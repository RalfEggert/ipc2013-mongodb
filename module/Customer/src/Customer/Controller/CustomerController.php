<?php
/**
 * Zend Framework 2 feat. MongoDB
 *
 * Zend Framework Session auf der International PHP Conference 2013 in München
 *
 * @package    Customer
 * @author     Ralf Eggert <r.eggert@travello.de>
 * @copyright  Ralf Eggert <r.eggert@travello.de>
 * @link       http://www.ralfeggert.de/
 */

/**
 * namespace definition and usage
 */
namespace Customer\Controller;

use Zend\Http\PhpEnvironment\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Customer\Form\CustomerForm;
use Customer\Service\CustomerService;

/**
 * Customer customer controller
 *
 * Handles the customer pages
 *
 * @package    Customer
 */
class CustomerController extends AbstractActionController
{
    /**
     * @var CustomerForm
     */
    protected $form;

    /**
     * @var CustomerService
     */
    protected $customerService;

    /**
     * set the customer service
     *
     * @param CustomerService
     */
    public function setCustomerService(CustomerService $customerService)
    {
        $this->customerService = $customerService;

        return $this;
    }

    /**
     * Get the customer service
     *
     * @return CustomerService
     */
    public function getCustomerService()
    {
        return $this->customerService;
    }

    /**
     * set the customer form
     *
     * @param CustomerForm
     */
    public function setCustomerForm(CustomerForm $form)
    {
        $this->form = $form;

        return $this;
    }

    /**
     * Get the customer form
     *
     * @return CustomerForm
     */
    public function getCustomerForm()
    {
        return $this->form;
    }

    /**
     * Handle index page
     */
    public function indexAction()
    {
        $customerList = $this->getCustomerService()->fetchList();

        return new ViewModel(array(
            'customerList' => $customerList,
        ));
    }

    /**
     * Handle show page
     */
    public function showAction()
    {
        $id = $this->params()->fromRoute('id');

        if (!$id) {
            return $this->redirect()->toRoute('customer');
        }

        $customerEntity = $this->getCustomerService()->fetchSingleById($id);

        if (!$customerEntity) {
            return $this->redirect()->toRoute('customer');
        }

        return new ViewModel(array(
            'customerEntity' => $customerEntity,
        ));
    }

    /**
     * Handle create page
     */
    public function createAction()
    {
        // prepare Post/Redirect/Get Plugin
        $prg = $this->prg(
            $this->url()->fromRoute('customer/action', array('action' => 'create')),
            true
        );

        // check PRG plugin for redirect to send
        if ($prg instanceof Response) {
            return $prg;

            // check PRG for redirect to process
        } elseif ($prg !== false) {

            // create with redirected data
            $customer = $this->getCustomerService()->save($prg);

            // check customer
            if ($customer) {
                // add messages to flash messenger
                if ($this->getCustomerService()->getMessage()) {
                    $this->flashMessenger()->addMessage(
                        $this->getCustomerService()->getMessage()
                    );
                }

                // Redirect to createed page
                return $this->redirect()->toRoute(
                    'customer/action', array(
                        'action' => 'update', 'id' => $customer->getId()
                    )
                );
            }
        }

        // get form
        $form = $this->getCustomerForm();
        $form->setMessages($this->getCustomerService()->getFilter()->getMessages());

        // set values from GET request
        if ($prg != false) {
            $form->setData($prg);
        }

        // add messages to flash messenger
        if ($this->getCustomerService()->getMessage()) {
            $this->flashMessenger()->addMessage(
                $this->getCustomerService()->getMessage()
            );
        }

        // no post or registration unsuccesful
        return new ViewModel(array(
            'form' => $form,
        ));
    }

    /**
     * Handle update page
     */
    public function updateAction()
    {
        // read id from route
        $id = $this->params()->fromRoute('id');

        // check for no id
        if (!$id) {
            // Redirect to createed page
            return $this->redirect()->toRoute('customer');
        }

        // read customer entity
        $customer = $this->getCustomerService()->fetchSingleById($id);

        // check for customer entity
        if (!$customer) {
            // Redirect to createed page
            return $this->redirect()->toRoute('customer');
        }

        // prepare Post/Redirect/Get Plugin
        $prg = $this->prg(
            $this->url()->fromRoute(
                'customer/action', array(
                    'action' => 'update', 'id' => $id
                )
            ),
            true
        );

        // check PRG plugin for redirect to send
        if ($prg instanceof Response) {
            return $prg;

            // check PRG for redirect to process
        } elseif ($prg !== false) {

            // update with redirected data
            $customer = $this->getCustomerService()->save($prg, $id);

            // check customer
            if ($customer) {
                // add messages to flash messenger
                if ($this->getCustomerService()->getMessage()) {
                    $this->flashMessenger()->addMessage(
                        $this->getCustomerService()->getMessage()
                    );
                }

                // Redirect to updateed page
                return $this->redirect()->toRoute(
                    'customer/action', array(
                        'action' => 'update', 'id' => $customer->getId()
                    )
                );
            }
        }

        // get form
        $form = $this->getCustomerForm();
        $form->setMessages($this->getCustomerService()->getFilter()->getMessages());

        //check prg
        if ($prg === false) {
            $form->bind($customer);
        } else {
            $form->setData($prg);
        }

        // add messages to flash messenger
        if ($this->getCustomerService()->getMessage()) {
            $this->flashMessenger()->addMessage(
                $this->getCustomerService()->getMessage()
            );
        }

        // no post or registration unsuccesful
        return new ViewModel(array(
            'form' => $form,
        ));
    }

    /**
     * Handle delete page
     */
    public function deleteAction()
    {
        // read id from route
        $id = $this->params()->fromRoute('id');

        // check for no id
        if (!$id) {
            // Redirect to createed page
            return $this->redirect()->toRoute('customer');
        }

        // read customer entity
        $customer = $this->getCustomerService()->fetchSingleById($id);

        // check for customer entity
        if (!$customer) {
            // Redirect to createed page
            return $this->redirect()->toRoute('customer');
        }

        // delete with redirected data
        $customer = $this->getCustomerService()->delete($id);

        // add messages to flash messenger
        if ($this->getCustomerService()->getMessage()) {
            $this->flashMessenger()->addMessage(
                $this->getCustomerService()->getMessage()
            );
        }

        // Redirect to createed page
        return $this->redirect()->toRoute('customer');
    }
}
