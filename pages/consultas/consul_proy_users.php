<?php


session_start();
$id = $_SESSION["id_users"];

include_once __DIR__ . ('/../../databases/conexion_crud.php');
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT * FROM project_miembro,members,projects WHERE project_miembro.id_proyecto=projects.id_proyecto AND project_miembro.id_miembro=members.id_miembro AND project_miembro.rol_proyecto='Lider' AND members.id_miembro='$id'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

print json_encode($data, JSON_UNESCAPED_UNICODE);

$conexion = null;

session_abort();
