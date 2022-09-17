<?php
namespace PHPMVC\Controllers;

class AbstractController 
{
	protected $_controller;
	protected $_action;
	protected $_params;
    protected $_template;
    protected $_registry;
    
    // we wil use this array to store the data coming from the models and then wil use it in our views
    // we will add the data with key for the data and then call this data from the array using this key
    protected $_data = [];
	
	public function notFoundAction()
	{
		echo $this->_view();
		
	}
	
	public function setController($controllerName)
	{
		$this->_controller = $controllerName;
	}
	
	public function setAction($actionName)
	{
		$this->_action = $actionName;
	}
	
	public function setParams($params) 
	{
		$this->_params = $params;
	}
    
    public function setTemplate($template)
    {
        $this->_template = $template;
       
    }
    
    /*
    //4- create this function that we will call from the frontcontroller to take the value of the language to be availble for the controller
     public function setLanguage($language)
    {
        $this->_language = $language;
       
    }
    we added the language inside the registry so we now set the registry and call the language through it
    */
    
    public function setRegistry($registry)
    {
        $this->_registry = $registry;
       
    }
    
    // we create this getter to can get the objects from registry direct as $this->language for example , not $this->registry->language
    public function __get($key) {
        return $this->_registry->$key;
    }
	
	
	// we create folder in views for every controllers
	//then we add view file for every action
	protected function _view()
	{
		$view = VIEWS_PATH . $this->_controller . DS . $this->_action . '.view.php';
		
		if($this->_action == \PHPMVC\LIB\FrontController::NOT_FOUND_ACTION || !file_exists($view)) {
			//if the action not found inside the controller 
			//or if the action availble inside the controller but we didn't create a view file for it yet
			//then we set it for notfound view file 404
			$view = VIEWS_PATH . 'notfound' . DS . 'notfound.view.php';
			
		} 
				//we merge the dictionary data with our data together
				// so the data will have the employees key and one for the other in dictionary
				$this->_data = array_merge($this->_data , $this->language->getDictionary());
				
                //to extract the data we added inside the array _data
                //then we call this data easily using just the key name  
               // extract($this->_data);
                
                //set the registry inside the template so it will be available inside the view
                $this->_template->setRegistry($this->_registry);
        
                // we used the function setTemplate() in dispatch in frontcontroller
                // so we already have the new template object that we injected
                //so we will use the function inside the template class
                //set the view path inside the template 
                $this->_template->setActionViewFile($view);
				
			
                // set all our data inside the template
                $this->_template->setAppData($this->_data);
               
				//require_once $view;
                //we will call render function inside the template organise and call all the parts of the view
                $this->_template->renderApp();
			
	}
	
	
}
