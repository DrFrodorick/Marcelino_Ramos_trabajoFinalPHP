<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticias</title>
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

        <?php include __DIR__ . '/../includes/navbar.php'; ?>
        <section class="noticias-contenido">
            <?php if (!empty($noticia)): ?>
                <!-- ---------------------------------------------------------
                    NOTICIA INDIVIDUAL
                    Se muestra cuando existe un ID en la URL
                --------------------------------------------------------- -->

                <header class="noticia-header">
                    <!-- Título y datos del autor -->
                    <h2><?= htmlspecialchars($noticia['titulo']) ?></h2>
                    <small>
                        <?= htmlspecialchars($noticia['fecha']) ?> — 
                        por <?= htmlspecialchars($noticia['nombre'] . " " . $noticia['apellidos']) ?>
                    </small>
                </header>

                <div class="noticia-detalle">
                    <!-- Imagen principal de la noticia -->
                    <img class="noticia-imagen" 
                        src="/Marcelino_Ramos_trabajoFinalPHP/uploads/<?= htmlspecialchars($noticia['imagen']) ?>"
                        alt="Imagen noticia">

                    <!-- Texto completo de la noticia -->
                    <p class="noticia-texto">
                        <?= nl2br(htmlspecialchars($noticia['texto'])) ?>
                    </p>
                    <a href="/Marcelino_Ramos_trabajoFinalPHP/index.php?page=noticias" class="btn-small volver-btn">← Volver a noticias</a>
                </div>

            <?php else: ?>
                <!-- ---------------------------------------------------------
                    LISTA DE NOTICIAS O MENSAJE DE ERROR
                    Se muestra cuando NO hay ID en la URL
                --------------------------------------------------------- -->

                <?php if (empty($listaNoticias)): ?>
                    <!-- NO HAY NOTICIAS PUBLICADAS -->
                    <div class="noticia-error">
                        <h2>No hay noticias publicadas</h2>
                        <p>Parece que aún no se ha publicado ninguna noticia.</p>

                        <a href="/Marcelino_Ramos_trabajoFinalPHP/index.php" class="btn-small volver-btn">← Volver al inicio</a>
                    </div>

                <?php else: ?>

                    <!-- MOSTRAR TODAS LAS NOTICIAS -->
                    <h2 class="titulo-lista">Noticias</h2>

                    <div class="lista-noticias">
                        <?php foreach ($listaNoticias as $n): ?>
                            <article class="noticia-card">
                                <!-- Imagen de la noticia -->
                                <img src="/Marcelino_Ramos_trabajoFinalPHP/uploads/<?= htmlspecialchars($n['imagen']) ?>"
                                    class="noticia-card-img">

                                <!-- Título -->
                                <h3><?= htmlspecialchars($n['titulo']) ?></h3>

                                <!-- Fecha y autor -->
                                <small>
                                    <?= htmlspecialchars($n['fecha']) ?> — 
                                    por <?= htmlspecialchars($n['nombre'] . " " . $n['apellidos']) ?>
                                </small>

                                <!-- Resumen del texto (primeros 150 caracteres) -->
                                <p><?= substr(htmlspecialchars($n['texto']), 0, 150) ?>...</p>

                                <!-- Enlace a la noticia completa -->
                                <a href="/Marcelino_Ramos_trabajoFinalPHP/index.php?page=noticias&id=<?= $n['idNoticia'] ?>" class="btn-small">Leer más</a>
                            </article>
                        <?php endforeach; ?>
                    </div>

                <?php endif; ?>
            <?php endif; ?>
        </section>
        <?php include __DIR__ . '/../includes/footer.php'; ?>
        <script src="/Marcelino_Ramos_trabajoFinalPHP/assets/js/hamburguesa.js" defer></script>
    </div>
</body>

</body>
</html>
