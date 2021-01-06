<?php include_once './views/layout/header.php'; ?>
<?php include_once './views/layout/lateral.php'; ?>
<?php if (isset($_SESSION['usuario'])) : ?>
    <!-- CAJA PRINCIPAL -->
    <div id="principal">

        <h1>Ultimos Enlaces Guardados</h1>

        <?php
        $urls = conseguirUrls($db, true);
        if (!empty($urls)) :
            while ($url = mysqli_fetch_assoc($urls)) :
        ?>

                <article class="entrada">
                    <a href="http://localhost/favoritos/views/urls/detalle-enlace.php?id=<?= $url['id'] ?>">
                        <h2><?= $url['titulo'] ?></h2>
                        <span class="fecha"><?= $url['categoria'] . ' | ' . $url['fecha'] . ''  ?></span>
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

        <div id="ver-todas">
            <a href="./views/urls/listar-favoritos.php">Ver todas las URLS</a>
        </div>
    <?php endif; ?>
    </div>
    <!--fin principal-->

    <!--Fin del principal-->
    <?php require_once './views/layout/footer.php' ?>