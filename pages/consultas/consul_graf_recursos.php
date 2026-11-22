
<?php

include_once __DIR__ . '/../../databases/conexion_crud.php';

header('Content-Type: application/json; charset=utf-8');

$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recibir identificador de planificación
$idPlan = filter_input(INPUT_GET, 'id_project_plans', FILTER_VALIDATE_INT);

if (!$idPlan || $idPlan <= 0) {
    http_response_code(400);

    echo json_encode([
        'success' => false,
        'message' => 'Identificador de planificación inválido.'
    ], JSON_UNESCAPED_UNICODE);

    exit;
}

// Consultar cantidad de recursos por disponibilidad
$consulta = "
    SELECT
        estados.disponibilidad_recurso AS estatus,
        COUNT(recursos.id_project_plans) AS Cantidad

    FROM (
        SELECT 'Confirmados' AS disponibilidad_recurso
        UNION ALL
        SELECT 'Por Confirmar'
        UNION ALL
        SELECT 'No disponibles'
    ) AS estados

    LEFT JOIN project_plan_resources AS recursos
        ON recursos.disponibilidad_recurso = estados.disponibilidad_recurso
        AND recursos.id_project_plans = :id_project_plans

    GROUP BY estados.disponibilidad_recurso

    ORDER BY FIELD(
        estados.disponibilidad_recurso,
        'Confirmados',
        'Por Confirmar',
        'No disponibles'
    )
";

$resultado = $conexion->prepare($consulta);

$resultado->bindValue(':id_project_plans', $idPlan, PDO::PARAM_INT);

$resultado->execute();

$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    'success' => true,
    'data' => $data
], JSON_UNESCAPED_UNICODE);

$conexion = null;

exit;
