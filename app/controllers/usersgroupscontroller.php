<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\UsersGroupsModel;
use PHPMVC\LIB\Helper;
use PHPMVC\LIB\InputFilter;
use \PHPMVC\Models\UsersPrivilegesModel;
use \PHPMVC\Models\UsersGroupsPrivilegesModel;


class UsersGroupsController extends AbstractController
{
	use Helper;
	use InputFilter;
	
    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->language->load('usersgroups.default');
        $this->_data['users_groups'] = UsersGroupsModel::getAll();
        $this->_data['groups_privileges_model'] = new UsersGroupsPrivilegesModel();
        $this->_view();
    }
	
	
	public function createAction()
	{
		$this->language->load('template.common');
        $this->language->load('usersgroups.create');
		//fetch all the privileges to can choose the privileges for the group in the form
		$this->_data['privileges'] = UsersPrivilegesModel::getAll();
		
		if(isset($_POST['submit'])) {
			$userGroup = new UsersGroupsModel();
			$userGroup->group_name = $this->filterString($_POST['group_name']);
			
			// after we saved the group name then we begin to add the group id and the privileges id's one by one into app_users_groups_privileges tables
			
			if($userGroup->save()) {
				
				if(isset($_POST['privileges']) && is_array($_POST['privileges'])) {
					
					foreach($_POST['privileges'] as $privilege_id) {
						$groupPrivileges = new UsersGroupsPrivilegesModel();
						// we will get group id from $userGroup object that we saved 
						$groupPrivileges->group_id = $userGroup->id;
						$groupPrivileges->privilege_id = $privilege_id;
						$groupPrivileges->save();
					}
					
				}
				$this->redirect('/usersgroups');
				
			}
			
			
		}
        $this->_view();
		
	}
    
    
	
    public function editAction()
	{
		$id = $this->filterInt($this->_params[0]);
		$user_group = UsersGroupsModel::getByPK($id);
		if($user_group === false) {
			$this->redirect('/usersgroups');
		}
		
		$this->language->load('template.common');
        $this->language->load('usersgroups.edit');
	    //fetch all the privileges to can choose the privileges for the group in the form
		$this->_data['privileges'] = UsersPrivilegesModel::getAll();
		
		
		//get the group by id
		$this->_data['user_group'] = $user_group;
		
		//we will get the privileges for the group we will edit, from app_users_groups_privileges, using getby function from the abstractmodel
		$group_privileges = UsersGroupsPrivilegesModel::getBy(['group_id' => $id]);
		
		//we will just need the privilges ids to mark the privileges values in the form for the edit
		$group_privileges_ids = [];
		
		if($group_privileges !== false) {
			foreach($group_privileges as $group_privilege) {
				$group_privileges_ids[] = $group_privilege->privilege_id;
			}	
		}
		
		$this->_data['group_privileges_ids'] = $group_privileges_ids;
		
		if(isset($_POST['submit'])) {
			
			$user_group->group_name = $this->filterString($_POST['group_name']);
            
			if($user_group->save()) {
				
				if(isset($_POST['privileges']) && is_array($_POST['privileges'])) {
                    
                    //compare the old selected privileges with the new ones after the edit
                    // array_diff(array1, array2) give the values in array1 that is not found on array2
                    $privilegesToBeDeleted = array_diff($group_privileges_ids , $_POST['privileges']);
                    $privilegesToBeAdded = array_diff($_POST['privileges'] , $group_privileges_ids);

                    //delete the unwanted privileges
                    foreach($privilegesToBeDeleted as $deletedPrivilege) {
                        //getby take array can have more than one condition exactly like where --- and  ----
                        //we will select the row to be deleted in app_users_groups_privileges by privilege_id and group_id
                        $privilegeToBeDeleted = UsersGroupsPrivilegesModel::getBy(['privilege_id' => $deletedPrivilege, 'group_id' => $user_group->id]);
                        
                        // current related for use iterator array (check the abstrsctmodel)
                        $privilegeToBeDeleted->current()->delete();
                        
                    }
                    
					// add the new privileges
					foreach($privilegesToBeAdded as $privilege_id) {
						$groupPrivileges = new UsersGroupsPrivilegesModel();
						$groupPrivileges->group_id = $user_group->id;
						$groupPrivileges->privilege_id = $privilege_id;
						$groupPrivileges->save();
					}
					
				}
                
				$this->redirect('/usersgroups');
				
			}
			
			
		}
        
        $this->_view();	
	}
    
    
    public function deleteAction() 
    {
        $id = $this->filterInt($this->_params[0]);
        $user_group = UsersGroupsModel::getByPK($id);
        
        if($user_group === false) {
            $this->redirect('/usersgroups');
        }
        
        //we can make the delete without create view for it
        // so we will not put the language or data or view
        
        //we will delete the rows of group pirivilege in app_users_groups_privileges table first
        //before delete the group from app_users_groups table
        //because of the refrences keys
        $group_privileges = UsersGroupsPrivilegesModel::getBy(['group_id' => $id]);
        if(false !== $group_privileges) {
             foreach($group_privileges as $group_privilege) {
                   $group_privilege->delete();
             }
        }
       
        if($user_group->delete()) {
            $this->redirect('/usersgroups');
        }
        
    }
    
    
}