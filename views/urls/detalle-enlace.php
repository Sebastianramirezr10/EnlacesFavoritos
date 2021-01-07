<?php require_once '../../config/conexion.php'; ?>
<?php require_once '../../controlador/helpers/helpers.php'; ?>
<?php
$url_actual = conseguirUrl($db, $_GET['id']);

/*if (!isset($url_actual['id'])) {
    header("Location: index.php");
}*/
?>
<?php require_once '../layout/header.php'; ?>
<?php require_once '../layout/lateral.php'; ?>

<!-- CAJA PRINCIPAL -->
<div id="principal">

    <h1><?= $url_actual['titulo'] ?></h1>

    <a href="http://localhost/favoritos/views/categorias/listar-por-categoria.php?id=<?= $url_actual['categoria_id'] ?>">
        <h2><?= $url_actual['categoria'] ?></h2>
    </a>
    <h4><?= $url_actual['fecha'] ?> | <?= $url_actual['usuario'] ?></h4>
    <p>
        <?= $url_actual['descripcion'] ?>
    </p>

    <?php if (isset($_SESSION["usuario"]) && $_SESSION['usuario']['id'] == $url_actual['usuario_id']) : ?>
        <br />
        <a href="http://localhost/favoritos/views/urls/editar-enlace.php?id=<?= $url_actual['id'] ?>" class="boton boton-verde">Editar entrada</a>
        <a href="http://localhost/favoritos/models/enlaces/borrar-enlace.php?id=<?= $url_actual['id'] ?>" class="boton">Eliminar entrada</a>
    <?php endif; ?>

</div>
<!--fin principal-->

<?php require_once '../layout/footer.php'; ?>