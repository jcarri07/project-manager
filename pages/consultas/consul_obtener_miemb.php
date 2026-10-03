<?php

require_once('../../databases/conexion.php');

header('Content-Type: application/json; charset=utf-8');

if (!isset($_GET['id_proyecto'])) {

    echo json_encode([
        'success' => false,
        'message' => 'No se recibió el ID del proyecto.'
    ]);

    exit;
}

$id_proyecto = (int) $_GET['id_proyecto'];

$sql = "SELECT * FROM project_miembro,members WHERE project_miembro.id_miembro = members.id_miembro AND project_miembro.id_proyecto = $id_proyecto";

$resultado = mysqli_query($conn, $sql);

if (!$resultado) {

    echo json_encode([
        'success' => false,
        'message' => mysqli_error($conn)
    ]);

    exit;
}

$miembros = [];

while ($row = mysqli_fetch_assoc($resultado)) {

    $miembros[] = $row;
}

echo json_encode([
    'success' => true,
    'data' => $miembros
]);
