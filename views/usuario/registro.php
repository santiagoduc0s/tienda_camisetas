<h1>Registrarse</h1>

<?php if (isset($_SESSION['registro']) && $_SESSION['registro'] == 'complete'): ?> 
    <strong class="alert_green">¡Registro satifactorio!</strong>
<?php elseif (isset($_SESSION['registro']) && $_SESSION['registro'] == 'problem'): ?>
    <strong class="alert_red">Lamentablemente no su pudo completar el registro</strong>
<?php elseif (isset($_SESSION['registro']) && $_SESSION['registro'] == 'error'): ?>
    <strong class="alert_red">Ocurrió un problema, intente registrarse nuevamente</strong>
<?php endif; ?>
<?php Utils::delete_session('registro'); ?>

<form action="<?= DOMINIO_URL; ?>usuario/save" method="POST">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" required />
    
    <label for="apellidos">Apellidos</label>
    <input type="text" name="apellidos" required />
    
    <label for="email">Email</label>
    <input type="email" name="email" required />
    
    <label for="password">Password</label>
    <input type="password" name="password" required />
    
    <input type="submit" name="registro" value="Registrar" />
</form>