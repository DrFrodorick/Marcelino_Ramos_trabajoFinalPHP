<?php
require_once __DIR__ . '/../models/registroFunciones.php';
require_once __DIR__ . '/../services/Validations.php';
// Importa el modelo de registro y la clase de validaciones

class RegistroController {

    public function procesarRegistro() {

        // Solo procesa el registro si la petición es POST
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            return null;
        }

        // Recoger y limpiar los datos enviados desde el formulario
        $datos = [
            "nombre"           => trim($_POST["nombre"]),
            "apellidos"        => trim($_POST["apellidos"]),
            "email"            => trim($_POST["email"]),
            "telefono"         => trim($_POST["telefono"]),
            "fecha_nacimiento" => trim($_POST["fecha_nacimiento"]),
            "direccion"        => trim($_POST["direccion"]),
            "sexo"             => trim($_POST["sexo"]),
            "usuario"          => trim($_POST["usuario"]),
            "password"         => trim($_POST["password"]),
            "password2"        => trim($_POST["password2"])
        ];

        // Validar todos los campos del formulario
        // La clase Validaciones devuelve un array con errores si los hay
        $errores = Validaciones::validarRegistro($datos);

        if (!empty($errores)) {
            // Si hay errores, se devuelven como texto para mostrarlos en la vista
            return implode("<br>", $errores);
        }

        // Si las validaciones pasan, se registra el usuario en el modelo
        $resultado = RegistroModel::registrarUsuarioCompleto($datos);

        if (!$resultado["ok"]) {
            // Si el modelo devuelve error, se muestra el mensaje correspondiente
            return $resultado["mensaje"];
        }

        // Si todo va bien, redirige al login con indicador de registro correcto
        header("Location: login.php?registro=ok");
        exit;
    }
}

?>