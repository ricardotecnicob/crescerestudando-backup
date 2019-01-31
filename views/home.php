<script src="<?php echo BASE_URL; ?>/assets/js/jquery.mask.js" type="text/javascript" ></script>

<script  type="text/javascript" charset="utf-8" async defer>
	$(document).ready(function(){
	  $('.valueWork1,.valueWork2').mask('000.000.000.000.000,00', {reverse: true});
	});
</script>

<style type="text/css">
	.areaPost{display: flex;flex-wrap: wrap;}
	.home01{flex:3; background: transparent;min-height: 700px;}
	.home02{flex:1; background: green;min-height: 700px;}

	.caixaPost{width: 90%;border:1px solid #ccc;margin: auto;min-height: 270px;margin-top: 10px;box-shadow: 1px 1px 1px rgba(0,0,0,.6)}
	.cabecalhoPost{width: 100%;height: 60px;background: #00008B;display: flex;padding: 5px;}
	.imgCabecalho{width: 50px;height: 50px;background: blue;border-radius: 100%;margin-right: 5px;border:2px solid #fff;}
	.imgCabecalho img{width: 100%;height: 100%;}
	.nomeCabecalho{font-size: 1.3em;margin-top: 10px;font-weight: 700;color:white;}
	.formPost{padding: 10px;}
	.areaEscreVer{background: blue;height: 120px;margin-bottom: 5px;}
	.TemaTrabalho{width: 100%;background: transparent;margin-bottom: 5px;margin-top: 5px;}
	.TemaTrabalho input{width: 100%;padding-left: 3px;}
	.areaEscreVer textarea{width: 100%;height: 100%;padding: 10px;}
	.Paginas{margin-bottom: 5px;}
	.Paginas .tempMinimo{color: red;}
	.Paginas input{height: 30px;width: 50px;margin-top: 5px;}
	.Prazo{}
	.Prazo .tempMinimo{color: red;}
	.Prazo input{height: 30px;width:130px;margin-top: 5px;margin-left: 8px;}
	.Valor{margin-top: 5px;margin-bottom: 10px;}
	.Valor input{width: 100px;}

	.rodapePost{display: flex;padding-top: 10px;padding-left: 10px;background: transparent;justify-content: right;border-top: 1px solid #ccc;}
	.rodapePost input[type="file"]{display: none;}
	.rodapePost label{ background-color: #3498db;border-radius: 5px;color: #fff;cursor: pointer;padding: 6px 20px;}
	.rodapePost .enviarPost{height: 33px;margin-right: 5px;margin-left: 5px;}

	.postHome{width: 100%;min-height: 200px;background:transparent;padding: 30px;border-bottom: 1px solid #ccc;}
	.postHomeOrg1{display: flex;}
	.postImage{background: green;width: 40px;height: 40px;border-radius:100%;}
	.postImage img{height: 40px;width: 40px;border-radius: 100%;}
	.postName{font-size: 1.3em;font-weight: bold;margin-left: 10px;padding-top: 5px;margin-right: 10px;}
	.postHomeOrg2{width: 82%;margin:auto;}
	.tempoPost{font-weight: bold;}
	.textPost{}
	.likePOst{margin-top: 10px;margin-bottom: 10px;}
	.likePOst .numb1{margin-right: 5px;font-size: 1.2em;}
	.likePOst .numb2{margin-right: 5px;font-size: 1.2em;}
	.likePOst .numb3{margin-right: 5px;font-size: 1.2em;}
	.coracion{color: #292929;font-size: 1.2em;} /*red*/
	.coracion:hover{color:#B22222;}
	.likeBtn{color: #292929;font-size: 1.2em;} /*blue*/
	.likeBtn:hover{color: #000080;}
	.deslike{color: #292929;font-size: 1.2em;}
	.deslike:hover{color: #3498db;}
	.listaComentario{border-top:1px solid #ccc;}
	.titleComment{font-size: 1.3em;margin-top: 10px;}
	.postComment{}
	.dataComment{font-size:.7em;color:red;}
	.addComentario{border-top:1px solid #ccc;padding-top: 10px;}
	.btnComent{margin-top: 8px;}
	.btnNegociacao{margin-top: 8px;}

	.titlePosts{font-size: 1.3em;}

	.coracion_marcado{color:red;}
	.likeBtn_marcado{color: blue;}
	.deslike_marcado{color: #3498db;}
	.verMenosComentario{display: none;}

	.nomeStatus{display: flex;justify-content: center;background: #00008B;width: 100%;margin-left: 5px;}
	.nameStats{flex:1;color: white}
	.nameStatsConcluido{padding-top: 8px;font-weight: bold;text-align: right;color: white;padding-right: 10px;}


</style>

<script type="text/javascript" >
	$(function(){

		$('.enviarPost').on('click', function(){
			$('.valueWork1').removeAttr('disabled');
			$('.valueWork2').removeAttr('disabled');
		});

		$('.npaginaWork').on('change', function(){
			var number = $(this).val();
			var dolar = '';

			if(number <= 0){
				$('.npaginaWork').val(0);
				$('.valueWork1').val('R$ '+0+',00');
				$('.valueWork2').val('R$ '+0+',00');
				return false;
			}else{
				$.ajax({
					url:'https://economia.awesomeapi.com.br/usd',
					type:'GET',
					dataType:'json',
					success:function(json){
						for(var i in json){
							var dolar =  parseFloat(json[i].ask.slice(0, 4));
						}

						var valorminimo1 = number * dolar;
						var valorminimo2 = number * dolar;
						var valorminimo2 = valorminimo2 + 15.00;
						var valorInit = valorminimo1.toFixed(2);
						var valorFim = valorminimo2.toFixed(2);
						var res1 = valorInit.replace('.', ',');
						var res2 = valorFim.replace('.', ',');
						$('.valueWork1').val("R$ "+res1);
						$('.valueWork2').val("R$ "+res2);
						
					},
					error:function(){
						console.log("E");
					}
				});

			}

		});


	$('.btnComent').on('click', function(){
		var idPost = $(this).attr('data-id');
		var comment = $('.containerComentario'+idPost).val();
		var idUser = '<?php echo $idUser; ?>';

		$.ajax({
			url:'<?php echo BASE_URL; ?>/ajax/comenntar',
			type:'POST',
			async:true,
			dataType:'json',
			data:{comment:comment,idPost:idPost,idUser:idUser},
			success:function(json){
				$html = '';

				if(json != ''){
					for(var i in json){
						var dateHora = json[i].data_create.split(' ');
						var dataCerta = dateHora[0].split('-');

						$html += '<div class="postComment"><label class="nameUserComent" style="margin-right:5px;" >'+json[i].nameUser+'</label><span class="dataComment" style="font-size:.7em;color:red;">'+dataCerta[2]+'/'+dataCerta[1]+'/'+dataCerta[0]+' '+dateHora[1]+'</span><p class="comentDesc" >'+json[i].comments+'</p></div>';
					}
				}

				$('.postsCommentsIni'+idPost).html('');
				$('.postsCommentsIni'+idPost).append($html);
				$('.containerComentario'+idPost).val('');

			}
		})

	});

	$('.verMaisComentario').on('click', function(){
		var idPost = $(this).attr('data-id');
		var idUser = '<?php echo $idUser; ?>';
		var lista = 1;

		$.ajax({
			url:'<?php echo BASE_URL; ?>/ajax/comenntar',
			type:'POST',
			async:true,
			dataType:'json',
			data:{idPost:idPost,idUser:idUser,lista:lista},
			success:function(json){
				$html = '';

				if(json != ''){
					for(var i in json){
						var dateHora = json[i].data_create.split(' ');
						var dataCerta = dateHora[0].split('-');

						$html += '<div class="postComment"><label class="nameUserComent" style="margin-right:5px;" >'+json[i].nameUser+'</label><span class="dataComment" style="font-size:.7em;color:red;">'+dataCerta[2]+'/'+dataCerta[1]+'/'+dataCerta[0]+' '+dateHora[1]+'</span><p class="comentDesc" >'+json[i].comments+'</p></div>';
					}
				}

				$('.postsCommentsIni'+idPost).html('');
				$('.postsCommentsIni'+idPost).append($html);
				$('.containerComentario'+idPost).val('');
				$('.verMenosComentario'+idPost).css('display','block');
				$('.verMaisComentario'+idPost).css('display','none');

			}
		})

	});

	$('.verMenosComentario').on('click', function(){
		var idPost = $(this).attr('data-id');
		var idUser = '<?php echo $idUser; ?>';
		var lista2 = 3;

		$.ajax({
			url:'<?php echo BASE_URL; ?>/ajax/comenntar',
			type:'POST',
			async:true,
			dataType:'json',
			data:{idPost:idPost,idUser:idUser,lista2:lista2},
			success:function(json){
				$html = '';

				if(json != ''){
					for(var i in json){
						var dateHora = json[i].data_create.split(' ');
						var dataCerta = dateHora[0].split('-');

						$html += '<div class="postComment"><label class="nameUserComent" style="margin-right:5px;" >'+json[i].nameUser+'</label><span class="dataComment" style="font-size:.7em;color:red;">'+dataCerta[2]+'/'+dataCerta[1]+'/'+dataCerta[0]+' '+dateHora[1]+'</span><p class="comentDesc" >'+json[i].comments+'</p></div>';
					}
				}

				$('.postsCommentsIni'+idPost).html('');
				$('.postsCommentsIni'+idPost).append($html);
				$('.containerComentario containerComentario'+idPost).val('');
				$('.verMaisComentario'+idPost).css('display','block');
				$('.verMenosComentario'+idPost).css('display','none');

			}
		})

	});


	});//FIM FUNCION PRINCIPAL jQUERY


</script>

<script type="text/javascript">
	//var listaComentarios = window.setInterval(listaComentarios, 2000);
	// function listaComentarios() {
	//    	$.ajax({
	// 		url:'<?php echo BASE_URL; ?>/ajax/comments',
	// 		type:'POST',
	// 		async:true,
	// 		dataType:'json',
	// 		data:{item:item,idPost:idPost,idUser:idUser,status:status},
	// 		success:function(json){}
	// 	});
	// }
	//date_default_timezone_set('America/Sao_Paulo');
	//clearInterval(listaComentarios);
</script>


<div class="areaPost">
	<div class="home01">
		<div class="caixaPost">
			<div class="cabecalhoPost">
				<div class="imgCabecalho">
					<?php if(empty($viewData['user_imagem'])): ?>
		                <img src="<?php echo BASE_URL; ?>/assets/images/TEMPLATE/user2.png" border="0" alt="" />
		            <?php else: ?>  
		                <img src="<?php echo BASE_URL; ?>/assets/images/<?php echo $viewData['user_imagem']; ?>" border="0" alt="" />
		            <?php endif; ?> 
        	    </div>
				<div class="nomeCabecalho"><?php $name = explode(' ', $viewData['user_name']); echo $name[0].' '.$name[1];   ?>    </div>
			</div>	
			<form method="POST" enctype="multipart/form-data" class="formPost">

				<div class="TemaTrabalho">
					<input type="text" class="nameTema" name="nameTema" required="required" placeholder="Tema do Trabalho" />
				</div>	

				<div class="areaEscreVer">
					<textarea placeholder="Compartilhe seu Trabalho" name="postarMyWork" class="postarMyWork" required="required" ></textarea>
				</div>
				<div class="Paginas">
					<label>Quantas Páginas? </label> <span class="tempMinimo"></span>
					<input type="number" class="npaginaWork" name="npaginaWork" required="required" placeholder="0" />
				</div>
				<div class="Prazo">
					<label>Data de Entrega </label> <span class="tempMinimo">(<strong style="color:red;">mínimo</strong> 5 dias depois da negociação)</span>
					<input type="date" class="prazoWork" name="prazoWork" required="required" placeholder="00/00/0000" />
				</div>	
				<div class="Valor">
					<label>Valor do trabalho: </label>
					<input type="text" disabled="disabled" class="valueWork2" name="value2" required="required" placeholder="R$ 00,00" /><br/>
					<label style="margin-top: 10px;">Valor <strong style="color:red;">mínimo</strong> depois da negociação: </label>
					<input type="text" disabled="disabled" class="valueWork1" name="value1" required="required" placeholder="R$ 00,00" />
					
				</div>	
				<div class="rodapePost">
					<label for='selecao-arquivo' >Escolher Trabalho</label>
					<input type="file" name="work" class="work" id="selecao-arquivo"  />
					<input type="submit" class="btn btn-primary enviarPost" value="Publicar">
				</div>
			</form>	
		</div>

		<?php foreach($posts as $info): ?>
			<div class="geralPosts">
				<div class="postHome" >	
					<div class="postHomeOrg1">
						<div class="postImage">
							<img src="<?php echo BASE_URL; ?>/assets/images/<?php echo $info['imagem']; ?>" border="0" alt="" />
						</div>
						<div class="nomeStatus" >
							<div class="nameStats postName">
								<?php echo $info['name']; ?>
							</div>
							<div class="nameStats nameStatsConcluido">
								<?php if($info['concluido'] == 0): ?>
									<label>Em Aberto</label>
								<?php elseif($info['concluido'] == 1): ?>
									<label>Concluido</label>
								<?php endif; ?>	
							</div>
						</div>	
					</div>
					<div class="postHomeOrg2" >
						<div class="tempoPost" style="margin-top: 5px;">
							<strong >Publicado em:</strong> <?php echo date('d/m/Y  H:i', strtotime($info['data_post'])); ?><br/>
							
						</div><br/>
						<div class="textPost" >
							<strong class="titlePosts"><?php echo $info['type']; ?></strong>
							
							<br><br>
							<?php echo $info['textt']; ?>
						</div>
						
						<br/>
						<strong>Nº Páginas: </strong> <span><?php echo $info['pages']; ?></span><br>
						<strong>Prazo de Entrega:</strong> <?php echo date('d/m/Y' , strtotime($info['delivery_date'])); ?><br>
						<strong>Valor do trabalho:</strong> R$ <?php echo str_replace(".", ",",$info['pay_end']); ?>
						<br/>
						<strong>Valor <strong style="color:red;">mínimo</strong> depois da negociação:</strong> R$ <?php echo str_replace(".", ",", $info['pay_start']); ?><br>
						<br/>
						<div class="listaComentario ">
							<center><label class="titleComment">Comentários</label></center>
							<div class="postsCommentsIni postsCommentsIni<?php echo $info['id']; ?>">
								<?php foreach($comments_posts as $coments): ?>
									<?php if($coments['id_post'] == $info['id']): ?>
										<div class="postCommentList">
											<div class="postComment">
												<label class="nameUserComent"><?php echo $coments['nameUser']; ?></label> <span class="dataComment"><?php echo date('d/m/Y H:i:s', strtotime($coments['data_create'])); ?></span> <p class="comentDesc" ><?php echo $coments['comments']; ?></p>
											</div>
										</div>
									<?php endif; ?>	
								<?php endforeach; ?>	
							</div>	
							<center>
								
								<a href="javascript:;" class="verMaisComentario verMaisComentario<?php echo $info['id']; ?>" data-id="<?php echo $info['id']; ?>" ><label style="cursor: pointer;">Ver mais <i class="fa fa-plus"></i></label></a>

								<a href="javascript:;" class="verMenosComentario verMenosComentario<?php echo $info['id']; ?>" data-id="<?php echo $info['id']; ?>" ><label style="cursor: pointer;">Ver menos <i class="fa fa-minus"></i></label></a>
								
							</center>
						</div>
						<div class="addComentario">
							<label>Novo Comentário</label>
							<textarea class="form-control containerComentario containerComentario<?php echo $info['id']; ?>" style="height: 150px"  placeholder="Adicionar Comentario" ></textarea>
							<a href="javascript:;" class="btn btn-success btnComent" data-id="<?php echo $info['id']; ?>" >Comentar</a>
							<a href="<?php echo BASE_URL; ?>/payment/typepayment/<?php echo $info['id']; ?>" class="btn btn-primary btnNegociacao">Escolher Forma de Pagamento</a>
						</div>
					</div>	
				</div><br/>
			</div>	
		<?php endforeach; ?>	



	</div> <!-- nao apagar fim -->

	<div class="home02">
	
	</div>
</div>







