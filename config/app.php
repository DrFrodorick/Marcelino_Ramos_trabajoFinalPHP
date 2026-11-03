<?php
/**
 * Configuración general de la aplicación.
 *
 * BASE_URL contiene la ruta pública del proyecto y se calcula automáticamente:
 *  - En local con XAMPP (htdocs/Marcelino_Ramos_trabajoFinalPHP) vale "/Marcelino_Ramos_trabajoFinalPHP".
 *  - En un hosting donde el proyecto está en la raíz (htdocs) vale "" (cadena vacía).
 * Así los enlaces, estilos e imágenes funcionan en cualquier servidor sin tocar el código.
 */
if (!defined('BASE_URL')) {
    $docRoot = rtrim(str_replace('\\', '/', (string) realpath($_SERVER['DOCUMENT_ROOT'] ?? '')), '/');
    $appRoot = rtrim(str_replace('\\', '/', (string) realpath(__DIR__ . '/..')), '/');

    $base = ($docRoot !== '' && stripos($appRoot, $docRoot) === 0)
        ? substr($appRoot, strlen($docRoot))
        : '';

    define('BASE_URL', rtrim($base, '/'));
}
