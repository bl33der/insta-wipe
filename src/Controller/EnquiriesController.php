<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Mailer\Mailer;
/**
 * Enquiries Controller
 *
 * @property \App\Model\Table\EnquiriesTable $Enquiries
 */
class EnquiriesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        // Allow public access to these actions
        $this->Authentication->allowUnauthenticated(['view', 'index', 'add']);
    }

    /**
     * Index method — lists all enquiries
     */
    public function index()
    {
        $query = $this->Enquiries->find();
        $enquiries = $this->paginate($query);

        // Ensure this sets only $enquiries for the index template
        $this->set(compact('enquiries'));
    }

    /**
     * View method — shows a single enquiry
     */
    public function view($id = null)
    {
        // Retrieves a single enquiry for the view
        $enquiry = $this->Enquiries->get($id);
        $this->set(compact('enquiry'));
    }

    /**
     * Add method — creates a new enquiry
     */
    public function add()
    {
        $enquiry = $this->Enquiries->newEmptyEntity();

        if ($this->request->is('post')) {
            $enquiry = $this->Enquiries->patchEntity($enquiry, $this->request->getData());

            if ($this->Enquiries->save($enquiry)) {
                $mailer = new Mailer('default');
                $mailer
                    ->setEmailFormat('html')
                    ->setTo(Configure::read('EnquiryMail.to'))
                    ->setFrom(Configure::read('EnquiryMail.from'))
                    ->setSubject('New Enquiry Received')
                    ->viewBuilder()
                    ->setTemplate('enquiry');

                //Send data to the email template
                $mailer->setviewVars([
                    'message' => $enquiry->message,
                    'subject' => $enquiry->subject,
                    'email' => $enquiry->email,
                    'created' => $enquiry->created,
                    'id' => $enquiry->id
                ]);

                if (!$mailer->deliver()) {
                    $this->Flash->error(__('Enquiry email failed to send to: ' . $enquiry->email));
                }

                $this->Flash->success(__('The enquiry has been saved.'));
                $this->set('showPopup', true); // Optional popup flag
            } else {
                $this->Flash->error(__('The enquiry could not be saved. Please, try again.'));
            }
        }

        $this->set(compact('enquiry'));
    }

    /**
     * Edit method — allows modifying an enquiry
     */
    public function edit($id = null)
    {
        $enquiry = $this->Enquiries->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $enquiry = $this->Enquiries->patchEntity($enquiry, $this->request->getData());

            if ($this->Enquiries->save($enquiry)) {
                $this->Flash->success(__('The enquiry has been saved.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The enquiry could not be saved. Please, try again.'));
        }

        $this->set(compact('enquiry'));
    }

    /**
     * Delete method — removes an enquiry
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $enquiry = $this->Enquiries->get($id);

        if ($this->Enquiries->delete($enquiry)) {
            $this->Flash->success(__('The enquiry has been deleted.'));
        } else {
            $this->Flash->error(__('The enquiry could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Mark an enquiry as resolved (e.g. "Done")
     */
    public function markResolved($id = null)
    {
        $this->request->allowMethod(['post']);
        $enquiry = $this->Enquiries->get($id);

        if ($enquiry->is_resolved) {
            $this->Flash->info('This enquiry is already marked as done.');
        } else {
            $enquiry->is_resolved = true;

            if ($this->Enquiries->save($enquiry)) {
                $this->Flash->success('Marked as done.');
            } else {
                $this->Flash->error('Failed to update.');
            }
        }

        return $this->redirect(['action' => 'view', $id]);
    }
}
