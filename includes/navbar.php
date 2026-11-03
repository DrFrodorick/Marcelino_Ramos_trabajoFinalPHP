<?php
require_once __DIR__ . '/../config/app.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$rol = $_SESSION['rol'] ?? 'visitante';
$page = $_GET['page'] ?? 'home';
$archivoActual = basename($_SERVER['PHP_SELF']);
?>
<nav class="navbar">
    <a href="<?= BASE_URL ?>/index.php" class="logo">Servicios Digitales</a>
    
    <div class="hamburger" id="hamburger">
        <span></span>
        <span></span>
        <span></span>
    </div>

    <ul>
        <!-- Siempre visibles -->
        <li><a href="<?= BASE_URL ?>/index.php"class="<?= ($page === 'home' && $archivoActual === 'index.php') ? 'active' : '' ?>">Inicio</a></li>
        <li><a href="<?= BASE_URL ?>/index.php?page=noticias" class="<?= $page === 'noticias' ? 'active' : '' ?>">Noticias</a></li>

        <?php if ($rol === "user"): ?>

            <li><a href="<?= BASE_URL ?>/index.php?page=citas" class="<?= $page === 'citas' ? 'active' : '' ?>">Cita</a></li>
            <li><a href="<?= BASE_URL ?>/index.php?page=perfil" class="<?= $page === 'perfil' ? 'active' : '' ?>">Perfil</a></li>
            <li><a href="<?= BASE_URL ?>/views/logout.php">Cerrar sesión</a></li>

        <?php elseif ($rol === "admin"): ?>

            <li><a href="<?= BASE_URL ?>/index.php?page=usuarios-administracion" class="<?= $page === 'usuarios-administracion' ? 'active' : '' ?>">Usuarios administración</a></li>

            <li><a href="<?= BASE_URL ?>/index.php?page=citas-administracion" class="<?= $page === 'citas-administracion' ? 'active' : '' ?>">Citas administración</a></li>

            <li><a href="<?= BASE_URL ?>/index.php?page=noticias-administracion" class="<?= $page === 'noticias-administracion' ? 'active' : '' ?>">Noticias administración</a></li>

            <li><a href="<?= BASE_URL ?>/index.php?page=perfil" class="<?= $page === 'perfil' ? 'active' : '' ?>">Perfil</a></li>

            <li><a href="<?= BASE_URL ?>/views/logout.php">Cerrar sesión</a></li>

        <?php else: ?>

            <li><a href="<?= BASE_URL ?>/views/login.php" class="<?= $archivoActual === 'login.php' ? 'active' : '' ?>">Iniciar sesión</a></li>
            <li><a href="<?= BASE_URL ?>/views/registro.php" class="<?= $archivoActual === 'registro.php' ? 'active' : '' ?>">Registrarse</a></li>

        <?php endif; ?>
    </ul>
</nav>
