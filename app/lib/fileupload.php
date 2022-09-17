<?php
namespace PHPMVC\LIB;
use PHPMVC\LIB\InputFilter;

class FileUpload
{
    use InputFilter;
    
    // we will create variables to get the values we will have from $_FILES
    private $name;
    private $type;
    //THE NAME of the temporary path where the file saved temporary
    private $tmp_name;
    private $error; 
    private $size;
    
    private $fileExtension;
    
    private $allowedExtensions = ['jpg', 'jpeg' , 'png', 'gif' , 'pdf'];
    
    public function __construct($files, $prefix = '')
    {
        //encode the name before set it
        $this->name = $this->name( $this->filterString( $files['name'] ) , $prefix );
        $this->type = $files['type'];
        $this->tmp_name = $files['tmp_name'];
        $this->error = $files['error'];
        $this->size = $files['size'];
    }
    
    private function name($name , $prefix)
    {
        //capture the file extension of the file name
        preg_match('/([a-z]{1,4})$/i' , $name, $m);
        $this->fileExtension = $m[0];
      
        //encode the name and choose the first 30 character of the encoded name and make it the name
        //help us if the file name not good written name or arabic or has spaces
		//substr($value , int satart , int length) to cut the string
        $name = substr(strtolower(base64_encode($name . APP_SALT)), 0 , 22);
		//preg_replace(capturing pattern for what we want to replace , $1 resemble what we captured with the change we will do, the string we working with)
		$name = preg_replace('/(\w{11})/i' , '$1_' , $name);
		//i add the date at the end of the name
		$name = $prefix . $name . date('d_m_y');
		return  $name;	
    }
    
    
    private function isAllowedType()
    {
 
       return in_array(strtolower($this->fileExtension) , $this->allowedExtensions);
    }
    
    
    private function isSizeAccepted()
    { 
        // MAX_FILE_SIZE_ALLOWED we set in config to get the maximum allowed size in my server
        // we will preg match to capture the unit and the number
        preg_match('/(\d+)([MG])/i' , MAX_FILE_SIZE_ALLOWED , $m);
        $sizeNumberAllowed = $m[1];
        $sizeUnit = $m[2];
        
        //the size which comes from $_FILES is in bytes,so we will convert it regards to the allowed size unit in the server(m or g)
        $currentSize =($sizeUnit == 'M') ? ($this->size / 1024 / 1024) : ($this->size / 1024 /1024 / 1024);
        $currentSize = round($currentSize,2);
        
        return $currentSize < $sizeNumberAllowed ;  
    }
    
    private function isImage()
    {
        return preg_match('/image/i' , $this->type);
    }
    
    
    public function getFileName()
    {
        return $this->name . '.' . $this->fileExtension;
    }
    
    
    public function upload()
    {
     if($error != 0 ) {
         
            trigger_error('Sorry file did\'t upload successfully' , E_USER_WARNING);
         
     } elseif (!$this->isAllowedType()) {
         //throw the error and catch it in the controller
           throw new \Exception('sorry files of type '.$fileExtension. ' are not allowed');
         
     } elseif(!$this->isSizeAccepted()) {
         
            throw new \Exception('sorry the file size exceeds the allowed size');
         
     } else {
			 //check if uploaded file is image so we will set the storage folder to  image , else document 
			 $storageFolder = $this->isImage() ? IMAGES_UPLOAD_STORAGE : DOCUMENTS_UPLOAD_STORAGE ;
			 
			 // is_writable to check id the given path is valid to write and upload the file for it
			 if(is_writable($storageFolder)) {
				 
			     // move_uploaded_file take two parameter 1st the temporary path where it temporary saved
                 //2nd the complete new path with the name and the file extension
                if(move_uploaded_file($this->tmp_name , $storageFolder . DS . $this->getFileName()) ) {
                    return true;
                } 
			 
		    } else {
				 throw new \Exception('sorry the folder doesn\'t has a writting permession');
			}
            
         
     }
        
        
    }
    
    
}