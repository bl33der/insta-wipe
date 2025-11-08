<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\I18n\FrozenDate;

class CartsController extends AppController
{
    protected $Carts;
    protected $Products;
    protected $Discounts;
    protected $Orders;

    public function initialize(): void
    {
        parent::initialize();
        $this->Carts = TableRegistry::getTableLocator()->get('Carts');
        $this->Products = TableRegistry::getTableLocator()->get('Products');

        $this->Authentication->allowUnauthenticated([
            'view', 'index', 'add', 'edit', 'checkout', 'updateQuantity', 'delete', 'confirmation', 'thankyou'
        ]);
    }

    public function index()
    {
        $carts = $this->Carts->find('all', ['contain' => ['Products']])->all();
        $this->set(compact('carts'));
    }

    public function view($id = null)
    {
        $cart = $this->Carts->get($id, ['contain' => ['Products']]);
        $this->set(compact('cart'));
    }

    public function add($productId = null)
    {
        $product = $this->Products->get($productId);

        if (!$product->is_enabled /* || $product->stock_quantity < 1 */) {
            $this->Flash->error(__('This product is currently unavailable'));
            return $this->redirect(['controller' => 'Products', 'action' => 'index']);
        }

        if (!$productId) {
            $this->Flash->error(__('Invalid product.'));
            return $this->redirect(['controller' => 'Products', 'action' => 'index']);
        }

        $existing = $this->Carts->find()->where(['product_id' => $productId])->first();

        if ($existing) {
            $existing->quantity += 1;
            $this->Carts->save($existing);
        } else {
            $cart = $this->Carts->newEmptyEntity();
            $cart = $this->Carts->patchEntity($cart, ['product_id' => $productId, 'quantity' => 1]);
            $this->Carts->save($cart);
        }

        //Flash message
        $this->Flash->success(__('Product has been added to your cart.'));

        return $this->redirect(['controller' => 'Products', 'action' => 'index']);
    }

    public function updateQuantity($id)
    {
        $this->request->allowMethod(['post']);
        $change = (int)$this->request->getData('change');
        $cart = $this->Carts->get($id, ['contain' => ['Products']]);

        // No more stock limit check here
        $cart->quantity += $change;

        if ($cart->quantity <= 0) {
            $this->Carts->delete($cart);
        } else {
            $this->Carts->save($cart);
        }

        return $this->redirect(['action' => 'index']);
    }

    public function checkout()
    {
        $this->Orders = TableRegistry::getTableLocator()->get('Orders');
        $this->Carts = TableRegistry::getTableLocator()->get('Carts');
        $this->Discounts = TableRegistry::getTableLocator()->get('Discounts');

        $cartItems = $this->Carts->find()->contain(['Products'])->all();

        foreach ($cartItems as $item) {
            if (!$item->product->is_enabled) {
                $this->Flash->error(__('{0} is no longer available', $item->product->product_name));
                return $this->redirect(['action' => 'index']);
            }
        }

        if ($cartItems->isEmpty()) {
            $this->Flash->error('Your cart is empty.');
            return $this->redirect(['action' => 'index']);
        }

        $totalAmount = 0;
        foreach ($cartItems as $item) {
            $totalAmount += $item->product->price * $item->quantity;
        }

        $discountAmount = 0;
        $appliedDiscount = null;

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            // Get email after form data is captured
            $customerEmail = !empty($data['email']) ? $data['email'] : null;

            $shippingCost = floatval($data['shipping_method'] ?? 0);

            if (!empty($data['discount_code'])) {
                $discount = $this->Discounts->find()
                    ->where([
                        'discount_code' => $data['discount_code'],
                        'is_active' => true,
                        'start_date <=' => date('Y-m-d'),
                        'end_date >=' => date('Y-m-d')
                    ])
                    ->first();

                if ($discount) {
                    $discountAmount = floatval($discount->discount_amount);
                    $appliedDiscount = $discount;
                    $this->Flash->success(__('Discount applied: ${0}', $discountAmount));
                } else {
                    $this->Flash->error(__('Invalid or expired discount code.'));
                }
            }

            $totalAmount = max(0, $totalAmount - $discountAmount + $shippingCost);

            $session = $this->request->getSession();
            $session->write('shipping_address', implode(', ', array_filter([
                $data['address_line'] ?? '',
                $data['city'] ?? '',
                $data['state'] ?? '',
                $data['postal_code'] ?? '',
                $data['country'] ?? ''
            ])));
            $session->write('cart_summary', array_map(function ($item) {
                return $item->product->product_name . ' x ' . $item->quantity;
            }, $cartItems->toArray()));
            $session->write('checkout_email', $data['email']);

            \Stripe\Stripe::setApiKey('sk_test_wsFx86XDJWwmE4dMskBgJYrt');

            try {
                $lineItems = [];
                $discountRemaining = $discountAmount;

                foreach ($cartItems as $item) {
                    $price = $item->product->price;
                    $quantity = $item->quantity;
                    $totalForItem = $price * $quantity;

                    if ($discountRemaining > 0) {
                        $discountToApply = min($discountRemaining, $totalForItem);
                        $totalForItem -= $discountToApply;
                        $discountRemaining -= $discountToApply;
                    }

                    $unitAmount = intval(round($totalForItem * 100 / $quantity));

                    $lineItems[] = [
                        'price_data' => [
                            'currency' => 'aud',
                            'product_data' => ['name' => $item->product->product_name],
                            'unit_amount' => max(0, $unitAmount)
                        ],
                        'quantity' => $quantity
                    ];
                }

                if ($shippingCost > 0) {
                    $lineItems[] = [
                        'price_data' => [
                            'currency' => 'aud',
                            'product_data' => ['name' => 'Shipping'],
                            'unit_amount' => intval($shippingCost * 100)
                        ],
                        'quantity' => 1
                    ];
                }

                $stripeSession = \Stripe\Checkout\Session::create([
                    'payment_method_types' => ['card'],
                    'line_items' => $lineItems,
                    'mode' => 'payment',
                    'success_url' => Router::url(['action' => 'confirmation'], true) . '?session_id={CHECKOUT_SESSION_ID}',
                    'cancel_url' => Router::url(['action' => 'checkout'], true),
                    'customer_email' => $customerEmail
                ]);

                return $this->redirect($stripeSession->url);
            } catch (\Exception $e) {
                $this->Flash->error('Stripe error: ' . $e->getMessage());
                return $this->redirect(['action' => 'checkout']);
            }
        }

        $this->set(compact('cartItems', 'totalAmount', 'discountAmount'));
    }

    public function confirmation()
    {
        \Stripe\Stripe::setApiKey('sk_test_wsFx86XDJWwmE4dMskBgJYrt');
        $sessionId = $this->request->getQuery('session_id');

        try {
            $stripeSession = \Stripe\Checkout\Session::retrieve($sessionId);
            $paymentIntent = \Stripe\PaymentIntent::retrieve($stripeSession->payment_intent);

            $this->Orders = TableRegistry::getTableLocator()->get('Orders');
            $this->Carts = TableRegistry::getTableLocator()->get('Carts');

            $cartItems = $this->Carts->find()->contain(['Products'])->all();
            $session = $this->request->getSession();

            $cartJson = json_encode(array_map(function ($item) {
                return [
                    'product' => $item->product->product_name,
                    'price' => $item->product->price,
                    'quantity' => $item->quantity
                ];
            }, $cartItems->toArray()), JSON_UNESCAPED_UNICODE);

            $email = $session->read('checkout_email');
            $shippingAddress = $session->read('shipping_address') ?? '[Guest provided address]';
            $totalAmount = $paymentIntent->amount_received / 100;

            $order = $this->Orders->newEntity([
                'user_id' => null,
                'email' => $email,
                'payment_method' => 'Stripe',
                'stripe_charge_id' => $paymentIntent->id,
                'cart_data' => $cartJson,
                'shipping_address' => $shippingAddress,
                'ordered_at' => date('Y-m-d H:i:s'),
                'total_amount' => $totalAmount,
                'order_status' => 'Paid'
            ]);

            try {
                $connection = $this->Orders->getConnection();
                $connection->begin();

                if ($this->Orders->save($order)) {
                    $connection->commit();
                    $this->Carts->deleteAll([]);
                    $session->delete('cart_summary');
                    $session->delete('shipping_address');
                    $session->delete('email');
                    return $this->redirect(['action' => 'thankyou']);
                } else {
                    $connection->rollback();
                    $this->Flash->error('Order could not be saved.');
                }

            } catch (\Exception $e) {
                $connection->rollback();
                $this->Flash->error('Order failed: ' . $e->getMessage());
                return $this->redirect(['action' => 'checkout']);
            }
        } catch (\Exception $e) {
            $this->Flash->error('Stripe session failed: ' . $e->getMessage());
        }

        return $this->redirect(['controller' => 'Carts', 'action' => 'checkout']);
    }


    public function thankyou()
    {
        $this->set('message', 'Thank you for your order. A confirmation email will be sent to you shortly.');
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cart = $this->Carts->get($id);
        if ($this->Carts->delete($cart)) {
            $this->Flash->success(__('The cart has been deleted.'));
        } else {
            $this->Flash->error(__('The cart could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
