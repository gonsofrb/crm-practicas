-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 28-05-2021 a las 10:49:06
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `crm_p`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `logo` varchar(150) NOT NULL,
  `nombre_cliente` varchar(250) NOT NULL,
  `cif` varchar(50) NOT NULL,
  `direccion` varchar(250) NOT NULL,
  `pais` varchar(250) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` bigint(11) NOT NULL,
  `persona_contacto` varchar(100) NOT NULL,
  `notas` text NOT NULL,
  `web` varchar(250) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `logo`, `nombre_cliente`, `cif`, `direccion`, `pais`, `email`, `telefono`, `persona_contacto`, `notas`, `web`, `fecha_creacion`) VALUES
(38, '', 'Telefónicaaaaa', 'B3456324C', 'C/San Marcos nº12 CP23456 Sevilla', 'España', 'telef@tele.es', 34955456734, 'Julián', '1ºNota', 'www.telef.com', '2021-05-26 18:53:14'),
(39, '', 'Paula', 'j4444444j', 'Calle carcelera nº14 cp 23400 Sevilla', 'España', 'paula@pau.es', 3432345676, 'Julia Romero', 'No hay notas', 'www.pau.es', '2021-05-27 08:15:22'),
(40, '', 'Rodolfo', 'f345678g', 'Calle Sanabria nº12 cp 21005 Huelva', 'España', 'rodolfo@rodof.es', 34567890987, 'Juan', 'No hay notas para añadir', 'www.rodolfo.com', '2021-05-26 19:25:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

DROP TABLE IF EXISTS `notas`;
CREATE TABLE IF NOT EXISTS `notas` (
  `id_nota` int(11) NOT NULL AUTO_INCREMENT,
  `comentario` text NOT NULL,
  `autor` varchar(100) NOT NULL,
  `tipo_nota` varchar(100) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `asociado` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  PRIMARY KEY (`id_nota`),
  KEY `id_cliente` (`id_cliente`),
  KEY `asociado` (`asociado`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

DROP TABLE IF EXISTS `proyectos`;
CREATE TABLE IF NOT EXISTS `proyectos` (
  `id_proyecto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_proyecto` varchar(250) NOT NULL,
  `descripcion` text NOT NULL,
  `estado` varchar(100) NOT NULL,
  `tarea_asociada` text NOT NULL,
  `nota_asociada` text NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_cliente` int(11) NOT NULL,
  PRIMARY KEY (`id_proyecto`),
  KEY `id_cliente` (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id_proyecto`, `nombre_proyecto`, `descripcion`, `estado`, `tarea_asociada`, `nota_asociada`, `fecha_creacion`, `id_cliente`) VALUES
(4, 'Fibra Óptica', 'Expansión de fibra óptica por la zona rural de Huelva', 'Sin empezar', 'Comprar cableado', 'Pedir presupuestos empresa Aislamientos SA', '2021-05-26 22:02:05', 38),
(6, 'Expansión cableado', 'Expandir cableado en Huelva', 'Sin empezar', 'Presupuestos a cablefree SA', 'Llamar a Laura, responsable logística', '2021-05-28 10:40:08', 39);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

DROP TABLE IF EXISTS `tareas`;
CREATE TABLE IF NOT EXISTS `tareas` (
  `id_tarea` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tarea` varchar(100) NOT NULL,
  `fecha_limite` date NOT NULL,
  `autor` varchar(100) NOT NULL,
  `proyecto_asociado` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `estado` varchar(100) NOT NULL,
  `prioridad` varchar(100) NOT NULL,
  `duracion` decimal(6,2) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_tarea`),
  KEY `id_cliente` (`id_cliente`),
  KEY `proyecto_asociado` (`proyecto_asociado`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `nombre_usu` varchar(100) NOT NULL,
  `contrasena` varchar(250) NOT NULL,
  `rol` int(11) NOT NULL,
  `empresa` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `telefono` bigint(11) NOT NULL,
  `imagen` varchar(250) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `nombre_usu` (`nombre_usu`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `nombre_usu`, `contrasena`, `rol`, `empresa`, `email`, `telefono`, `imagen`, `fecha_creacion`) VALUES
(16, 'Rosa', 'Rosa23', '$2y$04$.MjpbTcUK/SfdJeF8B1noeHpCLodVgvKnJWd1pSUoHR.YIT7R2TsK', 1, 'Limpiezas Rosa', 'rosa@rosa.es', 5434, '', '2021-03-29 15:48:37'),
(21, 'Antonio', 'Antonio23', '$2y$04$ewRWJNKNW/Yw1SDIRmTdtOw2B6Q/QjD7YPXwFEG5eUw7S0rpEBBdG', 1, 'Azulejos Antonio S.A', 'antonio@antonio.es', 34987654345, '', '2021-03-29 15:57:05'),
(36, 'Manu', 'Manu', '$2y$04$5M3NaYV87kBLzyLtYKK0/eNmV0vqbSLCq6ijHt0keKQnvWTyZZ66G', 1, 'manu', 'manurodrih3@gmail.com', 876543456, '', '2021-04-07 08:14:52'),
(53, 'Iker', 'Iker', '$2y$04$hI6YxPMx9GKtOQJgKE5HmO1/g.FmusZETvnLrnmdneD2IZtfM/tMy', 1, 'ikea', 'iker@iker.es', 34567876787, '', '2021-03-31 16:43:39'),
(54, 'Mi', 'mi', '$2y$04$4/l3qFffcuvdpwTR8lZjleIVqyolnmQFyzMzd0jggR1HX8WBRg3kK', 1, 'Gurú', 'mi@mi.es', 34435435435, 'minion.jpg', '2021-04-15 09:05:27');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `notas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `notas_ibfk_2` FOREIGN KEY (`asociado`) REFERENCES `proyectos` (`id_proyecto`);

--
-- Filtros para la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD CONSTRAINT `proyectos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`);

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `tareas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `tareas_ibfk_2` FOREIGN KEY (`proyecto_asociado`) REFERENCES `proyectos` (`id_proyecto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
