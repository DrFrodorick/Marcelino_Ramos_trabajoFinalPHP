<?php if (isset($_GET["msg"]) && $_GET["msg"] === "creado_ok"): ?>
    <p class="alerta-ok">✔ Cita creada correctamente.</p>
<?php endif; ?>
<?php if (isset($_GET["msg"]) && $_GET["msg"] === "borrado_ok"): ?>
    <p class="alerta-ok">✔ Cita eliminada correctamente.</p>
<?php endif; ?>

<h2>Seleccionar usuario</h2>

<form action="index.php" method="GET" class="crear-form">
    <input type="hidden" name="page" value="citas-administracion">

    <label>Usuario:</label>
    <select name="usuario" required>
        <option value="">-- Selecciona un usuario --</option>

        <?php while ($u = $usuarios->fetch_assoc()): ?>
            <option value="<?= $u['idUser'] ?>"
                <?= $usuarioSeleccionado == $u['idUser'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($u['nombre']) ?>
            </option>
        <?php endwhile; ?>
    </select>

    <button class="crear-btn">Ver citas</button>
</form>

<?php if ($usuarioSeleccionado): ?>

<div class="crear-usuario-container">
    <a class="crear-usuario-btn"
       href="index.php?page=citas-administracion&action=crear&usuario=<?= $usuarioSeleccionado ?>">
        Crear cita
    </a>
</div>

<h2>Citas del usuario</h2>

<table class="tabla-usuarios">
    <thead>
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        <?php while ($c = $citas->fetch_assoc()): ?>
        <tr>
            <td><?= $c['idCita'] ?></td>
            <td><?= htmlspecialchars($c['fecha_cita']) ?></td>
            <td><?= htmlspecialchars($c['motivo_cita']) ?></td>
            <td>
                <a href="index.php?page=citas-administracion&action=editar&id=<?= $c['idCita'] ?>&usuario=<?= $usuarioSeleccionado ?>"
                   class="btn-small">Editar</a>

                <a href="index.php?page=citas-administracion&action=borrar&id=<?= $c['idCita'] ?>&usuario=<?= $usuarioSeleccionado ?>"
                   class="btn-small eliminar-btn">Eliminar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php endif; ?>
