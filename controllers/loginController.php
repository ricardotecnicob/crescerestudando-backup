<?php 
	class loginController extends controller{
		
		public function __construct(){
			parent::__construct();	
			$u = new Users();

			if(isset($_SESSION['crescer'])){
				$ip = $_SERVER['REMOTE_ADDR'];
				
				$block = $u->isLock($_SESSION['crescer'],$ip);
			
			}
				
		}	
		
		public function index(){
			$data = array(
				'aviso' => ''
			);	

			$_SESSION['crescer'] = '';//solução ip unico
			
			if(isset($_POST['email']) && !empty($_POST['email'])){
				$email = addslashes($_POST['email']);
				$pass = addslashes($_POST['password']);	
				//unset($_SESSION['crescer']);exit;
				
				$u = new Users();
				
				if($u->analize($email) == true){
				if($u->doLogin($email,$pass)){
					header("Location: ".BASE_URL."");	
				}else{
					if(!isset($_SESSION['teste'])){
						$_SESSION['teste'] = 0;
					}
						$_SESSION['teste']++;

						if($_SESSION['teste'] > 3){
							$u->userBloqueadoLogin($email);

							$data['error'] = 'ESTE USUARIO ESTA BLOQUEADO! ENTRE EM CONTATO COM SUPORTE: <a href="mailto:site@brasilcomputadotes.com">site@brasilcomputadotes.com</a> ou <a href="tel:38401712">3840-1712</a>';
							//unset($_SESSION['teste']);

						}else{
							$data['error'] = 'Acesso Negado! E-mail e/ou senha errados Tentativas: '.$_SESSION['teste'];
						}

					}
				}else{
					$data['error'] = 'ESTE USUARIO ESTA BLOQUEADO! ENTRE EM CONTATO COM SUPORTE: <a href="mailto:site@brasilcomputadotes.com">site@brasilcomputadotes.com</a> ou <a href="tel:38401712">3840-1712</a>';
				}
				
			}


			require_once('controllers/config.php');
			$helper = $FB->getRedirectLoginHelper();

			$permissions = array('email');
			$loginurl = $helper->getLoginUrl(''.BASE_URL.'/login/fb_callback', $permissions);

			$data['link_facebook'] = $loginurl;
		
			
			$this->loadView("login" , $data);
			
		}

		public function fb_callback(){
			$data = array();
			$u = new Users();

			require_once('controllers/config.php');
			$helper = $FB->getRedirectLoginHelper();

			try{
				$token =  (string) $helper->getAccessToken();
			}catch(Facebook\Exceptions\FacebookResponseException $e){
				echo "ERROR: ".$e->getMessage();
				exit;
			}catch(Facebook\Exceptions\FacebookSDKException $e){
				echo "ERROR SDK: ".$e->getMessage();
				exit;
			}


			$res = $FB->get('/me?fields=id,name,email,gender', $token);
			$r = json_decode($res->getBody());

			$id = $r->id;
			$name = $r->name;
			$email = $r->email;
			$gender = $r->gender;
			$veioDoFacebook = "FACEBOOK_OPEN";

			$resultLoginFacebook = $u->doLogin2($email,$veioDoFacebook,$name,$gender);

			if($resultLoginFacebook == true){
				header("Location: ".BASE_URL."");
				exit;
			}else{
				header("Location: ".BASE_URL."/login");
				exit;
			}
			

		}

		public function register(){
			$data = array(
				'error' => ''
			);
			$u = new Users();

			if(isset($_POST['name']) && !empty($_POST['name']) && !empty($_POST['checkbox'])){

				$name = addslashes($_POST['name']);
				$email = addslashes($_POST['email']);
				$sex = addslashes($_POST['sex']);
				$password = addslashes($_POST['password']);
				$checkbox = addslashes($_POST['checkbox']);

				if(!empty($email) && !empty($sex) && !empty($password)){
					$resultt = $u->addUserCrescer($name,$email,$sex,$password,$checkbox);

					if($resultt == true){
						header("Location: ".BASE_URL."");
						exit;
					}else{
						$data['error'] = "E-mail já cadastrado";
						$this->loadView("login" , $data);
						//header("Location: ".BASE_URL."/login");
						//exit;
					}

				}
				
			}

			//header("Location: ".BASE_URL."");
		}

		//Client ID
		// 110459956794-acngp5r734d8c7kt3ai1rto3lckbmkco.apps.googleusercontent.com

		//Client Secret
		//GAHH7RoGLH2-xsrASmF--Ny1

		public function trocar_user(){

			$data = array();	

			//$_SESSION['crescer'] = '';//solução ip unico
			
			if(isset($_POST['email']) && !empty($_POST['email'])){
				$email = addslashes($_POST['email']);
				$pass = addslashes($_POST['password']);	
				//unset($_SESSION['crescer']);exit;
				
				$u = new Users();
				
				if($u->analize($email) == true){
				if($u->doLogin($email,$pass)){
					$_SESSION['teste2'] = '';
					$data = 4;	
				}else{
					if(!isset($_SESSION['teste2'])){
						$_SESSION['teste2'] = 0;
					}
						$_SESSION['teste2']++;

						if($_SESSION['teste2'] > 3){
							$u->userBloqueadoLogin($email);

							$data = 1;

						}else{
							$data = 2;
						}

					}
				}else{
					$data = 3;
				}
				
			}
			
			echo json_encode($data);

		}
		
		public function logout(){
			$u = new Users();
				$u->logout();

				$_SESSION['teste'] = '';

				header("Location: ".BASE_URL."");
		}

		public function newpass(){
			$data = array(
				'error' => '',
				'success' => ''
			);

			$u = new Users();

			if(isset($_POST['email']) && !empty($_POST['email'])){
				$email = addslashes($_POST['email']);

				if($u->veryemail($email) == true){

					require("../phpmailer/class.phpmailer.php");
 

					$mail = new PHPMailer();//talves colocar "true" dentro do parenteses
					 
					
					$mail->IsSMTP(); // Define que a mensagem será SMTP
					$mail->SMTPAuth = true;// Usa autenticação SMTP? (opcional)
					$mail->Host = "mail.brasilcomputadores.com"; // Endereço do servidor SMTP
					$mail->Port = 587;
					$mail->Username = 'site@brasilcomputadores.com'; // Usuário do servidor SMTP
					$mail->Password = 'brasil@1995'; // Senha do servidor SMTP
					//$mail->SMTPDebug  = 2;
						
					$mail->From = "site@brasilcomputadores.com"; // Seu e-mail
					$mail->Sender = "site@brasilcomputadores.com"; //Adicionar E-mail Principal
					$mail->FromName = "CODIGO PARA RECUPERAR SENHA"; // Nome da pagina 
					 
					
					$mail->AddAddress('site@brasilcomputadores.com');//Adicionar E-mail 2
					$mail->AddAddress(''.$email.'');//Adicionar E-mail 3
					
					 
					#recebendo os dados do formulario
					   
					//$email = addslashes($_POST['email']);
					for ($i=1; $i <= 6; $i++) { 
					 	 $code[] = rand(0,9);
					 } 

					 sort($code);

					 $code =  implode(' - ', $code);

					 $u->salveCodeUser($email,$code);

					//Busca o anexo
					//$anexo = $_FILES["anexo"];
					
					
					if(isset($email)){
					
					$conteudo = "<body style='margin:0px;'>
							<table width='100%' border='0' cellspacing='0' cellpadding='50' style='background-color:#fff; margin:0px;'><tbody><tr><td height='400' valign='top'>	
						
						<table width='50%' border='0' align='center' cellpadding='50' style='background-color:#0A45AB;margin:auto;'><tbody><tr>
						<td>
						
							<div class='jumbotron' style='text-align:center'>
								<h1 style='font:1.5em Tahoma, Geneva, sans-serif;text-align:center;color:#fff;'></h1>
								<div class='jumbotron' style='text-align:center'>
									<h2 style='font:1.3em Tahoma, Geneva, sans-serif;text-align:center;color:#fff;'>SEU CODIGO É</h2>
									<h1 style='font:1.4em Tahoma, Geneva, sans-serif;text-align:center;color:#fff;background:rgba(0,255,255,.1);width:200px;height:100px;line-height:100px;margin:auto;border-radius:100%;' class='teste' style='color:#000;'>$code</h1><br/>
									<a href='https://www.brasilcomputadores.com' style='margin-bottom:30px'><img src='https://www.brasilcomputadores.com/assets/images/CabecalhoLogoBrasil.png' border='0' width=201 height=85 alt=''></a><br />

                              <br /><br /><a style='text-align:center; color:#fff; margin-top:30px;' href='".BASE_URL."/login/codemail&&email=".$email."'>CONFIRME CODIGO</a> 
								</div>
                                
							</div>
						</td></tr></tbody></table>
	
						</td></tr></tbody></table>";
					
					}
					 
					
					$mail->IsHTML(true); 
					//$mail->CharSet = 'iso-8859-1'; // Charset da mensagem (opcional)
					 
					
					$mail->Subject  = "SEU CODIGO";  // Assunto da mensagem
					$exibir = $conteudo;
					$mail->Body = $exibir = utf8_decode($exibir); ;
					//Comando para enviar anexo pelo email
					//$mail->AddAttachment("/var/www/email/teste/teste.pdf", "novo_nome.pdf");  // Insere um anexo		
					
					$enviado = $mail->Send();
					 
					
					//$mail->ClearAllRecipients();
					$mail->ClearAttachments();
					 
					// Exibe uma mensagem de resultado
					if ($enviado) {
						$data['success'] = "Confirme <strong>CODIGO</strong> no seu E-mail.";
					} else {
						echo "ENTROU!";exit;
						echo "Informações do erro: " . $mail->ErrorInfo;
					}	
				}else{
					$data['error'] = '<strong>E-MAIL</strong> NÃO ENCONTRADO!';
				}

			}

			$this->loadView('newpass', $data);
		}

		public function codemail(){
			$data = array(
				'error' => ''
			);

			$u = new Users();


			if(isset($_POST['code01'])){

				$code01 = addslashes($_POST['code01']);
				$code02 = addslashes($_POST['code02']);
				$code03 = addslashes($_POST['code03']);
				$code04 = addslashes($_POST['code04']);
				$code05 = addslashes($_POST['code05']);
				$code06 = addslashes($_POST['code06']);

				$cod =  $code01.' - '.$code02.' - '.$code03.' - '.$code04.' - '.$code05.' - '.$code06;

				
				if($u->veryCodCerto($cod) == true){
					$id = $u->desativarCode($cod);

					header("Location: ".BASE_URL."/login/newpassword/".$id);

				}else{
			
					if(!isset($_SESSION['codeerrado'])){
						$_SESSION['codeerrado'] = 0;
					}
						$_SESSION['codeerrado']++;

						if($_SESSION['codeerrado'] > 2){

							$t =  $_SERVER['REQUEST_URI'];
							$tt = explode('email=', $t);
							$email = $tt[1];
							//print_r($tt[1]);exit;

							$u->limparCode($email);

							$_SESSION['codeerrado'] = '';
							header("Location: ".BASE_URL."/login/newpass");

						}else{
							$data['error'] = 'CODIGO INCORRETO: N° TENTATIVAS '.$_SESSION['codeerrado'];
						}	

				}

			}


			$this->loadView('codemail', $data);
		}

		public function newpassword($id){
			$data = array(
				'error' => ''
			);

			$u = new Users();

			$id = addslashes($id);

			$result = $u->verifikId($id);

			if($result == true){

				if(isset($_POST['password1']) && !empty($_POST['password1'])){
					$password1 = addslashes($_POST['password1']);
					$password2 = addslashes($_POST['password2']);

					if($password1 == $password2){

					$data['info'] = $u->recuperarSenha($id,$password1);
					$email = $data['info']['email'];
					
					$result = $u->doLogin($email,$password1);

						if($result == true){
							header("Location: ".BASE_URL."");	
						}else{
							echo "FALSE";
							exit;
						}
					

					}else{
						$data['error'] = "UMA DAS SENHAS NÃO CONINCIDE! ";
					}

				}


				$this->loadView('newsenha', $data);
			}else{
				header("Location: ".BASE_URL."/login/newpassTTTTT");
			}


			
		}

		
	}

?>
