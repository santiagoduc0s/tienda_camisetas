<?php if (isset($categoria)): ?>
    <h1><?= ucfirst($categoria->nombre) ?></h1>
    <?php if($cantidadProd > 0): ?>
        <?php while ($prod = $productos->fetch_object()): ?>
            <div class="product">
                <a href="<?=DOMINIO_URL?>producto/ver&id=<?=$prod->id?>">
                    <?php if ($prod->imagen != null): ?>
                        <img src="<?=DOMINIO_URL?>uploads/image/<?=$prod->imagen?>" />
                    <?php else: ?>
                        <img src="<?=DOMINIO_URL?>assets/img/camiseta.png" />
                    <?php endif; ?>
                    <h2><?=$prod->nombre?></h2>
                </a>
                <p><?=$prod->precio?></p>
                <a href="<?=DOMINIO_URL?>carrito/add&id=<?=$prod->id?>" class="button">Comprar</a>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No hay productos de esta categoria</p>
    <?php endif; ?>

<?php else: ?>
    <h1>La categoria no existe</h1>
<?php endif; ?>

