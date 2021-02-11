<?php
    
    class TypeBusiness {
        
        private $typeDAO;
        private static $instance;
       
        public static function getInstance(){
            if(!isset(self::$instance))
                self::$instance = new TypeBusiness();
                return self::$instance;
        }
       
        private function __construct(){
            $this->typeDAO = new TypeDAO();
        }
        
        public function getTypeIdByCode($code=null){
            return ($code!=null) ? $this->typeDAO->getIdByCode($code) : 0;
        }
       
    }
?>


