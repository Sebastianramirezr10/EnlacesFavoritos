<?php

if (isset($_POST)) {

    require_once '../../config/conexion.php';

    $titulo = isset($_POST['titulo']) ? mysqli_real_escape_string($db, $_POST['titulo']) : false;
    $descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($db, $_POST['descripcion']) : false;
    $url = isset($_POST['enlace']) ? mysqli_real_escape_string($db, $_POST['enlace']) : false;
    $categoria = isset($_POST['categoria']) ? (int)$_POST['categoria'] : false;
    $usuario = $_SESSION['usuario']['id'];

    // Validación
    $errores = array();

    if (empty($titulo)) {
        $errores['titulo'] = 'El titulo no es válido';
    }

    if (empty($descripcion)) {
        $errores['descripcion'] = 'La descripción no es válida';
    }
    if (empty($url)) {
        $errores['url'] = 'La url no es válida';
    }

    if (empty($categoria) && !is_numeric($categoria)) {
        $errores['categoria'] = 'La categoría no es válida';
    }


    if (count($errores) == 0) {


        if (isset($_GET['editar'])) {
            $url_id = $_GET['editar'];
            $usuario_id = $_SESSION['usuario']['id'];

            $sql = "UPDATE entradas SET titulo='$titulo', descripcion='$descripcion', categoria_id=$categoria " .
                " WHERE id = $url_id AND usuario_id = $usuario_id";
        } else {
            $sql = "INSERT INTO favoritos VALUES(null, $usuario, $categoria,'$titulo', '$descripcion','$url', CURDATE());";
        }
        $guardar = mysqli_query($db, $sql);


        header("Location: ../../index.php");
    } else {
        $_SESSION["errores_url"] = $errores;

        if (isset($_GET['editar'])) {
            header("Location: editar-url.php?id=" . $_GET['editar']);
        } else {
            header("Location: ../../views/urls/agregar-urls.php");
        }
    }
}
