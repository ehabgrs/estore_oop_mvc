<?php
namespace PHPMVC\LIB;

trait Validate
{ 
	private $_regexPatterns = [
	     'num'       =>     '/^[0-9]+(?:\.[0-9]+)?$/',
		 'int'       =>     '/^[0-9]+$/',
		 'float'     =>     '/^[0-9]+\.[0-9]+$/',
		 'alpha'     =>     '/^[a-zA-Z\p{Arabic} ]+$/u',
		 'alphanum'  =>     '/^[a-zA-Z\p{Arabic}0-9]+$/u',
		 'alphanumspace'  => '/^[a-zA-Z\p{Arabic}0-9 ]+$/u',
		 'vdate'     =>     '/^[1-2][0-9][0-9][0-9]-(?:(?:0[1-9])|(?:1[0-2]))-(?:(?:0[1-9])|(?:(?:1|2)[0-9])|(?:3[0-1]))$/',
		 'email'     =>     '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
		 'url'       =>     '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'
	];
	
	// to check the required not empty
	public function req($value) 
	{
	   return ($value == '' || empty($value)) ? false : true;
    }
	
	
	public function num($value) 
	{
		return (preg_match($this->_regexPatterns['num'] , $value)) ? true : false;
	}
	
	
	public function int($value) 
	{
		return (bool) preg_match($this->_regexPatterns['int'] , $value);
	}
	
	
	public function float($value) 
	{
		return (bool) preg_match($this->_regexPatterns['float'] , $value);
	}
	
	
	 public function floatlike($value, $beforeDP, $afterDP)
    {
        if(!$this->float($value))
        {
            return false;
        }
        $pattern = '/^[0-9]{' . $beforeDP . '}\.[0-9]{' . $afterDP . '}$/';
        return (bool) preg_match($pattern, $value);
    }
	
	
	public function alpha($value) 
	{
		return (bool) preg_match($this->_regexPatterns['alpha'] , $value);
	}
	
	
	public function alphanum($value) 
	{
		return (bool) preg_match($this->_regexPatterns['alphanum'] , $value);
	}
	
	public function alphanumspace($value) 
	{
		return (bool) preg_match($this->_regexPatterns['alphanumspace'] , $value);
	}
	
	
	public function vdate($value) 
	{
		return (bool) preg_match($this->_regexPatterns['vdate'] , $value);
	}
	
	
	public function email($value) 
	{
		return (bool) preg_match($this->_regexPatterns['email'] , $value);
	}
	
	
	public function url($value) 
	{
		return (bool) preg_match($this->_regexPatterns['url'] , $value);
	}
	
	/*
	public function lt($value, $matchAgainst) 
	{
		//I checked to be number first before check string , in case was number but written as string for example '12'
		//cascate for double to not be string anymore
		if(is_numeric($value)) {
			$value = (double) $value;
			return $value < $matchAgainst;
		}
		
		if(is_string($value)){
			//we used mb_strlen instead of strlen for the arabic language can be calcualted right 
			//be sure that everything is utf8
			return mb_strlen($value) < $matchAgainst;
		}
		
	}
	*/
	
	public function lt($value, $matchAgainst) 
	{
		if(is_string($value)){
			//we used mb_strlen instead of strlen for the arabic language can be calcualted right 
			//be sure that everything is utf8
			return mb_strlen($value) < $matchAgainst;
		}
		
		if(is_numeric($value)) {
			return $value < $matchAgainst;
		}
	}
	
	public function gt($value, $matchAgainst) 
	{
		if(is_string($value)){
			//we used mb_strlen instead of strlen for the arabic language can be calcualted right 
			//be sure that everything is utf8
			return mb_strlen($value) > $matchAgainst;
		}
	
		if(is_numeric($value)) {
			return $value > $matchAgainst;
		}	
	}
	
	
	public function min($value, $min) 
	{
		if(is_string($value)) {
			return mb_strlen($value) >= $min;
		}
		if(is_numeric($value)) {
			return $value >= $min;
		}
		
		
	}
	
	
	public function max($value, $max) 
	{
		if(is_string($value)) {
			return mb_strlen($value) <= $max;
		}
		
		if(is_numeric($value)) {
			return $value <= $max;
		}
	}
	
	
	public function between($value, $min, $max)
	{
		if(is_string($value)) {
			return mb_strlen($value) >= $min && mb_strlen($value) <= $max;
		}
		
		
		if(is_numeric($value)) {
			return $value >= $min && $value <= $max;
		}
		
	}
	
	 public function eq($value, $matchAgainst)
    {
        return $value == $matchAgainst;
    }

    public function eq_field($value, $otherFieldValue)
    {
        return $value == $otherFieldValue;
    }
	
	
	public function isValid($roles , $inputType)
	//for example inputType = $_POST
	{
		$errors = [];
		if(!empty($roles)) {
			
			foreach($roles as $item  => $role) {
				
				$value = $inputType[$item];
				
				$validationRoles = explode('|' , $role);
                
				foreach($validationRoles as $validationRole) {
					
					//we will get the number of the role min for example min(3) we will get the 3
                    //will match with the roles who accept one value
					if (preg_match_all('/(min||max||lt||gt)\((\d+)\)/', $validationRole, $m)) {
						//var_dump($m);
                        $roleName = $m[1][0];
						$numberOfCondition = $m[2][0];
						
							
                        if($this->$roleName($value,$numberOfCondition) === false) {

                             $this->messenger->add(
                              $this->language->feedKey( 'error_'. $roleName , [$this->language->get('text_'. $item)  , $numberOfCondition ] )
                             , Messenger::APP_MESSAGE_WARNING);
                            
                            $errors[$fieldName] = true;
                        }
                        
                        
						  //will match with the roles who accept two values
					} elseif (preg_match_all('/(between||floatLike)\((\d+),(\d+)\)/', $validationRole, $m)) {
                        $roleName = $m[1][0];
						$numberOfCondition = $m[2][0];
                        $numberOfCondition2 = $m[3][0];
						
			
							
							if($this->$roleName($value,$numberOfCondition, $numberOfCondition2) === false) {
								
							     $this->messenger->add(
								  $this->language->feedKey( 'error_'. $roleName , [$this->language->get('text_'. $item)  , $numberOfCondition , $numberOfCondition2 ] )
								 , Messenger::APP_MESSAGE_WARNING);
                                $errors[$fieldName] = true;
							}
					  } elseif (preg_match_all('/(eq_field)\((\w+)\)/', $validationRole, $m)) {
                        $roleName = $m[1][0];
						$matchedAgaist = $m[2][0];
						$matchedAgaistValue = $inputType[$m[2][0]];
						
							
                        if($this->$roleName($value,$matchedAgaistValue) === false) {

                             $this->messenger->add(
                              $this->language->feedKey( 'error_'. $roleName , [$this->language->get('text_'. $item)  , $this->language->get('text_'. $matchedAgaist)] )
                             , Messenger::APP_MESSAGE_WARNING);
                            $errors[$fieldName] = true;
                        }
					} else {
                         //will match with the roles which accept no other values
                        if($this->$validationRole($value) === false) {
                            
                             $this->messenger->add(
								  $this->language->feedKey( 'error_'. $validationRole , [$this->language->get('text_'. $item)] )
								 , Messenger::APP_MESSAGE_WARNING);
                            $errors[$fieldName] = true;
                            
                        }
                    }
                    
          	
				}
			}
		}
        
		// if there is no errors so the role is valid else is false not valid
		return empty($errors) ? true : false;
		
	}
	


	
	
	
	
}



/*

    public function eq($value, $matchAgainst)
    {
        return $value == $matchAgainst;
    }

    public function eq_field($value, $otherFieldValue)
    {
        return $value == $otherFieldValue;
    }

   

    public function isValid($roles, $inputType)
    //for example inputType = $_POST
    {
        $errors = [];
        if(!empty($roles)) {
            foreach ($roles as $fieldName => $validationRoles) {
                $value = $inputType[$fieldName];
                $validationRoles = explode('|', $validationRoles);
                foreach ($validationRoles as $validationRole) {
                    if(array_key_exists($fieldName, $errors))
                        continue;
                    if(preg_match_all('/(min)\((\d+)\)/', $validationRole, $m)) {
                        if($this->min($value, $m[2][0]) === false) {
                            $this->messenger->add(
                                $this->language->feedKey('text_error_'.$m[1][0], [$this->language->get('text_label_'.$fieldName), $m[2][0]]),
                                Messenger::APP_MESSAGE_ERROR
                            );
                            $errors[$fieldName] = true;
                        }
                    } elseif (preg_match_all('/(max)\((\d+)\)/', $validationRole, $m)) {
                        if($this->max($value, $m[2][0]) === false) {
                            $this->messenger->add(
                                $this->language->feedKey('text_error_'.$m[1][0], [$this->language->get('text_label_'.$fieldName), $m[2][0]]),
                                Messenger::APP_MESSAGE_ERROR
                            );
                            $errors[$fieldName] = true;
                        }
                    } elseif(preg_match_all('/(lt)\((\d+)\)/', $validationRole, $m)) {
                        if($this->lt($value, $m[2][0]) === false) {
                            $this->messenger->add(
                                $this->language->feedKey('text_error_'.$m[1][0], [$this->language->get('text_label_'.$fieldName), $m[2][0]]),
                                Messenger::APP_MESSAGE_ERROR
                            );
                            $errors[$fieldName] = true;
                        }
                    } elseif(preg_match_all('/(gt)\((\d+)\)/', $validationRole, $m)) {
                        if($this->gt($value, $m[2][0]) === false) {
                            $this->messenger->add(
                                $this->language->feedKey('text_error_'.$m[1][0], [$this->language->get('text_label_'.$fieldName), $m[2][0]]),
                                Messenger::APP_MESSAGE_ERROR
                            );
                            $errors[$fieldName] = true;
                        }
                    } elseif(preg_match_all('/(between)\((\d+),(\d+)\)/', $validationRole, $m)) {
                        if($this->between($value, $m[2][0], $m[3][0]) === false) {
                            $this->messenger->add(
                                $this->language->feedKey('text_error_'.$m[1][0], [$this->language->get('text_label_'.$fieldName), $m[2][0], $m[3][0]]),
                                Messenger::APP_MESSAGE_ERROR
                            );
                            $errors[$fieldName] = true;
                        }
                    } elseif(preg_match_all('/(floatlike)\((\d+),(\d+)\)/', $validationRole, $m)) {
                        if($this->floatlike($value, $m[2][0], $m[3][0]) === false) {
                            $this->messenger->add(
                                $this->language->feedKey('text_error_'.$m[1][0], [$this->language->get('text_label_'.$fieldName), $m[2][0], $m[3][0]]),
                                Messenger::APP_MESSAGE_ERROR
                            );
                            $errors[$fieldName] = true;
                        }
                    } elseif(preg_match_all('/(eq)\((\w+)\)/', $validationRole, $m)) {
                        if($this->eq($value, $m[2][0]) === false) {
                            $this->messenger->add(
                                $this->language->feedKey('text_error_'.$m[1][0], [$this->language->get('text_label_'.$fieldName), $m[2][0]]),
                                Messenger::APP_MESSAGE_ERROR
                            );
                            $errors[$fieldName] = true;
                        }
                    } elseif(preg_match_all('/(eq_field)\((\w+)\)/', $validationRole, $m)) {
                        $otherFieldValue = $inputType[$m[2][0]];
                        if($this->eq_field($value, $otherFieldValue) === false) {
                            $this->messenger->add(
                                $this->language->feedKey('text_error_'.$m[1][0], [$this->language->get('text_label_'.$fieldName), $this->language->get('text_label_'.$m[2][0])]),
                                Messenger::APP_MESSAGE_ERROR
                            );
                            $errors[$fieldName] = true;
                        }
                    } else {
                        if($this->$validationRole($value) === false) {
                            $this->messenger->add(
                                $this->language->feedKey('text_error_'.$validationRole, [$this->language->get('text_label_'.$fieldName)]),
                                Messenger::APP_MESSAGE_ERROR
                            );
                            $errors[$fieldName] = true;
                        }
                    }
                }
            }
        }
        return empty($errors) ? true : false;
    }

}
*/