<h1>Gestion de productos</h1>

<a href="<?= DOMINIO_URL ?>producto/crear" class="button button-small">
    Crear producto
</a>

<?php if (isset($_SESSION['save'])): ?>
    <?php if ($_SESSION['save'] == 'complete'): ?>
        <strong class="alert_green">Se creó un nuevo producto</strong>
    <?php elseif ($_SESSION['save'] == 'failed'): ?>
        <strong class="alert_red">No se pudo agregar el producto</strong>
    <?php elseif ($_SESSION['save'] == 'error_image'): ?>
        <strong class="alert_red">La extención del archivo solo puede ser *.jpg, *.jpeg, *.png</strong>
    <?php elseif ($_SESSION['save'] == 'error'): ?>
        <strong class="alert_red">Ocurrió un error, intente de nuevo</strong>
    <?php endif; ?>
    <?php Utils::delete_session('save') ?>
<?php endif; ?>

<?php if (isset($_SESSION['edit'])): ?>
    <?php if ($_SESSION['edit'] == 'complete'): ?>
        <strong class="alert_green">Se modificó el producto</strong>
    <?php elseif ($_SESSION['edit'] == 'failed'): ?>
        <strong class="alert_red">No se pudo modificar el producto</strong>
    <?php elseif ($_SESSION['edit'] == 'error_image'): ?>
        <strong class="alert_red">La extención del archivo solo puede ser *.jpg, *.jpeg, *.png</strong>
    <?php elseif ($_SESSION['edit'] == 'error'): ?>
        <strong class="alert_red">Ocurrió un error, intente de nuevo</strong>
    <?php endif; ?>
    <?php Utils::delete_session('edit') ?>
<?php endif; ?>

<?php if (isset($_SESSION['delete'])): ?>
    <?php if ($_SESSION['delete'] == 'complete'): ?>
        <strong class="alert_green">Se eliminó el producto</strong>
    <?php elseif ($_SESSION['delete'] == 'failed'): ?>
        <strong class="alert_red">No se pudo agregar el producto</strong>
    <?php elseif ($_SESSION['delete'] == 'error'): ?>
        <strong class="alert_red">Ocurrió un error, intente de nuevo</strong>
    <?php endif; ?>
    <?php Utils::delete_session('delete') ?>
<?php endif; ?>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>PRECIO</th>
            <th>STOCK</th>
            <th>MODIFICAR</th>
            <th>ELIMINAR</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($prod = $productos->fetch_object()): ?>
            <tr>
                <td><?= $prod->id ?></td>
                <td><?= ucfirst($prod->nombre) ?></td>
                <td>€ <?= $prod->precio ?></td>
                <td><?= $prod->stock ?></td>
                <td>
                    <a class="button button-gestion" href="<?= DOMINIO_URL ?>producto/modificar&id=<?= $prod->id ?>">
                        Modificar
                    </a>
                </td>
                <td>
                    <a class="button button-gestion button-red" href="<?= DOMINIO_URL ?>producto/eliminar&id=<?= $prod->id ?>">
                        Eliminar
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
