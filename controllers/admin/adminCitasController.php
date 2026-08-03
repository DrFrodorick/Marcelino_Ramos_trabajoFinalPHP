<?php

class AdminCitasController {

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
        $usuarioSeleccionado = isset($_GET["usuario"]) ? intval($_GET["usuario"]) : null;

        $usuarios = $this->model->getAllUsers();
        $citas = $usuarioSeleccionado ? $this->model->getCitasByUser($usuarioSeleccionado) : [];

        $vistaInterna = "index";
        require __DIR__ . "/../../views/admin/citas-administracion.php";
    }

    public function crear() {

        if (!isset($_GET["usuario"])) {
            header("Location: index.php?page=citas-administracion&msg=error_usuario");
            exit;
        }

        $usuarioSeleccionado = intval($_GET["usuario"]);
        $usuarios = $this->model->getAllUsers();

        $vistaInterna = "crear";
        require __DIR__ . "/../../views/admin/citas-administracion.php";
    }


    public function crearPost() {

        $data = [
            "idUser" => intval($_POST["idUser"]),
            "fecha_cita" => trim($_POST["fecha_cita"]),
            "motivo_cita" => trim($_POST["motivo_cita"])
        ];

        // Validación de fecha usando DateTime
        $fechaSeleccionada = new DateTime($data["fecha_cita"]);
        $hoy = new DateTime("today");
        
        // Bloquear fechas futuras
        if ($fechaSeleccionada < $hoy) {
            header("Location: index.php?page=citas-administracion&action=crear&usuario={$data['idUser']}&msg=fecha_pasada");
            exit;
        }

        // Bloquear fecha de hoy
        if ($fechaSeleccionada == $hoy) {
            header("Location: index.php?page=citas-administracion&action=crear&usuario={$data['idUser']}&msg=hoy_no_permitido");
            exit;
        }

        // Validación de campos vacíos
        if ($data["fecha_cita"] === "" || $data["motivo_cita"] === "") {
            header("Location: index.php?page=citas-administracion&action=crear&usuario={$data['idUser']}&msg=error_campos");
            exit;
        }

        $ok = $this->model->createCita($data);

        if ($ok) {
            header("Location: index.php?page=citas-administracion&usuario={$data['idUser']}&msg=creado_ok");
        } else {
            header("Location: index.php?page=citas-administracion&action=crear&usuario={$data['idUser']}&msg=error_crear");
        }
    }


    public function editar() {
        if (!isset($_GET["id"])) {
            header("Location: index.php?page=citas-administracion&msg=error_id");
            exit;
        }

        $idCita = intval($_GET["id"]);
        $cita = $this->model->getCitaById($idCita);

        if (!$cita) {
            header("Location: index.php?page=citas-administracion&msg=no_existe");
            exit;
        }

        $usuarios = $this->model->getAllUsers();

        $vistaInterna = "editar";
        require __DIR__ . "/../../views/admin/citas-administracion.php";
    }

    public function editarPost() {
        $idCita = intval($_POST["idCita"]);

        $data = [
            "fecha_cita" => trim($_POST["fecha_cita"]),
            "motivo_cita" => trim($_POST["motivo_cita"])
        ];

        if ($data["fecha_cita"] === "" || $data["motivo_cita"] === "") {
            header("Location: index.php?page=citas-administracion&action=editar&id=$idCita&msg=error_campos");
            exit;
        }

        $ok = $this->model->updateCita($idCita, $data);

        if ($ok) {
            header("Location: index.php?page=citas-administracion&usuario={$_POST['idUser']}&msg=editado_ok");
        } else {
            header("Location: index.php?page=citas-administracion&action=editar&id=$idCita&msg=error_editar");
        }
    }

    public function borrar() {
        if (!isset($_GET["id"]) || !isset($_GET["usuario"])) {
            header("Location: index.php?page=citas-administracion&msg=error_id");
            exit;
        }

        $idCita = intval($_GET["id"]);
        $usuario = intval($_GET["usuario"]); // recuperar el usuario

        $ok = $this->model->deleteCita($idCita);

        if ($ok) {
            header("Location: index.php?page=citas-administracion&usuario=$usuario&msg=borrado_ok");
        } else {
            header("Location: index.php?page=citas-administracion&usuario=$usuario&msg=error_borrar");
        }

        exit;
    }

}
