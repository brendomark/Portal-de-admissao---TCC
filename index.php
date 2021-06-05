<?php 
    session_start();
?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Quality - RH</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	</head>
	<body class="is-preload">
		<div class="container-fluid">
			<div id="main">
						<div class="form-group d-flex justify-content-center">
							<header id="header">
							<span class="label">LOGO DA EMPRESA QUE CONTRATAR O NOSSO SOFTWARE<!-- Search <img src="logo/quality.jpg" style="height: 120px; width: 200px;" alt="" />--></span> 
							</header>
						</div>

						<section>
							<div class="container">
								<div class="col-md-6 offset-md-3">
										<?php 
											if(isset($_SESSION['nao_autenticado'])):
										?>	
											<div class="form-group d-flex justify-content-center">
											<div class="alert alert-danger" role="alert">
												<p style="text-align:right">Usuário ou senha inválidos.</p>
											</div>
											</div>
										<?php 
											endif;
											unset($_SESSION['nao_autenticado']);
										?>

									<form method="POST" action="login.php">
											<h5>Login</h5>
												<input type="text" name="usuario" id="usuario" value="" placeholder="Usuario" required/>
												</br>
											<h5>Senha</h5>
												<input type="password" name="senha" id="senha" value="" placeholder="Senha" required/>
												</br>
											<div class="form-group d-flex justify-content-center">
												<input type="submit" value="Logar" class="primary" />
											</div>
												</br>
											<div class="form-group d-flex justify-content-center">	
												<a href="redefinir.php">Redefinir senha</a>
											</div>
									</form>
								</div>
							</div>
						</section>
			</div>
		</div>

			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>	
</html>