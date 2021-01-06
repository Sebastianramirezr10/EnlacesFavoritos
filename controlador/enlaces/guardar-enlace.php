<?php

if (isset($_POST)) {

    require_once '../../config/conexion.php';

    $titulo = isset($_POST['titulo']) ? mysqli_real_escape_string($db, $_POST['titulo']) : false;
    $descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($db, $_POST['descripcion']) : false;
    $url = isset($_POST['url']) ? mysqli_real_escape_string($db, $_POST['url']) : false;
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

            $sql = "UPDATE favoritos SET titulo='$titulo', descripcion='$descripcion', url='$url', categoria_id=$categoria " .
                " WHERE id = $url_id AND usuario_id = $usuario_id";
        } else {
            $sql = "INSERT INTO entradas VALUES(null, $usuario, $categoria, '$titulo', '$descripcion', CURDATE());";
        }
        $guardar = mysqli_query($db, $sql);

        header("Location: ../../index.php");
    } else {

        $_SESSION["errores_entrada"] = $errores;

        if (isset($_GET['editar'])) {
            header("Location: editar-entrada.php?id=" . $_GET['editar']);
        } else {
            header("Location: ../../views/categorias/crear-categoria.php");
        }
    }
}
