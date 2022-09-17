<?php
namespace PHPMVC\LIB;

class Messenger
    
{
    const APP_MESSAGE_SUCCESS = 'success';
    const APP_MESSAGE_DANGER = 'danger' ;
    const APP_MESSAGE_WARNING = 'warning' ;
    const APP_MESSAGE_INFO = 'info' ;
    
    private static $_instance;
    
    private $_session;
    
    private $_messages;
    
    private function __construct($session)
    {
        $this->_session = $session;
    }
    
    
    private function __clone() {}
    
    public static function getInstance(SessionManager $session)
    {
        if(self::$_instance === null) {
            self::$_instance = new self($session);
        }
        return self::$_instance;
    }
    
    
    public function add($message , $type = self::APP_MESSAGE_SUCCESS) {
        
        if(!$this->messagesExists()) {
            $this->_session->messages = [];
        }
        //when we used this way , gave us just one message the last message we sent
        // not added up the messages together
       // $this->_session->messages[] = [$message , $type];
        
        //so we got the old messages first
        $msgs = $this->_session->messages;
        //then we added the new message for the array
        $msgs[] = [$message , $type];
        //then we sent it for the session
        $this->_session->messages = $msgs;
    }
    
    private function messagesExists()
    {
        return isset($this->_session->messages);
    }
    
    
   public function getMessages()
    {
        if($this->messagesExists()){
            // we will take the messages and save it in our prvate messages variable
           $this->_messages = $this->_session->messages;
            //then unset the value from the session to not stay and be repeated and just appear one time when we return our private _messages
            unset($this->_session->messages);
            // we will return the value that we saved in our private _messages
            return $this->_messages;
        }
        return [];
        
    }
    
    
    
    
}