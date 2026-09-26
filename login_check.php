
<?php

require_once('databases/conexion.php');

$cedula = mysqli_real_escape_string($conn, stripslashes(strip_tags(htmlspecialchars(trim($_POST['cedula'])))));
$password = mysqli_real_escape_string($conn, stripslashes(strip_tags(htmlspecialchars(trim($_POST['password'])))));

if (!ctype_alnum($cedula) or !ctype_alnum($password)) {
	header("location: index.php?alert=1");
} else {

	$query = mysqli_query($conn, "SELECT * FROM users,members WHERE users.id_miembro = members.id_miembro AND cedula='$cedula' AND users.password_hash ='$password' AND estatus='activo'")
		or die('error' . mysqli_error($conn));
	$rows  = mysqli_num_rows($query);

	if ($rows > 0) {
		$data  = mysqli_fetch_assoc($query);

		session_start();
		$_SESSION['id_usuario']   = $data['id'];
		$_SESSION['email']  = $data['email'];
		$_SESSION['cedula']  = $data['cedula'];
		$_SESSION['password_hash']  = $data['password'];
		//$_SESSION['cargo'] = $data['cargo'];
		$_SESSION['nombre'] = $data['nombres'];
		$_SESSION['apellido'] = $data['apellidos'];
		//$_SESSION['permisos_acceso'] = $data['permisos_acceso'];

		header("Location: pages/dashboard.php");
	} else {
		header("Location: index.php?alert=1");
	}
}

?>