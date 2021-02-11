<?php
	/**
	* 
	*/
	class Entity 
	{
		private $id;
		private $insert_date;
		private $update_date;
		private $delete_date;
		
		function __construct($arguments=null)
		{
			# code...
		    if($arguments==null)return;
		    $this->setByRequest($arguments);
		}
		
		public function __get($key){
			return $this->$key;
		}

		public function __set($key, $value){
			if(property_exists($this, $key))
			 	$this->$key = $value;
		}

		public function setByRequest($request){
		    if($request==null)return;
			foreach ($request as $key => $value) 
				$this->__set($key, $value);
			
		}

		public function jsonSerialize()
	    {
	        return get_object_vars($this);
		}
	}
?>