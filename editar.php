<?php 
session_start();
include('verifica_login.php');
include_once 'conexao.php';
include_once 'mensagem.php';
?>
<?php 
	$CPF = $_SESSION['cpf'];
	$ID = mysqli_escape_String($conexao, $_GET['id']);
	$sql = "SELECT 
				*,
				CASE WHEN FUN.ESTADOCIVIL = CIVIL.ID THEN CIVIL.descricao END AS CIVIL_DESC,
				CASE WHEN FUN.CIVILMAE = CIVILMAE.ID THEN CIVILMAE.DESCRICAO END AS CIVILMAE_DESC,
                CASE WHEN FUN.CIVILPAI = CIVILPAI.ID THEN CIVILPAI.DESCRICAO END AS CIVILPAI_DESC,
				RACA.DESCRICAO AS RACA_DESCRICAO,
				INS.DESCRICAO AS INS_DESCRICAO,
				BANC.BANCO AS BANCO_LIST,
				DEF.DESCRICAO_DEF AS DEF_DESC
			FROM 
				PFUNC FUN 
				INNER JOIN PCODNACAO NACAO ON FUN.NACIONALIDADE = NACAO.CODIGO 
				INNER JOIN ESTADOCIVIL CIVIL ON FUN.ESTADOCIVIL = CIVIL.ID
				LEFT JOIN ESTADOCIVIL CIVILMAE ON FUN.CIVILMAE = CIVILMAE.ID 
                LEFT JOIN ESTADOCIVIL CIVILPAI ON FUN.CIVILPAI = CIVILPAI.ID 
				INNER JOIN PCODINSTRUCAO INS ON FUN.GRAUINSTRUCAO = ins.CODIGO
				INNER JOIN RACA RACA ON FUN.RACA = RACA.CODIGO
				INNER JOIN BANCOS BANC ON FUN.BANCO = BANC.COD
				LEFT JOIN DTIPORUA RUA ON RUA.CODIGO = FUN.TIPORUA
				LEFT JOIN DTIPOBAIRRO BAIRRO ON BAIRRO.CODIGO = FUN.TIPOBAIRRO
				INNER JOIN DEFICIENCIA DEF ON FUN.TP_DEFICIENCIA = DEF.ID_DEF
			WHERE FUN.CPF ='{$CPF}' OR FUN.ID = '{$ID}'";
	$resultado_usuario = mysqli_query($conexao,$sql);
	$row_usuario = mysqli_fetch_assoc($resultado_usuario);

	$sqlnacao = "SELECT codigo,nacao FROM pcodnacao order by nacao";
	$resultadonacao = mysqli_query($conexao, $sqlnacao);

	$sqlcivil = "SELECT id,descricao FROM estadocivil";
	$resultadocivil = mysqli_query($conexao, $sqlcivil);

	$sqlcivil1 = "SELECT id,descricao FROM estadocivil";
	$resultadocivil1 = mysqli_query($conexao, $sqlcivil1);

	$sqlcivil2 = "SELECT id,descricao FROM estadocivil";
	$resultadocivil2 = mysqli_query($conexao, $sqlcivil2);
	
	$sqlinstrucao = "SELECT CODIGO, DESCRICAO FROM pcodinstrucao";
	$resultadoinstrucao = mysqli_query($conexao, $sqlinstrucao);

	$sqlraca = "SELECT CODIGO, DESCRICAO FROM raca";
	$resultadoraca= mysqli_query($conexao, $sqlraca);

	$sqlbanco = "SELECT COD, BANCO FROM BANCOS";
	$resultabanco= mysqli_query($conexao, $sqlbanco);

	$sqldef = "SELECT ID_DEF, DESCRICAO_DEF FROM DEFICIENCIA";
	$result_def= mysqli_query($conexao, $sqldef);

	$sqlrua = "SELECT * FROM DTIPORUA";
	$result_rua= mysqli_query($conexao, $sqlrua);

	$sqlbairro = "SELECT * FROM DTIPOBAIRRO";
	$result_bairro= mysqli_query($conexao, $sqlbairro);

	$sqldep ="SELECT ID_DEP,DEP.NOME_DEP,DTNASC_DEP,PARENTESCO,CPF_DEP,IR_DEP,MAE_DEP FROM PFDEPEND DEP 
				INNER JOIN PPESSOA PES ON PES.CODCOLIGADA = DEP.CODCOLIGADA AND PES.MATRICULA = DEP.ID_FUNC
				INNER JOIN PFUNC FUN ON FUN.CODCOLIGADA = PES.CODCOLIGADA AND FUN.ID = PES.ID
			WHERE FUN.CPF = '{$CPF}' OR FUN.ID = '{$ID}'";
	$result_dep = mysqli_query($conexao, $sqldep);
	
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

					<form method="post" action="update.php" enctype="multipart/form-data">
						<div class="logo">
							<h3>Identificação</h3>
							<img src="<?php echo $row_usuario['FOTO_PERFIL'];?>" style="height: 150px; width: 155px;"><br>
							<label style="text-align: center" id="teste" for='imagem'>Foto</label>
							<input type="file" name="imagem" id="imagem" onchange="previewImagem()" ><br>
						</div>
						

						<div class="row gtr-uniform">
							<div class="col-6 col-12-xsmall">
								<h5>Nome</h5>
								<input type="text" name="nome" id="nome" value="<?php echo utf8_encode($row_usuario['NOME']);?>" required/>
							</div>
							<div class="col-6 col-12-xsmall">
								<h5>Data nascimento</h5>
								
								<input type="text" name="dtnasc" id="dtnasc" value="<?php echo date("d/m/Y", strtotime($row_usuario['DTNASC']));?>" placeholder="Data nascimento" maxlength="10" onkeypress="$(this).mask('00/00/0000')" style="text-transform:uppercase;" required/>
							</div>
							<div class="col-6 col-12-xsmall">
								<h5>Naturalidade</h5>	
								<input type="text" name="naturalidade" id="naturalidade" value="<?php echo utf8_encode($row_usuario['NATURALIDADE']);?>" placeholder="naturalidade" style="text-transform:uppercase;" required/>
							</div>
							<div class="col-6 col-12-xsmall">
								<h5>Nacionalidade</h5>
								<select name="nacionalidade" id="nacionalidade" style="text-transform:uppercase" required>
								<option value="<?php echo $row_usuario['NACIONALIDADE'];?>"><?php echo utf8_encode($row_usuario['nacao']);?></option>
									<?php while($dadosnacao = mysqli_fetch_array($resultadonacao)):?> 
										<option value="<?php echo $dadosnacao['codigo'];?>"><?php echo utf8_encode($dadosnacao['nacao']);?></option>
									<?php endwhile; ?>
								  </select>
							</div>
							<div class="col-6 col-12-xsmall">
								<h5>Estado civil</h5>
								<select name="estadocivil" id="estadocivil" style="text-transform:uppercase;"required>
									<option value="<?php echo $row_usuario['ESTADOCIVIL'];?>"><?php echo utf8_encode($row_usuario['CIVIL_DESC']);?></option>
									<?php while($dadoscivil = mysqli_fetch_array($resultadocivil)):?> 
										<option value="<?php echo $dadoscivil['id'];?>"><?php echo utf8_encode($dadoscivil['descricao']);?></option>
									<?php endwhile; ?>
								</select>
							</div>
							<div class="col-6 col-12-xsmall">
								<h5>Sexo</h5>
									<select name="sexo" id="sexo" style="text-transform:uppercase;" required>	
									<option value="<?php echo $row_usuario['SEXO'];?>"><?php $i=$row_usuario['SEXO']; if($i == 1) { echo "MASCULINO";} elseif ($i == 2) { echo "FEMININO";}?></option>
									<option value="1">Masculino</option>
									<option value="2">Feminino</option>
								</select>
							</div>
							<div class="col-6 col-12-xsmall">
								<h5>Grau de Instrução</h5>
								<select name="grauinstrucao" id="grauinstrucao" style="text-transform:uppercase;" required>
									<option value="<?php echo $row_usuario['GRAUINSTRUCAO'];?>"><?php echo utf8_encode($row_usuario['INS_DESCRICAO']);?></option>
									<?php while($dadosinstrucao = mysqli_fetch_array($resultadoinstrucao)):?> 
										<option value="<?php echo $dadosinstrucao['CODIGO'];?>"><?php echo utf8_encode($dadosinstrucao['DESCRICAO']);?></option>
									<?php endwhile; ?>
								</select>
							</div>
							<div class="col-6 col-12-xsmall">
								<h5>Raça</h5>
								<select name="raca" id="raca" style="text-transform:uppercase;" required>
									<option value="<?php echo $row_usuario['RACA'];?>"><?php echo utf8_encode($row_usuario['RACA_DESCRICAO']);?></option>
									<?php while($dadosraca = mysqli_fetch_array($resultadoraca)):?> 
										<option value="<?php echo $dadosraca['CODIGO'];?>"><?php echo utf8_encode($dadosraca['DESCRICAO']);?></option>
									<?php endwhile; ?>
								</select>
							</div>
							<div class="col-6 col-12-xsmall">
								<h5>Email</h5>
								<input type="text" name="email" id="email" value="<?php echo utf8_encode($row_usuario['EMAIL']);?>" placeholder="Email" style = "text-transform:uppercase" required />
							</div>
							<div class="col-3 col-12-xsmall">
								<h5>Telefone</h5>
								<input type="text" name="telefone" id="telefone" value="<?php echo $row_usuario['TELEFONE'];?>" placeholder="DD 0000-0000" maxlength="12" onkeypress="$(this).mask('(00) 0000-0000')" required />
							</div>
							<div class="col-3 col-12-xsmall">
								<h5>Celular</h5>
								<input type="text" name="celular" id="celular" value="<?php echo $row_usuario['CELULAR'];?>" placeholder="DD 00000-0000" maxlength="13" onkeypress="$(this).mask('(00) 0000-00009')" required />
							</div>


							<div class="col-12">
								<hr class="major"/>
								<h3>Filiação</h3>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Nome Mãe</h5>
								<input type="text" name="nomemae" id="nomemae" value="<?php echo $row_usuario['NOMEMAE'];?>" placeholder="Nome Mãe" style="text-transform:uppercase" required/>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Estado civil</h5>
								<select name="estadocivilmae" id="estadocivilmae" style="text-transform:uppercase;" required>
									<option value="<?php echo $row_usuario['CIVILMAE'];?>"><?php echo utf8_encode($row_usuario['CIVILMAE_DESC']);?></option>
									<?php while($dadoscivil2 = mysqli_fetch_array($resultadocivil2)):?>
										<option value="<?php echo $dadoscivil2['id'];?>"><?php echo utf8_encode($dadoscivil2['descricao']);?></option>
									<?php endwhile; ?>
								</select>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>CPF</h5>
								<input type="text" name="cpfmae" id="cpfmae" value="<?php echo $row_usuario['CPFMAE'];?>" placeholder="CPF" maxlength="11"  style="text-transform:uppercase" onkeypress="$(this).mask('000.000.000-00');" required/>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Nome Pai</h5>
								<input type="text" name="nomepai" id="nomepai" value="<?php echo $row_usuario['NOMEPAI'];?>" placeholder="Nome Pai" style ="text-transform:uppercase" required />
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Estado civil</h5>
								<select name="estadocivilpai" id="estadocivilpai" style="text-transform:uppercase;" required>
									<option value="<?php echo $row_usuario['CIVILPAI'];?>"><?php echo utf8_encode($row_usuario['CIVILPAI_DESC']);?></option>
									<?php while($dadoscivil1 = mysqli_fetch_array($resultadocivil1)):?>
										<option value="<?php echo $dadoscivil1['id'];?>"><?php echo utf8_encode($dadoscivil1['descricao']);?></option>
									<?php endwhile; ?>
								</select>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>CPF</h5>
								<input type="text" name="cpfpai" id="cpfpai" value="<?php echo $row_usuario['CPFPAI'];?>" placeholder="CPF" maxlength="11"  style="text-transform:uppercase" onkeypress="$(this).mask('000.000.000-00');" required/>
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
								<input type="text" name="cpf" id="cpf" value="<?php echo $row_usuario['CPF'];?>" placeholder="CPF" maxlength="11"  style="text-transform:uppercase" onkeypress="$(this).mask('000.000.000-00');" required/>
							</div>
							
							<div class="col-6 col-12-xsmall">
								<h5>RG</h5>
								<input type="text" name="rg" id="rg" value="<?php echo $row_usuario['RG'];?>" placeholder="RG" maxlength="10" onkeypress="$(this).mask('00.000.000-0');" style="text-transform:uppercase" required/>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Data de Emissão</h5>
								<input type="text" name="dtemissaorg" id="dtemissaorg" value="<?php echo date("d/m/Y", strtotime($row_usuario['DTEMISSAORG']));?>" placeholder="Data Emissão" maxlength="10" onkeypress="$(this).mask('00/00/0000')" style="text-transform:uppercase"/ required>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Órgão Emissor</h5>
								<input type="text" name="orgaorg" id="orgaorg" value="<?php echo $row_usuario['ORGAORG'];?>" placeholder="Órgão Emissor"style="text-transform:uppercase" required/>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Estado Emissor</h5>
								<select id="estadorg" name="estadorg" style="text-transform:uppercase" required>
									<option value="<?php echo $row_usuario['ESTADORG'];?>"><?php echo $row_usuario['ESTADORG'];?></option>
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
								<input type="text" name="ntitulo" id="ntitulo" value="<?php echo $row_usuario['TITULO'];?>" placeholder="Número Título" style="text-transform:uppercase" required />
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Zona</h5>
								<input type="text" name="zona" id="zona" value="<?php echo $row_usuario['ZONA'];?>" placeholder="Zona Eleitoral" style="text-transform:uppercase" required/>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Seção</h5>
								<input type="text" name="secao" id="secao" value="<?php echo $row_usuario['SECAO'];?>" placeholder="Seção" style="text-transform:uppercase" required/>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Data Emissão</h5>
								<input type="text" name="dtemissaotitulo" id="dtemissaotitulo" value="<?php echo date("d/m/Y", strtotime($row_usuario['DTEMISSAOTITULO']));?>" placeholder="Data Emissão" style="text-transform:uppercase" maxlength="10" onkeypress="$(this).mask('00/00/0000')" required/>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Estado Emissor</h5>
								<select id="estadotitulo" name="estadotitulo" style="text-transform:uppercase" required>
									<option value="<?php echo $row_usuario['ESTADOTITULO'];?>"><?php echo $row_usuario['ESTADOTITULO'];?></option>
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
								<input type="text" name="numerocarteira" id="numerocarteira" value="<?php echo $row_usuario['NUMEROCARTEIRA'];?>" placeholder="Número" style="text-transform:uppercase" required/>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Serie</h5>	
								<input type="text" name="seriecarteira" id="seriecarteira" value="<?php echo $row_usuario['SERIECARTEIRA'];?>" placeholder="Serie" style="text-transform:uppercase" required/>
							</div>
							<div class="col-2 col-12-xsmall">
								<h5>Data Emissão</h5>
								<input type="text" name="datacarteira" id="datacarteira" value="<?php echo date("d/m/Y", strtotime($row_usuario['DTEMISSAOCTPS']));?>" placeholder="Data" style="text-transform:uppercase" maxlength="10" onkeypress="$(this).mask('00/00/0000')" required/>
							</div>
							<div class="col-2 col-12-xsmall">
								<h5>UF</h5>
								<select id="ufcarteira" name="ufcarteira" style="text-transform:uppercase">
									<option value="<?php echo $row_usuario['ESTADOCTPS'];?>"><?php echo $row_usuario['ESTADOCTPS'];?></option>
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
								<input type="text" name="nmilitar" id="nmilitar" value="<?php echo $row_usuario['ALISTAMENTO'];?>" placeholder="Numero" required/>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Categoria</h5>
								<input type="text" name="categoriamilitar" id="categoriamilitar" value="<?php echo $row_usuario['CATEGORIAMILITAR'];?>" placeholder="Categoria" required/>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>PIS</h5>
								<input type="text" name="pis" id="pis" value="<?php echo $row_usuario['PIS'];?>" placeholder="PIS" required/>
							</div>


							<div class="col-12">
								<hr class="major"/>
								<h3>Endereço &emsp;&emsp;
									<label title="Anexar PDF" style="cursor:pointer;" for="end_pdf" class="fas fa-paperclip" style='font-size:18px'>
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
								<input type="text" name="cep" id="cep" value="<?php echo $row_usuario['CEP'];?>" placeholder="CEP" maxlength="10" style="text-transform:uppercase" onblur="pesquisacep(this.value);" onkeypress="$(this).mask('00.000-000')"required/>
							</div>
							<div class="col-3 col-6-xsmall">
								<h5>Tipo</h5>
								<select id="tp_rua" name="tp_rua" style="text-transform:uppercase" required>
								<option value="<?php echo $row_usuario['TIPORUA'];?>"><?php echo $row_usuario['TP_RUA'];?></option>
									<?php while($dados_rua = mysqli_fetch_array($result_rua)):?>
										<option value="<?php echo $dados_rua['CODIGO'];?>"><?php echo utf8_encode($dados_rua['TP_RUA']);?></option>
									<?php endwhile; ?>
								</select>
							</div>
							<div class="col-6 col-12-xsmall">
								<h5>Lagradouro</h5>
								<input type="text" name="logradouro" id="logradouro" value="<?php echo utf8_encode($row_usuario['LOGRADOURO']);?>" placeholder="Logradouro" style="text-transform:uppercase" required/>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Número</h5>
								<input type="text" name="numero" id="numero" value="<?php echo $row_usuario['NUMERO'];?>" placeholder="Numero" style="text-transform:uppercase" required />
							</div>
							<div class="col-8 col-12-xsmall">
								<h5>Complemento</h5>
								<input type="text" name="complemento" id="complemento" value="<?php echo utf8_encode($row_usuario['COMPLEMENTO']);?>" placeholder="Complemento" style="text-transform:uppercase" required/>
							</div>
							<div class="col-2 col-6-xsmall">
								<h5>Tipo</h5>
								<select id="tp_bairro" name="tp_bairro" style="text-transform:uppercase" required>
								<option value="<?php echo $row_usuario['TIPOBAIRRO'];?>"><?php echo $row_usuario['TP_BAIRRO'];?></option>
								<?php while($dados_bairro = mysqli_fetch_array($result_bairro)):?>
										<option value="<?php echo $dados_bairro['CODIGO'];?>"><?php echo utf8_encode($dados_bairro['TP_BAIRRO']);?></option>
									<?php endwhile; ?>
								</select>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Bairro</h5>
								<input type="text" name="bairro" id="bairro" value="<?php echo utf8_encode($row_usuario['BAIRRO']);?>" placeholder="Bairro" style="text-transform:uppercase" required />
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Município</h5>
								<input type="text" name="municipio" id="municipio" value="<?php echo utf8_encode($row_usuario['MUNICIPIO']);?>" placeholder="Município" style="text-transform:uppercase" required/>
							</div>
							<div class="col-2 col-12-xsmall">
								<h5>Estado</h5>
								<select id="ufendereco" name="ufendereco" style="text-transform:uppercase" required>
									<option value="<?php echo $row_usuario['ESTADO'];?>"><?php echo $row_usuario['ESTADO'];?></option>
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
								<select name="banco" id="banco" style="text-transform:uppercase;" required>
									<option value="<?php echo $row_usuario['BANCO'];?>"><?php echo utf8_encode($row_usuario['BANCO_LIST']);?></option>
									<?php while($dadosbanco = mysqli_fetch_array($resultabanco)):?> 
										<option value="<?php echo $dadosbanco['COD'];?>"><?php echo utf8_encode($dadosbanco['BANCO']);?></option>
									<?php endwhile; ?>
								</select>		
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Agência</h5>
								<input type="text" name="agencia" id="agencia" value="<?php echo $row_usuario['AGENCIA'];?>" placeholder="ex: 0000" style="text-transform:uppercase" required/>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Digito agência</h5>
								<input type="text" name="dagencia" id="dagencia" value="<?php echo $row_usuario['DAGENCIA'];?>" placeholder="ex: 0" style="text-transform:uppercase" required/>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Conta</h5>
								<input type="text" name="conta" id="conta" value="<?php echo $row_usuario['CONTA'];?>" placeholder="ex: 00000" style="text-transform:uppercase" required/>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Digito conta</h5>
								<input type="text" name="dconta" id="dconta" value="<?php echo $row_usuario['DCONTA'];?>" placeholder="ex: 0" style="text-transform:uppercase" required/>
							</div>
							<div class="col-4 col-12-xsmall">
								<h5>Tipo de Conta</h5>
								<select id="tpconta" name="tpconta" style="text-transform:uppercase" required>	
									<option value="<?php echo $row_usuario['TP_CONTA'];?>"><?php $TP_C=$row_usuario['TP_CONTA']; switch ($TP_C) { case 0: echo "CONTA POUPANÇA";break;  case 1: echo "CONTA CORRENTE";break;  case 2: echo "CONTA SALÁRIO";break; } ?></option>
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
								<input type="radio" id="def1" name="deficiencia" value="SIM" <?php echo (utf8_encode($row_usuario['DEFICIENCIA']) == "SIM") ? "checked" : null; ?> >
    							<label for="def1">SIM</label>
								<input type="radio" id="def2" name="deficiencia" value="NÃO" <?php echo (utf8_encode($row_usuario['DEFICIENCIA']) == "NÃO") ? "checked" : null; ?> >
    							<label for="def2">NÃO</label>
							</div>
							<div class="col-6 col-12-xsmall">
								<h5>Tipo de Deficiência</h5>
								<select id="tpdeficiencia" name="tpdeficiencia" style="text-transform:uppercase">
									<option value="<?php echo $row_usuario['TP_DEFICIENCIA'];?>"><?php echo utf8_encode($row_usuario['DEF_DESC']);?></option>
									<?php while($dadosdef = mysqli_fetch_array($result_def)):?> 
										<option value="<?php echo $dadosdef['ID_DEF'];?>"><?php echo utf8_encode($dadosdef['DESCRICAO_DEF']);?></option>
									<?php endwhile; ?>
								</select>
							</div>
							<div class="col-6 col-12-small">
								<p>Deseja ser descontado da Contribuição sindical?</p>
								<input type="radio" id="contrj1" name="cont_sindical_rj" value="SIM" <?php echo (utf8_encode($row_usuario['CONT_SIND1']) == "SIM") ? "checked" : null; ?> >
    							<label for="contrj1">SIM</label>
								<input type="radio" id="contrj2" name="cont_sindical_rj" value="NÃO" <?php echo (utf8_encode($row_usuario['CONT_SIND1']) == "NÃO") ? "checked" : null; ?> >
    							<label for="contrj2">NÃO</label>
							</div>
							<div class="col-6 col-12-small">
								<p>Já descontou Contribuição sindical?</p>
								<input type="radio" id="contsp1" name="cont_sindical_sp" value="SIM" <?php echo (utf8_encode($row_usuario['CONT_SIND2']) == "SIM") ? "checked" : null; ?> >
    							<label for="contsp1">SIM</label>
								<input type="radio" id="contsp2" name="cont_sindical_sp" value="NÃO" <?php echo (utf8_encode($row_usuario['CONT_SIND2']) == "NÃO") ? "checked" : null; ?> >
    							<label for="contsp2">NÃO</label>
							</div>

							<div id="dependentes" class="col-12">
								<hr class="major" />
								<h3>Dependentes</h3>
								</p><button type="button" id="add-dep">Add +</button>
              				</div>

							<?php while($dadosdep = mysqli_fetch_array($result_dep)):?> 
								<div class="col-12 col-12-xsmall">
								<hr>
								<strong>DEPENDENTE
								<?php echo $dadosdep['ID_DEP']+1;?></strong>
								
								<a href = "delete_dep.php?id=<?php echo $dadosdep['ID_DEP'];?>&ID_USER=<?php echo $row_usuario['ID'];?>">
								<i class="fas fa-trash dependente__del"></i></a>
								
								</div>
									<div class="col-4 col-12-xsmall" id="nometeste">
										<h5>Nome Completo</h5>
										<input type="text" name="nomedep[]" id="nomedep[]" value="<?php echo $dadosdep['NOME_DEP'];?>" placeholder="Nome" style="text-transform:uppercase"/>
									</div>
									<div class="col-4 col-12-xsmall" id="datanascimentoteste">
										<h5>Data Nascimento </h5>
										<input type="text" name="dtnascdep[]" id="dtnascdep[]" value="<?php echo date("d/m/Y", strtotime($dadosdep['DTNASC_DEP']));?>" placeholder="Data" style="text-transform:uppercase" maxlength="10" onkeypress="$(this).mask('00/00/0000')"/>
									</div>
									<div class="col-4 col-12-xsmall">
										<h5>Parentesco</h5>
										<select id="parentescodep[]" name="parentescodep[]" style="text-transform:uppercase">
										<option value="">Parentesco</option>
										<option value="0">Filho(a)</option>
										<option value="1">Pai</option>
										<option value="2">Mãe</option>
										<option value="3">Outros</option>
										</select>
									</div>
									<div class="col-4 col-12-xsmall">
										<h5>CPF</h5>
										<input type="text" name="cpfdep[]" id="cpfdep[]" value="<?php echo $dadosdep['CPF_DEP'];?>" placeholder="CPF" maxlength="14" onkeypress="$(this).mask('000.000.000-00');" style="text-transform:uppercase"/>
									</div>
									<div class="col-4 col-12-xsmall">
										<h5>I.R</h5>
										<select id="irdep[]" name="irdep[]" style="text-transform:uppercase">
										<option value="<?php echo $dadosdep['IR_DEP'];?>"><?php $DEP=$dadosdep['IR_DEP']; switch ($TP_C) { case 0: echo "NÃO";break;  case 1: echo "SIM";break;}?></option>
										<option value="0">Não</option>
										<option value="1">Sim</option>
										</select>
									</div>
									<div class="col-4 col-12-xsmall">
										<h5>Mãe do Dependente</h5>
										<input type="text" name="maedep[]" id="maedep[]" value="<?php echo $dadosdep['MAE_DEP'];?>" placeholder="Nome" style="text-transform:uppercase"/>
									</div>
							<?php endwhile;?>
								
							<div class="col-12">
								<hr class="major" />
								<h3>Beneficios</h3>
							</div>
							<div class="col-3 col-12-xsmall">
								<h5>Vale Transporte?</h5>
								<select id="vt" name="vt" style="text-transform:uppercase">
									<option value="<?php echo $row_usuario['VT']?>"> <?php $result_VT=$row_usuario['VT']; if($result_VT == "0") {echo "NÃO";} if ($result_VT == "1") {echo "SIM";}?> </option>
									<option value="0">Não</option>
									<option value="1">Sim</option>
								</select>
							</div>
							<div class="col-3 col-12-xsmall">
								<h5>Valor Diário</h5>
								<input type="text" name="valorvt" id="valorvt" value="<?php echo number_format($row_usuario['VALORVT'],2,',','.' );?>" placeholder="Valor VT" onkeypress="$(this).mask(' #.##0,00', {reverse: true});" style="text-transform:uppercase"/>
							</div>
							<div class="col-3 col-12-xsmall">
								<h5>Operadoras e Tarifas</h5>
								<input type="text" name="operadora" id="operadora" value="<?php echo $row_usuario['TARIFAOPERADORA']?>" placeholder="operadora" style="text-transform:uppercase"/>
							</div>
							<div class="col-3 col-12-xsmall">
								<h5>VR ou VA?</h5>
								<select id="vavr" name="vavr" style="text-transform:uppercase">
									<option value="<?php echo $row_usuario['VAVR']?>"> <?php $result_VAVR=$row_usuario['VAVR']; if($result_VAVR == "0") {echo "VR";} if ($result_VAVR == "1") {echo "VA";} if ($result_VAVR == "2") {echo "VA / VR";}?> </option>
									<option value="0">VR</option>
									<option value="1">VA</option>
									<option value="2">VA / VR</option>
								</select>
							</div>



							<p> </p>
							<div class="col-12">
								<ul class="actions">
									<li><input type="submit" name = "Atualizar" value="Atualizar Dados" class="primary" /></li>
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
						<li><a href="painel.php">Inicio</a></li>
						<li><a href="lista_func.php">Alterar dados</a></li>
						<li><a href="senha_user.php">Alterar senha</a></li>
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
	<script src ="assets/js/buca_cep.js"></script>
	<script src="assets/js/mask.js"></script>
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