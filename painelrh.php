<?php 
session_start();
include('verifica_login.php');
include('verifica_acesso_USER.php');
include('systeminfo.php');
include_once 'conexao.php';
include_once 'mensagem.php';


$CODCOLIGADA = $_SESSION['coligada'];
$query = "SELECT LOGO FROM GCOLIGADA WHERE CODCOLIGADA = '$CODCOLIGADA' ";
$result = mysqli_query($conexao, $query);
$logo = mysqli_fetch_assoc($result);

?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Quality - RH</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/stylesheet.css" />
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

								<section>
									<div class="posts">
										<article>
											<h2>Ola, <?php echo $_SESSION['nomecoligada'];?> <br /></h2>
											<p>Bem-vindo ao portal de admissão web RH!</p>
										</article>
										<article>
											<div class="mini-posts">
												<a href="#" class="image"><img src="<?php echo $logo['LOGO']; ?>" alt="" /></a>
											</div>
										</article>
									</div>	
								</section>

														
								<section>
									<header class="major">
										<h2>Post</h2>
									</header>
									<div class="posts">
										<article>
											<a href="#" class="image"><img src="images/pic01.jpg" alt="" /></a>
											<h3>Interdum aenean</h3>
											<p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
											<ul class="actions">
												<li><a href="#" class="button">More</a></li>
											</ul>
										</article>
										<article>
											<a href="#" class="image"><img src="images/pic02.jpg" alt="" /></a>
											<h3>Nulla amet dolore</h3>
											<p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
											<ul class="actions">
												<li><a href="#" class="button">More</a></li>
											</ul>
										</article>
										<article>
											<a href="#" class="image"><img src="images/pic03.jpg" alt="" /></a>
											<h3>Tempus ullamcorper</h3>
											<p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
											<ul class="actions">
												<li><a href="#" class="button">More</a></li>
											</ul>
										</article>
										<article>
											<a href="#" class="image"><img src="images/pic04.jpg" alt="" /></a>
											<h3>Sed etiam facilis</h3>
											<p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
											<ul class="actions">
												<li><a href="#" class="button">More</a></li>
											</ul>
										</article>
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
							
							<!-- Section -->
								<section>
									<header class="major">
										<h2>Info System</h2>
									</header>
									<div class="mini-posts">
										<article>
											<p><?php echo $device_details; ?></p>
											<a href="#" class="image"></a>
										</article>
									</div>
								</section>

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