<?php
namespace PHPMVC\LIB;

class SessionManager extends \SessionHandler
{

    private $sessionName = SESSION_NAME;
    private $sessionMaxLifetime = SESSION_LIFE_TIME;
    private $sessionSSL = false;
    // we asign it true to prevent the access of the session by java hackers
    private $sessionHTTPOnly = true;
    // the path where the session will be available to be used
    private $sessionPath = '/';
    private $sessionDomain = '.ehabsalib.rf.gd';
    private $sessionSavePath = SESSION_SAVE_PATH;
    
    //time of the session to live ex: 30 minute 
	// we will use it later to change the id of the session every this number of time as a securety	
    private $ttl = 30;
    
    
     //credentail to encrypt the session by openssl
    private $sessionCipherAlgo = 'AES-128-ECB';
    private $sessionCipherKey = 'WYCRYPT0K3Y@2016';

    public function __construct()
    {

        $this->sessionSSL = isset($_SERVER['HTTPS']) ? true : false;
        $this->sessionDomain = str_replace('www.', '', $_SERVER['SERVER_NAME']);

        // session use just cookies no url to prevent hacking
        ini_set('session.use_cookies', 1);
        ini_set('session.use_only_cookies', 1);
        // set 0 to prevent use the session id in the url
        ini_set('session.use_trans_sid', 0);
        // save at files not url
        ini_set('session.save_handler', 'files');

        session_name($this->sessionName);

        session_save_path($this->sessionSavePath);

        session_set_cookie_params(
            $this->sessionMaxLifetime, $this->sessionPath,
            $this->sessionDomain, $this->sessionSSL,
            $this->sessionHTTPOnly
        );

         //  we used this with mcrypt but now we use openssl encryption
        //session_set_save_handler($this, true);
    }

    public function __get($key) {
        if(isset($_SESSION[$key])) {
            $data = @unserialize($_SESSION[$key]);
            if($data === false) {
                return $_SESSION[$key];
            } else {
                return $data;
            }
        } else {
            trigger_error('No session key ' . $key . ' exists', E_USER_NOTICE);
        }
    }

    public function __set($key, $value) {
        if(is_object($value)) {
            $_SESSION[$key] = serialize($value);
        } else {
            $_SESSION[$key] = $value;
        }
    }

    public function __isset($key)
    {
        return isset($_SESSION[$key]) ? true : false;
    }

    public function __unset($key)
    {
        unset($_SESSION[$key]);
    }

   public function read($id)
    {
        //function read($id) is builtin in the handler_save and return the data of the session
        //we override it
        // we use parent::read($id) to return for us the data that is already encrypted
        //and we will decrypt it by openssl
        return openssl_decrypt(parent::read($id), $this->sessionCipherAlgo, $this->sessionCipherKey);
    }

    public function write($id, $data)
    {
    // we override the write($id, $data) to encrypt the data before give it for the function
        return parent::write($id, openssl_encrypt($data, $this->sessionCipherAlgo, $this->sessionCipherKey));
    }
    
    

    // function to start the session
    // first we will check that the session_id is empty so we be sure that there is no old session open already
    // we start to set the time of the start of the session
    // check the validity of the session by comparing the time of the start of the session with the time we set $ttl to after that change the id
		
    public function start()
    {
        if('' === session_id()) {
            if(session_start()) {
                $this->setSessionStartTime();
                $this->checkSessionValidity();
            }
        }
    }

    private function setSessionStartTime()
    {
        // isset to check if we have a key in the session called sessionStartTime or not
        // if not we create new one
        if(!isset($this->sessionStartTime)) {
            $this->sessionStartTime = time();
        }
        return true;
    }

    private function checkSessionValidity()
    {
        if((time() - $this->sessionStartTime) > ($this->ttl * 60)) {
            $this->renewSession();
            //to generate a new fingerprint for the user after change session_id() 
            $this->generateFingerPrint();
        }
        return true;
    }

    private function renewSession()
    {
        $this->sessionStartTime = time();
        // change the session id and move the same data for the new id, and return true
        return session_regenerate_id(true);
    }
    
    
      private function generateFingerPrint()
    {
        // $_SERVER['HTTP_USER_AGENT'] IS UNIQUE FOR THE USER DOESN'T CHANGE DURING THE SESSION
        $userAgentId = $_SERVER['HTTP_USER_AGENT'];
       // to create randam key of 16 character
       // we set cipherKey varable to this value
        $this->cipherKey = openssl_random_pseudo_bytes(16);
        $sessionId = session_id();
        $this->fingerPrint = md5($userAgentId . $this->cipherKey . $sessionId);
    }
    
    
       public function isValidFingerPrint()
    {
        // if there is no finger print assigned yet, we create one
        if(!isset($this->fingerPrint)) {
            $this->generateFingerPrint();
        }
         //check the current finger print at this moment for the user session
        // we compare it with the one already created when the session started to check if it is the same or not
        //this is a securety against hackers

        $fingerPrint = md5($_SERVER['HTTP_USER_AGENT'] . $this->cipherKey . session_id());

        if($fingerPrint === $this->fingerPrint) {
            return true;
        }

        return false;
    }
    
    

    public function kill()
    {
        session_unset();
     //setcookie use empty data, time in past
        setcookie(
            $this->sessionName, '', time() - 1000,
            $this->sessionPath, $this->sessionDomain,
            $this->sessionSSL, $this->sessionHTTPOnly
        );

        session_destroy();
		unset($this->sessionStartTime);
    }

  

 

    public function dumpSessionVariables()
    {
        var_dump($_SESSION);
    }

    public function gc($maxLifetime)
    {
        parent::gc($maxLifetime);
    }
}

/*
    to start the session with our handler
    $session = new AppSessionHandler();
	
	$session->start();
  
    */

// to avoid loss the session data with header better to close the session before use header
	//use relative link not absolute link 
	//use exit() after the header

	/*
    session_write_close();
	header('location: /index.php');
	exit();
    */