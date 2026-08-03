<?php

require_once __DIR__ . '/../db_conection/db_conn.php'; 

function noticiasIndex() {

    $conn = db_conn();   // Obtenemos la conexión mysqli usando la función db_conn()

    try {
        $stmt = $conn->prepare("
            SELECT n.idNoticia, n.titulo, n.imagen, n.texto, n.fecha, u.nombre 
            FROM noticias n 
            INNER JOIN users_data u ON n.idUser = u.idUser
            ORDER BY n.fecha DESC
            LIMIT 4
        ");
        // Preparamos una consulta SQL que obtiene las 4 noticias más recientes
        // junto con el nombre del usuario que las creó

        if ($stmt === false) {
            error_log("No se pudo preparar la consulta: " . $conn->error);
            return false;
            // Si falla la preparación, registra el error y devuelve false
        }

        if (!$stmt->execute()) {
            error_log("No se pudo ejecutar la consulta: " . $stmt->error);
            return false;
            // Si falla la ejecución, registra el error y devuelve false
        }

        $resultado = $stmt->get_result();
        // Obtiene el resultado de la consulta

        return $resultado->fetch_all(MYSQLI_ASSOC);
        // Devuelve todas las filas como array asociativo

    } catch (Exception $e) {
        error_log("Error al ejecutar la consulta: " . $e->getMessage());
        return false;
        // Captura cualquier excepción y devuelve false

    } finally {
        if (isset($stmt)) {
            $stmt->close();
            // Cierra el statement para liberar recursos
        }
    }
}


function loginUsuario($usuario, $password) {

    $conn = db_conn();   
    // Obtiene la conexión mysqli igual que en la funcion de arriba

    try {

        // Consulta para obtener los datos del usuario por su nombre
        $sql = "SELECT idLogin, idUser, usuario, password, rol 
                FROM users_login 
                WHERE usuario = ?";

        $stmt = $conn->prepare($sql);
        // Prepara la consulta con parámetro

        if ($stmt === false) {
            error_log("Error al preparar la consulta: " . $conn->error);
            return ["ok" => false, "mensaje" => "Error interno del servidor."];
            // Si falla la preparación, devuelve error controlado
        }

        $stmt->bind_param("s", $usuario);
        // Vincula el parámetro (usuario) a la consulta

        if (!$stmt->execute()) {
            error_log("Error al ejecutar la consulta: " . $stmt->error);
            return ["ok" => false, "mensaje" => "Error interno del servidor."];
            // Si falla la ejecución, devuelve error controlado
        }

        $resultado = $stmt->get_result();
        // Obtiene el resultado de la consulta

        if ($resultado->num_rows === 0) {
            return ["ok" => false, "mensaje" => "Usuario o contraseña incorrectos."];
            // Si no existe el usuario, devuelve error
        }

        $loginData = $resultado->fetch_assoc();
        // Obtiene los datos del usuario encontrado

        if (!password_verify($password, $loginData["password"])) {
            return ["ok" => false, "mensaje" => "Usuario o contraseña incorrectos."];
            // Verifica la contraseña encriptada
        }

        // Si todo es correcto, devuelve los datos del usuario
        return [
            "ok" => true,
            "idLogin" => $loginData["idLogin"],
            "idUser" => $loginData["idUser"],
            "usuario" => $loginData["usuario"],
            "rol" => $loginData["rol"]
        ];

    } catch (Exception $e) {

        error_log("Error en loginUsuario(): " . $e->getMessage());
        return ["ok" => false, "mensaje" => "Error interno del servidor."];
        // Captura cualquier excepción y devuelve error controlado

    } finally {

        if (isset($stmt)) {
            $stmt->close();
            // Cierra el statement para liberar recursos
        }
    }
}


?>

