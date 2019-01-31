<?php if(!empty($aviso)): ?>
	<script type="text/javascript">
		$('#naoTemPermissao').modal('show');
		$('#naoTemPermissao .modal-content').css('width','100%');
		$('#naoTemPermissao').css('z-index','99999999999999');
	</script>
	<?php exit; ?>
<?php else: ?>

<?php endif; ?>	

<?php if(BASE_URL.'/users'): ?>
	<script type="text/javascript">$('.navMenuLeft').css('display','none');$('.menuMinhaConta').css('display','block');</script>
<?php endif; ?>

<script type="text/javascript">
   $(document).ready(function(){
        $('.listNavBar ul .l3').css('background','#0f1315');
   });
</script>

<style type="text/css">
	.table-bordered{width: 93%;}

	<?php if(BASE_URL.'/users'): ?>
		.menuarea2 ul .userPg a{background: #000;border-left: 2px solid yellow;}/*ksi
		.menuarea2 li:nth-child(2){background-image: url('<?php echo BASE_URL; ?>/assets/images/template/user.png');height: 40px;line-height: 40px;font-size: 13px;padding-left: 30px;background-size: 15px;background-repeat: no-repeat;background-position: 10px 11px;}*/ 
	<?php endif; ?>
		
	<?php if(BASE_URL.'/users'): ?>
		.menuarea2 ul .userPg a{background: #000;border-left: 2px solid yellow;}/*
		.menuarea2 li:nth-child(2){background-image: url('<?php echo BASE_URL; ?>/assets/images/template/user.png');height: 40px;line-height: 40px;font-size: 13px;padding-left: 30px;background-size: 15px;background-repeat: no-repeat;background-position: 10px 11px;}*/
	<?php endif; ?>

</style>

<h1>Usuários - Editar</h1>

<?php if(!empty($error_msg)): ?>
	<div class="alert alert-danger"><?php echo $error_msg; ?></div>
<?php endif; ?>	

<form method="post" class="form">

	<label for="name" class="title">Nome do Usuário</label><br/>
	<input type="text" name="name" id="name" value="<?php echo $user_info['name']; ?>" placeholder="Nome do Usuário" autofocus="autofocus" class="form-control" required="required"><br/>

	<label for="name" class="title">Função do Usuário</label><br/>
	<input type="text" name="funcao" id="name" value="<?php echo $user_info['sector']; ?>" placeholder="Função do Usuário" autofocus="autofocus" class="form-control" required="required"><br/>

	<label for="email" class="title">Email do Usuário</label><br/>
	<input type="email" name="email" id="email" placeholder="E-mail do Usuário" readonly="readonly" value="<?php echo $user_info['email']; ?>" autofocus="autofocus" class="form-control" required="required"><br/>

	<label for="password" class="title">Senha do Usuário</label><br/>
	<input type="password" name="password" id="password" placeholder="Senha do Usuário" autofocus="autofocus" class="form-control"><br/>

	<label for="group" class="title">Groupo de Permissões</label><br/>
	<select name="group" class="form-control" id="group" required="required" >
		<option value="" selected="">Escolha um Grupo</option>
			<?php foreach($group_list as $g): ?>
				<option value="<?php echo $g['id']; ?>" <?php echo($g['id'] == $user_info['id_group'])?'selected="selected"':''; ?>><?php echo $g['name']; ?></option>
			<?php endforeach; ?>	
	</select><br/>


	<input type="submit" class="btn btn-default add" value="Editar" >
</form>