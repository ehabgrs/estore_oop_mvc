<?php
namespace PHPMVC\Models;

class ClientsModel extends AbstractModel
{
    public $id;
    public $name;
    public $phone_number;
    public $email;
    public $address;
    
    
    protected static $tableName = 'app_clients';
    
    protected static $tableSchema = array(
        'id'                =>    self::DATA_TYPE_INT,
        'name'              =>    self::DATA_TYPE_STR,
        'phone_number'      =>    self::DATA_TYPE_STR,
        'email'             =>    self::DATA_TYPE_STR,
        'address'           =>    self::DATA_TYPE_STR
    );
    
    protected static $primaryKey = 'id';
}