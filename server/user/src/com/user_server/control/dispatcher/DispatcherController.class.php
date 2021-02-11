<?php 

    class DispatcherController {
        
        private $response;
        
        function __construct() {
            $this->response = new HttpResponse();
        }
        
        public function isClient($client_token = null)
        {
            return AuthController::isClient($client_token);
        }
        
        public function signup($params = null)
        {
            $user = new User($params);
            $user->createUsername($user->__get("email"));
            $user->__set("password","***********");
          
            if(UserBusiness::getInstance()->isUser($params["email"])){
                $this->response->setParameter("error",["code"=>"0003","message"=>"Email already exists. please try another one"]);
                return  $this->response;
            }
            
            $situation_id = SituationBusiness::getInstance()->getIdByCode(SituationEnum::EMAIL_NOT_VERIFIED["code"]);
            $user_id = UserBusiness::getInstance()->add($params["name"],$params["email"],$user->__get("username"),$params["password"],$situation_id);
            
            if($user_id==0){
                $this->response->setParameter("error",["code"=>"0003","message"=>"Sorry we are not able to process your registration."]);
                return  $this->response;
            }
            
            $user->__set("id",$user_id);
            $type_id = TypeBusiness::getInstance()->getTypeIdByCode(TypeEnum::BASIC_USER["code"]);
            $profile_id = ProfileBusiness::getInstance()->add($user->__get("id"),$params["name"],$params["email"],$type_id);
            $profile = new Profile($params);
            $profile->__set('id',$profile_id);
            $user->__set('profile',$profile->jsonSerialize());
            $token = AuthController::getUserToken(sha1($user->__get("id")),$user->__get("name"), $user->__get("email"));
            $this->response->setParameter("data",["user" => $user->jsonSerialize(),"token"=>$token]);
           
            return $this->response;
        }
        
        public function signin($params=null)
        {
            $user = new User(UserBusiness::getInstance()->signin($params["email"],$params["password"]));
            $token = AuthController::getUserToken($user->__get("id"),$user->__get("name"), $user->__get("email"));
            $this->response->setParameter("data",["user" => $user->jsonSerialize(),"token"=>$token]);
            return $this->response;
        }
        
        public function updateAccount($params = null)
        {
            //if($token==null)return "";
            $token =null;
            if(isset($params["token"]))
                $token = $params["token"];
            
            $this->checkCredentials($token);
            
            if($this->response->getParameter("error")!==null)
                return $this->response;
            
            $this->response->setParameter("data",["message" =>"Account information updated successfully."]);
            
            return $this->response;
        }
        public function updateProfile($params = null){
            $this->checkCredentials($params["token"]);
            if($this->response->getParameter("error")!==null)
                return $this->response;
                $this->response->setParameter("data",["message" =>"Profile information updated successfully."]);
                return $this->response;
        }
        
        public function checkCredentials($token = null)
        {
            if($token==null || !AuthController::isAuthorizedUser($token)){
                $this->response->setParameter("error",["code"=>"0005","message" =>"You are not authorized to do this transaction please check your device or credentials"]);
                return $this->response;
            }
        }
        
        public function getUserByEmail($params=null)
        {
            if(is_null($params)){
                $this->response->setParameter("error",["code"=>"0004","message"=>"Your email is null please enter again."]);
                return  $this->response;
            }
            $this->response->setParameter("data",["user"=>UserBusiness::getInstance()->getUserByEmail($params["email"])]);
            return $this->response;
        }
            
        
    }
?>