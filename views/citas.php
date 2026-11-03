<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Citaciones</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
    <!-- FAVICON -->
    <link rel="icon" type="image/png" href="<?= BASE_URL ?>/assets/favicon/favicon-96x96.png" sizes="96x96" >
    <link rel="icon" type="image/svg+xml" href="<?= BASE_URL ?>/assets/favicon/favicon.svg" >
    <link rel="shortcut icon" href="<?= BASE_URL ?>/assets/favicon/favicon.ico" >
    <link rel="apple-touch-icon" sizes="180x180" href="<?= BASE_URL ?>/assets/favicon/apple-touch-icon.png" >
    <meta name="apple-mobile-web-app-title" content="Servicio Digital" >
    <link rel="manifest" href="<?= BASE_URL ?>/assets/favicon/site.webmanifest" >

</head>
<body>
    <main> 
        <?php include __DIR__ . "/../includes/navbar.php"; ?>

        <div class="perfil-container">
            <h2>Mis Citaciones</h2>

            <?php if ($mensaje !== ""): ?>
                <p class="mensaje"><?= $mensaje ?></p>
            <?php endif; ?>

            <!-- CREAR CITA -->
            <div class="perfil-section">
                <form method="POST">
                    <label>Fecha de la cita:</label>
                    <input type="date" name="fecha_cita">

                    <label>Motivo:</label>
                    <input type="text" name="motivo">

                    <button type="submit" name="crear_cita" class="btn-guardar">Crear cita</button>
                </form>
            </div>

            <h2>Citas programadas</h2>

            <?php while ($cita = $citas->fetch_assoc()): ?>
                <div class="perfil-section">
                    <form method="POST">
                        <label>Fecha:</label>
                        <input type="date" name="fecha_cita" value="<?= $cita['fecha_cita'] ?>">

                        <label>Motivo:</label>
                        <input type="text" name="motivo" value="<?= $cita['motivo_cita'] ?>">

                        <input type="hidden" name="idCita" value="<?= $cita['idCita'] ?>">

                        <button type="submit" name="editar_cita" class="btn-guardar">Modificar</button>
                        <button type="submit" name="borrar_cita" class="btn-borrar">Eliminar</button>
                    </form>
                </div>
            <?php endwhile; ?>

        </div>
    </main>
    <?php include __DIR__ . "/../includes/footer.php"; ?>
    <script src="<?= BASE_URL ?>/assets/js/hamburguesa.js" defer></script>
</body>
</html>