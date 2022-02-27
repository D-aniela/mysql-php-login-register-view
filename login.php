<?php
	require 'config.php';

	if(isset($_POST['login'])) {
		$errMsg = '';

		// Get data from FORM
		$ID_Usuario = $_POST['ID_Usuario'];
		$Password = $_POST['Password'];

		if($ID_Usuario == '')
			$errMsg = 'Ingrese id de su usuario';
		if($Password == '')
			$errMsg = 'Ingrese su contraseña';

		if($errMsg == '') {
			try {
				$stmt = $connect->prepare('SELECT ID_Usuario, Password, Nombre_usuario, Tipo_usuario FROM usuarios WHERE ID_Usuario = :ID_Usuario');
				$stmt->execute(array(
					':ID_Usuario' => $ID_Usuario
					));
				$data = $stmt->fetch(PDO::FETCH_ASSOC);

				if($data == false){
					$errMsg = "Usuario $ID_Usuario no encontrado.";
				}
				else {
					if($Password == $data['Password']) {
						$_SESSION['Nombre_usuario'] = $data['Nombre_usuario'];
						$_SESSION['Tipo_usuario'] = $data['Tipo_usuario'];
						$_SESSION['ID_Usuario'] = $data['ID_Usuario'];
						$_SESSION['Password'] = $data['Password'];

						if($_SESSION['Tipo_usuario'] == 'E') {
							header('Location: student-view.php');
							exit;
						}
						else {
							header('Location: teacher-view.php');
							exit;
						}
						exit;
					}
					else
						$errMsg = 'La contraseña no coincide.';
				}
			}
			catch(PDOException $e) {
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
	<title>Iniciar sesión</title>
	
</head>
<body>
<div id="navbar"> 
		<ul> 
		<li><a href="./index.html">Inicio</a></li> 
		<li><a href="./register.php">Registrarse</a></li> 
		<li><a href="./login.php">Iniciar sesión</a></li>
		</ul> 
	</div> 
			<?php
				if(isset($errMsg)){
					echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
				}
			?>
	<form action="" method="post">	
		<div class="container">
			<label for="ID_usuario"><b>ID Usuario</b></label>
			<input type="text" placeholder="Ingresar Id usuario" id="ID_Usuario" name="ID_Usuario" required value="<?php if(isset($_POST['ID_Usuario'])) echo $_POST['ID_Usuario'] ?>" autocomplete="off">
			<label for="Password"><b>Contraseña</b></label>
			<input id="Password" name="Password" type="Password"  placeholder="Contraseña" required value="<?php if(isset($_POST['Password'])) echo $_POST['Password'] ?>" autocomplete="off">
			<span id = "message2" style="color:red"> </span> <br><br>
			<input  type="submit" name='login' value="Login" class='submit'>Iniciar sesión</button>
		</div>
	</form>
</body>
</html>
