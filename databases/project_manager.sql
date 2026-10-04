-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-10-2026 a las 16:41:23
-- Versión del servidor: 9.7.1
-- Versión de PHP: 8.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `project_manager`
--
CREATE DATABASE IF NOT EXISTS `project_manager` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `project_manager`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `homework`
--

CREATE TABLE `homework` (
  `id_tarea` int NOT NULL,
  `id_proyecto` int NOT NULL,
  `id_miembro` int NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `fecha_vencimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `members`
--

CREATE TABLE `members` (
  `id_miembro` int NOT NULL,
  `cedula` varchar(100) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `especialidad` varchar(150) DEFAULT NULL,
  `foto_personal` varchar(200) DEFAULT NULL,
  `registrado` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `members`
--

INSERT INTO `members` (`id_miembro`, `cedula`, `nombre`, `apellido`, `email`, `especialidad`, `foto_personal`, `registrado`) VALUES
(1, '29648370', 'Alejando Enrique 333', 'Cousin Rodriguez', 'ac2002@g', 'Investigador', '../assets/img/img_users/Opera Captura de pantalla_2025-02-20_151444_bonvoyage.com.ve.png', '2026-09-26 04:00:00'),
(2, '24300100', 'Jose', 'Carrizales', 'Carrizales@g', 'Desarrollador', '../assets/img/img_users/Captura de pantalla 2026-05-09 223057.png', '2026-09-27 17:06:00'),
(3, '24344334', 'Juan', 'Suarez', 'Asd432@gmail.com', 'Desarrollo', '../assets/img/img_users/Captura de pantalla 2025-01-28 150846.png', '2026-09-29 20:35:00'),
(4, '5435646', 'Daniel', 'Jordan', 'Dan_el@gmail.com', 'Mantenimiento', '../assets/img/img_users/Captura de pantalla 2026-05-09 222737.png', '2026-10-03 00:18:00'),
(5, '16644565', 'Saly', 'Soldado', 'sasol@gmail.com', 'Desarrollo', '../assets/img/img_users/Captura de pantalla 2026-05-10 161639.png', '2026-10-03 16:06:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `projects`
--

CREATE TABLE `projects` (
  `id_proyecto` int NOT NULL,
  `id_manager` int NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `descripcion` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `avance` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `imagen` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `categoria` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `objetivos` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `beneficiarios` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `requerimientos` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `estatus` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Por Ejecutar',
  `activo` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `projects`
--

INSERT INTO `projects` (`id_proyecto`, `id_manager`, `nombre`, `descripcion`, `avance`, `imagen`, `fecha_inicio`, `fecha_fin`, `categoria`, `objetivos`, `beneficiarios`, `requerimientos`, `estatus`, `activo`) VALUES
(1, 2, '12to proceso', 'Nuevo avance 24', '0', '../assets/img/img_proyect/copa-de-vino.jpg', '2026-09-14', '2026-10-10', 'Hardware 98', 'Colocar una foto', 'Desarrollo', '589 hojas', 'Por Ejecutar', 1),
(2, 2, '12to', 'Nuevo avance 9', '0', '../assets/img/img_proyect/Captura de pantalla 2026-06-19 194709.png', '2026-10-22', '2026-10-20', 'Hardware', 'Colocar una foto 978', 'Desarrollo 578989', '5676 hojas', 'Por Ejecutar', 1),
(3, 1, '98to proceso', 'Nuevo avance 578', '50', '../assets/img/img_proyect/Captura de pantalla 2026-05-09 223057.png', '2026-10-06', '2026-10-22', 'Hardware/Software', 'Colocar una actualización', 'Desarrollo', '543 hojas', 'Por Ejecutar', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `project_miembro`
--

CREATE TABLE `project_miembro` (
  `id_project_miembro` int NOT NULL,
  `id_proyecto` int NOT NULL,
  `id_miembro` int NOT NULL,
  `rol_proyecto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'cargo',
  `fecha_asignacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `project_miembro`
--

INSERT INTO `project_miembro` (`id_project_miembro`, `id_proyecto`, `id_miembro`, `rol_proyecto`, `fecha_asignacion`) VALUES
(3, 1, 2, 'Lider', '2026-09-30'),
(4, 2, 2, 'Lider', '2026-10-01'),
(5, 3, 1, 'Lider', '2026-10-01'),
(6, 1, 3, 'Ayudante', '2026-10-04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_usuario` int NOT NULL,
  `cedula` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password_hash` varchar(100) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `foto_personal` varchar(200) DEFAULT NULL,
  `estatus` varchar(100) NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_usuario`, `cedula`, `email`, `password_hash`, `fecha_creacion`, `foto_personal`, `estatus`) VALUES
(1, '29648370', 'ac2002@g', '12345678', '2026-09-26 04:00:00', '../assets/img/img_users/Opera Captura de pantalla_2025-02-20_151444_bonvoyage.com.ve.png', 'activo'),
(2, '24300100', 'Carrizales@g', '12345', '2026-09-27 17:06:00', '../assets/img/img_users/Captura de pantalla 2026-05-09 223057.png', 'activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `homework`
--
ALTER TABLE `homework`
  ADD PRIMARY KEY (`id_tarea`),
  ADD KEY `id_proyecto` (`id_proyecto`),
  ADD KEY `id_miembro` (`id_miembro`);

--
-- Indices de la tabla `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id_miembro`);

--
-- Indices de la tabla `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id_proyecto`),
  ADD KEY `id_manager` (`id_manager`);

--
-- Indices de la tabla `project_miembro`
--
ALTER TABLE `project_miembro`
  ADD PRIMARY KEY (`id_project_miembro`),
  ADD KEY `manager_project` (`id_proyecto`),
  ADD KEY `id_miembro` (`id_miembro`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `homework`
--
ALTER TABLE `homework`
  MODIFY `id_tarea` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `members`
--
ALTER TABLE `members`
  MODIFY `id_miembro` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `projects`
--
ALTER TABLE `projects`
  MODIFY `id_proyecto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `project_miembro`
--
ALTER TABLE `project_miembro`
  MODIFY `id_project_miembro` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_usuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `homework`
--
ALTER TABLE `homework`
  ADD CONSTRAINT `homework_ibfk_1` FOREIGN KEY (`id_proyecto`) REFERENCES `projects` (`id_proyecto`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `homework_ibfk_2` FOREIGN KEY (`id_miembro`) REFERENCES `members` (`id_miembro`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`id_manager`) REFERENCES `users` (`id_usuario`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `project_miembro`
--
ALTER TABLE `project_miembro`
  ADD CONSTRAINT `project_miembro_ibfk_1` FOREIGN KEY (`id_proyecto`) REFERENCES `projects` (`id_proyecto`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `project_miembro_ibfk_2` FOREIGN KEY (`id_miembro`) REFERENCES `members` (`id_miembro`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
