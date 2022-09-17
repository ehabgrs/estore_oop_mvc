<?php
// when we use return like this , when we require once the file will give us the value of the return
return [
     
	 'template' => [
	       'nav'  => TEMPLATE_PATH . 'nav.php',
		   // view will be declared later
		   ':view' =>  ':action_view'
	 ],
	 // the css and js in header
	 'header_resources' => [
	 
	       'css' => [
	        // for example if we have our css files on our server we can include it in this way
			//we can define css file path as a constant
	        //'bootstrap'   => CSS . 'bootstrap.css'
			],
			'js' => [
			  //'jquery'  => JS . 'jquery.js'
			]
	 
	 ],
	 
	 'footer_resources' => [
         
         'js' =>[
	     
               'main'  => JS_PATH . 'main.js' 
             
             ]
	 
	 ] 
	 
];