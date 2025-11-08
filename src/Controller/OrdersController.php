<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Orders Controller
 *
 * @property \App\Model\Table\OrdersTable $Orders
 */
class OrdersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->Authentication->allowUnauthenticated(['view', 'index']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Orders->find()
            ->contain(['Users']);
        $orders = $this->paginate($query);

        $this->set(compact('orders'));
    }

    /**
     * View method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $order = $this->Orders->get($id, contain: ['Users']);
        $this->set(compact('order'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $order = $this->Orders->newEmptyEntity();
        if ($this->request->is('post')) {
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }
        $users = $this->Orders->Users->find('list', limit: 200)->all();
        $this->set(compact('order', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $order = $this->Orders->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }
        $users = $this->Orders->Users->find('list', limit: 200)->all();
        $this->set(compact('order', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $order = $this->Orders->get($id);
        if ($this->Orders->delete($order)) {
            $this->Flash->success(__('The order has been deleted.'));
        } else {
            $this->Flash->error(__('The order could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function checkout()
    {
        $this->Orders = TableRegistry::getTableLocator()->get('Orders');
        $this->Carts = TableRegistry::getTableLocator()->get('Carts');
        $userId = $this->Authentication->getIdentity()->id ?? null;

        $cartItems = $this->Carts->find('all', [
            'conditions' => ['Carts.user_id' => $userId],
            'contain' => ['Products']
        ])->toArray();

        $totalAmount = 0;
        foreach ($cartItems as $item) {
            $totalAmount += $item->product->price * $item->quantity;
        }

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            $customerEmail = !empty($data['email']) ? $data['email'] : null;


            $order = $this->Orders->newEntity([
                'user_id' => $userId,
                'stripe_charge_id' => null, // Can update this after payment
                'payment_method' => $data['payment_method'] ?? 'Stripe',
                'cart_data' => json_encode(array_map(function ($item) {
                    return [
                        'product' => $item->product->product_name,
                        'price' => $item->product->price,
                        'quantity' => $item->quantity
                    ];
                }, $cartItems)),
                'shipping_address' => $data['address_line'] . ', ' . $data['city'] . ', ' . $data['state'] . ' ' . $data['postal_code'] . ', ' . $data['country'],
                'ordered_at' => date('Y-m-d H:i:s'),
                'total_amount' => $totalAmount + (float)$data['shipping_method'],
                'order_status' => 'Pending'
            ]);

            if ($this->Orders->save($order)) {
                $this->Flash->success('Order placed successfully.');
                // Optional: clear user's cart
                $this->Carts->deleteAll(['user_id' => $userId]);
                return $this->redirect(['action' => 'confirmation', $order->id]);
            }

            $this->Flash->error('Unable to place the order. Please try again.');
        }

        $this->set(compact('cartItems', 'totalAmount'));
    }

    public function updateStatus($id)
    {
        $this->request->allowMethod(['post']);

        $order = $this->Orders->get($id);
        $order->order_status = $this->request->getData('order_status');

        if ($this->Orders->save($order)) {
            $this->Flash->success(__('Order status updated successfully.'));
        } else {
            $this->Flash->error(__('Failed to update order status.'));
        }

        return $this->redirect($this->referer());
    }
}
