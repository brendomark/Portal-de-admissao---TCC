<?php 
session_start();
include('verifica_login.php');
include('verifica_acesso_USER.php');
include_once 'conexao.php';
include_once 'mensagem.php';
?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Quality - RH</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/informacao.css" />
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

					<!-- Banner -->
						<section id="banner">
							<div class="content">
								<header class="major">
									<h2>Lista de usuários</h2>
								</header>

								<table class="table table-action">
									<thead>
											<tr>
												<th class="t-small">ID</th>
												<th class="t-small">CPF</th>
												<th class="t-small">Usuários</th>
												<th class="t-small">Email</th>
												<th class="t-small">Matrícula</th>
											</tr>
										</thead>
										
										<tbody>
											<?php 
												$CODCOLIGADA = $_SESSION['coligada'];
												$sql = "SELECT 
															*
														FROM
															PPESSOA
														WHERE NIVELACESSO = 1 AND CODCOLIGADA = $CODCOLIGADA";
												$resultado = mysqli_query($conexao, $sql);
												while($dados = mysqli_fetch_array($resultado)):
											?>
													<tr>
														<td><?php echo $dados['ID'];?></td>
														<td><?php echo $dados['CPF'];?></td>
														<td><?php echo $dados['USUARIO'];?></td>
														<td><?php echo $dados['EMAIL'];?></td>
														<td><?php echo $dados['MATRICULA'];?></td>
														<td><a title="ENVIAR EMAIL" href = "email_config.php?id=<?php echo $dados['ID'];?>"><i style='font-size:24px' aria-hidden="true" class="fa fa-envelope"></a></i><td>
														<td><a title="EDITAR" href = "editar_user_rh.php?id=<?php echo $dados['ID'];?>"><i style='font-size:24px' class="far fa-edit"></a></i><td>
														<td><a title="DELETAR" href = "delete_rh.php?id=<?php echo $dados['ID'];?>&mt=<?php echo $dados['MATRICULA'];?>"><i style='font-size:24px' class="fas fa-trash"></a></i><td>
													</tr>
												<?php endwhile; ?>
										</tbody>
									
									</table>
							</div>
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

	</body>
</html>