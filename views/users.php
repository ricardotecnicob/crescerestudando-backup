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
	.table-bordered{width: 100%;}

	<?php if(BASE_URL.'/users'): ?>
		.menuarea2 ul .userPg a{background: #000;border-left: 2px solid yellow;}/*ksi
		.menuarea2 li:nth-child(2){background-image: url('<?php echo BASE_URL; ?>/assets/images/template/user.png');height: 40px;line-height: 40px;font-size: 13px;padding-left: 30px;background-size: 15px;background-repeat: no-repeat;background-position: 10px 11px;}*/
	<?php endif; ?>
		
	<?php if(BASE_URL.'/users'): ?>
		.menuarea2 ul .userPg a{background: #000;border-left: 2px solid yellow;}/*
		.menuarea2 li:nth-child(2){background-image: url('<?php echo BASE_URL; ?>/assets/images/template/user.png');height: 40px;line-height: 40px;font-size: 13px;padding-left: 30px;background-size: 15px;background-repeat: no-repeat;background-position: 10px 11px;}*/
	<?php endif; ?>

	.btn-default{background: #1F3F77;border:1px solid #1F3F77;color: white;padding: 11px;}
	.btn-default:hover{background: rgba(25,25,112,1);border:1px solid #1F3F77;color: white;}

</style>

<h1>Usuários</h1>

 <br/><a href="<?php echo BASE_URL; ?>/users/add/" class="btn btn-default">Adicionar -  Usuário</a><br/><br/>
		<table class="table table-bordered" >
		    <thead>
		      <tr>
		        <th>Email Usuário</th>
		        <th width="200">Grupo Usuário</th>
		        <th width="180" style="text-align: center;">AÇÕES</th>
		      </tr>
		    </thead>
		    <tbody>
		    	<?php foreach($users_list as $us): ?>
				      <tr>
				        <td><?php echo $us['email']; ?></td>
				        <td><?php echo $us['name']; ?></td>
				        <td>
				        	<center>
				        		<?php if($us['id'] == '1'): ?>
				        			<?php if($_SESSION['crescer'] == '1'): ?>
				        				<a href="<?php echo BASE_URL; ?>/users/edit/<?php echo $us['id']; ?>" class="btn btn-info">Editar</a>
				        			<?php endif; ?>	
				        			<?php else: ?>
				        				<a href="<?php echo BASE_URL; ?>/users/edit/<?php echo $us['id']; ?>" class="btn btn-info">Editar</a>
				        		<?php endif; ?>
				        		

				        		<?php if($us['id'] != 1): ?>
				        			<a href="<?php echo BASE_URL; ?>/users/delete/<?php echo $us['id']; ?>" onClick="return confirm('Tem certeza que deseja EXCLUIR? ')" class="btn btn-danger">Excluir</a>
				        		<?php endif; ?>	
				        	</center>	
				        </td>
				      </tr>
		        <?php endforeach; ?>
		    </tbody>
		  </table>