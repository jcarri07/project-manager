-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-10-2026 a las 02:00:10
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
-- Estructura de tabla para la tabla `projects`
--

CREATE TABLE `projects` (
  `id_proyecto` int NOT NULL,
  `id_unidad` int NOT NULL,
  `id_manager` int NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `descripcion` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `unidad` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `tipo` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `prioridad` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `solicitante` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `sponsor` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `presupuesto_est` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `problema` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `objetivos` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `beneficios` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `dimension` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `evaluacion` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `comentario` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `avance` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `estatus` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Por Ejecutar',
  `salud` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'En control',
  `activo` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `projects`
--

INSERT INTO `projects` (`id_proyecto`, `id_unidad`, `id_manager`, `nombre`, `descripcion`, `unidad`, `tipo`, `prioridad`, `solicitante`, `sponsor`, `fecha_inicio`, `fecha_fin`, `presupuesto_est`, `problema`, `objetivos`, `beneficios`, `dimension`, `evaluacion`, `comentario`, `avance`, `estatus`, `salud`, `activo`) VALUES
(1, 0, 2, '12to proceso', 'Nuevo avance 24', '', '', '', '', '', '2026-09-14', '2026-10-10', '', '', '', '', '', '', '', '0', 'Por Ejecutar', 'Critico', 1),
(2, 0, 2, '12to', 'Nuevo avance 9', '', '', '', '', '', '2026-10-22', '2026-10-20', '', '', '', '', '', '', '', '100', 'Completado', 'En riesgo', 0),
(3, 0, 1, '98to proceso', 'Nuevo avance 578', '', '', '', '', '', '2026-10-06', '2026-10-22', '', '', '', '', '', '', '', '50', 'En progreso', 'En control', 1),
(4, 0, 1, 'Nueva version', '', 'Desarrollo', 'Mantenimiento', 'Alta', '29648370', 'ABAE', '2026-10-05', '2026-10-21', '22442', 'Pocas pruebas', 'Ver los nuevos añadidos', 'Nuevos avances', '', '', '', '0', 'Propuesto', 'En control', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `projects_draft`
--

CREATE TABLE `projects_draft` (
  `id_draf_proy` int NOT NULL,
  `id_manager` int NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `descripcion` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `unidad` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tipo` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prioridad` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `solicitante` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sponsor` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `presupuesto_est` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `problema` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `objetivos` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `beneficios` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dimension` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `evaluacion` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `comentario` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `avance` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `estatus` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Por Ejecutar',
  `salud` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'En control',
  `activo` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `projects_draft`
--

INSERT INTO `projects_draft` (`id_draf_proy`, `id_manager`, `nombre`, `descripcion`, `unidad`, `tipo`, `prioridad`, `solicitante`, `sponsor`, `fecha_inicio`, `fecha_fin`, `presupuesto_est`, `problema`, `objetivos`, `beneficios`, `dimension`, `evaluacion`, `comentario`, `avance`, `estatus`, `salud`, `activo`) VALUES
(1, 1, 'Nueva version de borrador', 'Prueba de nueva tabla', 'Administración', 'Proyecto', 'Media', '29648370', 'ABAE', '2026-10-14', '2026-10-29', '74746', 'Nueva revisión', 'Verificar', 'Revisión', '', '', '', '0', 'Propuesto', 'En control', 1);

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
(6, 1, 3, 'Ayudante', '2026-10-04'),
(7, 4, 1, 'Lider', '2026-10-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `responsibility`
--

CREATE TABLE `responsibility` (
  `id_responsabilidad` int NOT NULL,
  `nombre_resp` varchar(255) DEFAULT NULL,
  `descripcion_resp` varchar(300) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_roles` int NOT NULL,
  `nombre_roles` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad`
--

CREATE TABLE `unidad` (
  `id_unidad` int NOT NULL,
  `nombre_unid` varchar(255) NOT NULL,
  `id_jefe_unid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `unidad`
--

INSERT INTO `unidad` (`id_unidad`, `nombre_unid`, `id_jefe_unid`) VALUES
(1, 'USMI', 1),
(2, 'UDLP', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_usuario` int NOT NULL,
  `id_user_type` int NOT NULL,
  `id_unidad` int NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `apellido` varchar(200) NOT NULL,
  `cedula` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `especialidad` varchar(200) NOT NULL,
  `password_hash` varchar(100) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `foto_personal` varchar(200) DEFAULT NULL,
  `estatus` varchar(100) NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_usuario`, `id_user_type`, `id_unidad`, `nombre`, `apellido`, `cedula`, `email`, `especialidad`, `password_hash`, `fecha_creacion`, `foto_personal`, `estatus`) VALUES
(1, 1, 1, '', '', '29648370', 'ac2002@g', '', '12345678', '2026-09-26 04:00:00', '../assets/img/img_users/Opera Captura de pantalla_2025-02-20_151444_bonvoyage.com.ve.png', 'activo'),
(2, 2, 2, '', '', '24300100', 'Carrizales@g', '', '12345', '2026-09-27 17:06:00', '../assets/img/img_users/Captura de pantalla 2026-05-09 223057.png', 'activo'),
(3, 1, 1, '', '', '28556231', 'miguelB@g', '', '1234567890', '2026-10-07 01:48:00', '../assets/img/img_users/Captura de pantalla 2026-05-09 223057.png', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_history`
--

CREATE TABLE `user_history` (
  `id_user_history` int NOT NULL,
  `id_usuario` int NOT NULL,
  `fecha` datetime NOT NULL,
  `descripcion` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_responsibility`
--

CREATE TABLE `user_responsibility` (
  `id_usuario_responsabilidad` int NOT NULL,
  `id_usuario` int NOT NULL,
  `id_responsabilidad` int NOT NULL,
  `fecha_asignado` datetime NOT NULL,
  `fecha_finalidad` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_type`
--

CREATE TABLE `user_type` (
  `id_user_type` int NOT NULL,
  `nombre_user_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `user_type`
--

INSERT INTO `user_type` (`id_user_type`, `nombre_user_type`) VALUES
(1, 'Director'),
(2, 'Jefe de Unidad'),
(3, 'Trabajador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_roles`
--

CREATE TABLE `usuario_roles` (
  `id_usuario_rol` int NOT NULL,
  `id_usuario` int NOT NULL,
  `id_rol` int NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `fecha_asignado` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
-- Indices de la tabla `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id_proyecto`),
  ADD KEY `id_manager` (`id_manager`);

--
-- Indices de la tabla `projects_draft`
--
ALTER TABLE `projects_draft`
  ADD PRIMARY KEY (`id_draf_proy`),
  ADD KEY `id_manager` (`id_manager`);

--
-- Indices de la tabla `project_miembro`
--
ALTER TABLE `project_miembro`
  ADD PRIMARY KEY (`id_project_miembro`),
  ADD KEY `manager_project` (`id_proyecto`),
  ADD KEY `id_miembro` (`id_miembro`);

--
-- Indices de la tabla `responsibility`
--
ALTER TABLE `responsibility`
  ADD PRIMARY KEY (`id_responsabilidad`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_roles`);

--
-- Indices de la tabla `unidad`
--
ALTER TABLE `unidad`
  ADD PRIMARY KEY (`id_unidad`),
  ADD KEY `id_jefe_unid` (`id_jefe_unid`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_user_type` (`id_user_type`),
  ADD KEY `id_unidad` (`id_unidad`);

--
-- Indices de la tabla `user_history`
--
ALTER TABLE `user_history`
  ADD PRIMARY KEY (`id_user_history`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `user_responsibility`
--
ALTER TABLE `user_responsibility`
  ADD PRIMARY KEY (`id_usuario_responsabilidad`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_responsabilidad` (`id_responsabilidad`);

--
-- Indices de la tabla `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id_user_type`);

--
-- Indices de la tabla `usuario_roles`
--
ALTER TABLE `usuario_roles`
  ADD PRIMARY KEY (`id_usuario_rol`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `homework`
--
ALTER TABLE `homework`
  MODIFY `id_tarea` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `projects`
--
ALTER TABLE `projects`
  MODIFY `id_proyecto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `projects_draft`
--
ALTER TABLE `projects_draft`
  MODIFY `id_draf_proy` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `project_miembro`
--
ALTER TABLE `project_miembro`
  MODIFY `id_project_miembro` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `responsibility`
--
ALTER TABLE `responsibility`
  MODIFY `id_responsabilidad` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_roles` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `unidad`
--
ALTER TABLE `unidad`
  MODIFY `id_unidad` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_usuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `user_history`
--
ALTER TABLE `user_history`
  MODIFY `id_user_history` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `user_responsibility`
--
ALTER TABLE `user_responsibility`
  MODIFY `id_usuario_responsabilidad` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id_user_type` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario_roles`
--
ALTER TABLE `usuario_roles`
  MODIFY `id_usuario_rol` int NOT NULL AUTO_INCREMENT;

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
-- Filtros para la tabla `projects_draft`
--
ALTER TABLE `projects_draft`
  ADD CONSTRAINT `projects_draft_ibfk_1` FOREIGN KEY (`id_manager`) REFERENCES `users` (`id_usuario`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `project_miembro`
--
ALTER TABLE `project_miembro`
  ADD CONSTRAINT `project_miembro_ibfk_1` FOREIGN KEY (`id_proyecto`) REFERENCES `projects` (`id_proyecto`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `project_miembro_ibfk_2` FOREIGN KEY (`id_miembro`) REFERENCES `members` (`id_miembro`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `unidad`
--
ALTER TABLE `unidad`
  ADD CONSTRAINT `unidad_ibfk_1` FOREIGN KEY (`id_jefe_unid`) REFERENCES `users` (`id_usuario`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_user_type`) REFERENCES `user_type` (`id_user_type`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`id_unidad`) REFERENCES `unidad` (`id_unidad`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `user_history`
--
ALTER TABLE `user_history`
  ADD CONSTRAINT `user_history_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id_usuario`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `user_responsibility`
--
ALTER TABLE `user_responsibility`
  ADD CONSTRAINT `user_responsibility_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id_usuario`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_responsibility_ibfk_2` FOREIGN KEY (`id_responsabilidad`) REFERENCES `responsibility` (`id_responsabilidad`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `usuario_roles`
--
ALTER TABLE `usuario_roles`
  ADD CONSTRAINT `usuario_roles_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id_usuario`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `usuario_roles_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_roles`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
