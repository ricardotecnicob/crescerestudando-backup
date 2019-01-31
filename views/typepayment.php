<style type="text/css" media="screen">
	.valueJobs{display: flex;}
	.area01{width: 50%;background: #000080;height: 150px;text-align: center;justify-content: center;text-align: center;margin:10px;padding: 10px;}
	.area01 span{font-size: 2em;color: white;font-weight: bold;}
	.area01 p{font-size: 2em;color: white;}
	.area01 input{background: blue;width: 20px;height: 20px;}
	.escolhe{display: flex;color: white;justify-content: center;cursor: pointer;}
	.escolhe label{margin-top: 2px;cursor: pointer;}
	.area01:hover{}

	.formaTitle{font-size: 1.8em;margin-top: 50px;}
	.pagamentos{display: flex;background: #fff;}
	.area02{width: 50%;background: #fff;height: 150px;text-align: center;justify-content: center;margin:10px;padding: 10px;}
	.area03{width: 50%;background: #fff;height: 150px;text-align: left;justify-content: center;text-align: center;margin:10px;padding: 10px;}
	.area02 img{height: 70px;}
	.area03 img{height: 60px;margin-bottom: 10px;}
	.area02 input{background: transparent;width: 20px;height: 20px;}
	.area03 input{background: transparent;width: 20px;height: 20px;}
	.escolhe2{display: flex;justify-content: center;cursor: pointer;background: #000080;}
	.escolhe2 label{margin-top: 2px;cursor: pointer;color: white;}

</style>

<form method="POST">
	<div class="valueJobs">
		<div class="area01">
			<span>VALOR DO TRABALHO</span> <br>
			<p>R$ <?php echo str_replace('.', ',', $info_post['pay_end']); ?></p>
			<div class="escolhe">
				<input type="radio" name="escolher" style="cursor: pointer;" class="form-control" value="1" id="1" checked="cheked" /><label for="1">Pagar valor</label>
			</div>
		</div>
		<div class="area01">
			<span>VALOR MÍNIMO</span> <br>
			<p>R$ <?php echo str_replace('.', ',', $info_post['pay_start']); ?></p>
			<div class="escolhe">
				<input type="radio" name="escolher" style="cursor: pointer;" class="form-control" value="2" id="2" /><label for="2">Pagar valor</label>
			</div>
		</div>
	</div>
	<center><label class="formaTitle" >Escolher Forma de Pagamento</label></center>
	<div class="pagamentos">
		<div class="area02">
			<img src="<?php echo BASE_URL; ?>/assets/images/pagseguro-logo.png" border="0" /> <br/><br/>
			<div class="escolhe2">
				<input type="radio" name="escolher2" style="cursor: pointer;" class="form-control" value="1" id="3" checked="cheked" /><label for="3">Pagar valor</label>
			</div>
		</div>
		<div class="area03">
			<img src="<?php echo BASE_URL; ?>/assets/images/paypal.png" border="0" /> <br/><br/>
			<div class="escolhe2">
				<input type="radio" name="escolher2" style="cursor: pointer;" class="form-control" value="2" id="4"  /><label for="4">Forma de Pagamento</label>
			</div>
		</div>	
	</div>	

	<center>
		<input type="submit" class="btn btn-primary " value="Área de Pagamento" /> <br/><br/>
	
		<p>*Seus dados serão preservados e nada será publicado em sua timeline. serviço válido somente para pessoas fisicas.
Em caso de dúvidas, acesse nossa central de atendimento.</p>	

    </center>

</form>	
