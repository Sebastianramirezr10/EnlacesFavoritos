<?php require_once '../../config/redireccion.php'; ?>
<?php require_once '../../config/conexion.php'; ?>
<?php require_once '../../models/helpers/helpers.php'; ?>
<?php
$url_actual = conseguirUrl($db, $_GET['id']);

if (!isset($url_actual['id'])) {
    header("Location: index.php");
}
?>

<?php require_once '../layout/header.php'; ?>
<?php require_once '../layout/lateral.php'; ?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Editar entrada</h1>
    <p>
        Edita tu entrada <?= $url_actual['titulo'] ?>
    </p>
    <br />
    <form action="../../controlador/enlaces/guardar-enlace.php?editar=<?= $url_actual['id'] ?>" method="POST">
        <label for="titulo">Titulo:</label>
        <input type="text" name="titulo" value="<?= $url_actual['titulo'] ?>" />
        <?php echo isset($_SESSION['errores_url']) ? mostrarError($_SESSION['errores_url'], 'titulo') : ''; ?>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion"><?= $url_actual['descripcion'] ?></textarea>
        <?php echo isset($_SESSION['errores_url']) ? mostrarError($_SESSION['errores_url'], 'descripcion') : ''; ?>

        <label for="url">Enlace:</label>
        <input type="text" name="url" value="<?= $url_actual['url'] ?>" />
        <?php echo isset($_SESSION['errores_url']) ? mostrarError($_SESSION['errores_url'], 'url') : ''; ?>

        <label for="categoria">Categoría</label>
        <select name="categoria">
            <?php
            $categorias = conseguirCategorias($db);
            if (!empty($categorias)) :
                while ($categoria = mysqli_fetch_assoc($categorias)) :
            ?>
                    <option value="<?= $categoria['id'] ?>" <?= ($categoria['id'] == $url_actual['categoria_id']) ? 'selected="selected"' : '' ?>>
                        <?= $categoria['nombre'] ?>
                    </option>
            <?php
                endwhile;
            endif;
            ?>
        </select>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'categoria') : ''; ?>

        <input type="submit" value="Guardar" />
    </form>
    <?php borrarErrores(); ?>
</div>
<!--fin principal-->

<?php require_once '../../views/layout/footer.php'; ?>