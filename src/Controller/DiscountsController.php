<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Discounts Controller
 *
 * @property \App\Model\Table\DiscountsTable $Discounts
 */
class DiscountsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function beforeFilter(\Cake\Event\EventInterface $event): void
    {
        parent::beforeFilter($event);

        // Allow this endpoint without login
        $this->Authentication->addUnauthenticatedActions(['activeCodes']);
    }
    public function index()
    {
        $query = $this->Discounts->find();
        $discounts = $this->paginate($query);

        $this->set(compact('discounts'));
    }

    /**
     * View method
     *
     * @param string|null $id Discount id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $discount = $this->Discounts->get($id, contain: []);
        $this->set(compact('discount'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $discount = $this->Discounts->newEmptyEntity();
        if ($this->request->is('post')) {
            $discount = $this->Discounts->patchEntity($discount, $this->request->getData());
            if ($this->Discounts->save($discount)) {
                $this->Flash->success(__('The discount has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The discount could not be saved. Please, try again.'));
        }
        $this->set(compact('discount'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Discount id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $discount = $this->Discounts->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $discount = $this->Discounts->patchEntity($discount, $this->request->getData());
            if ($this->Discounts->save($discount)) {
                $this->Flash->success(__('The discount has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The discount could not be saved. Please, try again.'));
        }
        $this->set(compact('discount'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Discount id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $discount = $this->Discounts->get($id);
        if ($this->Discounts->delete($discount)) {
            $this->Flash->success(__('The discount has been deleted.'));
        } else {
            $this->Flash->error(__('The discount could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function activeCodes()
    {
        $this->request->allowMethod(['get']);
        $this->autoRender = false;

        $discounts = $this->Discounts->find()
            ->select(['discount_code', 'discount_amount'])
            ->where([
                'is_active' => true,
                'start_date <=' => date('Y-m-d'),
                'end_date >=' => date('Y-m-d')
            ])
            ->toArray();

        return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode($discounts));
    }
}
