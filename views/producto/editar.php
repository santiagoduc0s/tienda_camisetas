<h1>Editar producto</h1>

<div class="form_container">
    <form action="<?= DOMINIO_URL ?>producto/editar&id=<?= $producto->id ?>" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="<?= ucfirst($producto->nombre) ?>" required />

        <label for="descripcion">Descripción</label>
        <textarea name="descripcion" required><?= ucfirst($producto->descripcion) ?></textarea>

        <label>Categoría</label>
        <?php $categorias = Utils::showCategorias() ?>
        <select name="categoria">
            <?php while ($cat = $categorias->fetch_object()): ?>
                <?php if ($cat->id != $producto->categoria_id): ?>
                    <option value="<?= $cat->id ?>">
                        <?= ucfirst($cat->nombre) ?>
                    </option>
                <?php else: ?>
                    <option value="<?= $cat->id ?>" selected>
                        <?= ucfirst($cat->nombre) ?>
                    </option>
                <?php endif; ?>
            <?php endwhile; ?>
        </select>

        <label for="precio">Precio</label>
        <input type="number" name="precio" value="<?= $producto->precio ?>" step="0.01" required />

        <label for="stock">Stock</label>
        <input type="number" name="stock" value="<?= $producto->stock ?>" step="1" min="0" required />

        <label for="imagen">Imagen</label>
        <?php if (!is_null($producto->imagen)): ?>
            <img class="thumb" src="<?= DOMINIO_URL ?>uploads/image/<?= $producto->imagen ?>" />
        <?php endif; ?>
        <input type="file" name="imagen" accept=".png, .jpg, .jpeg" />

        <input type="submit" name="editar" value="Editar" />
    </form>
</div>

