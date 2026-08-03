<h2>Editar cita</h2>

<form class="crear-form"
      action="index.php?page=citas-administracion&action=editarPost"
      method="POST">

    <input type="hidden" name="idCita" value="<?= $cita['idCita'] ?>">
    <input type="hidden" name="idUser" value="<?= $cita['idUser'] ?>">

    <label>Fecha:</label>
    <input type="date" name="fecha_cita" value="<?= htmlspecialchars($cita['fecha_cita']) ?>" required>

    <label>Descripción:</label>
    <textarea name="motivo_cita" required><?= htmlspecialchars($cita['motivo_cita']) ?></textarea>

    <button class="crear-btn">Guardar cambios</button>
</form>
