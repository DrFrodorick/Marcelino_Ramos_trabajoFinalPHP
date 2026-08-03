<?php
class adminNoticiasController {

    private $model;

    public function __construct($model) {
        $this->model = $model;

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION["idUser"]) || $_SESSION["rol"] !== "admin") {
            header("Location: index.php");
            exit;
        }
    }

    public function index() {
        $noticias = $this->model->getNoticias();
        $vistaInterna = "index.php";
        require_once __DIR__ . "/../../views/admin/noticias-administracion.php";
    }

    public function crear() {
        $vistaInterna = "crear.php";
        require_once __DIR__ . "/../../views/admin/noticias-administracion.php";
    }

    public function crearPost() {

        // ============================
        // SUBIR IMAGEN
        // ============================
        $imagen = $_FILES["imagen"];
        $nombreImagen = time() . "_" . basename($imagen["name"]);
        $rutaDestino = __DIR__ . "/../../uploads/" . $nombreImagen;

        move_uploaded_file($imagen["tmp_name"], $rutaDestino);

        // ============================
        // GUARDAR EN BD
        // ============================
        $data = [
            "titulo" => $_POST["titulo"],
            "texto" => $_POST["texto"],
            "fecha" => date("Y-m-d H:i:s"),
            "imagen" => $nombreImagen,
            "idUser" => $_SESSION["idUser"]
        ];

        $ok = $this->model->crearNoticia($data);

        if ($ok) {
            header("Location: index.php?page=noticias-administracion&msg=creado_ok");
        } else {
            header("Location: index.php?page=noticias-administracion&msg=error_crear");
        }
        exit;
    }

    public function editar() {
        $id = intval($_GET["id"]);
        $noticia = $this->model->getNoticia($id);

        $vistaInterna = "editar.php";
        require_once __DIR__ . "/../../views/admin/noticias-administracion.php";
    }

    public function editarPost() {

        $idNoticia = intval($_POST["idNoticia"]);
        $titulo = $_POST["titulo"];
        $texto = $_POST["texto"];

        // Obtener noticia actual para saber la imagen existente
        $noticiaActual = $this->model->getNoticia($idNoticia);
        $nombreImagen = $noticiaActual["imagen"]; // por defecto

        // ============================
        // SI SUBE NUEVA IMAGEN
        // ============================
        if (!empty($_FILES["imagen"]["name"])) {

            $imagen = $_FILES["imagen"];
            $nombreImagen = time() . "_" . basename($imagen["name"]);
            $rutaDestino = __DIR__ . "/../../uploads/" . $nombreImagen;

            move_uploaded_file($imagen["tmp_name"], $rutaDestino);
        }

        // ============================
        // GUARDAR CAMBIOS
        // ============================
        $data = [
            "idNoticia" => $idNoticia,
            "titulo" => $titulo,
            "texto" => $texto,
            "imagen" => $nombreImagen
        ];

        $ok = $this->model->editarNoticia($data);

        if ($ok) {
            header("Location: index.php?page=noticias-administracion&msg=editado_ok");
        } else {
            header("Location: index.php?page=noticias-administracion&msg=error_editar");
        }
        exit;
    }

    public function borrar() {
        $id = intval($_GET["id"]);

        $ok = $this->model->borrarNoticia($id);

        if ($ok) {
            header("Location: index.php?page=noticias-administracion&msg=borrado_ok");
        } else {
            header("Location: index.php?page=noticias-administracion&msg=error_borrar");
        }
        exit;
    }
}
