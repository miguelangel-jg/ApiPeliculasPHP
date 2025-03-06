<?php
include_once("DBpeliculas.php");
class Usuario
{
    private $id;
    private $nombre;
    private $pass;

    public function __construct($id = 0, $nombre = '', $pass = '')
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->pass = $pass;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getPass()
    {
        return $this->pass;
    }

    //Añadir nuevo usuario a la BD:
    public function nuevoUsuario()
    {
        $conexion = DBpeliculas::conectar();
        $sql = "INSERT INTO usuario(nombre, pass) VALUES ('$this->nombre', '$this->pass')";
        $conexion->exec($sql);
    }

    public static function getUsuarioByNombre($nombre)
    {
        $conexion = DBpeliculas::conectar();
        // Realizar la consulta con los valores escapados
        $seleccion = "SELECT * FROM usuario WHERE nombre = '$nombre'";
        $consulta = $conexion->query($seleccion);

        $entrada = $consulta->fetchObject();
        if ($entrada) {
            $usuario = new Usuario($entrada->id, $entrada->nombre, $entrada->pass);
            return $usuario;
        } else {
            return null;
        }
    }

    public function comprobarUsuario()
    {
        $conexion = DBpeliculas::conectar();

        // Realizar la consulta con los valores escapados
        $seleccion = "SELECT * FROM usuario WHERE nombre = '$this->nombre' AND pass = '$this->pass'";

        // Ejecutar la consulta
        $consulta = $conexion->query($seleccion);

        // Obtener la fila resultante
        $entrada = $consulta->fetchObject();

        // Comprobar si existe el usuario
        if ($entrada) {
            return true;
        } else {
            return false;
        }
    }

    public static function getIdByNombre($nombre)
    {
        $conexion = DBpeliculas::conectar();

        // Realizar la consulta con los valores escapados
        $seleccion = "SELECT id FROM usuario WHERE nombre = '$nombre'";

        // Ejecutar la consulta
        $consulta = $conexion->query($seleccion);

        // Obtener la fila resultante
        $entrada = $consulta->fetchObject();

        if ($entrada) {
            $id = $entrada->id;
            return $id;
        } else {
            return null;
        }
    }


    //Comprueba si hay un usuario con ese nombre en la BD:
    public function comprobarUsuarioByNombre()
    {
        $conexion = DBpeliculas::conectar();

        // Realizar la consulta con los valores escapados
        $seleccion = "SELECT * FROM usuario WHERE nombre = '$this->nombre'";

        // Ejecutar la consulta
        $consulta = $conexion->query($seleccion);

        // Obtener la fila resultante
        $entrada = $consulta->fetchObject();

        // Comprobar si existe el usuario
        if ($entrada) {
            return true;
        } else {
            return false;
        }
    }
}
