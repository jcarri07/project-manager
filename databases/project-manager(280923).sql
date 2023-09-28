-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-09-2023 a las 18:34:31
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `project_manager`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `project_managers`
--

CREATE TABLE `project_managers` (
  `id` int(11) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `project_managers`
--

INSERT INTO `project_managers` (`id`, `project_id`, `nombres`, `apellidos`, `cargo`, `foto`, `unidad`, `cedula`, `email`, `movil`, `estatus`, `info`, `password`) VALUES
(1, 2, 'Jose Franzue', 'Carrizales', 'Personal Cientifico', 'foto', 'UDLP', '24642009', 'carrizalesj5@gmail.com', '04144001564', 'activo', NULL, '123456');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `project_managers`
--
ALTER TABLE `project_managers`
  ADD PRIMARY KEY (`id`,`cedula`),
  ADD KEY `manager_project` (`project_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `project_managers`
--
ALTER TABLE `project_managers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
