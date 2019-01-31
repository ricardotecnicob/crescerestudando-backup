<?php 
	class pagseguroController extends controller{
		
		public function __construct(){
			parent::__construct();	
				
			$u = new Users();
			$ip = $_SERVER['REMOTE_ADDR'];
			
			$ver = $u->isLogged($ip);
			if($ver == false){
				header("Location: ".BASE_URL."/login");
			}
			
		}	
		
		public function index(){
			$data = array();	
				
			$u = new Users();
			$u->setLoggedUser();
			$company = new Companies($u->getCompany());
			$data['company_name'] = $company->getName();
			$data['company_logo'] = $company->getLogo();
			$data['user_name']	= $u->getName();		
			$data['user_email']	= $u->getEmail();
			$data['user_imagem'] = $u->getImagem();	
			$data['sector'] = $u->getSector();
			$data['user_bio'] = $u->getBio();
			$id = $u->getId();

			$p = new Posts();

			$idpost = addslashes($_GET['id']);
			$valorQueroPagar = addslashes($_GET['valor']);

			if($p->veryPost($idpost) == true){

				$data['info_post'] = $p->infoPostId($idpost);

				if($valorQueroPagar == 1){
					$valorPagar = $data['info_post']['pay_end'];
				}else if($valorQueroPagar == 2){
					$valorPagar = $data['info_post']['pay_start'];
				}

				$data['idpost'] = $idpost;
				$data['valorPagar'] = $valorPagar;
				$data['valorQueroPagar'] = $valorQueroPagar;

				try{
					$sessionCode = \PagSeguro\Services\Session::create(
						\PagSeguro\Configuration\Configure::getAccountCredentials()
					);

					$data['sessionCode'] = $sessionCode->getResult();
				}catch(Exception $e){
					echo "ERRO: ".$e->getMessage();
					exit;
				}

				

				$this->loadTemplate("pagseguro" , $data);
			}else{
				header("Location: ".BASE_URL."/");
			}
			
		
			
		}


		public function checkout(){

			$data = array();
			$infotrabalho = array();

			$p = new Posts();
			$u = new Users();
			$pu = new Purchases();

			$id = addslashes($_POST['id']);

			$name = addslashes($_POST['name']);
			$cpf = addslashes($_POST['cpf']);
			$telefone = addslashes($_POST['telefone']);
			$email = addslashes($_POST['email']);
			$pass = addslashes($_POST['password']);

			$cep = addslashes($_POST['cep']);
			$rua = addslashes($_POST['rua']);
			$numero = addslashes($_POST['numero']);
			$complemento = addslashes($_POST['complemento']);
			$bairro = addslashes($_POST['bairro']);
			$cidade = addslashes($_POST['cidade']);
			$estado = addslashes($_POST['estado']);

			$cartao_titular = addslashes($_POST['cartao_titular']);
			$cartao_cpf = addslashes($_POST['cartao_cpf']);
			$cartao_numero = addslashes($_POST['cartao_numero']);
			$cvv = addslashes($_POST['cvv']);
			$v_mes = addslashes($_POST['v_mes']);
			$v_ano = addslashes($_POST['v_ano']);
			$cartao_token = addslashes($_POST['cartao_token']);

			$idUserOnline = $_SESSION['crescer'];
			$valorPagamento = $_POST['valorPagamento'];
			$valorQueroPagar = $_POST['valorQueroPagar'];
			$parc = explode(';',$_POST['parc']);

			$idpost = $_POST['idpost'];
			$infotrabalho = $p->infoPostId($idpost);
			$quant = "1";


			//validacoes user
			if($u->idExixts($idUserOnline)){
				if($u->emailValido($email)){
					if($uid = $u->valiUser($email,$pass)){
						$uid = addslashes($uid);
					}else{
						$data = 1;
						echo json_encode($data);
						exit;
					}
				}else{
					$data = 3;
					echo json_encode($data);
					exit;
				}
			}else{
				$data = 2;
				echo json_encode($data);
				exit;
			}

			//Adicioinar Lista minhas compras
			$id_purchase = $pu->createPurchase($uid,$valorPagamento,'PAGSEGURO',$idpost);

			//EFETUAR PAGAMENTO

			global $config;

			$creditCard = new \PagSeguro\Domains\Requests\DirectPayment\CreditCard();
			$creditCard->setReceiverEmail($config['pagseguro_seller']);
			$creditCard->setReference($id_purchase);
			$creditCard->setCurrency("BRL");
			$creditCard->addItems()->withParameters(
				$idpost,
				$infotrabalho['type'],
				intval($quant),
				floatval($valorPagamento)

			);
			$creditCard->setSender()->setName($name);
			$creditCard->setSender()->setEmail($email);
			$creditCard->setSender()->setDocument()->withParameters('CPF',$cpf);
			
			$ddd = substr($telefone, 0, 2);
			$telefone = substr($telefone, 2);
			
			$creditCard->setSender()->setPhone()->withParameters(
				$ddd,
				$telefone
			);
			$creditCard->setSender()->setHash($id);

			$ip = $_SERVER['REMOTE_ADDR'];
			if(strlen($ip) < 9){
				$ip = '127.0.0.1';
			}
			$creditCard->setSender()->setIp($ip);

			$creditCard->setShipping()->setAddress()->withParameters(
				$rua,
				$numero,
				$bairro,
				$cep,
				$cidade,
				$estado,
				"BRA",
				$complemento
			);

			$creditCard->setBilling()->setAddress()->withParameters(
				$rua,
				$numero,
				$bairro,
				$cep,
				$cidade,
				$estado,
				"BRA",
				$complemento
			);

			$creditCard->setToken($cartao_token);
			$creditCard->setInstallment()->withParameters($parc[0], $parc[1]);
			$creditCard->setHolder()->setName($cartao_titular);
			$creditCard->setHolder()->setDocument()->withParameters('CPF', $cartao_cpf);

			$creditCard->setMode('DEFAULT');

			try {

				$result = $creditCard->register(
					\PagSeguro\Configuration\Configure::getAccountCredentials()
				);

				echo json_encode(array('success'=>true, 'msg'=>$result));
				exit;

			} catch (Exception $e) {
				echo json_encode(array('error'=>true, 'msg'=>$e->getMessage()));
				exit;
			}

		}

	
	}

?>
