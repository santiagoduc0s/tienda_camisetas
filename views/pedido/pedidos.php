<?php if ($gestion): ?>
    <h1>Gestion de pedidos</h1>
<?php else: ?>
    <h1>Mis pedidos</h1>
<?php endif; ?>
<?php if ($cantPedidos > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Nº de pedido</th>
                <th>Coste</th>
                <th>Fecha</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($pedido = $pedidos->fetch_object()): ?>
                <tr>
                    <td><a href="pedido/ver&id=<?= $pedido->id ?>"><?= $pedido->id ?></a></td>
                    <td>$ <?= $pedido->coste ?></td>
                    <td><?= $pedido->fecha ?></td>
                    <td><?= $pedido->estado ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    Usted no tiene ningún pedido aún
<?php endif; ?>

