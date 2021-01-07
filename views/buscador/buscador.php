<?php
if (!isset($_POST['busqueda'])) {
    header("Location: ../index.php");
}

?>
<?php require_once '../../views/layout/header.php'; ?>
<?php require_once '../../views/layout/lateral.php'; ?>

<!-- CAJA PRINCIPAL -->
<div id="principal">

    <h1>Busqueda: <?= $_POST['busqueda'] ?></h1>

    <?php
    $urls = conseguirUrls($db, null, null, $_POST['busqueda']);

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
                </a>
            </article>
        <?php
        endwhile;
    else :
        ?>
        <div class="alerta">No hay Urls en esta categoría</div>
    <?php endif; ?>
</div>
<!--fin principal-->

<?php require_once '../layout/footer.php'; ?>