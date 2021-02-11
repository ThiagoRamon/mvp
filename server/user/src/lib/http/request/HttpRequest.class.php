<?php
 
class HttpRequest 
{
    private static $instance;
    public static function getInstance(){
        if(!isset(self::$instance))
            self::$instance = new HttpRequest();
            return self::$instance;
    }
    
    public function getRequest($key = null){
        if($key==null || !isset($_REQUEST[$key]))return;
         return ($_REQUEST[$key]);   
    }
    public function getPostParam($key = null){
        if($key==null || !isset($_POST[$key]))return;
        return ($_REQUEST[$key]);
    }
    public function getparameter($key = null){
        
        if($key==null && isset($_GET))
            return $_GET;
        
        if(!isset($_GET[$key]))return;
        return ($_GET[$key]);
    }
    public function getparameters(){
        return $_REQUEST;
    }
    
    
	/*private $request;
	private $get;
	private $post;
	private $put;
	private $delete;
	
	public function __construct($args = null){
		//print_r( explode("/", substr(@$_SERVER['PATH_INFO'], 1)));
		//print_r($_SERVER['REQUEST_METHOD']);
		//$this->__set($_SERVER['REQUEST_METHOD']);
		$this->post   = $this->isPost()   ? $_POST    : null;
		$this->get    = $this->isGet()    ? $_GET     : null;
		//$this->put    = $this->isPut()    ? $_PUT     : null;
		//$this->delete = $this->isDelete() ? $_DELETE  : null;
	}


	public function __get($key = null){
		if(property_exists($this, $key))
			return $this->$key;
	}	

	public function valueOf($key = null){
		if(property_exists($this, $key))
			return $this->$key;
	}

	public function __set($key, $value){
		if(property_exists($this, $key))
			$this->$key = $value;
	}


	public function isPost(){
		if(!$_SERVER['REQUEST_METHOD'] == "post")
			return false;
		return true;
	}
	public function isGet(){
		if(!$_SERVER['REQUEST_METHOD'] == "get")
			return false;
		return true;
	}
	public function isPUT(){
		if(!$_SERVER['REQUEST_METHOD'] == "put")
			return false;
		return true;
	}
	public function isDelete(){
		if(!$_SERVER['REQUEST_METHOD'] == "delete")
			return false;
		return true;
	}*/
}

?>