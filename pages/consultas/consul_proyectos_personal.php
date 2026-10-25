<?php


session_start();
$id = $_SESSION["id_usuario"];

include_once __DIR__ . ('/../../databases/conexion_crud.php');
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT * FROM projects,unidad WHERE projects.unidad = unidad.id_unidad AND projects.id_solicitante='$id' AND projects.estatus != 'Borrador'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

print json_encode($data, JSON_UNESCAPED_UNICODE);

$conexion = null;

session_abort();
