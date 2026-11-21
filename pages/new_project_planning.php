<?php

session_start();
require_once('../databases/conexion.php');

if (!isset($_SESSION['id_usuario'])) {
    header('Location: ../index.php');
    exit;
}

$idUsuario_pm = (int) $_SESSION['id_usuario'];

$id = $_REQUEST['id'];

$sqlUsers_pm = "SELECT * FROM users WHERE users.id_usuario = '$idUsuario_pm' LIMIT 1";
$sqlUser_pmanagers = mysqli_query($conn, $sqlUsers_pm);
while ($data_users_pm = mysqli_fetch_assoc($sqlUser_pmanagers)) {
    $users_pm = $data_users_pm;
}

$sqlProyecto = "SELECT * FROM projects, users, unidad WHERE users.id_usuario = projects.id_solicitante AND unidad.id_unidad = projects.unidad AND projects.id_proyecto = '$id' LIMIT 1";
$sqlProy = mysqli_query($conn, $sqlProyecto);
while ($data_proy = mysqli_fetch_assoc($sqlProy)) {
    $proyecto = $data_proy;
}

$unidades = [];
$resultadoUnidades = mysqli_query($conn, "SELECT * FROM unidad");
if ($resultadoUnidades) {
    while ($fila = mysqli_fetch_assoc($resultadoUnidades)) {
        $unidades[] = $fila;
    }
}

$riesgosProyecto = [];
$sqlRiesgos = "SELECT * FROM projects_risk,risk WHERE risk.id_risk = projects_risk.id_risk AND projects_risk.id_proyecto = '$id'";
$stmtRiesgos = mysqli_prepare($conn, $sqlRiesgos);
if ($stmtRiesgos) {
    mysqli_stmt_execute($stmtRiesgos);
    $resultadoRiesgos = mysqli_stmt_get_result($stmtRiesgos);
    while ($fila = mysqli_fetch_assoc($resultadoRiesgos)) {
        $riesgosProyecto[] = $fila;
    }
    mysqli_stmt_close($stmtRiesgos);
}

$nombreProyecto =  ($proyecto['nombre']);
$nombreManager =  ($users_pm['nombre_user'] . ' ' . $users_pm['apellido_user']);
$idManager =  ($users_pm['id_usuario']);
$nombreUnidad =  ($proyecto['nombre_unid'] ?? 'No especificada');
$versionInicial = '1.0';

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>Nueva planificación del proyecto</title>

    <link rel="stylesheet" href="../assets/coreui/coreui_min_css.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet">
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/code_icon_navbar.css">
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

        .required-mark {
            color: #dc3545;
        }

        .deferred-module {
            height: 100%;
            padding: 15px;
            border: 1px solid #e9ecef;
            border-radius: 9px;
            background: #fff;
        }

        .deferred-module .module-icon {
            width: 38px;
            height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: #e8eef5;
            color: #194070;
            margin-bottom: 10px;
        }

        .deferred-module p {
            color: #8392ab;
            font-size: 12px;
            margin-bottom: 8px;
        }

        .form-actions {
            border-top: 1px solid #edf0f3;
            background: #fff;
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
                        <p class="text-white opacity-8 mb-0">Registro inicial de la información general del plan de trabajo</p>
                    </div>
                    <span class="badge bg-white text-primary px-3 py-2">Nueva planificación</span>
                </div>
            </section>

            <!-- Identificación del proyecto -->
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
                        <div class="col-md-3">
                            <div class="planning-info">
                                <small>Project Manager</small>
                                <strong><?php echo $nombreManager; ?></strong>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="planning-info">
                                <small>Versión</small>
                                <strong><?php echo ($versionInicial); ?></strong>
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
                        <!-- <div class="lifecycle-step"><i class="material-icons-round">play_circle</i><br>Ejecución</div> -->
                    </div>
                </div>
            </section>

            <!-- Información aprobada: solo consulta -->
            <section class="card mb-4">
                <div class="card-header pb-0">
                    <h6 class="mb-1">
                        <i class="material-icons-round text-primary me-2">description</i>
                        Resumen aprobado de la propuesta
                    </h6>
                    <p class="text-sm text-secondary">Estos datos se recuperan del proyecto y de su evaluación. No se modifican durante el registro inicial del plan.</p>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label">Descripción del proyecto</label>
                            <div class="readonly-info"><?php echo ($proyecto['descripcion']); ?></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Unidad responsable</label>
                            <div class="readonly-info"><?php echo $nombreUnidad; ?></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Sponsor</label>
                            <div class="readonly-info"><?php echo ($proyecto['sponsor']); ?></div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Necesidad o problemática</label>
                            <div class="readonly-info"><?php echo ($proyecto['problema']); ?></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Objetivos aprobados</label>
                            <div class="readonly-info"><?php echo ($proyecto['objetivos']); ?></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Beneficios esperados</label>
                            <div class="readonly-info"><?php echo ($proyecto['beneficios']); ?></div>
                        </div>
                    </div>

                    <hr>
                    <h6 class="planning-section-title">Resultado de la evaluación</h6>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Técnica</label>
                            <div class="readonly-info"><?php echo ($proyecto['tecnica']); ?></div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Operativa</label>
                            <div class="readonly-info"><?php echo ($proyecto['operativa']); ?></div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Financiera</label>
                            <div class="readonly-info"><?php echo ($proyecto['financiera']); ?></div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Nivel de impacto</label>
                            <div class="readonly-info"><?php echo ($proyecto['nivel_impacto']); ?></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Observaciones de evaluación</label>
                            <div class="readonly-info"><?php echo ($proyecto['observaciones_eval']); ?></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Justificación de evaluación</label>
                            <div class="readonly-info"><?php echo ($proyecto['justificacion_eval']); ?></div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Decisión y justificación del Director</label>
                            <div class="readonly-info"><?php echo ($proyecto['justificacion_dir']); ?></div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Presupuesto estimado inicial</label>
                            <div class="readonly-info"><?php echo ($proyecto['presupuesto_est'] . "$"); ?></div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Inicio estimado inicial</label>
                            <div class="readonly-info"><?php echo ($proyecto['fecha_inicio']); ?></div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Final estimado inicial</label>
                            <div class="readonly-info"><?php echo ($proyecto['fecha_fin']); ?></div>
                        </div>
                    </div>
                </div>
            </section>

            <form method="POST" action="../pages/proses_plan_project.php?act=insert_init_plan_proj" id="form_planificacion" autocomplete="off">

                <input type="hidden" id="id_proyecto_for_plan" name="id_proyecto_for_plan" value="<?php echo (int) $id; ?>">

                <section class="card mb-4">
                    <div class="card-header pb-0">
                        <h6 class="mb-1">
                            <i class="material-icons-round text-primary me-2">assignment</i>
                            Información general del plan
                        </h6>
                        <p class="text-sm text-secondary">Complete los datos básicos que identificarán la primera versión del plan.</p>
                    </div>

                    <div class="card-body">
                        <div class="row g-3">

                            <div class="col-md-12">
                                <label class="form-label">Resumen ejecutivo <span class="required-mark">*</span></label>
                                <textarea class="form-control border px-3" id="resu_ejec_plan" name="resu_ejec_plan" rows="4" maxlength="300" placeholder="Explique cómo se organizará proyecto." required></textarea>
                                <div id="contador_resu_ejec_plan">300</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Fecha de inicio planificada <span class="required-mark">*</span></label>
                                <input type="date" class="form-control border px-3" id="fech_ini_plan" name="fech_ini_plan" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Fecha de finalización planificada <span class="required-mark">*</span></label>
                                <input type="date" class="form-control border px-3" id="fech_fin_plan" name="fech_fin_plan" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Project Manager</label>
                                <input type="text" class="form-control border px-3" value="<?php echo $nombreManager; ?>" readonly>
                                <input type="hidden" class="form-control border px-3" id="id_pm_plan" name="id_pm_plan" value="<?php echo $idManager; ?>" readonly>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Supuestos</label>
                                <textarea class="form-control border px-3" name="supuestos_plan_proj" id="supuestos_plan_proj" rows="3" maxlength="300" placeholder="Condiciones que se consideran ciertas para planificar el proyecto"></textarea>
                                <div id="contador_supuestos_plan_proj">300</div>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Restricciones</label>
                                <textarea class="form-control border px-3" name="restricc_plan_proj" id="restricc_plan_proj" rows="3" maxlength="300" placeholder="Limitaciones de tiempo, presupuesto, personal o tecnología"></textarea>
                                <div id="contador_restricc_plan_proj">300</div>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Dependencias externas</label>
                                <textarea class="form-control border px-3" name="depend_externas_plan_proj" id="depend_externas_plan_proj" rows="3" maxlength="300" placeholder="Proveedores, autorizaciones u otros factores externos necesarios"></textarea>
                                <div id="contador_depend_externas_plan_proj">300</div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Fecha de Registro:</label><br>
                                <input type="datetime-local" class="form-control border px-3" id="fecha_reg_min_plan_proy" name="fecha_reg_min_plan_proy" readonly>
                            </div>
                            <script>
                                var fechaActual = new Date();
                                var formattedDateTime = fechaActual.getFullYear() + '-' + ('0' + (fechaActual.getMonth() + 1)).slice(-2) + '-' + ('0' + fechaActual.getDate()).slice(-2) + 'T' + ('0' + fechaActual.getHours()).slice(-2) + ':' + ('0' + fechaActual.getMinutes()).slice(-2);
                                document.getElementById('fecha_reg_min_plan_proy').value = formattedDateTime;
                            </script>

                        </div>
                    </div>
                </section>

            </form>

            <section class="card mb-4">
                <div class="card-header pb-0">
                    <h6 class="mb-1">
                        <i class="material-icons-round text-primary me-2">widgets</i>
                        Otros componentes de la planificación
                    </h6>
                    <p class="text-sm text-secondary">Estos apartados se habilitarán después de crear el registro general del plan.</p>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4 col-sm-6">
                            <div class="deferred-module">
                                <span class="module-icon"><i class="material-icons-round">target</i></span>
                                <h6 class="mb-1">Alcance y entregables</h6>
                                <p>Definición del alcance, entregables y criterios de aceptación.</p>
                                <span class="badge bg-secondary">Se configurará después</span>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="deferred-module">
                                <span class="module-icon"><i class="material-icons-round">list_alt</i></span>
                                <h6 class="mb-1">Actividades y cronograma</h6>
                                <p>Actividades, responsables, fechas, hitos y dependencias.</p>
                                <span class="badge bg-secondary">Se configurará después</span>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="deferred-module">
                                <span class="module-icon"><i class="material-icons-round">inventory_2</i></span>
                                <h6 class="mb-1">Recursos</h6>
                                <p>Recursos humanos, materiales, tecnológicos y disponibilidad.</p>
                                <span class="badge bg-secondary">Se configurará después</span>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="deferred-module">
                                <span class="module-icon"><i class="material-icons-round">payments</i></span>
                                <h6 class="mb-1">Presupuesto</h6>
                                <p>Partidas, cantidades, costos unitarios y monto planificado.</p>
                                <span class="badge bg-secondary">Se configurará después</span>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="deferred-module">
                                <span class="module-icon"><i class="material-icons-round">warning</i></span>
                                <h6 class="mb-1">Riesgos y supuestos</h6>
                                <p>Respuestas, responsables y fechas de seguimiento de riesgos.</p>
                                <span class="badge bg-secondary">Se configurará después</span>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="deferred-module">
                                <span class="module-icon"><i class="material-icons-round">monitoring</i></span>
                                <h6 class="mb-1">Seguimiento y comunicación</h6>
                                <p>Indicadores, frecuencia de reportes y responsables.</p>
                                <span class="badge bg-secondary">Se configurará después</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Acciones: se envía solamente la información general -->
            <div class="d-flex flex-column flex-sm-row justify-content-between gap-2 pb-4">
                <button type="submit"
                    form="form_planificacion"
                    class="btn bg-gradient-primary mb-0">
                    <i class="material-icons-round me-1">save</i>
                    Crear plan inicial
                </button>
            </div>

        </div>
    </main>

    <script src="../assets/coreui/coreui_bundle_min_js.js"></script>
    <script>
        // La fecha final planificada no puede ser anterior a la fecha inicial.
        document.addEventListener('DOMContentLoaded', function() {
            const inicio = document.getElementById('fecha_inicio_plan');
            const fin = document.getElementById('fecha_fin_plan');
            const formulario = document.getElementById('form_planificacion');

            if (!inicio || !fin || !formulario) return;

            inicio.addEventListener('change', function() {
                fin.min = inicio.value || '';
                if (fin.value && inicio.value && fin.value < inicio.value) {
                    fin.value = '';
                }
            });

            formulario.addEventListener('submit', function(event) {
                if (inicio.value && fin.value && fin.value < inicio.value) {
                    event.preventDefault();
                    alert('La fecha de finalización no puede ser anterior a la fecha de inicio.');
                    fin.focus();
                }
            });
        });
    </script>

    <script>
        function limitarTextarea(idTextarea, idContador, maximoCaracteres = 300) {
            const textarea = document.getElementById(idTextarea);
            const contador = document.getElementById(idContador);

            const mensajeError = document.createElement('p');
            mensajeError.classList.add('text-danger');
            mensajeError.textContent = 'Has superado el límite de caracteres. ERROR (Reiniciar el Registro).';
            mensajeError.style.display = 'none';
            textarea.parentNode.appendChild(mensajeError);

            const actualizarContador = () => {
                const restantes = maximoCaracteres - textarea.value.length;
                contador.textContent = restantes;

                if (restantes < 0) {
                    mensajeError.style.display = 'block';
                    textarea.disabled = true;
                } else {
                    mensajeError.style.display = 'none';
                    textarea.disabled = false;
                }
            };

            textarea.addEventListener('input', actualizarContador);
            actualizarContador();
        }

        limitarTextarea("resu_ejec_plan", "contador_resu_ejec_plan", 300);
        limitarTextarea("supuestos_plan_proj", "contador_supuestos_plan_proj", 300);
        limitarTextarea("restricc_plan_proj", "contador_restricc_plan_proj", 300);
        limitarTextarea("depend_externas_plan_proj", "contador_depend_externas_plan_proj", 300);
    </script>

</body>

</html>