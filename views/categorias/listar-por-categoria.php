<?php require_once '../../config/conexion.php'; ?>
<?php require_once '../../controlador/helpers/helpers.php'; ?>
<?php
$categoria_actual = conseguirCategoria($db, $_GET['id']);

if (!isset($categoria_actual['id'])) {
    header("Location: index.php");
}
?>
<?php require_once '../layout/header.php'; ?>
<?php require_once '../layout/lateral.php'; ?>

<!-- CAJA PRINCIPAL -->
<div id="principal">

    <h1>Entradas de <?= $categoria_actual['nombre'] ?></h1>

    <?php
    $urls = conseguirUrls($db, null, $_GET['id']);

    if (!empty($urls) && mysqli_num_rows($urls) >= 1) :
        while ($url = mysqli_fetch_assoc($urls)) :
    ?>
            <article class="entrada">
                <a href="http://localhost/favoritos/views/urls/detalle-enlace.php?id=<?= $url['id'] ?>">
                    <h2><?= $url['titulo'] ?></h2>
                    <span class="fecha"><?= $url['categoria'] . ' | ' . $url['fecha'] ?></span>
                    <p>
                        <?= substr($url['descripcion'], 0, 180) . "..." ?>
                    </p>
                    <a href="<?= $url['url'] ?>">
                        <h3>Haga Click aqui para ir a Su Enlace...</h3>
                    </a>
                </a>
            </article>
        <?php
        endwhile;
    else :
        ?>
        <div class="alerta">No hay entradas en esta categoría</div>
    <?php endif; ?>
</div>
<!--fin principal-->

<?php require_once '../layout/footer.php'; ?>