<?php
	include $_SERVER['DOCUMENT_ROOT'].getenv("CONTEXT").getenv('CONFIG');
	header('Content-Type: application/json');
	$response         = new HttpResponse();
	$controller       = new DispatcherController();
	$client_token     = HttpRequest::getInstance()->getparameter("client_token");
	
	if(!$controller->isClient($client_token)){
	   $response->setParameter("error",["code"=>0001, "message"=>"You do not have permission to access the api, your client token is invalid."]);
	   echo json_encode($response->jsonSerialize(),JSON_PRETTY_PRINT);
	   exit();
	}
	
	$action           = HttpRequest::getInstance()->getparameter("action");
	
	if(!method_exists($controller, $action)){
	    $response->setParameter("error",["code"=>0002, "message"=>"invalid route action. The action($action) does not exist"]);
	    echo json_encode($response->jsonSerialize(),JSON_PRETTY_PRINT);
	    exit();
	}
	
	$response = $controller->$action(HttpRequest::getInstance()->getparameters());
	echo json_encode($response->jsonSerialize(),JSON_PRETTY_PRINT);
?>