<?php


class SituationDAO extends DAO{
    
    private const TABLE="ta_situation";
    
    public function __construct(){
        $this->table = self::TABLE;
    }
    
   public function getIdByCode($code = null){
        $condition = "code = '$code'";
        return $this->find(null,$condition,$this->return_type[1])["id"];
    }
    
    
    /*public static function add($user = null){
        $fields     = null;
        if($user   != null)
            $fields = "'$user->first_name','$user->last_name','$user->username','$user->email',sysdate(),null,null";
            return self::insert_id($fields);
    }
    
    
    public static function signin($username, $passcode){
        
        $response =[];
        if($username != null && $passcode != null){
            $response = array(
                "username" => $username,
                "passcode" => $passcode
            );
            self::$response = 0;
            
            
            
            self::open();
            $username = mysqli_real_escape_string(self::$connection, $username);
            //echo $username;
            //exit();
            self::build_query("select  u.id, u.first_name, u.last_name, u.email,u.username, u.insert_date, t.code as type_code , s.code as situation_code, p.id as passcode_id, p.code as passcode,sha2('concat(date(sysdate()),".':'.",p.code)', 512) as token , p.update_date  from tb_user u ");
            self::append_query("join tb_passcode p  on (u.id = p.user_id)");
            self::append_query("join j_user_type ut on (u.id = ut.user_id)");
            self::append_query("join at_type t      on (ut.type_id = t.id)");
            self::append_query("join j_user_situation us on (u.id = us.user_id)");
            self::append_query("join at_situation s on us.situation_id=s.id");
            self::append_query("where ((u.email = '$username' || u.username = '$username') and p.update_date is null )");
            self::append_query("ORDER BY passcode_id desc LIMIT 1");
            
            self::$resultSet = mysqli_query(self::$connection,self::$query);
            if($row = mysqli_fetch_array(self::$resultSet, MYSQLI_ASSOC)){
                //echo $passcode."\n". $row["passcode"];
                
                if( password_verify($passcode,$row["passcode"]) == "true"){
                    unset($row["passcode"]);
                    unset($row["passcode_id"]);
                    $user     = new User($row);
                    $passcode = new Passcode();
                    $passcode->__set("token", $row["token"]);
                    $user->__set("passcode",$passcode );
                    self::$response = $user;
                }else{
                    self::$response = 0;
                }
                //print_r( self::$response);
            }
            
            self::close();
            
            
        }
        
        return self::$response;
    }
    
    
    
    public static function hasUser($email= null){
        $condition = null;
        if($email != null)
            $condition = "email = '$email'";
            
        return  self::count($condition);
    }
    */
  
    
}

?>