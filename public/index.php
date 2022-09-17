<?php
namespace PHPMVC;
use PHPMVC\LIB\FrontController;
use PHPMVC\LIB\Registry;
use PHPMVC\LIB\Messenger;
use PHPMVC\LIB\Authentication;



if(!defined('DS')) {
    define('DS' , DIRECTORY_SEPARATOR);
}

require_once '../app/config/config.php';
require_once APP_PATH. DS .'lib/autoload.php';
//require_once APP_PATH . DS . 'database' . DS . 'db.php';


$session = new LIB\SessionManager();	
$session->start();
//$session->kill();

if(!isset($session->lang)) {
	$session->lang = APP_DEFAULT_LANGUAGE;
}


// because this file contain just return so the require once will give me it's return
$template_parts = require_once APP_PATH . DS . 'config' . DS . 'templateconfig.php';



// we will define new template outside then will inject it into the frontcontroller
$template = new LIB\Template($template_parts);

//first step define new object of the language
$language = new LIB\Language();





/* we moved this part inside the FrontController() class as a function
// first we transfered any link for index.php page , we did that at .htaccess file
// then we take the url that the user wrote, and work on it
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// trim($url,'/') to remove the / at the start and end
//explode to divide it for 3 parts inside the list
list($controller,$action,$params) = explode('/',trim($url,'/'),3);
//$ params will be the part of the link which contain parts for example ?id=20&action=edit
$params = explode('/',$params);

*/



//make a new instance of registry one time
$registry = Registry::getInstance();
// we use the setter to define key session inside the registry , have the value of the object
$registry->session = $session;
$registry->language = $language;


$messenger = Messenger::getInstance($session);
$registry->messenger = $messenger;

// create instance from authentication to check if the user is authorized or not
//send the session for authentication class as the session will have the user information
$authentication = Authentication::getInstance($session);


// we inject the $template by adding it in the construct of frontcontroller class
//2- inject the new language object into the frontcontroller after we add it in it's constructer function
//$frontController = new FrontController($template,$language);

// instead we will inject registry that have the values of the language and session now
// we will set the rgistry inside the frontcontrllore then abstract controller then inside the template
$frontController = new FrontController($template,$registry,$authentication);
$frontController->dispatch(); 

