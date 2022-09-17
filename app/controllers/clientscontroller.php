<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\ClientsModel;
use PHPMVC\LIB\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Validate;

class ClientsController extends AbstractController
{
    use Helper;
    use InputFilter;
	use Validate;
	
	
	private $_createActionRules = 
	[ 
	     'name'          => 'req|alphanumspace|between(3,30)',
		 'email'         => 'email',
		 'address'       => 'alphanumspace',
		 'phone_number'  => 'max(15)'
	];
	
    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->language->load('clients.common');
        $this->language->load('clients.default');
        $this->_data['clients'] = ClientsModel::getAll();
        $this->_view();
    }
    
    
    public function createAction()
    {
        $this->language->load('template.common');
        $this->language->load('clients.common');
        $this->language->load('clients.create');
		$this->language->load('validate.errors');
        
        if(isset($_POST['submit']) && $this->isValid($this->_createActionRules, $_POST)) {
            $client = new ClientsModel();
            $client->name = $_POST['name'];
            $client->address = $_POST['address'];
            $client->phone_number = $_POST['phone_number'];
            $client->email = $_POST['email'];
            
            if($client->save()) {
                $this->messenger->add($this->language->get('message_create_success'));
                $this->redirect('/clients');
            } else {
                 $this->messenger->add($this->language->get('message_create_fail') , APP_MESSAGE_WARNING);
            }
        }
        
        $this->_view();
    }
	
	
	  public function editAction()
    {
		$id = $this->filterInt($this->_params[0]);
        $client = ClientsModel::getByPK($id);
         
         if($client === false) {
             $this->redirect('/clients');
         }
		 
        $this->language->load('template.common');
        $this->language->load('clients.common');
        $this->language->load('clients.edit');
		$this->language->load('validate.errors');
		
		$this->_data['client'] = $client;
        
        if(isset($_POST['submit']) && $this->isValid($this->_createActionRules, $_POST)) {
            $client->name = $_POST['name'];
            $client->address = $_POST['address'];
            $client->phone_number = $_POST['phone_number'];
            $client->email = $_POST['email'];
            
            if($client->save()) {
                $this->messenger->add($this->language->get('message_create_success'));
                $this->redirect('/clients');
            } else {
                 $this->messenger->add($this->language->get('message_create_fail') , APP_MESSAGE_WARNING);
            }
        }
        
        $this->_view();
    }
    
     public function deleteAction()
    {
        $this->language->load('clients.common');
         
        $id = $this->filterInt($this->_params[0]);
        $client = ClientsModel::getByPK($id);
         
         if($client === false) {
             $this->redirect('/clients');
         }
         
         if($client->delete()) {
               $this->messenger->add($this->language->get('message_delete_success'));
               $this->redirect('/clients');
         } else {
               $this->messenger->add($this->language->get('message_delete_fail') , APP_MESSAGE_WARNING);
         }
    
    }
    
    
}