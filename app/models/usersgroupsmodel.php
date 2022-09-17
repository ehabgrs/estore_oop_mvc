<?php
namespace PHPMVC\Models;

class UsersGroupsModel extends AbstractModel
{
    public $id;
    public $group_name;
   

    protected static $tableName = 'app_users_groups';

    protected static $tableSchema = array(
        'id'            => self::DATA_TYPE_INT,
        'group_name'          => self::DATA_TYPE_STR,
       
    );

    protected static $primaryKey = 'id';
}
