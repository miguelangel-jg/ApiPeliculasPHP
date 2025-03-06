<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMDb API</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #141414;
        color: #ffffff;
        margin: 0;
        padding: 0;
    }

    h1 {
        text-align: center;
        text-decoration: underline;
        margin-top: 20px;
        color: #e50914;
    }

    h3 {
        text-align: center;
        margin-top: 50px;
    }

    form {
        display: flex;
        justify-content: center;
        margin: 20px 0;
    }

    input[type="text"] {
        padding: 10px;
        font-size: 16px;
        border: none;
        border-radius: 4px;
        width: 300px;
        margin-right: 10px;
    }

    button[type="submit"] {
        padding: 10px 20px;
        font-size: 16px;
        border: none;
        border-radius: 4px;
        background-color: #e50914;
        color: #ffffff;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        background-color: #f40612;
    }

    .resultados {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin: 20px;
    }

    .producto {
        background-color: #333333;
        border-radius: 8px;
        margin: 10px;
        padding: 10px;
        width: 400px;
        text-align: center;
    }

    .producto img {
        border-radius: 4px;
        max-width: 100%;
        max-height: 400px;
    }

    .producto h2 {
        font-size: 18px;
        margin: 10px 0;
    }

    .producto p {
        font-size: 14px;
        color: #b3b3b3;
    }

    .producto button {
        padding: 5px 10px;
        font-size: 14px;
        border: none;
        border-radius: 4px;
        background-color: #e50914;
        color: #ffffff;
        cursor: pointer;
    }

    .producto button:hover {
        background-color: #f40612;
    }
</style>

<body>


    <?php
    if (session_status() == PHP_SESSION_NONE) session_start();

    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
    }
    ?>
    <h1>Gestor de Series y Peliculas</h1>
    <form action="" method="get">
        <input type="text" name="titulo" placeholder="Escriba el titulo de una serie o pelicula...">
        <button type="submit" name="enviar">Enviar</button>
    </form>

    <?php
    if (isset($_REQUEST['enviar'])) {
        try {
            // API Key de OMDB (reemplázala con tu clave válida)
            $apiKey = '950bba72';

            // URL de la API
            $url = "https://www.omdbapi.com/?apikey=$apiKey&s=" . $_REQUEST['titulo'] . "";
            // Hacer una solicitud GET a la API
            $datos = file_get_contents($url);

            echo "</table>";
            // Verificar si la respuesta es válida
            if ($datos === FALSE) {
                throw new Exception("No se pudo conectar a la API.");
            }

            // Decodificar la respuesta JSON
            $data = json_decode($datos);
            if ($data->Response == 'False') {
                throw new Exception("No se encuentra una Serie o Pelicula con ese Titulo");
            }

    ?>

            <div class="resultados">
        <?php
            foreach ($data->Search as $producto) {
                echo ("<div class='producto'>");
                echo "<figure><img src='" . $producto->Poster . "' alt='Póster de la película'><figure/>";
                echo "<h2>" . $producto->Title . "<td/>";
                echo "<p>" . $producto->Year . "<td/>";
                // echo "<td>" . $producto->Type . "<td/>";
                echo ("<form action='' method='post'><input type='hidden' name='titulo' value='" . $producto->Title . "'><button name='anLista'>Añadir a la lista</button></form>");
                echo ("</div>");
            }
        } catch (Exception $e) {
            // Manejar errores
            echo "<h3>Error: " . $e->getMessage() . "</h3>";
        }
    }
        ?>
            </div>
</body>

</html>