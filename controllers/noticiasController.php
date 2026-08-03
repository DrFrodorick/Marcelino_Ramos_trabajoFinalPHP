<?php
class NoticiasController {

    private $model;
    // Guarda el modelo que gestiona las operaciones relacionadas con noticias

    public function __construct($noticiasModel) {
        $this->model = $noticiasModel;
        // Recibe el modelo desde fuera y lo almacena para usarlo en los métodos
    }

    public function mostrarNoticias() {

        // Si existe un parámetro GET "id", significa que se quiere ver una noticia concreta
        if (isset($_GET['id'])) {

            // Obtiene una sola noticia según el ID recibido
            $noticia = $this->model->obtenerNoticiaPorId($_GET['id']);

            // La vista espera esta variable aunque no se usen varias noticias
            $listaNoticias = [];

        } else {

            // Si no hay ID → se muestran todas las noticias
            $listaNoticias = $this->model->obtenerNoticias();

            // La vista espera esta variable aunque no haya noticia individual
            $noticia = null;
        }

        // Carga la vista de noticias y le pasa las variables preparadas
        include __DIR__ . '/../views/noticias.php';
    }
}

?>
