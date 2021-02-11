<?php
    class HttpResponse {
      
        public function __construct(){
                
        }
        
        public function setparameter($key = null, $value = null){
            $this->$key = $value;   
        }
        public function getparameter($key = null){
            if(!property_exists($this, $key))
                return null;
            return $this->$key;
        }
        public function hasError(){
            return property_exists($this, "error"); 
        }
        public  function jsonSerialize()
        {   
            
            return get_object_vars($this);
        }
    }
?>