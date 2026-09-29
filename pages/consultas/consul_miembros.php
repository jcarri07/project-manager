<?php
include_once __DIR__ . '/../../databases/conexion_crud.php';

$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT * FROM members";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json; charset=utf-8');
print json_encode($data, JSON_UNESCAPED_UNICODE);

$conexion = null;
