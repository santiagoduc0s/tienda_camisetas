<h1>Hacer pedido</h1>

<h3>Dirección del envío</h3>
<form action="<?= DOMINIO_URL ?>pedido/add" method="POST">
    <label for="departamento">Departamanto</label>
    <input type="text" name="departamento" required/>

    <label for="ciudad">Ciudad</label>
    <input type="text" name="ciudad" required/>

    <label for="direccion">Dirección</label>
    <input type="text" name="direccion" required/>

    <button type="submit" name="enviar-pedido">
        Confirmar pedido
    </button>
</form>

<br>

<a href="<?= DOMINIO_URL ?>carrito/index">Volver atrás</a>

