<?php
namespace PHPMVC\Models;

class MyAbstractModel
{
    public static function getAll() 
    {
        global $conn;
        $sql = 'select * from employees';
        $stmt = $conn->query($sql);
        //there too many ways to fetch data
        //here we will fetch the data into our class that we created
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\PHPMVC\Models\EmployeeModel' ,array('name','age','address','tax','salary'));
        // we check if is the result is not array or empty we set it false 
        return $result = (is_array($result)&& !empty($result)) ? $result : false;
    }
    
     public function create() 
        {
            global $conn;
            $sql = 'INSERT INTO employees SET name = :name, address = :address, age = :age, salary = :salary, tax = :tax';
            $stmt = $conn->prepare($sql);
            /*foreach($params as $param ) {
            $stmt->bindParam($param[0],$param[1],$param[2]);
            }*/

            $stmt->bindParam(':name' , $this->name, \PDO::PARAM_STR);
            $stmt->bindParam(':address' , $this->address, \PDO::PARAM_STR);
            $stmt->bindParam(':age' , $this->age, \PDO::PARAM_INT);
            $stmt->bindParam(':salary' , $this->salary, \PDO::PARAM_STR);
            $stmt->bindParam(':tax' , $this->tax, \PDO::PARAM_STR);

            if($stmt->execute() === true)
            {
                return true;
            }

            return false;


        }
		
		
		
		public static function getEmployeeById($id) {
			
				global $conn;
				 $sql = 'SELECT * FROM employees WHERE id = :id';
				// $stmt will have our result ready to be fetched
				$stmt = $conn->prepare($sql);
				$stmt->execute(array(':id' => $id));
				
				// PDO::FETCH_CLASS for fetch  the data for specific class we choose
				// we add PDO::FETCH_PROPS_LATE to can use an object with a required values for it's __construct function 
				$employee = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\PHPMVC\Models\EmployeeModel' ,array('name','age','address','tax','salary'));
				
				//$user is now a new object for employee
				//because we here have a result for one row of data
				//we use array_shift to take the first result of the total result 
				$employee = array_shift($employee); 
				
				return $employee;					
		}
		
		
		 public function update() 
        {
            global $conn;
            $sql = 'update employees SET name = :name, address = :address, age = :age, salary = :salary, tax = :tax where id = :id';
            $stmt = $conn->prepare($sql);
            /*foreach($params as $param ) {
            $stmt->bindParam($param[0],$param[1],$param[2]);
            }*/
            
			$stmt->bindParam(':id' , $this->id, \PDO::PARAM_INT);
            $stmt->bindParam(':name' , $this->name, \PDO::PARAM_STR);
            $stmt->bindParam(':address' , $this->address, \PDO::PARAM_STR);
            $stmt->bindParam(':age' , $this->age, \PDO::PARAM_INT);
            $stmt->bindParam(':salary' , $this->salary, \PDO::PARAM_STR);
            $stmt->bindParam(':tax' , $this->tax, \PDO::PARAM_STR);

            if($stmt->execute() === true)
            {
                return true;
            }

            return false;


        }
		
		public function employeeDelete($id)
		{
			global $conn;
			$sql = 'Delete FROM employees WHERE id = :id';
            $stmt = $conn->prepare($sql);
            return $stmt->execute(array(':id' => $id));
			
		}
    
    
		
		
}

?>