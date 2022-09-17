<?php
namespace PHPMVC\LIB;


class AutoLoad
{
	
	// function we will use to include the file of the class automatically when we use it
	
	public static function autoload($className)
	{
		
		//the path for the class name file will contain the namespace as app/PHPMVC\LIB so we will remove PHPMVC because it is not real path
		$className = str_replace('PHPMVC' , '' , $className);
		// we will replace \ to / we used '\\' to escape it
		$className = str_replace('\\' , '/' , $className);
		//convert it lower case letters
		$className = strtolower($className);
		$className = $className . '.php';
		
       //  we got now the path and name ready 
	   //and because we will put all the classes in app folder
	   // so we check first if the file exists and everything is ok
	   //then require_once automatically the file which contain the class we called by use the word new 
		if(file_exists(APP_PATH . $className)) {
			require_once APP_PATH . $className;
		}
	}
	
}

//we use this function to change the autoload to our own autoload so we can refer any new class to be uploaded throgh it, look for it`s file where it's class available

spl_autoload_register(__NAMESPACE__ . '\AutoLoad::autoload');