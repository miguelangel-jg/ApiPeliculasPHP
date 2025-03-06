<?php
include("../Model/Usuario.php");


if (isset($_REQUEST['registrarse'])) {
    //Comprobar que no existe ningun usuario con ese nombre:
    $usuario = new Usuario(0, $_REQUEST['username'], $_REQUEST['password']);
    $repetido = $usuario->comprobarUsuarioByNombre();

    if (!$repetido) {
        //Añadir el usuario a la BD:
        $usuario->nuevoUsuario();
        header("Location: login.php");
    } else {
        echo ("<script>alert('Ya existe un usuario registrado con ese nombre')</script>");
    }
}


include("../View/registro_view.php");
