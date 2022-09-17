<?php
namespace PHPMVC\Models;

class UsersPrivilegesModel extends AbstractModel
{
    public $id;
    public $privilege_url;
	public $privilege_title;
    
    protected static $tableName = 'app_users_privileges';
    
    protected static $tableSchema = array(
        'id'  => self::DATA_TYPE_INT,
        'privilege_url'  => self::DATA_TYPE_STR,
		'privilege_title'  => self::DATA_TYPE_STR
    );
    
    protected static $primaryKey = 'id';
    
        
    
}
