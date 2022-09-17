<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\UserModel;
use PHPMVC\LIB\Messenger;
use PHPMVC\LIB\Helper;

class AuthenticationController extends AbstractController
{
	use Helper;
	
	public function loginAction()
	{
		//will change the templateparts by exclude the nav
		$this->_template->swapTemplate([
		   'nav'  => TEMPLATE_PATH . 'login_nav.php',
		   ':view' =>  ':action_view'
		]);
		$this->language->load('template.common');
		$this->language->load('authentication.login');
		
		if(isset($_POST['submit'])) {
			$isAuthorized = UserModel::authenticate($_POST['username'], $_POST['password'], $this->session);
			if($isAuthorized == 2) {
				$this->messenger->add($this->language->get('error_user_disabled') , Messenger::APP_MESSAGE_WARNING);
			} elseif($isAuthorized == 1) {
				$this->redirect('/');
			} elseif($isAuthorized === false) {
				$this->messenger->add($this->language->get('error_user_notfound') , Messenger::APP_MESSAGE_WARNING);
			}
		}
        
		$this->_view();
		
		
	}
	
	
	public function logoutAction()
	{
	   $this->session->kill();
	   $this->redirect('/authentication/login');
	}
	
}