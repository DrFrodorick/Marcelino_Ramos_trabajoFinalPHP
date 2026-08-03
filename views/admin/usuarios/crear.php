<h2>Crear usuario</h2>

<form action="index.php?page=usuarios-administracion&action=crearPost" method="POST" class="crear-form">


    <label>Usuario:</label>
    <input type="text" name="usuario" required>

    <label>Nombre:</label>
    <input type="text" name="nombre" required>

    <label>Apellidos:</label>
    <input type="text" name="apellidos" required>

    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Teléfono:</label>
    <input type="text" name="telefono">

    <label>Fecha de nacimiento:</label>
    <input type="date" name="fecha_nacimiento">

    <label>Dirección:</label>
    <input type="text" name="direccion">

    <label>Sexo:</label>
    <select name="sexo">
        <option value="hombre">Hombre</option>
        <option value="mujer">Mujer</option>
        <option value="otro">Otro</option>
    </select>

    <label>Contraseña:</label>
    <input type="password" name="password" required>

    <label>Rol:</label>
    <select name="rol">
        <option value="user">Usuario</option>
        <option value="admin">Administrador</option>
    </select>

    <button class="crear-btn" type="submit">Crear usuario</button>
</form>
