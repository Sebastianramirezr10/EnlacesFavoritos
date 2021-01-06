<!-- BARRA LATERAL -->
<aside id="sidebar">
    <?php if (isset($_SESSION['usuario'])) : ?>
        <div id="buscador" class="bloque">
            <h3>Buscar</h3>

            <form action="http://localhost/favoritos/controlador/buscador/buscador.php" method="POST">
                <input type="text" name="busqueda" />
                <input type="submit" value="Buscar" />
            </form>
        </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['usuario'])) : ?>
        <div id="usuario-logueado" class="bloque">
            <h3>Bienvenido, <?= $_SESSION['usuario']['nombre'] . ' ' . $_SESSION['usuario']['apellido']; ?></h3>
            <!--botones-->
            <a href="http://localhost/favoritos/views/urls/agregar-urls.php" class="boton boton-verde">Agrega una Url</a>
            <a href="http://localhost/favoritos/views/categorias/crear-categoria.php" class="boton">Crear categoria</a>
            <a href="http://localhost/favoritos/views/usuario/mis-datos.php" class="boton boton-naranja">Mis datos</a>
            <a href="http://localhost/favoritos/controlador/usuario/cerrar.php" class="boton boton-rojo">Cerrar sesión</a>
        </div>
    <?php endif; ?>

    <!---LOGIN-->
    <?php if (!isset($_SESSION['usuario'])) : ?>
        <div id="" class="bloque">
            <h3>Identificate</h3>

            <?php if (isset($_SESSION['error_login'])) : ?>
                <div class="alerta alerta-error">
                    <?= $_SESSION['error_login']; ?>
                </div>
            <?php endif; ?>

            <form action="http://localhost/favoritos/controlador/usuario/login.php" method="POST">
                <label for="email">Email</label>
                <input type="email" name="email" />

                <label for="password">Contraseña</label>
                <input type="password" name="password" />

                <input type="submit" value="Entrar" />
            </form>
        </div>


        <div id="register" class="bloque">
            <h3>Resgistrate</h3>

            <!-- Mostrar errores -->
            <?php if (isset($_SESSION['completado'])) : ?>
                <div class="alerta alerta-exito">
                    <?= $_SESSION['completado'] ?>
                </div>
            <?php elseif (isset($_SESSION['errores']['general'])) : ?>
                <div class="alerta alerta-error">
                    <?= $_SESSION['errores']['general'] ?>
                </div>
            <?php endif; ?>

            <form action="./controlador/usuario/registro.php" method="POST">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" />
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?>

                <label for="apellidos">Apellidos</label>
                <input type="text" name="apellidos" />
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : ''; ?>

                <label for="email">Email</label>
                <input type="email" name="email" />
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?>

                <label for="password">Contraseña</label>
                <input type="password" name="password" />
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'password') : ''; ?>

                <input type="submit" name="submit" value="Registrar" />
            </form>
            <?php borrarErrores(); ?>
        </div>
    <?php endif; ?>
</aside>