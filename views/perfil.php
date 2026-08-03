
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
    <!-- FAVICON -->
    <link rel="icon" type="image/png" href="/Marcelino_Ramos_trabajoFinalPHP/assets/favicon/favicon-96x96.png" sizes="96x96" >
    <link rel="icon" type="image/svg+xml" href="/Marcelino_Ramos_trabajoFinalPHP/assets/favicon/favicon.svg" >
    <link rel="shortcut icon" href="/Marcelino_Ramos_trabajoFinalPHP/assets/favicon/favicon.ico" >
    <link rel="apple-touch-icon" sizes="180x180" href="/Marcelino_Ramos_trabajoFinalPHP/assets/favicon/apple-touch-icon.png" >
    <meta name="apple-mobile-web-app-title" content="Servicio Digital" >
    <link rel="manifest" href="/Marcelino_Ramos_trabajoFinalPHP/assets/favicon/site.webmanifest" >

</head>
<body>
    <?php include __DIR__ . '/../includes/navbar.php'; ?>
    <div class="perfil-container">
        <h2>Mi Perfil</h2>

        <!-- NOMBRE DE PERFIL (NO EDITABLE) -->
        <div class="perfil-section">
            <form class="form-username">
                <label>Nombre de perfil:</label>
                <input type="text" value="<?= htmlspecialchars($login['usuario']) ?>" readonly>
            </form>
        </div>

        <!-- FORMULARIO COMPLETO DE EDICIÓN -->
        <form method="POST">

            <!-- NOMBRE -->
            <div class="perfil-section">
                <label>Nombre:</label>
                <input type="text" name="nombre" value="<?= htmlspecialchars($datos['nombre']) ?>">
            </div>

            <!-- APELLIDOS -->
            <div class="perfil-section">
                <label>Apellidos:</label>
                <input type="text" name="apellidos" value="<?= htmlspecialchars($datos['apellidos']) ?>">
            </div>

            <!-- EMAIL -->
            <div class="perfil-section">
                <label>Email:</label>
                <input type="email" name="email" value="<?= htmlspecialchars($datos['email']) ?>">
            </div>

            <!-- TELÉFONO -->
            <div class="perfil-section">
                <label>Teléfono:</label>
                <input type="text" name="telefono" value="<?= htmlspecialchars($datos['telefono']) ?>">
            </div>

            <!-- DIRECCIÓN -->
            <div class="perfil-section">
                <label>Dirección:</label>
                <input type="text" name="direccion" value="<?= htmlspecialchars($datos['direccion']) ?>">
            </div>

            <!-- FECHA DE NACIMIENTO -->
            <div class="perfil-section">
                <label>Fecha de nacimiento:</label>
                <input type="date" name="fecha_nacimiento" value="<?= htmlspecialchars($datos['fecha_nacimiento']) ?>">
            </div>

            <!-- SEXO -->
            <div class="perfil-section">
                <label>Sexo:</label>
                <select name="sexo">
                    <option value="hombre" <?= $datos['sexo'] === 'hombre' ? 'selected' : '' ?>>Hombre</option>
                    <option value="mujer" <?= $datos['sexo'] === 'mujer' ? 'selected' : '' ?>>Mujer</option>
                </select>
            </div>

            <button type="submit" class="btn-guardar">Guardar cambios</button>
        </form>

        <!-- CAMBIO DE CONTRASEÑA -->
        <div class="perfil-section-pass">
            <form method="POST" class="form-pass">
                <div class="fila-pass">
                    <label>Nueva contraseña:</label>
                    <input type="password" name="password1">

                    <label>Confirmar:</label>
                    <input type="password" name="password2">
                </div>

                <button type="submit" name="update_password" class="btn-guardar btn-pass">Guardar</button>
            </form>
        </div>

    </div>
    <?php include __DIR__ . '/../includes/footer.php'; ?>
    <script src="/Marcelino_Ramos_trabajoFinalPHP/assets/js/hamburguesa.js" defer></script>
</body>
</html>
