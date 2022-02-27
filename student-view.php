<?php
require 'config.php';
?>

<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./styles.css">
	<title>Iniciar sesión</title>

</head>

<body>
	<div id="navbar">
		<ul>
		<li><a href="./index.html">Inicio</a></li> 
			<li><a href="#">Consultar Calificación</a></li>
			<li><a href="#">Usuario <?php echo $_SESSION['Tipo_usuario']; ?> </a></li>
			<li><a href="logout.php">Cerrar sesión</a></li>
		</ul>
	</div>
	<?php
	if (isset($errMsg)) {
		echo '<div style="color:#FF0000;text-align:center;font-size:17px;">' . $errMsg . '</div>';
	}
	?>
	<h1>Bienvenido <?php echo $_SESSION['Nombre_usuario']; ?>, has iniciado como "Estudiante" </h1>
</body>

</html>