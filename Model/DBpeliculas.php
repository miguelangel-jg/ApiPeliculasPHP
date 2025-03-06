<?php
class DBpeliculas
{
    private static $server = 'localhost';
    private static $db = 'peliculas';

    private static $user = 'root';
    private static $password = '';
    public static function conectar()
    {
        try {
            $conexion = new PDO("mysql:host=" . self::$server . ";dbname=" . self::$db .
                ";charset=utf8", self::$user, self::$password);
        } catch (PDOException $e) {
            echo "No se ha podido establecer conexión con el servidor de bases de datos.<br>";
            die("Error: " . $e->getMessage());
        }
        return $conexion;
    }
}
