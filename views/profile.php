<style type="text/css"> 
	.photoNow{width: 150px;height: 150px;border-radius: 100%;}
	.photoNow img{width: 100%;border-radius: 100%;}
	.myPorfileForm{margin: auto;width: 98%;}
	.myPorfileForm label{font-size: 1.3em;}
	.alterarSenha{font-size: 1.8em;}
	.avisoErro{display: none;}

	.linha{height: 1px;margin:auto;background: #ccc;margin-bottom: 10px;margin-top: 10px;}
	.panel-primary{margin:auto;width: 95%;}

	.Btalterar{margin-left: 20px;}

</style>

<script type="text/javascript">
	$(function(){
		$('.pass02').on('blur', function(){
			var pass01 = $('input[name="pass01"]').val();
			var pass02 = $('input[name="pass02"]').val();

			if(pass01 != ''){
				if(pass01 == pass02){
					//$('.Btalterar').removeClass('disabled');ksi
					$('.avisoErro').css('display','none');
					$('.pass02').css('border','1px solid green');
					$('.Btalterar').removeClass('disabled');
				}else{
					$('.Btalterar').addClass('disabled');
					$('.avisoErro').css('display','block');
					$('.pass02').css('border','1px solid red');
				}
			}	
		});
	});
</script>

<div id="uploadimageModal5" class="modal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">TAMANHO MAXIMO 338x338</h4>
          </div>
          <div class="modal-body">
            <div class="row">
            <div class="col-md-8 text-center">
              <div id="image_demo5" style="width:350px; margin-top:30px"></div>
            </div>
            <div class="col-md-4" style="padding-top:30px;">
              <br />
              <br />
              <br/>
              <button class="btn btn-success crop_image5">CORTAR IMAGEM</button>
          </div>
        </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">SAIR</button>
          </div>
      </div>
    </div>
</div>

<br/><br/>
<form method="POST" enctype="multipart/form-data" class="myPorfileForm">

<div class="panel panel-primary">
    <div class="panel-heading">Alterar Foto Perfil</div>
    <div class="panel-body">
    	
			<center>	
				<?php if(empty($viewData['user_imagem'])): ?>
					<div class="photoNow"><img src="<?php echo BASE_URL; ?>/assets/images/TEMPLATE/user2.png" border="0" alt=""></div><br/>
				<?php else: ?>
					<div class="photoNow"><img src="<?php echo BASE_URL; ?>/assets/images/<?php echo $viewData['user_imagem']; ?>" border="0" alt=""></div><br/>
				<?php endif; ?>	
			</center>

			<div class="panel panel-default">
		        <div class="panel-heading">ADICIONAR FOTO DE PERFIL <span style="color: red">1MB</span></div>
		        <div class="panel-body" align="center">
		            <input type="file" class="form-control" name="upload_image5 " id="upload_image5" />
		        <br />
		        <div id="uploaded_image5"></div>
		        </div>
		   </div>
		
    </div>
</div>
	<br/>
	<div class="panel panel-primary">
		<div class="panel-heading">Dados do Úsuarios</div>
			<div class="panel-body">
			    <label>Nome Usuário:</label>
				<input type="text" name="nameNew" value="<?php echo $viewData['user_name']; ?>" required="required" placeholder="Name User" class="form-control" ><br>
				<label>Nome do Cargo:</label>
				<input type="text" readonly="readonly" style="pointer-events: none;" value="<?php echo $viewData['sector']; ?>" required="required" placeholder="Name User" class="form-control" ><br>
				<label>Descrição Úsuario:</label>
				<textarea name="bio" class="form-control " style="height: 150px;" ><?php echo $viewData['user_bio']; ?></textarea><br/>
				<label>E-mail Usuário:</label><br>
						<?php echo $viewData['user_email']; ?>
			<br><br>
		</div>
	</div>
	<br/>
	<div class="panel panel-primary">
      <div class="panel-heading">Trocar Senha</div>
      <div class="panel-body">
			<label>Nova Senha:</label><br>
			<input type="password" name="pass01" placeholder=" " class="form-control pass01" ><br>
			<label>Nova Senha<span>(novamente)</span>:</label><br>
			<input type="password" name="pass02" placeholder=" "  class="form-control pass02" ><br>
			<div class="alert alert-danger avisoErro">SENHAS DIFERENTES!</div>
      </div>

    </div>

   <br/>
   
   <input type="submit" name="" class="btn btn-primary Btalterar" value="ALTERAR">

</form>
<br><br><br><br>


<script>  
	$(document).ready(function(){

			$image_crop = $('#image_demo5').croppie({
		    enableExif: true,
		    viewport: {
		      width:338,
		      height:338,
		      type:'circle' //circle square
		    },
		    boundary:{
		      width:300,
		      height:300
		    }
		  });


		  $('#upload_image5').on('change', function(){
		    var reader = new FileReader();
		    reader.onload = function (event) {
		      $image_crop.croppie('bind', {
		        url: event.target.result
		      }).then(function(){
		        console.log('jQuery bind complete');
		      });
		    }
		    reader.readAsDataURL(this.files[0]);
		    $('#uploadimageModal5').modal('show');
		  });

		  $('.crop_image5').click(function(event){
		    $image_crop.croppie('result', {
		      type: 'canvas',
		      size: 'viewport'
		    }).then(function(response){
		      $.ajax({
		        url:"<?php echo BASE_URL; ?>/users/imgdepoiment",
		        type: "POST",
		        async: true,
		        data:{"image": response},
		        success:function(data)
		        {
		          $('#uploadimageModal5').modal('hide');
		          $('#uploaded_image5').html(data);
		        }
		      });
		    })
		  });

	});  
</script>

