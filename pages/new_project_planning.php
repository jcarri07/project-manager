<?php

session_start();
require_once('../databases/conexion.php');

if (!isset($_SESSION['id_usuario'])) {
    header('Location: ../index.php');
    exit;
}

$idUsuario = (int) $_SESSION['id_usuario'];

if (!function_exists('pm_h')) {
    function pm_h($value): string
    {
        return htmlspecialchars((string)($value ?? ''), ENT_QUOTES, 'UTF-8');
    }
}

$id = $_REQUEST['id'];

// -----------------------------------------------------------------------------
// 2. Consultar proyecto, Project Manager, unidad y solicitante.
// -----------------------------------------------------------------------------
$sqlProyecto = "
    SELECT
        p.*,
        pm.nombre_user AS manager_nombre,
        pm.apellido_user AS manager_apellido,
        pm.estatus AS manager_estatus,
        u.nombre_unid,
        sol.nombre_user AS solicitante_nombre,
        sol.apellido_user AS solicitante_apellido
    FROM projects AS p
    INNER JOIN users AS pm
        ON pm.id_usuario = p.id_manager
    LEFT JOIN unidad AS u
        ON u.id_unidad = p.unidad
    LEFT JOIN users AS sol
        ON sol.id_usuario = p.id_solicitante
    WHERE p.id_proyecto = '$id'
      AND p.id_manager > 0
    LIMIT 1
";

$unidades = [];
$resultadoUnidades = mysqli_query(
    $conn,
    "SELECT id_unidad, nombre_unid FROM unidad ORDER BY nombre_unid"
);
if ($resultadoUnidades) {
    while ($fila = mysqli_fetch_assoc($resultadoUnidades)) {
        $unidades[] = $fila;
    }
}

$riesgosProyecto = [];
$sqlRiesgos = "
    SELECT
        pr.id_projects_risk,
        r.id_risk,
        r.riesgo,
        r.probabilidad,
        r.impacto,
        r.acciones
    FROM projects_risk AS pr
    INNER JOIN risk AS r
        ON r.id_risk = pr.id_risk
    WHERE pr.id_proyecto = ?
    ORDER BY r.riesgo ASC
";
$stmtRiesgos = mysqli_prepare($conn, $sqlRiesgos);
if ($stmtRiesgos) {
    mysqli_stmt_bind_param($stmtRiesgos, 'i', $idProyecto);
    mysqli_stmt_execute($stmtRiesgos);
    $resultadoRiesgos = mysqli_stmt_get_result($stmtRiesgos);
    while ($fila = mysqli_fetch_assoc($resultadoRiesgos)) {
        $riesgosProyecto[] = $fila;
    }
    mysqli_stmt_close($stmtRiesgos);
}

// -----------------------------------------------------------------------------
// 8. Datos de presentación y ruta de retorno.
// -----------------------------------------------------------------------------
$nombreProyecto = pm_h($proyecto['nombre']);
$nombreManager = pm_h(trim($proyecto['manager_nombre'] . ' ' . $proyecto['manager_apellido']));
$nombreUnidad = pm_h($proyecto['nombre_unid'] ?? 'No especificada');
$codigoProyecto = 'PRY-' . str_pad((string)$idProyecto, 4, '0', STR_PAD_LEFT);
$versionInicial = '1.0';

$urlRetorno = '../pages/project_indiv_tables_jef' . $paginaRetorno;

// Valores del ciclo de vida para mostrar una etapa coherente con el flujo.
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>Planificación del Proyecto</title>

    <!-- CoreUI -->
    <link rel="stylesheet" href="../assets/coreui/coreui_min_css.css">

    <!-- Iconos locales -->
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet">
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/code_icon_navbar.css">

    <!-- Material Dashboard -->
    <link href="../assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet">
    <link href="../assets/css/theme-override.css" rel="stylesheet">

    <style>
        .planning-hero {
            background: linear-gradient(110deg, #194070 0%, #2a5a96 100%);
            border-radius: 12px;
            padding: 24px;
        }

        .planning-info {
            height: 100%;
            min-height: 76px;
            padding: 12px 14px;
            background: #f8f9fa;
            border: 1px solid #edf0f3;
            border-radius: 8px;
        }

        .planning-info small {
            display: block;
            margin-bottom: 5px;
            color: #8392ab;
            font-size: 11px;
        }

        .planning-info strong {
            color: #344767;
            font-size: 13px;
            overflow-wrap: anywhere;
        }

        .lifecycle {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 8px;
        }

        .lifecycle-step {
            padding: 11px 6px;
            text-align: center;
            border-radius: 8px;
            color: #8392ab;
            background: #f1f3f5;
            font-size: 12px;
            font-weight: 600;
        }

        .lifecycle-step.completed {
            color: #198754;
            background: #e5f4eb;
        }

        .lifecycle-step.active {
            color: #fff;
            background: #194070;
        }

        .planning-tabs {
            display: flex;
            flex-wrap: nowrap;
            gap: 7px;
            overflow-x: auto;
            padding-bottom: 12px;
            border-bottom: 1px solid #e9ecef;
        }

        .planning-tabs .nav-link {
            flex: 0 0 auto;
            padding: 10px 13px;
            border-radius: 8px;
            color: #344767;
            background: #f8f9fa;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .planning-tabs .nav-link.active {
            color: #fff !important;
            background: #194070;
        }

        .planning-section-title {
            margin-bottom: 5px;
            color: #194070;
            font-weight: 700;
        }

        .planning-section-help {
            margin-bottom: 22px;
            color: #8392ab;
            font-size: 13px;
        }

        .readonly-info {
            min-height: 42px;
            padding: 11px 12px;
            border-radius: 7px;
            color: #344767;
            background: #f1f3f5;
            white-space: pre-wrap;
            overflow-wrap: anywhere;
        }

        .table-planning th {
            color: #344767;
            font-size: 11px;
            white-space: nowrap;
        }

        .table-planning td {
            min-width: 130px;
            vertical-align: middle;
        }

        .table-planning .form-control,
        .table-planning .form-select {
            min-width: 130px;
            padding: 8px 10px;
            font-size: 12px;
        }

        .table-planning .wide-field {
            min-width: 190px;
        }

        .section-note {
            padding: 12px 14px;
            border-left: 3px solid #194070;
            border-radius: 5px;
            background: #f4f7fb;
            color: #344767;
            font-size: 13px;
        }

        .required-mark {
            color: #dc3545;
        }

        .form-actions {
            position: sticky;
            bottom: 0;
            z-index: 10;
            background: #fff;
            border-top: 1px solid #edf0f3;
        }

        @media (max-width: 767px) {
            .lifecycle {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .lifecycle-step:last-child {
                grid-column: 1 / -1;
            }

            .planning-hero {
                padding: 18px;
            }
        }
    </style>
</head>

<body class="g-sidenav-show bg-gray-200">

    <?php include('./code_navbar.php'); ?>

    <main class="main-content position-relative max-height-vh-100 h-100">

        <!-- Barra superior -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0">
                        <li class="breadcrumb-item text-sm">
                            <a class="opacity-5 text-dark" href="javascript:;">Pages</a>
                        </li>
                        <li class="breadcrumb-item text-sm">
                            <a class="opacity-5 text-dark" href="<?php echo pm_h($urlRetorno); ?>">Proyectos</a>
                        </li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Planificación</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Nueva planificación</h6>
                </nav>
            </div>
        </nav>

        <div class="container-fluid px-3 px-md-4 pb-5">

            <!-- Encabezado -->
            <section class="planning-hero mt-4 mb-4">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                    <div>
                        <h3 class="text-white mb-1">Planificación del proyecto</h3>
                        <p class="text-white opacity-8 mb-0">Gestión del plan de trabajo</p>
                    </div>
                    <span class="badge bg-white text-primary px-3 py-2">Nueva planificación</span>
                </div>
            </section>

            <!-- Identificación -->
            <section class="card mb-4">
                <div class="card-header pb-0">
                    <h6 class="mb-1">
                        <i class="material-icons-round text-primary me-2">folder_open</i>
                        Identificación del proyecto
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="planning-info">
                                <small>Proyecto</small>
                                <strong><?php echo $nombreProyecto; ?></strong>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="planning-info">
                                <small>Código</small>
                                <strong><?php echo pm_h($codigoProyecto); ?></strong>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="planning-info">
                                <small>Project Manager</small>
                                <strong><?php echo $nombreManager; ?></strong>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="planning-info">
                                <small>Versión</small>
                                <strong><?php echo pm_h($versionInicial); ?></strong>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="planning-info">
                                <small>Estado del plan</small>
                                <strong>No iniciado</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Ciclo de vida -->
            <section class="card mb-4">
                <div class="card-header pb-0">
                    <h6 class="mb-1">
                        <i class="material-icons-round text-primary me-2">timeline</i>
                        Ciclo de vida del proyecto
                    </h6>
                </div>
                <div class="card-body">
                    <div class="lifecycle">
                        <div class="lifecycle-step completed"><i class="material-icons-round">check_circle</i><br>Propuesto</div>
                        <div class="lifecycle-step completed"><i class="material-icons-round">check_circle</i><br>Evaluación</div>
                        <div class="lifecycle-step completed"><i class="material-icons-round">check_circle</i><br>Aprobado</div>
                        <div class="lifecycle-step active"><i class="material-icons-round">edit_calendar</i><br>Planificación</div>
                        <div class="lifecycle-step"><i class="material-icons-round">play_circle</i><br>Ejecución</div>
                    </div>
                </div>
            </section>

            <!-- Formulario nuevo plan -->
            <form method="POST" action="./procesos/guardar_plan.php" id="form_planificacion" autocomplete="off">
                <input type="hidden" name="id_proyecto" value="<?php echo (int)$idProyecto; ?>">

                <section class="card">
                    <div class="card-header pb-0">
                        <h6 class="mb-1">
                            <i class="material-icons-round text-primary me-2">assignment</i>
                            Secciones del plan
                        </h6>
                        <p class="text-sm text-secondary">Complete la información necesaria para organizar la ejecución del proyecto.</p>
                    </div>

                    <div class="card-body">
                        <ul class="nav nav-pills planning-tabs" id="planningTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="tab-resumen-btn" type="button" data-coreui-toggle="tab" data-coreui-target="#tab-resumen" role="tab" aria-controls="tab-resumen" aria-selected="true">
                                    <i class="material-icons-round text-sm me-1">description</i>Resumen aprobado
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="tab-general-btn" type="button" data-coreui-toggle="tab" data-coreui-target="#tab-general" role="tab" aria-controls="tab-general" aria-selected="false">
                                    <i class="material-icons-round text-sm me-1">info</i>Información general
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="tab-alcance-btn" type="button" data-coreui-toggle="tab" data-coreui-target="#tab-alcance" role="tab" aria-controls="tab-alcance" aria-selected="false">
                                    <i class="material-icons-round text-sm me-1">target</i>Alcance y entregables
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="tab-actividades-btn" type="button" data-coreui-toggle="tab" data-coreui-target="#tab-actividades" role="tab" aria-controls="tab-actividades" aria-selected="false">
                                    <i class="material-icons-round text-sm me-1">list</i>Actividades y cronograma
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="tab-recursos-btn" type="button" data-coreui-toggle="tab" data-coreui-target="#tab-recursos" role="tab" aria-controls="tab-recursos" aria-selected="false">
                                    <i class="material-icons-round text-sm me-1">inventory</i>Recursos
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="tab-presupuesto-btn" type="button" data-coreui-toggle="tab" data-coreui-target="#tab-presupuesto" role="tab" aria-controls="tab-presupuesto" aria-selected="false">
                                    <i class="material-icons-round text-sm me-1">payments</i>Presupuesto
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="tab-riesgos-btn" type="button" data-coreui-toggle="tab" data-coreui-target="#tab-riesgos" role="tab" aria-controls="tab-riesgos" aria-selected="false">
                                    <i class="material-icons-round text-sm me-1">warning</i>Riesgos y supuestos
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="tab-seguimiento-btn" type="button" data-coreui-toggle="tab" data-coreui-target="#tab-seguimiento" role="tab" aria-controls="tab-seguimiento" aria-selected="false">
                                    <i class="material-icons-round text-sm me-1">monitoring</i>Seguimiento
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content pt-4" id="planningTabContent">

                            <!-- 1. Resumen aprobado: consulta, sin inputs editables -->
                            <div class="tab-pane fade show active" id="tab-resumen" role="tabpanel" aria-labelledby="tab-resumen-btn" tabindex="0">
                                <h6 class="planning-section-title">Información aprobada del proyecto</h6>
                                <p class="planning-section-help">Datos recuperados de la propuesta y evaluación previa. Se muestran como referencia y no se modifican desde esta pantalla.</p>

                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label class="form-label">Descripción del proyecto</label>
                                        <div class="readonly-info"><?php echo pm_h($proyecto['descripcion']); ?></div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Unidad responsable</label>
                                        <div class="readonly-info"><?php echo $nombreUnidad; ?></div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Sponsor</label>
                                        <div class="readonly-info"><?php echo pm_h($proyecto['sponsor']); ?></div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Necesidad o problemática</label>
                                        <div class="readonly-info"><?php echo pm_h($proyecto['problema']); ?></div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Objetivos aprobados</label>
                                        <div class="readonly-info"><?php echo pm_h($proyecto['objetivos']); ?></div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Beneficios esperados</label>
                                        <div class="readonly-info"><?php echo pm_h($proyecto['beneficios']); ?></div>
                                    </div>
                                </div>

                                <hr>
                                <h6 class="planning-section-title">Resultado de la evaluación</h6>
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Técnica</label>
                                        <div class="readonly-info"><?php echo pm_h($proyecto['tecnica']); ?></div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Operativa</label>
                                        <div class="readonly-info"><?php echo pm_h($proyecto['operativa']); ?></div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Financiera</label>
                                        <div class="readonly-info"><?php echo pm_h($proyecto['financiera']); ?></div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Nivel de impacto</label>
                                        <div class="readonly-info"><?php echo pm_h($proyecto['nivel_impacto']); ?></div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Observaciones de evaluación</label>
                                        <div class="readonly-info"><?php echo pm_h($proyecto['observaciones_eval']); ?></div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Justificación de evaluación</label>
                                        <div class="readonly-info"><?php echo pm_h($proyecto['justificacion_eval']); ?></div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Decisión y justificación del Director</label>
                                        <div class="readonly-info"><?php echo pm_h($proyecto['justificacion_dir']); ?></div>
                                    </div>
                                </div>

                                <hr>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Presupuesto estimado inicial</label>
                                        <div class="readonly-info"><?php echo pm_h($proyecto['presupuesto_est']); ?></div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Inicio estimado inicial</label>
                                        <div class="readonly-info"><?php echo pm_h($proyecto['fecha_inicio']); ?></div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Final estimado inicial</label>
                                        <div class="readonly-info"><?php echo pm_h($proyecto['fecha_fin']); ?></div>
                                    </div>
                                </div>
                            </div>

                            <!-- 2. Información general: inicia vacía -->
                            <div class="tab-pane fade" id="tab-general" role="tabpanel" aria-labelledby="tab-general-btn" tabindex="0">
                                <h6 class="planning-section-title">Información general del plan</h6>
                                <p class="planning-section-help">Describa cómo se organizará el proyecto y establezca sus fechas de referencia.</p>

                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label class="form-label">Resumen ejecutivo <span class="required-mark">*</span></label>
                                        <textarea class="form-control border px-3" name="resumen_ejecutivo" rows="4" data-required="1" placeholder="Explique brevemente cómo se organizará y desarrollará el proyecto..."></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Fecha de inicio planificada <span class="required-mark">*</span></label>
                                        <input type="date" class="form-control border px-3" name="fecha_inicio_plan" data-required="1">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Fecha de finalización planificada <span class="required-mark">*</span></label>
                                        <input type="date" class="form-control border px-3" name="fecha_fin_plan" data-required="1">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Project Manager</label>
                                        <input type="text" class="form-control border px-3" value="<?php echo $nombreManager; ?>" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Moneda del presupuesto <span class="required-mark">*</span></label>
                                        <select class="form-select border px-3" name="moneda" data-required="1">
                                            <option value="">Seleccione una moneda</option>
                                            <option value="USD">Dólar estadounidense (USD)</option>
                                            <option value="VES">Bolívar (VES)</option>
                                            <option value="EUR">Euro (EUR)</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Supuestos</label>
                                        <textarea class="form-control border px-3" name="supuestos" rows="3" placeholder="Condiciones que se consideran ciertas para planificar el proyecto..."></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Restricciones</label>
                                        <textarea class="form-control border px-3" name="restricciones" rows="3" placeholder="Limitaciones de tiempo, presupuesto, personal, tecnología u otras..."></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Dependencias externas</label>
                                        <textarea class="form-control border px-3" name="dependencias_externas" rows="3" placeholder="Proveedores, autorizaciones u otros factores externos necesarios..."></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- 3. Alcance y entregables -->
                            <div class="tab-pane fade" id="tab-alcance" role="tabpanel" aria-labelledby="tab-alcance-btn" tabindex="0">
                                <h6 class="planning-section-title">Alcance del proyecto</h6>
                                <p class="planning-section-help">Defina qué trabajo se realizará y qué queda fuera del proyecto.</p>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Alcance incluido <span class="required-mark">*</span></label>
                                        <textarea class="form-control border px-3" name="alcance_incluido" rows="5" data-required="1" placeholder="Describa los trabajos incluidos en el proyecto..."></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Alcance excluido</label>
                                        <textarea class="form-control border px-3" name="alcance_excluido" rows="5" placeholder="Describa los trabajos que no forman parte del proyecto..."></textarea>
                                    </div>
                                </div>

                                <hr>
                                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-3">
                                    <div>
                                        <h6 class="planning-section-title mb-1">Entregables del proyecto</h6>
                                        <p class="planning-section-help mb-0">Registre los resultados concretos que debe producir el proyecto.</p>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-primary mb-0" onclick="addPlanningRow('deliverables')">
                                        <i class="material-icons-round text-sm">add</i> Agregar entregable
                                    </button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped align-middle table-planning">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Entregable</th>
                                                <th>Descripción</th>
                                                <th>Criterio de aceptación</th>
                                                <th>Responsable</th>
                                                <th>Fecha objetivo</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="deliverables-body">
                                            <tr id="deliverables-empty">
                                                <td colspan="6" class="text-center text-secondary">Agregue los entregables del proyecto.</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- 4. Actividades y cronograma -->
                            <div class="tab-pane fade" id="tab-actividades" role="tabpanel" aria-labelledby="tab-actividades-btn" tabindex="0">
                                <h6 class="planning-section-title">Actividades y cronograma</h6>
                                <p class="planning-section-help">Descomponga el trabajo en actividades, asigne responsables y defina fechas y dependencias.</p>
                                <div class="section-note mb-3">Las actividades registradas aquí constituirán la base del cronograma del proyecto. Las dependencias se relacionarán con otras actividades del mismo plan.</div>
                                <div class="d-flex justify-content-end mb-3">
                                    <button type="button" class="btn btn-sm btn-outline-primary mb-0" onclick="addPlanningRow('activities')">
                                        <i class="material-icons-round text-sm">add</i> Agregar actividad
                                    </button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped align-middle table-planning">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Actividad</th>
                                                <th>Descripción</th>
                                                <th>Responsable</th>
                                                <th>Entregable relacionado</th>
                                                <th>Inicio</th>
                                                <th>Finalización</th>
                                                <th>Duración (días)</th>
                                                <th>Depende de</th>
                                                <th>Hito</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="activities-body">
                                            <tr id="activities-empty">
                                                <td colspan="10" class="text-center text-secondary">Agregue las actividades necesarias para ejecutar el proyecto.</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- 5. Recursos -->
                            <div class="tab-pane fade" id="tab-recursos" role="tabpanel" aria-labelledby="tab-recursos-btn" tabindex="0">
                                <h6 class="planning-section-title">Recursos requeridos</h6>
                                <p class="planning-section-help">Identifique los recursos humanos, materiales, tecnológicos, servicios e infraestructura necesarios.</p>
                                <div class="d-flex justify-content-end mb-3">
                                    <button type="button" class="btn btn-sm btn-outline-primary mb-0" onclick="addPlanningRow('resources')">
                                        <i class="material-icons-round text-sm">add</i> Agregar recurso
                                    </button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped align-middle table-planning">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Tipo</th>
                                                <th>Descripción</th>
                                                <th>Cantidad</th>
                                                <th>Unidad de medida</th>
                                                <th>Unidad responsable</th>
                                                <th>Responsable</th>
                                                <th>Disponibilidad</th>
                                                <th>Observaciones</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="resources-body">
                                            <tr id="resources-empty">
                                                <td colspan="9" class="text-center text-secondary">Agregue los recursos requeridos o indique que no se necesitan recursos adicionales.</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- 6. Presupuesto -->
                            <div class="tab-pane fade" id="tab-presupuesto" role="tabpanel" aria-labelledby="tab-presupuesto-btn" tabindex="0">
                                <h6 class="planning-section-title">Presupuesto planificado</h6>
                                <p class="planning-section-help">Desglose los costos previstos. El presupuesto inicial de la propuesta se conserva como referencia y no se modifica aquí.</p>
                                <div class="row mb-3">
                                    <div class="col-md-5">
                                        <label class="form-label">Presupuesto estimado inicial</label>
                                        <div class="readonly-info"><?php echo pm_h($proyecto['presupuesto_est']); ?></div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mb-3">
                                    <button type="button" class="btn btn-sm btn-outline-primary mb-0" onclick="addPlanningRow('budget')">
                                        <i class="material-icons-round text-sm">add</i> Agregar partida
                                    </button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped align-middle table-planning">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Categoría</th>
                                                <th>Descripción</th>
                                                <th>Cantidad</th>
                                                <th>Unidad</th>
                                                <th>Costo unitario</th>
                                                <th>Monto planificado</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="budget-body">
                                            <tr id="budget-empty">
                                                <td colspan="7" class="text-center text-secondary">Agregue las partidas del presupuesto planificado.</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-end mt-3">
                                    <div class="planning-info" style="min-width:230px">
                                        <small>Presupuesto total planificado</small>
                                        <strong id="budget-total" class="text-primary fs-5">0.00</strong>
                                    </div>
                                </div>
                            </div>

                            <!-- 7. Riesgos y supuestos -->
                            <div class="tab-pane fade" id="tab-riesgos" role="tabpanel" aria-labelledby="tab-riesgos-btn" tabindex="0">
                                <h6 class="planning-section-title">Riesgos identificados durante la evaluación</h6>
                                <p class="planning-section-help">Se muestran los riesgos previamente relacionados con el proyecto. Defina cómo se atenderá cada uno durante la planificación.</p>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped align-middle table-planning">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Riesgo</th>
                                                <th>Probabilidad inicial</th>
                                                <th>Impacto inicial</th>
                                                <th>Acciones del catálogo</th>
                                                <th>Respuesta planificada</th>
                                                <th>Responsable</th>
                                                <th>Fecha de revisión</th>
                                                <th>Observaciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (count($riesgosProyecto) > 0): ?>
                                                <?php foreach ($riesgosProyecto as $riesgo): ?>
                                                    <?php $riskKey = (int)$riesgo['id_projects_risk']; ?>
                                                    <tr>
                                                        <td class="wide-field"><?php echo pm_h($riesgo['riesgo']); ?></td>
                                                        <td><?php echo pm_h($riesgo['probabilidad']); ?></td>
                                                        <td><?php echo pm_h($riesgo['impacto']); ?></td>
                                                        <td class="wide-field"><?php echo pm_h($riesgo['acciones']); ?></td>
                                                        <td>
                                                            <textarea class="form-control border px-2 wide-field" rows="3" name="riesgos_plan[<?php echo $riskKey; ?>][respuesta_plan]" placeholder="Respuesta específica para este proyecto"></textarea>
                                                            <input type="hidden" name="riesgos_plan[<?php echo $riskKey; ?>][probabilidad_plan]" value="<?php echo pm_h($riesgo['probabilidad']); ?>">
                                                            <input type="hidden" name="riesgos_plan[<?php echo $riskKey; ?>][impacto_plan]" value="<?php echo pm_h($riesgo['impacto']); ?>">
                                                        </td>
                                                        <td>
                                                            <select class="form-select" name="riesgos_plan[<?php echo $riskKey; ?>][id_responsable]">
                                                                <option value="">Seleccione</option>
                                                                <?php foreach ($usuarios as $persona): ?>
                                                                    <option value="<?php echo (int)$persona['id_usuario']; ?>"><?php echo pm_h($persona['nombre_user'] . ' ' . $persona['apellido_user']); ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </td>
                                                        <td><input type="date" class="form-control" name="riesgos_plan[<?php echo $riskKey; ?>][fecha_revision]"></td>
                                                        <td><textarea class="form-control border px-2 wide-field" rows="3" name="riesgos_plan[<?php echo $riskKey; ?>][observaciones]"></textarea></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="8" class="text-center text-secondary">No se registraron riesgos asociados durante la evaluación. El Project Manager puede documentar los supuestos y restricciones en Información general.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- 8. Seguimiento -->
                            <div class="tab-pane fade" id="tab-seguimiento" role="tabpanel" aria-labelledby="tab-seguimiento-btn" tabindex="0">
                                <h6 class="planning-section-title">Seguimiento y comunicación</h6>
                                <p class="planning-section-help">Defina cómo se informarán los avances y quién tendrá la responsabilidad de reportarlos durante la ejecución.</p>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Frecuencia de actualización <span class="required-mark">*</span></label>
                                        <select class="form-select border px-3" name="frecuencia_seguimiento" data-required="1">
                                            <option value="">Seleccione la frecuencia</option>
                                            <option value="Semanal">Semanal</option>
                                            <option value="Quincenal">Quincenal</option>
                                            <option value="Mensual">Mensual</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Responsable de reportar <span class="required-mark">*</span></label>
                                        <select class="form-select border px-3" name="id_responsable_reporte" data-required="1">
                                            <option value="">Seleccione un responsable</option>
                                            <?php foreach ($usuarios as $persona): ?>
                                                <option value="<?php echo (int)$persona['id_usuario']; ?>"><?php echo pm_h($persona['nombre_user'] . ' ' . $persona['apellido_user']); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Indicadores de seguimiento <span class="required-mark">*</span></label>
                                        <textarea class="form-control border px-3" name="indicadores_seguimiento" rows="4" data-required="1" placeholder="Indique cómo se medirá el avance, cumplimiento de actividades, fechas y presupuesto..."></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Recomendación del Project Manager</label>
                                        <textarea class="form-control border px-3" name="recomendacion_manager" rows="4" placeholder="Indique si considera que el proyecto está preparado para ser enviado a revisión..."></textarea>
                                    </div>
                                </div>
                            </div>

                        </div><!-- /tab-content -->
                    </div><!-- /card-body -->

                    <div class="card-footer form-actions d-flex flex-column flex-sm-row justify-content-between gap-2">
                        <a href="<?php echo pm_h($urlRetorno); ?>" class="btn btn-outline-secondary mb-0">
                            <i class="material-icons-round me-1">arrow_back</i>Volver
                        </a>
                        <div class="d-flex flex-column flex-sm-row gap-2">
                            <button type="submit" name="accion_plan" value="borrador" class="btn btn-outline-primary mb-0">
                                <i class="material-icons-round me-1">save</i>Guardar borrador
                            </button>
                            <button type="submit" name="accion_plan" value="enviar_revision" class="btn bg-gradient-primary mb-0">
                                <i class="material-icons-round me-1">send</i>Enviar a revisión
                            </button>
                        </div>
                    </div>
                </section>
            </form>
        </div>
    </main>

    <!-- Plantillas para filas dinámicas. Las claves se reemplazan con JavaScript. -->
    <template id="tpl-deliverable">
        <tr data-row-key="__KEY__">
            <td><input class="form-control" name="entregables[__KEY__][nombre]" maxlength="200" placeholder="Nombre" data-row-field="nombre"></td>
            <td><textarea class="form-control wide-field" name="entregables[__KEY__][descripcion]" rows="2" placeholder="Descripción"></textarea></td>
            <td><textarea class="form-control wide-field" name="entregables[__KEY__][criterio_aceptacion]" rows="2" placeholder="Criterio de aceptación"></textarea></td>
            <td>
                <select class="form-select" name="entregables[__KEY__][id_responsable]">
                    <option value="">Seleccione</option>
                    <?php foreach ($usuarios as $persona): ?>
                        <option value="<?php echo (int)$persona['id_usuario']; ?>"><?php echo pm_h($persona['nombre_user'] . ' ' . $persona['apellido_user']); ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td><input type="date" class="form-control" name="entregables[__KEY__][fecha_objetivo]"></td>
            <td>
                <input type="hidden" name="entregables[__KEY__][orden]" value="__KEY__">
                <button type="button" class="btn btn-sm btn-outline-danger mb-0" onclick="removePlanningRow(this)"><i class="material-icons-round text-sm">delete</i></button>
            </td>
        </tr>
    </template>

    <template id="tpl-activity">
        <tr data-row-key="__KEY__">
            <td><input class="form-control" name="actividades[__KEY__][nombre_actividad]" maxlength="200" placeholder="Nombre de actividad"></td>
            <td><textarea class="form-control wide-field" name="actividades[__KEY__][descripcion]" rows="2" placeholder="Descripción"></textarea></td>
            <td>
                <select class="form-select" name="actividades[__KEY__][id_responsable]">
                    <option value="">Seleccione</option>
                    <?php foreach ($usuarios as $persona): ?>
                        <option value="<?php echo (int)$persona['id_usuario']; ?>"><?php echo pm_h($persona['nombre_user'] . ' ' . $persona['apellido_user']); ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td><select class="form-select" name="actividades[__KEY__][entregable_ref]" data-deliverable-ref>
                    <option value="">Sin asociar</option>
                </select></td>
            <td><input type="date" class="form-control" name="actividades[__KEY__][fecha_inicio_plan]" data-start-date></td>
            <td><input type="date" class="form-control" name="actividades[__KEY__][fecha_fin_plan]" data-end-date></td>
            <td><input type="number" min="0" step="1" class="form-control" name="actividades[__KEY__][duracion_dias]" data-duration placeholder="Días"></td>
            <td><select class="form-select" name="actividades[__KEY__][dependencia_ref]" data-activity-dependency>
                    <option value="">Ninguna</option>
                </select></td>
            <td class="text-center"><input type="checkbox" class="form-check-input" name="actividades[__KEY__][es_hito]" value="1" title="Marcar como hito"></td>
            <td>
                <input type="hidden" name="actividades[__KEY__][orden]" value="__KEY__">
                <button type="button" class="btn btn-sm btn-outline-danger mb-0" onclick="removePlanningRow(this)"><i class="material-icons-round text-sm">delete</i></button>
            </td>
        </tr>
    </template>

    <template id="tpl-resource">
        <tr data-row-key="__KEY__">
            <td>
                <select class="form-select" name="recursos[__KEY__][tipo_recurso]">
                    <option value="">Seleccione</option>
                    <option value="Humano">Humano</option>
                    <option value="Material">Material</option>
                    <option value="Tecnológico">Tecnológico</option>
                    <option value="Infraestructura">Infraestructura</option>
                    <option value="Servicio">Servicio</option>
                    <option value="Otro">Otro</option>
                </select>
            </td>
            <td><input class="form-control wide-field" name="recursos[__KEY__][descripcion]" maxlength="300" placeholder="Descripción del recurso"></td>
            <td><input type="number" min="0.01" step="0.01" class="form-control" name="recursos[__KEY__][cantidad]" value="1"></td>
            <td><input class="form-control" name="recursos[__KEY__][unidad_medida]" maxlength="40" placeholder="Unidad"></td>
            <td>
                <select class="form-select" name="recursos[__KEY__][id_unidad_responsable]">
                    <option value="">Seleccione</option>
                    <?php foreach ($unidades as $unidad): ?>
                        <option value="<?php echo (int)$unidad['id_unidad']; ?>"><?php echo pm_h($unidad['nombre_unid']); ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td>
                <select class="form-select" name="recursos[__KEY__][id_responsable]">
                    <option value="">Seleccione</option>
                    <?php foreach ($usuarios as $persona): ?>
                        <option value="<?php echo (int)$persona['id_usuario']; ?>"><?php echo pm_h($persona['nombre_user'] . ' ' . $persona['apellido_user']); ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td>
                <select class="form-select" name="recursos[__KEY__][disponibilidad]">
                    <option value="Por confirmar">Por confirmar</option>
                    <option value="Disponible">Disponible</option>
                    <option value="No disponible">No disponible</option>
                </select>
            </td>
            <td><textarea class="form-control wide-field" name="recursos[__KEY__][observaciones]" rows="2"></textarea></td>
            <td><button type="button" class="btn btn-sm btn-outline-danger mb-0" onclick="removePlanningRow(this)"><i class="material-icons-round text-sm">delete</i></button></td>
        </tr>
    </template>

    <template id="tpl-budget">
        <tr data-row-key="__KEY__">
            <td>
                <select class="form-select" name="presupuesto[__KEY__][categoria]">
                    <option value="">Seleccione</option>
                    <option value="Equipos">Equipos</option>
                    <option value="Materiales">Materiales</option>
                    <option value="Personal">Personal</option>
                    <option value="Servicios">Servicios</option>
                    <option value="Transporte">Transporte</option>
                    <option value="Otros">Otros</option>
                </select>
            </td>
            <td><input class="form-control wide-field" name="presupuesto[__KEY__][descripcion]" maxlength="300" placeholder="Descripción"></td>
            <td><input type="number" min="0.01" step="0.01" class="form-control" name="presupuesto[__KEY__][cantidad]" value="1" data-budget-quantity></td>
            <td><input class="form-control" name="presupuesto[__KEY__][unidad_medida]" maxlength="40" placeholder="Unidad"></td>
            <td><input type="number" min="0" step="0.01" class="form-control" name="presupuesto[__KEY__][costo_unitario]" value="0" data-budget-unit-cost></td>
            <td>
                <input type="number" min="0" step="0.01" class="form-control" name="presupuesto[__KEY__][monto_planificado]" value="0.00" readonly data-budget-total>
            </td>
            <td><button type="button" class="btn btn-sm btn-outline-danger mb-0" onclick="removePlanningRow(this)"><i class="material-icons-round text-sm">delete</i></button></td>
        </tr>
    </template>

    <script src="../assets/coreui/coreui_bundle_min_js.js"></script>
    <script>
        (function() {
            'use strict';

            const form = document.getElementById('form_planificacion');
            let rowCounters = {
                deliverables: 0,
                activities: 0,
                resources: 0,
                budget: 0
            };

            const tableConfig = {
                deliverables: {
                    tbody: 'deliverables-body',
                    template: 'tpl-deliverable',
                    empty: 'deliverables-empty'
                },
                activities: {
                    tbody: 'activities-body',
                    template: 'tpl-activity',
                    empty: 'activities-empty'
                },
                resources: {
                    tbody: 'resources-body',
                    template: 'tpl-resource',
                    empty: 'resources-empty'
                },
                budget: {
                    tbody: 'budget-body',
                    template: 'tpl-budget',
                    empty: 'budget-empty'
                }
            };

            window.addPlanningRow = function(type) {
                const config = tableConfig[type];
                if (!config) return;

                const tbody = document.getElementById(config.tbody);
                const template = document.getElementById(config.template);
                const emptyRow = document.getElementById(config.empty);

                if (!tbody || !template) return;
                if (emptyRow) emptyRow.remove();

                const key = rowCounters[type]++;
                const html = template.innerHTML.replaceAll('__KEY__', String(key));
                tbody.insertAdjacentHTML('beforeend', html);

                refreshActivityReferences();
            };

            window.removePlanningRow = function(button) {
                const row = button.closest('tr');
                if (row) row.remove();

                Object.keys(tableConfig).forEach(function(type) {
                    const config = tableConfig[type];
                    const tbody = document.getElementById(config.tbody);
                    if (tbody && tbody.querySelectorAll('tr[data-row-key]').length === 0) {
                        const colspans = {
                            deliverables: 6,
                            activities: 10,
                            resources: 9,
                            budget: 7
                        };
                        const messages = {
                            deliverables: 'Agregue los entregables del proyecto.',
                            activities: 'Agregue las actividades necesarias para ejecutar el proyecto.',
                            resources: 'Agregue los recursos requeridos o indique que no se necesitan recursos adicionales.',
                            budget: 'Agregue las partidas del presupuesto planificado.'
                        };
                        const empty = document.createElement('tr');
                        empty.id = config.empty;
                        empty.innerHTML = '<td colspan="' + colspans[type] + '" class="text-center text-secondary">' + messages[type] + '</td>';
                        tbody.appendChild(empty);
                    }
                });

                refreshActivityReferences();
                updateBudgetTotal();
            };

            function refreshActivityReferences() {
                const deliverableRows = document.querySelectorAll('#deliverables-body tr[data-row-key]');
                const activityRows = document.querySelectorAll('#activities-body tr[data-row-key]');

                deliverableRows.forEach(function(row) {
                    const nameInput = row.querySelector('[data-row-field="nombre"]');
                    row.dataset.deliverableLabel = nameInput ? nameInput.value.trim() : '';
                });

                activityRows.forEach(function(row) {
                    const activityInput = row.querySelector('input[name$="[nombre_actividad]"]');
                    row.dataset.activityLabel = activityInput ? activityInput.value.trim() : '';
                });

                document.querySelectorAll('[data-deliverable-ref]').forEach(function(select) {
                    const selected = select.value;
                    select.innerHTML = '<option value="">Sin asociar</option>';
                    deliverableRows.forEach(function(row) {
                        const key = row.dataset.rowKey;
                        const input = row.querySelector('[data-row-field="nombre"]');
                        const label = input && input.value.trim() ? input.value.trim() : 'Entregable ' + (Number(key) + 1);
                        const option = document.createElement('option');
                        option.value = key;
                        option.textContent = label;
                        select.appendChild(option);
                    });
                    if ([...select.options].some(option => option.value === selected)) select.value = selected;
                });

                document.querySelectorAll('[data-activity-dependency]').forEach(function(select) {
                    const selected = select.value;
                    const ownRow = select.closest('tr[data-row-key]');
                    const ownKey = ownRow ? ownRow.dataset.rowKey : null;
                    select.innerHTML = '<option value="">Ninguna</option>';
                    activityRows.forEach(function(row) {
                        const key = row.dataset.rowKey;
                        if (key === ownKey) return;
                        const input = row.querySelector('input[name$="[nombre_actividad]"]');
                        const label = input && input.value.trim() ? input.value.trim() : 'Actividad ' + (Number(key) + 1);
                        const option = document.createElement('option');
                        option.value = key;
                        option.textContent = label;
                        select.appendChild(option);
                    });
                    if ([...select.options].some(option => option.value === selected)) select.value = selected;
                });
            }

            document.addEventListener('input', function(event) {
                if (event.target.matches('#deliverables-body [data-row-field="nombre"], #activities-body input[name$="[nombre_actividad]"]')) {
                    refreshActivityReferences();
                }
                if (event.target.matches('[data-budget-quantity], [data-budget-unit-cost]')) {
                    const row = event.target.closest('tr');
                    const quantity = parseFloat(row.querySelector('[data-budget-quantity]').value) || 0;
                    const unitCost = parseFloat(row.querySelector('[data-budget-unit-cost]').value) || 0;
                    row.querySelector('[data-budget-total]').value = (quantity * unitCost).toFixed(2);
                    updateBudgetTotal();
                }
                if (event.target.matches('[data-start-date], [data-end-date]')) {
                    updateActivityDuration(event.target.closest('tr'));
                }
            });

            document.addEventListener('change', function(event) {
                if (event.target.matches('[data-start-date], [data-end-date]')) {
                    updateActivityDuration(event.target.closest('tr'));
                }
                if (event.target.matches('[data-budget-quantity], [data-budget-unit-cost]')) {
                    const row = event.target.closest('tr');
                    const quantity = parseFloat(row.querySelector('[data-budget-quantity]').value) || 0;
                    const unitCost = parseFloat(row.querySelector('[data-budget-unit-cost]').value) || 0;
                    row.querySelector('[data-budget-total]').value = (quantity * unitCost).toFixed(2);
                    updateBudgetTotal();
                }
            });

            function updateActivityDuration(row) {
                if (!row) return;
                const start = row.querySelector('[data-start-date]')?.value;
                const end = row.querySelector('[data-end-date]')?.value;
                const duration = row.querySelector('[data-duration]');
                if (!duration || !start || !end) return;

                const startDate = new Date(start + 'T00:00:00');
                const endDate = new Date(end + 'T00:00:00');
                const days = Math.round((endDate - startDate) / 86400000) + 1;
                duration.value = days > 0 ? days : '';
            }

            function updateBudgetTotal() {
                let total = 0;
                document.querySelectorAll('[data-budget-total]').forEach(function(input) {
                    total += parseFloat(input.value) || 0;
                });
                const output = document.getElementById('budget-total');
                if (output) output.textContent = total.toFixed(2);
            }

            function activateTabFor(element) {
                const pane = element.closest('.tab-pane');
                if (!pane) return;
                const targetButton = document.querySelector('[data-coreui-target="#' + pane.id + '"]');
                if (!targetButton) return;

                if (window.coreui && window.coreui.Tab) {
                    window.coreui.Tab.getOrCreateInstance(targetButton).show();
                } else if (window.bootstrap && window.bootstrap.Tab) {
                    window.bootstrap.Tab.getOrCreateInstance(targetButton).show();
                }
            }

            // Las validaciones de envío se realizan también en el servidor.
            // Guardar borrador admite secciones incompletas.
            form.addEventListener('submit', function(event) {
                const action = event.submitter ? event.submitter.value : 'borrador';
                if (action !== 'enviar_revision') return;

                const requiredFields = form.querySelectorAll('[data-required="1"]');
                let firstInvalid = null;

                requiredFields.forEach(function(field) {
                    field.classList.remove('is-invalid');
                    if (!String(field.value || '').trim()) {
                        field.classList.add('is-invalid');
                        if (!firstInvalid) firstInvalid = field;
                    }
                });

                const start = form.querySelector('[name="fecha_inicio_plan"]');
                const end = form.querySelector('[name="fecha_fin_plan"]');
                if (start && end && start.value && end.value && end.value < start.value) {
                    end.classList.add('is-invalid');
                    firstInvalid = firstInvalid || end;
                    alert('La fecha de finalización no puede ser anterior a la fecha de inicio.');
                }

                if (firstInvalid) {
                    event.preventDefault();
                    activateTabFor(firstInvalid);
                    firstInvalid.focus();
                    if (!firstInvalid.matches('[type="date"]') || !(start && end && end.value < start.value)) {
                        alert('Complete los campos obligatorios antes de enviar el plan a revisión.');
                    }
                }
            });

            // Evita fechas de finalización anteriores a la fecha de inicio.
            const startPlan = form.querySelector('[name="fecha_inicio_plan"]');
            const endPlan = form.querySelector('[name="fecha_fin_plan"]');
            if (startPlan && endPlan) {
                startPlan.addEventListener('change', function() {
                    endPlan.min = startPlan.value || '';
                });
                endPlan.addEventListener('change', function() {
                    if (startPlan.value) endPlan.min = startPlan.value;
                });
            }
        })();
    </script>

</body>

</html>