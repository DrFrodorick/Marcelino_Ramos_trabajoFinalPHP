<?php

class PerfilModel {

    private $db;
    // Guarda la conexión mysqli para ejecutar consultas SQL

    public function __construct($conexion) {
        $this->db = $conexion;
        // Recibe la conexión desde fuera y la almacena en la propiedad del modelo
    }

    /* ============================================================
       OBTENER DATOS PERSONALES DEL USUARIO
    ============================================================ */
    public function obtenerDatosUsuario($idUser) {

        // Creamos la consulta para obtener todos los datos personales del usuario
        $sql = "SELECT * FROM users_data WHERE idUser = ?";
        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            return false; // Error al preparar la consulta
        }

        $stmt->bind_param("i", $idUser);   // Vincula el ID del usuario
        $stmt->execute();                  // Ejecutamos la consulta

        $resultado = $stmt->get_result();
        $datos = $resultado->fetch_assoc(); // Obtiene los datos como array asociativo

        // Si no existe el usuario, devuelve false
        return $datos ?: false;
    }

    /* ============================================================
       OBTENER NOMBRE DE USUARIO (LOGIN)
    ============================================================ */
    public function obtenerLoginUsuario($idUser) {

        // Consulta para obtener el nombre de usuario (login)
        $sql = "SELECT usuario FROM users_login WHERE idUser = ?";
        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            return false; // Error al preparar la consulta
        }

        $stmt->bind_param("i", $idUser);   // Vincula el ID del usuario
        $stmt->execute();                  // Ejecuta la consulta

        $resultado = $stmt->get_result();
        $login = $resultado->fetch_assoc(); // Obtiene el usuario como array asociativo

        return $login ?: false;
    }

    /* ============================================================
       ACTUALIZAR DATOS PERSONALES
    ============================================================ */
    public function actualizarDatosUsuario($idUser, $nombre, $apellidos, $email, $telefono, $fecha, $direccion, $sexo) {

        // Creamos la consulta para actualizar los datos personales del usuario
        $sql = "UPDATE users_data 
                SET nombre=?, apellidos=?, email=?, telefono=?, fecha_nacimiento=?, direccion=?, sexo=? 
                WHERE idUser=?";

        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            return false; // Error al preparar la consulta
        }

        // Vinculamos todos los valores que se van a actualizar
        $stmt->bind_param("sssssssi", 
            $nombre, $apellidos, $email, $telefono, $fecha, $direccion, $sexo, $idUser
        );

        return $stmt->execute(); // Ejecutamos la actualización
    }

    /* ============================================================
       CAMBIAR CONTRASEÑA
    ============================================================ */
    public function cambiarPassword($idUser, $passwordHash) {

        // Consultamos para actualizar la contraseña del usuario
        $sql = "UPDATE users_login SET password=? WHERE idUser=?";
        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            return false; // Error al preparar la consulta
        }

        // Vinculamos la nueva contraseña encriptada y el ID del usuario
        $stmt->bind_param("si", $passwordHash, $idUser);

        return $stmt->execute(); // Ejecutamos la actualización
    }
}

?>
