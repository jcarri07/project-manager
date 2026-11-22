<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header('Content-Type: application/json; charset=utf-8');

include_once __DIR__ . '/../../databases/conexion_crud.php';

$objeto = new Conexion();
$conexion = $objeto->Conectar();

$idPlan = filter_input(
    INPUT_GET,
    'id_project_plans',
    FILTER_VALIDATE_INT
);

if (!$idPlan || $idPlan <= 0) {

    http_response_code(400);

    echo json_encode([
        'success' => false,
        'message' => 'Identificador de planificación inválido.'
    ]);

    exit;
}

// ==========================================
// CONSULTAR DISTRIBUCIÓN DEL PRESUPUESTO
// ==========================================

$consulta = "SELECT id_project_plan_budgets, categoria_presupuesto, porcentaje_presupuesto, valor_total_presupuesto FROM project_plan_budgets WHERE id_project_plans = :idPlan ORDER BY id_project_plan_budgets ASC";

$resultado = $conexion->prepare($consulta);

$resultado->bindParam(':idPlan', $idPlan, PDO::PARAM_INT);

$resultado->execute();

$registros = $resultado->fetchAll(PDO::FETCH_ASSOC);

// ==========================================
// PROCESAR INFORMACIÓN
// ==========================================

$categorias = [];

$valorTotalPresupuesto = null;

foreach ($registros as $fila) {

    // Obtener el valor global del presupuesto.
    if (
        $valorTotalPresupuesto === null &&
        $fila['valor_total_presupuesto'] !== null
    ) {

        $valorTotalPresupuesto = (float) $fila['valor_total_presupuesto'];
    }

    // Agregar cada categoría como un segmento.
    $categorias[] = [

        'id_project_plan_budgets' =>
        $fila['id_project_plan_budgets'],

        'categoria_presupuesto' =>
        $fila['categoria_presupuesto'],

        'porcentaje_presupuesto' =>
        (float) $fila['porcentaje_presupuesto']

    ];
}

// ==========================================
// RESPUESTA JSON
// ==========================================

echo json_encode([

    'success' => true,

    'data' => $categorias,

    'valor_total_presupuesto' => $valorTotalPresupuesto

], JSON_UNESCAPED_UNICODE);

$conexion = null;

exit;
