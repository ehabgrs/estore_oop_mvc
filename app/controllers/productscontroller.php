<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\ProductsModel;
use PHPMVC\Models\ProductsCategoriesModel;
use PHPMVC\LIB\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Validate;
use PHPMVC\LIB\FileUpload;

class ProductsController extends AbstractController
{
    use Helper;
    use InputFilter;
	use Validate;
	
	//TODO unrequired values nned to be fixed to not give error as empty value not email for example
	private $_createActionRules = 
	[ 
        'category_id'       => 'req|int',
	    'name'              => 'req|alphanumspace|between(3,70)',
        'quantity'          => 'req|int',
        'purchase_price'    => 'req|num',
        'sell_price'        => 'req|num',
        'vat'               => 'num',
        //'barcode'           => ''
        //'gtn_code'          => ''
        
	];
	
    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->language->load('products.common');
        $this->language->load('products.default');
        
        $this->_data['products'] = ProductsModel::getAll();
        $this->_view();
    }
    
    
    public function createAction()
    {
        $this->language->load('template.common');
        $this->language->load('products.common');
        $this->language->load('products.create');
		$this->language->load('validate.errors');
        
        $uploadError = false ;
        
        $this->_data['categories'] = ProductsCategoriesModel::getAll();
        
        if(isset($_POST['submit']) && $this->isValid($this->_createActionRules, $_POST)) {
            
            $product = new ProductsModel();
            $product->name  = $this->filterString($_POST['name']);
            $product->category_id  = $this->filterInt($_POST['category_id']);
            $product->quantity  = $this->filterInt($_POST['quantity']);
            $product->purchase_price  = $this->filterFloat($_POST['purchase_price']);
            $product->sell_price  = $this->filterFloat($_POST['sell_price']);
            $product->vat  = $this->filterInt($_POST['vat']);
            $product->barcode  = $this->filterString($_POST['barcode']);
            $product->gtn_code  = $this->filterString($_POST['gtn_code']);
           
            //at general even if we didn't upload picture $_FILES['image'] will exists
			//but the name will be empty if we didn't upload file so will check the name
            if(!empty($_FILES['image']['name'])) {
                
				//i added the prefix parameter to can add for example p_ for the product pictures
                //or add any prefix for every the spcefic types of images
                
               $uploaded_file = new FileUpload($_FILES['image'] , 'p_');
            
                //if there is any errors got thrown in the upload function we will catch it
               try {
                  
                   $uploaded_file->upload();
                   $product->image = $uploaded_file->getFileName();
                   
               } catch (\Exception $e) {
                   $this->messenger->add( $e , APP_MESSAGE_WARNING);
                   $uploadError = true;
               }
                
            
            }
            
           //we put the first condition first because if uploadError is true $product_category->save() will not be called
           if($uploadError === false && $product->save()) {
                
                $this->messenger->add($this->language->get('message_create_success'));
                $this->redirect('/products');
                
            } else {
                
                 $this->messenger->add($this->language->get('message_create_fail') , APP_MESSAGE_WARNING);
                
            }
        }
        
        $this->_view();
    }
	
	
	  public function editAction()
    {
		$id = $this->filterInt($this->_params[0]);
          
        $product = ProductsModel::getByPK($id);
         
         if($product_category === false) {
             $this->redirect('/products');
         }
		 
        $this->language->load('template.common');
        $this->language->load('products.common');
        $this->language->load('products.create');
		$this->language->load('validate.errors');
        $this->_data['product'] = $product;
        
        $uploadError = false ;
        
        $this->_data['categories'] = ProductsCategoriesModel::getAll();
        
        if(isset($_POST['submit']) && $this->isValid($this->_createActionRules, $_POST)) {
            
            $product->name  = $this->filterString($_POST['name']);
            $product->category_id  = $this->filterInt($_POST['category_id']);
            $product->quantity  = $this->filterInt($_POST['quantity']);
            $product->purchase_price  = $this->filterFloat($_POST['purchase_price']);
            $product->sell_price  = $this->filterFloat($_POST['sell_price']);
            $product->vat  = $this->filterInt($_POST['vat']);
            $product->barcode  = $this->filterString($_POST['barcode']);
            $product->gtn_code  = $this->filterString($_POST['gtn_code']);
           
        
            if(!empty($_FILES['image']['name'])) {
                
                if($product->image !== '' && file_exists(IMAGES_UPLOAD_STORAGE . DS .$product->image) ) {
                    unlink(IMAGES_UPLOAD_STORAGE . DS . $product->image );
                }
          
               $uploaded_file = new FileUpload($_FILES['image'] , 'p_');
            
                //if there is any errors got thrown in the upload function we will catch it
               try {
                  
                   $uploaded_file->upload();
                   $product->image = $uploaded_file->getFileName();
                   
               } catch (\Exception $e) {
                   $this->messenger->add( $e , APP_MESSAGE_WARNING);
                   $uploadError = true;
               }
                
            
            }
            
           //we put the first condition first because if uploadError is true $product_category->save() will not be called
           if($uploadError === false && $product->save()) {
                
                $this->messenger->add($this->language->get('message_create_success'));
                $this->redirect('/products');
                
            } else {
                
                 $this->messenger->add($this->language->get('message_create_fail') , APP_MESSAGE_WARNING);
                
            }
        }
        
        $this->_view();
    }
    
    
     public function deleteAction()
    {
        $this->language->load('products.common');
         
        $id = $this->filterInt($this->_params[0]);
        $product= ProductsModel::getByPK($id);
         
         if($product_category === false) {
             $this->redirect('/products');
         }      
		
         
         if($product->delete()) {
			    if($product>image !== '' && file_exists(IMAGES_UPLOAD_STORAGE . DS . $product->image)) {
			  
				    unlink(IMAGES_UPLOAD_STORAGE . DS . $product->image);	
		        }
               $this->messenger->add($this->language->get('message_delete_success'));
               $this->redirect('/products');
         } else {
               $this->messenger->add($this->language->get('message_delete_fail') , APP_MESSAGE_WARNING);
         }
    
    }
    
    
}