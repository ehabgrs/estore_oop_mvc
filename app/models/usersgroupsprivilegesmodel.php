<?php
namespace PHPMVC\Models;
use \PHPMVC\Lib\Database\DatabaseHandler;

class UsersGroupsPrivilegesModel extends AbstractModel
{
	public $id;
	public $group_id;
	public $privilege_id;
	
	protected static $tableName = 'app_users_groups_privileges';
	
	protected static $tableSchema = array(
	
	'group_id'      => self::DATA_TYPE_INT,
	'privilege_id'  =>  self::DATA_TYPE_INT
	
	);
	
	protected static $primaryKey = 'id';
    
    
    public static function getGroupPrivileges($group_id)
    {
       $sql = " select privilege_title from app_users_privileges where id IN (
       select privilege_id from app_users_groups_privileges where group_id = :group_id
       )";
        
        $stmt = DatabaseHandler::factory()->prepare($sql);
        $stmt->execute(array(':group_id' => $group_id));
        $results = $stmt->fetchAll(\PDO::FETCH_COLUMN, 0);
        $results_string = '';
        for($i = 0 ; $i < count($results) ; $i++) {
           $results_string .= $results[$i].' | ';
        }
        return trim($results_string , "| ");
    }
	
	
	public static function getPrivilegesByGroup($groupId)
	{
		// when we put the abbreviation for table name app_users_groups_privileges augp, means we defining it as augp
		$sql = 'SELECT augp.*, aup.privilege_url FROM '. self::$tableName . ' augp ';
		$sql .= 'INNER JOIN app_users_privileges aup ON aup.id = augp.privilege_id ';
		$sql .= 'WHERE augp.group_id = "' .$groupId. '"';
		$privileges =  self::get($sql);
		$extractedUrl = [];
		foreach($privileges as $privilege) {
			$extractedUrl[] = $privilege->privilege_url;
		}
		
		return $extractedUrl;
	}
	
		
}