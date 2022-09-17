<?php
namespace PHPMVC\LIB;

class Language 
{
	private $_dictionary = [];
	
	public function load($path)
    {
        $definedLanguage = APP_DEFAULT_LANGUAGE;
		if(isset($_SESSION['lang']))  {
			$definedLanguage = $_SESSION['lang'];
		}
        $pathArray = explode('.' , $path);
        $languageFilePath = LANGUAGES_PATH . $definedLanguage . DS . $pathArray[0] . DS . $pathArray[1] . '.lang.php';
                 
        if(file_exists($languageFilePath)){
            
            require $languageFilePath;
		
            if(is_array($_) && !empty($_)) {
				foreach($_ as $key => $value) {
					$this->_dictionary[$key] = $value;
				}
                
            }
        } else {
			trigger_error('sorry the langauge file not exists', E_USER_WARNING);
		}		
    }
    
    
    
    public function get($key) 
    {
        //check first if this key value is already defined inside the array dictionary[]
        if(array_key_exists($key, $this->_dictionary)) {
            return $this->_dictionary[$key];
        }
    }
    
    
    // function to feed the defined sentences inside the language files with extra words
    //example $_['error'] = "%s is not availble" , then we want to change this %s by something else
    // so we will feed this sentence with the key that we want
    //$str = "my name is %s"; sprintf($str , 'ehab'); result : my name is ehab
   
    public function feedKey($key , $data)
        //$key is the key for the sentence which has %s in the dictionary
        //data is the data we want to insert instead of %s
        // data will be array in case we need to exchange more than %s in the same sentence
    {
        if(array_key_exists($key, $this->_dictionary)) {
            
            //The array_unshift() function inserts new elements to an array. The new array values will be inserted in the beginning of the array
            array_unshift($data, $this->_dictionary[$key]);
            //$data array here will strat with the value of the sensence _dictionary[$key]
            //$data = [_dictionary[$key, value1 we wnat to insert , value2 we want to insert]
            
            //call_user_func_array(callable $callback, array $args);
            //The callable to be called.
            //The parameters to be passed to the callback, as an indexed array.
            return call_user_func_array('sprintf' , $data);
            
        }
        
    }
	
	
	public function getDictionary()
	{
		return $this->_dictionary;
	}
    
    
    
}