<?php
require 'config.php';
if ($_SESSION['Nombre_usuario']) {
	$resultado = $connect->query('SELECT * FROM calificaciones');
} else {
	echo 'Inicie sesión para ver la información';
}
?>

<style>
	td,
	table,
	th {
		border: 1px solid gray !important;
	}
</style>

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
					<a class="nav-link" href="./score.php">Registrar Calificación</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="./scoreTeacher.php">Consultar Calificación</a>
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
	<section style="text-align: center;">
		<h1>Calificaciones</h1>
		<!-- TABLE CONSTRUCTION-->
		<div class="container">
			<table class="table" style="text-align: center; margin-left: 50%; transform:translateX(-50%)">
				<thead>
					<tr>
						<th scope="col">Matrícula</th>
						<th scope="col">Matemáticas</th>
						<th scope="col">Español</th>
						<th scope="col">Geografía</th>
						<th scope="col">Historia</th>
						<th scope="col">Biología</th>
						<th scope="col">Química</th>
					</tr>
				</thead>
				<!-- PHP CODE TO FETCH DATA FROM ROWS-->
				<?php   // LOOP TILL END OF DATA 
				while ($calif = $resultado->fetch(PDO::FETCH_OBJ)) {
				?>
					<tbody>
						<tr>
							<!--FETCHING DATA FROM EACH 
                    ROW OF EVERY COLUMN-->
							<td><?php echo $calif->matricula; ?></td>
							<td><?php echo $calif->matematicas; ?></td>
							<td><?php echo $calif->espanol; ?></td>
							<td><?php echo $calif->geografia; ?></td>
							<td><?php echo $calif->historia; ?></td>
							<td><?php echo $calif->biologia; ?></td>
							<td><?php echo $calif->quimica; ?></td>
						</tr>
					<?php
				}
					?>
					</tbody>
			</table>
		</div>
	</section>
</body>

</html>