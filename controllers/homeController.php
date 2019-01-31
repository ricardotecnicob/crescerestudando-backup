<?php 
	class homeController extends controller{
		
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

			if(isset($_POST['nameTema']) && !empty($_POST['nameTema'])){
				$nameTema = addslashes($_POST['nameTema']);
				$postarMyWork = addslashes($_POST['postarMyWork']);
				$npaginaWork = addslashes($_POST['npaginaWork']);
				$prazoWork = addslashes($_POST['prazoWork']);
				$valueWork1 = addslashes($_POST['value1']);
				$valueWork2 = addslashes($_POST['value2']);
				$work = $_FILES['work'];

				$valueWork1 = str_replace(',','.',$valueWork1);
				$valueWork2 = str_replace(',','.',$valueWork2);

				$valueWork1 = explode(" ",$valueWork1);
				$valueWork1 = $valueWork1[1];

				$valueWork2 = explode(" ",$valueWork2);
				$valueWork2 = $valueWork2[1];


				if(isset($work) && !empty($work['tmp_name'])){

					move_uploaded_file($work['tmp_name'], 'assets/trabalhos/'.$work['name']);

					$work = $work['name'];

				}else{
					$work = '';
				}

				$result = $p->addpost($nameTema,$postarMyWork,$npaginaWork,$prazoWork,$valueWork1,$valueWork2,$work,$id);

				header("Location: ".BASE_URL."/");

			}

			$data['idUser'] = $id;
			$data['posts'] = $p->list_posts();	
			$data['comments_posts'] = $p->commentsPosts(3);	

			
			$this->loadTemplate("home" , $data);
			
		}
	
	}

?>
