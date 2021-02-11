<?php
    
    class ProfileBusiness {
       
        private $profileDAO;
        private static $instance;

        public static function getInstance(){
            if(!isset(self::$instance))
                self::$instance = new ProfileBusiness();
                return self::$instance;
        }
       
        private function __construct(){
            $this->profileDAO = new ProfileDAO();
        }
        
        public  function add($user_id=null,$name=null,$email=null, $type_id ){
            $profile_id = $this->profileDAO->add($user_id,$name,$email, $type_id);
            return $profile_id;
        }
       
        public static function isUser($email = null){
            return ($email!=null) ? $this->profileDAO->isUser($email) : 0;
        }
        
        public function getProfileByEmail($email=null){
            return ($email!=null) ? $this->profileDAO->getUserByEmail($email) : 0;
        }
       
    }
?>


