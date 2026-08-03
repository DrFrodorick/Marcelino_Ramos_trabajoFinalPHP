<h2>Crear cita</h2>

<?php if (isset($_GET["msg"])): ?>

    <?php if ($_GET["msg"] === "fecha_pasada"): ?>
        <p class="alerta-error">❌ No se pueden crear citas para fechas pasadas.</p>
    <?php endif; ?>

    <?php if ($_GET["msg"] === "hoy_no_permitido"): ?>
        <p class="alerta-error">❌ No se pueden crear citas para hoy. Solo para fechas futuras.</p>
    <?php endif; ?>

<?php endif; ?>


<form class="crear-form"
      action="index.php?page=citas-administracion&action=crearPost"
      method="POST">

    <input type="hidden" name="idUser" value="<?= $usuarioSeleccionado ?>">

    <label>Fecha:</label>
    <input type="date" name="fecha_cita" required>

    <label>Descripción:</label>
    <textarea name="motivo_cita" required></textarea>

    <button class="crear-btn">Crear cita</button>
</form>
