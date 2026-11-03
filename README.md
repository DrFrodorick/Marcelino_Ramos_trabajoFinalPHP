# Servicios Digitales · Aplicación web con PHP y MySQL

Aplicación web para una empresa de servicios digitales con área privada de usuarios y panel de administración. Los visitantes pueden leer las noticias y registrarse; los usuarios gestionan su perfil y sus citas; y los administradores gestionan usuarios, citas y noticias.

Proyecto final del módulo de PHP del ciclo de **Técnico Superior en Desarrollo de Aplicaciones Web**.

<!-- Cuando el proyecto esté publicado, añade aquí el enlace a la demo y una captura:
**Demo:** https://tu-subdominio.infinityfreeapp.com
![Captura de la página de inicio](docs/captura-inicio.png)
-->

## Funcionalidades

**Visitantes**
- Página de inicio con carrusel y últimas noticias.
- Sección de noticias con vista de detalle.
- Registro con validación de datos (nombre, email, usuario y contraseña segura).

**Usuarios registrados**
- Inicio y cierre de sesión.
- Perfil: edición de datos personales y cambio de contraseña.
- Citas: solicitar, editar y cancelar citas.

**Administradores**
- Gestión de usuarios (crear, editar, eliminar y asignar rol).
- Gestión de todas las citas.
- Gestión de noticias con subida de imágenes.

## Tecnologías

- **Backend:** PHP 8 (sin frameworks), arquitectura MVC
- **Base de datos:** MySQL / MariaDB con la extensión mysqli
- **Frontend:** HTML5, CSS3 y JavaScript (menú responsive y carrusel)

## Seguridad

- Contraseñas cifradas con `password_hash()` y comprobadas con `password_verify()`.
- Consultas preparadas (`prepare` + `bind_param`) para evitar la inyección SQL.
- Salida escapada con `htmlspecialchars()` para evitar ataques XSS.
- Control de acceso por sesión y por rol (`admin` / `user`).
- Credenciales de la base de datos fuera del repositorio (`.env.php` en `.gitignore`) y protegidas con `.htaccess`.

## Estructura del proyecto

```
├── index.php              # Punto de entrada y enrutador (?page=...)
├── config/app.php         # Configuración general (BASE_URL automática)
├── controllers/           # Lógica de cada sección (usuario y admin)
│   └── db_conection/      # Conexión a la base de datos
├── models/                # Acceso a datos (consultas SQL)
├── views/                 # Plantillas HTML/PHP
├── services/              # Validaciones reutilizables
├── includes/              # Cabecera de navegación y pie
├── assets/                # CSS, JavaScript y favicon
├── uploads/               # Imágenes subidas desde el panel
└── database/              # Script SQL con la estructura y datos de ejemplo
```

## Instalación en local (XAMPP)

1. Clona el repositorio dentro de la carpeta `htdocs` de XAMPP:
   ```bash
   git clone https://github.com/DrFrodorick/Marcelino_Ramos_trabajoFinalPHP.git
   ```
2. Arranca **Apache** y **MySQL** desde el panel de XAMPP.
3. En phpMyAdmin (`http://localhost/phpmyadmin`) crea una base de datos e importa `database/bd_usuarios_trabajo_php.sql`.
4. Copia `controllers/db_conection/.env.example.php` como `.env.php` en la misma carpeta y rellena los datos de conexión.
5. Abre `http://localhost/Marcelino_Ramos_trabajoFinalPHP/`.

La aplicación detecta sola si está en una subcarpeta o en la raíz del servidor, así que funciona igual en local que en un hosting.

## Autor

**Marcelino Ramos Martínez** · Desarrollador Web Junior
[GitHub](https://github.com/DrFrodorick) · [LinkedIn](https://www.linkedin.com/in/marcelino-ramos-martinez-0b4178262/)
