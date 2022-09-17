<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\SuppliersModel;
use PHPMVC\LIB\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Validate;

class SuppliersController extends AbstractController
{
    use Helper;
    use InputFilter;
	use Validate;
	
	//TODO unrequired values nned to be fixed to not give error as empty value not email for example
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
        $this->language->load('suppliers.common');
        $this->language->load('suppliers.default');
        $this->_data['suppliers'] = SuppliersModel::getAll();
        $this->_view();
    }
    
    
    public function createAction()
    {
        $this->language->load('template.common');
        $this->language->load('suppliers.common');
        $this->language->load('suppliers.create');
		$this->language->load('validate.errors');
        
        if(isset($_POST['submit']) && $this->isValid($this->_createActionRules, $_POST)) {
            $supplier = new SuppliersModel();
            $supplier->name = $_POST['name'];
            $supplier->address = $_POST['address'];
            $supplier->phone_number = $_POST['phone_number'];
            $supplier->email = $_POST['email'];
            
            if($supplier->save()) {
                $this->messenger->add($this->language->get('message_create_success'));
                $this->redirect('/suppliers');
            } else {
                 $this->messenger->add($this->language->get('message_create_fail') , APP_MESSAGE_WARNING);
            }
        }
        
        $this->_view();
    }
	
	
	  public function editAction()
    {
		$id = $this->filterInt($this->_params[0]);
        $supplier = SuppliersModel::getByPK($id);
         
         if($supplier === false) {
             $this->redirect('/suppliers');
         }
		 
        $this->language->load('template.common');
        $this->language->load('suppliers.common');
        $this->language->load('suppliers.edit');
		$this->language->load('validate.errors');
		
		$this->_data['supplier'] = $supplier;
        
        if(isset($_POST['submit']) && $this->isValid($this->_createActionRules, $_POST)) {
            $supplier->name = $_POST['name'];
            $supplier->address = $_POST['address'];
            $supplier->phone_number = $_POST['phone_number'];
            $supplier->email = $_POST['email'];
            
            if($supplier->save()) {
                $this->messenger->add($this->language->get('message_create_success'));
                $this->redirect('/suppliers');
            } else {
                 $this->messenger->add($this->language->get('message_create_fail') , APP_MESSAGE_WARNING);
            }
        }
        
        $this->_view();
    }
    
     public function deleteAction()
    {
        $this->language->load('suppliers.common');
         
        $id = $this->filterInt($this->_params[0]);
        $supplier = SuppliersModel::getByPK($id);
         
         if($supplier === false) {
             $this->redirect('/suppliers');
         }
         
         if($supplier->delete()) {
               $this->messenger->add($this->language->get('message_delete_success'));
               $this->redirect('/suppliers');
         } else {
               $this->messenger->add($this->language->get('message_delete_fail') , APP_MESSAGE_WARNING);
         }
    
    }
    
    
}