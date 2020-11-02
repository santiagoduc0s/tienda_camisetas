<h1>Detalle del pedido</h1>

<?php if (isset($_SESSION['set_pedido'])): ?>
    <?php if ($_SESSION['set_pedido'] == 'complete'): ?>
        <p><strong class="alert_green">Se ha modificado el pedido</strong></p>
    <?php elseif ($_SESSION['set_pedido'] == 'failed'): ?>
        <p><strong class="alert_red">Ocurió un error, vuelva a intentarlo</strong></p>
    <?php endif; ?>
    <?php Utils::delete_session('set_pedido') ?>
<?php endif; ?>

<h3>Datos del pedido</h3>

Número de pedido: <?= $pedido->id ?><br/>
Total a pagar: $ <?= $pedido->coste ?><br/>
Envio a: <?= ucfirst($pedido->departamento) ?>, <?= ucwords($pedido->ciudad) ?>, <?= ucwords($pedido->direccion) ?><br/>
Dia y hora: <?= $pedido->fecha ?> <?= $pedido->hora ?><br/>
Estado: 
<?php if ($gestion): ?>
    <form action="<?= DOMINIO_URL ?>pedido/estado" method="POST">
        <input type="hidden" name="pedido_id" value="<?= $pedido->id ?>" />
        <select name="estado">
            <?php foreach ($estados as $est): ?>
                <?php if ($pedido->estado == $est): ?>
                    <option value="<?= $est ?>" selected><?= ucfirst($est) ?></option>
                <?php else: ?>
                    <option value="<?= $est ?>"><?= ucfirst($est) ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
        <button type="submit">Modificar Estado</button><br/>
    </form>
<?php else: ?>
    <?= ucfirst($pedido->estado) ?><br/>
<?php endif; ?>

Productos:
<table>
    <thead>
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Unidades</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($producto = $productos->fetch_object()): ?>
            <tr>
                <td>
                    <?php if ($producto->imagen != null || $producto->imagen = ''): ?>
                        <img class="img_carrito" src="<?= DOMINIO_URL ?>uploads/image/<?= $producto->imagen ?>" />
                    <?php else: ?>
                        <img class="img_carrito" src="<?= DOMINIO_URL ?>assets/img/camiseta.png" />
                    <?php endif; ?>
                </td>
                <td><a href="producto/ver&id=<?= $producto->id ?>" target="_blank"><?= ucfirst($producto->nombre) ?></a></td>
                <td>$ <?= $producto->precio ?></td>
                <td><?= $producto->unidades ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
<br/>
<?php if ($gestion): ?>
    <a href="pedido/pedidos">Volver a los pedidos</a>
<?php else: ?>
    <a href="pedido/pedidos">Volver a mis pedidos</a>
<?php endif; ?>


