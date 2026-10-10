
<?php

require_once('databases/conexion.php');

$cedula = mysqli_real_escape_string($conn, stripslashes(strip_tags(htmlspecialchars(trim($_POST['cedula'])))));
$password = mysqli_real_escape_string($conn, stripslashes(strip_tags(htmlspecialchars(trim($_POST['password'])))));

if (!ctype_alnum($cedula) or !ctype_alnum($password)) {
	header("location: index.php?alert=1");
} else {

	$query = mysqli_query($conn, "SELECT * FROM users,members WHERE users.cedula = members.cedula AND users.cedula='$cedula' AND users.password_hash ='$password' AND users.estatus='activo'")
		or die('error' . mysqli_error($conn));
	$rows  = mysqli_num_rows($query);

	if ($rows > 0) {
		$data  = mysqli_fetch_assoc($query);

		$type_user = $data['id_user_type'];

		session_start();
		$_SESSION['id_miembro']   = $data['id_miembro'];
		$_SESSION['email']  = $data['email'];
		$_SESSION['cedula']  = $data['cedula'];
		$_SESSION['password']  = $data['password_hash'];
		$_SESSION['id_user_type']  = $data['id_user_type '];

		if ($type_user == 1) {
			header("Location: pages/dashboard_admin.php");
		}
		if ($type_user == 2) {
			header("Location: pages/dashboard_director.php");
		}
		if ($type_user == 3) {
			header("Location: pages/dashboard_manager.php");
		}
	} else {
		header("Location: index.php?alert=1");
	}
}

?>