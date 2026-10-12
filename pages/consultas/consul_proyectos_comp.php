<?php
include_once __DIR__ . '/../../databases/conexion_crud.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT * FROM projects,users WHERE projects.id_manager = users.id_usuario AND projects.activo != '1'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

print json_encode($data, JSON_UNESCAPED_UNICODE);

$conexion = null;
