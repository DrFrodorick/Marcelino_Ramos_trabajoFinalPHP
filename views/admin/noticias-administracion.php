<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de noticias</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/styles.css">
    <!-- FAVICON -->
    <link rel="icon" type="image/png" href="<?= BASE_URL ?>/assets/favicon/favicon-96x96.png" sizes="96x96" >
    <link rel="icon" type="image/svg+xml" href="<?= BASE_URL ?>/assets/favicon/favicon.svg" >
    <link rel="shortcut icon" href="<?= BASE_URL ?>/assets/favicon/favicon.ico" >
    <link rel="apple-touch-icon" sizes="180x180" href="<?= BASE_URL ?>/assets/favicon/apple-touch-icon.png" >
    <meta name="apple-mobile-web-app-title" content="Servicio Digital" >
    <link rel="manifest" href="<?= BASE_URL ?>/assets/favicon/site.webmanifest" >
</head>
<body>

    <div class="layout">

    <?php include __DIR__ . '/../../includes/navbar.php'; ?>

    <section class="admin-usuarios">

        <h1>Administración de noticias</h1>

        <?php if (!empty($mensaje)): ?>
            <p class="mensaje-error"><?= htmlspecialchars($mensaje) ?></p>
        <?php endif; ?>

        <?php include __DIR__ . "/noticias/$vistaInterna"; ?>

    </section>

    <?php include __DIR__ . '/../../includes/footer.php'; ?>

    </div>
    <script src="<?= BASE_URL ?>/assets/js/hamburguesa.js" defer></script>
</body>
</html>
