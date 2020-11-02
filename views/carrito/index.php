<h1>Carrito de la compra</h1>
<?php if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])): ?>
    <table>
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Unidades</th>
                <th>Sacar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($carrito as $indice => $elemento):
                $prodObj = $elemento['producto'];
                ?>
                <tr>
                    <td>
                        <?php if ($prodObj->imagen != null || $prodObj->imagen = ''): ?>
                            <img class="img_carrito" src="<?= DOMINIO_URL ?>uploads/image/<?= $prodObj->imagen ?>" />
                        <?php else: ?>
                            <img class="img_carrito" src="<?= DOMINIO_URL ?>assets/img/camiseta.png" />
                        <?php endif; ?>
                    </td>
                    <td><a href="producto/ver&id=<?= $elemento['id_producto'] ?>"><?= $prodObj->nombre ?></a></td>
                    <td>$ <?= $elemento['precio'] ?></td>
                    <td>
                        <?= $elemento['unidades'] ?>
                        <div class="updown-unidades">
                            <a class="button" href="carrito/lessUnidades&indice=<?= $indice ?>">-</a>
                            <a class="button" href="carrito/moreUnidades&indice=<?= $indice ?>">+</a>
                        </div>
                    </td>
                    <td><a href="<?= DOMINIO_URL ?>carrito/delete&indice=<?= $indice ?>" class="button button-carrito button-red">Quitar producto</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br />
    <div class="delete-carrito">
        <a href="<?= DOMINIO_URL ?>carrito/delete_all" class="button button-delete button-red">Vaciar carrito</a>
    </div>
    <div class="total-carrito">
        <h3>Precio total: $ <?= Utils::statusCarrito()['total'] ?></h3>
        <a href="<?= DOMINIO_URL ?>pedido/hacer" class="button button-pedido">Hacer pedido</a>
    </div>
<?php else: ?>
    No hay productos en su carrito
<?php endif; ?>

