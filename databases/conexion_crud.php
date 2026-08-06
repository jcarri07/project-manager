<?php
class Conexion
{
    public static function Conectar()
    {
        define('servidor', 'localhost');
        define('nombre_bd', 'project_manager');
        define('usuario', 'root');
        define('password', '12345678');

        try {
            $conexion = new PDO(
                "mysql:host=" . servidor . ";dbname=" . nombre_bd . ";charset=utf8",
                usuario,
                password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
            return $conexion;
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["error" => $e->getMessage()]);
            exit;
        }
    }
}
