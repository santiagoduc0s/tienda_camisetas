<!-- barra lateral -->
<aside id="lateral">

    <?php if (isset($_SESSION['user_logged'])): ?>
        <div id="login" class="block_aside">
            <h3>Mi carrito</h3>
            <ul>
                <?php $statusCarrito = Utils::statusCarrito() ?>
                <li><a href="carrito/index">Ver el carrito</a></li>
                <li><a href="carrito/index">Productos (<?= $statusCarrito['cantidad'] ?>)</a></li>
                <li><a href="carrito/index">Unidades (<?= $statusCarrito['unidades'] ?>)</a></li>
                <li><a href="carrito/index">Total: $ <?= $statusCarrito['total'] ?></a></li>
                <li><a href="pedido/mis_pedidos">Mis pedidos</a></li>
            </ul>
        </div>
    <?php endif; ?>

    <div id="login" class="block_aside">
        <?php if (!isset($_SESSION['user_logged'])): ?>
            <h3>Entrar a la WEB</h3>
            <?php if (isset($_SESSION['login'])): ?>
                <?php if ($_SESSION['login'] == 'failed'): ?>
                    <p class="alert_red">Usuario o contraseña incorrecto.</p>
                <?php endif; ?>
                <?php Utils::delete_session('login'); ?>
            <?php endif; ?>

            <form action="<?= DOMINIO_URL; ?>usuario/login" method="POST">
                <label for="email">Email</label>
                <input type="email" name="email" required />
                <label for="password">Contraseña</label>
                <input type="password" name="password" required />
                <button type="submit" name="login">Ingresar</button>
            </form>
        <?php else: ?>
            <h3><?= ucwords($_SESSION['user_logged']->nombre) ?> <?= ucwords($_SESSION['user_logged']->apellidos) ?></h3>
        <?php endif; ?>

        <ul>
            <?php if (isset($_SESSION['admin'])): ?>
                <li><a href="categoria/index">Gestionar categorias</a></li>
                <li><a href="producto/gestion">Gestionar productos</a></li>
                <li><a href="pedido/gestion_pedidos">Gestionar pedidos</a></li>
            <?php endif; ?>

            <?php if (isset($_SESSION['user_logged'])): ?>
                <li><a href="usuario/logout">Cerrar sesión</a></li>
            <?php else: ?>
                <li><a href="usuario/agregar_view">Registrate aquí</a></li>
            <?php endif; ?>
        </ul>

    </div>
</aside>

<!-- contenido central -->
<div id="central">
