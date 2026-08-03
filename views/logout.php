<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
$_SESSION = [];

// Destruir la sesión
session_destroy();

// Redirigir al usuario al index como visitante
header("Location: ../index.php");
exit();
?>


?>