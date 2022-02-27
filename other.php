<?php
$ID_usuario = $_POST['ID_usuario'];
$Nombre_usuario = $_POST['Nombre_usuario'];
$Tipo_usuario = 'E';
$Password = $_POST['Password'];

// $con = mysqli_connect('localhost', 'database_user', 'database_password','database');
$conn = new mysqli('localhost', 'root', '','pw2u2a2');
// get the post records
if($conn->connect_error){
	echo "$conn->connect_error";
	die("Connection Failed : ". $conn->connect_error);
} else {
	$sql = mysqli_query($conn, "SELECT ID_usuario FROM usuarios WHERE ID_usuario = '".$_POST['ID_usuario']."'");
 if(mysqli_num_rows($sql)>=1)
   {
    echo"Este id ya existe";
   }
 else
    {
			$stmt = $conn->prepare("insert into usuarios(ID_usuario, Nombre_usuario, Tipo_usuario, Password) values(?, ?, ?, ?)");
			$stmt->bind_param('ssss',$ID_usuario, $Nombre_usuario, $Tipo_usuario, $Password);
			$execval = $stmt->execute();
			echo $execval;
			echo "Registration successfully...";
			$stmt->close();
			$conn->close();
    }

}
?>