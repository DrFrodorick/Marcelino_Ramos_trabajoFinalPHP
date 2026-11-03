<?php
class PerfilController {

    private $model;
    // Guarda el modelo que gestiona las operaciones del perfil (datos personales y contraseña)

    public function __construct($perfilModel) {
        $this->model = $perfilModel;
        // Recibe el modelo desde fuera y lo almacena para usarlo en los métodos
    }

    public function perfil() {

        // Seguridad: si no hay sesión iniciada, se redirige al login
        if (!isset($_SESSION['idUser'])) {
            header("Location: " . BASE_URL . "/views/login.php");
            exit;
        }
        
        $idUser = $_SESSION['idUser'];
        // ID del usuario logueado

        $error = "";
        $mensaje = "";
        // Variables para mostrar mensajes de error o éxito en la vista

        /* ============================================================
           ACTUALIZAR DATOS PERSONALES
           (solo si el formulario NO es el de cambiar contraseña)
        ============================================================ */
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['update_password'])) {

            // Recoge los datos enviados desde el formulario
            $nombre     = trim($_POST['nombre']);
            $apellidos  = trim($_POST['apellidos']);
            $email      = trim($_POST['email']);
            $telefono   = trim($_POST['telefono']);
            $fecha      = $_POST['fecha_nacimiento'];
            $direccion  = trim($_POST['direccion']);
            $sexo       = trim($_POST['sexo']);

            // Llama al modelo para actualizar los datos del usuario
            // (se permite actualizar aunque haya campos vacíos)
            $ok = $this->model->actualizarDatosUsuario(
                $idUser, $nombre, $apellidos, $email, $telefono, $fecha, $direccion, $sexo
            );

            if ($ok) {
                $mensaje = "Datos actualizados correctamente.";
            } else {
                $error = "Error al actualizar los datos.";
            }
        }


        /* ============================================================
           CAMBIAR CONTRASEÑA
        ============================================================ */
        if (isset($_POST['update_password'])) {

            $password1 = $_POST['password1'];
            $password2 = $_POST['password2'];
            // Recoge las contraseñas enviadas desde el formulario

            if ($password1 === "" || $password2 === "") {
                $error = "Debes completar ambos campos de contraseña.";
                // Verifica que ambos campos estén completos
            }
            elseif ($password1 !== $password2) {
                $error = "Las contraseñas no coinciden.";
                // Verifica que las contraseñas sean iguales
            }
            else {
                // Encripta la nueva contraseña
                $hash = password_hash($password1, PASSWORD_DEFAULT);

                // Llama al modelo para actualizar la contraseña en la base de datos
                $ok = $this->model->cambiarPassword($idUser, $hash);

                if ($ok) {
                    $mensaje = "Contraseña actualizada correctamente.";
                } else {
                    $error = "Error al actualizar la contraseña.";
                }
            }
        }

        /* ============================================================
           OBTENER DATOS ACTUALIZADOS DEL USUARIO
        ============================================================ */
        $datos = $this->model->obtenerDatosUsuario($idUser);
        // Obtiene los datos personales del usuario

        $login = $this->model->obtenerLoginUsuario($idUser);
        // Obtiene los datos de login del usuario (usuario, rol, etc.)

        require_once __DIR__ . "/../../views/perfil.php";
        // Carga la vista del perfil con los datos actualizados
    }
}

?>
