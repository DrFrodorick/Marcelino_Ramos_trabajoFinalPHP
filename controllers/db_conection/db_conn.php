<?php
# Incluir/vincular los parámetros de conexión
require_once __DIR__ . '/../../config/app.php';
require_once __DIR__ . '/.env.php';



date_default_timezone_set("Europe/Madrid");

# Definimos una función para realizar la conexión a la BBDD
function db_conn(){
    # Crear una variable de conexión
    static $db_conn = null;

    if($db_conn === null){
        try{
            # Crear la conexión a la BBDD
            $db_conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

            # Comprobar que la conexión se haya realizado correctamente
            if($db_conn -> connect_errno){
                # Registrar el error en el archivo log
                error_log("Fallo al conecar a la base de datos: " . $db_conn -> connect_error);
                return null;
            }

            # Usar UTF-8 completo para que tildes y eñes se guarden y muestren bien
            $db_conn->set_charset('utf8mb4');
        } catch(Exception $e){
            # Registrar la exepción en el archivo log
            error_log("Error de conexión a la base de datos: " . $e->getMessage());
            return null;
        }

    }

    return $db_conn;

}

$db_connection = db_conn(); // $db_conn o null

if($db_connection === null){
    header('Location: ./views/errors/error500.html');
}


?>