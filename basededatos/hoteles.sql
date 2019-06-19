-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-06-2019 a las 00:38:35
-- Versión del servidor: 10.1.40-MariaDB
-- Versión de PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hoteles`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones`
--

CREATE TABLE `habitaciones` (
  `id_habitacion` int(11) NOT NULL,
  `descripcion` varchar(50) COLLATE utf16_bin DEFAULT NULL,
  `precio` double NOT NULL,
  `img_path` varchar(150) COLLATE utf16_bin DEFAULT NULL,
  `num_habitacion` int(11) DEFAULT NULL,
  `hoteles_id_hotel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Volcado de datos para la tabla `habitaciones`
--

INSERT INTO `habitaciones` (`id_habitacion`, `descripcion`, `precio`, `img_path`, `num_habitacion`, `hoteles_id_hotel`) VALUES
(1, 'Habitacion Presidencial Doble', 200, 'images/hab_1.jpg', 101, 1),
(7, 'Habitacion Simple Individual', 75, 'images/hab_2.jpg', 111, 1),
(8, 'Habitacion Familiar Doble', 110, 'images/hab_4.jpg', 121, 1),
(9, 'Habitacion Simple Doble', 90, 'images/hab_3.jpg', 113, 1),
(10, 'Habitacion de Lujo Doble', 215, 'images/img_6.jpg', 104, 1),
(11, 'Habitacion Familiar Especial Doble ', 100, 'images/img_5.jpg', 124, 1),
(12, 'Habitacion Individual Premium', 150, 'images/img_1.jpg', 127, 1),
(13, 'Habitacion Familiar Grande', 175, 'images/img_2.jpg', 119, 1),
(16, 'Habitacion individual Discreta', 60, 'images/img_3.jpg', 109, 1),
(17, 'Habitacion Familiar Simple', 100, 'images/img_4.jpg', 115, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hoteles`
--

CREATE TABLE `hoteles` (
  `id_hotel` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf16_bin DEFAULT NULL,
  `ubicacion` varchar(50) COLLATE utf16_bin DEFAULT NULL,
  `ciudad` varchar(50) COLLATE utf16_bin DEFAULT NULL,
  `estrellas` int(1) DEFAULT NULL,
  `path_img` varchar(150) COLLATE utf16_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Volcado de datos para la tabla `hoteles`
--

INSERT INTO `hoteles` (`id_hotel`, `nombre`, `ubicacion`, `ciudad`, `estrellas`, `path_img`) VALUES
(1, 'Hotel Sol y Mar', 'Calle Luis Ortega Bru, s/n', 'Sevilla', 4, 'C:\\xampp\\htdocs\\Proyecto\\HotelBootstrap\\images\\hotel_1.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id_reserva` int(11) NOT NULL,
  `fecha_reserva` date DEFAULT NULL,
  `usuario_correo` varchar(100) COLLATE utf16_bin DEFAULT NULL,
  `precio_final` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id_reserva`, `fecha_reserva`, `usuario_correo`, `precio_final`) VALUES
(1, '2019-06-13', 'juan@prueba.com', 200),
(2, '2019-02-02', 'parejo@parejo.com', 367),
(3, '2019-03-03', 'ester@ester.com', 455),
(4, '2019-04-04', 'migue@migue.com', 155),
(19, '2019-06-18', 'juan@prueba.com', 480),
(21, '2019-06-19', 'juan@prueba.com', 920);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas_habitacion`
--

CREATE TABLE `reservas_habitacion` (
  `id_reserva_habitacion` int(11) NOT NULL,
  `fecha_entrada` date DEFAULT NULL,
  `fecha_salida` date DEFAULT NULL,
  `ocupantes` int(11) DEFAULT NULL,
  `habitaciones_id_habitacion` int(11) DEFAULT NULL,
  `reservas_id_reserva` int(11) DEFAULT NULL,
  `tipo_pensiones_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Volcado de datos para la tabla `reservas_habitacion`
--

INSERT INTO `reservas_habitacion` (`id_reserva_habitacion`, `fecha_entrada`, `fecha_salida`, `ocupantes`, `habitaciones_id_habitacion`, `reservas_id_reserva`, `tipo_pensiones_id`) VALUES
(1, '2019-05-05', '2019-05-12', 2, 7, 2, 4),
(5, '2019-05-20', '2019-05-22', 1, 8, 3, 2),
(21, '2019-06-17', '2019-06-20', 1, 8, 19, 1),
(23, '2019-06-25', '2019-06-27', 2, 1, 21, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_pensiones`
--

CREATE TABLE `tipo_pensiones` (
  `id_tipo_pension` int(11) NOT NULL,
  `descripcion` varchar(50) COLLATE utf16_bin DEFAULT NULL,
  `precio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Volcado de datos para la tabla `tipo_pensiones`
--

INSERT INTO `tipo_pensiones` (`id_tipo_pension`, `descripcion`, `precio`) VALUES
(1, 'pension completa', 50),
(2, 'media pension', 30),
(3, 'desayuno', 15),
(4, 'nada', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `correo` varchar(100) COLLATE utf16_bin NOT NULL,
  `nombre` varchar(50) COLLATE utf16_bin DEFAULT NULL,
  `apellidos` varchar(50) COLLATE utf16_bin DEFAULT NULL,
  `passwd` varchar(20) COLLATE utf16_bin DEFAULT NULL,
  `tipo_usuario` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`correo`, `nombre`, `apellidos`, `passwd`, `tipo_usuario`) VALUES
('admin@admin.com', 'admin', 'admin', 'admin', 1),
('ester@ester.com', 'ester', 'ester', 'ester', 0),
('juan@prueba.com', 'juan', 'cervantes', 'deadpool', 0),
('migue@migue.com', 'migue', 'migue', 'migue', 0),
('parejo@parejo.com', 'parejo', 'parejo', 'parejo', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoraciones`
--

CREATE TABLE `valoraciones` (
  `id_valoracion` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `valoracion` int(1) DEFAULT NULL,
  `opinion` varchar(500) COLLATE utf16_bin NOT NULL,
  `usuario_correo` varchar(100) COLLATE utf16_bin DEFAULT NULL,
  `reservas_id_reserva` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin;

--
-- Volcado de datos para la tabla `valoraciones`
--

INSERT INTO `valoraciones` (`id_valoracion`, `fecha`, `valoracion`, `opinion`, `usuario_correo`, `reservas_id_reserva`) VALUES
(5, '2019-10-10', 5, 'Un gran servicio y unas vistas espectaculares', 'parejo@parejo.com', 2),
(7, '2018-12-10', 3, 'Mejorable pero muy agradable', 'ester@ester.com', 3),
(10, '2019-06-17', 2, 'No a estado tan mal', 'juan@prueba.com', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD PRIMARY KEY (`id_habitacion`),
  ADD KEY `hoteles_id_hotel` (`hoteles_id_hotel`);

--
-- Indices de la tabla `hoteles`
--
ALTER TABLE `hoteles`
  ADD PRIMARY KEY (`id_hotel`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `usuario_correo` (`usuario_correo`);

--
-- Indices de la tabla `reservas_habitacion`
--
ALTER TABLE `reservas_habitacion`
  ADD PRIMARY KEY (`id_reserva_habitacion`),
  ADD KEY `habitaciones_id_habitacion` (`habitaciones_id_habitacion`),
  ADD KEY `reservas_id_reserva` (`reservas_id_reserva`),
  ADD KEY `tipo_pensiones_id` (`tipo_pensiones_id`);

--
-- Indices de la tabla `tipo_pensiones`
--
ALTER TABLE `tipo_pensiones`
  ADD PRIMARY KEY (`id_tipo_pension`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`correo`);

--
-- Indices de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD PRIMARY KEY (`id_valoracion`),
  ADD KEY `usuario_correo` (`usuario_correo`),
  ADD KEY `reservas_id_reserva` (`reservas_id_reserva`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  MODIFY `id_habitacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `hoteles`
--
ALTER TABLE `hoteles`
  MODIFY `id_hotel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `reservas_habitacion`
--
ALTER TABLE `reservas_habitacion`
  MODIFY `id_reserva_habitacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `tipo_pensiones`
--
ALTER TABLE `tipo_pensiones`
  MODIFY `id_tipo_pension` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  MODIFY `id_valoracion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD CONSTRAINT `habitaciones_ibfk_1` FOREIGN KEY (`hoteles_id_hotel`) REFERENCES `hoteles` (`id_hotel`);

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`usuario_correo`) REFERENCES `usuarios` (`correo`);

--
-- Filtros para la tabla `reservas_habitacion`
--
ALTER TABLE `reservas_habitacion`
  ADD CONSTRAINT `reservas_habitacion_ibfk_1` FOREIGN KEY (`habitaciones_id_habitacion`) REFERENCES `habitaciones` (`id_habitacion`),
  ADD CONSTRAINT `reservas_habitacion_ibfk_2` FOREIGN KEY (`reservas_id_reserva`) REFERENCES `reservas` (`id_reserva`),
  ADD CONSTRAINT `reservas_habitacion_ibfk_3` FOREIGN KEY (`tipo_pensiones_id`) REFERENCES `tipo_pensiones` (`id_tipo_pension`);

--
-- Filtros para la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD CONSTRAINT `valoraciones_ibfk_1` FOREIGN KEY (`usuario_correo`) REFERENCES `usuarios` (`correo`),
  ADD CONSTRAINT `valoraciones_ibfk_2` FOREIGN KEY (`reservas_id_reserva`) REFERENCES `reservas` (`id_reserva`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
