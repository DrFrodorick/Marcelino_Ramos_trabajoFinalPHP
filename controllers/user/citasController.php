<?php

class CitasController {

    private $model;
    // Guarda el modelo que maneja las operaciones de citas (crear, borrar, editar, obtener)

    public function __construct($model) {
        $this->model = $model;
        // Recibe el modelo desde fuera y lo almacena para usarlo en los métodos
    }

    public function citas() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // Inicia la sesión si aún no está iniciada

        if (!isset($_SESSION["idUser"]) || $_SESSION["rol"] !== "user") {
            header("Location: " . BASE_URL . "/views/login.php");
            exit();
        }
        // Si el usuario no está logueado o no es del rol "user", se le redirige al login

        $idUser = $_SESSION["idUser"];
        // ID del usuario logueado

        $mensaje = "";
        // Variable para mostrar mensajes de error o éxito

        /* ============================
           CREAR CITA
        ============================ */
        if (isset($_POST["crear_cita"])) {

            $fecha_cita = trim($_POST["fecha_cita"]);
            $motivo = trim($_POST["motivo"]);
            // Recoge los datos enviados desde el formulario

            if ($fecha_cita === "" || !strtotime($fecha_cita)) {
                $mensaje = "La fecha de la cita no es válida.";
                // Valida que la fecha exista y tenga formato correcto

            } else {
                $fecha = new DateTime($fecha_cita);
                $hoy = new DateTime();
                // Convierte la fecha a objeto DateTime para compararla

                if ($fecha < $hoy) {
                    $mensaje = "No puedes crear citas en fechas pasadas.";
                    // Evita crear citas en días anteriores al actual

                } else {
                    $this->model->crearCita($idUser, $fecha_cita, $motivo);
                    // Llama al modelo para crear la cita en la base de datos

                    $mensaje = "Cita creada correctamente.";
                }
            }
        }

        /* ============================
           BORRAR CITA
        ============================ */
        if (isset($_POST["borrar_cita"])) {

            $idCita = intval($_POST["idCita"]);
            // ID de la cita a borrar

            $resultado = $this->model->obtenerFechaCita($idCita, $idUser);
            // Obtiene la fecha de la cita para verificar si puede borrarse

            if ($resultado) {
                $fecha = new DateTime($resultado["fecha_cita"]);
                $hoy = new DateTime();

                if ($fecha < $hoy) {
                    $mensaje = "No puedes borrar citas ya realizadas.";
                    // Impide borrar citas que ya han pasado

                } else {
                    $this->model->borrarCita($idCita, $idUser);
                    // Elimina la cita de la base de datos

                    $mensaje = "Cita eliminada correctamente.";
                }
            }
        }

        /* ============================
           EDITAR CITA
        ============================ */
        if (isset($_POST["editar_cita"])) {

            $idCita = intval($_POST["idCita"]);
            $fecha_cita = trim($_POST["fecha_cita"]);
            $motivo = trim($_POST["motivo"]);
            // Recoge los datos enviados desde el formulario

            $resultado = $this->model->obtenerFechaCita($idCita, $idUser);
            // Obtiene la fecha original de la cita

            if ($resultado) {
                $fechaOriginal = new DateTime($resultado["fecha_cita"]);
                $hoy = new DateTime();

                if ($fechaOriginal < $hoy) {
                    $mensaje = "No puedes modificar citas ya realizadas.";
                    // Impide editar citas que ya han pasado

                } else {

                    if ($fecha_cita === "" || !strtotime($fecha_cita)) {
                        $mensaje = "La nueva fecha no es válida.";
                        // Valida la nueva fecha

                    } else {
                        $fechaNueva = new DateTime($fecha_cita);

                        if ($fechaNueva < $hoy) {
                            $mensaje = "La nueva fecha debe ser futura.";
                            // Evita poner una fecha anterior al día actual

                        } else {
                            $this->model->editarCita($idCita, $idUser, $fecha_cita, $motivo);
                            // Actualiza la cita en la base de datos

                            $mensaje = "Cita modificada correctamente.";
                        }
                    }
                }
            }
        }

        /* ============================
           OBTENER CITAS DEL USUARIO
        ============================ */
        $citas = $this->model->obtenerCitasUsuario($idUser);
        // Obtiene todas las citas del usuario logueado

        require_once __DIR__ . "/../../views/citas.php";
        // Carga la vista que muestra las citas
    }
}
?>