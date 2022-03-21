-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 21-03-2022 a las 15:57:35
-- Versión del servidor: 8.0.28
-- Versión de PHP: 8.0.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Tragamillas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Categoria`
--

CREATE TABLE `Categoria` (
  `id_categoria` int NOT NULL,
  `nombre` char(100) DEFAULT NULL,
  `edad_min` int DEFAULT NULL,
  `edad_max` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_socio`
--

CREATE TABLE `categoria_socio` (
  `id_categoria` int NOT NULL,
  `id_socio` int NOT NULL,
  `Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Entrenador`
--

CREATE TABLE `Entrenador` (
  `id_entrenador` int NOT NULL,
  `sueldo` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Entrenador`
--

INSERT INTO `Entrenador` (`id_entrenador`, `sueldo`) VALUES
(2, 9000),
(7, 900),
(28, 1100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrenador_grupo`
--

CREATE TABLE `entrenador_grupo` (
  `id_grupo` int NOT NULL,
  `id_entrenador` int NOT NULL,
  `Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `entrenador_grupo`
--

INSERT INTO `entrenador_grupo` (`id_grupo`, `id_entrenador`, `Fecha`) VALUES
(1, 2, '2022-03-21'),
(2, 2, '2022-03-16'),
(3, 2, '2022-03-22'),
(1, 7, '2022-03-21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipacion`
--

CREATE TABLE `equipacion` (
  `id_equipacion` int NOT NULL,
  `id_user` int NOT NULL,
  `id_ingreso_cuota` int DEFAULT NULL,
  `id_gastos` int DEFAULT NULL,
  `talla` char(5) DEFAULT NULL,
  `fecha_peticion` date DEFAULT NULL,
  `tipo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `recogido` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `equipacion`
--

INSERT INTO `equipacion` (`id_equipacion`, `id_user`, `id_ingreso_cuota`, `id_gastos`, `talla`, `fecha_peticion`, `tipo`, `recogido`) VALUES
(4, 3, NULL, NULL, 'XXS', '2022-03-09', '', 1),
(5, 3, NULL, NULL, NULL, '2022-03-10', '', 0),
(6, 3, NULL, NULL, NULL, '2022-03-14', '', 0),
(43, 3, NULL, NULL, NULL, '2022-03-15', '', 0),
(44, 3, NULL, NULL, NULL, '2022-03-15', '', 0),
(71, 59, NULL, NULL, NULL, '2022-03-15', 'prenda temporada', 0),
(72, 24, NULL, NULL, 'XXS', '2022-03-15', 'termica', 0),
(73, 32, NULL, NULL, 'L', '2022-03-15', 'pantalones chandal', 0),
(74, 59, NULL, NULL, 'M', '2022-03-15', 'chandal completo', 0),
(75, 21, NULL, NULL, 'L', '2022-03-15', 'una careta', 0),
(76, 32, NULL, NULL, 'unica', '2022-03-15', 'reloj', 0),
(77, 24, NULL, NULL, 'M', '2022-03-15', 'prueba', 0),
(78, 24, NULL, NULL, 'S', '2022-03-15', 'sdfg', 0),
(79, 24, NULL, NULL, 'L', '2022-03-15', 'prueba final', 0),
(80, 28, NULL, NULL, 'unica', '2022-03-15', 'gorra', 0),
(81, 5, NULL, NULL, 'unica', '2022-03-15', 'alas', 0),
(86, 24, NULL, NULL, 'L', '2022-03-16', 'Chandal completo', 0),
(87, 24, NULL, NULL, NULL, '2022-03-16', 'prenda temporada', 0),
(88, 61, NULL, NULL, NULL, '2022-03-20', 'prenda temporada', 0),
(89, 62, NULL, NULL, NULL, '2022-03-20', 'prenda temporada', 0),
(90, 63, NULL, NULL, NULL, '2022-03-20', 'prenda temporada', 0),
(91, 64, NULL, NULL, NULL, '2022-03-20', 'prenda temporada', 0),
(92, 65, NULL, NULL, NULL, '2022-03-21', 'prenda temporada', 0),
(93, 66, NULL, NULL, NULL, '2022-03-21', 'prenda temporada', 0),
(94, 67, NULL, NULL, NULL, '2022-03-21', 'prenda temporada', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Evento`
--

CREATE TABLE `Evento` (
  `id_evento` int NOT NULL,
  `id_entrenador` int DEFAULT NULL,
  `Nombre` char(100) DEFAULT NULL,
  `Tipo` char(20) DEFAULT NULL,
  `Precio` int DEFAULT NULL,
  `descuento` char(3) DEFAULT NULL,
  `fecha_ini` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Evento`
--

INSERT INTO `Evento` (`id_evento`, `id_entrenador`, `Nombre`, `Tipo`, `Precio`, `descuento`, `fecha_ini`, `fecha_fin`) VALUES
(1, NULL, '10K Tragamillas', 'carrera', 15, '0', '2022-02-01', '2022-02-01'),
(2, 7, 'Preparacion fisica', 'curso', 60, '0', '2022-02-01', '2022-05-13'),
(3, 2, 'taller peques', 'curso', 40, '0', '2022-01-01', '2022-09-23'),
(4, NULL, 'carrera del pavo', 'carrera', 5, '0', '2022-02-01', '2022-02-01'),
(5, NULL, 'invadir rusia en invierno', 'carrera', 0, '100', '2022-12-30', '2023-01-03'),
(6, NULL, 'carrera1', 'carrera', 20, '0', '2022-03-12', '2022-03-12'),
(9, NULL, 'carrera2', 'carrera', 20, '0', '2022-03-12', '2022-03-12'),
(10, NULL, 'carrera3', 'carrera', 20, '0', '2022-03-26', '2022-03-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Externo`
--

CREATE TABLE `Externo` (
  `id_externo` int NOT NULL,
  `id_evento` int NOT NULL,
  `nombre` char(20) DEFAULT NULL,
  `apellido` char(60) DEFAULT NULL,
  `dni` char(15) DEFAULT NULL,
  `fecha_nac` date DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` char(60) DEFAULT NULL,
  `CC` varchar(50) DEFAULT NULL,
  `dorsal` int DEFAULT NULL,
  `marca` char(10) DEFAULT NULL,
  `fecha_ini` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Externo`
--

INSERT INTO `Externo` (`id_externo`, `id_evento`, `nombre`, `apellido`, `dni`, `fecha_nac`, `telefono`, `email`, `CC`, `dorsal`, `marca`, `fecha_ini`, `fecha_fin`) VALUES
(24, 1, 'benito', 'perez galdos', '12345632A', '2001-01-23', '676676676', 'email@gmail.com', NULL, NULL, NULL, '2022-02-01', '2022-02-01'),
(25, 4, 'Juana', 'De Arco', '74185294J', '2001-01-23', '741841941', 'juana@dearco.com', NULL, NULL, NULL, '2022-02-01', '2022-02-01'),
(26, 1, 'benito', 'perez galdos', '12345632A', '2022-03-18', '23434242', 'email@gmail.com', NULL, NULL, NULL, '2022-02-01', '2022-02-01'),
(27, 1, 'benito', 'perez galdos', '12345632A', '2022-03-18', '23434242', 'email@gmail.com', NULL, NULL, NULL, '2022-02-01', '2022-02-01'),
(28, 1, 'benito', 'perez galdos', '12345632A', '2022-03-18', '23434242', 'email@gmail.com', NULL, 1, NULL, '2022-02-01', '2022-02-01'),
(29, 1, 'oscar', 'magallon', '65498715M', '2002-05-13', '684684684', 'magallon@gmail.com', NULL, NULL, NULL, '2022-02-01', '2022-02-01'),
(30, 1, 'Javier', 'AAAA', '35748625J', '1990-02-15', '148657952', 'javier@profe.com', NULL, 2, NULL, '2022-02-01', '2022-02-01'),
(32, 1, 'Javier', 'perez galdos', '12345632A', '1990-12-12', '741852963', 'javier@profe.com', 'ES123456489', NULL, NULL, '2022-02-01', '2022-02-01'),
(33, 5, 'benito', 'perez galdos', '12345632A', '2002-05-05', '714865932', 'javier@profe.com', 'ES215345585', 1, NULL, '2022-12-30', '2023-01-03'),
(34, 9, 'benito', 'perez galdos', '12345632A', '2002-05-05', '741852963', 'javier@profe.com', 'ES215345585', NULL, NULL, '2022-03-12', '2022-03-12'),
(36, 5, 'Maria', 'Unpajote', '00000000F', '2021-09-16', '000000000', 'aaa@gmuil.com', '000', NULL, NULL, '2022-12-30', '2023-01-03'),
(39, 5, 'Benito', 'Camelas', '00000000H', '2021-12-09', '0000000000', 'ejemplo@gmail.com', '677899', 4, NULL, '2022-12-30', '2023-01-03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Grupo`
--

CREATE TABLE `Grupo` (
  `id_grupo` int NOT NULL,
  `nombre` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Grupo`
--

INSERT INTO `Grupo` (`id_grupo`, `nombre`) VALUES
(1, 'Grupo_1'),
(2, 'Grupo_2 Atletismo Genral'),
(3, 'Grupo_3 Atletismo General');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `G_Otros`
--

CREATE TABLE `G_Otros` (
  `id_gastos` int NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Concepto` char(60) DEFAULT NULL,
  `importe` int DEFAULT NULL,
  `id_socio` int NOT NULL,
  `Id_entidad` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `G_Personal`
--

CREATE TABLE `G_Personal` (
  `id_gasto` int NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Concepto` char(40) DEFAULT NULL,
  `importe` int DEFAULT NULL,
  `id_entrenador` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `id_horario` int NOT NULL,
  `dia_sem` char(10) DEFAULT NULL,
  `hora_ini` varchar(5) DEFAULT NULL,
  `hora_fin` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`id_horario`, `dia_sem`, `hora_ini`, `hora_fin`) VALUES
(1, 'Martes', '18:30', '20:00'),
(2, 'Jueves', '18:00', '19:30'),
(3, 'Lunes', '18:30', '20:00'),
(4, 'Miercoles', '18:30', '20:00'),
(5, 'Jueves', '18:30', '20:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario_grupo`
--

CREATE TABLE `horario_grupo` (
  `id_horario` int NOT NULL,
  `id_grupo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `horario_grupo`
--

INSERT INTO `horario_grupo` (`id_horario`, `id_grupo`) VALUES
(3, 1),
(4, 1),
(5, 1),
(1, 3),
(2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Ing_Actividades`
--

CREATE TABLE `Ing_Actividades` (
  `id_ingreso_Actividades` int NOT NULL,
  `id_externo` int NOT NULL,
  `id_socio` int NOT NULL,
  `id_evento` int NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Concepto` char(60) DEFAULT NULL,
  `Importe` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `I_cuotas`
--

CREATE TABLE `I_cuotas` (
  `id_ingreso_cuota` int NOT NULL,
  `id_socio` int NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Concepto` char(60) DEFAULT NULL,
  `Importe` int DEFAULT NULL,
  `Tipo` char(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `I_otros`
--

CREATE TABLE `I_otros` (
  `id_ingreso_otros` int NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Concepto` char(60) DEFAULT NULL,
  `Importe` int DEFAULT NULL,
  `Id_entidad` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Licencia`
--

CREATE TABLE `Licencia` (
  `id_licencia` int NOT NULL,
  `id_socio` int NOT NULL,
  `img` char(100) DEFAULT NULL,
  `num_licencia` int DEFAULT NULL,
  `fecha_cad` date DEFAULT NULL,
  `Tipo` char(25) DEFAULT NULL,
  `Dorsal` char(10) DEFAULT NULL,
  `Reginal_nacional` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Otras_entidades`
--

CREATE TABLE `Otras_entidades` (
  `Id_entidad` int NOT NULL,
  `nombre` char(40) DEFAULT NULL,
  `NIF` char(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Otras_entidades`
--

INSERT INTO `Otras_entidades` (`Id_entidad`, `nombre`, `NIF`) VALUES
(4, 'Adidasa', '00000000D'),
(27, 'Nike', '987987987'),
(29, 'Sportacus', '85274136J'),
(30, 'Ara Ara', '85274136J'),
(31, 'ak47 for russia', '768637678'),
(34, 'pakasasasas', '4554525'),
(35, 'pakasasasas2', '45545250'),
(36, 'pakasasasas3', '45545'),
(37, 'pakasasasas4', '45545'),
(38, 'pakasasasas5', '45545'),
(39, 'pakasasasas6', '45545'),
(40, 'ji levah', '454545'),
(41, 'fsdfsdf', '858757'),
(42, 'dgfsdgfds', '56756545'),
(43, 'fsfsdfsd', '45242'),
(44, 'dgsdgsdg', '86876'),
(45, 'dgsdgsdg2', '86876'),
(46, 'gjsbjsdgbjk', '554525'),
(47, 'msdmdfnm', '54442'),
(48, 'msdmdfnm2', '54442'),
(49, 'asfsf7777', '4444'),
(50, 'asfsf99999', '4444'),
(51, 'prprppdgp', '555555'),
(52, 'prprppkkkkk', '555555'),
(53, 'ak48-1', '476654'),
(54, 'ak48-1', '476654'),
(60, 'test pag', '5456');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Prueba`
--

CREATE TABLE `Prueba` (
  `Id_prueba` int NOT NULL,
  `nombre` char(100) DEFAULT NULL,
  `tipo` char(10) DEFAULT NULL,
  `observaciones` char(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Prueba`
--

INSERT INTO `Prueba` (`Id_prueba`, `nombre`, `tipo`, `observaciones`) VALUES
(1, '100 metros lisos', 'tiempo', ''),
(2, '400 metros lisos', 'tiempo', ''),
(3, 'lanzamiento de peso', 'distancia', ''),
(4, 'salto de longitud', 'distancia', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prueba_socio`
--

CREATE TABLE `prueba_socio` (
  `Id_prueba` int NOT NULL,
  `id_socio` int NOT NULL,
  `marca` char(10) DEFAULT NULL,
  `Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `prueba_socio`
--

INSERT INTO `prueba_socio` (`Id_prueba`, `id_socio`, `marca`, `Fecha`) VALUES
(1, 3, '10.32 s', '2022-02-08'),
(1, 3, '10.20', '2022-02-10'),
(1, 3, '1', '2022-03-01'),
(1, 3, '22', '2022-03-14'),
(1, 3, '33', '2022-04-09'),
(1, 5, '11', '2022-02-01'),
(1, 5, '1', '2022-02-28'),
(1, 5, '11', '2022-03-01'),
(1, 5, '11', '2022-03-23'),
(1, 21, '1.2', '2022-02-01'),
(1, 21, '1.1', '2022-02-28'),
(1, 21, '22', '2022-03-14'),
(1, 21, '22', '2022-03-23'),
(1, 24, '100', '2022-02-28'),
(1, 32, '12', '2022-02-01'),
(1, 32, '23', '2022-02-28'),
(1, 32, '911911', '2022-03-14'),
(1, 32, '33', '2022-03-23'),
(1, 59, '12', '2022-02-28'),
(1, 59, '96', '2022-03-21'),
(1, 65, '12', '2022-02-28'),
(2, 3, '5.7', '2022-02-01'),
(2, 3, '6', '2022-02-28'),
(2, 3, '11', '2022-03-01'),
(2, 3, '0.111', '2022-03-10'),
(2, 3, '5.5', '2022-03-23'),
(2, 5, '51.75 s', '2022-02-08'),
(2, 5, '111', '2022-03-01'),
(2, 5, '44', '2022-03-23'),
(2, 21, '2', '2022-03-23'),
(2, 32, '12', '2022-02-28'),
(2, 32, '911911', '2022-03-14'),
(2, 59, '22', '2022-03-15'),
(3, 3, '16.72m', '2022-02-08'),
(3, 3, '99999999', '2022-02-28'),
(3, 5, '444', '2022-02-28'),
(3, 5, '66', '2022-03-01'),
(3, 21, '2700', '2022-02-28'),
(3, 21, '1112', '2022-03-14'),
(3, 21, '2222', '2022-03-23'),
(3, 32, '911911', '2022-03-14'),
(4, 3, '33', '2022-02-28'),
(4, 3, '20', '2022-03-10'),
(4, 5, '2.45', '2022-02-08'),
(4, 21, '2222', '2022-03-08'),
(4, 21, '564566', '2022-03-14'),
(4, 21, '222', '2022-03-23'),
(4, 32, '911', '2022-02-28'),
(4, 32, '911911', '2022-03-14'),
(4, 65, '2', '2022-04-09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Rol`
--

CREATE TABLE `Rol` (
  `id_Rol` int NOT NULL,
  `nombre` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Rol`
--

INSERT INTO `Rol` (`id_Rol`, `nombre`) VALUES
(0, 'superAdmin'),
(5, 'Entrenador'),
(10, 'Usuario'),
(200, 'Tienda');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Socio`
--

CREATE TABLE `Socio` (
  `id_socio` int NOT NULL,
  `familiar` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Socio`
--

INSERT INTO `Socio` (`id_socio`, `familiar`) VALUES
(5, NULL),
(21, NULL),
(32, NULL),
(33, NULL),
(65, NULL),
(66, NULL),
(67, NULL),
(3, 24),
(24, 24),
(59, 24),
(61, 62),
(62, 62),
(63, 62),
(64, 62);

--
-- Disparadores `Socio`
--
DELIMITER $$
CREATE TRIGGER `primera_equipacion` AFTER INSERT ON `Socio` FOR EACH ROW BEGIN
	INSERT INTO `equipacion` (`id_user`, `tipo`, `fecha_peticion`) VALUES (new.id_socio, 'prenda temporada',CURDATE());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socio_pertenece_grupo`
--

CREATE TABLE `socio_pertenece_grupo` (
  `id_grupo` int NOT NULL,
  `id_socio` int NOT NULL,
  `Fecha` date NOT NULL,
  `aceptado` tinyint(1) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `socio_pertenece_grupo`
--

INSERT INTO `socio_pertenece_grupo` (`id_grupo`, `id_socio`, `Fecha`, `aceptado`, `activo`) VALUES
(1, 3, '2022-03-09', 1, 1),
(1, 3, '2022-03-21', 0, 0),
(1, 5, '2022-03-17', 0, 0),
(1, 21, '2022-02-08', 1, 1),
(1, 24, '2022-03-17', 1, 1),
(1, 59, '2022-03-21', 0, 0),
(3, 3, '2022-03-17', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socio_x_evento`
--

CREATE TABLE `socio_x_evento` (
  `id_socio` int NOT NULL,
  `id_evento` int NOT NULL,
  `marca` char(10) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `dorsal` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `socio_x_evento`
--

INSERT INTO `socio_x_evento` (`id_socio`, `id_evento`, `marca`, `fecha`, `dorsal`) VALUES
(3, 6, NULL, '2022-03-07', '5'),
(32, 5, NULL, '2022-03-09', '3'),
(32, 10, NULL, '2022-03-09', '6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_evento`
--

CREATE TABLE `solicitud_evento` (
  `id_solicitud_evento` int NOT NULL,
  `fecha_ini` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `solicitud_evento`
--

INSERT INTO `solicitud_evento` (`id_solicitud_evento`, `fecha_ini`, `fecha_fin`) VALUES
(1, '2022-01-01', '2022-01-31'),
(2, '2022-01-01', '2022-01-31'),
(3, '2022-01-01', '2022-01-31'),
(4, '2022-01-01', '2022-01-31'),
(5, '2022-01-02', '2022-01-31'),
(6, '2022-01-01', '2022-01-31'),
(9, '2022-03-04', '2022-03-10'),
(10, '2022-03-04', '2022-03-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_exter_evento`
--

CREATE TABLE `solicitud_exter_evento` (
  `id_externo` int NOT NULL,
  `id_evento` int NOT NULL,
  `id_solicitud_evento` int NOT NULL,
  `fecha` date DEFAULT NULL,
  `activo` tinyint(1) DEFAULT '0',
  `aceptado` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `solicitud_exter_evento`
--

INSERT INTO `solicitud_exter_evento` (`id_externo`, `id_evento`, `id_solicitud_evento`, `fecha`, `activo`, `aceptado`) VALUES
(28, 1, 1, '2022-03-08', 1, 1),
(29, 1, 1, '2022-03-08', 0, 0),
(30, 1, 1, '2022-03-08', 1, 1),
(32, 1, 1, '2022-03-08', 0, 0),
(33, 5, 5, '2022-03-08', 1, 1),
(34, 9, 9, '2022-03-08', 0, 0),
(39, 5, 5, '2022-03-15', 1, 1);

--
-- Disparadores `solicitud_exter_evento`
--
DELIMITER $$
CREATE TRIGGER `poner_dorsal_externo` AFTER UPDATE ON `solicitud_exter_evento` FOR EACH ROW BEGIN
    DECLARE dorsal_ext INT;
    DECLARE dorsal_soc INT; 
	IF(new.activo AND new.aceptado) THEN 
    	SELECT IFNULL(max(dorsal),0) INTO dorsal_ext FROM Externo WHERE id_evento=old.id_evento;
    	SELECT IFNULL(max(dorsal),0) INTO dorsal_soc FROM socio_x_evento WHERE id_evento=old.id_evento;
            IF(dorsal_ext>dorsal_soc) THEN
                UPDATE Externo SET dorsal= (dorsal_ext+1) WHERE id_externo=old.id_externo;
            ELSE
            	UPDATE Externo SET dorsal= (dorsal_soc+1) WHERE id_externo=old.id_externo;
            END IF;    
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_ext_solo_si__socio`
--

CREATE TABLE `solicitud_ext_solo_si__socio` (
  `id_solicitud_soc` int NOT NULL,
  `id_grupo` int NOT NULL,
  `aceptado` tinyint(1) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_socio`
--

CREATE TABLE `solicitud_socio` (
  `id_solicitud_soc` int NOT NULL,
  `Dni` char(15) DEFAULT NULL,
  `nombre` char(40) DEFAULT NULL,
  `apellido` char(100) DEFAULT NULL,
  `CC` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fecha_nac` date DEFAULT NULL,
  `email` char(60) DEFAULT NULL,
  `telefono` int DEFAULT NULL,
  `aceptada` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `solicitud_socio`
--

INSERT INTO `solicitud_socio` (`id_solicitud_soc`, `Dni`, `nombre`, `apellido`, `CC`, `fecha_nac`, `email`, `telefono`, `aceptada`) VALUES
(1, '12345678K', 'Oscar', 'Merino', 'ES0252158121', '2001-01-01', 'merino@puto.amo', 32165489, 1),
(9, '73022886W', 'Diego', 'Berenguer Celma', 'ES56258625', '2001-01-23', 'cassasdiego@hotmail.com', 651918916, 1),
(10, '12345678Ñ', 'Pepe', 'perez', 'ES5558612585625', '2001-01-23', 'pepe@pepe.com', 654651456, 1),
(11, '00000000J', 'Marcos', 'Hernandez Aragones', 'ES5258695856', '2001-01-19', 'marcos@gmail.com', 123456987, 1),
(12, '00011223J', 'Marcos', 'Hernandez Aragones', 'ES651498156149814', '2001-01-19', 'marcos@gmail.com', 123456987, 1),
(13, '00000000P', 'Marcos', 'Hernandez Aragones', '', '2018-06-13', 'ejemplo@gmial.com', 0, 1),
(14, '00000000O', 'Benito', 'Camelas', '', '2022-02-03', 'ejemplo@gmial.com', 0, 1),
(15, '12345698G', 'Gil Pablo', 'Blanco', 'ES015615610', '2000-01-12', 'gil@pablo.com', 123456789, 1),
(16, '00000000I', 'Maria', 'Unpajote', '', '2022-02-04', 'ejemplo@gmial.com', 0, 1),
(17, '00000000U', 'Tomas', 'Turbado', '', '2022-02-05', 'ejemplo@gmial.com', 0, 1),
(18, '65498732J', 'Javier', 'Legua', 'ES65198165189', '2002-05-19', 'legua@delegado.com', 654987321, 1),
(19, '00000000Y', 'Queri', 'Caberga', '', '2022-02-05', 'ejemplo@gmial.com', 0, 1),
(20, '14785236G', 'Oscar', 'Merino', 'ES654891456786453', '2001-01-25', 'merino@otaku.com', 789658234, 1),
(21, '12345687J', 'la definitiva', 'asdfa', 'ES651981981', '1111-05-23', 'la@definitiva.chavales', 845967154, 1),
(22, '98747514J', 'Raul', 'Bernal Arrufat', 'ES5258695856', '2001-03-04', 'raulbernal@gmail.com', 693693693, 1),
(23, '99988877K', 'Oscar', 'Garcia Blanco', 'ES351856185654', '2001-04-04', 'bombi@gmail.com', 747747747, 1),
(24, '85554564', 'aqui', 'llueve dentro', '545456456', '2022-03-16', 'meLlueveEncima@gmail.com', 55475454, 1),
(26, '54245242', 'bbbbbbbbb', 'sfeedfsdfsdf', '5452444414', '2022-04-01', 'rtdhdfgfrgh@fdgsdfsg.sdg', 544244, 1),
(27, '865456', 'SMYD', 'sfgsdgg', '32523545', '2022-03-09', 'dadfgsdfg@sdfsdf.sdf', 55752425, 1),
(30, '6345453', 'ben', 'dover', '45453245345', '2022-03-19', 'bendover@like.dat', 86456, 1),
(32, '00000000Z', 'Marcos', 'Hernández Aragonés', '78890', '2021-11-12', 'marcoshernandezaragones@gmail.com', 633933656, 1),
(33, '76485475H', 'Hommer', 'Simpson', 'ES65149618596819654', '1956-05-12', 'hommersimp@hotmail.com', 741987573, 1),
(34, '98963568M', 'Marge', 'Simpson', 'ES65149618596819484', '1954-03-19', 'margesimp@gmail.com', 878585948, 1),
(35, '15168645B', 'Bart', 'Simpson', 'ES65149618596819654', '1983-04-01', 'bartsimp@gmail.com', 741847695, 1),
(36, '15984875L', 'Lisa', 'Simpson', 'ES65149618596819484', '1981-05-09', 'lisasimp@hotmail.com', 748748959, 1),
(37, '00000000O', 'a', 'a', '0000', '2021-09-17', 'ejemplo13@gmial.com', 0, 0),
(38, '12345678E', 'Javier', 'Arenzana Romeo', 'ES015615610', '2000-01-12', 'jarenzana@cpifpbajoaragon.com', 741852963, 1),
(39, '00000000t', 'falco', 'apellido da igual', '0000', '2022-03-23', 'falco@falco.falco', 345452, 1),
(40, '73229684F', 'Carlos', 'Baquero Soriano', '33334448907', '2000-10-17', 'carlosbaq17@hotmail.com', 633391767, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_socio_evento`
--

CREATE TABLE `solicitud_socio_evento` (
  `id_socio` int NOT NULL,
  `id_evento` int NOT NULL,
  `id_solicitud_evento` int NOT NULL,
  `fecha` date NOT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `aceptado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `solicitud_socio_evento`
--

INSERT INTO `solicitud_socio_evento` (`id_socio`, `id_evento`, `id_solicitud_evento`, `fecha`, `activo`, `aceptado`) VALUES
(3, 2, 2, '2022-03-08', 0, 0),
(3, 2, 2, '2022-03-11', 0, 0),
(3, 3, 3, '2022-03-07', 0, 0),
(3, 3, 3, '2022-03-11', 0, 0),
(3, 4, 4, '2022-03-08', 0, 0),
(3, 4, 4, '2022-03-11', 0, 0),
(3, 5, 5, '2022-03-08', 1, 1),
(3, 5, 5, '2022-03-14', 0, 0),
(3, 6, 6, '2022-03-07', 1, 1),
(3, 9, 9, '2022-03-07', 0, 0),
(32, 5, 5, '2022-03-09', 1, 1),
(32, 10, 10, '2022-03-09', 1, 1),
(33, 4, 4, '2022-03-09', 0, 0);

--
-- Disparadores `solicitud_socio_evento`
--
DELIMITER $$
CREATE TRIGGER `poner_dorsal_socio` AFTER UPDATE ON `solicitud_socio_evento` FOR EACH ROW BEGIN
    DECLARE dorsal_ext INT;
    DECLARE dorsal_soc INT; 
	IF(new.activo AND new.aceptado) THEN 
    	SELECT IFNULL(max(dorsal),0) INTO dorsal_ext FROM Externo WHERE old.id_evento;
    	SELECT IFNULL(max(dorsal),0) INTO dorsal_soc FROM socio_x_evento WHERE old.id_evento;
            IF(dorsal_ext>dorsal_soc) THEN
                INSERT INTO `socio_x_evento`(`id_socio`, `id_evento`, `marca`, `fecha`, `dorsal`) VALUES (old.id_socio, old.id_evento, null, old.fecha, (dorsal_ext+1));
            ELSE
            	INSERT INTO `socio_x_evento`(`id_socio`, `id_evento`, `marca`, `fecha`, `dorsal`) VALUES (old.id_socio, old.id_evento, null, old.fecha, (dorsal_soc+1));
            END IF;    
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Temp`
--

CREATE TABLE `Temp` (
  `id_temp` int NOT NULL,
  `Fecha_ini` date DEFAULT NULL,
  `Fecha_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Test`
--

CREATE TABLE `Test` (
  `id_test` int NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `Test`
--

INSERT INTO `Test` (`id_test`, `Nombre`, `fecha`) VALUES
(1, 'hail hydra', '2022-02-28'),
(2, 'ban capt America', '2022-02-01'),
(3, 'testzone1', '2022-03-23'),
(4, 'polski', '2022-04-09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `test_prueba`
--

CREATE TABLE `test_prueba` (
  `id_test` int NOT NULL,
  `Id_prueba` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `test_prueba`
--

INSERT INTO `test_prueba` (`id_test`, `Id_prueba`) VALUES
(1, 1),
(2, 1),
(1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `User`
--

CREATE TABLE `User` (
  `id_user` int NOT NULL,
  `Dni` char(9) DEFAULT NULL,
  `nombre` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `apellido` char(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `CC` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fecha_nac` date DEFAULT NULL,
  `email` char(40) DEFAULT NULL,
  `pass` char(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `rol` int DEFAULT NULL,
  `telefono` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `img` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `User`
--

INSERT INTO `User` (`id_user`, `Dni`, `nombre`, `apellido`, `CC`, `fecha_nac`, `email`, `pass`, `rol`, `telefono`, `img`, `activo`) VALUES
(1, '00000000A', 'SueprAdmin', 'SuperAdmin', '000', '2001-01-01', 'superadmin@gmail.com', '*8A24B641D1943F19759959F8FC49251B002F91B0', 0, '0', NULL, 1),
(2, '00000000J', 'Antonio', 'Camachoc', '000010101', '2022-02-17', 'jesus@gmail.com', '*2A4188593CEB5D3F0DBF0BED33935E09163A9D48', 5, '100', NULL, 1),
(3, '00000000C', 'Jorge', 'El Curioso', '000', '2019-01-01', 'zeke@gmail.com', '*0A2E83D2AB0839DE27B6A3083218AFE826DD3468', 10, '676489725', 'foto_usuario_3.png', 1),
(4, '00000000D', 'Adidas', 'sl', '000', '1949-08-18', 'tienda@gmail.com', '*A1D652475676C8BB8A65B2AE62D55631964FCAB6', 200, '0', NULL, 1),
(5, '00000000K', 'Sara', 'Kerrigan', '000', '2473-06-16', 'TarKossia@gmail.com', '*87C32412A2E6F8698666E7821B72074810CE5B2C', 10, '0', NULL, 1),
(7, '12345678J', 'Juana', 'Orta', '0202', '2002-01-01', 'juangenio@gmail.com', NULL, 5, '123456', NULL, 1),
(10, '56654', 'pako', ' pako pakoooo', '00000', '2080-08-09', 'pako@pako.pako', NULL, 5, '486', NULL, 0),
(16, '00000000T', 'damian', 'Miron', 'ES8630638615110355360779', '2022-02-04', 'damian@soy.ungenio', NULL, 5, '787878787', NULL, 0),
(21, '000R', 'RED', 'SKULL', '00001001010101', '2022-02-08', 'hydra@hydra.ger', '*D610A31F29B10A0BC88ADAEDF625672E31791AA3', 10, '9696985', NULL, 1),
(24, '73022886W', 'Diego', 'Berenguer Celma', 'ES56258625', '2001-01-23', 'cassasdiego@hotmail.com', '*58A53281961DAAF5CE57BA76149D8C4E2E249633', 10, '651918916', NULL, 1),
(28, '85274136J', 'Javier', 'Legua 0lleta', 'ES8630638615110355360779', '2002-05-05', 'javierlegua@gmail.com', '*8B3ECFFA41454B2727819EBF31FA533C28B64695', 5, '987755315', NULL, 1),
(32, '98747514J', 'Raul', 'Bernal Arrufat', 'ES5258695856', '2001-03-04', 'raulbernal@gmail.com', '*3E16155FA1F9A3A7FCAE345D3D6CB236DFD30187', 10, '693693693', NULL, 1),
(33, '99988877K', 'Oscar', 'Garcia Blancos', 'ES351856185654', '2001-04-04', 'bombi@gmail.com', '*7E0BDDB97F334C475D692D398CFE758A3D830135', 10, '747747747', NULL, 1),
(59, '00000000Z', 'Marcos', 'Hernández Aragonés', '78890', '2021-11-12', 'marcoshernandezaragones@gmail.com', '*59EC7D1CDC0F076F72976434FCE14BC3D8FB2D90', 10, '633933656', NULL, 1),
(61, '76485475H', 'Hommer', 'Simpson', 'ES65149618596819654', '1956-05-12', 'hommersimp@hotmail.com', '*FC3254B99A04D1F6C2384889AB89659C48E80D58', 10, '741987573', NULL, 1),
(62, '98963568M', 'Marge', 'Simpson', 'ES65149618596819484', '1954-03-19', 'margesimp@gmail.com', '*A31BD0B778BEF03AE4EC1EBA96E67317DD5C02A1', 10, '878585948', NULL, 1),
(63, '15168645B', 'Bart', 'Simpson', 'ES65149618596819654', '1983-04-01', 'bartsimp@gmail.com', '*25A89F48AF3E5947F46D05C4FDFC6BE3DC8E9578', 10, '741847695', NULL, 1),
(64, '15984875L', 'Lisa', 'Simpson', 'ES65149618596819484', '1981-05-09', 'lisasimp@hotmail.com', '*C3BBB372235DEE6D2B4B93EE0A1C2A1512C8F28A', 10, '748748959', NULL, 1),
(65, '12345678E', 'Javier', 'Arenzana Romeo', 'ES015615610', '2000-01-12', 'jarenzana@cpifpbajoaragon.com', '*A02AA727CF2E8C5E6F07A382910C4028D65A053A', 10, '741852963', NULL, 1),
(66, '00000000t', 'falco', 'apellido da igual', '0000', '2022-03-23', 'falco@falco.falco', '*1C6D0B3DB33CFC69C83D08E46C72B791E37A060D', 10, '345452', NULL, 1),
(67, '73229684F', 'Carlos', 'Baquero Soriano', '33334448907', '2000-10-17', 'carlosbaq17@hotmail.com', '*01D7DA39DAD70206128EB619CE0724BDE871EC9F', 10, '633391767', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_x_temporada`
--

CREATE TABLE `usuario_x_temporada` (
  `id_temp` int NOT NULL,
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Categoria`
--
ALTER TABLE `Categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `categoria_socio`
--
ALTER TABLE `categoria_socio`
  ADD PRIMARY KEY (`id_categoria`,`id_socio`,`Fecha`),
  ADD KEY `id_socio` (`id_socio`);

--
-- Indices de la tabla `Entrenador`
--
ALTER TABLE `Entrenador`
  ADD PRIMARY KEY (`id_entrenador`);

--
-- Indices de la tabla `entrenador_grupo`
--
ALTER TABLE `entrenador_grupo`
  ADD PRIMARY KEY (`id_grupo`,`id_entrenador`,`Fecha`),
  ADD KEY `id_entrenador` (`id_entrenador`);

--
-- Indices de la tabla `equipacion`
--
ALTER TABLE `equipacion`
  ADD PRIMARY KEY (`id_equipacion`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_ingreso_cuota` (`id_ingreso_cuota`),
  ADD KEY `id_gastos` (`id_gastos`);

--
-- Indices de la tabla `Evento`
--
ALTER TABLE `Evento`
  ADD PRIMARY KEY (`id_evento`),
  ADD KEY `id_entrenador` (`id_entrenador`);

--
-- Indices de la tabla `Externo`
--
ALTER TABLE `Externo`
  ADD PRIMARY KEY (`id_externo`),
  ADD KEY `id_evento` (`id_evento`);

--
-- Indices de la tabla `Grupo`
--
ALTER TABLE `Grupo`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indices de la tabla `G_Otros`
--
ALTER TABLE `G_Otros`
  ADD PRIMARY KEY (`id_gastos`),
  ADD KEY `id_socio` (`id_socio`),
  ADD KEY `Id_entidad` (`Id_entidad`);

--
-- Indices de la tabla `G_Personal`
--
ALTER TABLE `G_Personal`
  ADD PRIMARY KEY (`id_gasto`),
  ADD KEY `id_entrenador` (`id_entrenador`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`id_horario`);

--
-- Indices de la tabla `horario_grupo`
--
ALTER TABLE `horario_grupo`
  ADD PRIMARY KEY (`id_horario`,`id_grupo`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- Indices de la tabla `Ing_Actividades`
--
ALTER TABLE `Ing_Actividades`
  ADD PRIMARY KEY (`id_ingreso_Actividades`),
  ADD KEY `id_socio` (`id_socio`),
  ADD KEY `id_evento` (`id_evento`),
  ADD KEY `id_externo` (`id_externo`);

--
-- Indices de la tabla `I_cuotas`
--
ALTER TABLE `I_cuotas`
  ADD PRIMARY KEY (`id_ingreso_cuota`),
  ADD KEY `id_socio` (`id_socio`);

--
-- Indices de la tabla `I_otros`
--
ALTER TABLE `I_otros`
  ADD PRIMARY KEY (`id_ingreso_otros`),
  ADD KEY `Id_entidad` (`Id_entidad`);

--
-- Indices de la tabla `Licencia`
--
ALTER TABLE `Licencia`
  ADD PRIMARY KEY (`id_licencia`),
  ADD KEY `id_socio` (`id_socio`);

--
-- Indices de la tabla `Otras_entidades`
--
ALTER TABLE `Otras_entidades`
  ADD PRIMARY KEY (`Id_entidad`);

--
-- Indices de la tabla `Prueba`
--
ALTER TABLE `Prueba`
  ADD PRIMARY KEY (`Id_prueba`);

--
-- Indices de la tabla `prueba_socio`
--
ALTER TABLE `prueba_socio`
  ADD PRIMARY KEY (`Id_prueba`,`id_socio`,`Fecha`),
  ADD KEY `id_socio` (`id_socio`);

--
-- Indices de la tabla `Rol`
--
ALTER TABLE `Rol`
  ADD PRIMARY KEY (`id_Rol`);

--
-- Indices de la tabla `Socio`
--
ALTER TABLE `Socio`
  ADD PRIMARY KEY (`id_socio`),
  ADD KEY `familiar` (`familiar`);

--
-- Indices de la tabla `socio_pertenece_grupo`
--
ALTER TABLE `socio_pertenece_grupo`
  ADD PRIMARY KEY (`id_grupo`,`id_socio`,`Fecha`),
  ADD KEY `id_socio` (`id_socio`);

--
-- Indices de la tabla `socio_x_evento`
--
ALTER TABLE `socio_x_evento`
  ADD PRIMARY KEY (`id_socio`,`id_evento`),
  ADD KEY `id_evento` (`id_evento`);

--
-- Indices de la tabla `solicitud_evento`
--
ALTER TABLE `solicitud_evento`
  ADD PRIMARY KEY (`id_solicitud_evento`);

--
-- Indices de la tabla `solicitud_exter_evento`
--
ALTER TABLE `solicitud_exter_evento`
  ADD PRIMARY KEY (`id_externo`),
  ADD KEY `id_evento` (`id_evento`),
  ADD KEY `id_solicitud_evento` (`id_solicitud_evento`);

--
-- Indices de la tabla `solicitud_ext_solo_si__socio`
--
ALTER TABLE `solicitud_ext_solo_si__socio`
  ADD PRIMARY KEY (`id_solicitud_soc`,`id_grupo`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- Indices de la tabla `solicitud_socio`
--
ALTER TABLE `solicitud_socio`
  ADD PRIMARY KEY (`id_solicitud_soc`);

--
-- Indices de la tabla `solicitud_socio_evento`
--
ALTER TABLE `solicitud_socio_evento`
  ADD PRIMARY KEY (`id_socio`,`id_evento`,`id_solicitud_evento`,`fecha`),
  ADD KEY `id_evento` (`id_evento`),
  ADD KEY `id_solicitud_evento` (`id_solicitud_evento`);

--
-- Indices de la tabla `Temp`
--
ALTER TABLE `Temp`
  ADD PRIMARY KEY (`id_temp`);

--
-- Indices de la tabla `Test`
--
ALTER TABLE `Test`
  ADD PRIMARY KEY (`id_test`);

--
-- Indices de la tabla `test_prueba`
--
ALTER TABLE `test_prueba`
  ADD PRIMARY KEY (`id_test`,`Id_prueba`),
  ADD KEY `Id_prueba` (`Id_prueba`);

--
-- Indices de la tabla `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `rol` (`rol`);

--
-- Indices de la tabla `usuario_x_temporada`
--
ALTER TABLE `usuario_x_temporada`
  ADD PRIMARY KEY (`id_temp`,`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Entrenador`
--
ALTER TABLE `Entrenador`
  MODIFY `id_entrenador` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `equipacion`
--
ALTER TABLE `equipacion`
  MODIFY `id_equipacion` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT de la tabla `Evento`
--
ALTER TABLE `Evento`
  MODIFY `id_evento` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `Externo`
--
ALTER TABLE `Externo`
  MODIFY `id_externo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `solicitud_socio`
--
ALTER TABLE `solicitud_socio`
  MODIFY `id_solicitud_soc` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `Test`
--
ALTER TABLE `Test`
  MODIFY `id_test` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categoria_socio`
--
ALTER TABLE `categoria_socio`
  ADD CONSTRAINT `categoria_socio_ibfk_1` FOREIGN KEY (`id_socio`) REFERENCES `Socio` (`id_socio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `categoria_socio_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `Categoria` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Entrenador`
--
ALTER TABLE `Entrenador`
  ADD CONSTRAINT `Entrenador_ibfk_1` FOREIGN KEY (`id_entrenador`) REFERENCES `User` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `entrenador_grupo`
--
ALTER TABLE `entrenador_grupo`
  ADD CONSTRAINT `entrenador_grupo_ibfk_1` FOREIGN KEY (`id_entrenador`) REFERENCES `Entrenador` (`id_entrenador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `entrenador_grupo_ibfk_2` FOREIGN KEY (`id_grupo`) REFERENCES `Grupo` (`id_grupo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `equipacion`
--
ALTER TABLE `equipacion`
  ADD CONSTRAINT `equipacion_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `User` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `equipacion_ibfk_2` FOREIGN KEY (`id_ingreso_cuota`) REFERENCES `I_cuotas` (`id_ingreso_cuota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `equipacion_ibfk_3` FOREIGN KEY (`id_gastos`) REFERENCES `G_Otros` (`id_gastos`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Evento`
--
ALTER TABLE `Evento`
  ADD CONSTRAINT `Evento_ibfk_1` FOREIGN KEY (`id_entrenador`) REFERENCES `Entrenador` (`id_entrenador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Externo`
--
ALTER TABLE `Externo`
  ADD CONSTRAINT `Externo_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `Evento` (`id_evento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `G_Otros`
--
ALTER TABLE `G_Otros`
  ADD CONSTRAINT `G_Otros_ibfk_1` FOREIGN KEY (`id_socio`) REFERENCES `Socio` (`id_socio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `G_Otros_ibfk_2` FOREIGN KEY (`Id_entidad`) REFERENCES `Otras_entidades` (`Id_entidad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `G_Personal`
--
ALTER TABLE `G_Personal`
  ADD CONSTRAINT `G_Personal_ibfk_1` FOREIGN KEY (`id_entrenador`) REFERENCES `Entrenador` (`id_entrenador`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `horario_grupo`
--
ALTER TABLE `horario_grupo`
  ADD CONSTRAINT `horario_grupo_ibfk_1` FOREIGN KEY (`id_grupo`) REFERENCES `Grupo` (`id_grupo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `horario_grupo_ibfk_2` FOREIGN KEY (`id_horario`) REFERENCES `horario` (`id_horario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Ing_Actividades`
--
ALTER TABLE `Ing_Actividades`
  ADD CONSTRAINT `Ing_Actividades_ibfk_1` FOREIGN KEY (`id_socio`) REFERENCES `Socio` (`id_socio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Ing_Actividades_ibfk_2` FOREIGN KEY (`id_evento`) REFERENCES `Evento` (`id_evento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Ing_Actividades_ibfk_3` FOREIGN KEY (`id_externo`) REFERENCES `Externo` (`id_externo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `I_cuotas`
--
ALTER TABLE `I_cuotas`
  ADD CONSTRAINT `I_cuotas_ibfk_1` FOREIGN KEY (`id_socio`) REFERENCES `Socio` (`id_socio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `I_otros`
--
ALTER TABLE `I_otros`
  ADD CONSTRAINT `I_otros_ibfk_1` FOREIGN KEY (`Id_entidad`) REFERENCES `Otras_entidades` (`Id_entidad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Licencia`
--
ALTER TABLE `Licencia`
  ADD CONSTRAINT `Licencia_ibfk_1` FOREIGN KEY (`id_socio`) REFERENCES `Socio` (`id_socio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prueba_socio`
--
ALTER TABLE `prueba_socio`
  ADD CONSTRAINT `prueba_socio_ibfk_1` FOREIGN KEY (`id_socio`) REFERENCES `Socio` (`id_socio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prueba_socio_ibfk_2` FOREIGN KEY (`Id_prueba`) REFERENCES `Prueba` (`Id_prueba`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Socio`
--
ALTER TABLE `Socio`
  ADD CONSTRAINT `Socio_ibfk_1` FOREIGN KEY (`id_socio`) REFERENCES `User` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Socio_ibfk_2` FOREIGN KEY (`familiar`) REFERENCES `Socio` (`id_socio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `socio_pertenece_grupo`
--
ALTER TABLE `socio_pertenece_grupo`
  ADD CONSTRAINT `socio_pertenece_grupo_ibfk_1` FOREIGN KEY (`id_socio`) REFERENCES `Socio` (`id_socio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `socio_pertenece_grupo_ibfk_2` FOREIGN KEY (`id_grupo`) REFERENCES `Grupo` (`id_grupo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `socio_x_evento`
--
ALTER TABLE `socio_x_evento`
  ADD CONSTRAINT `socio_x_evento_ibfk_1` FOREIGN KEY (`id_socio`) REFERENCES `Socio` (`id_socio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `socio_x_evento_ibfk_2` FOREIGN KEY (`id_evento`) REFERENCES `Evento` (`id_evento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `solicitud_exter_evento`
--
ALTER TABLE `solicitud_exter_evento`
  ADD CONSTRAINT `solicitud_exter_evento_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `Evento` (`id_evento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `solicitud_exter_evento_ibfk_2` FOREIGN KEY (`id_externo`) REFERENCES `Externo` (`id_externo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `solicitud_exter_evento_ibfk_3` FOREIGN KEY (`id_solicitud_evento`) REFERENCES `solicitud_evento` (`id_solicitud_evento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `solicitud_ext_solo_si__socio`
--
ALTER TABLE `solicitud_ext_solo_si__socio`
  ADD CONSTRAINT `solicitud_ext_solo_si__socio_ibfk_1` FOREIGN KEY (`id_grupo`) REFERENCES `Grupo` (`id_grupo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `solicitud_ext_solo_si__socio_ibfk_2` FOREIGN KEY (`id_solicitud_soc`) REFERENCES `solicitud_socio` (`id_solicitud_soc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `solicitud_socio_evento`
--
ALTER TABLE `solicitud_socio_evento`
  ADD CONSTRAINT `solicitud_socio_evento_ibfk_1` FOREIGN KEY (`id_socio`) REFERENCES `Socio` (`id_socio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `solicitud_socio_evento_ibfk_2` FOREIGN KEY (`id_evento`) REFERENCES `Evento` (`id_evento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `solicitud_socio_evento_ibfk_3` FOREIGN KEY (`id_solicitud_evento`) REFERENCES `solicitud_evento` (`id_solicitud_evento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `test_prueba`
--
ALTER TABLE `test_prueba`
  ADD CONSTRAINT `test_prueba_ibfk_1` FOREIGN KEY (`Id_prueba`) REFERENCES `Prueba` (`Id_prueba`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `test_prueba_ibfk_2` FOREIGN KEY (`id_test`) REFERENCES `Test` (`id_test`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `User`
--
ALTER TABLE `User`
  ADD CONSTRAINT `User_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `Rol` (`id_Rol`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_x_temporada`
--
ALTER TABLE `usuario_x_temporada`
  ADD CONSTRAINT `usuario_x_temporada_ibfk_1` FOREIGN KEY (`id_temp`) REFERENCES `Temp` (`id_temp`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_x_temporada_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `User` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
