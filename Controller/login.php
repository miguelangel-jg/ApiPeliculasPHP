<?php
include("../Model/Usuario.php");

if (session_status() == PHP_SESSION_NONE) session_start();

if (isset($_REQUEST['iniciarSesion'])) {
    //crear el usuario:
    $usuario = new Usuario(0, $_REQUEST['username'], $_REQUEST['password']);
    $encontrado = $usuario->comprobarUsuario();

    if ($encontrado) {
        echo ("<script>alert('Usuario encontrado')</script>");
        $_SESSION['user'] = $usuario->getNombre();
        //Buscar la id de usuario por el nombre:
        $usuario = Usuario::getUsuarioByNombre($usuario->getNombre());
        $_SESSION['idUsuario'] = $usuario->getId();
        header("Location: index.php");
    } else {
        echo ("<script>alert('Usuario o contraseña incorrectos')</script>");
    }
}


include("../View/login_view.php");
