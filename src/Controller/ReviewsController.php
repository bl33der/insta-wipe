<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\Utility\Text;

/**
 * Reviews Controller
 *
 * @property \App\Model\Table\ReviewsTable $Reviews
 */
class ReviewsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function initialize(): void
    {
        parent::initialize();

        // Allow non-logged-in users to view the reviews index and view pages
        $this->loadComponent('Authentication.Authentication');
        $this->Authentication->addUnauthenticatedActions(['index', 'add']);
        $this->Products = TableRegistry::getTableLocator()->get('Products');
        $this->Authentication->allowUnauthenticated(['add']);
    }
    public function index()
    {
        $query = $this->Reviews->find()
            ->contain(['Products']);
        $reviews = $this->paginate($query);

        $this->set(compact('reviews'));
    }

    /**
     * View method
     *
     * @param string|null $id Review id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $review = $this->Reviews->get($id, contain: ['Products']);
        $this->set(compact('review'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $review = $this->Reviews->newEmptyEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            // Handle image upload
            $file = $data['img_url'] ?? null;
            if ($file && $file->getError() === UPLOAD_ERR_OK) {
                $filename = time() . '_' . Text::slug(pathinfo($file->getClientFilename(), PATHINFO_FILENAME)) . '.' . pathinfo($file->getClientFilename(), PATHINFO_EXTENSION);
                $targetPath = WWW_ROOT . 'img/reviews/' . $filename;

                // Ensure target directory exists
                if (!is_dir(WWW_ROOT . 'img/reviews')) {
                    mkdir(WWW_ROOT . 'img/reviews', 0755, true);
                }

                $file->moveTo($targetPath);
                $data['img_url'] = 'img/reviews/' . $filename;
            } else {
                unset($data['img_url']);
            }

            // Patch and save
            $review = $this->Reviews->patchEntity($review, $data);
            if ($this->Reviews->save($review)) {
                $this->Flash->success('The review has been saved.');
                return $this->redirect(['controller' => 'Pages', 'action' => 'display', 'home']);
            }

            $this->Flash->error('The review could not be saved. Please, try again.');
        }

        $products = $this->Reviews->Products->find('list', [
            'keyField' => 'product_id',
            'valueField' => 'product_name'
        ])->toArray();

        $this->set(compact('review', 'products'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Review id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $review = $this->Reviews->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $review = $this->Reviews->patchEntity($review, $this->request->getData());
            if ($this->Reviews->save($review)) {
                $this->Flash->success(__('The review has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The review could not be saved. Please, try again.'));
        }
        $products = $this->Reviews->Products->find('list', limit: 200)->all();
        $this->set(compact('review', 'products'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Review id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $review = $this->Reviews->get($id);
        if ($this->Reviews->delete($review)) {
            $this->Flash->success(__('The review has been deleted.'));
        } else {
            $this->Flash->error(__('The review could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function approve($id)
    {
        $this->request->allowMethod(['post']);
        $review = $this->Reviews->get($id);
        $review->is_approved = !$review->is_approved;

        if ($this->Reviews->save($review)) {
            $this->Flash->success(__('Review visibility updated.'));
        } else {
            $this->Flash->error(__('Failed to update review visibility.'));
        }

        // Redirect back to the index
        return $this->redirect($this->referer(['action' => 'index']));
    }
}
