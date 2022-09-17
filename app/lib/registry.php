<?php

namespace PHPMVC\LIB;

class Registry 
{
    private static $_instance;
    
    //we make the construct like this to prevent making a new object of this clas registry ouside
    // we will create getinstsnce function to use the same object every time we call this class not making new one
    private function __construct() {}
    //to prevent any one from cloning the class from outside
    private function __clone() {}
    
    public static function getInstance()
    {
        //if there is no new object created yet we create one
        //if we alraedy created one we use it again, without create new one
        if(self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    public function __set($key , $object)
    {
        $this->$key = $object;
    }
    
    //getter 
    public function __get($key)
    {
        return $this->$key;
    }
    
    
    
}
