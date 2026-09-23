
<?php 

include_once '../databases/conexion_crud.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT
memo.Estado AS Estado,
SUM( CASE
   WHEN memo.Estado = 'Cerrado' THEN 1
   WHEN memo.Estado = 'Asignado' THEN 1
   WHEN memo.Estado IN ('En Espera', 'Por Asignar') THEN 1
   ELSE 0
 END
) AS Cantidad
FROM memo
GROUP BY CASE WHEN memo.Estado IN ('En Espera', 'Por Asignar') THEN 'En Espera/Por Asignar' ELSE memo.Estado END;";

$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data);

$conexion=null;


?>