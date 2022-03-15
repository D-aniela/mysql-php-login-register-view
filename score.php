<?php
session_start();

// Define database
define('dbhost', 'localhost');
define('dbuser', 'root');
define('dbpass', '');
define('dbname', 'pw2u2a2');

// Connecting database
try {
	$connect = new PDO("mysql:host=" . dbhost . "; dbname=" . dbname, dbuser, dbpass);
	$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo $e->getMessage();
}

if (isset($_POST['register'])) {
	$errMsg = '';

	// Get data from FROM
	$matricula = $_POST['matricula'];
	$ID_USUARIO = $_POST['ID_USUARIO'];
	$matematicas = $_POST['matematicas'];
	$espanol = $_POST['espanol'];
	$geografia = $_POST['geografia'];
	$historia = $_POST['historia'];
	$biologia = $_POST['biologia'];
	$quimica = $_POST['quimica'];
	echo $matricula;

	if ($matricula == '')
		$errMsg = 'Ingresa matrícula';
	if ($ID_USUARIO == '')
		$errMsg = 'Ingresa id de estudiante';
	if ($matematicas == '')
		$errMsg = 'Ingrese calicación de matemáticas';
	if ($espanol == '')
		$errMsg = 'Ingrese calificación de español';
	if ($geografia == '')
		$errMsg = 'Ingrese calificación de geografía';
	if ($historia == '')
		$errMsg = 'Ingrese calificación de historia';
	if ($biologia == '')
		$errMsg = 'Ingrese calificación de biología';
	if ($quimica == '')
		$errMsg = 'Ingrese calificación de química';

	if ($errMsg == '') {
		try {
			$stmt = $connect->prepare('INSERT INTO calificaciones 
			(matricula, 
			ID_USUARIO, 
			matematicas, 
			espanol, 
			geografia, 
			historia,
			biologia,
			quimica)
			VALUES (:matricula, 
			:ID_USUARIO, 
			:matematicas,
			:espanol,
			:geografia,
			:historia,
			:biologia,
			:quimica)');

			$stmt->execute(array(
				':matricula' => $matricula,
				':ID_USUARIO' => $ID_USUARIO,
				':matematicas' => $matematicas,
				':espanol' => $espanol,
				':geografia' => $geografia,
				':historia' => $historia,
				':biologia' => $biologia,
				':quimica' => $quimica
			));
			header('Location: score.php?action=joined');
			exit;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
}

if (isset($_GET['action']) && $_GET['action'] == 'joined') {
	$errMsg = 'Calificaciones registradas <a href="scoreTeacher.php">consultarlas</a>';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./styles.css">
	<title>Registrarse</title>
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
	<form action="score.php" method="post">
		<h2 style="text-align: center;">Datos de estudiante</h2>
		<div class="container">

			<div class="row">
				<div class="col">
					<div class="form-group">
						<label for="matricula"><b>Ingrese matrícula de Estudiante</b></label>
						<input type="text" class="form-control" name="matricula" placeholder="Ingresar matrícula estudiante" value="<?php if (isset($_POST['matricula'])) echo $_POST['matricula'] ?>" autocomplete="off" /><br /><br />
					</div>
				</div>

				<div class="col">
					<div class="form-group">
						<label for="ID_USUARIO"><b>Ingrese ID de Estudiante</b></label>
						<input type="text" class="form-control" name="ID_USUARIO" placeholder="Ingresar Id estudiante" value="<?php if (isset($_POST['ID_USUARIO'])) echo $_POST['ID_USUARIO'] ?>" autocomplete="off" /><br /><br />
					</div>
				</div>
			</div>



			<h2 style="text-align: center;">Registro de calificaciones</h2>
			<div class="row">
				<div class="col">
					<div class="form-group">
						<label for="matematicas"><b>Matemáticas</b></label>
						<input type="text" class="form-control" name="matematicas" placeholder="Matemáticas" value="<?php if (isset($_POST['matematicas'])) echo $_POST['matematicas'] ?>" autocomplete="off" /><br /><br />
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<label for="espanol"><b>Español</b></label>
						<input type="text" class="form-control" name="espanol" placeholder="Español" value="<?php if (isset($_POST['espanol'])) echo $_POST['espanol'] ?>" autocomplete="off" /><br /><br />
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col">
					<div class="form-group">
						<label for="geografia"><b>Geografía</b></label>
						<input type="text" class="form-control" name="geografia" placeholder="Geografía" value="<?php if (isset($_POST['geografia'])) echo $_POST['geografia'] ?>" autocomplete="off" /><br /><br />
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<label for="historia"><b>Historia</b></label>
						<input type="text" class="form-control" name="historia" placeholder="Historia" value="<?php if (isset($_POST['historia'])) echo $_POST['historia'] ?>" autocomplete="off" /><br /><br />
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col">
					<div class="form-group">
						<label for="biologia"><b>Biología</b></label>
						<input type="text" class="form-control" name="biologia" placeholder="Biología" value="<?php if (isset($_POST['biologia'])) echo $_POST['biologia'] ?>" autocomplete="off" /><br /><br />
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<label for="quimica"><b>Química</b></label>
						<input type="text" class="form-control" name="quimica" placeholder="Química" value="<?php if (isset($_POST['quimica'])) echo $_POST['quimica'] ?>" autocomplete="off" /><br /><br />
					</div>
				</div>
			</div>

			<button class="btn btn-primary" type="submit" name='register' value="Register" class='submit'>Registrar calificaciones</button>

		</div>

	</form>

</body>

</html>