<?php
include ("includes/init-inc.php");
// A partir de aquí ponemos el código de
// la página en lenguaje HTML
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

		<title>Tuavenida.com</title>

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
		<script type="text/javascript" src="js/scripts.js"></script>
		<script type="text/javascript" src="js/menu.js"></script>
		<script type="text/javascript" src="js/shadowbox.js"></script>

		<script type="text/javascript">
			var _siteRoot = 'index.html', _root = 'index.html';
		</script>

		<link rel="stylesheet" href="css/main.css" type="text/css" />
		<link rel="stylesheet" href="css/menu.css" type="text/css" />
		<link rel="stylesheet" href="css/slider.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/shadowbox.css" type="text/css" />
		<link rel="Shortcut Icon" href="images/favicon.ico" type="image/x-icon" />

	</head>
	<body>

		<?php

		$dev_reference = $_GET["dev_reference"];
		?>

		<div id="contenedor">

			<!-- seccion inc header -->
			<?php
				include ("includes/header-inc.php");
			?>
			<!-- termina inc header -->

			<div id="main">
				<div id="contenido_left">

				</div>
				<div id="separador"></div>

				<div id="contenido_top">
					
					<?php if($_GET['status']<>0)
					{?>

					<div id="estado_ok" style="display:block">

						<h2>Parabéns!</h2>
						<br />
						<h3>A compra foi bem sucedida</h3>
						<br />
						<h3>Agora você pode encontrá-lo em<a href="myproducts.php"> Meus Produtos</a></h3>
						<br />

						<br />

						<?php confirmacion(cargaritems($dev_reference));
							unset($_SESSION['carro']);
						?>
					</div>
					<?php
					}else {?>
					<div id="estado_ok" style="display:block">

						<h2>Oi!</h2>
						<br />
						<h3>Transação em andamento</h3>
						<br />
						<h3>Estamos verificando sua operação de pagamento.
						Enquanto a operação se processa, não perca nossas promoções especiais da semana!<a href="index.php"> Pechinchas</a></h3>
					</div>	
					<?php }
					?>

				</div>
			</div>
		<!--termina main-->

		<!-- seccion inc footer -->
		<?php
			include ("includes/footer-inc.php");
		?>
		<!-- termina inc footer -->

		</div> <!--termina contenedor-->

	</body>
</html>