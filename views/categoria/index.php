<h1>Categorias</h1>

<?php if (isset($_SESSION['edit-categoria'])): ?>
    <?php if ($_SESSION['edit-categoria'] == 'complete'): ?>
        <p class="alert_green">Se ha modificado la categoría</p><br>
    <?php elseif ($_SESSION['edit-categoria'] == 'failed'): ?>
        <p class="alert_red">Ocurrió un error, intente de nuevo</p><br>
    <?php endif; ?>
    <?php Utils::delete_session('edit-categoria') ?>
<?php endif; ?>

<?php if (isset($_SESSION['delete-categoria'])): ?>
    <?php if ($_SESSION['delete-categoria'] == 'complete'): ?>
        <p class="alert_green">Se ha eliminado la categoría</p><br>
    <?php elseif ($_SESSION['delete-categoria'] == 'failed'): ?>
        <p class="alert_red">Ocurrió un error o existen productos en esta categoria, intente de nuevo</p><br>
    <?php endif; ?>
    <?php Utils::delete_session('delete-categoria') ?>
<?php endif; ?>

<a href="<?= DOMINIO_URL ?>categoria/crear" class="button button-small">
    Crear categoria
</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($cat = $categorias->fetch_object()): ?>
            <tr>
                <td><?= $cat->id ?></td>
                <td><?= ucfirst($cat->nombre) ?></td>
                <td>
                    <a class="button" href="categoria/editar_view&id=<?= $cat->id ?>">
                        Modificar
                    </a>
                </td>
                <td>
                    <a class="button button-red" href="categoria/borrar&id=<?= $cat->id ?>">
                        Eliminar
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>


