<?php
class AdminCitasModel {

    private $conn;
    // Guarda la conexión mysqli para ejecutar consultas

    public function __construct($conn) {
        $this->conn = $conn;
        // Recibe la conexión desde fuera y la almacena
    }

    public function getAllUsers() {
        $sql = "SELECT d.idUser, d.nombre
                FROM users_data d
                INNER JOIN users_login l ON d.idUser = l.idUser
                ORDER BY d.nombre ASC";

        // Devuelve todos los usuarios registrados ordenados por nombre
        return $this->conn->query($sql);
    }

    public function getCitasByUser($idUser) {
        $sql = "SELECT idCita, fecha_cita, motivo_cita
                FROM citas
                WHERE idUser = ?
                ORDER BY fecha_cita ASC";

        $stmt = $this->conn->prepare($sql);
        // Prepara consulta para obtener todas las citas de un usuario

        $stmt->bind_param("i", $idUser);
        // Vincula el parámetro (ID del usuario)

        $stmt->execute();
        // Ejecuta la consulta

        return $stmt->get_result();
        // Devuelve todas las citas del usuario
    }

    public function getCitaById($idCita) {
        $sql = "SELECT * FROM citas WHERE idCita = ?";
        $stmt = $this->conn->prepare($sql);
        // Prepara consulta para obtener una cita concreta

        $stmt->bind_param("i", $idCita);
        // Vincula el ID de la cita

        $stmt->execute();
        // Ejecuta la consulta

        return $stmt->get_result()->fetch_assoc();
        // Devuelve la cita como array asociativo
    }

    public function createCita($data) {
        $sql = "INSERT INTO citas (idUser, fecha_cita, motivo_cita)
                VALUES (?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        // Prepara consulta para crear una nueva cita

        $stmt->bind_param("iss", $data["idUser"], $data["fecha_cita"], $data["motivo_cita"]);
        // Vincula los valores necesarios para la inserción

        return $stmt->execute();
        // Ejecuta la inserción y devuelve true/false
    }

    public function updateCita($idCita, $data) {
        $sql = "UPDATE citas SET fecha_cita=?, motivo_cita=? WHERE idCita=?";
        $stmt = $this->conn->prepare($sql);
        // Prepara consulta para actualizar una cita existente

        $stmt->bind_param("ssi", $data["fecha_cita"], $data["motivo_cita"], $idCita);
        // Vincula los nuevos valores y el ID de la cita

        return $stmt->execute();
        // Ejecuta la actualización y devuelve true/false
    }

    public function deleteCita($idCita) {
        $sql = "DELETE FROM citas WHERE idCita = ?";
        $stmt = $this->conn->prepare($sql);
        // Prepara consulta para eliminar una cita

        $stmt->bind_param("i", $idCita);
        // Vincula el ID de la cita

        return $stmt->execute();
        // Ejecuta la eliminación y devuelve true/false
    }
}

?>