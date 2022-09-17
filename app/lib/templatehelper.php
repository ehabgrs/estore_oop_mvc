<?php
namespace PHPMVC\LIB;

trait TemplateHelper
{
    
    //functions here can be called inside the view files
    
    public function urlMatch($url) {
        //get our url now and compare it with the given url
        //we will use this function to put selected value in it's html of the selected item in navbar
       
        return parse_url($_SERVER['REQUEST_URI'] , PHP_URL_PATH) == $url;
        
    }
    
     public function showValue($fieldName , $object = null)
    {
        return isset($_POST[$fieldName]) ? $_POST[$fieldName] : ( is_null($object) ? '' : $object->$fieldName );
    }
    
    public function labelDisplay($fieldName, $object = null) 
    {
        return (isset($_POST[$fieldName]) && !empty($_POST[$fieldName])) || ($object !== null && $object->$fieldName !== null ) ? "d-block" : "d-none";
    }
    
    public function hasAcccessToLink($url)
    {
     return  in_array($url, $this->session->u->privileges) ? 'd-block' : (CHECK_FOR_PRIVILEGES == 1 ? 'd-none' : 'd-block');
    }
    
    
    
}