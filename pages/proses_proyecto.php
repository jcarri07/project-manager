

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

if ($_GET['act'] == 'insert_init') {
	if (isset($_POST['Guardar'])) {


		$cont = 0;
		$sql0 = ("SELECT * FROM projects");
		$result = mysqli_query($conn, $sql0);
		$datos = array();

		while ($row = mysqli_fetch_array($result)) {
			$cont++;
		}

		if ($cont == 0) {
			$DIDM = 1;
		} else {
			$DIDM = $cont + 1;
		}

		$nombre = mysqli_real_escape_string($conn, trim($_POST['nombre_proy']));
		$lider = mysqli_real_escape_string($conn, trim($_POST['lider_proy']));
		$descripcion  = mysqli_real_escape_string($conn, trim($_POST['descripcion_proy']));
		$d_unidad_proy = mysqli_real_escape_string($conn, trim($_POST['unidad_proy']));
		$d_categoria_proy = mysqli_real_escape_string($conn, trim($_POST['categoria_proy']));
		$d_prioridad_proy = mysqli_real_escape_string($conn, trim($_POST['prioridad_proy']));
		$d_solicitante_proy = mysqli_real_escape_string($conn, trim($_POST['solicitante_proy']));
		$d_sponsor_proy = mysqli_real_escape_string($conn, trim($_POST['sponsor_proy']));
		$d_fecha_inicio_proy = mysqli_real_escape_string($conn, trim($_POST['fecha_inicio_proy']));
		$d_fecha_fin_proy = mysqli_real_escape_string($conn, trim($_POST['fecha_fin_proy']));
		$d_presupuesto_estimado_proy = mysqli_real_escape_string($conn, trim($_POST['presupuesto_estimado_proy']));
		$d_problema_proy = mysqli_real_escape_string($conn, trim($_POST['problema_proy']));
		$d_objetivos_proy = mysqli_real_escape_string($conn, trim($_POST['objetivos_proy']));
		$d_beneficios_esperados_proy = mysqli_real_escape_string($conn, trim($_POST['beneficios_esperados_proy']));
		$d_dimension = null;
		$d_evaluacion = null;
		$d_comentario = null;
		$d_avance = 0;
		$d_estatus = "Propuesto";
		$d_salud = "En control";
		$act = 1;
		$rol = "Lider";
		$fecha_regist = mysqli_real_escape_string($conn, trim($_POST['fecha_reg']));

		$query = mysqli_query($conn, "INSERT INTO projects(id_proyecto, id_manager, nombre, descripcion, unidad, tipo, prioridad, solicitante, sponsor, fecha_inicio, fecha_fin, presupuesto_est, problema, objetivos, beneficios, dimension, evaluacion, comentario, avance, estatus, salud, activo)
											VALUES('$DIDM','$lider','$nombre','$descripcion','$d_unidad_proy','$d_categoria_proy','$d_prioridad_proy','$d_solicitante_proy','$d_sponsor_proy','$d_fecha_inicio_proy','$d_fecha_fin_proy','$d_presupuesto_estimado_proy','$d_problema_proy','$d_objetivos_proy','$d_beneficios_esperados_proy','$d_dimension','$d_evaluacion','$d_comentario','$d_avance','$d_estatus','$d_salud','$act')")
			or die('error: ' . mysqli_error($conn));

		if ($query) {
			$Sql_2 = "INSERT INTO project_miembro(id_proyecto, id_miembro, rol_proyecto, fecha_asignacion) 
						VALUES ('$DIDM','$lider','$rol','$fecha_regist')";
			$Carg_project_miembro = mysqli_query($conn, $Sql_2);

			header("location: ../pages/project_tables.php?alert=1");
		}
	}
	if (isset($_POST['Borrador'])) {

		$nombre = mysqli_real_escape_string($conn, trim($_POST['nombre_proy']));
		$lider = mysqli_real_escape_string($conn, trim($_POST['lider_proy']));
		$descripcion  = mysqli_real_escape_string($conn, trim($_POST['descripcion_proy']));
		$d_unidad_proy = mysqli_real_escape_string($conn, trim($_POST['unidad_proy']));
		$d_categoria_proy = mysqli_real_escape_string($conn, trim($_POST['categoria_proy']));
		$d_prioridad_proy = mysqli_real_escape_string($conn, trim($_POST['prioridad_proy']));
		$d_solicitante_proy = mysqli_real_escape_string($conn, trim($_POST['solicitante_proy']));
		$d_sponsor_proy = mysqli_real_escape_string($conn, trim($_POST['sponsor_proy']));
		$d_fecha_inicio_proy = mysqli_real_escape_string($conn, trim($_POST['fecha_inicio_proy']));
		$d_fecha_fin_proy = mysqli_real_escape_string($conn, trim($_POST['fecha_fin_proy']));
		$d_presupuesto_estimado_proy = mysqli_real_escape_string($conn, trim($_POST['presupuesto_estimado_proy']));
		$d_problema_proy = mysqli_real_escape_string($conn, trim($_POST['problema_proy']));
		$d_objetivos_proy = mysqli_real_escape_string($conn, trim($_POST['objetivos_proy']));
		$d_beneficios_esperados_proy = mysqli_real_escape_string($conn, trim($_POST['beneficios_esperados_proy']));
		$d_dimension = null;
		$d_evaluacion = null;
		$d_comentario = null;
		$d_avance = 0;
		$d_estatus = "Propuesto";
		$d_salud = "En control";
		$act = 1;

		$query = mysqli_query($conn, "INSERT INTO projects_draft(id_manager, nombre, descripcion, unidad, tipo, prioridad, solicitante, sponsor, fecha_inicio, fecha_fin, presupuesto_est, problema, objetivos, beneficios, dimension, evaluacion, comentario, avance, estatus, salud, activo)
											VALUES('$lider','$nombre','$descripcion','$d_unidad_proy','$d_categoria_proy','$d_prioridad_proy','$d_solicitante_proy','$d_sponsor_proy','$d_fecha_inicio_proy','$d_fecha_fin_proy','$d_presupuesto_estimado_proy','$d_problema_proy','$d_objetivos_proy','$d_beneficios_esperados_proy','$d_dimension','$d_evaluacion','$d_comentario','$d_avance','$d_estatus','$d_salud','$act')")
			or die('error: ' . mysqli_error($conn));

		if ($query) {
			header("location: ../pages/project_tables.php?alert=1");
		}
	}
} elseif ($_GET['act'] == 'update') {
} elseif ($_GET['act'] == 'delete' /*&& $_SESSION['permisos_acceso'] == "Super Admin"*/) {

	if (isset($_GET['id'])) {
		$id_user = $_GET['id'];

		$query = mysqli_query($conn, "DELETE FROM members WHERE id=  '$id_user'")
			or die('error ' . mysqli_error($conn));

		if ($query) {

			header("location: ../pages/profile.php?alert=4");
		}
	}
}

?>