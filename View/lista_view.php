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
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
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

    .producto .titulo {
        font-size: 18px;
        color: white;
        text-decoration: none;
        margin: 10px 0;
    }

    .titulo:hover {
        text-decoration: underline;
    }


    .resultados {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin: 20px;
        margin-top: 50px;
    }

    .producto button[name="elimLista"] {
        padding: 10px 20px;
        font-size: 16px;
        border: none;
        border-radius: 4px;
        background-color: #e50914;
        color: #ffffff;
        cursor: pointer;
    }

    .producto button[name="elimLista"]:hover {
        background-color: #f40612;
    }

    .producto {
        background-color: #333333;
        border-radius: 8px;
        margin: 20px;
        width: 300px;
        text-align: center;
    }

    .producto figure {
        margin: 16px 20px;
    }

    .producto img {
        border-radius: 4px;
        max-width: 100%;
        max-height: 300px;
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

    if (!isset($_SESSION['user']) || $_SESSION['user'] == '') {
        header("Location: login.php");
    }
    ?>

    <header><span>Usuario: <?= $_SESSION['user'] ?></span>
        <div class="lista"><a href="index.php">Inicio:</a><img src="../View/inicio-icon.png"></div>
        <form action="index.php" method="post">
            <button type="submit" name="cerrarSesion" class="red">Cerrar Sesion</button>
        </form>
    </header>


</body>

</html>