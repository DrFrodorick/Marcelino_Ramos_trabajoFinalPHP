<?php
require_once __DIR__ . '/controllers/db_conection/db_conn.php';
require_once __DIR__ . '/controllers/functions/db_functions.php';
require_once __DIR__ . '/models/noticias_model.php';
require_once __DIR__ . '/controllers/noticiasController.php';
// Carga las dependencias necesarias para manejar noticias y la conexión a la BD

if(session_status() == PHP_SESSION_NONE){
    session_start();
}
// Inicia la sesión si aún no está iniciada

/* ============================================================
   RUTA: NOTICIAS (página pública)
============================================================ */
if (isset($_GET['page']) && $_GET['page'] === 'noticias') {

    $conexion = db_conn();                     // Obtiene conexión a la BD
    $model = new NoticiasModel($conexion);     // Crea el modelo de noticias
    $controller = new NoticiasController($model); // Crea el controlador

    $controller->mostrarNoticias();            // Ejecuta la acción principal
    exit;                                      // Detiene la ejecución del router
}

/* ============================================================
   RUTA: PERFIL DE USUARIO
============================================================ */
if (isset($_GET['page']) && $_GET['page'] === 'perfil') {

    require_once __DIR__ . '/controllers/db_conection/db_conn.php';
    require_once __DIR__ . '/models/perfilModel.php';
    require_once __DIR__ . '/controllers/user/perfilController.php';
    // Carga los archivos necesarios para manejar el perfil

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $conexion = db_conn();                     // Conexión BD
    $model = new PerfilModel($conexion);       // Modelo del perfil
    $controller = new PerfilController($model);// Controlador del perfil

    $controller->perfil();                     // Ejecuta la acción del perfil
    exit;                                      // Imprescindible para evitar cargar otras rutas
}

/* ============================================================
   RUTA: CITAS (usuario normal)
============================================================ */
if (isset($_GET['page']) && $_GET['page'] === 'citas') {

    $conexion = db_conn();
    require_once __DIR__ . "/models/citasModel.php";
    require_once __DIR__ . "/controllers/user/citasController.php";

    $model = new CitasModel($conexion);
    $controller = new CitasController($model);

    $controller->citas();                      // Acción principal de citas
    exit;
}

/* ============================================================
   RUTA: ADMINISTRACIÓN DE USUARIOS
============================================================ */
if (isset($_GET['page']) && $_GET['page'] === 'usuarios-administracion') {

    require_once __DIR__ . '/controllers/db_conection/db_conn.php';
    require_once __DIR__ . '/models/admin/adminUsuariosModel.php';
    require_once __DIR__ . '/controllers/admin/adminUsuariosController.php';

    $conn = db_conn();
    $model = new AdminUsuariosModel($conn);
    $controller = new AdminUsuariosController($model);

    // Acciones específicas dentro de la administración
    if (isset($_GET['action'])) {

        if ($_GET['action'] === 'crear')      { $controller->crear();      exit; }
        if ($_GET['action'] === 'crearPost')  { $controller->crearPost();  exit; }
        if ($_GET['action'] === 'editar')     { $controller->editar();     exit; }
        if ($_GET['action'] === 'editarPost') { $controller->editarPost(); exit; }
        if ($_GET['action'] === 'borrar')     { $controller->borrar();     exit; }
    }

    // Acción por defecto
    $controller->index();
    exit;
}

/* ============================================================
   RUTA: ADMINISTRACIÓN DE CITAS
============================================================ */
if (isset($_GET['page']) && $_GET['page'] === 'citas-administracion') {

    require_once __DIR__ . '/controllers/db_conection/db_conn.php';
    require_once __DIR__ . '/models/admin/adminCitasModel.php';
    require_once __DIR__ . '/controllers/admin/adminCitasController.php';

    $conn = db_conn();
    $model = new AdminCitasModel($conn);
    $controller = new AdminCitasController($model);

    // Acciones específicas
    if (isset($_GET['action'])) {

        if ($_GET['action'] === 'crear')      { $controller->crear();      exit; }
        if ($_GET['action'] === 'crearPost')  { $controller->crearPost();  exit; }
        if ($_GET['action'] === 'editar')     { $controller->editar();     exit; }
        if ($_GET['action'] === 'editarPost') { $controller->editarPost(); exit; }
        if ($_GET['action'] === 'borrar')     { $controller->borrar();     exit; }
    }

    $controller->index();
    exit;
}

/* ============================================================
   RUTA: ADMINISTRACIÓN DE NOTICIAS
============================================================ */
if (isset($_GET['page']) && $_GET['page'] === 'noticias-administracion') {

    require_once __DIR__ . '/controllers/db_conection/db_conn.php';
    require_once __DIR__ . '/models/admin/adminNoticiasModel.php';
    require_once __DIR__ . '/controllers/admin/adminNoticiasController.php';

    $conn = db_conn();
    $model = new AdminNoticiasModel($conn);
    $controller = new AdminNoticiasController($model);

    // Acciones específicas
    if (isset($_GET['action'])) {

        if ($_GET['action'] === 'crear')      { $controller->crear();      exit; }
        if ($_GET['action'] === 'crearPost')  { $controller->crearPost();  exit; }
        if ($_GET['action'] === 'editar')     { $controller->editar();     exit; }
        if ($_GET['action'] === 'editarPost') { $controller->editarPost(); exit; }
        if ($_GET['action'] === 'borrar')     { $controller->borrar();     exit; }
    }

    // Acción por defecto
    $controller->index();
    exit;
}

/* ============================================================
   CARGA POR DEFECTO (NOTICIAS)
============================================================ */
$noticias = noticiasIndex();                   // Noticias para la página principal
$conexion = db_conn();                         // Conexión BD
$model = new NoticiasModel($conexion);         // Modelo de noticias
$controller = new NoticiasController($model);  // Controlador de noticias

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SERVICIOS DIGITALES</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- FAVICON -->
    <link rel="icon" type="image/png" href="<?= BASE_URL ?>/assets/favicon/favicon-96x96.png" sizes="96x96" >
    <link rel="icon" type="image/svg+xml" href="<?= BASE_URL ?>/assets/favicon/favicon.svg" >
    <link rel="shortcut icon" href="<?= BASE_URL ?>/assets/favicon/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= BASE_URL ?>/assets/favicon/apple-touch-icon.png" >
    <meta name="apple-mobile-web-app-title" content="Servicio Digital" >
    <link rel="manifest" href="<?= BASE_URL ?>/assets/favicon/site.webmanifest" >


</head>
<body>
<div class="layout">
    <?php include __DIR__ . '/includes/navbar.php'; ?>
    <!-- HERO -->
    <header class="hero">

        <!-- CARRUSEL -->
        <div class="hero-slide" style="background-image: url('assets/images/carrusel_hero/hero1.jpg');" width="4256" height="2832"></div>
        <div class="hero-slide" style="background-image: url('assets/images/carrusel_hero/hero2.jpg');" width="5906" height="3937"></div>
        <div class="hero-slide" style="background-image: url('assets/images/carrusel_hero/hero3.jpg');" width="2690" height="4033"></div>

        <!-- BOTONES DEL CARRUSEL -->
        <button id="prev-btn" class="hero-btn">‹</button>
        <button id="next-btn" class="hero-btn">›</button>

        <!-- TU CONTENIDO ORIGINAL -->
        <div class="hero-content">
            <h1>Soluciones digitales para impulsar tus ideas</h1>
            <p>Servicios modernos, soporte confiable y herramientas pensadas para ti.</p>
            
        </div>

    </header>

    <!-- SERVICIOS -->
    <section class="servicios">
        <h2>Servicios destacados</h2>

        <div class="cards">
            <div class="card">
                <h3>Consultoría digital</h3>
                <p>Planificación y mejora de tus proyectos tecnológicos.</p>
            </div>

            <div class="card">
                <h3>Optimización web</h3>
                <p>Mejoramos el rendimiento y la experiencia de tu sitio.</p>
            </div>

            <div class="card">
                <h3>Soporte técnico</h3>
                <p>Asistencia personalizada y resolución de problemas.</p>
            </div>

            <div class="card">
                <h3>Gestión de proyectos</h3>
                <p>Organización y seguimiento profesional.</p>
            </div>
        </div>
    </section>

    <!-- NOTICIAS DINÁMICAS -->
    <section class="noticias">
        <h2>Últimas noticias</h2>

        <div class="cards">

            <?php if ($noticias && count($noticias) > 0): ?>
                <?php foreach ($noticias as $row): ?>

                    <?php
                    // La imagen siempre existe
                    $rutaImagen = BASE_URL . "/uploads/" . $row['imagen'];
                    ?>

                    <div class="card noticia">
                        <img src="<?= $rutaImagen ?>" alt="Imagen noticia">

                        <h3><?= htmlspecialchars($row['titulo']); ?></h3>

                        <small>
                            <?= htmlspecialchars($row['fecha']); ?> — por <?= htmlspecialchars($row['nombre']); ?>
                        </small>

                        <p><?= htmlspecialchars(substr($row['texto'], 0, 120)); ?>...</p>

                        <a href="index.php?page=noticias&id=<?= $row['idNoticia']; ?>" class="btn-small">Leer más</a>
                    </div>

                <?php endforeach; ?>
            <?php else: ?>
                <p>No hay noticias disponibles.</p>
            <?php endif; ?>

        </div>
    </section>

    <!-- MIS PROYECTOS -->
    <section class="servicios">
        <h2>Nuestros proyectos web</h2>

        <div class="cards">
            <div class="card">
                <h3>Proyecto HTML</h3>
                <p>Trabajo completo realizado en HTML y CSS.</p>
                <a href="https://drfrodorick.github.io/Marcelino_Ramos_trabajoHTML/" class="btn-small" target="_blank">Ver proyecto</a>
            </div>

            <div class="card">
                <h3>Proyecto JavaScript</h3>
                <p>Aplicación interactiva desarrollada con JavaScript.</p>
                <a href="https://drfrodorick.github.io/Marcelino_Ramos_trabajoJAVASCRIPT/" class="btn-small" target="_blank">Ver proyecto</a>
            </div>
        </div>
    </section>


    <!--CTA-->
    <section class="cta">
        <h2>¿Listo para impulsar tu proyecto?</h2>
        <p>Estamos preparados para ayudarte a dar el siguiente paso con soluciones digitales a medida.</p>
        <a href="<?= BASE_URL ?>/views/registro.php" class="btn cta-btn">Registrarme</a>
    </section>

    <?php include __DIR__ . '/includes/footer.php'; ?>
    <script src="<?= BASE_URL ?>/assets/js/main.js" defer></script>
    <script src="<?= BASE_URL ?>/assets/js/hamburguesa.js" defer></script>
</div>
</body>
</html>