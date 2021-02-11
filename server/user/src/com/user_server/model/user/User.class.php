<?php
	/**
	* 
	*/
	class User extends Entity
	{
	  
		protected $email;
		protected $name;
		protected $username;
		protected $password;
		protected $profile;
		protected $situation;
		protected $token;

		
		public function setProfile(Profile $profile){
			$this->profile = $profile;
		}

		public function createUsername($arg=null){
			if($arg == null){
				return;
			}
			$pattern        = "/(.*)@/";
			preg_match($pattern, $arg,$match);
            $this->username = $match[1];
		}

	}
?>