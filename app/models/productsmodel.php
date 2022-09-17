<?php
namespace PHPMVC\Models;

class ProductsModel extends AbstractModel
{
    public $id;
    public $category_id;
    public $name;
    public $image;
    public $quantity;
    public $purchase_price;
    public $sell_price;
    public $vat;
    public $barcode;
    public $gtn_code;
    
    protected static $tableName = 'app_products';
    
    protected static $tableSchema = array(
        'id'                       =>    self::DATA_TYPE_INT,
        'category_id'              =>    self::DATA_TYPE_INT,
        'name'                     =>    self::DATA_TYPE_STR,
        'image'                    =>    self::DATA_TYPE_STR,
        'quantity'                 =>    self::DATA_TYPE_INT,
        'purchase_price'           =>    self::DATA_TYPE_DECIMAL,
        'sell_price'               =>    self::DATA_TYPE_DECIMAL,
        'vat'                      =>    self::DATA_TYPE_INT,
        'barcode'                  =>    self::DATA_TYPE_STR,
        'gtn_code'                 =>    self::DATA_TYPE_STR,
    );
    
    protected static $primaryKey = 'id';
    
    
    //override getall function to add the category name
    public static function getAll()
    {
        $sql = 'SELECT ap.* , apc.name category_name FROM '. self::$tableName . ' ap ';
        $sql .= 'INNER JOIN app_products_categories  apc ' ;
        $sql .= 'ON apc.id = ap.category_id';
        return self::get($sql);
    }
}