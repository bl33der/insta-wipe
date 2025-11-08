<?php
declare(strict_types=1);

namespace App\Controller;

use Stripe\Stripe;
use Cake\ORM\TableRegistry;
use Stripe\Checkout\Session;
use Cake\Core\Configure;
use Cake\Routing\Router;

/**
 * Payments Controller
 *
 * @property \App\Model\Table\PaymentsTable $Payments
 * @method \Cake\ORM\Table loadModel(string $modelClass, ?string $type = null)
 */
class PaymentsController extends AppController
{
    protected $Carts;
    protected $Products;

    public function initialize(): void
    {
        parent::initialize();
        $this->Carts = TableRegistry::getTableLocator()->get('Carts');
        $this->Products = TableRegistry::getTableLocator()->get('Products');
        $this->Authentication->allowUnauthenticated(['view', 'index', 'checkout', 'cancel', 'success', 'confirmation']);
    }

    public function checkout()
    {
        $session = $this->request->getSession();
        $address = $session->read('checkout.address');
        $totalAmount = $session->read('checkout.totalAmount');

        if (!$address || !$totalAmount) {
            $this->Flash->error('Missing checkout details.');
            return $this->redirect(['controller' => 'Carts', 'action' => 'checkout']);
        }

        Stripe::setApiKey(Configure::read('Stripe.secret'));

        // Clearly set Stripe's amount including postage from the session
        $lineItems = [[
            'price_data' => [
                'currency' => 'aud',
                'product_data' => ['name' => 'Order from Insta WIpe'],
                'unit_amount' => intval($totalAmount * 100),
            ],
            'quantity' => 1,
        ]];

        $stripeSession = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'customer_email' => $address['email'],
            'success_url' => Router::url(['controller' => 'Payments', 'action' => 'success', '?' => ['session_id' => '{CHECKOUT_SESSION_ID}']], true),
            'cancel_url' => Router::url(['controller' => 'Payments', 'action' => 'cancel'], true),
        ]);

        return $this->redirect($stripeSession->url);
    }

    public function success()
    {
        $this->Carts = TableRegistry::getTableLocator()->get('Carts');
        $cartItems = $this->Carts->find()->contain(['Products'])->all();

        foreach ($cartItems as $item) {
            $this->Products->updateAll(
                ['stock_quantity' => $this->Products->escapeField('stock_quantity') . ' - ' . $item->quantity],
                [
                    'product_id' => $item->product_id,
                    'stock_quantity >=' => $item->quantity
                ]
            );
        }

        $this->Carts->deleteAll([]);
        return $this->redirect(['controller' => 'Payments', 'action' => 'confirmation']);
    }

    public function cancel()
    {
        $this->Flash->error('Payment was cancelled.');
        return $this->redirect(['controller' => 'Carts', 'action' => 'index']);
    }

    public function index()
    {
        $query = $this->Payments->find()->contain(['Orders']);
        $payments = $this->paginate($query);

        $this->set(compact('payments'));
    }

    public function view($id = null)
    {
        $payment = $this->Payments->get($id, ['contain' => ['Orders']]);
        $this->set(compact('payment'));
    }

    public function add()
    {
        $payment = $this->Payments->newEmptyEntity();
        if ($this->request->is('post')) {
            $payment = $this->Payments->patchEntity($payment, $this->request->getData());
            if ($this->Payments->save($payment)) {
                $this->Flash->success(__('The payment has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The payment could not be saved. Please, try again.'));
        }
        $orders = $this->Payments->Orders->find('list', ['limit' => 200])->all();
        $this->set(compact('payment', 'orders'));
    }

    public function edit($id = null)
    {
        $payment = $this->Payments->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $payment = $this->Payments->patchEntity($payment, $this->request->getData());
            if ($this->Payments->save($payment)) {
                $this->Flash->success(__('The payment has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The payment could not be saved. Please, try again.'));
        }
        $orders = $this->Payments->Orders->find('list', ['limit' => 200])->all();
        $this->set(compact('payment', 'orders'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $payment = $this->Payments->get($id);
        if ($this->Payments->delete($payment)) {
            $this->Flash->success(__('The payment has been deleted.'));
        } else {
            $this->Flash->error(__('The payment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function confirmation()
    {
        // Can add order details here later
    }
}
