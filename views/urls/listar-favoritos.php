<?php include_once '../layout/header.php'; ?>
<?php include_once '../layout/lateral.php'; ?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Todas las Url Favoritas</h1>

    <?php
    $urls = conseguirUrls($db);
    if (!empty($urls)) :
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
    endif;
    ?>
</div>
<!--fin principal-->

<?php require_once '../layout/footer.php'; ?>