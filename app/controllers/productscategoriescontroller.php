<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\ProductsCategoriesModel;
use PHPMVC\LIB\Helper;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Validate;
use PHPMVC\LIB\FileUpload;

class ProductsCategoriesController extends AbstractController
{
    use Helper;
    use InputFilter;
	use Validate;
	
	//TODO unrequired values nned to be fixed to not give error as empty value not email for example
	private $_createActionRules = 
	[ 
	     'name'          => 'req|alphanumspace|between(3,30)'
	];
	
    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->language->load('productscategories.common');
        $this->language->load('productscategories.default');
        $this->_data['products_categories'] = ProductsCategoriesModel::getAll();
        $this->_view();
    }
    
    
    public function createAction()
    {
        $this->language->load('template.common');
        $this->language->load('productscategories.common');
        $this->language->load('productscategories.create');
		$this->language->load('validate.errors');
        
        $uploadError = false ;
        
        if(isset($_POST['submit']) && $this->isValid($this->_createActionRules, $_POST)) {
            $product_category = new ProductsCategoriesModel();
            $product_category->name  = $this->filterString($_POST['name']);
			
            //at general even if we didn't upload picture $_FILES['image'] will exists
			//but the name will be empty if we didn't upload file so will check the name
            if(!empty($_FILES['image']['name'])) {
				
               $uploaded_file = new FileUpload($_FILES['image']);
            
                //if there is any errors got thrown in the upload function we will catch it
               try {
                   
                   $uploaded_file->upload();
                   $product_category->image = $uploaded_file->getFileName();
                   
               } catch (\Exception $e) {
                   $this->messenger->add( $e , APP_MESSAGE_WARNING);
                   $uploadError = true;
               }
                
            
            }
           //we put the first condition first because if uploadError is true $product_category->save() will not be called
           if($uploadError === false && $product_category->save()) {
           
                $this->messenger->add($this->language->get('message_create_success'));
                $this->redirect('/productscategories');
                
            } else {
                
                 $this->messenger->add($this->language->get('message_create_fail') , APP_MESSAGE_WARNING);
                
            }
        }
        
        $this->_view();
    }
	
	
	  public function editAction()
    {
		$id = $this->filterInt($this->_params[0]);
          
        $product_category = ProductsCategoriesModel::getByPK($id);
         
         if($product_category === false) {
             $this->redirect('/productscategories');
         }
		 
        $this->language->load('template.common');
        $this->language->load('productscategories.common');
        $this->language->load('productscategories.edit');
		$this->language->load('validate.errors');
          
        $uploadError = false;
		
		$this->_data['product_category'] = $product_category;
		    
        if(isset($_POST['submit']) && $this->isValid($this->_createActionRules, $_POST)) {
            
            $product_category->name  = $this->filterString($_POST['name']);
			
            if(!empty($_FILES['image']['name'])) {
				//delete the old picture if exists first then add the new picture				
			    if($product_category->image !== '' && file_exists(IMAGES_UPLOAD_STORAGE . DS . $product_category->image)) {
					unlink(IMAGES_UPLOAD_STORAGE . DS . $product_category->image);	
				}
				
               $uploaded_file = new FileUpload($_FILES['image']);
                
               try {
                   
                   $uploaded_file->upload();
                   $product_category->image = $uploaded_file->getFileName();
                   
               } catch(\Exception $e) {
                   $this->messenger->add( $e , APP_MESSAGE_WARNING);
                   $uploadError = true; 
               }
                
             
               
            }
            
            if($uploadError === false && $product_category->save()) {
                
                $this->messenger->add($this->language->get('message_create_success'));
                $this->redirect('/productscategories');
                
            } else {
                
                 $this->messenger->add($this->language->get('message_create_fail') , APP_MESSAGE_WARNING);
                
            }
        }
        
        $this->_view();
    }
    
     public function deleteAction()
    {
        $this->language->load('productscategories.common');
         
        $id = $this->filterInt($this->_params[0]);
        $product_category = ProductsCategoriesModel::getByPK($id);
         
         if($product_category === false) {
             $this->redirect('/productscategories');
         }      
		
         
         if($product_category->delete()) {
			    if($product_category->image !== '' && file_exists(IMAGES_UPLOAD_STORAGE . DS . $product_category->image)) {
			  
				    unlink(IMAGES_UPLOAD_STORAGE . DS . $product_category->image);	
		        }
               $this->messenger->add($this->language->get('message_delete_success'));
               $this->redirect('/productscategories');
         } else {
               $this->messenger->add($this->language->get('message_delete_fail') , APP_MESSAGE_WARNING);
         }
    
    }
    
    
}