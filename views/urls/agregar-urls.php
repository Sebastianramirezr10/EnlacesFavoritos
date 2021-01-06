<?php require_once '../layout/header.php'; ?>
<?php require_once '../layout/lateral.php'; ?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Agrega tus Enlaces Favoritos!</h1>
    <p>
        Añade nuevos Enlaces al sistema para que los usuarios puedan
        acceder y disfrutar de la funcionalidad.
    </p>
    <br />
    <form action="../../controlador/url/agregar-url.php" method="POST">
        <label for="titulo">Titulo:</label>
        <input type="text" name="titulo" />
        <?php echo isset($_SESSION['errores_url']) ? mostrarError($_SESSION['errores_url'], 'titulo') : ''; ?>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" style="margin: 0px; width: 802px; height: 74px;"></textarea>
        <?php echo isset($_SESSION['errores_url']) ? mostrarError($_SESSION['errores_url'], 'descripcion') : ''; ?>

        <label for="enlace">Enlace del Sitio:</label>
        <input type="text" name="enlace" />
        <?php echo isset($_SESSION['errores_url']) ? mostrarError($_SESSION['errores_url'], 'url') : ''; ?>

        <label for="categoria">Categoría</label>
        <select name="categoria">
            <?php
            $categorias = conseguirCategorias($db);
            if (!empty($categorias)) :
                while ($categoria = mysqli_fetch_assoc($categorias)) :
            ?>
                    <option value="<?= $categoria['id'] ?>">
                        <?= $categoria['nombre'] ?>
                    </option>
            <?php
                endwhile;
            endif;
            ?>
        </select>
        <?php echo isset($_SESSION['errores_url']) ? mostrarError($_SESSION['errores_url'], 'categoria') : ''; ?>

        <input type="submit" value="Guardar" />
    </form>
    <?php borrarErrores(); ?>
</div>
<!--fin principal-->

<?php require_once '../layout/footer.php'; ?>