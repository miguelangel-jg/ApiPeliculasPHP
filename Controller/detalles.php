<?php
if (session_status() == PHP_SESSION_NONE) session_start();

if (isset($_REQUEST['titulo'])) {
    try {
        // API Key de OMDB
        $apiKey = '950bba72';

        $url = "https://www.omdbapi.com/?apikey=$apiKey&t=" . $_REQUEST['titulo'];
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
        echo ("<figure>");
        echo ("<img src='$data->Poster'>");
        echo ("</figure>");
        echo ("<div class='datosProducto'>");
        echo ("<p>Titulo: $data->Title</p>");
        echo ("<p>Años en emision: $data->Year</p>");
        echo ("<p>Generos: $data->Genre</p>");
        echo ("<p>Director: $data->Director</p>");
        echo ("<p>Actores: $data->Actors</p>");
        echo ("<p>Valoracion en IMDB: $data->imdbRating</p>");
        echo ("<p>Tipo de producto: $data->Type</p>");

        echo ("</div>");
        echo ("</div>");
    } catch (Exception $e) {
        echo "<h3>Error: " . $e->getMessage() . "</h3>";
    }
}

include("../View/detalles_view.php");
