<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>Tienda de camisetas</title>
        <base href="<?= DOMINIO_URL ?>" />
        <link rel="stylesheet" href="<?= DOMINIO_URL; ?>assets/css/styles.css" />
    </head>
    <body>
        <div id="container">
            <!-- cabecera -->
            <header id="header">
                <div id="logo">
                    <img src="<?= DOMINIO_URL; ?>/assets/img/camiseta.png" alt="Camiseta logo" />
                    <a href="<?= DOMINIO_URL; ?>">
                        Tienda de Camisetas
                    </a>
                </div>
            </header>

            <!-- menu -->
            <?php $categorias = Utils::showCategorias() ?>
            <nav id="menu">
                <ul>
                    <li>
                        <a href="<?= DOMINIO_URL ?>">
                            Inicio
                        </a>
                    </li>
                    <?php while ($cat = $categorias->fetch_object()): ?>
                    <li>
                        <a href="<?= DOMINIO_URL ?>categoria/ver&id=<?= $cat->id ?>">
                            <?= ucfirst($cat->nombre) ?>
                        </a>
                    </li>
                    <?php endwhile; ?>
                </ul>
            </nav>

            <div id="content">