<?php
include("../Model/Lista.php");

if (session_status() == PHP_SESSION_NONE) session_start();

if (isset($_REQUEST['cerrarSesion'])) {
    header("Location: login.php");
}


//Cargar  los productos que tiene el usuario en la lista:
include("../View/lista_view.php");

$productos = Lista::getProductosByID($_SESSION['idUsuario']);
echo ("<div class='resultados'>");
foreach ($productos as $producto) {
    try {
        $url = "https://www.omdbapi.com/?apikey=950bba72&t=" . $producto->getTitulo() . "";

        $datos = file_get_contents($url);

        // Verificar si la respuesta es válida
        if ($datos === FALSE) {
            throw new Exception("No se pudo conectar a la API.");
        }

        // Decodificar la respuesta JSON
        $data = json_decode($datos);
        if ($data == 'False') {
            throw new Exception("No se encuentra una Serie o Pelicula con ese Titulo");
        }

        echo ("<div class='producto'>");
        echo "<figure><img src='" . $data->Poster . "' alt='Póster de la película'><figure/>";
        echo "<a class='titulo' href='detalles.php?titulo=" . $data->Title . "'>" . $data->Title . "<a/>";
        echo "<p>" . $data->Year . "<td/>";

        if ($data->Type == 'series') {
            echo "<p>Serie</p>";
        } else if ($data->Type == 'movie') {
            echo "<p>Pelicula</p>";
        } else {
            echo ("<p>Juego</p>");
        }

        echo ("<form action='lista.php' method='post'><input type='hidden' name='titulo' value='" . $data->Title . "'><button name='elimLista'>Eliminar de la lista</button></form>");
        echo ("</div>");
    } catch (Exception $e) {
        echo "<h3>Error: " . $e->getMessage() . "</h3>";
    }
}
echo ("</div>");


if (isset($_REQUEST['elimLista'])) {
    $producto = new Lista($_SESSION['idUsuario'], $_REQUEST['titulo']);
    $producto->eliminarProducto();
}
