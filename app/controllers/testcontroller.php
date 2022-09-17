<?php

namespace PHPMVC\Controllers;
use \PHPMVC\LIB\Validate;

class TestController  extends AbstractController
{
	use Validate;
	
	public function defaultAction() {
		
		var_dump($this->between('1000' ,2,999 ));
	}
	
}