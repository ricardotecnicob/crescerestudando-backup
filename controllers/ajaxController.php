<?php 
	class ajaxController extends controller{
		
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

		}

		public function listTrabalhos(){
			$data = array();

			$posts = new Posts();

			if(isset($_POST['busca'])){
				$busca = addslashes($_POST['busca']);
				$data = $posts->listaPostsCategoria($busca);
			
			}

			echo json_encode($data);
		}

		public function mudastatus(){
			$data = array();

			$pgcontact = new Pgcontact();

			if(isset($_POST['id']) && !empty($_POST['id'])){
				$id = addslashes($_POST['id']);
				$pgcontact->mudarstatus($id);
				$data = " ";
			}

			echo json_encode($data);
		}

		public function statusPost(){
			$data = array();

			$pos = new Posts();

			if(isset($_POST['item']) && !empty($_POST['item'])){
				$item = addslashes($_POST['item']);
				$idPost = addslashes($_POST['idPost']);
				$idUser = addslashes($_POST['idUser']);
				$status = addslashes($_POST['status']);

				$data = $pos->addStatus($item,$idPost,$idUser,$status);

			}

			echo json_encode($data);
		}

		public function comenntar(){
			$data = array();

			$pos = new Posts();

			if(isset($_POST['lista']) && !empty($_POST['lista'])){
				$lista = addslashes($_POST['lista']);
				$idPost = addslashes($_POST['idPost']);
				$idUser = addslashes($_POST['idUser']);

				$data = $pos->getComments($lista,$idPost,$idUser);

			}

			if(isset($_POST['lista2']) && !empty($_POST['lista2'])){
				$lista = addslashes($_POST['lista2']);
				$idPost = addslashes($_POST['idPost']);
				$idUser = addslashes($_POST['idUser']);

				$data = $pos->getComments2($lista,$idPost,$idUser);

			}

			if(isset($_POST['comment']) && !empty($_POST['comment'])){
				$comment = addslashes($_POST['comment']);
				$idPost = addslashes($_POST['idPost']);
				$idUser = addslashes($_POST['idUser']);

				$data = $pos->addComments($comment,$idPost,$idUser);

			}


			echo json_encode($data);
		}


		
	}//FIM

?>