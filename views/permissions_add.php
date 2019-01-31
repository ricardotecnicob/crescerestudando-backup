<?php if(!empty($aviso)): ?> 
	<script type="text/javascript">
		$('#naoTemPermissao').modal('show');
		$('#naoTemPermissao .modal-content').css('width','100%');
		$('#naoTemPermissao').css('z-index','99999999999999');
	</script>
	<?php exit; ?>
<?php else: ?>

<?php endif; ?>	

<?php if(BASE_URL.'/permissions/'): ?>
	<script type="text/javascript">$('.navMenuLeft').css('display','none');$('.menuMinhaConta').css('display','block');</script>
<?php endif; ?>

<script type="text/javascript">
   $(document).ready(function(){
        $('.listNavBar ul .l2').css('background','#0f1315');
   });
</script>


<style type="text/css">
	#name{width: 90%;}
	.nome_titulo{font-size: 1.2em;}
	.form{margin-top: 40px;}
	.add{margin-top: 10px;}

	<?php if(BASE_URL.'/permissions'): ?>
		.menuarea2 ul .permissionsPg a{background: #000;border-left: 2px solid yellow;}
		/*ksi
		.menuarea2 li:nth-child(1){background-image: url('<?php echo BASE_URL; ?>/assets/images/template/key.png');height: 40px;line-height: 40px;font-size: 13px;padding-left: 30px;background-size: 15px;background-repeat: no-repeat;background-position: 10px 11px;}*/
	<?php endif; ?>
		
	<?php if(BASE_URL.'/permissions'): ?>
		.menuarea2 ul .permissionsPg a{background: #000;border-left: 2px solid yellow;}/*
		.menuarea2 li:nth-child(1){background-image: url('<?php echo BASE_URL; ?>/assets/images/template/key.png');height: 40px;line-height: 40px;font-size: 13px;padding-left: 30px;background-size: 15px;background-repeat: no-repeat;background-position: 10px 11px;}*/
	<?php endif; ?>

</style>

<h1>Permissões - Adicionar</h1>

<form method="post" class="form">
	<label for="name" class="nome_titulo">Nome da Permissão</label>
	<input type="text" name="name" id="name" placeholder="Nome da Permissão" autofocus="autofocus" class="form-control" required="required">
	<input type="submit" class="btn btn-default add" value="Adicionar" >
</form>