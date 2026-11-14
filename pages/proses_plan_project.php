

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

?>