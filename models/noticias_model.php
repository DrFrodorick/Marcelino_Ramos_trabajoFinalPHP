<?php

class NoticiasModel {

    private $db;
    // Guarda la conexión mysqli para ejecutar consultas SQL

    public function __construct($conexion) {
        $this->db = $conexion;
        // Recibe la conexión desde fuera y la almacena en la propiedad del modelo
    }

    public function obtenerNoticias() {
        // Creamos la consulta que obtiene todas las noticias junto con los datos del autor
        $sql = "SELECT n.idNoticia, n.titulo, n.imagen, n.texto, n.fecha,
                       u.nombre, u.apellidos
                FROM noticias n
                INNER JOIN users_data u ON n.idUser = u.idUser
                ORDER BY n.fecha DESC";

        $resultado = $this->db->query($sql);
        // Ejecutamos la consulta y devolvemos todas las noticias ordenadas por fecha

        return $resultado;
    }

    public function obtenerNoticiaPorId($id) {

        // Creamos la consulta que obtiene una noticia concreta por su ID
        $sql = "SELECT n.idNoticia, n.titulo, n.imagen, n.texto, n.fecha,
                       u.nombre, u.apellidos
                FROM noticias n
                INNER JOIN users_data u ON n.idUser = u.idUser
                WHERE n.idNoticia = ?";

        $stmt = $this->db->prepare($sql);
        // Prepara la consulta con parámetro

        $stmt->bind_param("i", $id);
        // Vinculamos el ID de la noticia

        $stmt->execute();
        // Ejecutamos la consulta

        $resultado = $stmt->get_result();
        // Obtiene el resultado

        return $resultado->fetch_assoc(); 
        // Devolvemos UNA noticia como array asociativo
    }
}

?>