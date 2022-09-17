<?php
namespace PHPMVC\Models;

class ProductsCategoriesModel extends AbstractModel
{
    public $id;
    public $name;
    public $image;
    
    
    protected static $tableName = 'app_products_categories';
    
    protected static $tableSchema = array(
        'id'                =>    self::DATA_TYPE_INT,
        'name'              =>    self::DATA_TYPE_STR,
        'image'             =>    self::DATA_TYPE_STR,
    );
    
    protected static $primaryKey = 'id';
}