<h1>Categorias</h1>

<a href="<?=DOMINIO_URL?>categoria/crear" class="button button-small">
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
                    <a class="button">
                        Modificar
                    </a>
                </td>
                <td>
                    <a class="button button-red">
                        Eliminar
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>


