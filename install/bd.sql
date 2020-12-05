-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-12-2020 a las 19:02:45
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `desatranques`
--

-- --------------------------------------------------------

--
-- Borrar tabla `provincias` si existe
-- 

DROP TABLE IF EXISTS `provincias`;

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE `provincias` (
  `cod` char(2) CHARACTER SET utf8 NOT NULL DEFAULT '00' COMMENT 'Código de la provincia de dos digitos',
  `nombre` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT 'Nombre de la provincia',
  `comunidad_id` tinyint(4) NOT NULL COMMENT 'Código de la comunidad a la que pertenece'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Provincias de españa; 99 para seleccionar a Nacional';

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`cod`, `nombre`, `comunidad_id`) VALUES
('01', 'Alava', 16),
('02', 'Albacete', 7),
('03', 'Alicante', 10),
('04', 'Almería', 1),
('05', 'Avila', 8),
('06', 'Badajoz', 11),
('07', 'Balears (Illes)', 4),
('08', 'Barcelona', 9),
('09', 'Burgos', 8),
('10', 'Cáceres', 11),
('11', 'Cádiz', 1),
('12', 'Castellón', 10),
('13', 'Ciudad Real', 7),
('14', 'Córdoba', 1),
('15', 'Coruña (A)', 12),
('16', 'Cuenca', 7),
('17', 'Girona', 9),
('18', 'Granada', 1),
('19', 'Guadalajara', 7),
('20', 'Guipúzcoa', 16),
('21', 'Huelva', 1),
('22', 'Huesca', 2),
('23', 'Jaén', 1),
('24', 'León', 8),
('25', 'Lleida', 9),
('26', 'Rioja (La)', 17),
('27', 'Lugo', 12),
('28', 'Madrid', 13),
('29', 'Málaga', 1),
('30', 'Murcia', 14),
('31', 'Navarra', 15),
('32', 'Ourense', 12),
('33', 'Asturias', 3),
('34', 'Palencia', 8),
('35', 'Palmas (Las)', 5),
('36', 'Pontevedra', 12),
('37', 'Salamanca', 8),
('38', 'Santa Cruz de Tenerife', 5),
('39', 'Cantabria', 6),
('40', 'Segovia', 8),
('41', 'Sevilla', 1),
('42', 'Soria', 8),
('43', 'Tarragona', 9),
('44', 'Teruel', 2),
('45', 'Toledo', 7),
('46', 'Valencia', 10),
('47', 'Valladolid', 8),
('48', 'Vizcaya', 16),
('49', 'Zamora', 8),
('50', 'Zaragoza', 2),
('51', 'Ceuta', 18),
('52', 'Melilla', 19);

-- --------------------------------------------------------

--
-- Borrar tabla `tareas` si existe
-- 

DROP TABLE IF EXISTS `tareas`;

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `tarea_id` int(5) NOT NULL,
  `contacto` varchar(140) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `email` varchar(30) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `poblacion` varchar(40) NOT NULL,
  `cp` int(5) NOT NULL,
  `provincia` char(2) NOT NULL,
  `estado` varchar(1) NOT NULL,
  `fecha_creacion` date NOT NULL DEFAULT current_timestamp(),
  `operario` varchar(20) NOT NULL,
  `fecha_realizacion` varchar(10) NOT NULL,
  `anotaciones_anteriores` varchar(500) NOT NULL,
  `anotaciones_posteriores` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`tarea_id`, `contacto`, `telefono`, `descripcion`, `email`, `direccion`, `poblacion`, `cp`, `provincia`, `estado`, `fecha_creacion`, `operario`, `fecha_realizacion`, `anotaciones_anteriores`, `anotaciones_posteriores`) VALUES
(18, 'Agapito García', '699123123', 'Limpieza de fosa séptica.', 'agapitogarcia@emailfalso.com', 'c/ Falsa 23', 'Huelva', 21001, '21', 'P', '2020-12-03', 'Juan', '10/03/2021', 'Esta tarea pendiente la llevará a cabo Juan en la provincia de Huelva. (Prueba de selects y checkbox).', ''),
(19, 'Margarita', '657123123', 'Desatascar tuberías.', 'marga@rita.com', 'Avenida Principal 1', 'Salamanca', 37004, '37', 'C', '2020-12-03', 'Pepe', '01/02/2021', 'Esta tarea cancelada es de Pepe en la provincia de Salamanca. (Prueba de selects y checkbox).', ''),
(22, 'Filomeno López', '652456431', 'Arreglar fuga.', 'filome@no.com', 'c/ Jaén', 'Guadalajara', 19005, '19', 'P', '2020-12-05', 'Pepe', '01/06/2021', 'El cliente no sabe dónde está la fuga.', ''),
(23, 'María Domínguez', '657123234', 'Limpieza de tuberías.', 'lamari@email.com', 'Avenida Alemania 27', 'Cádiz', 22001, '11', 'R', '2020-12-05', 'Pepe', '08/07/2021', '', ''),
(24, 'Felipe Conde', '699112233', 'Mantenimiento.', 'felipito@email.com', 'c/ Marina, 19, 9ºB', 'Huelva', 21002, '21', 'P', '2020-12-05', 'Juan', '04/11/2050', 'El cliente tiene contratado un servicio de mantenimiento anual.', ''),
(25, 'Elena Gómez', '699342312', 'Desatasco de bajante.', 'elenagomez@emailfalso.com', 'c/ Ancha 12, 6ºC', 'Murcia', 25023, '30', 'P', '2020-12-05', 'Pepe', '04/11/2021', '', '');

-- --------------------------------------------------------

--
-- Borrar tabla `usuarios` si existe
-- 

DROP TABLE IF EXISTS `usuarios`;

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(4) NOT NULL,
  `nombre` varchar(12) NOT NULL,
  `tipo` varchar(14) NOT NULL,
  `usuario` varchar(12) NOT NULL,
  `pass` varchar(12) NOT NULL,
  `intentos_fallidos` int(5) NOT NULL,
  `fecha_bloqueo` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `tipo`, `usuario`, `pass`, `intentos_fallidos`, `fecha_bloqueo`) VALUES
(1, 'Angela', 'administrativo', 'angela', '1111', 0, '2020-12-04 19:19:01'),
(2, 'Pepe', 'operario', 'pepe', '1234', 0, '2020-12-05 16:52:13'),
(3, 'Juan', 'operario', 'juan', '1234', 0, '2020-12-04 16:55:37'),
(4, 'Jose', 'administrativo', 'jose', '1234', 0, '2020-12-04 19:29:54');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `nombre` (`nombre`),
  ADD KEY `FK_ComunidadAutonomaProv` (`comunidad_id`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`tarea_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `tarea_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
