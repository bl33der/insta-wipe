<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * AboutUs Controller
 *
 * @property \App\Model\Table\AboutUsTable $AboutUs
 */
class AboutUsController extends AppController
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
        $query = $this->AboutUs->find();
        $aboutUs = $this->paginate($query);

        $this->set(compact('aboutUs'));
    }

    /**
     * View method
     *
     * @param string|null $id About U id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $aboutU = $this->AboutUs->get($id, contain: []);
        $this->set(compact('aboutU'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $aboutU = $this->AboutUs->newEmptyEntity();
        if ($this->request->is('post')) {
            $aboutU = $this->AboutUs->patchEntity($aboutU, $this->request->getData());
            if ($this->AboutUs->save($aboutU)) {
                $this->Flash->success(__('The about u has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The about u could not be saved. Please, try again.'));
        }
        $this->set(compact('aboutU'));
    }

    /**
     * Edit method
     *
     * @param string|null $id About U id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $aboutU = $this->AboutUs->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $aboutU = $this->AboutUs->patchEntity($aboutU, $this->request->getData());
            if ($this->AboutUs->save($aboutU)) {
                $this->Flash->success(__('The about u has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The about u could not be saved. Please, try again.'));
        }
        $this->set(compact('aboutU'));
    }

    /**
     * Delete method
     *
     * @param string|null $id About U id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $aboutU = $this->AboutUs->get($id);
        if ($this->AboutUs->delete($aboutU)) {
            $this->Flash->success(__('The about u has been deleted.'));
        } else {
            $this->Flash->error(__('The about u could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
