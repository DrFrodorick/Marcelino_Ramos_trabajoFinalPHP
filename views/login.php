<?php
require_once __DIR__ . '/../controllers/functions/db_functions.php';
require_once __DIR__ . '/../controllers/db_conection/db_conn.php';
// Carga las funciones de base de datos y la conexión

if(session_status() == PHP_SESSION_NONE){
    session_start();
}
// Inicia la sesión si aún no está iniciada

$mensaje = "";
// Variable para mostrar errores o mensajes al usuario

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Solo procesa el login si el formulario fue enviado por POST

    $usuario = trim($_POST["usuario"]);
    $password = trim($_POST["password"]);
    // Recoge y limpia los datos enviados por el formulario

    if ($usuario === "" || $password === "") {
        // Validación básica: campos vacíos
        $mensaje = "Por favor, completa todos los campos.";

    } else {

        // Llama a la función que valida el login en la base de datos
        $login = loginUsuario($usuario, $password);

        if (!$login["ok"]) {
            // Si la función devuelve error → mensaje para el usuario
            $mensaje = $login["mensaje"];

        } else {
            // Login correcto → guardar datos en la sesión
            $_SESSION["idLogin"] = $login["idLogin"];
            $_SESSION["idUser"] = $login["idUser"];
            $_SESSION["usuario"] = $login["usuario"];
            $_SESSION["rol"] = $login["rol"];

            // Redirige al inicio del sitio
            header("Location: ../index.php");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
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

    <main>
        <section class="login">
            <h2>Iniciar sesión</h2>

            <?php if ($mensaje): ?>
                <div class="mensaje"><?php echo $mensaje; ?></div>
            <?php endif; ?>

            <?php if (isset($_GET["registro"]) && $_GET["registro"] === "ok"): ?>
                <div class="mensaje">Registro completado correctamente. Ya puedes iniciar sesión.</div>
            <?php endif; ?>

            <form action="" method="POST" class="login-form">

                <label>Usuario</label>
                <input type="text" name="usuario" required>

                <label>Contraseña</label>
                <input type="password" name="password" required>

                <button type="submit" class="btn login-btn">Entrar</button>

                <p class="registro-link">
                    ¿No tienes cuenta?
                    <a href="registro.php">Regístrate aquí</a>
                </p>

            </form>
        </section>
    </main>

    <?php include __DIR__ . "/../includes/footer.php"; ?>
    <script src="/Marcelino_Ramos_trabajoFinalPHP/assets/js/hamburguesa.js" defer></script>

</body>
</html>

