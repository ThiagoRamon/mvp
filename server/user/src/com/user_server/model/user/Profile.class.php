<?php
	/**
	* 
	*/
	class Profile extends Entity
	{	
		
		protected $photo;
		protected $name;
		protected $email;
		protected $bio;
		protected $birthday;
		protected $type;
		
		function __construct($arguments = null)
		{
			# code...
			if($arguments!=null)
				$this->setByRequest($arguments);
		}

		function setType(Type $type){
			$this->type = $type;
		}

	}
?>