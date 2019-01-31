<?php

		/*
			
			,(select count(*) from posts_likes where posts_likes.id_post = posts.id and posts_likes.item = 1 and posts_likes.status = 1 ) as likes1,

					  (select count(*) from posts_likes where posts_likes.id_post = posts.id and posts_likes.item  = 2 and posts_likes.status = 1 ) as likes2,

					  (select count(*) from posts_likes where posts_likes.id_post = posts.id and posts_likes.item  = 3 and posts_likes.status = 1 ) as likes3,

					  (select count(*) from posts_likes where posts_likes.id_post = posts.id and posts_likes.id_user = :user and posts_likes.status = 1 ) as liked,

					  (select posts_likes.item from posts_likes where posts_likes.id_user = :user and  posts_likes.status = 1 ) as likedSelect,

					  (select posts_likes.status from posts_likes where posts_likes.id_user = :user ) as status,

					  (select posts_likes.item from posts_likes where posts_likes.id_user = :user and posts_likes.status = 1 and posts_likes.id_post = posts.id ) as itemAtivo
						  

		*/

		class Posts extends model{

			public function veryPost($id){
				$array = array();

				$sql = "SELECT * FROM posts WHERE id = :id";
				$sql = $this->db->prepare($sql);
				$sql->bindValue(':id',$id);
				$sql->execute();

				if($sql->rowCount() > 0){
					$array = true;
				}else{
					$array = false;
				}

				return $array;

			}

			public function list_posts(){

				$array = array();

				$sql = "
				SELECT 

					users.imagem,
					users.name,
					users.id as iduserr,
					posts.id_user,
					posts.data_post,
					posts.type,
					posts.textt,
					posts.id_group,
					posts.pages,
					posts.delivery_date,
					posts.pay_start,
					posts.pay_end,
					posts.job,
					posts.concluido,
					posts.id
					
				FROM posts 
				LEFT JOIN users ON users.id = posts.id_user
				ORDER BY posts.data_post DESC	
				" ;
				$sql = $this->db->prepare($sql);
				$sql->execute();

				if($sql->rowCount() > 0){
					$array = $sql->fetchAll();

				}


				return $array;
			}

			public function infoPostId($id){
				$array = array();

				$sql = "SELECT * FROM posts WHERE id = :id";
				$sql = $this->db->prepare($sql);
				$sql->bindValue(':id',$id);
				$sql->execute();

				if($sql->rowCount() > 0){
					$array = $sql->fetch();
				}

				return $array;

			}

			public function listaPostsCategoria($busca){
				$array = array();

				$sql = "
				SELECT 

					users.imagem,
					users.name,
					users.id as iduserr,
					posts.id_user,
					posts.data_post,
					posts.type,
					posts.textt,
					posts.id_group,
					posts.pages,
					posts.delivery_date,
					posts.pay_start,
					posts.pay_end,
					posts.job,
					posts.concluido,
					posts.id
					
				FROM posts 
				LEFT JOIN users ON users.id = posts.id_user
				WHERE posts.concluido = :busca
				ORDER BY posts.data_post DESC	
				" ;
				$sql = $this->db->prepare($sql);
				if($busca == '500'){
					$sql->bindValue(':busca','');
				}else{
					$sql->bindValue(':busca',$busca);
				}
				$sql->execute();

				if($sql->rowCount() > 0){
					$array = $sql->fetchAll();

				}


				return $array;
			}

			public function commentsPosts($limit=''){
				$array = array();

				$sql = "SELECT *,(select users.name from users where users.id = post_comments.id_user) as nameUser FROM post_comments LIMIT $limit";
				$sql = $this->db->prepare($sql);
				$sql->execute();

				if($sql->rowCount() > 0){
					$array = $sql->fetchAll();
				}

				return $array;

			}

			public function postsemAberto(){
				$array = array();

				$sql = "SELECT COUNT(*) as c FROM posts WHERE concluido = :concluido ";
				$sql = $this->db->prepare($sql);
				$sql->bindValue(':concluido',0);
				$sql->execute();

				if($sql->rowCount() > 0){
					$sql = $sql->fetch();
					$array = $sql['c'];
				}

				return $array;
			}

			public function addComments($comment,$idPost,$idUser){
				$array = array();

				$sql = "INSERT INTO post_comments SET id_post = :id_post, id_user = :id_user, comments = :comments, data_create = NOW() ";
				$sql = $this->db->prepare($sql);
				$sql->bindValue(':id_post',$idPost);
				$sql->bindValue(':id_user',$idUser);
				$sql->bindValue(':comments',$comment);
				$sql->execute();

				$sql = "SELECT *,(select users.name from users where users.id = post_comments.id_user) as nameUser FROM post_comments WHERE id_post = :id_post ";
				$sql = $this->db->prepare($sql);
				$sql->bindValue(':id_post',$idPost);
				$sql->execute();

				if($sql->rowCount() > 0){
					$array = $sql->fetchAll();
				}

				return $array;


			}

			public function getComments($lista,$idPost,$idUser){
				$array = array();

				$sql = "SELECT *,(select users.name from users where users.id = post_comments.id_user) as nameUser FROM post_comments WHERE id_post = :id_post ";
				$sql = $this->db->prepare($sql);
				$sql->bindValue(':id_post',$idPost);
				$sql->execute();

				if($sql->rowCount() > 0){
					$array = $sql->fetchAll();
				}

				return $array;
			}

			public function getComments2($lista,$idPost,$idUser){
				$array = array();

				$sql = "SELECT *,(select users.name from users where users.id = post_comments.id_user) as nameUser FROM post_comments WHERE id_post = :id_post LIMIT $lista ";
				$sql = $this->db->prepare($sql);
				$sql->bindValue(':id_post',$idPost);
				$sql->execute();

				if($sql->rowCount() > 0){
					$array = $sql->fetchAll();
				}

				return $array;
			}


			public function addpost($nameTema,$postarMyWork,$npaginaWork,$prazoWork,$valueWork1,$valueWork2,$work,$id){

				$sql = "INSERT INTO posts SET id_user = :id_user, data_post = NOW(), type = :type, textt = :textt, pages = :pages, delivery_date = :delivery_date, pay_start = :pay_start, pay_end = :pay_end, job = :job, concluido = :concluido ";
				$sql = $this->db->prepare($sql);
				$sql->bindValue(':id_user',$id);
				$sql->bindValue(':type',$nameTema);
				$sql->bindValue(':textt',$postarMyWork);
				$sql->bindValue(':pages',$npaginaWork);
				$sql->bindValue(':delivery_date',$prazoWork);
				$sql->bindValue(':pay_start',$valueWork1);
				$sql->bindValue(':pay_end',$valueWork2);
				$sql->bindValue(':job',$work);
				$sql->bindValue(':concluido',0);
				$sql->execute();

			}


			public function addStatus($item,$idPost,$idUser,$status){
				$post = array();

				$sql = "SELECT * FROM posts_likes WHERE id_post = :id_post AND id_user = :id_user ";
				$sql = $this->db->prepare($sql);
				$sql->bindValue(':id_post',$idPost);
				$sql->bindValue(':id_user',$idUser);
				$sql->execute();

				if($sql->rowCount() > 0){
					$post = $sql->fetch();

					if($post['item'] == $item){
						if($post['status'] == 0){
							$sql = "UPDATE posts_likes SET  status = :status WHERE id_post = :id_post AND id_user = :id_user ";
							$sql = $this->db->prepare($sql);
							$sql->bindValue(':id_post',$idPost);
							$sql->bindValue(':id_user',$idUser);
							$sql->bindValue(':status',1);
							$sql->execute();
							return 1;
						}else if($post['status'] == 1){
							$sql = "UPDATE posts_likes SET  status = :status WHERE id_post = :id_post AND id_user = :id_user ";
							$sql = $this->db->prepare($sql);
							$sql->bindValue(':id_post',$idPost);
							$sql->bindValue(':id_user',$idUser);
							$sql->bindValue(':status',0);
							$sql->execute();
							return 2;
						}
					}else{
						$sql = "UPDATE posts_likes SET  status = :status, item = :item WHERE id_post = :id_post AND id_user = :id_user ";
						$sql = $this->db->prepare($sql);
						$sql->bindValue(':id_post',$idPost);
						$sql->bindValue(':id_user',$idUser);
						$sql->bindValue(':item',$item);
						$sql->bindValue(':status',1);
						$sql->execute();
						return 3;
					}

				}else{
					$sql = "INSERT INTO posts_likes SET id_post = :id_post, id_user = :id_user, item = :item,  status = :status ";
					$sql = $this->db->prepare($sql);
					$sql->bindValue(':id_post',$idPost);
					$sql->bindValue(':id_user',$idUser);
					$sql->bindValue(':item',$item);
					$sql->bindValue(':status',1);
					$sql->execute();
					return 4;
				}

			}



			
		}	

?>