<?php
//MOSTRAR ERROS OS ERROS
error_reporting(E_ALL);
ini_set('display_errors',"On");
ini_set('display_startup_erros', "On");
//echo phpinfo();
//exit;

	session_start();
	require 'vendor/autoload.php';
	require 'config.php';
	
	spl_autoload_register(function($class){
		if(file_exists('controllers/'.$class.'.php')){
			require_once 'controllers/'.$class.'.php';	
		}elseif(file_exists('models/'.$class.'.php')){
			require_once 'models/'.$class.'.php';	
		}else{
			if(file_exists('core/'.$class.'.php')){
				require_once 'core/'.$class.'.php';
			}	
		}
	});
	
	$core = new Core();
	$core->run();
?>
