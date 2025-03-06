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
        background-image: url(../View/fondo.jpg);
        background-size: cover;
        min-height: 100vh;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        color: #ffffff;
        margin: 0;
        padding: 0;
    }

    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: black;
        padding: 10px 20px;
        color: #ffffff;
    }

    header span {
        margin-right: 20px;
    }

    header form {
        margin: 0;
    }

    header button {
        padding: 5px 10px;
        font-size: 14px;
        border: none;
        border-radius: 4px;
        background-color: #e50914;
        color: #ffffff;
        cursor: pointer;
    }

    header button:hover {
        background-color: #f40612;
    }

    header img {
        width: 40px;
    }

    .lista {
        display: flex;
        align-items: center;
        align-content: center;
        justify-content: center;
        width: 200px;
    }

    .lista a {
        padding: 10px;
        color: white;
    }



    h1 {
        text-align: center;
        text-decoration: underline;
        color: #e50914;
        background-color: black;
        margin: 0;
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

    .form {
        background-color: black;
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

    .container {
        background-color: black;
        padding: 10px;
    }

    button[type="submit"]:hover {
        background-color: #f40612;
    }

    select {
        padding: 10px;
        font-size: 16px;
        border: none;
        border-radius: 4px;
        margin-right: 10px;
        background-color: #333333;
        color: #ffffff;
    }

    select option {
        background-color: #333333;
        color: #ffffff;
    }

    .resultados {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin: 20px;
    }

    .producto button[name="anLista"] {
        padding: 10px 20px;
        font-size: 16px;
        border: none;
        border-radius: 4px;
        background-color: #e50914;
        color: #ffffff;
        cursor: pointer;
    }

    .producto button[name="anLista"]:hover {
        background-color: #f40612;
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

    .producto .titulo {
        font-size: 18px;
        color: white;
        text-decoration: none;
        margin: 10px 0;
    }

    .titulo:hover {
        text-decoration: underline;
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

    if (!isset($_SESSION['user']) || $_SESSION['user'] == '') {
        header("Location: login.php");
    }
    ?>

    <header><span>Usuario: <?= $_SESSION['user'] ?></span>
        <div class="lista"><a href="lista.php">Mi lista:</a><img src="../View/lista-icon.png"></div>
        <form action="index.php" method="post">
            <button type="submit" name="cerrarSesion" class="red">Cerrar Sesion</button>
        </form>
    </header>

    <div class="container">
        <h1>Buscador de Series Peliculas y Juegos</h1>
        <form class="form" action="" method="post">
            <select name="filtrar" id="">
                <option value="seriesPeliculas">Cualquiera</option>
                <option value="series">Series</option>
                <option value="movie">Peliculas</option>
                <option value="game">Juegos</option>
            </select>
            <input type="text" name="titulo" placeholder="Escriba el titulo de una serie o pelicula...">

            <button type="submit" name="enviar">Enviar</button>
        </form>
    </div>

</body>

</html>