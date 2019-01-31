<?php
	require 'environment.php';
	
	$config = array();
	
	if(ENVIRONMENT == 'development'){
		define ("BASE_URL", "http://localhost/crescerestudando");
		
		$config['dbname'] = 'crescerestudando';
		$config['host'] = 'localhost';
		$config['dbuser'] = 'root';
		$config['dbpass'] = '';
	}elseif(ENVIRONMENT == 'production'){
		define ("BASE_URL", "https://www.crescerestudando.com.br");
		$config['dbname'] = 'crescerestudando';
		$config['host'] = 'localhost';
		$config['dbuser'] = 'crescerestudando';
		$config['dbpass'] = '$bJda300';
	}
	
	global $db;

	$config['pagseguro_seller'] = 'ricardotecnicoeletronica@gmail.com';
	
	try{
		$db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'],$config['dbuser'],$config['dbpass']);
	} catch(PDOException $e){
		echo "ERRO: ".$e->getMenssage();
		exit;	
	}

	//Inicializar o PagSeguro
	\PagSeguro\Library::initialize();
	\PagSeguro\Library::cmsVersion()->setName("CrescerEstudando")->setRelease("1.0.0");
	\PagSeguro\Library::moduleVersion()->setName("CrescerEstudando")->setRelease("1.0.0");

	//Configurar conta do PagSeguro
	\PagSeguro\Configuration\Configure::setEnvironment('sandbox');
	\PagSeguro\Configuration\Configure::setAccountCredentials('ricardotecnicoeletronica@gmail.com', '783FA1876A304199887EA329D6438D92');
	\PagSeguro\Configuration\Configure::setCharset('UTF-8');
	\PagSeguro\Configuration\Configure::setLog(true, 'pagseguro.log');

?>