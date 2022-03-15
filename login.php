<?php
require 'config.php';

if (isset($_POST['login'])) {
	$errMsg = '';

	// Get data from FORM
	$ID_Usuario = $_POST['ID_Usuario'];
	$Password = $_POST['Password'];

	if ($ID_Usuario == '')
		$errMsg = 'Ingrese id de su usuario';
	if ($Password == '')
		$errMsg = 'Ingrese su contraseña';

	if ($errMsg == '') {
		try {
			$stmt = $connect->prepare('SELECT ID_Usuario, Nombre_usuario, apellidoPaterno, apellidoMaterno, Tipo_usuario, Password FROM usuarios WHERE ID_Usuario = :ID_Usuario');
			$stmt->execute(array(
				':ID_Usuario' => $ID_Usuario
			));
			$data = $stmt->fetch(PDO::FETCH_ASSOC);

			if ($data == false) {
				$errMsg = "Usuario $ID_Usuario no encontrado.";
			} else {
				if ($Password == $data['Password']) {
					$_SESSION['Nombre_usuario'] = $data['Nombre_usuario'];
					$_SESSION['apellidoPaterno'] = $data['apellidoPaterno'];
					$_SESSION['apellidoMaterno'] = $data['apellidoMaterno'];
					$_SESSION['Tipo_usuario'] = $data['Tipo_usuario'];
					$_SESSION['ID_Usuario'] = $data['ID_Usuario'];
					$_SESSION['Password'] = $data['Password'];

					if ($_SESSION['Tipo_usuario'] == 'E') {
						header('Location: student-view.php');
						exit;
					} else {
						header('Location: teacher-view.php');
						exit;
					}
					exit;
				} else
					$errMsg = 'La contraseña no coincide.';
			}
		} catch (PDOException $e) {
			$errMsg = $e->getMessage();
		}
	}
}
?>

<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./styles.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
	<title>Iniciar sesión</title>

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
					<a class="nav-link" href="./register.php">Registrarse</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="./login.php">Iniciar sesión</a>
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
	<form action="" method="post">
		<div class="container">
			<div class="form-group">
				<label for="ID_usuario"><b>ID Usuario</b></label>
				<input type="text" class="form-control" placeholder="Ingresar Id usuario" id="ID_Usuario" name="ID_Usuario" required value="<?php if (isset($_POST['ID_Usuario'])) echo $_POST['ID_Usuario'] ?>" autocomplete="off">
			</div>
			<div class="form-group">
				<label for="Password"><b>Contraseña</b></label>
				<input id="Password" class="form-control" name="Password" type="Password" placeholder="Contraseña" required value="<?php if (isset($_POST['Password'])) echo $_POST['Password'] ?>" autocomplete="off">
			</div>
			<div class="form-group">
				<span id="message2" style="color:red"> </span> <br><br>
				<button class="btn btn-primary" type="submit" name='login' value="Login" class='submit'>Iniciar sesión</button>
			</div>
		</div>
	</form>
</body>

</html>