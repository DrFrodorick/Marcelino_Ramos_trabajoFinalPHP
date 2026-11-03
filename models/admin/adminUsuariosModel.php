<?php
require_once __DIR__ . "/../../controllers/db_conection/db_conn.php";
// Importa la conexión a la base de datos para poder usar $conn

class AdminUsuariosModel {

    /* ============================================================
       OBTENER TODOS LOS USUARIOS
    ============================================================ */
    public function getAllUsers() {
        global $conn;
        // Usa la conexión global $conn (mysqli)

        $sql = "SELECT d.idUser, d.nombre, d.email, l.rol
                FROM users_data d
                INNER JOIN users_login l ON d.idUser = l.idUser
                ORDER BY d.idUser ASC";
        // Obtiene todos los usuarios con sus datos personales y rol

        return $conn->query($sql);
        // Ejecuta la consulta y devuelve el resultado
    }

    /* ============================================================
       OBTENER USUARIO POR ID
    ============================================================ */
    public function getUserById($id) {
        global $conn;

        $sql = "SELECT d.*, l.usuario, l.rol
                FROM users_data d
                INNER JOIN users_login l ON d.idUser = l.idUser
                WHERE d.idUser = ?";
        // Obtiene todos los datos personales + login del usuario

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        // Vincula el ID del usuario

        $stmt->execute();
        // Ejecuta la consulta

        return $stmt->get_result()->fetch_assoc();
        // Devuelve el usuario como array asociativo
    }

    /* ============================================================
       CREAR USUARIO
    ============================================================ */
    public function createUser($data) {
        global $conn;

        // Insertar datos personales en users_data
        $sql1 = "INSERT INTO users_data (nombre, apellidos, email, telefono, fecha_nacimiento, direccion, sexo)
                 VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param(
            "sssssss",
            $data["nombre"],
            $data["apellidos"],
            $data["email"],
            $data["telefono"],
            $data["fecha_nacimiento"],
            $data["direccion"],
            $data["sexo"]
        );
        $stmt1->execute();
        // Inserta los datos personales

        $nuevoID = $stmt1->insert_id;
        // Obtiene el ID del nuevo usuario recién creado

        // Insertar datos de login en users_login
        $passwordHash = password_hash($data["password"], PASSWORD_DEFAULT);
        // Encripta la contraseña

        $sql2 = "INSERT INTO users_login (idUser, usuario, password, rol)
                 VALUES (?, ?, ?, ?)";

        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("isss", $nuevoID, $data["usuario"], $passwordHash, $data["rol"]);
        // Inserta usuario, contraseña y rol

        return $stmt2->execute();
        // Devuelve true/false según si la operación fue correcta
    }

    /* ============================================================
       EDITAR USUARIO
    ============================================================ */
    public function updateUser($id, $data) {
        global $conn;

        // Actualizar datos personales
        $sql1 = "UPDATE users_data 
                 SET nombre=?, apellidos=?, email=?, telefono=?, fecha_nacimiento=?, direccion=?, sexo=?
                 WHERE idUser=?";

        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param(
            "sssssssi",
            $data["nombre"],
            $data["apellidos"],
            $data["email"],
            $data["telefono"],
            $data["fecha_nacimiento"],
            $data["direccion"],
            $data["sexo"],
            $id
        );
        $stmt1->execute();
        // Actualiza los datos personales del usuario

        // Actualizar login (con o sin contraseña)
        if (!empty($data["password"])) {
            // Si se envió una nueva contraseña, se actualiza también
            $passwordHash = password_hash($data["password"], PASSWORD_DEFAULT);

            $sql2 = "UPDATE users_login SET usuario=?, password=?, rol=? WHERE idUser=?";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->bind_param("sssi", $data["usuario"], $passwordHash, $data["rol"], $id);

        } else {
            // Si no se envió contraseña, solo se actualiza usuario y rol
            $sql2 = "UPDATE users_login SET usuario=?, rol=? WHERE idUser=?";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->bind_param("ssi", $data["usuario"], $data["rol"], $id);
        }

        return $stmt2->execute();
        // Ejecuta la actualización y devuelve true/false
    }

    /* ============================================================
       BORRAR USUARIO
    ============================================================ */
    public function deleteUser($id) {
        global $conn;

        $id = (int) $id;

        // Primero se borra el login del usuario (consulta preparada)
        $stmt = $conn->prepare("DELETE FROM users_login WHERE idUser = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        // Luego se borran los datos personales
        $stmt = $conn->prepare("DELETE FROM users_data WHERE idUser = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
        // Devuelve true/false según si la eliminación fue correcta
    }
}

?>