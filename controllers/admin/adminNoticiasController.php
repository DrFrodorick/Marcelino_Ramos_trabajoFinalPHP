<?php
class adminNoticiasController {

    private $model;
    private $motivoErrorImagen = "";

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
        $nombreImagen = $this->subirImagen($_FILES["imagen"] ?? null);

        if ($nombreImagen === null) {
            header("Location: index.php?page=noticias-administracion&msg=error_imagen&motivo=" . $this->motivoErrorImagen);
            exit;
        }

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

            $nuevaImagen = $this->subirImagen($_FILES["imagen"]);

            if ($nuevaImagen === null) {
                header("Location: index.php?page=noticias-administracion&msg=error_imagen&motivo=" . $this->motivoErrorImagen);
                exit;
            }
            $nombreImagen = $nuevaImagen;
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

    /* ============================================================
       SUBIDA SEGURA DE IMÁGENES
       - Solo acepta imágenes reales (se comprueba el contenido, no solo la extensión).
       - Tamaño máximo: 2 MB.
       - Genera un nombre aleatorio con la extensión correcta, así nunca
         se puede subir un archivo .php u otro ejecutable.
       Devuelve el nombre del archivo guardado, o null si no es válido.
    ============================================================ */
    private function subirImagen($archivo) {
        if (!$archivo || ($archivo["error"] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
            $codigo = $archivo["error"] ?? UPLOAD_ERR_NO_FILE;
            $this->motivoErrorImagen = in_array($codigo, [UPLOAD_ERR_INI_SIZE, UPLOAD_ERR_FORM_SIZE]) ? "tamano" : "subida_" . $codigo;
            return null;
        }

        if ($archivo["size"] > 2 * 1024 * 1024) {
            $this->motivoErrorImagen = "tamano";
            return null;
        }

        $tiposPermitidos = [
            "image/jpeg" => "jpg",
            "image/png"  => "png",
            "image/webp" => "webp",
            "image/gif"  => "gif",
        ];

        $info = @getimagesize($archivo["tmp_name"]);
        if ($info === false || !isset($tiposPermitidos[$info["mime"]])) {
            $this->motivoErrorImagen = "tipo";
            return null;
        }

        $nombre = time() . "_" . bin2hex(random_bytes(8)) . "." . $tiposPermitidos[$info["mime"]];
        $destino = __DIR__ . "/../../uploads/" . $nombre;

        if (!move_uploaded_file($archivo["tmp_name"], $destino)) {
            error_log("No se pudo mover la imagen subida a " . $destino);
            $this->motivoErrorImagen = "guardar";
            return null;
        }

        return $nombre;
    }
}
