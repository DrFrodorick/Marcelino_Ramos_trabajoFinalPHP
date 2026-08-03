<?php

class Validaciones {

    // Valida que el nombre tenga solo letras y espacios, entre 2 y 45 caracteres
    public static function validarNombre($nombre) {
        $regex = "/^[a-zA-ZÁÉÍÓÚáéíóúñÑ ]{2,45}$/";
        return preg_match($regex, trim($nombre));
    }

    // Valida que el nombre de usuario tenga entre 4 y 20 caracteres y solo use letras, números, guiones y guiones bajos
    public static function validarUsuario($usuario) {
        $regex = "/^[a-zA-Z0-9_-]{4,20}$/";
        return preg_match($regex, trim($usuario));
    }

    // Valida que el email tenga un formato correcto usando filter_var
    public static function validarEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    // Valida que la contraseña sea fuerte: 6-20 caracteres, una mayúscula, un número y un símbolo permitido
    public static function validarPasswordFuerte($password) {
        $regex = "/^(?=.*[A-Z])(?=.*\d)(?=.*[.,_\-])[A-Za-z\d.,_\-]{6,20}$/";
        return preg_match($regex, $password);
    }

    // Comprueba que ambas contraseñas coincidan
    public static function validarCoincidenciaPassword($pass1, $pass2) {
        return $pass1 === $pass2;
    }

    // Valida que el ID sea numérico
    public static function validarID($id) {
        return preg_match("/^[0-9]+$/", $id);
    }

    // Comprueba que un campo no esté vacío
    public static function validarCampoVacio($campo) {
        return trim($campo) !== "";
    }

    /* ============================================================
       VALIDACIÓN COMPLETA DEL REGISTRO
       ============================================================ */
    public static function validarRegistro($datos) {

        $errores = [];
        // Array donde se almacenarán todos los errores encontrados

        // Validación del nombre
        if (!self::validarNombre($datos["nombre"])) {
            $errores[] = "El nombre no es válido.";
        }

        // Validación de apellidos
        if (!self::validarNombre($datos["apellidos"])) {
            $errores[] = "Los apellidos no son válidos.";
        }

        // Validación del email
        if (!self::validarEmail($datos["email"])) {
            $errores[] = "El email no es válido.";
        }

        // Validación del nombre de usuario
        if (!self::validarUsuario($datos["usuario"])) {
            $errores[] = "El nombre de usuario debe tener entre 4 y 20 caracteres y solo puede contener letras, números, guiones y guiones bajos.";
        }

        // Validación de contraseña fuerte
        if (!self::validarPasswordFuerte($datos["password"])) {
            $errores[] = "La contraseña debe tener entre 6 y 20 caracteres, incluir una mayúscula, un número y un símbolo (.,_-).";
        }

        // Validación de coincidencia entre contraseñas
        if (!self::validarCoincidenciaPassword($datos["password"], $datos["password2"])) {
            $errores[] = "Las contraseñas no coinciden.";
        }

        // Validación de teléfono no vacío
        if (!self::validarCampoVacio($datos["telefono"])) {
            $errores[] = "El teléfono no puede estar vacío.";
        }

        // Validación de fecha de nacimiento no vacía
        if (!self::validarCampoVacio($datos["fecha_nacimiento"])) {
            $errores[] = "La fecha de nacimiento es obligatoria.";
        }

        // Devuelve todos los errores encontrados (si no hay, devuelve array vacío)
        return $errores;
    }
}

?>
