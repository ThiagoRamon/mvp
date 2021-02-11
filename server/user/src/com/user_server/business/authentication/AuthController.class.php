<?php
    
    class AuthController {
        
        private static $header = ["alg"=>"HS256","typ"=>"JWT"];
        private static $s_key    = "1234567890-thi-ra-fe-pi-0987654321";//sha1("123");
        private static $instance;
        private static $client_token = "bota_na_conta_do_papa!";
        
        public static function getInstance(){
            if(!isset(self::$instance))
                self::$instance = new AuthController();
                return self::$instance;
        }
        
        private function __construct() {
        }
        
        public static function isClient($client_token = null ){
            //hash(sha256) -> $client_token -->>  f923951a08432bbf2c1f70885fc0133394f8f18dc0e57354d8ba196dc7e590f1
             return (hash("sha256",self::$client_token) == $client_token)?true:false; 
        }
        
        public static function getUserToken($id = null, $name = null, $email=null)
        {
            $header    = self::base64UrlEncode(json_encode(self::$header));
            $payload   = self::base64UrlEncode(json_encode(["sub" =>$id, "name" =>$name,"email" =>$email]));
            $signature = self::base64UrlEncode(hash_hmac("sha256", $header.".".$payload,  hash("sha256",self::$s_key) , true));
            return $header.".".$payload.".".$signature;
        }
        
        public static function isAuthorizedUser($token = null)
        {
            if($token == null)
                return false;
            return self::isRightToken($token);
        }
        
        private static function isRightToken($token = null)
        {
            $token = explode(".",$token);
            $header    = $token[0];
            $payload   = $token[1];
            $client_signature = $token[2];
            $signature = self::base64UrlEncode(hash_hmac("sha256", $header.".".$payload,  hash("sha256",self::$s_key) , true));
            if($signature!=$client_signature)
                return false;
            return true;
        }
        
        private static function base64UrlEncode($text)
        {
            return str_replace(
                ['+', '/', '='],
                ['-', '_', ''],
                base64_encode($text)
                );
        }
        
        private static function base64UrlDecode($text)
        {
            return base64_decode($text);
        }
       
    }
?>