<?php

include_once __DIR__ . '/../../databases/conexion_crud.php';

$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT
        CASE
            WHEN projects.estatus IN ('En Espera', 'Por Ejecutar')
                THEN 'En Espera/Por Ejecutar'
            ELSE projects.estatus
        END AS estatus,

        SUM(
            CASE
                WHEN projects.estatus IN (
                    'Propuesto',
                    'Evaluacion',
                    'Aprobacion',
                    'Planificacion',
                    'Ejecucion',
                    'Completado',
                    'Cerrado',
                    'En Espera',
                    'Por Ejecutar'
                )
                THEN 1
                ELSE 0
            END
        ) AS Cantidad

    FROM projects

    WHERE projects.estatus <> 'Borrador'

    GROUP BY
        CASE
            WHEN projects.estatus IN ('En Espera', 'Por Ejecutar')
                THEN 'En Espera/Por Ejecutar'
            ELSE projects.estatus
        END
";

$resultado = $conexion->prepare($consulta);
$resultado->execute();

$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json; charset=utf-8');
echo json_encode($data, JSON_UNESCAPED_UNICODE);

$conexion = null;
