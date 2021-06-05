<?php 
session_start();
include('verifica_login.php');
include('verifica_acesso_USER.php');
include('mensagem.php');
include_once 'conexao.php';
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
									<a href="painelrh.php" class="logo"><strong>Configurações</strong> Email</a>
									<ul class="icons">
										<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
										<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
										<li><a href="#" class="icon brands fa-snapchat-ghost"><span class="label">Snapchat</span></a></li>
										<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
										
									</ul>
								</header>

							<!-- Banner -->
								<!-- Banner -->
								<section id="banner">
									<div class="content">
											<form method="post" action="email_cad.php">
												<div class="logo">
													<h3>Configurações</h3>
														
												</div>
												<div class="row gtr-uniform">
													
													<div class="col-3 col-12-xsmall">
														<h5>Host/SMTP</h5>
														<input type="text" name="host" id="host" value="" placeholder="smtp-mail" style="text-transform:uppercase;" required />
													</div>
													<div class="col-3 col-12-xsmall">
														<h5>Email</h5>
														<input type="text" name="email" id="email" value="<?php echo $_SESSION['email']?>" placeholder="nome@servidor.com" style="text-transform:uppercase;" required/>
													</div>
													<div class="col-2 col-6-xsmall">
														<h5>Porta</h5>
														<input type="text" name="port" id="port" value="" placeholder="587" style="text-transform:uppercase;" required />
													</div>
													<div class="col-3 col-12-xsmall">
														<h5>Senha</h5>
														<input type="password" name="senha" id="senha" value="" placeholder="Senha" style ="text-transform:uppercase" required  />
													</div>

													<br>
													<div class="col-4 col-12-xsmall"></div>
													<br>
													<div class="col-4 col-12-xsmall">
														<ul class="actions">
															<li><input type="submit" value="Configurar Email" class="primary" /></li>
														</ul>
													</div>
											</form>
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