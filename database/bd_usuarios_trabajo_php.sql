-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 03-08-2026 a las 17:16:20
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_usuarios_trabajo_php`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `idCita` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `fecha_cita` date NOT NULL,
  `motivo_cita` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`idCita`, `idUser`, `fecha_cita`, `motivo_cita`) VALUES
(16, 11, '2026-07-31', 'mañana'),
(17, 11, '2026-07-31', 'mañana2'),
(18, 11, '2026-08-08', 'efgefe'),
(20, 15, '2026-08-04', 'toma');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `idNoticia` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `imagen` text NOT NULL,
  `texto` longtext NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`idNoticia`, `titulo`, `imagen`, `texto`, `fecha`, `idUser`) VALUES
(1, 'hola hola', '1782896323_una lechuga estiliza.png', 'prueba prueba', '2026-07-01 00:00:00', 2),
(2, 'seguimos probando dia treinta ', '', 'Prueba de noticia sin foto', '2026-07-01 00:00:00', 2),
(8, '33333333333333', '1782903987_furgoneta-imagenes-10.jpg', '3333333333333333333333', '2026-07-01 13:06:27', 2),
(9, 'isgouirsahgourhgoruhguor', '', 'uehuiewhufwehufwhufwhufwef', '2026-07-01 13:07:49', 2),
(13, 'efffffffffffffffff', '', 'eeeeeeeeeeeeeeeeeeeeeeee', '2026-07-01 13:26:22', 2),
(14, 'ooTIHU4PUhtuhgojngojhrghqrñ', '', 'uewhwruiopfghwerhtglwngkjdhsgosADHFGasngkjscfhgerafgareg', '2026-07-01 13:27:22', 2),
(16, 'Noticia seria', '1782905783_furgoneta-imagenes-3.jpg', 'El texto aleatorio (o \"texto de relleno\") se utiliza para maquetar diseños y maquetar documentos. Los ejemplos más comunes son el clásico Lorem ipsum y las funciones automáticas de Microsoft Word, como =rand().Los generadores de texto aleatorio son útiles para visualizar el diseño sin distraerse con el contenido. Existen varios formatos y plataformas para crearlos:Lorem Ipsum estándar: Genera texto clásico en latín para maquetación de diseño web. Puedes crearlo al instante en Lipsum.Generador ciego: Para ajustar longitudes exactas o tipos de letra, puedes utilizar herramientas como Blind Text Generator.En Microsoft Word: Escribe =rand() seguido de Enter para obtener un texto de ejemplo, o =lorem() para texto en latín.Generador de texto con IA: Si buscas texto con sentido para blogs o correos electrónicos, puedes utilizar herramientas como el generador de textos de QuillBot.Si necesitas un párrafo específico o una longitud de caracteres determinada, avísame y te generaré el texto a medida.', '2026-07-01 13:36:23', 2),
(17, 'hola hola admin', '1782983954_furgoneta-imagenes-10.jpg', 'gogogogogogo', '2026-07-02 11:19:14', 2),
(19, '30 del siete ', 'Captura de pantalla 2026-06-05 225847.png', 'nueva noticia ', '2026-07-30 00:00:00', 2),
(20, 'noticia con fecha y hora actual', 'Captura de pantalla 2026-06-05 224848.png', 'notica ', '2026-07-30 13:07:03', 2),
(21, 'Prueba de noticia con imagen', '1785410082_Captura de pantalla 2026-06-05 224848.png', 'hola', '2026-07-30 13:14:42', 2),
(22, 'foto jpg', '1785410347_icono_rojo.avif', 'jpg', '2026-07-30 13:19:07', 2),
(23, 'Otra noticia con imagen', '1785410842_Captura de pantalla 2026-06-05 224848.png', 'hola noticia con imagen ', '2026-07-30 13:27:22', 2),
(24, 'Prueba cuatro', '1785410992_Captura de pantalla 2026-06-05 224848.png', 'imagen ', '2026-07-30 13:29:52', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_data`
--

CREATE TABLE `users_data` (
  `idUser` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `telefono` text NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `direccion` text DEFAULT NULL,
  `sexo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users_data`
--

INSERT INTO `users_data` (`idUser`, `nombre`, `apellidos`, `email`, `telefono`, `fecha_nacimiento`, `direccion`, `sexo`) VALUES
(2, 'Oscar', 'Antori', 'ramosmartinezmarcelinoA@hotmail.com', '222222222', '2020-01-28', '111', 'H'),
(5, 'Mario', '', 'mario@gmail.com', '', '0000-00-00', '', ''),
(6, 'Maria', 'Pilar Rosario', 'holahola@gmail.com', '666666666', '1990-05-11', 'Rafael Altamira', 'mujer'),
(9, 'Pilar', 'Maria Rosario', 'tralala@gmail.com', '666666666', '1991-11-11', 'Rafael Altamira', 'mujer'),
(10, 'Maria', 'Pilas Pilas', 'lalalalalala@gmail.com', '666666666', '1991-11-11', 'Rafael Altamira', 'mujer'),
(11, 'Marcelino', 'Ramos Martinez', 'ramosmartinezo@gmail.com', '648662470', '0000-00-00', 'Rafael Altamira', 'H'),
(15, 'Antonio', 'Usuario', 'nada@gmail.com', '333333333', '1991-11-11', '111111', 'hombre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_login`
--

CREATE TABLE `users_login` (
  `idLogin` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users_login`
--

INSERT INTO `users_login` (`idLogin`, `idUser`, `usuario`, `password`, `rol`) VALUES
(1, 2, 'Nuevo_usuario', '$2y$10$HDu4k/bmOiiNUIM7c6dv.eMbQSQT2aLbMk2jyDLDwN1ozVTIrWp3K', 'admin'),
(4, 5, '', '$2y$10$OtHO0CvtQZc/DAj.oQempue7XLGazu3cJpNoFmKdvZAw4MwPpbB1S', 'user'),
(8, 11, 'Usuario_administrativo', '$2y$10$gQeF6irrnBCQC.2dDmXRgeBbVv.loJ9MCVs3sJ3IlXEjeL/dgC59G', 'admin'),
(12, 15, 'usuario_user', '$2y$10$QmfE6D66F5OnZ.Tvdb58gOd1X2Lggn67R7iyLtcO7QibaOfqix/wm', 'user');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`idCita`),
  ADD KEY `idUser` (`idUser`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`idNoticia`),
  ADD UNIQUE KEY `titulo` (`titulo`),
  ADD KEY `idUser` (`idUser`);

--
-- Indices de la tabla `users_data`
--
ALTER TABLE `users_data`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `users_login`
--
ALTER TABLE `users_login`
  ADD PRIMARY KEY (`idLogin`),
  ADD UNIQUE KEY `idUser` (`idUser`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `idCita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `idNoticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `users_data`
--
ALTER TABLE `users_data`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `users_login`
--
ALTER TABLE `users_login`
  MODIFY `idLogin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users_data` (`idUser`);

--
-- Filtros para la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `noticias_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users_data` (`idUser`);

--
-- Filtros para la tabla `users_login`
--
ALTER TABLE `users_login`
  ADD CONSTRAINT `users_login_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users_data` (`idUser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
