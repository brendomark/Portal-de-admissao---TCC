<?php 
    session_start();
    include_once 'conexao.php';
    
    if (isset($_POST['email'])){

        $email = mysqli_escape_String($conexao,$_POST['email']);
             
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
             $erro[]= "email invalido";
			}
			
			$query = "SELECT * FROM PPESSOA WHERE email = '$email'";
			$result = mysqli_query($conexao, $query);
			$row = mysqli_num_rows($result);
			if($row == 0){
				$erro[] = "O email informado nao existe";
			}


        if(count($erro) == 0 && $row == 1){

            $novasenha = substr(md5(time()),0,6);
            $nscriptografada = md5(md5($novasenha));
           
            if(mail($email, "Sua nova senha", "Sua nova senha: ".$novasenha)){
                $sql_code = "UPDATE PPESSOA SET senha = '$nscriptografada' WHERE email ='$email'";
                $sql_query = $mysqli->query($sql_code) or die($mysqli->erro);
            }
        }
    }
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
				<div class="inner">
						<div class="form-group d-flex justify-content-center">
							<header id="header">
							<span class="label"><img src="logo/logo.png" alt="" /></span> 
							</header>
						</div>

						<section>
							<div class="container">
							    <div class="col-md-6 offset-md-3">
									<form method="POST" action="">
									
                                        <h5>E-mail</h5>
                                        <input type="text" name="email" id="email" value="" placeholder="E-Mail"/>
										</br>
										<div class="form-group d-flex justify-content-center">
                                        <input type="submit" value="Enviar" name="email" class="primary" />
										</div>
										</br>
                                    </div>
								</form>
							</div>
						</section>
				</div>
			</div>
		</div>

			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
	</body>	
</html>