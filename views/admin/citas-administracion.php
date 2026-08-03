<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de citas</title>
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
    <div class="layout">

        <?php include __DIR__ . '/../../includes/navbar.php'; ?>

        <section class="admin-usuarios">

            <h1>Administración de citas</h1>

            <?php if (!empty($mensaje)): ?>
                <p class="mensaje-error"><?= htmlspecialchars($mensaje) ?></p>
            <?php endif; ?>

            <?php include __DIR__ . "/citas/$vistaInterna.php"; ?>

        </section>


        <?php include __DIR__ . '/../../includes/footer.php'; ?>

    </div>
    <script src="/Marcelino_Ramos_trabajoFinalPHP/assets/js/hamburguesa.js" defer></script>
</body>
</html>
