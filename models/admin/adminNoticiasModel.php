<?php
class adminNoticiasModel {

    private $conn;
    // Guarda la conexión mysqli para ejecutar consultas SQL

    public function __construct($conn) {
        $this->conn = $conn;
        // Recibe la conexión desde fuera y la almacena en la propiedad del modelo
    }

    public function getNoticias() {
        $sql = "SELECT * FROM noticias ORDER BY fecha DESC";
        // Obtiene todas las noticias ordenadas por fecha (más recientes primero)

        return $this->conn->query($sql);
        // Ejecuta la consulta directamente y devuelve el resultado
    }

    public function getNoticia($id) {
        $sql = "SELECT * FROM noticias WHERE idNoticia = ?";
        $stmt = $this->conn->prepare($sql);
        // Prepara consulta para obtener una noticia concreta por su ID

        $stmt->bind_param("i", $id);
        // Vincula el parámetro (ID de la noticia)

        $stmt->execute();
        // Ejecuta la consulta

        return $stmt->get_result()->fetch_assoc();
        // Devuelve la noticia como array asociativo
    }

    public function crearNoticia($data) {

        $sql = "INSERT INTO noticias (titulo, texto, fecha, imagen, idUser)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        // Prepara consulta para insertar una nueva noticia

        $stmt->bind_param("ssssi",
            $data["titulo"],
            $data["texto"],
            $data["fecha"],
            $data["imagen"],   // Nombre final del archivo de imagen
            $data["idUser"]
        );
        // Vincula los valores enviados desde el formulario

        return $stmt->execute();
        // Ejecuta la inserción y devuelve true/false
    }

    public function editarNoticia($data) {

        $sql = "UPDATE noticias SET titulo=?, texto=?, imagen=? WHERE idNoticia=?";

        $stmt = $this->conn->prepare($sql);
        // Prepara consulta para actualizar una noticia existente

        $stmt->bind_param("sssi",
            $data["titulo"],
            $data["texto"],
            $data["imagen"],   // Nombre final del archivo de imagen
            $data["idNoticia"]
        );
        // Vincula los nuevos valores y el ID de la noticia

        return $stmt->execute();
        // Ejecuta la actualización y devuelve true/false
    }

    public function borrarNoticia($id) {
        $sql = "DELETE FROM noticias WHERE idNoticia=?";
        $stmt = $this->conn->prepare($sql);
        // Prepara consulta para eliminar una noticia por su ID

        $stmt->bind_param("i", $id);
        // Vincula el ID de la noticia

        return $stmt->execute();
        // Ejecuta la eliminación y devuelve true/false
    }
}

?>
