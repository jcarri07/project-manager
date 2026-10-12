<?php
include_once __DIR__ . '/../../databases/conexion_crud.php';
session_start();
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$id = $_SESSION['id_usuario'];

$consulta = "SELECT * FROM projects_draft WHERE projects_draft.id_manager = '$id'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json; charset=utf-8');
print json_encode($data, JSON_UNESCAPED_UNICODE);

$conexion = null;
