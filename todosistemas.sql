-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 07-07-2021 a las 01:15:37
-- Versión del servidor: 5.7.24
-- Versión de PHP: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `todosistemas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE `actividad` (
  `Idactividad` int(11) NOT NULL,
  `actividad` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `estado` enum('Realizado','No realizado','Pendiente') COLLATE utf8_spanish_ci NOT NULL,
  `fechaAsignado` date NOT NULL,
  `HoraAsignado` time NOT NULL,
  `fechaRealizacion` date DEFAULT NULL,
  `horaRealizacion` time DEFAULT NULL,
  `usuarioAsignado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`Idactividad`, `actividad`, `estado`, `fechaAsignado`, `HoraAsignado`, `fechaRealizacion`, `horaRealizacion`, `usuarioAsignado`) VALUES
(1, 'Test pagina', 'No realizado', '2021-07-06', '09:56:57', NULL, NULL, 1),
(2, 'Corrección bug TodoSistemas financiero', 'Pendiente', '2021-07-01', '09:58:24', NULL, NULL, 2),
(3, 'Envio Correo a colaboradores', 'Realizado', '2021-06-30', '08:59:37', '2021-06-30', '10:00:11', 3),
(4, 'Prueba moto', 'Pendiente', '2021-05-02', '09:45:00', NULL, NULL, 3),
(5, 'Equipo dañado', 'Realizado', '2021-07-06', '10:00:45', '2021-07-06', '12:05:22', 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `actividadview`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `actividadview` (
`Idactividad` int(11)
,`actividad` varchar(255)
,`fechaAsignado` date
,`HoraAsignado` time
,`fechaRealizacion` date
,`horaRealizacion` time
,`diasRetraso` int(7)
,`estado` enum('Realizado','No realizado','Pendiente')
,`usuarioAsignado` int(11)
,`asignado` varchar(255)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Idusuario` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` enum('Activo','Inactivo') COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Idusuario`, `nombre`, `estado`) VALUES
(1, 'jperez', 'Activo'),
(2, 'emendoza', 'Activo'),
(3, 'wgonzalez', 'Activo');

-- --------------------------------------------------------

--
-- Estructura para la vista `actividadview`
--
DROP TABLE IF EXISTS `actividadview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `actividadview`  AS SELECT `a`.`Idactividad` AS `Idactividad`, `a`.`actividad` AS `actividad`, `a`.`fechaAsignado` AS `fechaAsignado`, `a`.`HoraAsignado` AS `HoraAsignado`, `a`.`fechaRealizacion` AS `fechaRealizacion`, `a`.`horaRealizacion` AS `horaRealizacion`, (to_days(curdate()) - to_days(`a`.`fechaAsignado`)) AS `diasRetraso`, `a`.`estado` AS `estado`, `a`.`usuarioAsignado` AS `usuarioAsignado`, `b`.`nombre` AS `asignado` FROM (`actividad` `a` join `usuario` `b` on((`a`.`usuarioAsignado` = `b`.`Idusuario`))) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`Idactividad`),
  ADD KEY `usuarioAsignado` (`usuarioAsignado`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad`
--
ALTER TABLE `actividad`
  MODIFY `Idactividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD CONSTRAINT `usuarioAsignado` FOREIGN KEY (`usuarioAsignado`) REFERENCES `usuario` (`Idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
