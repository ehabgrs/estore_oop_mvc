<?php
namespace PHPMVC\LIB;

class Template   
{
    use TemplateHelper;
    
    private $_templateParts;
    
    //we set it for action view path
    private $_action_view;
    private $_data;
    private $_registry;
	
	
    
    public function __get($key)
    {
        return $this->_registry->$key;
    }
    
    // we will recive the template parts from the index when we make new template
	public function __construct(array $parts)
    {
        $this->_templateParts = $parts;
    }
    
    public function setActionViewFile($path)
    {
       $this->_action_view = $path; 
    }
    
    public function setAppData($data)
    {
        $this->_data = $data;	
	
    }
	
	// function to change the template parts when we need to exclude some parts for example in login 
	//$template is array to reset the template array inside the file templateconfig 
	//_templateParts is all the content of templateconfig file
	// will call this function inside the action function inside the controller
	public function swapTemplate($template) 
	{
		$this->_templateParts['template'] = $template;
		
	}
    
    public function setRegistry($registry)
    {
        $this->_registry = $registry;
    }
    
    private function renderTemplateHeaderStart()
    {
		extract($this->_data);
        require_once TEMPLATE_PATH . 'templateheadstart.php';
    }
    
    
     private function renderTemplateHeaderEnd()
    {
		extract($this->_data);
        require_once TEMPLATE_PATH . 'templateheadend.php';
    }
    
    
     private function renderTemplateFooter()
    {
		extract($this->_data);
        require_once TEMPLATE_PATH . 'templatefooter.php';
    }
    
    //will render the first part of the file templateconfig where we declare all the extra parts
    // so we will use $_templateParts array 
    
    private function renderTemplateBlooks()
    {
        if(!array_key_exists('template' , $this->_templateParts)) {
            trigger_error('Sorry you have to define the template blocks' , E_USER_WARNING);
        } else {
           extract ($this->_data);
            
            $parts = $this->_templateParts['template'];
            
            if(!empty($parts)) {
                
                foreach ($parts as $partkey => $filePath) {
                    
                    if($partkey== ':view') {
                        require_once $this->_action_view;
                    } else {
                        require_once $filePath;
                    }
                    
                }
            }
        }
    }
    
    
    private function renderHeaderResources() {
     
        $output =  '';
		if(!array_key_exists('header_resources' , $this->_templateParts)) {
			trigger_error('sorry you have to define the header resourses first'. E_USER_WARNING);
		} else {
			 extract ($this->_data);
			$resources = $this->_templateParts['header_resources'];
			$css = $resources['css'];
			if(!empty($css)) {
				foreach($css as $cssKey => $path) {
					$output .= '<link type="text/css" rel="stylesheet" href="'.$path. '" />'; 
				}
			}
			
			$js = $resources['js'];
			if(!empty($js)) {
				foreach($js as $jsKey => $path) {
                    
					$output .= '<script src="'.$path. '"></script>'; 
				}
			}
		}
          echo $output;		
    }
    
    private function renderFooterResources() {
        $output='';
		if(!array_key_exists('footer_resources' , $this->_templateParts)) {
			trigger_error('sorry you have to define the footer resourses first'. E_USER_WARNING);
		} else {
           
			extract ($this->_data);
			$resources = $this->_templateParts['footer_resources'];
			$js = $resources['js'];
			
			if(!empty($js)) {
				foreach($js as $jsKey => $path) {
					$output .= '<script src="'.$path. '"></script>'; 
				}
			}
		}
         echo $output;	
		
    }
    
    
    
    public function renderApp()
    {
		
        $this->renderTemplateHeaderStart();
         $this->renderHeaderResources();
        $this->renderTemplateHeaderEnd();
        $this->renderTemplateBlooks();
        $this->renderFooterResources();
        $this->renderTemplateFooter();
    }
    
    
}