<?php
namespace PHPMVC\LIB;

class Authentication
{
	
	private static $_instance;
	private $_session;
	
	//the url s that will be availble for all the users
	private $_excludedRoutes = [
	     '/index/default',
		 '/authentication/logout',
		 '/users/profile',
		 '/users/changepassword',
		 '/users/settings',
		 '/language/default',
         '/accessdenied/default',
         '/notfound/notfound'
	];
	
	private function __construct($session) 
	{
		$this->_session = $session;
	}
	
	private function __clone()
	{
		
	}
	
	public static function getInstance($session)
	{
		if(self::$_instance === null) {
			self::$_instance = new self($session);
		}
		return self::$_instance;
		
	}
    
	
    //check if the user logged in or not
	public function isAuthorized()
	{
        return isset($this->_session->u) ? true : false;
	}
    
    
	//check if the user has access for this page or not
	public function hasAccess($controller , $action)
	{
		$url = strtolower(DS . $controller. DS .$action);
        if(in_array($url , $this->_excludedRoutes) || in_array($url , $this->_session->u->privileges)) {
			return true;
		}
	}
}