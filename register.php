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
	$ID_USUARIO = $_POST['ID_USUARIO'];
	$Nombre_Usuario = $_POST['Nombre_Usuario'];
	$Tipo_usuario = 'E';
	$Password = $_POST['Password'];
	$apellidoPaterno = $_POST['apellidoPaterno'];
	$apellidoMaterno = $_POST['apellidoMaterno'];

	if ($ID_USUARIO == '')
		$errMsg = 'Ingresa tu Id de usuario';
	if ($Nombre_Usuario == '')
		$errMsg = 'Ingresa tu nombre';
	if ($Tipo_usuario == '')
		$errMsg = 'Ingresa tu tipo de usuario';
	if ($Password == '')
		$errMsg = 'Ingresa tu contraseña';
	if ($apellidoPaterno == '')
		$errMsg = 'Ingresa tu apellido paterno';
	if ($apellidoMaterno == '')
		$errMsg = 'Ingresa tu apellido materno';

	if ($errMsg == '') {
		try {
			$stmt = $connect->prepare('INSERT INTO usuarios 
			(ID_USUARIO, 
			Nombre_Usuario, 
			apellidoPaterno, 
			apellidoMaterno, 
			Tipo_usuario, 
			Password) 
			VALUES (:ID_USUARIO, 
			:Nombre_Usuario, 
			:apellidoPaterno,
			:apellidoMaterno,
			:Tipo_usuario, 
			:Password)');

			$stmt->execute(array(
				':ID_USUARIO' => $ID_USUARIO,
				':Nombre_Usuario' => $Nombre_Usuario,
				':apellidoPaterno' => $apellidoPaterno,
				':apellidoMaterno' => $apellidoMaterno,
				':Tipo_usuario' => $Tipo_usuario,
				':Password' => $Password
			));
			header('Location: register.php?action=joined');
			exit;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
}

if (isset($_GET['action']) && $_GET['action'] == 'joined') {
	$errMsg = 'Ya está registrado, ahora puede <a href="login.php">iniciar sesión</a>';
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
	<form action="register.php" method="post">
		<div class="container">
			<div class="form-group">
				<div class="row">
					<div class="col">
						<label for="ID_usuario"><b>ID Usuario</b></label>
						<input type="text" class="form-control" name="ID_USUARIO" placeholder="Ingresar Id usuario" value="<?php if (isset($_POST['ID_USUARIO'])) echo $_POST['ID_USUARIO'] ?>" autocomplete="off" /><br /><br />
					</div>
					<div class="col">
						<label for="Nombre_usuario"><b>Nombre</b></label>
						<input type="text" class="form-control" name="Nombre_Usuario" placeholder="Nombre del Usuario" value="<?php if (isset($_POST['Nombre_Usuario'])) echo $_POST['Nombre_Usuario'] ?>" autocomplete="off" /><br /><br />
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col">
						<label for="apellidoPaterno"><b>Apellido Paterno</b></label>
						<input type="text" class="form-control" name="apellidoPaterno" placeholder="Nombre del Usuario" value="<?php if (isset($_POST['apellidoPaterno'])) echo $_POST['apellidoPaterno'] ?>" autocomplete="off" /><br /><br />
					</div>
					<div class="col">
						<label for="apellidoMaterno"><b>Apellido Materno</b></label>
						<input type="text" class="form-control" name="apellidoMaterno" placeholder="Nombre del Usuario" value="<?php if (isset($_POST['apellidoMaterno'])) echo $_POST['apellidoMaterno'] ?>" autocomplete="off" /><br /><br />
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col">
						<label for="Tipo_usuario"><b>Tipo Usuario</b></label>
						<input type="Tipo_usuario" class="form-control" name="Tipo_usuario" placeholder="Tipo_usuario" disabled value="Estudiante" /><br /><br />
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col">
						<label for="Password"><b>Contraseña</b></label>
						<input id="Password" class="form-control" name="Password" type="password" value="<?php if (isset($_POST['Password'])) echo $_POST['Password'] ?>" autocomplete="off" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Debe tener al menos 8 carácteres' : ''); if(this.checkValidity()) form.password_two.pattern = this.value;" placeholder="Contraseña" required>
					</div>
					<div class="col">
						<label for="psw"><b>Confirmar Contraseña</b></label>
						<input id="password_two" class="form-control" name="password_two" type="password" pattern="^\S{8,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Introduzca la misma contraseña de arriba' : '');" placeholder="Confirmar contraseña" required>
					</div>
				</div>
			</div>
			<span id="message2" style="color:red"> </span> <br><br>

			<button class="btn btn-primary" type="submit" class="form-control" name='register' value="Register" class='submit'>Registrarse</button>

		</div>

		<div id="message">
			<h3>Password must contain the following:</h3>
			<p id="letter" class="invalid">A <b>lowercase</b> letter</p>
			<p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
			<p id="number" class="invalid">A <b>number</b></p>
			<p id="length" class="invalid">Minimum <b>8 characters</b></p>
		</div>

	</form>

	<script>
		var myInput = document.getElementById("Password");
		var letter = document.getElementById("letter");
		var capital = document.getElementById("capital");
		var number = document.getElementById("number");
		var length = document.getElementById("length");



		// When the user clicks on the password field, show the message box
		myInput.onfocus = function() {
			document.getElementById("message").style.display = "block";
		}

		// When the user clicks outside of the password field, hide the message box
		myInput.onblur = function() {
			document.getElementById("message").style.display = "none";
		}

		// When the user starts to type something inside the password field
		myInput.onkeyup = function() {
			// Validate lowercase letters
			var lowerCaseLetters = /[a-z]/g;
			if (myInput.value.match(lowerCaseLetters)) {
				letter.classList.remove("invalid");
				letter.classList.add("valid");
			} else {
				letter.classList.remove("valid");
				letter.classList.add("invalid");
			}

			// Validate capital letters
			var upperCaseLetters = /[A-Z]/g;
			if (myInput.value.match(upperCaseLetters)) {
				capital.classList.remove("invalid");
				capital.classList.add("valid");
			} else {
				capital.classList.remove("valid");
				capital.classList.add("invalid");
			}

			// Validate numbers
			var numbers = /[0-9]/g;
			if (myInput.value.match(numbers)) {
				number.classList.remove("invalid");
				number.classList.add("valid");
			} else {
				number.classList.remove("valid");
				number.classList.add("invalid");
			}

			// Validate length
			if (myInput.value.length >= 8) {
				length.classList.remove("invalid");
				length.classList.add("valid");
			} else {
				length.classList.remove("valid");
				length.classList.add("invalid");
			}
		}
	</script>
</body>

</html>