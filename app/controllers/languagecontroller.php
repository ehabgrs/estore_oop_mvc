<?php
namespace PHPMVC\Controllers;


class LanguageController extends AbstractController
{
	use \PHPMVC\LIB\Helper;
	
	public function defaultAction()
	{
		if($_SESSION['lang'] == 'ar') {
			$_SESSION['lang'] = 'en';
		} else {
			$_SESSION['lang'] = 'ar';
		}
		// WE USED this redirect function from helper
		// $_SERVER['HTTP REFERER'] give us the same link we used before got redirected, means here return for the same page
		$this->redirect($_SERVER['HTTP_REFERER']);
	}
}