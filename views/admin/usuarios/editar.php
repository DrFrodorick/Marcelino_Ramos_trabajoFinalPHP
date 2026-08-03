<form class="editar-form" 
      action="index.php?page=usuarios-administracion&action=editarPost" 
      method="POST">

    <input type="hidden" name="idUser" value="<?= $usuario['idUser'] ?>">

    <label>Usuario:</label>
    <input type="text" name="usuario" value="<?= htmlspecialchars($usuario['usuario']) ?>">

    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>">

    <label>Apellidos:</label>
    <input type="text" name="apellidos" value="<?= htmlspecialchars($usuario['apellidos']) ?>">

    <label>Email:</label>
    <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>">

    <label>Teléfono:</label>
    <input type="text" name="telefono" value="<?= htmlspecialchars($usuario['telefono']) ?>">

    <label>Fecha nacimiento:</label>
    <input type="date" name="fecha_nacimiento" value="<?= htmlspecialchars($usuario['fecha_nacimiento']) ?>">

    <label>Dirección:</label>
    <input type="text" name="direccion" value="<?= htmlspecialchars($usuario['direccion']) ?>">

    <label>Sexo:</label>
    <select name="sexo">
        <option value="H" <?= $usuario['sexo'] === 'H' ? 'selected' : '' ?>>Hombre</option>
        <option value="M" <?= $usuario['sexo'] === 'M' ? 'selected' : '' ?>>Mujer</option>
    </select>

    <label>Rol:</label>
    <select name="rol">
        <option value="user" <?= $usuario['rol'] === 'user' ? 'selected' : '' ?>>Usuario</option>
        <option value="admin" <?= $usuario['rol'] === 'admin' ? 'selected' : '' ?>>Administrador</option>
    </select>

    <label>Nueva contraseña (opcional):</label>
    <input type="password" name="password">

    <button class="editar-btn" type="submit">Guardar cambios</button>
</form>
