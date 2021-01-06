<?php

function mostrarError($errores, $campo)
{
    $alerta = '';
    if (isset($errores[$campo]) && !empty($campo)) {
        $alerta = "<div class='alerta alerta-error'>" . $errores[$campo] . '</div>';
    }

    return $alerta;
}

function borrarErrores()
{
    $borrado = false;

    if (isset($_SESSION['errores'])) {
        $_SESSION['errores'] = null;
        $borrado = true;
    }

    if (isset($_SESSION['errores_url'])) {
        $_SESSION['errores_url'] = null;
        $borrado = true;
    }

    if (isset($_SESSION['completado'])) {
        $_SESSION['completado'] = null;
        $borrado = true;
    }

    return $borrado;
}


function conseguirCategorias($conexion)
{
    $sql = "SELECT * FROM categorias ORDER BY id ASC;";
    $categorias = mysqli_query($conexion, $sql);

    $resultado = array();
    if ($categorias && mysqli_num_rows($categorias) >= 1) {
        $resultado = $categorias;
    }

    return $resultado;
}

function conseguirCategoria($conexion, $id)
{
    $sql = "SELECT * FROM categorias WHERE id = $id;";
    $categorias = mysqli_query($conexion, $sql);

    $resultado = array();
    if ($categorias && mysqli_num_rows($categorias) >= 1) {
        $resultado = mysqli_fetch_assoc($categorias);
    }

    return $resultado;
}

function conseguirUrl($conexion, $id)
{
    $sql = "SELECT f.*, c.nombre AS 'categoria', CONCAT(u.nombre, ' ', u.apellido) AS usuario"
        . " FROM favoritos f " .
        "INNER JOIN categorias c ON f.categoria_id = c.id " .
        "INNER JOIN usuarios u ON f.usuario_id = u.id " .
        "WHERE f.id = $id";
    $url = mysqli_query($conexion, $sql);

    $resultado = array();
    if ($url && mysqli_num_rows($url) >= 1) {
        $resultado = mysqli_fetch_assoc($url);
    }


    return $resultado;
}

function conseguirUrls($conexion, $limit = null, $categoria = null, $busqueda = null)
{
    $sql = "SELECT f.*, c.nombre AS 'categoria' FROM favoritos f " .
        "INNER JOIN categorias c ON f.categoria_id = c.id ";

    if (!empty($categoria)) {
        $sql .= "WHERE f.categoria_id = $categoria ";
    }

    if (!empty($busqueda)) {
        $sql .= "WHERE f.titulo LIKE '%$busqueda%' ";
    }

    $sql .= "ORDER BY f.id DESC ";

    if ($limit) {
        // $sql = $sql." LIMIT 4";
        $sql .= "LIMIT 4";
    }

    $urls = mysqli_query($conexion, $sql);

    $resultado = array();
    if ($urls && mysqli_num_rows($urls) >= 1) {
        $resultado = $urls;
    }

    return $urls;
}
