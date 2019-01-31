<?php 
	class paymentController extends controller{
		
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

			header("Location: ".BASE_URL."/payment/typepayment/");
			
			$this->loadTemplate("payment" , $data);
			
		}

		public function typepayment($id){
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
			//$id = $u->getId();

			$p = new Posts();

			if($p->veryPost($id) == true){

				if(isset($_POST['escolher']) && !empty($_POST['escolher'])){
					$escolher = addslashes($_POST['escolher']);
					$escolher2 = addslashes($_POST['escolher2']);

					if($escolher2 == 1){
						header("Location: ".BASE_URL."/pagseguro?id=".$id."&&valor=".$escolher."");
					}else if($escolher2 == 2){
						header("Location: ".BASE_URL."/paypal?id=".$id."&&valor=".$escolher."");
					}

				}

				$data['info_post'] = $p->infoPostId($id);
				$data['id_post'] = $id;
			
				$this->loadTemplate("typepayment" , $data);
			}else{

				header("Location: ".BASE_URL."/");

			}
			
			
		}
	
	}

?>
