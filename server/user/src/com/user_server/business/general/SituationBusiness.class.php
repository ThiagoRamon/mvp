<?php
    
    class SituationBusiness {
        
        private $situationDAO;
        private static $instance;
        public static function getInstance(){
            if(!isset(self::$instance))
                self::$instance = new SituationBusiness();
                return self::$instance;
        }
        
        private function __construct(){
            $this->situationDAO = new SituationDAO();
        }
        
        public function getIdByCode($code=null){
            return ($code!=null) ? ($this->situationDAO->getIdByCode($code)) : 0;
        }
       
    }
?>


