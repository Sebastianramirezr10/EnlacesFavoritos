<?php
require_once '../../config/conexion.php';

if (isset($_SESSION['usuario']) && isset($_GET['id'])) {
    $favoritos_id = $_GET['id'];
    $usuario_id = $_SESSION['usuario']['id'];

    $sql = "DELETE FROM favoritos WHERE usuario_id = $usuario_id AND id = $favoritos_id";
    $borrar = mysqli_query($db, $sql);
}

header("Location: ../../index.php");
