<?php
require_once __DIR__ . '/../controllers/RegistroController.php';
// Importa el controlador encargado de procesar el registro de usuarios

$controller = new RegistroController();
// Crea una instancia del controlador de registro

$mensaje = $controller->procesarRegistro();
// Ejecuta el proceso de registro si el formulario fue enviado (POST)
// Devuelve un mensaje de error o éxito para mostrar en la vista

if(session_status() == PHP_SESSION_NONE){
    session_start();
}
// Inicia la sesión si aún no está iniciada (necesario para manejar datos del usuario)
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="/Marcelino_Ramos_trabajoFinalPHP/assets/css/styles.css">
    <!-- FAVICON -->
    <link rel="icon" type="image/png" href="/Marcelino_Ramos_trabajoFinalPHP/assets/favicon/favicon-96x96.png" sizes="96x96" >
    <link rel="icon" type="image/svg+xml" href="/Marcelino_Ramos_trabajoFinalPHP/assets/favicon/favicon.svg" >
    <link rel="shortcut icon" href="/Marcelino_Ramos_trabajoFinalPHP/assets/favicon/favicon.ico" >
    <link rel="apple-touch-icon" sizes="180x180" href="/Marcelino_Ramos_trabajoFinalPHP/assets/favicon/apple-touch-icon.png" >
    <meta name="apple-mobile-web-app-title" content="Servicio Digital" >
    <link rel="manifest" href="/Marcelino_Ramos_trabajoFinalPHP/assets/favicon/site.webmanifest" >
</head>
<body>

    <?php include __DIR__ . "/../includes/navbar.php"; ?>

        <section class="registro">
            <h2>Crear una cuenta</h2>

            <?php if (!empty($mensaje)): ?>
                <div class="mensaje"><?php echo $mensaje; ?></div>
            <?php endif; ?>

            <form action="" method="POST" class="registro-form">

                <label>Nombre *</label>
                <input type="text" name="nombre" required>

                <label>Apellidos *</label>
                <input type="text" name="apellidos" required>

                <label>Email *</label>
                <input type="email" name="email" required>

                <label>Teléfono *</label>
                <input type="text" name="telefono" required>

                <label>Fecha de nacimiento *</label>
                <input type="date" name="fecha_nacimiento" required>

                <label>Dirección</label>
                <textarea name="direccion"></textarea>

                <label>Sexo</label>
                <select name="sexo">
                    <option value="">Seleccionar</option>
                    <option value="Hombre">Hombre</option>
                    <option value="Mujer">Mujer</option>
                    <option value="Otro">Otro</option>
                </select>

                

                <label>Nombre de usuario *</label>
                <input type="text" name="usuario" required>

                <label>Contraseña *</label>
                <input type="password" name="password" required>

                <label>Confirmar contraseña *</label>
                <input type="password" name="password2" required>

                <button type="submit" class="btn registro-btn">Registrarse</button>

                <p class="login-link">
                    ¿Ya tienes cuenta?  
                    <a href="/Marcelino_Ramos_trabajoFinalPHP/views/login.php">Inicia sesión aquí</a>
                </p>

            </form>
        </section>

    <?php include __DIR__ . "/../includes/footer.php"; ?>
    <script src="/Marcelino_Ramos_trabajoFinalPHP/assets/js/hamburguesa.js" defer></script>
</body>
</html>
