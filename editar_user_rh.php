<?php 
session_start();
include('verifica_login.php');
include('verifica_acesso_USER.php');
include_once 'conexao.php';
include_once 'mensagem.php';

$CODCOLIGADA = $_SESSION['coligada'];
$ID = mysqli_escape_String($conexao, $_GET['id']);

$sqlsecao = "SELECT codigo,descricao FROM psecao where codcoligada = '$CODCOLIGADA'";
$result_secao = mysqli_query($conexao, $sqlsecao);

$sqlfuncao = "SELECT codigo,descricao FROM pfuncao where codcoligada = '$CODCOLIGADA'";
$result_funcao = mysqli_query($conexao, $sqlfuncao);

$sqlhorario = "SELECT codigo,descricao FROM AHORARIO where codcoligada = '$CODCOLIGADA'";
$result_horario = mysqli_query($conexao, $sqlhorario);

$sql = "SELECT 
			*,
			SEC.DESCRICAO AS DES_SEC,
			HR.DESCRICAO AS DES_HR,
			FUN.DESCRICAO AS FUN_DESC,
			CASE WHEN TPSALARIO = 'D' THEN 'Diarista'
				 WHEN TPSALARIO = 'H' THEN 'Horista'
				 WHEN TPSALARIO = 'M' THEN 'Mensalista'
				 WHEN TPSALARIO = 'O' THEN 'Outros'
				 WHEN TPSALARIO = 'P' THEN 'Horista (Professor)'
				 WHEN TPSALARIO = 'Q' THEN 'Quinzenalista'
				 WHEN TPSALARIO = 'S' THEN 'Semanalista'
				 WHEN TPSALARIO = 'T' THEN 'Tarefeiro' END AS TP_SAL,
			
			CASE WHEN TPJORNADA = '1' THEN 'Submetido a Horário de Trabalho'
				 WHEN TPJORNADA = '2' THEN 'Atividade Externa'
				 WHEN TPJORNADA = '3' THEN 'Confiança'
				 WHEN TPJORNADA = '4' THEN 'Teletrabalho' END AS TPJORNADA_DESC,

			CASE WHEN CONTRATACAO = '1' THEN 'Experiência'
				 WHEN CONTRATACAO = '2' THEN 'Indeterminado'
				 WHEN CONTRATACAO = '3' THEN 'Determinado' END AS DESC_CONTRATACAO

		FROM
			PPESSOA PES 
			LEFT JOIN PSECAO SEC ON SEC.CODIGO = PES.CODSECAO AND SEC.CODCOLIGADA = PES.CODCOLIGADA
			LEFT JOIN PFUNCAO FUN ON FUN.CODIGO = PES.CODFUNCAO AND FUN.CODCOLIGADA = PES.CODCOLIGADA
			LEFT JOIN AHORARIO HR ON HR.CODIGO = PES.HORARIOS AND HR.CODCOLIGADA = PES.CODCOLIGADA
		WHERE 
			PES.ID = $ID AND PES.CODCOLIGADA = $CODCOLIGADA";
$result_pessoa = mysqli_query($conexao, $sql);
$row_usuario = mysqli_fetch_assoc($result_pessoa);

?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Quality - RH</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header">
									<a href="#" class="logo"><strong>Seja</strong> bem vindo</a>
									<ul class="icons">
										<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
										<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
										<li><a href="#" class="icon brands fa-snapchat-ghost"><span class="label">Snapchat</span></a></li>
										<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
										
									</ul>
								</header>
								<br>
								<a title="VOLTAR" href ="lista_user_rh.php" ><i class="fas fa-angle-double-left"></i></a>
								
								<section>
                                    <form method="post" action="processa_editar_user_rh.php" enctype="multipart/form-data">
									
										<div class="logo">
											<h3>Editar Usuário</h3>
                                        </div>
                                        <div class="row gtr-uniform">
                                            <div class="col-4 col-12-xsmall">
                                                <h5>Usuário</h5>
                                                <input type="text" name="usuario" id="usuario" value="<?php echo $row_usuario['USUARIO'];?>" placeholder="Usuário" style="text-transform:uppercase;" required/>
                                            </div>
											<div class="col-4 col-12-xsmall">
                                                <h5>Primeiro Nome</h5>
                                                <input type="text" name="nomeusuario" id="nomeusuario" value="<?php echo $row_usuario['PRIMEIRONOME'];?>" placeholder="Primeiro Nome" style="text-transform:uppercase;" required/>
                                            </div>
                                            <div class="col-4 col-12-xsmall">
												<h5>CPF</h5>
												<input type="hidden" value="<?php echo $ID;?>" name="id" id="id">
                                                <input type="text" name="cpf" id="cpf" value="<?php echo $row_usuario['CPF'];?>" placeholder="CPF" maxlength="14" onkeypress="$(this).mask('000.000.000-00');"  style="text-transform:uppercase" required />
                                            </div>

                                            <div class="col-4 col-12-xsmall">
                                                <h5>Senha</h5>
                                                <input type="password" name="password" id="password" value="<?php echo $row_usuario['SENHA'];?>" placeholder="Senha" style ="text-transform:uppercase"required />
                                            </div>
                                            <div class="col-4 col-12-xsmall">
                                                <h5>Email</h5>
                                                <input type="text" name="email" id="email" value="<?php echo $row_usuario['EMAIL'];?>" placeholder="Email" style = "text-transform:uppercase"required />
                                            </div>
											<div class="col-4 col-12-xsmall">
                                                <h5>Data limite de acesso</h5>
                                                <input type="text" name="datalimite" id="datalimite" value="<?php echo date("d/m/Y", strtotime($row_usuario['DATALIMITE']));?>" placeholder="Data" onkeypress="$(this).mask('00/00/0000')" style = "text-transform:uppercase" required />
                                            </div>
											
											<div class="col-12">
												<hr class="major" />
												<h3>Empresa</h3>
											</div>
											<div class="col-3 col-12-xsmall">
												<h5>Seção</h5>
												<select name="secao" id="secao" style="text-transform:uppercase"; required>
												<option value="<?php echo $row_usuario['CODSECAO'];?>"> <?php echo $row_usuario['DES_SEC'];?> </option>
													<?php while($dados_secao = mysqli_fetch_array($result_secao)):?> 
														<option value="<?php echo $dados_secao['codigo'];?>"><?php echo utf8_encode($dados_secao['descricao']);?></option>
													<?php endwhile; ?>
												</select>
											</div>
											<div class="col-3 col-12-xsmall">
												<h5>Primeiro emprego?</h5>		
												<select id="primeiroemp" name="primeiroemp" style="text-transform:uppercase" required>	
													<option value="<?php echo $row_usuario['PRIMEIROEMP'];?>"><?php $i=$row_usuario['PRIMEIROEMP']; if($i == 0) { echo "SIM";} elseif($i == 1) { echo "NÃO";};?></option>
													<option value="0">Sim</option>
													<option value="1">Não</option>
												</select>
											</div>
											<div class="col-3 col-12-xsmall">
												<h5>Data de Admissão</h5>
												<input type="text" name="dtadmissao" id="dtadmissao" value="<?php echo date("d/m/Y", strtotime($row_usuario['DTADMISSAO']));?>" placeholder="Admissão" maxlength="10" onkeypress="$(this).mask('00/00/0000')" style="text-transform:uppercase" required/>
											</div>
											<div class="col-3 col-12-xsmall">
												<h5>Gestor</h5>
												<input type="text" name="gestor" id="gestor" value="<?php echo $row_usuario['GESTOR'];?>" placeholder="Gestor" style="text-transform:uppercase" required/>
											</div>
											<div class="col-4 col-12-xsmall">
												<h5>Função</h5>
												<select name="funcao" id="funcao" style="text-transform:uppercase"; required>
												<option value="<?php echo $row_usuario['CODFUNCAO'];?>"><?php echo utf8_encode($row_usuario['FUN_DESC']);?></option>
													<?php while($dados_funcao = mysqli_fetch_array($result_funcao)):?> 
														<option value="<?php echo $dados_funcao['codigo'];?>"><?php echo utf8_encode($dados_funcao['descricao']);?></option>
													<?php endwhile; ?>
												</select>
											</div>
											<div class="col-4 col-12-xsmall">
												<h5>Tipo de salario?</h5>		
												<select id="tpsalario" name="tpsalario" style="text-transform:uppercase" required>	
													<option value="<?php echo $row_usuario['TPSALARIO'];?>"><?php echo $row_usuario['TP_SAL'];?></option>
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
												<input type="text" name="salario" id="salario" value="<?php echo number_format($row_usuario['SALARIO'],2,',','.' )?>" placeholder="Salario" onkeypress="$(this).mask('#.##0,00', {reverse: true});" style="text-transform:uppercase" required/>
											</div>
											<div class="col-4 col-12-xsmall">
												<h5>Jornada</h5>		
												<input type="text" name="jornada" id="jornada" value="<?php echo $row_usuario['JORNADA'];?>" placeholder="Jornada" style="text-transform:uppercase" required/>
											</div>
											<div class="col-4 col-12-xsmall">
												<h5>Horarios</h5>
												<select name="tphorario" id="tphorario" style="text-transform:uppercase"; required>		
												<option value="<?php echo $row_usuario['HORARIOS'];?>"><?php echo utf8_encode($row_usuario['DES_HR']);?></option>
													<?php while($dados_horario = mysqli_fetch_array($result_horario)):?> 
														<option value="<?php echo $dados_horario['codigo'];?>"><?php echo utf8_encode($dados_horario['descricao']);?></option>
													<?php endwhile; ?>
												</select>
											</div>
											<div class="col-3 col-12-xsmall">
												<h5>Matricula</h5>
												<input type="text" name="matricula" id="matricula" value="<?php echo $row_usuario['MATRICULA'];?>" placeholder="Matricula" style="text-transform:uppercase"required/>
											</div>
											<div class="col-3 col-12-xsmall">
												<h5>Local de prestação de Serv.</h5>
												<input type="text" name="localserve" id="localserve" value="<?php echo $row_usuario['LOCALSERVICO'];?>" placeholder="Local" style="text-transform:uppercase"required/>
											</div>
											<div class="col-3 col-12-xsmall">
												<h5>Tipo de Jornada</h5>		
												<select id="tpjornada" name="tpjornada" style="text-transform:uppercase" required>	
													<option value="<?php echo $row_usuario['TPJORNADA'];?>"><?php echo $row_usuario['TPJORNADA_DESC'];?></option>
													<option value="1">Submetido a Horário de Trabalho</option>
													<option value="2">Atividade Externa</option>
													<option value="3">Confiança</option>
													<option value="4">Teletrabalho</option>
												</select>
											</div>
											<div class="col-3 col-12-xsmall">
												<h5>Forma de Contratação</h5>		
												<select id="contratacao" name="contratacao" style="text-transform:uppercase" required>	
													<option value="<?php echo $row_usuario['CONTRATACAO'];?>"><?php echo $row_usuario['DESC_CONTRATACAO'];?></option>
													<option value="1">Experiência</option>
													<option value="2">Indeterminado</option>
													<option value="3">Determinado</option>
												</select>
											</div>
											<div class="col-3 col-12-xsmall">
												<h5>Prazo</h5>		
												<select id="prazo" name="prazo" style="text-transform:uppercase" required>	
													<option value="<?php echo $row_usuario['PRAZO'];?>"><?php $P=$row_usuario['PRAZO']; if($P == 0) { echo "45+45";} elseif($P == 1) { echo "30+60";};?></option>
													<option value="0">45+45</option>
													<option value="1">30+60</option>
												</select>
											</div>

                                            <div class="col-12">
                                                <ul class="actions">
                                                    <li><input type="submit" value="Atualizar" class="primary"/></li>
                                                </ul>
                                            </div>
                                            <div class="col-12">
                                                <hr class="major"/>
                                            </div>
                                        </div>
                                    </form>
								</section>
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
								</section>
							-->

							<!-- Section -->
								<section>
									<header class="major">
										<h2>Quality RH</h2>
									</header>
									<p>A Quality RH é uma empresa com foco estratégico em Recursos Humanos, trabalhando como extensão do cliente e aprimorando a gestão da Folha de Pagamento. Com expertise nos segmentos de Óleo e Gás, Tecnologia da Informação, Advocacia, Indústria e Empregadores Domésticos.</p>
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
	</body>
</html>