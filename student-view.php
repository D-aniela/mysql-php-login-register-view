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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />

</head>

<body>
	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="#">Navbar</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item active">
					<a class="nav-link" href="./index.html">Inicio <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="./scoreStudent.php">Consultar Calificación</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Usuario <?php echo $_SESSION['Tipo_usuario']; ?> </a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="logout.php">Cerrar sesión</a>
				</li>
			</ul>
		</div>
	</nav>
	<!-- navbar end -->
	<?php
	if (isset($errMsg)) {
		echo '<div style="color:#FF0000;text-align:center;font-size:17px;">' . $errMsg . '</div>';
	}
	?>
	<h1>Bienvenido
		<?php echo $_SESSION['Nombre_usuario'];  ?>
		<?php echo $_SESSION['apellidoPaterno']; ?>
		<?php echo $_SESSION['apellidoMaterno']; ?>
		, has iniciado como "Estudiante" </h1>
</body>

</html>