<?php

/*
 create table tb_user(
 id int primary key auto_increment,
 first_name varchar(80),
 last_name varchar(80),
 username varchar(80),
 email 	varchar(80),
 insert_date TIMESTAMP,
 update_date TIMESTAMP,
 delete_date TIMESTAMP
 
 );
 */
class UserDAO extends DAO{
    
    private const TABLE="tb_user";
    
    public function __construct(){
        $this->table = self::TABLE;
    }
    public function isUser($email= null){
        $condition = "email = '$email' or username='$email'";
        return ( $this->count($condition) > 0) ? true : false;
    }
    public function add($name = null,$email=null,  $username = null , $password=null,$situation_id=0){
        $values = "null,'$name','$email','$username',SHA2('$password',512),$situation_id,sysdate(),null,null";
        return $this->insert_id(null, $values);
    }
    public function signin($email = null, $password = null){
        $condition = "email = '$email' and password = SHA2('$password',512)";
        return $this->find(" sha1(id) as id, name,username,email ",$condition,$this->return_type[1]);
    }
  
    
}

?>