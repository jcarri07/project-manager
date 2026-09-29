

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
				header("location: ../index.php");
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