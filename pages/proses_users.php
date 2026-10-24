

<?php
/*session_start();

$NombreUser = $_SESSION['name_user'];
$iduser = $_SESSION['id_user'];
$accion = "";
$cedulauser = $_SESSION['cedula_user'];

require_once "../../config/database.php";


if (empty($_SESSION['username']) && empty($_SESSION['password'])){
	echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
}*/

require_once('../databases/conexion.php');


/*else {*/

if ($_GET['act'] == 'insert_users') {
	if (isset($_POST['Guardar'])) {

		$D_unid_user  = mysqli_real_escape_string($conn, trim($_POST['unidad_user']));
		$D_nombres  = mysqli_real_escape_string($conn, trim($_POST['nombres_reg_min']));
		$D_apellidos  = mysqli_real_escape_string($conn, trim($_POST['apellidos_reg_min']));
		$D_cedula  = mysqli_real_escape_string($conn, trim($_POST['cedula_reg_min']));
		$D_correo = mysqli_real_escape_string($conn, trim($_POST['email_reg_min']));
		$D_especialidad = mysqli_real_escape_string($conn, trim($_POST['especialidad_reg_min']));
		$D_fecha = mysqli_real_escape_string($conn, trim($_POST['fecha_reg_min']));
		$D_level  = mysqli_real_escape_string($conn, trim($_POST['level_user_new']));
		$D_password = mysqli_real_escape_string($conn, trim($_POST['password_reg']));
		$D_estatus = "activo";

		$carpeta_destino = "../assets/img/img_users/";

		$nombre_archivo1 = basename($_FILES["foto_reg_min"]["name"]);
		$extension1 = strtolower(pathinfo($nombre_archivo1, PATHINFO_EXTENSION));
		$Destino1 = $carpeta_destino . $nombre_archivo1;

		if ((is_uploaded_file($_FILES["foto_reg_min"]["tmp_name"]) && move_uploaded_file($_FILES["foto_reg_min"]["tmp_name"], $carpeta_destino . $nombre_archivo1))) {

			$Sqll_1 = "INSERT INTO users(id_user_type, id_unidad, nombre_user, apellido_user, cedula, email, especialidad, password_hash, fecha_creacion, foto_personal, estatus) 
				VALUES ('$D_level','$D_unid_user','$D_nombres','$D_apellidos','$D_cedula','$D_correo','$D_especialidad','$D_password','$D_fecha','$Destino1','$D_estatus')";
			$Carg1 = mysqli_query($conn, $Sqll_1);

			if ($Carg1) {
				header("location: ../pages/pag_admin_users.php?alert=1");
			}
		}
	}
} elseif ($_GET['act'] == 'update_users') {

	if (isset($_POST['Guardar'])) {

		$D_id_type  = mysqli_real_escape_string($conn, trim($_POST['edit_type_user']));
		$D_id_unid  = mysqli_real_escape_string($conn, trim($_POST['edit_unid_user']));
		$D_id_users  = mysqli_real_escape_string($conn, trim($_POST['edit_id_miem']));
		$D_level_users  = mysqli_real_escape_string($conn, trim($_POST['level_user']));
		$D_cedul_users  = mysqli_real_escape_string($conn, trim($_POST['edit_ced_miem']));
		$D_nombres_users  = mysqli_real_escape_string($conn, trim($_POST['edit_nombre_miem']));
		$D_apellidos_users = mysqli_real_escape_string($conn, trim($_POST['edit_apell_miem']));
		$D_correo_users = mysqli_real_escape_string($conn, trim($_POST['edit_corr_miem']));
		$D_especialidad_users = mysqli_real_escape_string($conn, trim($_POST['edit_esp_miem']));
		$D_password_users = mysqli_real_escape_string($conn, trim($_POST['edit_passw_user']));

		$carpeta_destino = "../assets/img/img_users/";

		$nombre_archivo1 = basename($_FILES["Arc_fot_miem"]["name"]);
		$extension1 = strtolower(pathinfo($nombre_archivo1, PATHINFO_EXTENSION));

		$Destino1 = $carpeta_destino . $nombre_archivo1;

		if (($extension1 == "png") || ($extension1 == "jpg")) {

			if ((is_uploaded_file($_FILES["Arc_fot_miem"]["tmp_name"]) && move_uploaded_file($_FILES["Arc_fot_miem"]["tmp_name"], $carpeta_destino . $nombre_archivo1))) {

				$C2 = ("UPDATE users SET foto_personal = '$Destino1' WHERE users.id_usuario ='$D_id_users' ");

				$Carg2 = mysqli_query($conn, $C2);

				if (!$Carg1) {
					header("location: ../pages/pag_admin_users.php?alert=3");
				}
			}
		}

		$C4 = ("UPDATE users SET id_user_type = '$D_id_type', id_unidad = '$D_id_unid', nombre_user = '$D_nombres_users', apellido_user = '$D_apellidos_users', cedula = '$D_cedul_users', email = '$D_correo_users', especialidad = '$D_especialidad_users', password_hash = '$D_password_users' WHERE users.id_usuario ='$D_id_users' ");

		$Carg4 = mysqli_query($conn, $C4);

		if (($Carg4)) {
			//echo ("$C3 " . " " . "Hola 3 " . " $C2");
			header("location: ../pages/pag_admin_users.php?alert=2");
		} else {
			header("location: ../pages/pag_admin_users.php?alert=3");
		}
	}
} elseif ($_GET['act'] == 'insert_miembros_proyectos') {

	if (isset($_POST['Guardar'])) {

		$Data_id_proy = mysqli_real_escape_string($conn, trim($_POST['miembros_id_proyecto']));
		$D_id_new_member  = mysqli_real_escape_string($conn, trim($_POST['new_member']));
		$D_miembro_rol_proyect  = mysqli_real_escape_string($conn, trim($_POST['miembro_rol_proyect']));
		$D_fecha_reg_memb  = mysqli_real_escape_string($conn, trim($_POST['fecha_reg_memb']));

		$C1 = ("INSERT INTO project_miembro(id_proyecto, id_miembro, rol_proyecto, fecha_asignacion) 
			VALUES ('$Data_id_proy','$D_id_new_member','$D_miembro_rol_proyect','$D_fecha_reg_memb')");

		$Carg1 = mysqli_query($conn, $C1);

		if (($Carg1)) {
			//echo ("$C3 " . " " . "Hola 3 " . " $C2");
			header("location: ../pages/project_tables.php?alert=1");
		} else {
			header("location: ../pages/project_tables.php?alert=3");
		}
	}
}

?>