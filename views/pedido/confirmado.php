<?php if (isset($_SESSION['pedido'])): ?>
    <?php if ($_SESSION['pedido'] == 'complete'): ?>
        <h1>Su pedido ha sido confirmado</h1>
        <h3>Datos del pedido</h3>
        <?php if (isset($pedido)): ?>
            <p>
                Número de pedido: <?= $pedido->id ?><br/>
                Total a pagar: $ <?= $pedido->coste ?><br/>
                Productos:
            </p>
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
            <br>
            <a href="">Volver al inicio</a>
        <?php endif; ?>
    <?php elseif ($_SESSION['pedido'] == 'failed'): ?>
        <h1>No se pudo confirmar su pedido</h1>
        <a href="<?= DOMINIO_URL ?>carrito/index">Volver al carrito</a>
    <?php else: ?>
        <h1>No se pudo confirmar su pedido</h1>
    <?php endif; ?>
<?php else: ?>
    <?php header('Location:' . DOMINIO_URL) ?>
<?php endif; ?>

