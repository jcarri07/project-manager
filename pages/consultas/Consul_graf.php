
<?php

include_once __DIR__ . '/../../databases/conexion_crud.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT
projects.estatus AS estatus,
SUM( CASE
    WHEN projects.estatus = 'Completado' THEN 1
    WHEN projects.estatus = 'En progreso' THEN 1
    WHEN projects.estatus IN ('En Espera', 'Por Ejecutar') THEN 1
    ELSE 0
  END
) AS Cantidad
FROM projects
GROUP BY CASE WHEN projects.estatus IN ('En Espera', 'Por Ejecutar') THEN 'En Espera/Por Ejecutar' ELSE projects.estatus END;";

$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data);

$conexion = null;


?>