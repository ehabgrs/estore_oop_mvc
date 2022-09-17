<?php
namespace PHPMVC\Controllers;

class AccessDenied extends AbstractController
{
    public function default()
    {
        $this->language->load('template.common');
        
        $this->_view();
    }
}