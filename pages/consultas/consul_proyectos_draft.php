<?php
include_once __DIR__ . '/../../databases/conexion_crud.php';
session_start();
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$cedul = $_SESSION['id_usuario'];

$consulta = "SELECT * FROM projects WHERE projects.id_solicitante  = '$cedul' AND projects.estatus = 'Borrador'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json; charset=utf-8');
print json_encode($data, JSON_UNESCAPED_UNICODE);

$conexion = null;
