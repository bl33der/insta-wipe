<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Faqs Controller
 *
 * @property \App\Model\Table\FaqsTable $Faqs
 */
class FaqsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->Authentication->allowUnauthenticated(['index']);
    }
    public function index()
{
    $search = $this->request->getQuery('q');

    $query = $this->Faqs->find();

    if (!empty($search)) {
        $query->where([
            'OR' => [
                'Faqs.question LIKE' => '%' . $search . '%',
                'Faqs.answer LIKE' => '%' . $search . '%'
            ]
        ]);
    }

    $faqs = $query->all();

    $this->set(compact('faqs', 'search'));
}
    /**
     * View method
     *
     * @param string|null $id Faq id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $faq = $this->Faqs->get($id, contain: []);
        $this->set(compact('faq'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $faq = $this->Faqs->newEmptyEntity();
        if ($this->request->is('post')) {
            $faq = $this->Faqs->patchEntity($faq, $this->request->getData());
            if ($this->Faqs->save($faq)) {
                $this->Flash->success(__('The faq has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The faq could not be saved. Please, try again.'));
        }
        $this->set(compact('faq'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Faq id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $faq = $this->Faqs->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $faq = $this->Faqs->patchEntity($faq, $this->request->getData());
            if ($this->Faqs->save($faq)) {
                $this->Flash->success(__('The FAQ has been saved.'));

                // Redirect to 'manage' instead of 'index'
                return $this->redirect(['action' => 'manage']);
            }
            $this->Flash->error(__('The FAQ could not be saved. Please, try again.'));
        }
        $this->set(compact('faq'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Faq id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $faq = $this->Faqs->get($id);
        if ($this->Faqs->delete($faq)) {
            $this->Flash->success(__('The faq has been deleted.'));
        } else {
            $this->Flash->error(__('The faq could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'manage']);
    }
    public function manage()
    {
        $query = $this->Faqs->find();
        $faqs = $this->paginate($query);

        $this->set(compact('faqs'));
        $this->render('manage');
    }
}
