<?php
namespace PHPMVC\Controllers;

class IndexController extends AbstractController
{
	public function defaultAction()
	{
        //$this->_registry->language
		$this->language->load('template.common');
        $this->language->load('employee.default');
		//we call _view function from AbstractController class
		$this->_view();
	}
}