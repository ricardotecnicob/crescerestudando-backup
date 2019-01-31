<style type="text/css" media="screen">
	h1{text-align: center;}
	.logoFormaPagamento{height: 80px;margin-top: -20px;}
	.formPagSeguro{width: 80%;margin:auto;margin-top: 0px;}
	.formPagSeguro input,select{margin-bottom: 10px;}
	.areaCartDate{display: flex; margin-bottom: 10px;width: 30%;background: transparent;}
	.areaCartDate .cartao_mes{width: 100px;}
	.areaCartDate .cartao_ano{width: 100px;}

	.aviso01{display:none;}
	.aviso02{display:none;}

</style>

<script type="text/javascript">
	$(function(){
		$('input[name=cep]').on('blur', function(){

			var cep = $(this).val();

			$.ajax({
				url:'https://viacep.com.br/ws/'+cep+'/json/',
				type:'GET',
				dataType:'json',
				success:function(json){
					$('input[name=address]').val(json.logradouro);
					$('input[name=bairro]').val(json.bairro);
					$('input[name=city]').val(json.localidade);
					$('.state').val(json.uf);
					$('input[name=number]').focus();
				}
			});

		});
	});
</script>	

<center><h1>Forma de Pagamento</h1> <img src="<?php echo BASE_URL; ?>/assets/images/pagseguro-logo.png" class="logoFormaPagamento" border="0" alt="" />  <br/><br/>
</center>

<form method="POST" class="formPagSeguro" >

	<div class="panel panel-primary">
	    <div class="panel-heading">Dados Pessoais</div>
	    <div class="panel-body">
	    	
		    <strong>NOME:</strong>
			<input type="text" required="required"  name="name" value="Ricardo Augusto de Aguiar Alves" class="form-control" placeholder="Nome Completo">

			<strong>CPF:</strong>
			<input type="text" required="required"  name="cpf" value=" 13256368603" class="form-control" placeholder="CPF">

			<strong>TELEFONE:</strong>
			<input type="text" required="required"  name="phone" value="31987016568" class="form-control" placeholder="TELEFONE">

			<strong>E-MAIL:</strong>
			<input type="email" required="required"  value="c36503904386523982148@sandbox.pagseguro.com.br" name="email" class="form-control" placeholder="E-MAIL">

			<strong>SENHA:</strong>
			<input type="password" required="required"  value="1XcluKCW2JJPdYNw" name="password" class="form-control" placeholder="SENHA">


			
	    </div>
	</div>

	<div class="panel panel-primary">
	    <div class="panel-heading">Informações de Endereço</div>
	    <div class="panel-body">
	    	
		    <strong>CEP:</strong>
			<input type="text" required="required"  value="35900-391" name="cep" class="form-control cep" placeholder="CEP">

			<strong>RUA:</strong>
			<input type="text" required="required"  value="Rua Paraíba" name="address" class="form-control" placeholder="RUA">

			<strong>NÚMERO:</strong> 
			<input type="text" required="required"  name="number" value="131" class="form-control" placeholder="NÚMERO">

			<strong>COMPLEMENTO:</strong> 
			<input type="text" required="required"  name="address2" value="AP 12" class="form-control" placeholder="COMPLEMENTO">

			<strong>BAIRRO:</strong>
			<input type="text" required="required"  name="bairro" value="GIANNET" class="form-control" placeholder="BAIRRO">

			<strong>CIDADE:</strong>
			<input type="text" name="city" required="required"  value="ITABIRA" class="form-control" placeholder="CIDADE">
			
			<strong>ESTADO:</strong>
			<select name="state" required="required"  class="form-control state" >
				<option value="">SELECIONE ESTADO</option>
			    <option value="AC">Acre</option>
			    <option value="AL">Alagoas</option>
			    <option value="AP">Amapá</option>
			    <option value="AM">Amazonas</option>
			    <option value="BA">Bahia</option>
			    <option value="CE">Ceará</option>
			    <option value="DF">Distrito Federal</option>
			    <option value="ES">Espírito Santo</option>
			    <option value="GO">Goiás</option>
			    <option value="MA">Maranhão</option>
			    <option value="MT">Mato Grosso</option>
			    <option value="MS">Mato Grosso do Sul</option>
			    <option value="MG" selected="selected" >Minas Gerais</option>
			    <option value="PA">Pará</option>
			    <option value="PB">Paraíba</option>
			    <option value="PR">Paraná</option>
			    <option value="PE">Pernambuco</option>
			    <option value="PI">Piauí</option>
			    <option value="RJ">Rio de Janeiro</option>
			    <option value="RN">Rio Grande do Norte</option>
			    <option value="RS">Rio Grande do Sul</option>
			    <option value="RO">Rondônia</option>
			    <option value="RR">Roraima</option>
			    <option value="SC">Santa Catarina</option>
			    <option value="SP">São Paulo</option>
			    <option value="SE">Sergipe</option>
			    <option value="TO">Tocantins</option>
			    <option value="ES">Estrangeiro</option>
			</select>
			
	    </div>
	</div>



	<div class="panel panel-primary">
	    <div class="panel-heading">Informações de Pagamento</div>
	    <div class="panel-body">

		  <strong>TITULAR DO CARTÃO:</strong>
			<input type="text" value="Ricardo Augusto de Aguiar Alves" name="cartao_titular" class="form-control " placeholder="TITULAR DO CARTÃO" required="required" >

		  <strong>CPF DO TITULAR:</strong>
			<input type="text" value="13256368603" name="cartao_cpf" class="form-control " placeholder="CPF DO TITULAR" required="required" >
	    	
		    <strong>NÚMERO DO CARTÃO:</strong>
			<input type="text" name="cartao_numero" class="form-control " placeholder="NÚMERO DO CARTÃO" maxlength="16" required="required" >

			<strong>CÓDIGO DE SEGURANÇA:</strong>
			<input type="text" name="cartao_cvv" class="form-control" placeholder="CÓDIGO DE SEGURANÇA" required="required"  >

			<strong>VALIDADE:</strong>
			<div class="areaCartDate">
				<select name="cartao_mes" required="required"  class="form-control" style="margin-right: 10px;" >
					<?php for($q=1; $q<=12; $q++):  ?>
						<option ><?php echo ($q<10)?'0'.$q : $q; ?></option>
					<?php endfor; ?>	
				</select>	
				<select name="cartao_ano" required="required"  class="form-control" >
					<?php $ano = intval(date('Y')); ?>
					<?php for($q= $ano; $q<=($ano+20); $q++):  ?>
						<option ><?php echo $q; ?></option>
					<?php endfor; ?>
				</select>	
			</div>	
			
			<strong>PARCELAS:</strong>
			<select name="parc" style="width:185px" required="required"  class="form-control parc" >
			</select>

	    </div>
	</div>

	<div class="alert alert-danger aviso01">
		<strong>E-mail e/ou senha não CONFEREM!</strong>
	</div>

	<div class="alert alert-danger aviso02">
		<strong>E-mail não encontrado!</strong>
	</div>

	<button type="button" class="btn btn-success efetuarCompra" >Efetuar Pagamento</button>

</form>
<br/><br/>

<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js" ></script>

<script type="text/javascript" >
	$(function(){

		$('input[name=email],input[name=password]').on('focus', function(){
			$('.aviso01').css('display','none');
		});

		$('input[name=email]').on('focus', function(){
			$('.aviso02').css('display','none');
		});

		$('.efetuarCompra').on('click', function(){

			var id = PagSeguroDirectPayment.getSenderHash();

			var name = $('input[name=name]').val();
			var cpf = $('input[name=cpf]').val();
			var telefone = $('input[name=phone]').val();
			var email = $('input[name=email]').val();
			var password = $('input[name=password]').val();
			    
			var cep = $('input[name=cep]').val();
			var rua = $('input[name=address]').val();
			var numero = $('input[name=number]').val();
			var complemento = $('input[name=address2]').val();
			var bairro = $('input[name=bairro]').val();
			var cidade = $('input[name=city]').val();
			var estado = $('select[name=state]').val();
			
			
			var cartao_titular = $('input[name=cartao_titular]').val();
			var cartao_cpf = $('input[name=cartao_cpf]').val();
			var cartao_numero = $('input[name=cartao_numero]').val();
			var cvv = $('input[name=cartao_cvv]').val();
			var v_mes = $('select[name=cartao_mes]').val();
			var v_ano = $('select[name=cartao_ano]').val();

			var parc = $('select[name=parc]').val();

			var valorPagamento = <?php echo $valorPagar; ?>;
			var idpost = <?php echo $idpost; ?>;
			var valorQueroPagar = <?php echo $valorQueroPagar; ?>

			if(cartao_numero != '' && cvv != '' && v_mes != '' && v_ano != ''){
				PagSeguroDirectPayment.createCardToken({
					cardNumber:cartao_numero,
					brand:window.cardBrand,
					cvv:cvv,
					expirationMonth:v_mes,
					expirationYear:v_ano,
					success:function(r){
						window.cardToken = r.card.token;
						//FINALIZAR PAGAMENTO

						$.ajax({
							url:'<?php echo BASE_URL; ?>/pagseguro/checkout',
							type:'POST',
							dataType:'json',
							data:{
								id:id,
								name:name,
								cpf:cpf,
								telefone:telefone,
								email:email,
								password:password,
								cep:cep,
								rua:rua,
								numero:numero,
								complemento:complemento,
								bairro:bairro,
								cidade:cidade,
								estado:estado,
								cartao_titular:cartao_titular,
								cartao_cpf:cartao_cpf,
								cartao_numero:cartao_numero,
								cvv:cvv,
								v_mes:v_mes,
								v_ano:v_ano,
								cartao_token:window.cardToken,
								valorPagamento:valorPagamento,
								idpost:idpost,
								valorQueroPagar:valorQueroPagar,
								parc:parc
							},
							success:function(json){
								if(json == 1){
									$('.aviso01').css('display','block');
								}else if(json == 2){
									window.location.href = "<?php echo BASE_URL; ?>/login/logout";
								}else if(json.error == true){
									console.log(json.msg);
								}else if(json.success == true){
									console.log(json.msg);
								}
							},
							error:function(r){

							},
							complete:function(r){

							}
						});

					},
					error:function(r){
						console.log(r);
					},
					complete:function(r){

					}
				});
			}

		});

		$('input[name=cartao_numero]').on('keyup', function(){
			if($(this).val().length == 6){
				PagSeguroDirectPayment.getBrand({
					cardBin:$(this).val(),
					success:function(r){
						//console.log(r);
						window.cardBrand = r.brand.name;
						var cvvLimit = r.brand.cvvSize;

						//MOSTRAR BANDEIRA FAZER ISSO SOZINHO	

						//PARCELAMENTO	
						PagSeguroDirectPayment.getInstallments({
							amount:<?php echo $valorPagar; ?>,
							brand:window.cardBrand,
							success:function(r){
								
								if(r.error == false){
									var parc = r.installments[window.cardBrand];

									var html = '';

									for(var i in parc){
										if(parc[i].quantity == 1){

											var optionValue = parc[i].quantity+';'+parc[i].installmentAmount+';';

											if(parc[i].interestFree == true){
												optionValue += 'true';
											}else{
												optionValue += 'false';
											}

											html += '<option value="'+optionValue+'" selected="selected">'+parc[i].quantity+'x de R$ '+parc[i].installmentAmount+'</option>';
										}
									}
									
									$('select[name=parc]').html(html);

								}

							},
							error:function(r){

							},
							complete:function(r){

							}
						});

						$('input[name=cartao_cvv]').attr('maxlength',cvvLimit);

					},
					error:function(r){
						console.log("ERROR: ");
					},
					complete:function(r){

					}
				});
			}
		});
	});
</script>

<script type="text/javascript" >
	PagSeguroDirectPayment.setSessionId("<?php echo $sessionCode; ?>");
</script>

<script type="text/javascript">
$(document).ready(function(){
  $('.date').mask('00/00/0000');
  $('.time').mask('00:00:00');
  $('.date_time').mask('00/00/0000 00:00:00');
  $('.cep').mask('00000-000');
  $('.phone').mask('0000-0000');
  $('.phone_with_ddd').mask('(00) 0000-0000');
  $('.phone_us').mask('(000) 000-0000');
  $('.mixed').mask('AAA 000-S0S');
  $('.cpf').mask('000.000.000-00', {reverse: true});
  $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
  $('.money').mask('000.000.000.000.000,00', {reverse: true});
  $('.money2').mask("#.##0,00", {reverse: true});
  $('.ip_address').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
    translation: {
      'Z': {
        pattern: /[0-9]/, optional: true
      }
    }
  });
  $('.ip_address').mask('099.099.099.099');
  $('.percent').mask('##0,00%', {reverse: true});
  $('.clear-if-not-match').mask("00/00/0000", {clearIfNotMatch: true});
  $('.placeholder').mask("00/00/0000", {placeholder: "__/__/____"});
  $('.fallback').mask("00r00r0000", {
      translation: {
        'r': {
          pattern: /[\/]/,
          fallback: '/'
        },
        placeholder: "__/__/____"
      }
    });
  $('.selectonfocus').mask("00/00/0000", {selectOnFocus: true});
});
</script>	



