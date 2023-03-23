-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-03-2023 a las 20:31:30
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `project-manager`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `members`
--

CREATE TABLE `members` (
  `member_id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `nombres` varchar(50) DEFAULT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `cargo` varchar(50) DEFAULT NULL,
  `jefe` varchar(50) DEFAULT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `unidad` varchar(50) DEFAULT NULL,
  `cedula` varchar(11) NOT NULL,
  `movil` varchar(11) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `info` varchar(200) DEFAULT NULL,
  `estatus` enum('activo','inactivo') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `projects`
--

CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `avance` varchar(50) DEFAULT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `objetivos` varchar(200) DEFAULT NULL,
  `beneficiarios` varchar(200) DEFAULT NULL,
  `requerimientos` varchar(200) DEFAULT NULL,
  `estatus` varchar(50) DEFAULT 'por_ejecutar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `projects`
--

INSERT INTO `projects` (`project_id`, `nombre`, `descripcion`, `avance`, `imagen`, `fecha_inicio`, `fecha_fin`, `categoria`, `objetivos`, `beneficiarios`, `requerimientos`, `estatus`) VALUES
(1, 'Proyecto 1', 'Descripcion', '65', NULL, '2023-03-21', '2023-03-23', 'Categoria', 'Obectivos', 'Beneficiarios', 'Requerimientos', 'por_ejecutar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `project_managers`
--

CREATE TABLE `project_managers` (
  `manager_id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `nombres` varchar(50) DEFAULT 'name',
  `apellidos` varchar(50) DEFAULT 'lastname',
  `cargo` varchar(20) DEFAULT 'cargo',
  `foto` varchar(200) DEFAULT 'foto',
  `unidad` varchar(50) DEFAULT 'unidad',
  `cedula` varchar(11) NOT NULL DEFAULT '000000',
  `email` varchar(100) DEFAULT 'correo@gmail.com',
  `movil` varchar(20) DEFAULT '04100000',
  `estatus` enum('activo','inactivo') DEFAULT 'activo',
  `info` varchar(100) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `project_managers`
--

INSERT INTO `project_managers` (`manager_id`, `project_id`, `nombres`, `apellidos`, `cargo`, `foto`, `unidad`, `cedula`, `email`, `movil`, `estatus`, `info`, `password`) VALUES
(1, NULL, 'Jose Franzue', 'Carrizales', 'Personal Cientifico', 'foto', 'UDLP', '24642009', 'carrizalesj5@gmail.com', '04144001564', 'activo', NULL, '123456');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`,`cedula`);

--
-- Indices de la tabla `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`);

--
-- Indices de la tabla `project_managers`
--
ALTER TABLE `project_managers`
  ADD PRIMARY KEY (`manager_id`,`cedula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `project_managers`
--
ALTER TABLE `project_managers`
  MODIFY `manager_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `member_project` FOREIGN KEY (`member_id`) REFERENCES `projects` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `project_projectManager` FOREIGN KEY (`project_id`) REFERENCES `project_managers` (`manager_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `project_managers`
--
ALTER TABLE `project_managers`
  ADD CONSTRAINT `manager_project` FOREIGN KEY (`manager_id`) REFERENCES `projects` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
