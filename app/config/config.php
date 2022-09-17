<?php

if(!defined('DS')) {
	define('DS' , DIRECTORY_SEPARATOR);
}


define( 'APP_PATH' , realpath(dirname(__FILE__ , 2)));
define('PUBLIC_PATH' , realpath(dirname(__FILE__,3)) . '/public');
define('SESSION_PATH', realpath(dirname(__FILE__,3)) . '/sessions');
define('VIEWS_PATH' , APP_PATH . DS . 'views' . DS);
define('TEMPLATE_PATH' , APP_PATH . DS . 'template' . DS);
define('LANGUAGES_PATH' , APP_PATH . DS . 'languages' . DS);
define('JS_PATH' , PUBLIC_PATH. DS . 'js' . DS);

//DATABASE credentials
defined('DATABASE_HOST_NAME') ? null : define('DATABASE_HOST_NAME' , '127.0.0.1');
defined('DATABASE_USER_NAME') ? null : define('DATABASE_USER_NAME' , 'root');
defined('DATABASE_PASSWORD') ? null : define('DATABASE_PASSWORD' , '');
defined('DATABASE_DB_NAME') ? null : define('DATABASE_DB_NAME' , 'estore');
defined('DATABASE_PORT_NUMBER') ? null : define('DATABASE_PORT_NUMBER' , '3306');
defined('DATABASE_CONN_DRIVER') ? null : define('DATABASE_CONN_DRIVER' , 1);


defined('APP_DEFAULT_LANGUAGE') ? null : define('APP_DEFAULT_LANGUAGE' , 'en');

//session configuartion
defined('SESSION_NAME') ? null : define('SESSION_NAME' , '_EHAB_SESSION');
//0 means destroy the session when close the browser
defined('SESSION_LIFE_TIME') ? null : define('SESSION_LIFE_TIME' , 0);
//where we will save the temporary files
defined('SESSION_SAVE_PATH') ? null : define('SESSION_SAVE_PATH' ,SESSION_PATH);
//blowfish type salt $2a$07$ here we put 22 characters $
//$2y$10$83Le7T.fgpuJb/h51fUGuu
defined('APP_SALT') ? null : define('APP_SALT' , '$2y$10$83Le7T.fgpuJb/h51fUGuu$');

//check for access privileges
defined('CHECK_FOR_PRIVILEGES') ? null : define('CHECK_FOR_PRIVILEGES' , 0 );


//file upload
defined('UPLOAD_STORAGE') ? null : define('UPLOAD_STORAGE', PUBLIC_PATH . DS . 'uploads') ;
defined('IMAGES_UPLOAD_STORAGE') ? null : define('IMAGES_UPLOAD_STORAGE', UPLOAD_STORAGE . DS . 'images') ;
defined('DOCUMENTS_UPLOAD_STORAGE') ? null : define('DOCUMENTS_UPLOAD_STORAGE',UPLOAD_STORAGE . DS . 'documents') ;
//ini_get('max_file_uploads') give me the maximum allowed size for file upload in my server
defined('MAX_FILE_SIZE_ALLOWED')  ? null : define('MAX_FILE_SIZE_ALLOWED', ini_get('upload_max_filesize'));