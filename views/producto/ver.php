<?php if (isset($producto)): ?>
    <h1><?= ucfirst($producto->nombre) ?></h1>
    <div id="detail-product">
        <div class="image">
            <?php if ($producto->imagen != null): ?>
                <img src="<?= DOMINIO_URL ?>uploads/image/<?= $producto->imagen ?>" />
            <?php else: ?>
                <img src="<?= DOMINIO_URL ?>assets/img/camiseta.png" />
            <?php endif; ?>
        </div>
        <div class="data">
            <p class="description"><?= $producto->descripcion ?></p>
            <p class="price">€ <?= $producto->precio ?></p>
            <a href="<?=DOMINIO_URL?>carrito/add&id=<?=$producto->id?>" class="button">Comprar</a>
        </div>
    </div>
<?php else: ?>
    <h1>El producto no existe</h1>
<?php endif; ?>
