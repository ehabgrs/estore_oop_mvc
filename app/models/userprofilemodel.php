<?php
namespace PHPMVC\Models;

class UserProfileModel extends AbstractModel
{
    public $id;
    public $first_name;
    public $last_name;
    public $address;
    public $dob;
    public $image;
    
    protected static $tableName = 'app_users_profiles';
    
    protected static $tableSchema = array(
        'id'                    => self::DATA_TYPE_INT,
        'first_name'            => self::DATA_TYPE_STR,
        'last_name'             => self::DATA_TYPE_STR,
        'address'               => self::DATA_TYPE_STR,
        'dob'                   => self::DATA_TYPE_DATE,
        'image'                 => self::DATA_TYPE_STR,
        
    );
    
    protected static $primaryKey = 'id';
}