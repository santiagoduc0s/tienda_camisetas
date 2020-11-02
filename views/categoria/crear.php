<h1>Crear nueva categoría</h1>
<form action="<?=DOMINIO_URL?>categoria/guardar" method="POST">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" required />
    <input type="submit" name="crear" value="Crear" />
</form>
