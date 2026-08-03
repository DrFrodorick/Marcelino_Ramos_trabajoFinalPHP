<?php



class AdminUsuariosController {

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


    /* ============================================================
       LISTADO DE USUARIOS
    ============================================================ */
    public function index() {
        $usuarios = $this->model->getAllUsers();
        $mensaje = isset($_GET["msg"]) ? $_GET["msg"] : "";

        $vistaInterna = "index";   // ✔ ahora sí existe
        require __DIR__ . "/../../views/admin/usuarios-administracion.php";
    }


    /* ============================================================
       MOSTRAR FORMULARIO CREAR
    ============================================================ */
    public function crear() {
        $mensaje = isset($_GET["msg"]) ? $_GET["msg"] : "";

        $vistaInterna = "crear";
        require __DIR__ . "/../../views/admin/usuarios-administracion.php";
    }


    /* ============================================================
       PROCESAR CREACIÓN
    ============================================================ */
    public function crearPost() {

        $data = [
            "usuario" => trim($_POST["usuario"]),
            "nombre" => trim($_POST["nombre"]),
            "apellidos" => trim($_POST["apellidos"]),
            "email" => trim($_POST["email"]),
            "telefono" => trim($_POST["telefono"]),
            "fecha_nacimiento" => trim($_POST["fecha_nacimiento"]),
            "direccion" => trim($_POST["direccion"]),
            "sexo" => trim($_POST["sexo"]),
            "password" => trim($_POST["password"]),
            "rol" => $_POST["rol"]
        ];

        if ($data["nombre"] === "" || $data["email"] === "" || $data["password"] === "") {
            header("Location: index.php?page=usuarios-administracion&action=crear&msg=error_campos");
            exit;
        }

        $ok = $this->model->createUser($data);

        if ($ok) {
            header("Location: index.php?page=usuarios-administracion&msg=Usuario creado correctamente");
        } else {
            header("Location: index.php?page=usuarios-administracion&action=crear&msg=error_crear");
        }
    }


    /* ============================================================
       MOSTRAR FORMULARIO EDITAR
    ============================================================ */
    public function editar() {
        if (!isset($_GET["id"])) {
            header("Location: index.php?page=usuarios-administracion&msg=error_id");
            exit;
        }

        $id = intval($_GET["id"]);
        $usuario = $this->model->getUserById($id);

        if (!$usuario) {
            header("Location: index.php?page=usuarios-administracion&msg=no_existe");
            exit;
        }

        $vistaInterna = "editar";   // ✔ ahora sí existe
        require __DIR__ . "/../../views/admin/usuarios-administracion.php";
    }


    /* ============================================================
       PROCESAR EDICIÓN
    ============================================================ */
    public function editarPost() {

        $id = intval($_POST["idUser"]);

        $data = [
            "usuario" => trim($_POST["usuario"]),
            "nombre" => trim($_POST["nombre"]),
            "apellidos" => trim($_POST["apellidos"]),
            "email" => trim($_POST["email"]),
            "telefono" => trim($_POST["telefono"]),
            "fecha_nacimiento" => trim($_POST["fecha_nacimiento"]),
            "direccion" => trim($_POST["direccion"]),
            "sexo" => trim($_POST["sexo"]),
            "rol" => $_POST["rol"],
            "password" => trim($_POST["password"]) // opcional
        ];

        if ($data["nombre"] === "" || $data["email"] === "") {
            header("Location: usuarios-administracion.php?action=editar&id=$id&msg=error_campos");
            exit;
        }

        $ok = $this->model->updateUser($id, $data);

        if ($ok) {
            header("Location: index.php?page=usuarios-administracion&msg=Usuario actualizado correctamente");
        } else {
            header("Location: index.php?page=usuarios-administracion&action=editar&id=$id&msg=error_editar");
        }

    }

    /* ============================================================
       BORRAR USUARIO
    ============================================================ */
    public function borrar() {

        if (!isset($_GET["id"])) {
            header("Location: usuarios-administracion.php?msg=error_id");
            exit;
        }

        $id = intval($_GET["id"]);

        $ok = $this->model->deleteUser($id);

        if ($ok) {
            header("Location: index.php?page=usuarios-administracion&msg=Usuario eliminado correctamente");
        } else {
            header("Location: index.php?page=usuarios-administracion&msg=error_borrar");
        }
    }
}
