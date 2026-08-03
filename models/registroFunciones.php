<?php

require_once __DIR__ . "/../controllers/db_conection/db_conn.php";  // conexión mysqli

class RegistroModel{
// Comprobamos si el email ya existe en users_data
    public static function comprobarEmailExiste($email) {
        $conn = db_conn();

        try {
            $sql = "SELECT idUser FROM users_data WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $resultado = $stmt->get_result();

            return $resultado->num_rows > 0;

        } catch (Exception $e) {
            error_log("Error en comprobarEmailExiste(): " . $e->getMessage());
            return true; // por seguridad, tratamos como existente
        }
    }

    // Comprobamos si el usuario ya existe en users_login
    public static function comprobarUsuarioExiste($usuario) {
        $conn = db_conn();

        try {
            $sql = "SELECT idLogin FROM users_login WHERE usuario = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $usuario);
            $stmt->execute();
            $resultado = $stmt->get_result();

            return $resultado->num_rows > 0;

        } catch (Exception $e) {
            error_log("Error en comprobarUsuarioExiste(): " . $e->getMessage());
            return true;
        }
    }

    // Insertamos datos personales en users_data
    public static function registrarDatosUsuario($nombre, $apellidos, $email, $telefono, $fecha_nacimiento, $direccion, $sexo) {
        $conn = db_conn();

        try {
            $sql = "INSERT INTO users_data (nombre, apellidos, email, telefono, fecha_nacimiento, direccion, sexo)
                    VALUES (?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssss", $nombre, $apellidos, $email, $telefono, $fecha_nacimiento, $direccion, $sexo);
            $stmt->execute();

            return $conn->insert_id; // idUser

        } catch (Exception $e) {
            error_log("Error en registrarDatosUsuario(): " . $e->getMessage());
            return false;
        }
    }

    // Insertamos login en users_login
    public static function registrarLoginUsuario($idUser, $usuario, $password) {
        $conn = db_conn();

        try {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users_login (idUser, usuario, password, rol)
                    VALUES (?, ?, ?, 'user')";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iss", $idUser, $usuario, $passwordHash);
            $stmt->execute();

            return true;

        } catch (Exception $e) {
            error_log("Error en registrarLoginUsuario(): " . $e->getMessage());
            return false;
        }
    }

    // Función final que registra al usuario completo
    public static function registrarUsuarioCompleto($datos) {

        // Comprobar duplicados
        if (self::comprobarEmailExiste($datos["email"])) {
            return ["ok" => false, "mensaje" => "El email ya está registrado."];
        }

        if (self::comprobarUsuarioExiste($datos["usuario"])) {
            return ["ok" => false, "mensaje" => "El nombre de usuario ya existe."];
        }

        // Insertamos datos personales
        $idUser = self::registrarDatosUsuario(
            $datos["nombre"],
            $datos["apellidos"],
            $datos["email"],
            $datos["telefono"],
            $datos["fecha_nacimiento"],
            $datos["direccion"],
            $datos["sexo"]
        );

        if (!$idUser) {
            return ["ok" => false, "mensaje" => "Error al registrar los datos personales."];
        }

        // Insertamos login
        $loginOK = self::registrarLoginUsuario($idUser, $datos["usuario"], $datos["password"]);

        if (!$loginOK) {
            return ["ok" => false, "mensaje" => "Error al registrar los datos de inicio de sesión."];
        }

        return ["ok" => true, "mensaje" => "Registro completado correctamente."];
    }
}
?>
