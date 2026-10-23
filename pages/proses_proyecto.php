

<?php


require_once('../databases/conexion.php');

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

$query_2 = mysqli_query($conn, "SELECT * FROM users WHERE users.cedula = '$_SESSION[cedula]'")
	or die('error: ' . mysqli_error($conn));

$data  = mysqli_fetch_assoc($query_2);
$val_Type_User = $data['id_user_type'];


if ($_GET['act'] == 'insert_init_dir') {
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

		$d_id_manager = 0;
		$d_solicitante_proy = mysqli_real_escape_string($conn, trim($_POST['solicitante_proy']));
		$nombre = mysqli_real_escape_string($conn, trim($_POST['nombre_proy']));
		//$lider = mysqli_real_escape_string($conn, trim($_POST['lider_proy']));
		$descripcion  = mysqli_real_escape_string($conn, trim($_POST['descripcion_proy']));
		$d_unidad_proy = mysqli_real_escape_string($conn, trim($_POST['unidad_proy']));
		$d_categoria_proy = mysqli_real_escape_string($conn, trim($_POST['categoria_proy']));
		$d_prioridad_proy = mysqli_real_escape_string($conn, trim($_POST['prioridad_proy']));
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
		//$rol = "Lider";
		$fecha_regist = mysqli_real_escape_string($conn, trim($_POST['fecha_reg']));

		$query = mysqli_query($conn, "INSERT INTO projects(id_proyecto, id_solicitante, id_manager, nombre, descripcion, unidad, tipo, prioridad, sponsor, fecha_inicio, fecha_fin, presupuesto_est, problema, objetivos, beneficios, dimension, evaluacion, comentario, avance, estatus, salud, activo)
											VALUES('$DIDM','$d_solicitante_proy','$d_id_manager','$nombre','$descripcion','$d_unidad_proy','$d_categoria_proy','$d_prioridad_proy','$d_sponsor_proy','$d_fecha_inicio_proy','$d_fecha_fin_proy','$d_presupuesto_estimado_proy','$d_problema_proy','$d_objetivos_proy','$d_beneficios_esperados_proy','$d_dimension','$d_evaluacion','$d_comentario','$d_avance','$d_estatus','$d_salud','$act')");

		if ($query) {

			if (!empty($_POST['co_autor_select'])) {
				foreach ($_POST['co_autor_select'] as $id_autor) {
					$id_autor = intval($id_autor);
					$sql = "INSERT INTO users_projects (id_projects, id_autor_user) 
						VALUES ('$DIDM', '$id_autor')";
					mysqli_query($conn, $sql);
				}
			}

			header("location: ../pages/project_tables_direct.php?alert=1");
		}
	}
	if (isset($_POST['Borrador'])) {

		$nombre = mysqli_real_escape_string($conn, trim($_POST['nombre_proy']));
		$lider = mysqli_real_escape_string($conn, trim($_POST['solicitante_proy']));
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

		$query = mysqli_query($conn, "INSERT INTO projects_draft(id_solicitante, nombre, descripcion, unidad, tipo, prioridad, sponsor, fecha_inicio, fecha_fin, presupuesto_est, problema, objetivos, beneficios, dimension, evaluacion, comentario, avance, estatus, salud, activo)
											VALUES('$lider','$nombre','$descripcion','$d_unidad_proy','$d_categoria_proy','$d_prioridad_proy','$d_sponsor_proy','$d_fecha_inicio_proy','$d_fecha_fin_proy','$d_presupuesto_estimado_proy','$d_problema_proy','$d_objetivos_proy','$d_beneficios_esperados_proy','$d_dimension','$d_evaluacion','$d_comentario','$d_avance','$d_estatus','$d_salud','$act')")
			or die('error: ' . mysqli_error($conn));

		if ($query) {
			header("location: ../pages/project_tables_direct.php?alert=1");
		}
	}
} elseif ($_GET['act'] == 'insert_init_trab') {

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

		if (!empty($_POST['co_autor_select'])) {
			foreach ($_POST['co_autor_select'] as $id_autor) {
				$id_autor = intval($id_autor);
				$sql = "INSERT INTO users_projects (id_projects, id_autor_user) 
						VALUES ('$DIDM', '$id_autor')";
				mysqli_query($conn, $sql);
			}
		}

		$d_id_manager = 0;
		$d_solicitante_proy = mysqli_real_escape_string($conn, trim($_POST['solicitante_proy']));
		$nombre = mysqli_real_escape_string($conn, trim($_POST['nombre_proy']));
		//$lider = mysqli_real_escape_string($conn, trim($_POST['lider_proy']));
		$descripcion  = mysqli_real_escape_string($conn, trim($_POST['descripcion_proy']));
		$d_unidad_proy = mysqli_real_escape_string($conn, trim($_POST['unidad_proy']));
		$d_categoria_proy = mysqli_real_escape_string($conn, trim($_POST['categoria_proy']));
		$d_prioridad_proy = mysqli_real_escape_string($conn, trim($_POST['prioridad_proy']));
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
		//$rol = "Lider";
		$fecha_regist = mysqli_real_escape_string($conn, trim($_POST['fecha_reg']));

		$query = mysqli_query($conn, "INSERT INTO projects(id_proyecto, id_solicitante, id_manager, nombre, descripcion, unidad, tipo, prioridad, sponsor, fecha_inicio, fecha_fin, presupuesto_est, problema, objetivos, beneficios, dimension, evaluacion, comentario, avance, estatus, salud, activo)
											VALUES('$DIDM','$d_solicitante_proy','$d_id_manager','$nombre','$descripcion','$d_unidad_proy','$d_categoria_proy','$d_prioridad_proy','$d_sponsor_proy','$d_fecha_inicio_proy','$d_fecha_fin_proy','$d_presupuesto_estimado_proy','$d_problema_proy','$d_objetivos_proy','$d_beneficios_esperados_proy','$d_dimension','$d_evaluacion','$d_comentario','$d_avance','$d_estatus','$d_salud','$act')");

		if ($query) {

			header("location: ../pages/project_tables_trab.php?alert=1");
		}
	}
} elseif ($_GET['act'] == 'insert_borr_init') {

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

	$id_borr = mysqli_real_escape_string($conn, trim($_POST['borra_id_Proy']));
	$d_id_manager = 0;
	$nombre = mysqli_real_escape_string($conn, trim($_POST['borra_nombre_proy']));
	//$lider = mysqli_real_escape_string($conn, trim($_POST['borra_pm_proy']));
	$descripcion  = mysqli_real_escape_string($conn, trim($_POST['borra_descrip_proy']));
	$d_unidad_proy = mysqli_real_escape_string($conn, trim($_POST['borra_unidad_proy']));
	$d_categoria_proy = mysqli_real_escape_string($conn, trim($_POST['borra_tipo_proy']));
	$d_prioridad_proy = mysqli_real_escape_string($conn, trim($_POST['borra_prio_proy']));
	$d_solicitante_proy = mysqli_real_escape_string($conn, trim($_POST['borra_solic_proy']));
	$d_sponsor_proy = mysqli_real_escape_string($conn, trim($_POST['borra_sponsor_proy']));
	$d_fecha_inicio_proy = mysqli_real_escape_string($conn, trim($_POST['borra_fech_ini_proy']));
	$d_fecha_fin_proy = mysqli_real_escape_string($conn, trim($_POST['borra_fech_fin_proy']));
	$d_presupuesto_estimado_proy = mysqli_real_escape_string($conn, trim($_POST['borra_pres_proy']));
	$d_problema_proy = mysqli_real_escape_string($conn, trim($_POST['borra_problema_proy']));
	$d_objetivos_proy = mysqli_real_escape_string($conn, trim($_POST['borra_objetivos_proy']));
	$d_beneficios_esperados_proy = mysqli_real_escape_string($conn, trim($_POST['borra_beneficios_proy']));
	$d_dimension = null;
	$d_evaluacion = null;
	$d_comentario = null;
	$d_avance = 0;
	$d_estatus = "Propuesto";
	$d_salud = "En control";
	$act = 1;
	$rol = "Lider";

	$query = mysqli_query($conn, "INSERT INTO projects(id_proyecto, id_solicitante, id_manager, nombre, descripcion, unidad, tipo, prioridad, sponsor, fecha_inicio, fecha_fin, presupuesto_est, problema, objetivos, beneficios, dimension, evaluacion, comentario, avance, estatus, salud, activo)
											VALUES('$DIDM','$d_solicitante_proy','$d_id_manager','$nombre','$descripcion','$d_unidad_proy','$d_categoria_proy','$d_prioridad_proy','$d_sponsor_proy','$d_fecha_inicio_proy','$d_fecha_fin_proy','$d_presupuesto_estimado_proy','$d_problema_proy','$d_objetivos_proy','$d_beneficios_esperados_proy','$d_dimension','$d_evaluacion','$d_comentario','$d_avance','$d_estatus','$d_salud','$act')");

	if ($query) {

		$Sql_3 = "DELETE FROM projects_draft WHERE projects_draft.id_draf_proy = $id_borr";
		$elim_proyect = mysqli_query($conn, $Sql_3);

		header("location: ../pages/project_tables_draft.php?alert=1");
	}
} elseif ($_GET['act'] == 'update_valid_proy_trab') {

	$id_proy = mysqli_real_escape_string($conn, trim($_POST['id_proyecto']));
	$status_val = "Evaluacion";

	$query = mysqli_query($conn, "UPDATE projects SET estatus='$status_val' WHERE projects.id_proyecto = '$id_proy'");

	if ($query) {

		if ($val_Type_User == 1) {
			header("location: ../pages/project_tables_direct.php");
		}

		if ($val_Type_User == 2) {
			header("location: ../pages/project_tables_jef.php?alert=1");
		}

		if ($val_Type_User == 3) {
			header("location: ../pages/project_tables_trab.php?alert=1");
		}
	}
} elseif ($_GET['act'] == 'update_asig_eval') {

	$id_proy = mysqli_real_escape_string($conn, trim($_POST['edit_id_Proy_2']));
	$id_val = mysqli_real_escape_string($conn, trim($_POST['select_id_eval_proy']));

	$Carg = "UPDATE projects SET id_validador='$id_val' WHERE projects.id_proyecto = '$id_proy'";

	$query = mysqli_query($conn, $Carg);

	if ($query) {

		//echo ($Carg);

		header("location: ../pages/project_tables_direct.php?alert=1");
	}
} elseif ($_GET['act'] == 'insert_eval_proy') {

	$id_proy = mysqli_real_escape_string($conn, trim($_POST['edit_id_Proy_2']));
	$dimen_proy = mysqli_real_escape_string($conn, trim($_POST['dimen_proy_valid']));
	$eval_proy = mysqli_real_escape_string($conn, trim($_POST['edit_id_Proy_2']));
	$coment_proy = mysqli_real_escape_string($conn, trim($_POST['edit_id_Proy_2']));
	$status_val = "Decision";

	$query = mysqli_query($conn, "UPDATE projects SET dimension = '$dimen_proy', evaluacion = '$eval_proy', comentario = '$coment_proy',estatus='$status_val' WHERE projects.id_proyecto = '$id_proy'");

	if ($query) {

		header("location: ../pages/project_tables_jef.php?alert=1");
	}
}

?>