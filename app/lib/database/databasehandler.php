<?php
namespace PHPMVC\Lib\Database;

abstract class DatabaseHandler
{
    const DATABASE_DRIVER_POD       = 1;
    const DATABASE_DRIVER_MYSQLI    = 2;

    private function __construct() {}

    abstract protected static function init();

    abstract protected static function getInstance();

    public static function factory()
    {
        $driver = DATABASE_CONN_DRIVER;
        if ($driver == self::DATABASE_DRIVER_POD) {
            return PDODatabaseHandler::getInstance();
        } elseif ($driver == self::DATABASE_DRIVER_MYSQLI) {
            return MySQLiDatabaseHandler::getInstance();
        }
    }
}

/*
// simple way we did that if we didn't createthe handler

// $dsn data source name
$dsn = 'mysql:host=sql102.epizy.com;dbname=epiz_31470951_employees';
$user = 'epiz_31470951';
$password = 'gXkX24nCn1no';


$conn = null;



try {
	$conn = new PDO($dsn, $user, $password, array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ));

	if ($conn) {
		//echo "Connected to the $db database successfully!";
	}
} catch (PDOException $e) {
	echo $e->getMessage();
}

        //simple example if there is no handler and we work manually

           public function create() 
        {
            global $conn;
            $sql = 'INSERT INTO employees SET name = :name, address = :address, age = :age, salary = :salary, tax = :tax';
            $stmt = $conn->prepare($sql);
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
		
*/
