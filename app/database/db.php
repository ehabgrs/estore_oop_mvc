<?php
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

?>