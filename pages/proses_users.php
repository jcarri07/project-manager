

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

if ($_GET['act'] == 'insert_members_users') {
	if (isset($_POST['Guardar'])) {

		$D_cedula  = mysqli_real_escape_string($conn, trim($_POST['cedula_reg']));
		$D_nombres  = mysqli_real_escape_string($conn, trim($_POST['nombres_reg']));
		$D_apellidos = mysqli_real_escape_string($conn, trim($_POST['apellidos_reg']));
		$D_correo = mysqli_real_escape_string($conn, trim($_POST['correo_reg']));
		$D_password = mysqli_real_escape_string($conn, trim($_POST['password_reg']));
		$D_especialidad = mysqli_real_escape_string($conn, trim($_POST['especialidad_reg']));
		$D_fecha = mysqli_real_escape_string($conn, trim($_POST['fecha_reg']));
		$D_estatus = "activo";

		$carpeta_destino = "../assets/img/img_users/";

		$nombre_archivo1 = basename($_FILES["foto_reg"]["name"]);
		$extension1 = strtolower(pathinfo($nombre_archivo1, PATHINFO_EXTENSION));
		$Destino1 = $carpeta_destino . $nombre_archivo1;

		if ((is_uploaded_file($_FILES["foto_reg"]["tmp_name"]) && move_uploaded_file($_FILES["foto_reg"]["tmp_name"], $carpeta_destino . $nombre_archivo1))) {

			$Sqll_1 = "INSERT INTO members(cedula, nombre, apellido, email, especialidad, foto_personal, registrado) 
				VALUES ('$D_cedula','$D_nombres','$D_apellidos','$D_correo','$D_especialidad','$Destino1','$D_fecha')";
			$Carg1 = mysqli_query($conn, $Sqll_1);

			$Sqll_2 = "INSERT INTO users(cedula, email, password_hash, fecha_creacion, foto_personal, estatus) 
				VALUES ('$D_cedula','$D_correo','$D_password','$D_fecha','$Destino1','$D_estatus')";
			$Carg2 = mysqli_query($conn, $Sqll_2);

			if (($Carg1) && ($Carg2)) {
				header("location: ../profile.php");
			}
		}
	}
} elseif ($_GET['act'] == 'insert_miembros') {
	if (isset($_POST['Guardar'])) {

		$D_cedula  = mysqli_real_escape_string($conn, trim($_POST['cedula_reg_min']));
		$D_nombres  = mysqli_real_escape_string($conn, trim($_POST['nombres_reg_min']));
		$D_apellidos = mysqli_real_escape_string($conn, trim($_POST['apellidos_reg_min']));
		$D_correo = mysqli_real_escape_string($conn, trim($_POST['email_reg_min']));
		$D_especialidad = mysqli_real_escape_string($conn, trim($_POST['especialidad_reg_min']));
		$D_fecha = mysqli_real_escape_string($conn, trim($_POST['fecha_reg_min']));
		$carpeta_destino = "../assets/img/img_users/";

		$nombre_archivo1 = basename($_FILES["foto_reg_min"]["name"]);
		$extension1 = strtolower(pathinfo($nombre_archivo1, PATHINFO_EXTENSION));
		$Destino1 = $carpeta_destino . $nombre_archivo1;

		if ((is_uploaded_file($_FILES["foto_reg_min"]["tmp_name"]) && move_uploaded_file($_FILES["foto_reg_min"]["tmp_name"], $carpeta_destino . $nombre_archivo1))) {

			$Sqll_1 = "INSERT INTO members(cedula, nombre, apellido, email, especialidad, foto_personal, registrado) 
				VALUES ('$D_cedula','$D_nombres','$D_apellidos','$D_correo','$D_especialidad','$Destino1','$D_fecha')";
			$Carg1 = mysqli_query($conn, $Sqll_1);

			if ($Carg1) {
				header("location: ../pages/pag_admin_users.php?alert=1");
			}
		}
	}
} elseif ($_GET['act'] == 'update_miembros') {

	if (isset($_POST['Guardar'])) {

		$D_id_miemb  = mysqli_real_escape_string($conn, trim($_POST['edit_id_miem']));
		$D_cedul_miemb  = mysqli_real_escape_string($conn, trim($_POST['edit_ced_miem']));
		$D_nombres_edit  = mysqli_real_escape_string($conn, trim($_POST['edit_nombre_miem']));
		$D_apellidos_edit = mysqli_real_escape_string($conn, trim($_POST['edit_apell_miem']));
		$D_correo_edit = mysqli_real_escape_string($conn, trim($_POST['edit_corr_miem']));
		$D_especialidad_edit = mysqli_real_escape_string($conn, trim($_POST['edit_esp_miem']));

		$carpeta_destino = "../assets/img/img_users/";

		$nombre_archivo1 = basename($_FILES["Arc_fot_miem"]["name"]);
		$extension1 = strtolower(pathinfo($nombre_archivo1, PATHINFO_EXTENSION));

		$Destino1 = $carpeta_destino . $nombre_archivo1;

		if (($extension1 == "png") || ($extension1 == "jpg")) {

			if ((is_uploaded_file($_FILES["Arc_fot_miem"]["tmp_name"]) && move_uploaded_file($_FILES["Arc_fot_miem"]["tmp_name"], $carpeta_destino . $nombre_archivo1))) {

				$C1 = ("UPDATE members SET foto_personal = '$Destino1' WHERE members.id_miembro='$D_id_miemb' ");

				$Carg1 = mysqli_query($conn, $C1);

				$C2 = ("UPDATE users SET foto_personal = '$Destino1' WHERE users.cedula='$D_cedul_miemb' ");

				$Carg2 = mysqli_query($conn, $C2);

				if (!$Carg1) {
					header("location: ../pages/pag_admin_users.php?alert=3");
				}
			}
		}

		$C3 = "UPDATE members SET nombre = '$D_nombres_edit', apellido = '$D_apellidos_edit', email = '$D_correo_edit', especialidad = '$D_especialidad_edit' WHERE members.id_miembro='$D_id_miemb' ";

		$Carg3 = mysqli_query($conn, $C3);

		$C4 = ("UPDATE users SET email = '$D_correo_edit' WHERE users.cedula='$D_cedul_miemb' ");

		$Carg4 = mysqli_query($conn, $C4);

		if ($Carg3) {
			//echo ("$C3 " . " " . "Hola 3 " . " $C2");
			header("location: ../pages/pag_admin_users.php?alert=2");
		} else {
			header("location: ../pages/pag_admin_users.php?alert=3");
		}
	}
} elseif ($_GET['act'] == 'update_members_users') {

	if (isset($_POST['Guardar'])) {

		$Data_cedul_prev = mysqli_real_escape_string($conn, trim($_POST['data_cedul_ini']));
		$D_id_users  = mysqli_real_escape_string($conn, trim($_POST['data_id_prev']));

		$D_cedul_users  = mysqli_real_escape_string($conn, trim($_POST['cedula_users']));
		$D_nombres_users  = mysqli_real_escape_string($conn, trim($_POST['nombres_users']));
		$D_apellidos_users = mysqli_real_escape_string($conn, trim($_POST['apellidos_user']));
		$D_correo_users = mysqli_real_escape_string($conn, trim($_POST['correo_user']));
		$D_especialidad_users = mysqli_real_escape_string($conn, trim($_POST['especialidad_user']));
		$D_password_users = mysqli_real_escape_string($conn, trim($_POST['password_user']));

		$carpeta_destino = "../assets/img/img_users/";

		$nombre_archivo1 = basename($_FILES["foto_user"]["name"]);
		$extension1 = strtolower(pathinfo($nombre_archivo1, PATHINFO_EXTENSION));

		$Destino1 = $carpeta_destino . $nombre_archivo1;

		if (($extension1 == "png") || ($extension1 == "jpg")) {

			if ((is_uploaded_file($_FILES["foto_user"]["tmp_name"]) && move_uploaded_file($_FILES["foto_user"]["tmp_name"], $carpeta_destino . $nombre_archivo1))) {

				$C1 = ("UPDATE members SET foto_personal = '$Destino1' WHERE members.cedula='$Data_cedul_prev' ");

				$Carg1 = mysqli_query($conn, $C1);

				$C2 = ("UPDATE users SET foto_personal = '$Destino1' WHERE users.id_usuario ='$D_id_users' ");

				$Carg2 = mysqli_query($conn, $C2);

				if (!$Carg1) {
					header("location: ../pages/profile.php?alert=3");
				}
			}
		}

		$C3 = "UPDATE members SET cedula = '$D_cedul_users', nombre = '$D_nombres_users', apellido = '$D_apellidos_users', email = '$D_correo_users', especialidad = '$D_especialidad_users' WHERE members.cedula='$Data_cedul_prev' ";

		$Carg3 = mysqli_query($conn, $C3);

		$C4 = ("UPDATE users SET cedula = '$D_cedul_users', email = '$D_correo_users', password_hash = '$D_password_users' WHERE users.id_usuario ='$D_id_users' ");

		$Carg4 = mysqli_query($conn, $C4);

		if (($Carg3) && ($Carg4)) {
			//echo ("$C3 " . " " . "Hola 3 " . " $C2");
			header("location: ../pages/profile.php?alert=2");
		} else {
			header("location: ../pages/profile.php?alert=3");
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

/*
	elseif ($_GET['act']=='off' && $_SESSION['permisos_acceso'] == "Super Admin") {
		if (isset($_GET['id'])) {
			
			$id_user = $_GET['id'];
			$status  = "bloqueado";

		
            $query = mysqli_query($conn, "UPDATE usuarios SET status  = '$status'
                                                          WHERE id_user = '$id_user'")
                                            or die('Error : '.mysqli_error($conn));

        
            if ($query) {
              
                header("location: ../../main.php?module=user&alert=4");
            }
		}
	}*/

?>