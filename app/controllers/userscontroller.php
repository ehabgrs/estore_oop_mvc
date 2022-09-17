<?php 
namespace PHPMVC\Controllers;

 use \PHPMVC\LIB\InputFilter;
 use \PHPMVC\LIB\Helper;
 use \PHPMVC\Models\UserModel;
 use \PHPMVC\Models\UserProfileModel;
 use \PHPMVC\Models\UsersGroupsModel;
 use \PHPMVC\LIB\Validate;
 use \PHPMVC\LIB\Messenger;

class UsersController extends AbstractController
{
	use Validate;
	use InputFilter;
	use Helper;
	
	private $_createActionRules = 
	[ 
	     'username'      => 'req|alphanum|between(3,12)',
         'first_name'    => 'req|alpha|between(3,10)',
         'last_name'     => 'req|alpha|between(3,10)',
		 'password'      => 'req|min(6)|max(20)',
		 'cpassword'     => 'req|min(6)|max(20)|eq_field(password)',
		 'email'         => 'req|email',
		 'cemail'        => 'req|email|eq_field(email)',
		 'phone_number'  => 'req|max(15)',
		 'group_id'      => 'req|int'
	];
    
    
    private $_editActionRules = 
	[ 
		 'phone_number'  => 'req|max(15)',
		 'group_id'      => 'req|int'
	];
	
	public function defaultAction()
	{
		$this->language->load('template.common');
        $this->language->load('users.default');
		// we added the data for _data array for this controller
		$this->_data['users'] = UserModel::getUsers();
        $this->_view();
		
	}
	
	
	public function createAction()
	{
		$this->language->load('template.common');
        $this->language->load('users.create');
		$this->language->load('users.common');
        $this->language->load('validate.errors');
		// we added the data for _data array for this controller
		$this->_data['groups'] = UsersGroupsModel::getAll();
		
		
		if(isset($_POST['submit']) && $this->isValid($this->_createActionRules, $_POST)) {
            
			$user = new UserModel;
			$user->username = $this->filterString($_POST['username']);
			$user->password = UserModel::cryptPassword($_POST['password']);
			$user->email = $this->filterString($_POST['email']);
			$user->phone_number = $this->filterString($_POST['phone_number']);
			$user->group_id = $this->filterInt($_POST['group_id']);
			$user->subscription_date = date('y-m-d');
			$user->last_login = date('Y-m-d H:i:s');
			$user->status = 1;
            
            
            if(UserModel::userExists($user->username)) {
                $this->messenger->add($this->language->get('message_user_exists') , Messenger::APP_MESSAGE_WARNING ) ;
            } else {
                
                    if($user->save()) {
                    
                        $userProfile = new UserProfileModel();
                        $userProfile->id = $user->id;
                        $userProfile->first_name = $this->filterString($_POST['first_name']);
                        $userProfile->last_name = $this->filterString($_POST['last_name']);
                        $userProfile->save(false);

                        $this->messenger->add($this->language->get('message_create_success') );
                        $this->redirect('/users');
                    } else {
                        $this->messenger->add($this->language->get('message_create_fail'), Messenger::APP_MESSAGE_WARNING );
                    }
                
             }
            
		}
		
        $this->_view();

		
	}
	
	
	public function editAction()
	{
            $id = $this->filterInt($this->_params[0]);
        
            $user = UserModel::getByPK($id);
            if($user === false) {
                $this->redirect('/users');
            }
            $this->_data['user'] = $user;
            $this->_data['groups'] = UsersGroupsModel::getAll();
        
            $this->language->load('template.common');
            $this->language->load('users.edit');
            $this->language->load('users.common');
            $this->language->load('validate.errors');

            
            
		
		
		
            if(isset($_POST['submit']) && $this->isValid($this->_editActionRules, $_POST)) {
                $user->phone_number = $this->filterString($_POST['phone_number']);
                $user->group_id = $this->filterInt($_POST['group_id']);
                $user->status = 1;
                
                
                if($user->save()) {
                    $this->messenger->add($this->language->get('message_create_success') );
                    $this->redirect('/users');
                } else {
                    $this->messenger->add($this->language->get('message_create_fail') ,APP_MESSAGE_WARNING );
                }



            }

            $this->_view();
		
	}
    
    
    
    public function deleteAction()     
	{
        $this->language->load('users.common');
        
        $id = $this->filterInt($this->_params[0]);

        $user = UserModel::getByPK($id);
        
        if($user === false || $this->session->u->id == $id) {
            //$this->session->u->id == $id we added this part to not let the active usr delete himself
            $this->messenger->add($this->language->get('message_delete_youself'),Messenger::APP_MESSAGE_WARNING );
            $this->redirect('/users');
        }
       
          
        if($user->delete()) {
            
            $this->messenger->add($this->language->get('message_delete_success') );
            $this->redirect('/users');

        } else {

            $this->messenger->add($this->language->get('message_delete_fail') , Messenger::APP_MESSAGE_WARNING );

        }
		
    }
    
    
    //action for check if the username in the database already or not, immediately
    public function checkUserExistsAjaxAction()
    {
        if(isset($_POST['username'])) {
            
            header('Content-type: text/plain');        
            if( UserModel::userExists($this->filterString($_POST['username']) ) ) {
                echo '1';
            } else {
                echo '2';
            }
        }
    }
	

}