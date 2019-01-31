<?php 
	class paypalController extends controller{
		
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

				$this->loadTemplate("paypal" , $data);
			}else{
				header("Location: ".BASE_URL."/");
			}
			
			
		}

	
	}

?>
