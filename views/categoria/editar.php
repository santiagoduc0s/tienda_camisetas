<h1>Editar catogoria</h1>

<div class="form_container">
    <form action="categoria/editar&id=<?= $categoria->id ?>" method="POST">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="<?= ucfirst($producto->nombre) ?>" required />
        <input type="submit" name="editar" value="Editar" />
    </form>
</div>
