<?php
    
    class UserBusiness {
       
        private $userDAO;
        private static $instance;
        
        public static function getInstance(){
            if(!isset(self::$instance))
                self::$instance = new UserBusiness();
            return self::$instance;
        }
       
        private function __construct(){
            $this->userDAO =  new UserDAO();
        }
        
        public function add($name = null ,$email=null, $username = null, 
                                    $password=null, $situation_id = null){
            $user_id = $this->userDAO->add($name, $email, $username , $password, $situation_id);
            return $user_id;
        }
        
        public function signin($email=null, $password = null){
            return ($email!=null && $password!=null)? $this->userDAO->signin($email, $password):0;
        }
        
        public  function isUser($email = null){
            return ($email!=null)? $this->userDAO->isUser($email):0;
        }
        
        public function getUserByEmail($email=null){
            return ($email!=null)? $this->userDAO->getUserByEmail($email):0;
        }
       
       
    }
?>


