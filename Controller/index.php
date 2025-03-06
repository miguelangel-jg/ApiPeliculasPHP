<?php
include("../Model/Lista.php");
if (session_status() == PHP_SESSION_NONE) session_start();


if (!isset($_SESSION['user']) || isset($_REQUEST['cerrarSesion'])) {
    header("Location: login.php");
}

include("../View/index_view.php");

if (isset($_REQUEST['enviar'])) {
    try {
        // API Key de OMDB
        $apiKey = '950bba72';

        $url = "https://www.omdbapi.com/?apikey=$apiKey&s=" . $_REQUEST['titulo'] . "";

        $datos = file_get_contents($url);

        // Verificar si la respuesta es válida
        if ($datos === FALSE) {
            throw new Exception("No se pudo conectar a la API.");
        }

        // Decodificar la respuesta JSON
        $data = json_decode($datos);
        if ($data->Response == 'False') {
            throw new Exception("No se encuentra una Serie o Pelicula con ese Titulo");
        }

        echo ("<div class='resultados'>");
        foreach ($data->Search as $producto) {
            if ($_REQUEST['filtrar'] ==  $producto->Type || $_REQUEST['filtrar'] == 'seriesPeliculas') {
                if ($producto->Poster != 'N/A') {
                    echo ("<div class='producto'>");
                    echo "<figure><img src='" . $producto->Poster . "' alt='Póster de la película'><figure/>";
                    echo "<a class='titulo' href='detalles.php?titulo=" . $producto->Title . "'>" . $producto->Title . "<a/>";
                    echo "<p>" . $producto->Year . "<p/>";
                    if ($producto->Type == 'series') {
                        echo "<p>Serie</p>";
                    } else if ($producto->Type == 'movie') {
                        echo "<p>Pelicula</p>";
                    } else {
                        echo ("<p>Juego</p>");
                    }

                    echo ("<form action='' method='post'><input type='hidden' name='titulo' value='" . $producto->Title . "'><button name='anLista'>Añadir a la lista</button></form>");
                    echo ("</div>");
                }
            }
        }
        echo ("</div>");
    } catch (Exception $e) {
        echo "<h3>Error: " . $e->getMessage() . "</h3>";
    }
}


//Funcion para añadir a la lista del usuario:
if (isset($_REQUEST['anLista'])) {
    $anLista = new Lista($_SESSION['idUsuario'], $_REQUEST['titulo']);
    //Comprobar que no esta ya metido en la lista:

    $repetido = $anLista->comprobarProductoByTitulo();

    if (!$repetido) {
        $anLista->anLista();
    }

    // API Key de OMDB
    $apiKey = '950bba72';

    $url = "https://www.omdbapi.com/?apikey=$apiKey&s=" . $_REQUEST['titulo'] . "";

    $datos = file_get_contents($url);

    // Verificar si la respuesta es válida
    if ($datos === FALSE) {
        throw new Exception("No se pudo conectar a la API.");
    }

    // Decodificar la respuesta JSON
    $data = json_decode($datos);
    if ($data->Response == 'False') {
        throw new Exception("No se encuentra una Serie o Pelicula con ese Titulo");
    }

    echo ("<div class='resultados'>");
    foreach ($data->Search as $producto) {

        if ($producto->Poster != 'N/A') {
            echo ("<div class='producto'>");
            echo "<figure><img src='" . $producto->Poster . "' alt='Póster de la película'><figure/>";
            echo "<h2>" . $producto->Title . "<td/>";
            echo "<p>" . $producto->Year . "<td/>";
            if ($producto->Type == 'series') {
                echo "<p>Serie</p>";
            } else if ($producto->Type == 'movie') {
                echo "<p>Pelicula</p>";
            } else {
                echo ("<p>Juego</p>");
            }

            echo ("<form action='' method='post'><input type='hidden' name='titulo' value='" . $producto->Title . "'><button name='anLista'>Añadir a la lista</button></form>");
            echo ("</div>");
        }
    }
}
echo ("</div>");
