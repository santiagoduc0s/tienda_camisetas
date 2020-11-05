<h1>Algunos de nuestros productos</h1>


<?php if (isset($_SESSION['error-sistem'])): ?>
    <?php if ($_SESSION['error-sistem'] == 'typeError'): ?>
        <p class="alert_green">Ocurrió un error en el sistema</p>
    <?php endif; ?>
    <?php Utils::delete_session('error-sistem') ?>
<?php endif; ?>

<?php while ($prod = $productos->fetch_object()): ?>
    <div class="product">
        <a href="<?=DOMINIO_URL?>producto/ver&id=<?=$prod->id?>">
            <?php if ($prod->imagen != null): ?>
                <img src="<?= DOMINIO_URL ?>uploads/image/<?= $prod->imagen ?>" />
            <?php else: ?>
                <img src="<?= DOMINIO_URL ?>assets/img/camiseta.png" />
            <?php endif; ?>
            <h2><?= $prod->nombre ?></h2>
        </a>
        <p><?= $prod->precio ?></p>
        <a href="<?=DOMINIO_URL?>carrito/add&id=<?=$prod->id?>" class="button">Comprar</a>
    </div>
<?php endwhile; ?>