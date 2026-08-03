<?php

class CitasModel {

    private $conn;
    // Guarda la conexión mysqli para ejecutar consultas SQL

    public function __construct($conexion) {
        $this->conn = $conexion;
        // Recibe la conexión desde fuera y la almacena en la propiedad del modelo
    }

    public function obtenerCitasUsuario($idUser) {
        // Obtenemos todas las citas de un usuario ordenadas por fecha
        $stmt = $this->conn->prepare("SELECT * FROM citas WHERE idUser=? ORDER BY fecha_cita ASC");
        $stmt->bind_param("i", $idUser);   // Vincula el ID del usuario
        $stmt->execute();                  // Ejecutamos la consulta
        return $stmt->get_result();        // Devolvemos todas las citas del usuario
    }

    public function crearCita($idUser, $fecha_cita, $motivo) {
        // Inserta una nueva cita en la base de datos
        $stmt = $this->conn->prepare("INSERT INTO citas (idUser, fecha_cita, motivo_cita) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $idUser, $fecha_cita, $motivo);  // Vincula los valores
        return $stmt->execute();                                   // Ejecutamos la inserción
    }

    public function obtenerFechaCita($idCita, $idUser) {
        // Obtiene la fecha de una cita concreta (sirve para validar si puede editarse o borrarse)
        $stmt = $this->conn->prepare("SELECT fecha_cita FROM citas WHERE idCita=? AND idUser=?");
        $stmt->bind_param("ii", $idCita, $idUser);   // Vinculamos ID de cita y usuario
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();   // Devolvemos la fecha como array asociativo
    }

    public function borrarCita($idCita, $idUser) {
        // Elimina una cita si pertenece al usuario
        $stmt = $this->conn->prepare("DELETE FROM citas WHERE idCita=? AND idUser=?");
        $stmt->bind_param("ii", $idCita, $idUser);   // Vinculamos ID de cita y usuario
        return $stmt->execute();                     // Ejecutamos la eliminación
    }

    public function editarCita($idCita, $idUser, $fecha_cita, $motivo) {
        // Actualiza la fecha y el motivo de una cita concreta
        $stmt = $this->conn->prepare("UPDATE citas SET fecha_cita=?, motivo_cita=? WHERE idCita=? AND idUser=?");
        $stmt->bind_param("ssii", $fecha_cita, $motivo, $idCita, $idUser);  // Vinculamos los nuevos valores
        return $stmt->execute();                                           // Ejecutamos la actualización
    }
}

?>