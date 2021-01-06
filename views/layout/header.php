<?php include_once 'C:\Desarollo_Xampp\htdocs\favoritos\models\helpers\helpers.php'; ?>
<?php include_once 'C:\Desarollo_Xampp\htdocs\favoritos\config\conexion.php'; ?>
<!DOCTYPE html>
<html lang="es">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
<link rel="stylesheet" type="text/css" href="http://localhost/favoritos/assets/css/style.css">
<link rel="icon" type="favicon/x-icon" href="./assets/img/icon.jpg">

<head>
    <title>Favoritos</title>
</head>

<body>

    <!--CABECERA-->
    <header id="cabecera">
        <!--LOGO-->
        <div id="logo">
            <a href="./index.php">
                Guarda tus Favoritos!
            </a>
        </div>

        <!-- MENU -->
        <nav id="menu">
            <ul>
                <li>
                    <a href="http://localhost/favoritos/index.php">Inicio</a>
                </li>
                <?php if (isset($_SESSION['usuario'])) : ?>
                    <?php

                    $categorias = conseguirCategorias($db);
                    if (!empty($categorias)) :
                        while ($categoria = mysqli_fetch_assoc($categorias)) :
                    ?>
                            <li>
                                <a href="http://localhost/favoritos/views/categorias/listar-por-categoria.php?id=<?= $categoria['id'] ?>">
                                    <?= $categoria['nombre'] ?></a>
                            </li>
                    <?php
                        endwhile;
                    endif;
                    ?>


                <?php endif; ?>
            </ul>
        </nav>

        <div class="clearfix"></div>
    </header>

    <div id="contenedor">