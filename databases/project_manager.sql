-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-11-2026 a las 21:50:15
-- Versión del servidor: 9.7.1
-- Versión de PHP: 8.5.12

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
-- Estructura de tabla para la tabla `projects`
--

CREATE TABLE `projects` (
  `id_proyecto` int NOT NULL,
  `id_solicitante` int NOT NULL,
  `id_manager` int NOT NULL,
  `id_validador` int NOT NULL DEFAULT '0',
  `id_aprobador` int NOT NULL DEFAULT '0',
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `descripcion` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `unidad` int NOT NULL,
  `tipo` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prioridad` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sponsor` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `presupuesto_est` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `problema` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `objetivos` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `beneficios` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tecnica` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `operativa` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `financiera` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `organizacional` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `areas_impacto` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nivel_impacto` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `observaciones_eval` varchar(300) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `duracion_estimada` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `recursos_requeridos` varchar(300) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `justificacion_eval` varchar(300) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `avance` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `estatus` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Por Ejecutar',
  `salud` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'En control',
  `decision_dir` varchar(200) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Por asignar',
  `justificacion_dir` varchar(300) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'En revisión ',
  `activo` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `projects`
--

INSERT INTO `projects` (`id_proyecto`, `id_solicitante`, `id_manager`, `id_validador`, `id_aprobador`, `nombre`, `descripcion`, `unidad`, `tipo`, `prioridad`, `sponsor`, `fecha_inicio`, `fecha_fin`, `presupuesto_est`, `problema`, `objetivos`, `beneficios`, `tecnica`, `operativa`, `financiera`, `organizacional`, `areas_impacto`, `nivel_impacto`, `observaciones_eval`, `duracion_estimada`, `recursos_requeridos`, `justificacion_eval`, `avance`, `estatus`, `salud`, `decision_dir`, `justificacion_dir`, `activo`) VALUES
(1, 1, 0, 2, 0, '12to proceso', 'Nuevo avance 24', 1, 'Proyecto', 'Baja', 'ABAE', '2026-09-14', '2026-10-10', '77', '8', 'Ingreso', 'Ingreso', 'No viable', 'No viable', 'No viable', 'USMI', 'UDLP', 'Crítica', 'tttt', '8 meses', 'gg', 'y', '0', 'Cancelado', 'Critico', '2', 'Falta información', 1),
(2, 2, 2, 0, 1, '12to', 'Nuevo avance 19', 2, 'Proyecto', 'Alta', 'ABAE', '2026-10-22', '2026-10-20', '44747', 'Trabajo', 'Funciona', 'Funciona', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100', 'Evaluacion', 'En control', 'Por asignar', 'En revisión ', 1),
(3, 1, 0, 2, 0, '98to proceso', 'Nuevo avance 578', 2, 'Proyecto', 'Media', 'ABAE', '2026-10-06', '2026-10-22', '7', '1', '22', '333', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '50', 'Planificacion', 'En control', '1', 'Cumple', 1),
(4, 1, 2, 2, 1, 'Nueva version', 'Nueva proyecto', 1, 'Mantenimiento', 'Alta', 'ABAE', '2026-10-05', '2026-10-21', '22442', 'Pocas pruebas', 'Ver los nuevos añadidos', 'Nuevos avances', 'No viable', 'Viable', 'Intermedio', 'USMI', 'UDLP', 'Crítica', 'Prueba de evaluación', '3 meses', 'Prueba 2002', 'En desarrollo 1999', '0', 'Planificacion', 'En control', 'Por asignar', 'En revisión ', 1),
(5, 1, 0, 0, 0, 'Practica de cambios', 'afffafffa', 1, 'Mantenimiento', 'Media', 'ABAE', '2026-10-13', '2026-10-30', '255', 'affaff', 'adffg', 'faff', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Planificacion', 'En control', 'Por asignar', 'En revisión ', 1),
(6, 1, 5, 0, 0, 'Nueva version de borrador', 'Prueba de nueva tabla', 2, 'Proyecto', 'Media', 'ABAE', '2026-10-14', '2026-10-29', '74746', 'Nueva revisión', 'Verificar', 'Revisión', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Planificacion', 'Critico', '1', '', 1),
(7, 1, 0, 0, 0, 'Practica 8', 'dadadadadad', 2, 'Mantenimiento', 'Media', 'ABAE', '2026-10-07', '2026-11-07', '2424', 'rwrrwr', '31331', '42424', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Propuesto', 'En control', 'Por asignar', 'En revisión ', 1),
(8, 1, 0, 0, 0, 'Ingreso 7', 'ffffffffff', 2, 'Mantenimiento', 'Crítica', 'ABAE', '2026-07-26', '2026-10-28', '5787', 'sdggd', 'etyg', 'tyuhb', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Aprobacion', 'En control', 'Por asignar', 'En revisión ', 1),
(9, 4, 0, 1, 0, 'Ingreso trabajador', 'sfsfsf', 1, 'Mantenimiento y Revisión', 'Media', 'ABAE', '2026-10-05', '2026-10-29', '4443', 'srwr', 'wrr', 'wrr', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Aprobacion', 'En control', 'Por asignar', 'En revisión ', 1),
(10, 1, 0, 0, 0, 'Practica tecnica', 'Prueba en la oficina', 2, 'Mantenimiento', 'Baja', 'ABAE', '2026-10-14', '2026-10-29', '856', 'Practica', 'Funcionamiento', 'Modulo 1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Propuesto', 'Critico', 'Por asignar', 'En revisión ', 1),
(11, 1, 0, 0, 0, 'Practica tecnica 2', 'Prueba de ingreso', 1, 'Reparación', 'Baja', 'ABAE', '2026-10-29', '2026-10-23', '754', 'Prueba de funcionamiento', 'Ver avance', 'Modulo 1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Propuesto', 'En control', 'Por asignar', 'En revisión ', 1),
(12, 4, 0, 2, 0, 'Proyecto trabajador', 'Prueba de la pagina 2', 1, 'Proyecto', 'Alta', 'ABAE', '2026-10-08', '2026-10-15', '434', 'Practica de usuario', 'Prueba', 'Prueba', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Evaluacion', 'En control', 'Por asignar', 'En revisión ', 1),
(13, 1, 0, 0, 0, 'Select', 'Multiple', 1, 'Proyecto', 'Baja', 'ABAE', '2026-10-13', '2026-10-16', '634', 'Prueba', 'Prueba', 'Prueba', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Evaluacion', 'En control', 'Por asignar', 'En revisión ', 1),
(14, 1, 0, 2, 0, 'Select Admid', 'hrhr', 2, 'Mantenimiento', 'Baja', 'ABAE', '2026-10-01', '2026-10-23', '37', 'tww', 'yyy', 'yyy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Evaluacion', 'En control', 'Por asignar', 'En revisión ', 1),
(15, 4, 0, 0, 0, 'Ingreso nuevo select', 'Nuevas mejoras no', 1, 'Reparación', 'Baja', 'ABAE', '2026-10-07', '2026-10-21', '3313', 'jsddd', 'dssdd', 'dssdd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Planificacion', 'En control', 'Por asignar', 'En revisión ', 1),
(16, 4, 0, 2, 0, 'Ingreso de la nueva versión', 'Otra prueba', 1, 'Proyecto', 'Alta', 'ABAE', '2026-10-15', '2026-11-07', '766881', 'Uno y medio', 'Dos', 'Dos', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Planificacion', 'En control', '1', 'Aceptable', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `projects_risk`
--

CREATE TABLE `projects_risk` (
  `id_projects_risk` int NOT NULL,
  `id_proyecto` int NOT NULL,
  `id_risk` int NOT NULL,
  `estado_risk` varchar(100) NOT NULL DEFAULT 'Abierto',
  `responsable_risk` varchar(100) NOT NULL DEFAULT 'Sin asignar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `projects_risk`
--

INSERT INTO `projects_risk` (`id_projects_risk`, `id_proyecto`, `id_risk`, `estado_risk`, `responsable_risk`) VALUES
(1, 4, 10, 'Abierto', 'Sin asignar'),
(2, 4, 14, 'Abierto', 'Sin asignar'),
(3, 4, 15, 'Abierto', 'Sin asignar'),
(4, 4, 16, 'Abierto', 'Sin asignar'),
(5, 1, 1, 'Abierto', 'Sin asignar'),
(6, 1, 2, 'Abierto', 'Sin asignar'),
(7, 4, 3, 'Identificados', 'Miguel Bencomo'),
(8, 4, 11, 'Identificados', 'Miguel Bencomo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `project_activities`
--

CREATE TABLE `project_activities` (
  `id_project_activities` int NOT NULL,
  `id_project_plans` int DEFAULT NULL,
  `nombre_actividad` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `descripcion_actividad` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fecha_inicio_plan_actividad` datetime DEFAULT NULL,
  `fecha_fin_plan_actividad` datetime DEFAULT NULL,
  `duracion_actividad` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `estado_actividad` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `observaciones_actividad` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fecha_creacion_actividad` datetime DEFAULT NULL,
  `fecha_modificacion_actividad` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `project_activity_dependencies`
--

CREATE TABLE `project_activity_dependencies` (
  `id_project_activity_dependencies` int NOT NULL,
  `id_project_activities` int NOT NULL,
  `id_project_activities_previous` int DEFAULT NULL,
  `tipo_dependencia` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `desfase_dias` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
-- Estructura de tabla para la tabla `project_plans`
--

CREATE TABLE `project_plans` (
  `id_project_plans` int NOT NULL,
  `id_proyecto` int NOT NULL,
  `n_version_mayor` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `n_version_menor` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `estado_plan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `resumen_ejecutivo` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `alcance_incluido` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `alcance_excluido` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `supuestos` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `restricciones` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `dependencias_externas` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fecha_inicio_plan` datetime DEFAULT NULL,
  `fecha_fin_plan` datetime DEFAULT NULL,
  `frecuencia_seguimiento` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `indicadores_seguimiento` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_responsable_reporte` int DEFAULT NULL,
  `recomendacion_manager` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_project_manager` int DEFAULT NULL,
  `fecha_creacion_plan` datetime DEFAULT NULL,
  `fecha_modificacion_plan` datetime DEFAULT NULL,
  `fecha_envio_revision_plan` datetime DEFAULT NULL,
  `fecha_validacion_plan` datetime DEFAULT NULL,
  `fecha_autorizacion_plan` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `project_plans`
--

INSERT INTO `project_plans` (`id_project_plans`, `id_proyecto`, `n_version_mayor`, `n_version_menor`, `estado_plan`, `resumen_ejecutivo`, `alcance_incluido`, `alcance_excluido`, `supuestos`, `restricciones`, `dependencias_externas`, `fecha_inicio_plan`, `fecha_fin_plan`, `frecuencia_seguimiento`, `indicadores_seguimiento`, `id_responsable_reporte`, `recomendacion_manager`, `id_project_manager`, `fecha_creacion_plan`, `fecha_modificacion_plan`, `fecha_envio_revision_plan`, `fecha_validacion_plan`, `fecha_autorizacion_plan`) VALUES
(1, 4, '1', '0', 'Propuesto', 'svssdd', 'hola', NULL, 'sdds', 'ffff', 'ssss', '2026-11-18 00:00:00', '2026-12-01 00:00:00', NULL, NULL, NULL, NULL, 2, '2026-11-14 18:47:00', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `project_plans_assumptions`
--

CREATE TABLE `project_plans_assumptions` (
  `id_project_plans_assumptions` int NOT NULL,
  `id_proyecto` int NOT NULL,
  `id_project_plan` int NOT NULL,
  `nombre_supuesto` varchar(100) NOT NULL,
  `descripcion_supuesto` varchar(300) NOT NULL,
  `impacto_supuestos` varchar(300) NOT NULL,
  `estado_supuestos` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `project_plans_assumptions`
--

INSERT INTO `project_plans_assumptions` (`id_project_plans_assumptions`, `id_proyecto`, `id_project_plan`, `nombre_supuesto`, `descripcion_supuesto`, `impacto_supuestos`, `estado_supuestos`) VALUES
(1, 4, 1, 'Hay sobre recursos', 'Hay exceso de materiales', 'Disponibilidad de equipo', 'Vigente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `project_plans_milestones`
--

CREATE TABLE `project_plans_milestones` (
  `id_project_plans_milestones` int NOT NULL,
  `id_project_plans` int NOT NULL,
  `nombre_hitos` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `descripcion_hitos` varchar(300) NOT NULL,
  `fecha_hito` datetime NOT NULL,
  `estado_hito` varchar(100) NOT NULL DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `project_plans_milestones`
--

INSERT INTO `project_plans_milestones` (`id_project_plans_milestones`, `id_project_plans`, `nombre_hitos`, `descripcion_hitos`, `fecha_hito`, `estado_hito`) VALUES
(1, 1, 'Modal funcional', 'Segundo modal listo', '2026-11-02 00:00:00', 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `project_plans_restriction`
--

CREATE TABLE `project_plans_restriction` (
  `project_plans_restriction` int NOT NULL,
  `id_proyecto` int NOT NULL,
  `id_project_plan` int NOT NULL,
  `nombre_restriccion` varchar(100) NOT NULL,
  `descripcion_restriccion` varchar(300) NOT NULL,
  `impacto_restriccion` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `project_plans_restriction`
--

INSERT INTO `project_plans_restriction` (`project_plans_restriction`, `id_proyecto`, `id_project_plan`, `nombre_restriccion`, `descripcion_restriccion`, `impacto_restriccion`) VALUES
(1, 4, 1, 'Sin almacén', 'Falta una recamara', 'Aumenta la inseguridad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `project_plan_budgets`
--

CREATE TABLE `project_plan_budgets` (
  `id_project_plan_budgets` int NOT NULL,
  `id_project_plans` int NOT NULL,
  `categoria_presupuesto` varchar(100) NOT NULL,
  `descripcion_presupuesto` varchar(300) NOT NULL,
  `monto_presupuesto` varchar(100) NOT NULL,
  `porcentaje_presupuesto` varchar(100) NOT NULL,
  `valor_total_presupuesto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `project_plan_budgets`
--

INSERT INTO `project_plan_budgets` (`id_project_plan_budgets`, `id_project_plans`, `categoria_presupuesto`, `descripcion_presupuesto`, `monto_presupuesto`, `porcentaje_presupuesto`, `valor_total_presupuesto`) VALUES
(1, 1, 'Recurso humano', 'Personal util', '343.36', '1.53', '22442');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `project_plan_deliverables`
--

CREATE TABLE `project_plan_deliverables` (
  `id_project_deliverables` int NOT NULL,
  `id_project_plans` int NOT NULL,
  `nombre_entregable` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `descripcion_entregable` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `criterio_aceptacion_entregable` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_user_responsable` int NOT NULL,
  `fecha_objetivo_entregable` date NOT NULL,
  `estado_entregable` varchar(100) NOT NULL DEFAULT 'Pendiente',
  `fecha_creacion_entregable` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `project_plan_deliverables`
--

INSERT INTO `project_plan_deliverables` (`id_project_deliverables`, `id_project_plans`, `nombre_entregable`, `descripcion_entregable`, `criterio_aceptacion_entregable`, `id_user_responsable`, `fecha_objetivo_entregable`, `estado_entregable`, `fecha_creacion_entregable`) VALUES
(1, 1, 'Gato', 'Herramienta de taller', 'Es importante', 2, '2026-11-19', 'Pendiente', '2026-11-23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `project_plan_resources`
--

CREATE TABLE `project_plan_resources` (
  `id_project_resources` int NOT NULL,
  `id_project_plans` int NOT NULL,
  `tipo_recurso` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `descripcion_recurso` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `cantidad_recurso` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `periodo_recurso` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_responsable_recurso` int DEFAULT NULL,
  `disponibilidad_recurso` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `project_plan_resources`
--

INSERT INTO `project_plan_resources` (`id_project_resources`, `id_project_plans`, `tipo_recurso`, `descripcion_recurso`, `cantidad_recurso`, `periodo_recurso`, `id_responsable_recurso`, `disponibilidad_recurso`) VALUES
(1, 1, 'Humano', 'Personal', '2 personas', '2 dias', 3, 'Confirmados');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `project_plan_reviews`
--

CREATE TABLE `project_plan_reviews` (
  `id_project_plan_reviews` int NOT NULL,
  `id_project_plans` int NOT NULL,
  `id_user_reviews` int NOT NULL,
  `accion_reseña` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `observaciones_reseña` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fecha_reseña` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
-- Estructura de tabla para la tabla `risk`
--

CREATE TABLE `risk` (
  `id_risk` int NOT NULL,
  `riesgo` varchar(300) DEFAULT NULL,
  `probabilidad` varchar(300) DEFAULT NULL,
  `impacto` varchar(300) DEFAULT NULL,
  `nivel_risk` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `acciones` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `risk`
--

INSERT INTO `risk` (`id_risk`, `riesgo`, `probabilidad`, `impacto`, `nivel_risk`, `acciones`) VALUES
(1, 'Retraso en el cronograma de actividades.', 'Alta', 'Alta', 'Alta', 'Establecer fechas de control, supervisar avances y reorganizar las actividades pendientes.'),
(2, 'Falta de presupuesto', 'Media', 'Bajo', 'Alta', 'Investigar alternativas de financiamiento'),
(3, 'Insuficiencia de presupuesto para completar el proyecto.', 'Media', 'Alta', 'Alta', 'Revisar los costos, priorizar actividades y gestionar recursos financieros adicionales.'),
(4, 'Falta de personal técnico especializado.', 'Media', 'Alta', 'Alta', 'Identificar las competencias necesarias, capacitar al personal o contratar especialistas.'),
(5, 'Cambios frecuentes en los requerimientos del proyecto.', 'Alta', 'Alta', 'Alta', 'Establecer un alcance definido y formalizar cualquier solicitud de cambio.'),
(6, 'Fallas en equipos, herramientas o infraestructura.', 'Media', 'Alta', 'Alta', 'Realizar mantenimiento preventivo, disponer de equipos de respaldo y establecer protocolos de contingencia.'),
(7, 'Retraso en la adquisición de materiales o equipos.', 'Media', 'Media', 'Alta', 'Planificar las compras con anticipación, evaluar proveedores alternativos y hacer seguimiento a los pedidos.'),
(8, 'Falta de comunicación entre los integrantes del equipo.', 'Media', 'Alta', 'Alta', 'Establecer canales oficiales de comunicación, reuniones periódicas y responsables por actividad.'),
(9, 'Bajo rendimiento o incumplimiento de responsabilidades del personal.', 'Media', 'Media', 'Media', 'Definir responsabilidades, establecer indicadores de desempeño y realizar evaluaciones periódicas.'),
(10, 'Problemas técnicos durante la implementación.', 'Media', 'Alta', 'Media', 'Realizar pruebas preliminares, documentar procedimientos y disponer de un plan de contingencia.'),
(11, 'Resultados que no cumplen con los requisitos establecidos.', 'Media', 'Alta', 'Media', 'Definir criterios de aceptación, ejecutar controles de calidad y realizar pruebas de validación.'),
(12, 'Dependencia de proveedores externos.', 'Media', 'Alta', 'Media', 'Identificar proveedores alternativos, establecer acuerdos de servicio y supervisar los tiempos de entrega.'),
(13, 'Falta de aprobación o autorización para continuar con el proyecto.', 'Media', 'Alta', 'Media', 'Identificar a los responsables de aprobación, presentar la documentación requerida y realizar seguimiento a las solicitudes.'),
(14, 'Pérdida o corrupción de información del proyecto.', 'Baja', 'Alta', 'Media', 'Implementar copias de seguridad, controlar los accesos y establecer procedimientos de recuperación.'),
(15, 'Accidentes laborales o incidentes durante la ejecución.', 'Baja', 'Alta', 'Media', 'Aplicar protocolos de seguridad, capacitar al personal y suministrar los equipos de protección necesarios.'),
(16, 'Condiciones externas que afectan la ejecución del proyecto.', 'Media', 'Media', 'Baja', 'Identificar factores externos, monitorear su evolución y preparar alternativas de ejecución.'),
(17, 'Falta de seguimiento y supervisión del proyecto.', 'Media', 'Alta', 'Media', 'Establecer reuniones de seguimiento, informes periódicos e indicadores de avance.'),
(18, 'Conflictos entre las áreas involucradas.', 'Media', 'Media', 'Baja', 'Definir responsables, establecer acuerdos de trabajo y gestionar oportunamente los desacuerdos.'),
(19, 'Entrega de resultados fuera de los estándares de calidad.', 'Media', 'Alta', 'Baja', 'Aplicar controles de calidad, inspecciones y pruebas antes de la entrega final.'),
(20, 'Equipo quemado', 'Baja', 'Alta', 'Baja', 'Solicitar equipo nuevo.');

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
  `nombre_user` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `apellido_user` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
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

INSERT INTO `users` (`id_usuario`, `id_user_type`, `id_unidad`, `nombre_user`, `apellido_user`, `cedula`, `email`, `especialidad`, `password_hash`, `fecha_creacion`, `foto_personal`, `estatus`) VALUES
(1, 1, 1, 'Alejandro Enrique', 'Cousin Rodriguez', '29648370', 'ac2002@g', 'Mantenimiento', '12345678', '2026-09-26 04:00:00', '../assets/img/img_users/Captura de pantalla 2025-01-28 150903.png', 'activo'),
(2, 2, 2, 'Jose', 'Carrizales', '24300100', 'Carrizales@g', 'Desarrollador', '12345', '2026-09-27 17:06:00', '../assets/img/img_users/Captura de pantalla 2026-05-09 223057.png', 'activo'),
(3, 3, 1, 'Miguel', 'Bencomo', '28556231', 'miguelB@g', 'Modelado', '1234567890', '2026-10-07 01:48:00', '../assets/img/img_users/Captura de pantalla 2026-05-09 223057.png', 'activo'),
(4, 3, 1, 'Alfredo', 'Calderon', '28654133', 'calderon@gmail.com', 'Desarrollo', '123', '2026-10-17 22:15:00', '../assets/img/img_users/avionRojos.png', 'activo'),
(5, 2, 2, 'Karla', 'Mieres', '28043244', 'karla@gmail.com', 'Mecanica', '123456', '2026-10-18 23:31:00', '../assets/img/img_users/textu_uco.png', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_projects`
--

CREATE TABLE `users_projects` (
  `id_users_projects` int NOT NULL,
  `id_projects` int NOT NULL,
  `id_autor_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `users_projects`
--

INSERT INTO `users_projects` (`id_users_projects`, `id_projects`, `id_autor_user`) VALUES
(2, 14, 5),
(3, 15, 2),
(6, 14, 3),
(8, 16, 5),
(9, 12, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_project_activities`
--

CREATE TABLE `users_project_activities` (
  `id_users_project_activities` int NOT NULL,
  `id_users` int NOT NULL,
  `id_project_activities` int NOT NULL,
  `id_project_plans` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
-- Indices de la tabla `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id_proyecto`),
  ADD KEY `id_solicitante` (`id_solicitante`),
  ADD KEY `unidad` (`unidad`);

--
-- Indices de la tabla `projects_risk`
--
ALTER TABLE `projects_risk`
  ADD PRIMARY KEY (`id_projects_risk`),
  ADD KEY `id_proyecto` (`id_proyecto`),
  ADD KEY `id_risk` (`id_risk`);

--
-- Indices de la tabla `project_activities`
--
ALTER TABLE `project_activities`
  ADD PRIMARY KEY (`id_project_activities`);

--
-- Indices de la tabla `project_activity_dependencies`
--
ALTER TABLE `project_activity_dependencies`
  ADD PRIMARY KEY (`id_project_activity_dependencies`),
  ADD KEY `id_project_activities` (`id_project_activities`);

--
-- Indices de la tabla `project_miembro`
--
ALTER TABLE `project_miembro`
  ADD PRIMARY KEY (`id_project_miembro`),
  ADD KEY `manager_project` (`id_proyecto`),
  ADD KEY `id_miembro` (`id_miembro`);

--
-- Indices de la tabla `project_plans`
--
ALTER TABLE `project_plans`
  ADD PRIMARY KEY (`id_project_plans`),
  ADD KEY `id_proyecto` (`id_proyecto`),
  ADD KEY `id_project_manager` (`id_project_manager`);

--
-- Indices de la tabla `project_plans_assumptions`
--
ALTER TABLE `project_plans_assumptions`
  ADD PRIMARY KEY (`id_project_plans_assumptions`),
  ADD KEY `id_proyecto` (`id_proyecto`),
  ADD KEY `id_project_plan` (`id_project_plan`);

--
-- Indices de la tabla `project_plans_milestones`
--
ALTER TABLE `project_plans_milestones`
  ADD PRIMARY KEY (`id_project_plans_milestones`),
  ADD KEY `id_project_plans` (`id_project_plans`);

--
-- Indices de la tabla `project_plans_restriction`
--
ALTER TABLE `project_plans_restriction`
  ADD PRIMARY KEY (`project_plans_restriction`),
  ADD KEY `id_proyecto` (`id_proyecto`),
  ADD KEY `id_project_plan` (`id_project_plan`);

--
-- Indices de la tabla `project_plan_budgets`
--
ALTER TABLE `project_plan_budgets`
  ADD PRIMARY KEY (`id_project_plan_budgets`),
  ADD KEY `id_project_plans` (`id_project_plans`);

--
-- Indices de la tabla `project_plan_deliverables`
--
ALTER TABLE `project_plan_deliverables`
  ADD PRIMARY KEY (`id_project_deliverables`),
  ADD KEY `id_project_plans` (`id_project_plans`),
  ADD KEY `id_user_responsable` (`id_user_responsable`);

--
-- Indices de la tabla `project_plan_resources`
--
ALTER TABLE `project_plan_resources`
  ADD PRIMARY KEY (`id_project_resources`),
  ADD KEY `id_project_plans` (`id_project_plans`),
  ADD KEY `id_responsable_recurso` (`id_responsable_recurso`);

--
-- Indices de la tabla `project_plan_reviews`
--
ALTER TABLE `project_plan_reviews`
  ADD PRIMARY KEY (`id_project_plan_reviews`),
  ADD KEY `id_project_plans` (`id_project_plans`),
  ADD KEY `id_user_reviews` (`id_user_reviews`);

--
-- Indices de la tabla `responsibility`
--
ALTER TABLE `responsibility`
  ADD PRIMARY KEY (`id_responsabilidad`);

--
-- Indices de la tabla `risk`
--
ALTER TABLE `risk`
  ADD PRIMARY KEY (`id_risk`);

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
-- Indices de la tabla `users_projects`
--
ALTER TABLE `users_projects`
  ADD PRIMARY KEY (`id_users_projects`) USING BTREE,
  ADD KEY `id_projects` (`id_projects`),
  ADD KEY `id_autor_user` (`id_autor_user`);

--
-- Indices de la tabla `users_project_activities`
--
ALTER TABLE `users_project_activities`
  ADD PRIMARY KEY (`id_users_project_activities`),
  ADD KEY `id_users` (`id_users`),
  ADD KEY `id_project_plans` (`id_project_plans`),
  ADD KEY `id_project_activities` (`id_project_activities`);

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
-- AUTO_INCREMENT de la tabla `projects`
--
ALTER TABLE `projects`
  MODIFY `id_proyecto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `projects_risk`
--
ALTER TABLE `projects_risk`
  MODIFY `id_projects_risk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `project_activities`
--
ALTER TABLE `project_activities`
  MODIFY `id_project_activities` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `project_activity_dependencies`
--
ALTER TABLE `project_activity_dependencies`
  MODIFY `id_project_activity_dependencies` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `project_miembro`
--
ALTER TABLE `project_miembro`
  MODIFY `id_project_miembro` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `project_plans`
--
ALTER TABLE `project_plans`
  MODIFY `id_project_plans` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `project_plans_assumptions`
--
ALTER TABLE `project_plans_assumptions`
  MODIFY `id_project_plans_assumptions` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `project_plans_milestones`
--
ALTER TABLE `project_plans_milestones`
  MODIFY `id_project_plans_milestones` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `project_plans_restriction`
--
ALTER TABLE `project_plans_restriction`
  MODIFY `project_plans_restriction` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `project_plan_budgets`
--
ALTER TABLE `project_plan_budgets`
  MODIFY `id_project_plan_budgets` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `project_plan_deliverables`
--
ALTER TABLE `project_plan_deliverables`
  MODIFY `id_project_deliverables` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `project_plan_resources`
--
ALTER TABLE `project_plan_resources`
  MODIFY `id_project_resources` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `project_plan_reviews`
--
ALTER TABLE `project_plan_reviews`
  MODIFY `id_project_plan_reviews` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `responsibility`
--
ALTER TABLE `responsibility`
  MODIFY `id_responsabilidad` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `risk`
--
ALTER TABLE `risk`
  MODIFY `id_risk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
  MODIFY `id_usuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `users_projects`
--
ALTER TABLE `users_projects`
  MODIFY `id_users_projects` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `users_project_activities`
--
ALTER TABLE `users_project_activities`
  MODIFY `id_users_project_activities` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- Filtros para la tabla `projects_risk`
--
ALTER TABLE `projects_risk`
  ADD CONSTRAINT `projects_risk_ibfk_1` FOREIGN KEY (`id_proyecto`) REFERENCES `projects` (`id_proyecto`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `projects_risk_ibfk_2` FOREIGN KEY (`id_risk`) REFERENCES `risk` (`id_risk`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `project_activity_dependencies`
--
ALTER TABLE `project_activity_dependencies`
  ADD CONSTRAINT `project_activity_dependencies_ibfk_1` FOREIGN KEY (`id_project_activities`) REFERENCES `project_activities` (`id_project_activities`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `project_plans`
--
ALTER TABLE `project_plans`
  ADD CONSTRAINT `project_plans_ibfk_1` FOREIGN KEY (`id_proyecto`) REFERENCES `projects` (`id_proyecto`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `project_plans_ibfk_2` FOREIGN KEY (`id_project_manager`) REFERENCES `users` (`id_usuario`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `project_plans_assumptions`
--
ALTER TABLE `project_plans_assumptions`
  ADD CONSTRAINT `project_plans_assumptions_ibfk_1` FOREIGN KEY (`id_proyecto`) REFERENCES `projects` (`id_proyecto`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `project_plans_assumptions_ibfk_2` FOREIGN KEY (`id_project_plan`) REFERENCES `project_plans` (`id_project_plans`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `project_plans_milestones`
--
ALTER TABLE `project_plans_milestones`
  ADD CONSTRAINT `project_plans_milestones_ibfk_1` FOREIGN KEY (`id_project_plans`) REFERENCES `project_plans` (`id_project_plans`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `project_plans_restriction`
--
ALTER TABLE `project_plans_restriction`
  ADD CONSTRAINT `project_plans_restriction_ibfk_1` FOREIGN KEY (`id_proyecto`) REFERENCES `projects` (`id_proyecto`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `project_plans_restriction_ibfk_2` FOREIGN KEY (`id_project_plan`) REFERENCES `project_plans` (`id_project_plans`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `project_plan_budgets`
--
ALTER TABLE `project_plan_budgets`
  ADD CONSTRAINT `project_plan_budgets_ibfk_1` FOREIGN KEY (`id_project_plans`) REFERENCES `project_plans` (`id_project_plans`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `project_plan_deliverables`
--
ALTER TABLE `project_plan_deliverables`
  ADD CONSTRAINT `project_plan_deliverables_ibfk_1` FOREIGN KEY (`id_project_plans`) REFERENCES `project_plans` (`id_project_plans`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `project_plan_deliverables_ibfk_2` FOREIGN KEY (`id_user_responsable`) REFERENCES `users` (`id_usuario`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `project_plan_resources`
--
ALTER TABLE `project_plan_resources`
  ADD CONSTRAINT `project_plan_resources_ibfk_1` FOREIGN KEY (`id_project_plans`) REFERENCES `project_plans` (`id_project_plans`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `project_plan_resources_ibfk_3` FOREIGN KEY (`id_responsable_recurso`) REFERENCES `users` (`id_usuario`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `project_plan_reviews`
--
ALTER TABLE `project_plan_reviews`
  ADD CONSTRAINT `project_plan_reviews_ibfk_1` FOREIGN KEY (`id_project_plans`) REFERENCES `project_plans` (`id_project_plans`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `project_plan_reviews_ibfk_2` FOREIGN KEY (`id_user_reviews`) REFERENCES `users` (`id_usuario`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `users_projects`
--
ALTER TABLE `users_projects`
  ADD CONSTRAINT `users_projects_ibfk_1` FOREIGN KEY (`id_projects`) REFERENCES `projects` (`id_proyecto`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `users_projects_ibfk_2` FOREIGN KEY (`id_autor_user`) REFERENCES `users` (`id_usuario`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `users_project_activities`
--
ALTER TABLE `users_project_activities`
  ADD CONSTRAINT `users_project_activities_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_usuario`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `users_project_activities_ibfk_2` FOREIGN KEY (`id_project_plans`) REFERENCES `project_plans` (`id_project_plans`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `users_project_activities_ibfk_3` FOREIGN KEY (`id_project_activities`) REFERENCES `project_activities` (`id_project_activities`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
