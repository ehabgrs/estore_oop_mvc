<?php
namespace PHPMVC\LIB;

trait Helper
{
    public function redirect($path)
    {
        session_write_close();
        header('location: '. $path);
        exit;
    }
    
   
}