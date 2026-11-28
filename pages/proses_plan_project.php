

<?php


require_once('../databases/conexion.php');

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

$query_2 = mysqli_query($conn, "SELECT * FROM users WHERE users.cedula = '$_SESSION[cedula]'")
	or die('error: ' . mysqli_error($conn));

$data  = mysqli_fetch_assoc($query_2);
$val_Type_User = $data['id_user_type'];


if ($_GET['act'] == 'insert_init_plan_proj') {

	$d_id_proyecto_for_plan = mysqli_real_escape_string($conn, trim($_POST['id_proyecto_for_plan']));
	$d_num_mayor = 1;
	$d_num_menor = 0;
	$d_estatus_plan = "Propuesto";
	$d_resu_ejec_plan = mysqli_real_escape_string($conn, trim($_POST['resu_ejec_plan']));
	$d_supuestos_plan_proj = mysqli_real_escape_string($conn, trim($_POST['supuestos_plan_proj']));
	$d_restricc_plan_proj = mysqli_real_escape_string($conn, trim($_POST['restricc_plan_proj']));
	$d_depend_externas_plan_proj = mysqli_real_escape_string($conn, trim($_POST['depend_externas_plan_proj']));
	$d_fech_ini_plan = mysqli_real_escape_string($conn, trim($_POST['fech_ini_plan']));
	$d_fech_fin_plan = mysqli_real_escape_string($conn, trim($_POST['fech_fin_plan']));
	$d_id_pm_plan = mysqli_real_escape_string($conn, trim($_POST['id_pm_plan']));
	$d_fecha_reg_min_plan_proy = mysqli_real_escape_string($conn, trim($_POST['fecha_reg_min_plan_proy']));

	$query = mysqli_query($conn, "INSERT INTO project_plans(id_proyecto, n_version_mayor, n_version_menor, estado_plan, resumen_ejecutivo, supuestos, restricciones, dependencias_externas, fecha_inicio_plan, fecha_fin_plan, id_project_manager, fecha_creacion_plan)
											VALUES('$d_id_proyecto_for_plan', '$d_num_mayor', '$d_num_menor', '$d_estatus_plan', '$d_resu_ejec_plan', '$d_supuestos_plan_proj', '$d_restricc_plan_proj', '$d_depend_externas_plan_proj', '$d_fech_ini_plan', '$d_fech_fin_plan', '$d_id_pm_plan', '$d_fecha_reg_min_plan_proy')");

	if ($query) {

		if ($val_Type_User == 1) {
			header("location: ../pages/project_indiv_tables_direct.php?alert=1");
		}
		if ($val_Type_User == 2) {
			header("location: ../pages/project_indiv_tables_jef.php?alert=1");
		}
		if ($val_Type_User == 3) {
			header("location: ../pages/project_tables_trab.php?alert=1");
		}
	}
}

if ($_GET['act'] == 'insert_alcance_plan_proy') {

	$d_id_proyecto_plan = mysqli_real_escape_string($conn, trim($_POST['id_project_plans']));
	$d_proy_plan_alcance_incluido = mysqli_real_escape_string($conn, trim($_POST['proy_plan_alcance_incluido']));
	$d_proy_plan_alcance_excluido = mysqli_real_escape_string($conn, trim($_POST['proy_plan_alcance_excluido']));
	$d_fecha_upt_plan_proy = mysqli_real_escape_string($conn, trim($_POST['fecha_upt_plan_proy']));

	$query = mysqli_query($conn, "UPDATE project_plans SET alcance_incluido='$d_proy_plan_alcance_incluido', alcance_excluido='$d_proy_plan_alcance_excluido', fecha_modificacion_plan='$d_fecha_upt_plan_proy' WHERE project_plans.id_project_plans = '$d_id_proyecto_plan' ");

	if ($query) {

		if ($val_Type_User == 1) {
			header("location: ../pages/project_indiv_tables_direct.php?alert=1");
		}
		if ($val_Type_User == 2) {
			header("location: ../pages/project_gen_tables_jef.php?alert=1");
		}
		if ($val_Type_User == 3) {
			header("location: ../pages/project_tables_trab.php?alert=1");
		}
	}
}

if ($_GET['act'] == 'insert_entregable_plan_proy') {

	$d_id_proyecto_plan = mysqli_real_escape_string($conn, trim($_POST['id_project_plans']));
	$d_nom_entregable = mysqli_real_escape_string($conn, trim($_POST['nom_entregable']));
	$d_descripcion_entre = mysqli_real_escape_string($conn, trim($_POST['descripcion_entre']));
	$d_criterios_acept = mysqli_real_escape_string($conn, trim($_POST['criterios_acept']));
	$d_id_respon_select = mysqli_real_escape_string($conn, trim($_POST['id_respon_select']));
	$d_fech_entregable = mysqli_real_escape_string($conn, trim($_POST['fech_entregable']));
	$d_estatus_entreg = "Pendiente";
	$d_fecha_reg_entreg = mysqli_real_escape_string($conn, trim($_POST['fecha_reg_entreg']));

	$query = mysqli_query($conn, "INSERT INTO project_plan_deliverables(id_project_plans , nombre_entregable, descripcion_entregable, criterio_aceptacion_entregable, id_user_responsable, fecha_objetivo_entregable, estado_entregable, fecha_creacion_entregable)
											VALUES('$d_id_proyecto_plan', '$d_nom_entregable', '$d_descripcion_entre', '$d_criterios_acept', '$d_id_respon_select', '$d_fech_entregable', '$d_estatus_entreg', '$d_fecha_reg_entreg')");

	if ($query) {

		if ($val_Type_User == 1) {
			header("location: ../pages/project_indiv_tables_direct.php?alert=1");
		}
		if ($val_Type_User == 2) {
			header("location: ../pages/project_gen_tables_jef.php?alert=1");
		}
		if ($val_Type_User == 3) {
			header("location: ../pages/project_tables_trab.php?alert=1");
		}
	}
}

if ($_GET['act'] == 'insert_actividad_tarea_plan_proy') {

	$cont = 0;
	$sql0 = ("SELECT * FROM project_activities");
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

	$d_id_project_plans = mysqli_real_escape_string($conn, trim($_POST['id_project_plans']));
	$d_nombre_actividad_proy = mysqli_real_escape_string($conn, trim($_POST['nombre_actividad_proy']));
	$d_descripcion_actividad_proy = mysqli_real_escape_string($conn, trim($_POST['descripcion_actividad_proy']));
	$d_fecha_ini_actividad_proy = mysqli_real_escape_string($conn, trim($_POST['fecha_ini_actividad_proy']));
	$d_fecha_fin_actividad_proy = mysqli_real_escape_string($conn, trim($_POST['fecha_fin_actividad_proy']));
	$d_durac_actividad_proy = mysqli_real_escape_string($conn, trim($_POST['durac_actividad_proy']));
	$d_estado_actividad = "Pendiente";
	$d_observacion_actividad_proy = mysqli_real_escape_string($conn, trim($_POST['observacion_actividad_proy']));
	$d_fecha_creac_actividad_proy = mysqli_real_escape_string($conn, trim($_POST['fecha_creac_actividad_proy']));

	$query = mysqli_query($conn, "INSERT INTO project_activities(id_project_activities, id_project_plans, nombre_actividad, descripcion_actividad, fecha_inicio_plan_actividad, fecha_fin_plan_actividad, duracion_actividad, estado_actividad, observaciones_actividad, fecha_creacion_actividad)
											VALUES('$DIDM', '$d_id_project_plans', '$d_nombre_actividad_proy', '$d_descripcion_actividad_proy', '$d_fecha_ini_actividad_proy', '$d_fecha_fin_actividad_proy', '$d_durac_actividad_proy', '$d_estado_actividad', '$d_observacion_actividad_proy', '$d_fecha_creac_actividad_proy')");

	if ($query) {

		if (!empty($_POST['respon_act_tarea'])) {
			foreach ($_POST['respon_act_tarea'] as $id_riesgo_e) {
				$id_riesgo_e = intval($id_riesgo_e);
				$sql_riesgo = "INSERT INTO users_project_activities(id_users, id_project_activities, id_project_plans) 
						VALUES ('$id_riesgo_e', '$DIDM', '$d_id_project_plans')";
				mysqli_query($conn, $sql_riesgo);
			}
		}

		if ($val_Type_User == 1) {
			header("location: ../pages/project_indiv_tables_direct.php?alert=1");
		}
		if ($val_Type_User == 2) {
			header("location: ../pages/project_gen_tables_jef.php?alert=1");
		}
		if ($val_Type_User == 3) {
			header("location: ../pages/project_tables_trab.php?alert=1");
		}
	}
}

if ($_GET['act'] == 'insert_hitos_plan_proy') {

	$d_id_project_plans = mysqli_real_escape_string($conn, trim($_POST['id_project_plans']));
	$d_nombre_hito_proy = mysqli_real_escape_string($conn, trim($_POST['nombre_hito_proy']));
	$d_descripcion_hito_proy = mysqli_real_escape_string($conn, trim($_POST['descripcion_hito_proy']));
	$d_fecha_ocurren_hito_proy = mysqli_real_escape_string($conn, trim($_POST['fecha_ocurren_hito_proy']));
	$d_estado_hito = "Pendiente";

	$query = mysqli_query($conn, "INSERT INTO project_plans_milestones(id_project_plans, nombre_hitos, descripcion_hitos, fecha_hito, estado_hito)
											VALUES('$d_id_project_plans', '$d_nombre_hito_proy', '$d_descripcion_hito_proy', '$d_fecha_ocurren_hito_proy', '$d_estado_hito')");

	if ($query) {

		if ($val_Type_User == 1) {
			header("location: ../pages/project_indiv_tables_direct.php?alert=1");
		}
		if ($val_Type_User == 2) {
			header("location: ../pages/project_gen_tables_jef.php?alert=1");
		}
		if ($val_Type_User == 3) {
			header("location: ../pages/project_tables_trab.php?alert=1");
		}
	}
}

if ($_GET['act'] == 'insert_recurso_plan_proy') {

	$d_id_project_plans = mysqli_real_escape_string($conn, trim($_POST['id_project_plans']));
	$d_tipo_recurso_proy = mysqli_real_escape_string($conn, trim($_POST['tipo_recurso_proy']));
	$d_descripcion_recurso_proy = mysqli_real_escape_string($conn, trim($_POST['descripcion_recurso_proy']));
	$d_cant_dedic_recurso_proy = mysqli_real_escape_string($conn, trim($_POST['cant_dedic_recurso_proy']));
	$d_periodo_recur_plan_proy = mysqli_real_escape_string($conn, trim($_POST['periodo_recur_plan_proy']));
	$d_id_respon_recurso_tarea = mysqli_real_escape_string($conn, trim($_POST['id_respon_recurso_tarea']));
	$d_disponib_recur_plan_proy = mysqli_real_escape_string($conn, trim($_POST['disponib_recur_plan_proy']));

	$query = mysqli_query($conn, "INSERT INTO project_plan_resources(id_project_plans, tipo_recurso, descripcion_recurso, cantidad_recurso, periodo_recurso, id_responsable_recurso, disponibilidad_recurso)
											VALUES('$d_id_project_plans', '$d_tipo_recurso_proy', '$d_descripcion_recurso_proy', '$d_cant_dedic_recurso_proy', '$d_periodo_recur_plan_proy', '$d_id_respon_recurso_tarea', '$d_disponib_recur_plan_proy')");

	if ($query) {

		if ($val_Type_User == 1) {
			header("location: ../pages/project_indiv_tables_direct.php?alert=1");
		}
		if ($val_Type_User == 2) {
			header("location: ../pages/project_gen_tables_jef.php?alert=1");
		}
		if ($val_Type_User == 3) {
			header("location: ../pages/project_tables_trab.php?alert=1");
		}
	}
}

if ($_GET['act'] == 'insert_presupuestos_plan_proy') {

	$d_id_proyecto = mysqli_real_escape_string($conn, trim($_POST['id_proyecto']));

	$sql0 = ("SELECT presupuesto_est FROM projects WHERE id_proyecto = '$d_id_proyecto' LIMIT 1");
	$result = mysqli_query($conn, $sql0);
	$datos = array();

	while ($row = mysqli_fetch_array($result)) {
		$dato_presupuesto_est = $row['presupuesto_est'];
	}

	//echo ("Presupuesto: " . $dato_presupuesto_est);

	$d_id_project_plans = mysqli_real_escape_string($conn, trim($_POST['id_project_plans']));
	$d_categoria_presup_proy = mysqli_real_escape_string($conn, trim($_POST['categoria_presup_proy']));
	$d_descripcion_presup_proy = mysqli_real_escape_string($conn, trim($_POST['descripcion_presup_proy']));
	$d_monto_presup_proy = mysqli_real_escape_string($conn, trim($_POST['monto_presup_proy']));
	$d_valor_total_presupuesto = $dato_presupuesto_est;

	$d_porcent_presup_proy = (($d_monto_presup_proy * 100) / $dato_presupuesto_est);
	$d_porcent_presup_proy = round($d_porcent_presup_proy, 2);

	//echo (" Porcentaje: " . $d_porcent_presup_proy);

	$query = mysqli_query($conn, "INSERT INTO project_plan_budgets(id_project_plans, categoria_presupuesto, descripcion_presupuesto, monto_presupuesto, porcentaje_presupuesto, valor_total_presupuesto)
											VALUES('$d_id_project_plans', '$d_categoria_presup_proy', '$d_descripcion_presup_proy', '$d_monto_presup_proy', '$d_porcent_presup_proy', '$d_valor_total_presupuesto')");

	if ($query) {

		if ($val_Type_User == 1) {
			header("location: ../pages/project_indiv_tables_direct.php?alert=1");
		}
		if ($val_Type_User == 2) {
			header("location: ../pages/project_gen_tables_jef.php?alert=1");
		}
		if ($val_Type_User == 3) {
			header("location: ../pages/project_tables_trab.php?alert=1");
		}
	}
}

if ($_GET['act'] == 'insert_new_riesg_respon_proy') {

	$d_id_proyecto = mysqli_real_escape_string($conn, trim($_POST['id_proyecto']));
	$d_respon_riesgo_proy = mysqli_real_escape_string($conn, trim($_POST['respon_riesgo_proy']));
	$d_estado_risg_plan_proy = mysqli_real_escape_string($conn, trim($_POST['estado_risg_plan_proy']));

	foreach ($_POST['list_riesgo_proy'] as $id_riesgo_list) {
		$id_riesgo_list = intval($id_riesgo_list);
		$query = mysqli_query($conn, "INSERT INTO projects_risk(id_proyecto, id_risk, estado_risk, responsable_risk)
											VALUES('$d_id_proyecto', '$id_riesgo_list', '$d_estado_risg_plan_proy', '$d_respon_riesgo_proy')");
	}

	if ($query) {

		if ($val_Type_User == 1) {
			header("location: ../pages/project_indiv_tables_direct.php?alert=1");
		}
		if ($val_Type_User == 2) {
			header("location: ../pages/project_gen_tables_jef.php?alert=1");
		}
		if ($val_Type_User == 3) {
			header("location: ../pages/project_tables_trab.php?alert=1");
		}
	}
}

if ($_GET['act'] == 'insert_new_supuestos_proy') {

	$d_id_proyecto = mysqli_real_escape_string($conn, trim($_POST['id_proyecto']));
	$d_id_project_plans = mysqli_real_escape_string($conn, trim($_POST['id_project_plans']));
	$d_nom_supuestos_proy = mysqli_real_escape_string($conn, trim($_POST['nom_supuestos_proy']));
	$d_descripcion_supuesto_nuevo_proy = mysqli_real_escape_string($conn, trim($_POST['descripcion_supuesto_nuevo_proy']));
	$d_impacto_supest_proy = mysqli_real_escape_string($conn, trim($_POST['impacto_supest_proy']));
	$d_estado_supest_proy = mysqli_real_escape_string($conn, trim($_POST['estado_supest_proy']));

	$query = mysqli_query($conn, "INSERT INTO project_plans_assumptions(id_proyecto, id_project_plan, nombre_supuesto, descripcion_supuesto, impacto_supuestos, estado_supuestos)
											VALUES('$d_id_proyecto', '$d_id_project_plans', '$d_nom_supuestos_proy', '$d_descripcion_supuesto_nuevo_proy', '$d_impacto_supest_proy', '$d_estado_supest_proy')");


	if ($query) {

		if ($val_Type_User == 1) {
			header("location: ../pages/project_indiv_tables_direct.php?alert=1");
		}
		if ($val_Type_User == 2) {
			header("location: ../pages/project_gen_tables_jef.php?alert=1");
		}
		if ($val_Type_User == 3) {
			header("location: ../pages/project_tables_trab.php?alert=1");
		}
	}
}

if ($_GET['act'] == 'insert_new_restricciones_proy') {

	$d_id_proyecto = mysqli_real_escape_string($conn, trim($_POST['id_proyecto']));
	$d_id_project_plans = mysqli_real_escape_string($conn, trim($_POST['id_project_plans']));
	$d_nom_restricc_proy = mysqli_real_escape_string($conn, trim($_POST['nom_restricc_proy']));
	$d_descripcion_restricc_nuevo_proy = mysqli_real_escape_string($conn, trim($_POST['descripcion_restricc_nuevo_proy']));
	$d_impacto_restricc_proy = mysqli_real_escape_string($conn, trim($_POST['impacto_restricc_proy']));

	$query = mysqli_query($conn, "INSERT INTO project_plans_restriction(id_proyecto, id_project_plan, nombre_restriccion, descripcion_restriccion, impacto_restriccion)
											VALUES('$d_id_proyecto', '$d_id_project_plans', '$d_nom_restricc_proy', '$d_descripcion_restricc_nuevo_proy', '$d_impacto_restricc_proy')");

	if ($query) {

		if ($val_Type_User == 1) {
			header("location: ../pages/project_indiv_tables_direct.php?alert=1");
		}
		if ($val_Type_User == 2) {
			header("location: ../pages/project_gen_tables_jef.php?alert=1");
		}
		if ($val_Type_User == 3) {
			header("location: ../pages/project_tables_trab.php?alert=1");
		}
	}
}

if ($_GET['act'] == 'insert_new_seguimiento_proy') {

	//$d_id_proyecto = mysqli_real_escape_string($conn, trim($_POST['id_proyecto']));
	$d_id_project_plans = mysqli_real_escape_string($conn, trim($_POST['id_project_plans']));
	$d_nom_restricc_proy = mysqli_real_escape_string($conn, trim($_POST['nom_restricc_proy']));
	$d_descripcion_restricc_nuevo_proy = mysqli_real_escape_string($conn, trim($_POST['descripcion_restricc_nuevo_proy']));
	$d_impacto_restricc_proy = mysqli_real_escape_string($conn, trim($_POST['impacto_restricc_proy']));

	$query = mysqli_query($conn, "INSERT INTO project_plans_tracing(id_project_plans, indicador_tracing, descripcion_tracing, tipo_tracing, meta_tracing, periodicidad_tracing, responsable_tracing)
											VALUES('$d_id_project_plans', '$', '$', '$', '$')");

	if ($query) {

		if ($val_Type_User == 1) {
			header("location: ../pages/project_indiv_tables_direct.php?alert=1");
		}
		if ($val_Type_User == 2) {
			header("location: ../pages/project_gen_tables_jef.php?alert=1");
		}
		if ($val_Type_User == 3) {
			header("location: ../pages/project_tables_trab.php?alert=1");
		}
	}
}

?>