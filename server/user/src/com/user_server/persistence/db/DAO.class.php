<?php
	/**
	* 
	*/
	class DAO
	{
		protected  $response = "to aqui";
		protected  $connection;
		protected  $resultSet;
		protected  $table;
		protected  $query;
		protected  $return_type=[MYSQLI_BOTH, MYSQLI_ASSOC,MYSQLI_NUM];

		public function __construct($args=null){}
    
		protected function open(){
		    if($_SERVER['SERVER_NAME'] == getenv("URL_PATH")){
			    $this->response = $this->connection = mysqli_connect(getenv("HTTP_DB_HOST"),getenv("HTTP_DB_USER"),getenv("HTTP_DB_PASS"))or die("Error : ".mysqli_error());
			    mysqli_select_db($this->connection,getenv("HTTP_DB_NAME"))or die("Error : ".mysqli_error($this->connection));
			}else{
			    $this->response = $this->connection = mysqli_connect(getenv("DB_HOST"),getenv("DB_USER"),getenv("DB_PASS"))or die("Error : ".mysqli_error());
			    mysqli_select_db($this->connection,getenv("DB_NAME"))or die("Error : ".mysqli_error($this->connection));
				
			}
			return $this->response;
		}
		protected function close(){
		    if($this->connection!=null)
		        mysqli_close($this->connection);
		}
		
		protected function count($condition = null){
		    
		    $this->open();
		    $query = "select count(id) as count from ".$this->table;
		    
		    if($condition != null)
		        $query .= " where $condition";
		    
		    
		    $this->resultSet = mysqli_query($this->connection,$query);
		    
		    if($row = mysqli_fetch_array($this->resultSet))
		        $this->response = $row["count"];
		    
		    
		    $this->close();
		    
		    return $this->response;
		    
		}
		protected function find( $returns = null, $condition = null, $return_type = MYSQLI_BOTH){
		    $this->open();
		    if($returns == null)
		        $returns="*";
		        
		        $query = "select ".$returns." from ". $this->table;
		        
		        if($condition != null)
		            $query.= " where ".$condition;
		        
		        $this->resultSet = mysqli_query($this->connection,$query);
		        //  if($row = mysqli_fetch_object(self::$resultSet)){
		        if($row = mysqli_fetch_array($this->resultSet,$return_type))
		            $this->response =  $row;
		        
		        $this->close();
		        
		        return $this->response;
		}
		
		protected function insert_id($keys=null, $values=null){
		    
		    if($values == null) return;
		    
		    $this->open();
		    
		    $query = "insert into ".$this->table;
		    
		    if($keys!=null)$query .="($keys)";
		    
		    $query.=" values($values)";
		    
		    mysqli_query($this->connection,$query);
		    
		    $this->response = mysqli_insert_id($this->connection);
		    
		    $this->close();
		    
		    return $this->response;
		}

	}
?>