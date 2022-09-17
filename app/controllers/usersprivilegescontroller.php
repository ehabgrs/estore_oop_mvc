<?php
namespace PHPMVC\Controllers;

use \PHPMVC\Models\UsersPrivilegesModel;
use \PHPMVC\LIB\InputFilter;
use \PHPMVC\LIB\Helper;
use \PHPMVC\Models\UsersGroupsPrivilegesModel;

class UsersPrivilegesController extends AbstractController
{
	use InputFilter;
	use Helper;
	
    public function defaultAction()
    {
        
        $this->language->load('template.common');
        $this->language->load('usersprivileges.default');
        $this->_data['users_privileges'] = UsersPrivilegesModel::getAll();
        $this->_view();
    }
	
	public function createAction()
	{
		$this->language->load('template.common');
		$this->language->load('usersprivileges.common');
        $this->language->load('usersprivileges.create');
		if(isset($_POST['submit'])) {
			$privilege = new usersPrivilegesModel();
			$privilege->privilege_url = $this->filterString($_POST['privilege_url']) ;
			$privilege->privilege_title = $this->filterString($_POST['privilege_title']);
			
			if($privilege->save()) {
				
				$this->redirect('/usersprivileges');
			}
		}
		
		
        $this->_view();
		
	}
	
		public function editAction()
	{
		// we will check first before anything if the id is valid and give me data
		//if true we will load all and continue
		$id = $this->filterInt($this->_params[0]);
		$privilege = UsersPrivilegesModel::getByPK($id);
		if($privilege === false) {
			$this->redirect('/usersprivileges');
		}
	    
		$this->language->load('template.common');
		$this->language->load('usersprivileges.common');
        $this->language->load('usersprivileges.edit');
		$this->_data['users_privileges'] = $privilege;
		
		if(isset($_POST['submit'])) {
            //we will not make a new object here because we already have the one we get by id
            // the id will be defined in this object so save() will be update not create
			//$privilege = new usersPrivilegesModel();
			//$privilege->id = $id ;
            
			$privilege->privilege_url = $this->filterString($_POST['privilege_url']) ;
			$privilege->privilege_title = $this->filterString($_POST['privilege_title']);
			
			if($privilege->save()) {
				
				$this->redirect('/usersprivileges');
			}
		}
		
		
        $this->_view();
		
	}
	
	
	
	
	public function deleteAction()
	{
		
		$id = $this->filterInt($this->_params[0]);
		$privilege = UsersPrivilegesModel::getByPK($id);
		if($privilege === false) {
			$this->redirect('/usersprivileges');
		}
	    
		$this->language->load('template.common');
		$this->language->load('usersprivileges.common');
        $this->language->load('usersprivileges.delete');
		
		$this->_data['users_privileges'] = $privilege;
                
        //we will delete the privileges in the group privileges table to avoid the error related for the refrences keys
		
		if(isset($_POST['submit'])) {
            
		    $group_privileges = UsersGroupsPrivilegesModel::getBy(['privilege_id' => $id]);
            
            if($group_privileges !== false) {
                foreach($group_privileges as $group_privilege) {
                    $group_privilege->delete();
                }
            }
            
			if($privilege->delete()) {
				$this->redirect('/usersprivileges');
			}
		}
        $this->_view();
		
	}
	

    
}