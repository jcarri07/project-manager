

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

			if ($val_Type_User == 1) {
				header("location: ../pages/project_tables_direct.php?alert=1");
			}
			if ($val_Type_User == 2) {
				header("location: ../pages/project_tables_jef.php?alert=1");
			}
			if ($val_Type_User == 3) {
				header("location: ../pages/project_tables_trab.php?alert=1");
			}
		}
	}
	if (isset($_POST['Borrador'])) {

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
		$d_estatus = "Borrador";
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

			if ($val_Type_User == 1) {
				header("location: ../pages/project_tables_direct.php?alert=1");
			}
			if ($val_Type_User == 2) {
				header("location: ../pages/project_tables_jef.php?alert=1");
			}
			if ($val_Type_User == 3) {
				header("location: ../pages/project_tables_trab.php?alert=1");
			}
		}
	}
} elseif ($_GET['act'] == 'insert_borr_init') {

	$id_borr = mysqli_real_escape_string($conn, trim($_POST['borra_id_Proy']));
	$d_nombre = mysqli_real_escape_string($conn, trim($_POST['borra_nombre_proy']));
	$d_descripcion  = mysqli_real_escape_string($conn, trim($_POST['borra_descrip_proy']));
	$d_unidad_proy = mysqli_real_escape_string($conn, trim($_POST['borra_unidad_proy']));
	$d_categoria_proy = mysqli_real_escape_string($conn, trim($_POST['borra_tipo_proy']));
	$d_prioridad_proy = mysqli_real_escape_string($conn, trim($_POST['borra_prio_proy']));
	//$d_solicitante_proy = mysqli_real_escape_string($conn, trim($_POST['borra_solic_proy']));
	$d_sponsor_proy = mysqli_real_escape_string($conn, trim($_POST['borra_sponsor_proy']));
	$d_fecha_inicio_proy = mysqli_real_escape_string($conn, trim($_POST['borra_fech_ini_proy']));
	$d_fecha_fin_proy = mysqli_real_escape_string($conn, trim($_POST['borra_fech_fin_proy']));
	$d_presupuesto_estimado_proy = mysqli_real_escape_string($conn, trim($_POST['borra_pres_proy']));
	$d_problema_proy = mysqli_real_escape_string($conn, trim($_POST['borra_problema_proy']));
	$d_objetivos_proy = mysqli_real_escape_string($conn, trim($_POST['borra_objetivos_proy']));
	$d_beneficios_esperados_proy = mysqli_real_escape_string($conn, trim($_POST['borra_beneficios_proy']));
	$d_estatus = "Propuesto";

	$query = mysqli_query($conn, "UPDATE projects SET nombre='$d_nombre',descripcion='$d_descripcion',unidad='$d_unidad_proy',tipo='$d_categoria_proy',prioridad='$d_prioridad_proy',sponsor='$d_sponsor_proy',fecha_inicio='$d_fecha_inicio_proy',fecha_fin='$d_fecha_fin_proy',presupuesto_est='$d_presupuesto_estimado_proy',problema='$d_problema_proy',objetivos='$d_objetivos_proy',beneficios='$d_beneficios_esperados_proy',estatus='$d_estatus' WHERE projects.id_proyecto = '$id_borr' ");

	if ($query) {

		if ($val_Type_User == 1) {
			header("location: ../pages/project_tables_direct.php?alert=1");
		}
		if ($val_Type_User == 2) {
			header("location: ../pages/project_tables_jef.php?alert=1");
		}
		if ($val_Type_User == 3) {
			header("location: ../pages/project_tables_trab.php?alert=1");
		}
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
	$eval_proy = mysqli_real_escape_string($conn, trim($_POST['eval_proy_valid']));
	$coment_proy = mysqli_real_escape_string($conn, trim($_POST['coment_proy_valid']));
	$status_val = "Aprobacion";

	$query = mysqli_query($conn, "UPDATE projects SET dimension = '$dimen_proy', evaluacion = '$eval_proy', comentario = '$coment_proy',estatus='$status_val' WHERE projects.id_proyecto = '$id_proy'");

	if ($query) {

		header("location: ../pages/project_tables_jef.php?alert=1");
	}
} elseif ($_GET['act'] == 'insert_decision_proy') {

	$id_proy = mysqli_real_escape_string($conn, trim($_POST['edit_id_Proy_3']));
	$just_proy = mysqli_real_escape_string($conn, trim($_POST['justificacion_proy_3']));
	$decis_proy = mysqli_real_escape_string($conn, trim($_POST['decision_proy']));
	$status_val = "Evaluacion";

	switch ($decis_proy) {
		case 1:
			$status_val = "Planificacion";
			break;
		case 2:
			$status_val = "Evaluacion";
			break;
		case 3:
			$status_val = "Cancelado";
			break;
	}

	$query = mysqli_query($conn, "UPDATE projects SET decision_dir = '$decis_proy', justificacion_dir = '$just_proy', estatus='$status_val' WHERE projects.id_proyecto = '$id_proy'");

	if ($query) {

		header("location: ../pages/project_tables_direct.php?alert=1");
	}
} elseif ($_GET['act'] == 'update_proy_propio') {
	$d_id_proy = mysqli_real_escape_string($conn, trim($_POST['edit_id_Proy_1']));
	$d_nombre = mysqli_real_escape_string($conn, trim($_POST['edit_nombre_proy_1']));
	$d_descripcion  = mysqli_real_escape_string($conn, trim($_POST['edit_descripcion_proy_1']));
	$d_unidad_proy = mysqli_real_escape_string($conn, trim($_POST['edit_unidad_proy_1']));
	$d_categoria_proy = mysqli_real_escape_string($conn, trim($_POST['edit_tipo_proy_1']));
	$d_prioridad_proy = mysqli_real_escape_string($conn, trim($_POST['edit_prioridad_proy_1']));
	//$d_solicitante_proy = mysqli_real_escape_string($conn, trim($_POST['borra_solic_proy']));
	$d_sponsor_proy = mysqli_real_escape_string($conn, trim($_POST['edit_sponsor_proy_1']));
	$d_fecha_inicio_proy = mysqli_real_escape_string($conn, trim($_POST['edit_fecha_inicio_proy_1']));
	$d_fecha_fin_proy = mysqli_real_escape_string($conn, trim($_POST['edit_fecha_fin_proy_1']));
	$d_presupuesto_estimado_proy = mysqli_real_escape_string($conn, trim($_POST['edit_presupuesto_est_proy_1']));
	$d_problema_proy = mysqli_real_escape_string($conn, trim($_POST['edit_problema_proy_1']));
	$d_objetivos_proy = mysqli_real_escape_string($conn, trim($_POST['edit_objetivos_proy_1']));
	$d_beneficios_esperados_proy = mysqli_real_escape_string($conn, trim($_POST['edit_beneficios_proy_1']));

	$query = mysqli_query($conn, "UPDATE projects SET nombre='$d_nombre',descripcion='$d_descripcion',unidad='$d_unidad_proy',tipo='$d_categoria_proy',prioridad='$d_prioridad_proy',sponsor='$d_sponsor_proy',fecha_inicio='$d_fecha_inicio_proy',fecha_fin='$d_fecha_fin_proy',presupuesto_est='$d_presupuesto_estimado_proy',problema='$d_problema_proy',objetivos='$d_objetivos_proy',beneficios='$d_beneficios_esperados_proy' WHERE projects.id_proyecto = '$d_id_proy' ");

	if ($query) {

		if (!empty($_POST['edit_new_co_autor_1'])) {
			foreach ($_POST['edit_new_co_autor_1'] as $id_autor) {
				$id_autor = intval($id_autor);
				$sql1 = "INSERT INTO users_projects (id_projects, id_autor_user) 
						VALUES ('$d_id_proy', '$id_autor')";
				mysqli_query($conn, $sql1);
			}
		}

		if (!empty($_POST['edit_quitar_co_autor_1'])) {
			foreach ($_POST['edit_quitar_co_autor_1'] as $id_autor_elim) {
				$id_autor_elim = intval($id_autor_elim);
				$sql2 = "DELETE FROM users_projects WHERE id_projects = '$d_id_proy' AND id_autor_user = '$id_autor_elim'";
				mysqli_query($conn, $sql2);
			}
		}

		if ($val_Type_User == 1) {
			//echo ($sql1 . "  -----  " . $sql2);
			header("location: ../pages/project_tables_direct.php?alert=1");
		}
		if ($val_Type_User == 2) {
			header("location: ../pages/project_tables_jef.php?alert=1");
		}
		if ($val_Type_User == 3) {
			header("location: ../pages/project_tables_trab.php?alert=1");
		}
	}
}

?>