<h1>Crear nuevo producto</h1>

<div class="form_container">
    <form action="<?=DOMINIO_URL?>producto/save" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" required />

        <label for="descripcion">Descripción</label>
        <textarea name="descripcion" required></textarea>

        <label>Categoría</label>
        <?php $categorias = Utils::showCategorias() ?>
        <select name="categoria">
            <?php while ($cat = $categorias->fetch_object()): ?>
            <option value="<?= $cat->id ?>">
                    <?= $cat->nombre ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label for="precio">Precio</label>
        <input type="number" name="precio" step="0.01" required />

        <label for="stock">Stock</label>
        <input type="number" name="stock" step="1" min="0" required />

        <label for="imagen">Imagen</label>
        <input type="file" name="imagen" accept=".png, .jpg, .jpeg" />
        
        <input type="submit" name="crear" value="Crear" />
    </form>
</div>