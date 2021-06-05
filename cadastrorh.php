<?php 
session_start();
include('verifica_login.php');
include('verifica_acesso_USER.php');
include_once 'conexao.php';
include_once 'mensagem.php';

	$sqlcivil = "SELECT id,descricao FROM estadocivil";
	$resultadocivil = mysqli_query($conexao, $sqlcivil);

	$sqlcivil1 = "SELECT id,descricao FROM estadocivil";
	$resultadocivil1 = mysqli_query($conexao, $sqlcivil1);

	$sqlcivil2 = "SELECT id,descricao FROM estadocivil";
	$resultadocivil2 = mysqli_query($conexao, $sqlcivil2);
	
	$sqlnacao = "SELECT codigo,nacao FROM pcodnacao order by nacao";
	$resultadonacao = mysqli_query($conexao, $sqlnacao);
	
	$sqlinstrucao = "SELECT CODIGO, DESCRICAO FROM pcodinstrucao";
	$resultadoinstrucao = mysqli_query($conexao, $sqlinstrucao);
	
	$sqlraca = "SELECT CODIGO, DESCRICAO FROM raca";
	$resultadoraca = mysqli_query($conexao, $sqlraca);

	$sqlbanco = "SELECT COD, BANCO FROM BANCOS";
	$resultabanco= mysqli_query($conexao, $sqlbanco);

	$sqldef = "SELECT ID_DEF, DESCRICAO_DEF FROM DEFICIENCIA";
	$result_def= mysqli_query($conexao, $sqldef);

	$sqlrua = "SELECT * FROM DTIPORUA";
	$result_rua= mysqli_query($conexao, $sqlrua);

	$sqlbairro = "SELECT * FROM DTIPOBAIRRO";
	$result_bairro= mysqli_query($conexao, $sqlbairro);

	$coligada = $_SESSION['coligada'];

	$sqlsecao = "SELECT codigo,descricao FROM psecao where codcoligada = '$coligada'";
	$result_secao = mysqli_query($conexao, $sqlsecao);

	$sqlfuncao = "SELECT codigo,descricao FROM pfuncao where codcoligada = '$coligada'";
	$result_funcao = mysqli_query($conexao, $sqlfuncao);

	$sqlhorario = "SELECT codigo,descricao FROM AHORARIO where codcoligada = '$coligada'";
	$result_horario = mysqli_query($conexao, $sqlhorario);
?>
<!DOCTYPE HTML>

<html>

<head>
	<title>Quality - RH</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="assets/css/main.css" />
	<link rel="stylesheet" href="assets/css/stylesheet.css"/>
	<link rel="stylesheet" href="assets/css/informacao.css"/>
</head>

<body class="is-preload">

	<!-- Wrapper -->
	<div id="wrapper">

		<!-- Main -->
		<div id="main">
			<div class="inner">

				<!-- Header -->
				<header id="header">
					<a href="#" class="logo"><strong>Formulario</strong> de admissão</a>
					<ul class="icons">
						<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon brands fa-snapchat-ghost"><span class="label">Snapchat</span></a></li>
						<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>

					</ul>
				</header>


				<section>
					<form method="post" action="cadfunc_processa_rh.php" enctype="multipart/form-data">
						<div class="logo">
							<h3>Identificação</h3>
							<img style="height: 150px; width: 155px;"><br>
							<label style="text-align: center" id="teste" for='imagem'>Foto</label>
							<input type="file" name="imagem" id="imagem" onchange="previewImagem()" ><br>
						</div>
						<div class="row gtr-uniform">
						
							<div class="col-6 col-12-xsmall">
								<h5>Nome</h5>
								<input type="text" name="nome" id="nome" value="" placeholder="Nome" style="text-transform:uppercase;" required />
							</div>
							<div class="col-6 col-12-xsmall">
								<h5>Data nascimento</h5>
								<input type="text" name="dtnasc" id="dtnasc" value="" placeholder="Data nascimento" maxlength="10" onkeypress="$(this).mask('00/00/0000')" style="text-transform:uppercase;" required/>
							</div>
							<div class="col-6 col-12-xsmall">
								<h5>Naturalidade</h5>
								<input type="text" name="naturalidade" id="naturalidade" value="" placeholder="naturalidade" style="text-transform:uppercase;" required />
							</div>
							<div class="col-6 col-12-xsmall">
								<h5>Nacionalidade</h5>
								<select name="nacionalidade" id="nacionalidade" style="text-transform:uppercase"; required>
								<option value="">Nacionalidade</option>
									<?php while($dadosnacao = mysqli_fetch_array($resultadonacao)):?>
										<option value="<?php echo $dadosnacao['codigo'];?>"><?php echo utf8_encode($dadosnacao['nacao']);?></option>
									<?php endwhile; ?>
								  </select>
							</div>
							<div class="col-6 col-12-xsmall">
								<h5>Estado civil</h5>
								<select name="estadocivil" id="estadocivil" style="text-transform:uppercase;" required>
									<option value="">Estado civil</option>
									<?php while($dadoscivil = mysqli_fetch_array($resultadocivil)):?>
										<option value="<?php echo $dadoscivil['id'];?>"><?php echo utf8_encode($dadoscivil['descricao']);?></option>
									<?php endwhile; ?>
								</select>
							</div>
							<div class="col-6 col-12-xsmall">
								<h5>Sexo</h5>
									<select name="sexo" id="sexo" style="text-transform:uppercase;" required>
									<option value="">Sexo</option>
									<option value="1">Masculino</option>
									<option value="2">Feminino</option>
								</select>
							</div>
							<div class="col-6 col-12-xsmall">
								<h5>Grau de Instrução</h5>
								<select name="grauinstrucao" id="grauinstrucao" style="text-transform:uppercase;" required>
									<option value="">Grau de Instrução</option>
									<?php while($dadosinstrucao = mysqli_fetch_array($resultadoinstrucao)):?>
										<option value="<?php echo $dadosinstrucao['CODIGO'];?>"><?php echo utf8_encode($dadosinstrucao['DESCRICAO']);?></option>
									<?php endwhile; ?>
								</select>
							</div>
							<div class="col-6 col-12-xsmall">
								<h5>Raça</h5>
								<select name="raca" id="raca" style="text-transform:uppercase;" required>
									<option value="">Raça</option>
									<?php while($dadosraca = mysqli_fetch_array($resultadoraca)):?>
										<option value="<?php echo $dadosraca['CODIGO'];?>"><?php echo utf8_encode($dadosraca['DESCRICAO']);?></option>
									<?php endwhile; ?>
								</select>
							</div>
							<div class="col-6 col-12-xsmall">
								<h5>Email</h5>
								<input type="text" name="email" id="email" value="" placeholder="Email" style = "text-transform:uppercase" required />
							</div>
							<div class="col-3 col-12-xsmall">
								<h5>Telefone</h5>
								<input type="text" name="telefone" id="telefone" value="" placeholder="DD 0000-0000" maxlength="12" onkeypress="$(this).mask('(00) 0000-0000')" required/>
							</div>
							<div class="col-3 col-12-xsmall">
								<h5>Celular</h5>
								<input type="text" name="celular" id="celular" value="" placeholder="DD 00000-0000" maxlength="13" onkeypress="$(this).mask('(00) 0000-00009')" required/>
							</div>



							<div class="col-12">
								<hr class="major"/>
								<h3>Filiação</h3>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Nome Mãe</h5>
								<input type="text" name="nomemae" id="nomemae" value="" placeholder="Nome Mãe" style="text-transform:uppercase" required/>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Estado civil</h5>
								<select name="estadocivilmae" id="estadocivilmae" style="text-transform:uppercase;" required>
									<option value="">Estado civil</option>
									<?php while($dadoscivil2 = mysqli_fetch_array($resultadocivil2)):?>
										<option value="<?php echo $dadoscivil2['id'];?>"><?php echo utf8_encode($dadoscivil2['descricao']);?></option>
									<?php endwhile; ?>
								</select>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>CPF</h5>
								<input type="text" name="cpfmae" id="cpfmae" value="" placeholder="CPF" maxlength="11"  style="text-transform:uppercase" onkeypress="$(this).mask('000.000.000-00');" required/>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Nome Pai</h5>
								<input type="text" name="nomepai" id="nomepai" value="" placeholder="Nome Pai" style ="text-transform:uppercase" required />
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Estado civil</h5>
								<select name="estadocivilpai" id="estadocivilpai" style="text-transform:uppercase;" required>
									<option value="">Estado civil</option>
									<?php while($dadoscivil1 = mysqli_fetch_array($resultadocivil1)):?>
										<option value="<?php echo $dadoscivil1['id'];?>"><?php echo utf8_encode($dadoscivil1['descricao']);?></option>
									<?php endwhile; ?>
								</select>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>CPF</h5>
								<input type="text" name="cpfpai" id="cpfpai" value="" placeholder="CPF" maxlength="11"  style="text-transform:uppercase" onkeypress="$(this).mask('000.000.000-00');" required/>
							</div>



							<div class="col-12">
								<hr class="major"/>
								<h3>CPF / RG &emsp;&emsp;
									<label title="Anexar PDF" style="cursor:pointer;" for="CPF_PDF" class="fas fa-paperclip" style='font-size:15px'>
									<input type="file" name="CPF_PDF" id="CPF_PDF">
										Anexo CPF
									</label>
										&emsp;&emsp;
									<label title="Anexar PDF" style="cursor:pointer;" for="RG_PDF" class="fas fa-paperclip" style='font-size:15px'>
									<input type="file" name="RG_PDF" id="RG_PDF">
										Anexo RG
									</label>
										&emsp;&emsp;
									
									<a title="Informações" href="#openModal" style="font-size: 20px; font-family: 'Lucida Grande', Verdana; font-weight: bold;"><i class="far fa-question-circle"></i></a>
									<div id="openModal" class="janela">
									<div>
										
									<a  href="#close" title="Fechar" class="close">X</a>  
									<iframe src="templates/informacao.php" frameborder="0" height="100%" width="100%" ></iframe>  
									
									</div>
									</div>
								</h3>
							</div>
							<div class="col-6 col-12-xsmall">
								<h5>CPF</h5>
								<input type="text" name="cpf" id="cpf" value="<?php echo $_SESSION['cpf'];?>" placeholder="CPF" maxlength="11" onkeypress="$(this).mask('000.000.000-00');" style="text-transform:uppercase" required/>
							</div>

							<div class="col-6 col-12-xsmall">
								<h5>RG</h5>
								<input type="text" name="rg" id="rg" value="" placeholder="RG" maxlength="10" onkeypress="$(this).mask('00.000.000-0');" style="text-transform:uppercase" required/>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Data de Emissão</h5>
								<input type="text" name="dtemissaorg" id="dtemissaorg" value="" placeholder="Data Emissão" maxlength="10" onkeypress="$(this).mask('00/00/0000')" style="text-transform:uppercase" required/>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Órgão Emissor</h5>
								<input type="text" name="orgaorg" id="orgaorg" value=""placeholder="Órgão Emissor"style="text-transform:uppercase" required />
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Estado Emissor</h5>
								<select id="estadorg" name="estadorg" style="text-transform:uppercase" required>
									<option value="">UF</option>
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
									<option value="MG">Minas Gerais</option>
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
									<option value="EX">Estrangeiro</option>
								</select>
							</div>


							<div class="col-12">
								<hr class="major"/>
								<h3>Titulo eleitoral &emsp;&emsp;
									<label title="Anexar PDF" style="cursor:pointer;" for="titulopdf" class="fas fa-paperclip" style='font-size:18px'>
										<input type="file" name="titulopdf" id="titulopdf">
										Anexo
									</label>
									&emsp;&emsp;

									<a title="Informações" href="#openModal" style="font-size: 20px; font-family: 'Lucida Grande', Verdana; font-weight: bold;"><i class="far fa-question-circle"></i></a>
									<div id="openModal" class="janela">
									<div>
										
									<a  href="#close" title="Fechar" class="close">X</a>  
									<iframe src="templates/informacao.php" frameborder="0" height="100%" width="100%" ></iframe>  
									
									</div>
									</div>
								</h3>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Número</h5>
								<input type="text" name="ntitulo" id="ntitulo" value=""placeholder="Número Título" style="text-transform:uppercase" required />
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Zona</h5>
								<input type="text" name="zona" id="zona" value="" placeholder="Zona Eleitoral" style="text-transform:uppercase" required/>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Seção</h5>
								<input type="text" name="secao" id="secao" value="" placeholder="Seção" style="text-transform:uppercase" required/>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Data Emissão</h5>
								<input type="text" name="dtemissaotitulo" id="dtemissaotitulo" value="" placeholder="Data Emissão" style="text-transform:uppercase" maxlength="10" onkeypress="$(this).mask('00/00/0000')" required/>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Estado Emissor</h5>
								<select id="estadotitulo" name="estadotitulo" style="text-transform:uppercase" required>
									<option value="">UF</option>
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
									<option value="MG">Minas Gerais</option>
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
									<option value="EX">Estrangeiro</option>
								</select>
							</div>


							<div class="col-12">
								<hr class="major"/>
								<h3>Carteira de Trabalho &emsp;&emsp;
									<label title="Anexar PDF" style="cursor:pointer;" for="ctps_pdf" class="fas fa-paperclip" style='font-size:18px'>
										<input type="file" name="ctps_pdf" id="ctps_pdf">
										Anexo
									</label>
									&emsp;&emsp;

									<a title="Informações" href="#openModal" style="font-size: 20px; font-family: 'Lucida Grande', Verdana; font-weight: bold;"><i class="far fa-question-circle"></i></a>
									<div id="openModal" class="janela">
									<div>
										
									<a  href="#close" title="Fechar" class="close">X</a>  
									<iframe src="templates/informacao.php" frameborder="0" height="100%" width="100%" ></iframe>  
									
									</div>
									</div>
								</h3>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Número</h5>
								<input type="text" name="numerocarteira" id="numerocarteira" value="" placeholder="Número" style="text-transform:uppercase" required/>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Serie</h5>
								<input type="text" name="seriecarteira" id="seriecarteira" value="" placeholder="Serie" style="text-transform:uppercase"required/>
							</div>
							<div class="col-2 col-12-xsmall">
								<h5>Data Emissão</h5>
								<input type="text" name="datacarteira" id="datacarteira" value="" placeholder="Data" style="text-transform:uppercase" maxlength="10" onkeypress="$(this).mask('00/00/0000')" required/>
							</div>
							<div class="col-2 col-12-xsmall">
								<h5>UF</h5>
								<select id="ufcarteira" name="ufcarteira" style="text-transform:uppercase" required>
									<option value="">UF</option>
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
									<option value="MG">Minas Gerais</option>
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
									<option value="EX">Estrangeiro</option>
								</select>
							</div>


							<div class="col-12">
								<hr class="major"/>
								<h3>Certificado de Alistamento Militar &emsp;&emsp;
									<label title="Anexar PDF" style="cursor:pointer;" for="militar_pdf" class="fas fa-paperclip" style='font-size:18px'>
										<input type="file" name="militar_pdf" id="militar_pdf">
										Anexo
									</label>
									&emsp;&emsp;

									<a title="Informações" href="#openModal" style="font-size: 20px; font-family: 'Lucida Grande', Verdana; font-weight: bold;"><i class="far fa-question-circle"></i></a>
									<div id="openModal" class="janela">
									<div>
										
									<a  href="#close" title="Fechar" class="close">X</a>  
									<iframe src="templates/informacao.php" frameborder="0" height="100%" width="100%" ></iframe>  
									
									</div>
									</div>
								</h3>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Número</h5>
								<input type="text" name="nmilitar" id="nmilitar" value="" placeholder="Numero" />
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Categoria</h5>
								<input type="text" name="categoriamilitar" id="categoriamilitar" value="" placeholder="Categoria" />
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>PIS</h5>
								<input type="text" name="pis" id="pis" value="" placeholder="PIS" required/>
							</div>


							<div class="col-12">
								<hr class="major"/>
								<h3>Endereço &emsp;&emsp;
									<label title="Anexar PDF" style="cursor:pointer;" for="end_pdf" class="fas fa-paperclip" style='font-size:18px' >
										<input type="file" name="end_pdf" id="end_pdf">
										Anexo
									</label>
									&emsp;&emsp;

									<a title="Informações" href="#openModal" style="font-size: 20px; font-family: 'Lucida Grande', Verdana; font-weight: bold;"><i class="far fa-question-circle"></i></a>
									<div id="openModal" class="janela">
									<div>
										
									<a  href="#close" title="Fechar" class="close">X</a>  
									<iframe src="templates/informacao.php" frameborder="0" height="100%" width="100%" ></iframe>  
									
									</div>
									</div>
								</h3>
							</div>
							<div class="col-3 col-12-xsmall">
								<h5>Cep</h5>
								<input type="text" name="cep" id="cep" value="" placeholder="CEP" maxlength="10" style="text-transform:uppercase" onblur="pesquisacep(this.value);" onkeypress="$(this).mask('00.000-000')" required />
							</div>
							<div class="col-3 col-6-xsmall">
								<h5>Tipo</h5>
								<select id="tp_rua" name="tp_rua" style="text-transform:uppercase" required>
								<option value="">TIPO</option>
									<?php while($dados_rua = mysqli_fetch_array($result_rua)):?>
										<option value="<?php echo $dados_rua['CODIGO'];?>"><?php echo utf8_encode($dados_rua['TP_RUA']);?></option>
									<?php endwhile; ?>
								</select>
							</div>
							<div class="col-6 col-12-xsmall">
								<h5>Lagradouro</h5>
								<input type="text" name="logradouro" id="logradouro" value="" placeholder="Logradouro" style="text-transform:uppercase" required/>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Número</h5>
								<input type="text" name="numero" id="numero" value="" placeholder="Numero" style="text-transform:uppercase" required />
							</div>
							<div class="col-8 col-12-xsmall">
								<h5>Complemento</h5>
								<input type="text" name="complemento" id="complemento" value="" placeholder="Complemento" style="text-transform:uppercase" required/>
							</div>
							<div class="col-2 col-6-xsmall">
								<h5>Tipo</h5>
								<select id="tp_bairro" name="tp_bairro" style="text-transform:uppercase" required>
								<option value="">TIPO</option>
								<?php while($dados_bairro = mysqli_fetch_array($result_bairro)):?>
										<option value="<?php echo $dados_bairro['CODIGO'];?>"><?php echo utf8_encode($dados_bairro['TP_BAIRRO']);?></option>
									<?php endwhile; ?>
								</select>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Bairro</h5>
								<input type="text" name="bairro" id="bairro" value="" placeholder="Bairro" style="text-transform:uppercase" required/>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Município</h5>
								<input type="text" name="municipio" id="municipio" value="" placeholder="Município" style="text-transform:uppercase" required/>
							</div>
							<div class="col-2 col-12-xsmall">
								<h5>Estado</h5>
								<select id="ufendereco" name="ufendereco" style="text-transform:uppercase" required>
									<option value="">UF</option>
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
									<option value="MG">Minas Gerais</option>
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
									<option value="EX">Estrangeiro</option>
								</select>
							</div>


							<div class="col-12">
								<hr class="major" />
								<h3>Banco</h3>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Banco</h5>
								<select name="banco" id="banco" style="text-transform:uppercase;">
									<option value="">BANCO</option>
									<?php while($dadosbanco = mysqli_fetch_array($resultabanco)):?>
										<option value="<?php echo $dadosbanco['COD'];?>"><?php echo utf8_encode($dadosbanco['BANCO']);?></option>
									<?php endwhile; ?>
								</select>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Agência</h5>
								<input type="text" name="agencia" id="agencia" value="" placeholder="ex: 0000" style="text-transform:uppercase" required/>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Digito agência</h5>
								<input type="text" name="dagencia" id="dagencia" value="" placeholder="ex: 0" style="text-transform:uppercase"required/>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Conta</h5>
								<input type="text" name="conta" id="conta" value="" placeholder="ex: 00000" style="text-transform:uppercase"required/>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Digito conta</h5>
								<input type="text" name="dconta" id="dconta" value="" placeholder="ex: 0" style="text-transform:uppercase"required/>
							</div>

							<div class="col-4 col-12-xsmall">
								<h5>Tipo de Conta</h5>
								<select id="tpconta" name="tpconta" style="text-transform:uppercase"required>
									<option value="">Tipo de Conta</option>
									<option value="1">Conta Corrente</option>
									<option value="0">Conta Poupança</option>
									<option value="2">Conta Salario</option>
								</select>
							</div>


							<div class="col-12">
								<hr class="major" />
								<h3>Outras informações</h3>
							</div>
							<div class="col-6 col-12-small">
								<h5>Deficiente</h5>
								<input type="radio" id="def1" name="deficiencia" value="SIM">
    							<label for="def1">SIM</label>
								<input type="radio" id="def2" name="deficiencia" value="NÃO">
    							<label for="def2">NÃO</label>
							</div>
							<div class="col-6 col-12-xsmall">
								<h5>Tipo de Deficiência</h5>
								<select id="tpdeficiencia" name="tpdeficiencia" style="text-transform:uppercase">
									<option value="">Tipo Deficiencia</option>
									<?php while($dadosdef = mysqli_fetch_array($result_def)):?> 
										<option value="<?php echo $dadosdef['ID_DEF'];?>"><?php echo utf8_encode($dadosdef['DESCRICAO_DEF']);?></option>
									<?php endwhile; ?>
								</select>
							</div>
							<div class="col-6 col-12-small">
								<h5>Deseja ser descontado da Contribuição sindical?</h5>
								<input type="radio" id="contrj1" name="cont_sindical_rj" value="SIM">
    							<label for="contrj1">SIM</label>
								<input type="radio" id="contrj2" name="cont_sindical_rj" value="NÃO">
    							<label for="contrj2">NÃO</label>
							</div>
							<div class="col-6 col-12-small">
								<h5>Já descontou Contribuição sindical?</h5>
								<input type="radio" id="contsp1" name="cont_sindical_sp" value="SIM">
    							<label for="contsp1">SIM</label>
								<input type="radio" id="contsp2" name="cont_sindical_sp" value="NÃO">
    							<label for="contsp2">NÃO</label>
							</div>


							<div id="dependentes" class="col-12">
								<hr class="major" />
								<h3>Dependentes</h3>
								</p><button type="button" id="add-dep">Add +</button>
              				</div>


							<div class="col-12">
								<hr class="major" />
								<h3>Beneficios</h3>
							</div>
							<div class="col-3 col-12-xsmall">
								<h5>Vale Transporte?</h5>
								<select id="vt" name="vt" style="text-transform:uppercase">
									<option value="">Vale Transporte?</option>
									<option value="0">Não</option>
									<option value="1">Sim</option>
								</select>
							</div>
							<div class="col-3 col-12-xsmall">
								<h5>Valor Diário </h5>
								<input type="text" name="valorvt" id="valorvt" value="" placeholder="Valor VT" onkeypress="$(this).mask(' #.##0,00', {reverse: true});" style="text-transform:uppercase"/>
							</div>
							<div class="col-3 col-12-xsmall">
								<h5>Operadoras e Tarifas</h5>
								<input type="text" name="operadora" id="operadora" value="" placeholder="operadora" style="text-transform:uppercase"/>
							</div>
							<div class="col-3 col-12-xsmall">
								<h5>VR ou VA?</h5>
								<select id="vavr" name="vavr" style="text-transform:uppercase">
									<option value="">VR ou VA ?</option>
									<option value="0">VR</option>
									<option value="1">VA</option>
									<option value="2">VA / VR</option>
								</select>
							</div>

							<div class="col-12">
								<hr class="major" />
								<h3>Empresa</h3>
							</div>
							<div class="col-3 col-12-xsmall">
								<h5>Seção</h5>
								<select name="secao" id="secao" style="text-transform:uppercase"; required>
								<option value="">Seção</option>
									<?php while($dados_secao = mysqli_fetch_array($result_secao)):?> 
										<option value="<?php echo $dados_secao['codigo'];?>"><?php echo utf8_encode($dados_secao['descricao']);?></option>
									<?php endwhile; ?>
								</select>
							</div>
							<div class="col-3 col-12-xsmall">
								<h5>Primeiro emprego?</h5>		
								<select id="primeiroemp" name="primeiroemp" style="text-transform:uppercase" required>	
									<option value="">Primeiro emprego?</option>
									<option value="0">Sim</option>
									<option value="1">Não</option>
								</select>
							</div>
							<div class="col-3 col-12-xsmall">
								<h5>Data de Admissão</h5>
								<input type="text" name="dtadmissao" id="dtadmissao" value="" placeholder="Admissão" maxlength="10" onkeypress="$(this).mask('00/00/0000')" style="text-transform:uppercase" required/>
							</div>
							<div class="col-3 col-12-xsmall">
								<h5>Gestor</h5>
								<input type="text" name="gestor" id="gestor" value="" placeholder="Gestor" style="text-transform:uppercase" required/>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Função</h5>
								<select name="funcao" id="funcao" style="text-transform:uppercase" required;>
								<option value="">Função</option>
									<?php while($dados_funcao = mysqli_fetch_array($result_funcao)):?> 
										<option value="<?php echo $dados_funcao['codigo'];?>"><?php echo utf8_encode($dados_funcao['descricao']);?></option>
									<?php endwhile; ?>
								</select>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Tipo de salario?</h5>		
								<select id="tpsalario" name="tpsalario" style="text-transform:uppercase" required>	
									<option value="">Tipo de salario?</option>
									<option value="D">Diarista</option>
									<option value="H">Horista</option>
									<option value="M">Mensalista</option>
									<option value="O">Outros</option>
									<option value="P">Horista (Professor)</option>
									<option value="Q">Quinzenalista</option>
									<option value="S">Semanalista</option>
									<option value="T">Tarefeiro</option>
								</select>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Salario</h5>
								<input type="text" name="salario" id="salario" value="" placeholder="Salario" onkeypress="$(this).mask('#.##0,00', {reverse: true});" style="text-transform:uppercase" required/>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Jornada</h5>		
								<input type="text" name="jornada" id="jornada" value="" placeholder="Jornada" style="text-transform:uppercase"required/>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Horarios</h5>
								<select name="tphorario" id="tphorario" style="text-transform:uppercase";required>		
								<option value="">Horarios</option>
									<?php while($dados_horario = mysqli_fetch_array($result_horario)):?> 
										<option value="<?php echo $dados_horario['codigo'];?>"><?php echo utf8_encode($dados_horario['descricao']);?></option>
									<?php endwhile; ?>
								</select>
							</div>
							<div class="col-3 col-12-xsmall">
								<h5>Matricula</h5>
								<input type="text" name="matricula" id="matricula" value="" placeholder="Matricula" style="text-transform:uppercase" required/>
							</div>
							<div class="col-3 col-12-xsmall">
								<h5>Local de prestação de Serv.</h5>
								<input type="text" name="localserve" id="localserve" value="" placeholder="Local" style="text-transform:uppercase" required/>
							</div>
							<div class="col-3 col-12-xsmall">
								<h5>Tipo de Jornada</h5>		
								<select id="tpjornada" name="tpjornada" style="text-transform:uppercase" required>	
									<option value="">Tipo de Jornada</option>
									<option value="1">Submetido a Horário de Trabalho</option>
									<option value="2">Atividade Externa</option>
									<option value="3">Confiança</option>
									<option value="4">Teletrabalho</option>
								</select>
							</div>
							<div class="col-3 col-12-xsmall">
								<h5>Forma de Contratação</h5>		
								<select id="contratacao" name="contratacao" style="text-transform:uppercase" required>	
									<option value="">Forma de Contratação</option>
									<option value="1">Experiência</option>
									<option value="2">Indeterminado</option>
									<option value="3">Determinado</option>
								</select>
							</div>
							<div class="col-3 col-12-xsmall">
								<h5>Prazo</h5>		
								<select id="prazo" name="prazo" style="text-transform:uppercase" required>	
									<option value="">Prazo</option>
									<option value="0">45+45</option>
									<option value="1">30+60</option>
								</select>
							</div>


							<p> </p>

							<div class="col-12">
								<ul class="actions">
									<li><input type="submit" value="Cadastrar" class="primary" /></li>
								</ul>
							</div>
						</div>
					</form>
			</div>
		</div>

		<!-- Sidebar -->
		<div id="sidebar">
			<div class="inner">

				<!-- Search -->
				<section id="search" class="alt">
					<form method="post" action="#">
						<input type="text" name="query" id="query" placeholder="Search" />
					</form>
				</section>

				<!-- Menu -->
				<nav id="menu">
					<header class="major">
						<h2>Menu</h2>
					</header>
					<ul>
						<li><a href="painelrh.php">Inicio</a></li>
						<li><a href="coligadarh.php">Alterar Empresa</a></li>
						<li>
							<span class="opener">Funcionarios</span>
							<ul>
								<li><a href="cadastrorh.php">Cadastrar Funcionarios</a></li>
								<li><a href="lista_func_rh.php">Listar Funcionarios</a></li>
							</ul>
						</li>

						<li>
							<span class="opener">Usuarios</span>
							<ul>
								<li><a href="cad_user_rh.php">Cadastrar Usuarios</a></li>
								<li><a href="lista_user_rh.php">Listar Usuarios</a></li>
							</ul>
						</li>

						<li>
							<span class="opener">Configurações</span>
							<ul>
								<li><a href="email.php">Email</a></li>
								<li><a href="alterarsenharh.php">Alterar senha</a></li>
							</ul>
						</li>

						<li>
							<span class="opener">Sair</span>
							<ul>
								<li><a href="fechar.php">Logout</a></li>
							</ul>
						</li>
					</ul>
				</nav>

				<!-- Section
								<section>
									<header class="major">
										<h2>Ante interdum</h2>
									</header>
									<div class="mini-posts">
										<article>
											<a href="#" class="image"><img src="images/pic07.jpg" alt="" /></a>
											<p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore aliquam.</p>
										</article>
										<article>
											<a href="#" class="image"><img src="images/pic08.jpg" alt="" /></a>
											<p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore aliquam.</p>
										</article>
										<article>
											<a href="#" class="image"><img src="images/pic09.jpg" alt="" /></a>
											<p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore aliquam.</p>
										</article>
									</div>
									<ul class="actions">
										<li><a href="#" class="button">More</a></li>
									</ul>
								</section> -->

				<!-- Section -->
				<section>
					<header class="major">
						<h2>Quality RH</h2>
					</header>
					<p>A Quality RH é uma empresa com foco estratégico em Recursos Humanos, trabalhando como extensão do
						cliente e aprimorando a gestão da Folha de Pagamento. Com expertise nos segmentos de Óleo e Gás,
						Tecnologia da Informação, Advocacia, Indústria e Empregadores Domésticos.</p>
					<ul class="contact">
						<li class="icon solid fa-envelope"><a href="#">contato@qualityrhrio.com.br</a></li>
						<li class="icon solid fa-phone">(21) 3559-3936</li>
						<li class="icon solid fa-home">
							R. Eng. Enaldo Cravo Peixoto,<br />
							215 - Sala 908 a 910 -
							<br />
							Tijuca, Rio de Janeiro - RJ, 20540-106
						</li>
					</ul>
				</section>

				<!-- Footer -->
				<footer id="footer">
					<p class="copyright">&copy; Untitled <a href="https://qualityrhrio.com.br/">Quality - RH </a></p>
				</footer>

			</div>
		</div>

	</div>

	<!-- Scripts -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/browser.min.js"></script>
	<script src="assets/js/breakpoints.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>
	<script src="assets/js/mask.js"></script>
	<script src ="assets/js/buca_cep.js"></script>
	<script>
		function previewImagem(){
			var imagem = document.querySelector('input[name=imagem]').files[0];
			var preview = document.querySelector('img');

			var reader = new FileReader();
			reader.onloadend = function() {
				preview.src = reader.result;
			}
			if(imagem){
				reader.readAsDataURL(imagem);
			} else{
				previwq.src = "";
			}

		}
	</script>

	<script>

		$("#add-dep").click(function () {
		  $.get('./templates/dependente.php', function (file) {
        var dependente = file.replace(/{{DEP}}/g, $('.dependentes').length + 1)
        $('#dependentes').append(dependente)
      })
		});
		$('body').on('click', '.dependente__del', function () {
		  var count = 0;
      $('.dependente-' + $(this).attr('data-id')).remove()
      $.each($('.dependentes .title'), function (id, el) {
        count++
        var content = $(el).html().replace(/#[0-9]/, '#' + count)
        $(el).html(content)
      })
    })
	</script>

</body>

</html>
