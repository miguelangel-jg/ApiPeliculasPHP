<?php
include_once("DBpeliculas.php");
class Lista
{
    private $id_usuario;

    private $titulo;

    public function __construct($id_usuario, $titulo)
    {
        $this->id_usuario = $id_usuario;
        $this->titulo = $titulo;
    }

    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    //Añadir producto a la BD:
    public function anLista()
    {
        $conexion = DBpeliculas::conectar();
        $sql = "INSERT INTO lista (id_usuario, titulo) VALUES ($this->id_usuario, '$this->titulo')";
        $conexion->exec($sql);
    }
    public function eliminarProducto()
    {
        $conexion = DBpeliculas::conectar();
        $sql = "DELETE FROM lista WHERE id_usuario=$this->id_usuario AND titulo = '$this->titulo'";
        $conexion->exec($sql);
    }

    //Comprobar que el producto no este ya en la lista de ese usuario:
    public function comprobarProductoByTitulo()
    {
        $conexion = DBpeliculas::conectar();

        // Realizar la consulta con los valores escapados
        $seleccion = "SELECT * FROM lista WHERE id_usuario = $this->id_usuario AND titulo = '$this->titulo'";

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

    //Devolver los productos que tiene en la lista un usuario segun su id:
    public static function getProductosByID($id_usuario)
    {
        $conexion = DBpeliculas::conectar();
        // Realizar la consulta con los valores escapados
        $seleccion = "SELECT * FROM lista WHERE id_usuario = $id_usuario";
        // Ejecutar la consulta
        $consulta = $conexion->query($seleccion);

        // Obtener la fila resultante
        $productos = [];
        while ($producto = $consulta->fetchObject()) {
            $productos[] = new Lista($id_usuario, $producto->titulo);
        }

        return $productos;
    }
}
