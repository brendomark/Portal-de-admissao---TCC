<?php 
session_start();
include('../verifica_login.php');
include_once '../conexao.php';
include_once '../mensagem.php';

$ID = mysqli_escape_String($conexao, $_GET['id']);
$sql = "SELECT ANEXO_CPF,ANEXO_RG,ANEXO_TITULO,ANEXO_CTPS,ANEXO_MILITAR,ANEXO_END,FICHAS FROM PFUNC WHERE ID = '$ID'";
$result = mysqli_query($conexao, $sql);
$dados = mysqli_fetch_array($result);

$anexo_cpf=$dados['ANEXO_CPF'];
$anexo_rg=$dados['ANEXO_RG'];
$anexo_titulo=$dados['ANEXO_TITULO'];
$anexo_ctps=$dados['ANEXO_CTPS'];
$anexo_militar=$dados['ANEXO_MILITAR'];
$anexo_end=$dados['ANEXO_END'];
$FICHAS=$dados['FICHAS'];
?>

<!DOCTYPE HTML>

<html>

<head>
	<title>Quality - RH</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="../assets/css/main.css" />
	<link rel="stylesheet" href="../assets/css/stylesheet.css"/>
	<link rel="stylesheet" href="../assets/css/viewdocs.css"/>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body class="is-preload">
	<!-- Wrapper -->
	<div id="wrapper">
		<!-- Main -->
		<div id="main">
			<div class="inner">
				<div class="w3-container">

					<div class="w3-bar">
						<button class="w3-bar-item w3-button tablink w3-red" onclick="openCity(event,'CPF')"><i class="fas fa-eye"> CPF</i></button>
						<button class="w3-bar-item w3-button tablink" onclick="openCity(event,'RG')"><i class="fas fa-eye"> RG</i></button>
						<button class="w3-bar-item w3-button tablink" onclick="openCity(event,'CTPS')"><i class="fas fa-eye"> CTPS</i></button>
						<button class="w3-bar-item w3-button tablink" onclick="openCity(event,'TITULO')"><i class="fas fa-eye"> TITULO</i></button>
						<button class="w3-bar-item w3-button tablink" onclick="openCity(event,'RESERVISTA')"><i class="fas fa-eye"> RESERVISTA</i></button>
						<button class="w3-bar-item w3-button tablink" onclick="openCity(event,'END')"><i class="fas fa-eye"> END</i></button>
						<button class="w3-bar-item w3-button tablink" onclick="openCity(event,'FICHA')"><i class="fas fa-eye"> FICHA</i></button>
						
					</div>
					<div id="CPF" class="w3-container w3-border city">
						<object data="<?php echo $anexo_cpf;?>" type="application/pdf" width="800" height="800">
							<a href="<?php echo $anexo_cpf;?>"></a>
						</object>
					</div>

					<div id="RG" class="w3-container w3-border city" style="display:none">
						<object data="<?php echo $anexo_rg;?>" type="application/pdf" width="800" height="800">
							<a href="<?php echo $anexo_rg;?>"></a>
						</object> 
					</div>

					<div id="CTPS" class="w3-container w3-border city" style="display:none">
						<object data="<?php echo $anexo_ctps;?>" type="application/pdf" width="800" height="800">
							<a href="<?php echo $anexo_ctps;?>"></a>
						</object>
					</div>

					<div id="TITULO" class="w3-container w3-border city" style="display:none">
						<object data="<?php echo $anexo_titulo;?>" type="application/pdf" width="800" height="800">
							<a href="<?php echo $anexo_titulo;?>"></a>
						</object>
					</div>

					<div id="RESERVISTA" class="w3-container w3-border city" style="display:none">
						<object data="<?php echo $anexo_militar;?>" type="application/pdf" width="800" height="800">
							<a href="<?php echo $anexo_militar;?>"></a>
						</object>
					</div>

					<div id="END" class="w3-container w3-border city" style="display:none">
						<object data="<?php echo $anexo_end;?>" type="application/pdf" width="800" height="800">
							<a href="<?php echo $anexo_end;?>"></a>
						</object>
					</div>

					<div id="FICHA" class="w3-container w3-border city" style="display:none">
						<object data="<?php echo $FICHAS;?>" type="application/pdf" width="800" height="800">
							<a href="<?php echo $FICHAS;?>"></a>
						</object>
					</div>

				</div>
			</div>
		</div>
	</div>

	<!-- Scripts -->
	<script src="../assets/js/jquery.min.js"></script>
	<script src="../assets/js/browser.min.js"></script>
	<script src="../assets/js/breakpoints.min.js"></script>
	<script src="../assets/js/util.js"></script>
	<script src="../assets/js/main.js"></script>
	<script>
		function openCity(evt, cityName) {
		var i, x, tablinks;
		x = document.getElementsByClassName("city");
		for (i = 0; i < x.length; i++) {
			x[i].style.display = "none";
		}
		tablinks = document.getElementsByClassName("tablink");
		for (i = 0; i < x.length; i++) {
			tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
		}
		document.getElementById(cityName).style.display = "block";
		evt.currentTarget.className += " w3-red";
		}
	</script>
</body>
</html>
