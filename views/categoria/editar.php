<h1>Editar catgoria</h1>

<div class="form_container">
    <form action="categoria/editar" method="POST">
        <input type="hidden" name="id" value="<?= $categoria->id ?>" />
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="<?= ucfirst($categoria->nombre) ?>" required />
        <button type="submit">Guardar</button>
    </form>
    <br>
    <a href="categoria/index">Volver a las categorias</a>
</div>
