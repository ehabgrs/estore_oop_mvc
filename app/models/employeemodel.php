<?php
namespace PHPMVC\Models;


class EmployeeModel extends MyAbstractModel
{
	
		public $id;
		public $name;
		public $age;
		public $address;
		public $tax;
		public $salary;
    
   /* public $params= array(
        array(':name' , $name, \PDO::PARAM_STR),
        array(':address' , $address, \PDO::PARAM_STR),
        array(':age' , $age, \PDO::PARAM_INT),
        array(':salary' , $salary, \PDO::PARAM_STR),
        array(':tax' , $tax, \PDO::PARAM_STR)
      );*/
	
	
	public function __construct($name, $age, $address, $tax, $salary) {
		
		$this->name = $name;
		$this->age = $age;
		$this->address = $address;
		$this->tax = $tax;
		$this->salary = $salary;
	}
    
   
	

}