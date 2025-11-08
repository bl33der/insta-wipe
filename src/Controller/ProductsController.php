<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\ORM\TableRegistry;


/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 */
class ProductsController extends AppController
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
        $query = $this->Products->find();
        $products = $this->paginate($query);
        $videosTable = TableRegistry::getTableLocator()->get('Videos');
        $videos = $videosTable->find('all', [ 'order' => ['Videos.created' => 'DESC'] ]);;

        $this->set(compact('products', 'videos'));
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $product = $this->Products->get($id);
        $this->set(compact('product'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Products->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();

            // Handle file upload
            if (!empty($data['img_url']->getClientFilename())) {
                $file = $data['img_url'];
                $filename = time() . '_' . $file->getClientFilename(); // Unique filename
                $targetPath = 'img/' . $filename;
                $product->img_url = $targetPath; // Ensure correct path is saved

                // Move file to img directory
                $file->moveTo($targetPath);
                $data['img_url'] = 'img/' . $filename; // Store only relative path
            } else {
                unset($data['img_url']); // Remove if no file uploaded
            }

            $product = $this->Products->patchEntity($product, $data);
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['controller' => 'Users', 'action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $this->set(compact('product'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $product = $this->Products->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            // Handle file upload
            if (!empty($data['img_url']->getClientFilename())) {
                $file = $data['img_url'];
                $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientFilename());
                $targetPath = WWW_ROOT . 'img/' . $filename;

                // Move the uploaded file
                $file->moveTo($targetPath);

                // Set the relative path in data
                $data['img_url'] = 'img/' . $filename;
            } else {
                unset($data['img_url']); // Retain existing image if none uploaded
            }

            $product = $this->Products->patchEntity($product, $data);

            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }

        $this->set(compact('product'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function toggleAvailability($id = null)
    {
        $this->request->allowMethod(['post']);
        $product = $this->Products->get($id);
        $product->is_enabled = !$product->is_enabled;

        if ($this->Products->save($product)) {
            $this->response = $this->response->withType('application/json');
            $this->response = $this->response->withStringBody(json_encode([
                'success' => true,
                'is_enabled' => $product->is_enabled
            ]));
            return $this->response;
        }

        $this->response->setStatusCode(400);
        return $this->response->withStringBody(json_encode(['success' => false]));
    }
    public function manage()
    {
        $this->paginate = [
            'limit' => 10,
            'order' => ['Products.product_id' => 'desc']
        ];

        $query = $this->Products->find();

        // Sorting setup
        $sortField = $this->request->getQuery('sort');
        $sortDirection = $this->request->getQuery('direction');

        // Allow sorting only on specific fields
        $validSortFields = ['product_id', 'name', 'price', 'is_available'];
        $validDirections = ['asc', 'desc'];

        if (in_array($sortField, $validSortFields) && in_array($sortDirection, $validDirections)) {
            $query->order([$sortField => $sortDirection]);
        }

        $products = $this->paginate($query);

        $this->set(compact('products'));
    }
}
