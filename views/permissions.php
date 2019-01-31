<?php if(!empty($aviso)): ?> 
	<script type="text/javascript">
		$('#naoTemPermissao').modal('show');
		$('#naoTemPermissao .modal-content').css('width','100%');
		$('#naoTemPermissao').css('z-index','99999999999999');
	</script>
	<?php exit; ?>
<?php else: ?>

<?php endif; ?>	

<?php if(BASE_URL.'/permissions'): ?>
	<script type="text/javascript">$('.navMenuLeft').css('display','none');$('.menuMinhaConta').css('display','block');</script>
<?php endif; ?>


<script type="text/javascript">
   $(document).ready(function(){
        $('.listNavBar ul .l2').css('background','#0f1315');
   });
</script>



<style type="text/css">
	.tabarea{height: 40px;}
	.tabitem{float: left;width: 46%;height: 40px;text-align: center;border-bottom: 1px solid #e9e9e9;padding-top: 11px;background: #ccc;cursor: pointer;}
	.activetab{border-bottom:1px solid #fff;background: #fff;}
	.tabbody{display: none;width: 93%;}

	th{background: #e9e9e9;}
	td{background: #FBFBFB;}

	<?php if(BASE_URL.'/permissions'): ?>
		.menuarea2 ul .permissionsPg a{background: #000;border-left: 2px solid yellow;}
		/*crescer
		.menuarea2 li:nth-child(1){background-image: url('<?php echo BASE_URL; ?>/assets/images/template/key.png');height: 40px;line-height: 40px;font-size: 13px;padding-left: 30px;background-size: 15px;background-repeat: no-repeat;background-position: 10px 11px;}
		*/
	<?php endif; ?>
		
	<?php if(BASE_URL.'/permissions'): ?>
		.menuarea2 ul .permissionsPg a{background: #000;border-left: 2px solid yellow;}
		/*
		.menuarea2 li:nth-child(1){background-image: url('<?php echo BASE_URL; ?>/assets/images/template/key.png');height: 40px;line-height: 40px;font-size: 13px;padding-left: 30px;background-size: 15px;background-repeat: no-repeat;background-position: 10px 11px;}
		*/
	<?php endif; ?>

	.btn-default{background: #1F3F77;border:1px solid #1F3F77;color: white;padding: 11px;}
	.btn-default:hover{background: rgba(25,25,112,1);border:1px solid #1F3F77;color: white;}

</style>

<script type="text/javascript">
	
	$(function(){
		$('.tabitem').on('click', function(){
			$('.activetab').removeClass('activetab');
			$(this).addClass('activetab');

			var item = $('.activetab').index();
			$('.tabbody').hide();
			$('.tabbody').eq(item).show();
		});
		$('.tabbody').eq(0).show();
	});

</script>

<h1>Permissões</h1>

<div class="tabarea">
	<div class="tabitem activetab">Grupos de Permissões</div>
	<div class="tabitem">Permissões</div>
</div>
<div class="tabcontant">
	<div class="tabbody">
	 <br/><a href="<?php echo BASE_URL; ?>/permissions/add_group/" class="btn btn-default">Adicionar Grupo de Permissão</a><br/><br/>
		<table class="table table-bordered" >
		    <thead>
		      <tr>
		        <th>NOME DO GRUPO DA PERMISSÃO</th>
		        <th width="160" style="text-align: center;">AÇÕES</th>
		      </tr>
		    </thead>
		    <tbody>
		    	<?php foreach($permissions_group_list as $p): ?>
				      <tr>
				        <td><?php echo $p['name']; ?></td>
				        <td>
				        	<center>
				        		<?php if($p['id'] == '1'): ?>
				        			<?php if($_SESSION['crescer'] == '1'): ?>
				        				<a href="<?php echo BASE_URL; ?>/permissions/edit_group/<?php echo $p['id']; ?>" class="btn btn-info">Editar</a>
				        			<?php endif; ?>	
				        			<?php else: ?>
				        				<a href="<?php echo BASE_URL; ?>/permissions/edit_group/<?php echo $p['id']; ?>" class="btn btn-info">Editar</a>
				        		<?php endif; ?>


				        		<?php if($p['id'] != '1'): ?>
				        			<a href="<?php echo BASE_URL; ?>/permissions/delete_group/<?php echo $p['id']; ?>" onClick="return confirm('Tem certeza que deseja EXCLUIR? ')" class="btn btn-danger">Excluir</a>
				        		<?php endif; ?>	

				        	</center>	
				        </td>
				      </tr>
		        <?php endforeach; ?>
		    </tbody>
		  </table>

	</div>
	<div class="tabbody">
		<br/><a href="<?php echo BASE_URL; ?>/permissions/add/" class="btn btn-default">Adicionar Permissão</a><br/><br/>
		<table class="table table-bordered" >
		    <thead>
		      <tr>
		        <th>NOME DA PERMISSÃO</th>
		        <th width="12" style="text-align: center;">AÇÕES</th>
		      </tr>
		    </thead>
		    <tbody>
		    	<?php foreach($permissions_list as $p): ?>
				      <tr>
				        <td><?php echo $p['name']; ?></td>
				        <td>
				        	<center>
				        		<a href="<?php echo BASE_URL; ?>/permissions/delete/<?php echo $p['id']; ?>" onClick="return confirm('Tem certeza que deseja EXCLUIR? ')" class="btn btn-danger">Excluir</a>
				        	</center>	
				        </td>
				      </tr>
		        <?php endforeach; ?>
		    </tbody>
		  </table>

	</div>
</div>

