<?php 
namespace PHPMVC\LIB;
use PHPMVC\LIB\Helper;

class FrontController 
{
	use Helper;
    
	const NOT_FOUND_ACTION = 'notFoundAction';
	const NOT_FOUND_CONTROLLER = 'PHPMVC\Controllers\\NotFoundController';
	
    //we use _ before the variable name to remember that is private
    // we set the variables for default values in case if the url doesn't have values
    private $_controller = 'index';
    private $_action = 'default';
    private $_params = array();
    
    private $_template;
    private $_registry;
	private $_authentication;
	
	// 2- add the language object to be parameter in the constructor of the frontcontroller and assign private variable for it , to save what we will get from the construct
	public function __construct(Template $template, Registry $registry , Authentication $auth)
	{
        $this->_template = $template;
        $this->_registry = $registry;
		$this->_authentication = $auth;
		$this->_parseUrl();
        
	}
	
	

    private function _parseUrl()
    {
        // first we transfered any link for index.php page , we did that at .htaccess file
        // then we take the url that the user wrote, and work on it
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        //use trim to remove the / at the start or at the end, so if the url just /, then be empty
        $url = trim($url, '/');
        // cut the url into array , where is the separator / for 3 parts 
		
        $url = explode('/',$url , 3);
        
        
        if(isset($url[0]) && $url[0] != '') {
            $this->_controller = $url[0];
        }
        
        if(isset($url[1]) && $url[1] != '') {
            $this->_action = $url[1];
        }
        
        if(isset($url[2]) && $url[2] != '') {
            $this->_params = explode('/', $url[2]);
        }
       
    }
    
    
    public function dispatch()
    {
		// we will get the controller name from _parseUrl function
		// then we search for it's class name 
		// we already created class for every controller in it's specific file
		//the name of the class will be like this for example IndexController
		// we use ucfirst() function to change the first letter to capital letter
		//then add the word Controller
		//we add first the namespace 
		// we add two \ after controllers to one escape one
		
      $controllerClassName = 'PHPMVC\Controllers\\' . ucfirst($this->_controller) . 'Controller';
	  
	  // create the action name
	  //the name of the action method will be like this for example defaultAction
	  
	  $actionName = $this->_action . 'Action';
	  
	  
	  //we will check if the user authorized or not
	  //if not we send him for autherization controller login action
	  if(!$this->_authentication->isAuthorized()) {
		 
		  /* $controllerClassName = 'PHPMVC\Controllers\AuthenticationController';
		   $actionName = 'loginAction';
		   $this->_controller = 'authentication';
		   $this->_action = 'login';*/
          
          //we will use this method instead now    
          //we check first if we are not already in login page if not so we will redirct him for login action
          if($this->_controller != 'authentication' && $this->_action != 'login') {
              
              $this->redirect('/authentication/login');
              
          } 
	  } else 
      //if the user authorized to login
      {
              //if the user opened the login page and he already loged in , we will redirect him home if the user wasn't refered from other pages
              //if he was refered from other pages as coming from /users for example we will return him for this page again
           if($this->_controller == 'authentication' && $this->_action == 'login') {
                isset($_SESSION['HTTP_REFERER']) ? $this->redirect($_SESSION['HTTP_REFERER']) : $this->redirect('/');
           }
		   
          //if the user authorized but not have permission for th page
          //CHECK_FOR_PRIVILEGES defined in the config file in case we don't want to chck privileges we set it zero
		    if(!$this->_authentication->hasAccess($this->_controller,$this->_action) && CHECK_FOR_PRIVILEGES == 1) {
			
               $this->_controller = 'accessdenied';
			   $this->_action =  'default';
			}
             
        }
        
        
        
	  
	  // we created class notfound to direct any unknown class name direct to it, so if the user wrote any random url , unknown for us , this take him for the notfound controller
	  // method_exists take two parameters , the object we looking inside name and the method name
     if(!class_exists($controllerClassName) || !method_exists($controllerClassName, $actionName)) {
            $controllerClassName = self::NOT_FOUND_CONTROLLER;
            $actionName = self::NOT_FOUND_ACTION;
			// i added this here to can set the _controler to notfound for abstractcontroller ,in case the controller name was right but the method not exists
			$this->_controller = 'notFound';
			$this->_action =  'notFound';
        }	 
	

	// we create new object of the controller class after we changed the controller into notfound if the method or the controller not found
	
	 $controller = new $controllerClassName;
	 
	 //send the information we got to the abstractcontroller class
	 $controller->setController($this->_controller);
	 $controller->setAction($this->_action);
	 $controller->setParams($this->_params);
     $controller->setTemplate($this->_template);
     //5- call the function that we created inside the abstract controller
     $controller->setRegistry($this->_registry);
	 
	 //we call the action name function which is inside the controller class
	 $controller->$actionName();
    }
        
        
	
    
    
}