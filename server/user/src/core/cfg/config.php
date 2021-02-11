<?php
@header('Content-Type: text/html; charset=utf-8');
@date_default_timezone_set("America/New_York");
ini_set( 'display_errors', true );
error_reporting(E_ALL);
spl_autoload_register('my_auto_load');	

function my_auto_load($class){
	$file  = "/$class.class.php";
	$path  = $_SERVER['DOCUMENT_ROOT'].getenv("CONTEXT")."/src";
	$class_uri = getClass($path, $file);
}	

function getClass($path = null, $file = null, $levels = 0 ){
	$a = '';
	$dir_list = dir($path);
	while(false !== ($dir = $dir_list->read())){
		if(preg_match("/(\.)|(\.\.)/", $dir))
			continue;
		for($i = 0 ; $i < $levels ; $i++){
			$a .= " ";
		}		
		if(is_file($path."/".$dir.$file)){
			include $path."/".$dir.$file;
		}
		 getClass($path."/".$dir,$file,$levels+1);
	}
}	

function print_obj($obj){
	echo "<pre>";
	print_r($obj);
	echo "</pre>";
}

?>