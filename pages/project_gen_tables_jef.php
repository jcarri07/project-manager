<?php
require_once('../databases/conexion.php');
session_start();


if (!isset($_SESSION['id_usuario'])) {
  // Redirigir al usuario a la página de inicio de sesión
  header("Location: ../index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Sistema de Gestion de Proyectos
  </title>

  <!-- 1. Material Dashboard -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
  <!-- Theme Override: Corporate Blue #194070 -->
  <link href="../assets/css/theme-override.css" rel="stylesheet">

  <!-- 2. CoreUI -->
  <link rel="stylesheet" href="../assets/coreui/coreui_min_css.css">

  <!-- 3. Bootstrap: una sola vez -->
  <link rel="stylesheet" href="../assets/Bootstrap/css/bootstrap.min.css">

  <!-- 4. Iconos -->
  <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">

  <!-- 5. Estilos propios del proyecto y de los modales -->
  <link rel="stylesheet" href="../assets/css/code_icon_navbar.css">
  <link rel="stylesheet" href="../assets/css/material-modal.css">
  <link rel="stylesheet" href="../assets/css/dash-modal_miemb.css">

  <!-- 6. DataTables -->
  <link rel="stylesheet" href="../assets/DataTable/datatables.min.css">
  <link rel="stylesheet" href="../assets/css/code_tables_miemb_users.css">

  <link rel="stylesheet" href="../assets/css/material-project_gen_tables_jef.css">
</head>


<body class="g-sidenav-show  bg-gray-200">
  <?php
  include("./code_navbar.php");
  $query_users = mysqli_query($conn, "SELECT id_usuario, CONCAT(nombre_user, ' ', apellido_user) AS nombre_completo FROM users");
  $mapa_pm = [];
  while ($u = mysqli_fetch_assoc($query_users)) {
    $mapa_pm[$u['id_usuario']] = $u['nombre_completo'];
  }
  ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tables</li>
          </ol>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          </div>
          <ul class="navbar-nav  justify-content-end">

            <li class="nav-item d-flex align-items-center">
              <a href="../logout.php" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Cerrar Sesión</span>
              </a>
            </li>

    </nav>

    <div class="d-flex justify-content-center align-items-md-center mt-2">

      <div class="col-12 px-3">

        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">

            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">

              <div class="d-flex align-items-center gap-3 px-3">

                <div class="d-flex align-items-center gap-3 px-3">
                  <h2 class="text-white fw-bold text-capitalize mb-0" style="font-size: 1.8rem;">
                    <i class="fas fa-project-diagram me-2 text-white"></i> Proyectos
                  </h2>
                </div>

              </div>

              <br>

            </div>

            <div class="col-12 mt-3 px-3">

              <div class="d-flex flex-wrap align-items-center gap-3">

                <ul class="nav nav-pills flex-row p-1" id="proyectosTabs" role="tablist">

                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="valid_pro-tab" data-bs-toggle="tab" data-bs-target="#valid_pro-pane" type="button" role="tab" aria-controls="valid_pro-pane" aria-selected="false">Propuestas</button>
                  </li>

                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="plan_pro_mana-tab" data-bs-toggle="tab" data-bs-target="#plan_pro_mana-pane" type="button" role="tab" aria-controls="plan_pro_mana-pane" aria-selected="false">Desarrollo de la planificación</button>
                  </li>

                </ul>

              </div>

            </div>

          </div>

          <div class="card-body px-3 pb-3">

            <div class="tab-content" id="proyectosTabsContent">

              <div class="tab-pane fade show active" id="valid_pro-pane" role="tabpanel" aria-labelledby="valid_pro-tab" tabindex="0">

                <div class="table-responsive">

                  <table id="tabla_valid_proyectos_pro" class="table tabla-proyectos align-items-center justify-content-center" style="width:100%">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Proyecto</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unidad</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">PM</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estado</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Salud</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Inicio</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fin</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Progreso</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Prioridad</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Opciones</th>

                      </tr>
                    </thead>

                    <tbody>
                    </tbody>

                  </table>

                </div>

              </div>

              <div class="tab-pane fade show" id="plan_pro_mana-pane" role="tabpanel" aria-labelledby="plan_pro_mana-tab" tabindex="0">

                <div class="table-responsive">

                  <table id="tabla_planinn_proyectos" class="table tabla-proyectos align-items-center justify-content-center" style="width:100%">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Proyecto</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unidad</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">PM</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estado</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Salud</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Inicio</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fin</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Progreso</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Prioridad</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Opciones</th>

                      </tr>
                    </thead>

                    <tbody>
                    </tbody>

                  </table>

                </div>

              </div>

            </div>

          </div>



        </div>
      </div>
    </div>

    </div>
  </main>

  <!-- ------------------Codigo del modal para realizar la evaluación de los proyectos asignados ------------------ -->

  <div class="modal w3-container" id="Modal_valid" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content w3-animate-opacity">
        <div class="w3-container w3-teal">
          <br>
          <p class="modal-title" style="color: black;">Proyecto Pendiente de Evaluación</p>
          <br>
          <div class="w3-center">
            <span
              class="closeAndRedirect w3-button w3-xlarge w3-hover-red w3-display-topright"
              title="Cerrar modal">
              &times;
            </span>
          </div>
        </div>

        <div class="w3-container modal-body" id="modalBody">

          <form class="row g-3" action="./proses_proyecto.php?act=insert_eval_proy" id="form-upload" enctype="multipart/form-data" method="POST">

            <input type="hidden" style="display:none" class="form-control" id="edit_id_Proy_2" name="edit_id_Proy_2" readonly>

            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="check_data_proyValid" checked>
              <label class="form-check-label" for="check_data_proyValid">Información de la Propusta</label>
            </div>

            <div id="data_proy_container">

              <div class="row g-3">

                <div class="col-md-4" style="color:black">
                  <label for="Comando" class="form-label">Nombre del Proyecto: </label>
                  <input type="text" class="form-control" id="edit_nombre_proy_2" name="edit_nombre_proy_2" disabled>
                </div>

                <div class="col-md-4" style="color:black">
                  <label for="Cond" class="form-label">Solicitante: </label>
                  <select class="form-select" id="edit_id_solic_proy_2" name="edit_id_solic_proy_2" disabled>
                    <?php
                    $query_data = mysqli_query($conn, "SELECT * FROM users");
                    while ($miembro = mysqli_fetch_assoc($query_data)) {
                      $id = $miembro['id_usuario'];
                      $nombre = ($miembro['nombre_user']);
                      $apell = ($miembro['apellido_user']);
                      echo "<option value=\"$id\">$nombre $apell</option>";
                    }
                    ?>
                  </select>
                </div>

                <div class="col-md-4" style="color:black">
                  <label for="Cond" class="form-label">Unidad: </label>
                  <select class="form-select" id="edit_unidad_proy_2" name="edit_unidad_proy_2" disabled>
                    <?php
                    $query_data = mysqli_query($conn, "SELECT * FROM unidad");
                    while ($miembro = mysqli_fetch_assoc($query_data)) {
                      $id = $miembro['id_unidad'];
                      $nombre = ($miembro['nombre_unid']);
                      echo "<option value=\"$id\">$nombre</option>";
                    }
                    ?>
                  </select>
                </div>

              </div>

              <br>

              <div class="row g-3">

                <div class="col-md-3" style="color:black">
                  <label for="Comando" class="form-label">Tipo: </label>
                  <input type="text" class="form-control" id="edit_tipo_proy_2" name="edit_tipo_proy_2" disabled>
                </div>

                <div class="col-md-3" style="color:black">
                  <label for="Comando" class="form-label">Prioridad: </label>
                  <input type="text" class="form-control" id="edit_prioridad_proy_2" name="edit_prioridad_proy_2" disabled>
                </div>

                <div class="col-md-3" style="color:black">
                  <label for="Comando" class="form-label">Sponsor: </label>
                  <input type="text" class="form-control" id="edit_sponsor_proy_2" name="edit_sponsor_proy_2" disabled>
                </div>

              </div>

              <br>

              <div class="row g-3">

                <div class="col-md-3" style="color:black">
                  <label class="form-label">Inicio estimado</label>
                  <input type="date" name="edit_fecha_inicio_proy_2" id="edit_fecha_inicio_proy_2" class="form-control border px-3" disabled>
                </div>

                <div class="col-md-3">
                  <label class="form-label">Final estimado</label>
                  <input type="date" name="edit_fecha_fin_proy_2" id="edit_fecha_fin_proy_2" class="form-control border px-3" disabled>
                </div>

                <div class="col-md-3" style="color:black">
                  <label for="Comando" class="form-label">Presupesto: </label>
                  <div class="input-group col-md-">
                    <input type="number" class="form-control" id="edit_presupuesto_est_proy_2" name="edit_presupuesto_est_proy_2" disabled>
                    <span class="input-group-text">$</span>
                  </div>
                </div>

                <div class="col-md-3" style="color:black">
                  <label for="Comando" class="form-label">Avance: </label>
                  <div class="input-group col-md-">
                    <input type="number" class="form-control" id="edit_avance_proy_2" name="edit_avance_proy_2" disabled>
                    <span class=" input-group-text">%</span>
                  </div>
                </div>

              </div>

              <div class="row g-3">

                <div class="col-md-3" style="color:black">
                  <label for="Grafica" class="form-label">Problematica: </label>
                  <textarea name="edit_problema_proy_2" id="edit_problema_proy_2" cols="40" rows="4" class="form-control" readonly></textarea>
                  <div id="contador_edit_problema_proy_1"></div>
                </div>

                <div class="col-md-3" style="color:black">
                  <label for="Grafica" class="form-label">Objetivos del Proyecto: </label>
                  <textarea name="edit_objetivos_proy_2" id="edit_objetivos_proy_2" cols="40" rows="4" class="form-control" readonly></textarea>
                  <div id="contador_edit_objetivos_proy_2"></div>
                </div>

                <div class="col-md-3" style="color:black">
                  <label for="Grafica" class="form-label">Beneficios del Proyecto: </label>
                  <textarea name="edit_beneficios_proy_2" id="edit_beneficios_proy_2" cols="40" rows="4" class="form-control" readonly></textarea>
                  <div id="contador_edit_beneficios_proy_2"></div>
                </div>

                <div class="col-md-3" style="color:black">
                  <label for="Grafica" class="form-label">Descripción del Proyecto: </label>
                  <textarea name="edit_descripcion_proy_2" id="edit_descripcion_proy_2" cols="40" rows="4" class="form-control" readonly></textarea>
                  <div id="contador_edit_descripcion_proy_2"></div>
                </div>

              </div>

            </div>

            <br>

            <div class="row g-3">

              <div class="col-md-6" style="color:black">
                <label for="Comando" class="form-label">Técnica: </label>
                <select name="tecnica_proy_valid" id="tecnica_proy_valid" class="form-select border px-3" required>
                  <option value="">Seleccione la técnica</option>
                  <option value="Viable">Viable</option>
                  <option value="No viable">No viable</option>
                </select>
              </div>

              <div class="col-md-6" style="color:black">
                <label for="Comando" class="form-label">Operativa: </label>
                <select class="form-select border px-3" id="operativa_proy_valid" name="operativa_proy_valid" required>
                  <option value="">Seleccione la Operatividad</option>
                  <option value="Viable">Viable</option>
                  <option value="No viable">No viable</option>
                </select>
              </div>

            </div>

            <div class="row g-3">

              <div class="col-md-6" style="color:black">
                <label for="Comando" class="form-label">Financiera: </label>
                <select class="form-select border px-3" id="financiera_proy_valid" name="financiera_proy_valid" required>
                  <option value="">Seleccione la Operatividad</option>
                  <option value="Viable">Viable</option>
                  <option value="Viable con condiciones">Viable con condiciones</option>
                  <option value="Intermedio">Intermedio</option>
                  <option value="No viable">No viable</option>
                </select>
              </div>

              <div class="col-md-6" style="color:black">
                <label for="Comando" class="form-label">Organizacional: </label>
                <input type="text" class="form-control" id="organizacional_proy_valid" name="organizacional_proy_valid" required>
              </div>

            </div>

            <div class="row g-3">

              <div class="col-md-6" style="color:black">
                <label for="Comando" class="form-label">Areas Impactadas: </label>
                <input type="text" class="form-control" id="areas_imp_proy_valid" name="areas_imp_proy_valid" required>
              </div>

              <div class="col-md-6" style="color:black">
                <label for="Comando" class="form-label">Nivel de Impacto: </label>
                <select class="form-select border px-3" id="nivel_imp_proy_valid" name="nivel_imp_proy_valid" required>
                  <option value="">Seleccione el nivel de impacto</option>
                  <option value="Baja">Baja</option>
                  <option value="Media">Media</option>
                  <option value="Alta">Alta</option>
                  <option value="Crítica">Crítica</option>
                </select>
              </div>

            </div>

            <div class="row g-3">

              <div class="col-md-12" style="color:black">
                <label for="Grafica" class="form-label">Observaciones: </label>
                <textarea name="observa_eval_proy_valid" id="observa_eval_proy_valid" maxlength="300" cols="40" rows="4" class="form-control" required></textarea>
                <div id="contador_observa_eval_proy_valid"></div>
              </div>

            </div>

            <div class="row g-3">

              <div class="col-md-4" style="color:black">
                <label for="Comando" class="form-label">Presupuesto Estimado (Actualizacion): </label>
                <input type="text" class="form-control" id="presu_est_proy_valid" name="presu_est_proy_valid" required>
              </div>

              <div class="col-md-4" style="color:black">
                <label for="Comando" class="form-label">Duración Estimada: </label>
                <input type="text" class="form-control" id="dur_est_proy_valid" name="dur_est_proy_valid" required>
              </div>

              <div class="col-md-4" style="color:black">
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" id="check_ver_riesgos" checked>
                  <label class="form-check-label" for="check_ver_riesgos">Asignar riesgos</label>
                </div>
              </div>

            </div>

            <div class="col-md-12 mb-3" id="ver_riesgos_container">

              <div class="row g-3">
                <div class="col-md-12" style="color:black">

                  <label class="form-label">Riesgos registrados:</label>
                  <br>
                  <button type="button" class="btn btn-outline-primary btn-sm mb-3" onclick="abrirModalAgregarRiesgo()">
                    <i class="material-icons text-sm">add_circle</i>
                    Agregar Riesgo
                  </button>
                  <br>

                  <div class="table-responsive">
                    <table id="tabla_riesgos_seleccion" class="table table-hover table-striped align-middle">

                      <thead class="table-light">
                        <tr>
                          <th class="text-center">Seleccionar</th>
                          <th class="text-center">Riesgo</th>
                          <th class="text-center">Probabilidad</th>
                          <th class="text-center">Impacto</th>
                          <th class="text-center">Nivel</th>
                          <th class="text-center">Acciones</th>
                        </tr>
                      </thead>

                      <tbody>

                        <?php
                        $query_riesgos = mysqli_query($conn, "SELECT * FROM risk");

                        if ($query_riesgos && mysqli_num_rows($query_riesgos) > 0) {

                          while ($riesgo = mysqli_fetch_assoc($query_riesgos)) {

                            $id_riesgo = (int)$riesgo['id_risk'];
                            $nombre_riesgo = htmlspecialchars($riesgo['riesgo']);
                            $probabilidad = htmlspecialchars($riesgo['probabilidad']);
                            $impacto = htmlspecialchars($riesgo['impacto']);
                            $nivel = htmlspecialchars($riesgo['nivel_risk']);
                            $acciones = htmlspecialchars($riesgo['acciones']);
                        ?>

                            <tr>
                              <td class="text-center">
                                <input type="checkbox" class="form-check-input chk_riesgo_seleccion" name="riesgos_proy_valid[]" value="<?php echo $id_riesgo; ?>">
                              </td>
                              <td class="text-center"><?php echo $nombre_riesgo; ?></td>
                              <td class="text-center"><?php echo $probabilidad; ?></td>
                              <td class="text-center"><?php echo $impacto; ?></td>
                              <td class="text-center"><?php echo $nivel; ?></td>
                              <td class="text-center"><?php echo $acciones; ?></td>
                            </tr>

                          <?php
                          }
                        } else {
                          ?>

                          <tr>
                            <td colspan="6" class="text-center text-secondary">
                              No hay riesgos registrados.
                            </td>
                          </tr>

                        <?php } ?>

                      </tbody>
                    </table>
                  </div>

                  <small class="text-secondary">
                    Seleccione los riesgos que correspondan al proyecto.
                  </small>

                </div>
              </div>

            </div>

            <div class="row g-3">

              <div class="col-md-12" style="color:black">
                <label for="Grafica" class="form-label">Recursos Requeridos: </label>
                <textarea name="recur_requer_proy_valid" id="recur_requer_proy_valid" maxlength="300" cols="40" rows="4" class="form-control" required></textarea>
                <div id="contador_recur_requer_proy_valid"></div>
              </div>

            </div>


            <div class="row g-3">

              <div class="col-md-12" style="color:black">
                <label for="Grafica" class="form-label">Justificación: </label>
                <textarea name="just_eval_proy_valid" id="just_eval_proy_valid" maxlength="300" cols="40" rows="4" class="form-control" required></textarea>
                <div id="contador_just_eval_proy_valid">300</div>
              </div>

            </div>

            <div class="row g-3">
              <div class="col-12">
                <p class="form-label fw-semibold mb-2" style="color:#194070;">Decisión <span class="text-danger">*</span></p>
                <div class="decision-card-group">

                  <div class="decision-card decision-card--aprobar">
                    <input class="decision-card__input" type="radio"
                      name="decision_proy_eval" id="flexRadioDefault1"
                      value="1" required>
                    <label class="decision-card__label" for="flexRadioDefault1">
                      <span class="decision-card__icon">
                        <i class="fa-solid fa-circle-check"></i>
                      </span>
                      <span class="decision-card__title">Aprobar</span>
                      <span class="decision-card__desc">El proyecto queda autorizado para continuar.</span>
                    </label>
                  </div>

                  <div class="decision-card decision-card--info">
                    <input class="decision-card__input" type="radio"
                      name="decision_proy_eval" id="flexRadioDefault2"
                      value="2">
                    <label class="decision-card__label" for="flexRadioDefault2">
                      <span class="decision-card__icon">
                        <i class="fa-solid fa-circle-exclamation"></i>
                      </span>
                      <span class="decision-card__title">Solicitar información adicional</span>
                      <span class="decision-card__desc">Reformular la propuesta.</span>
                    </label>
                  </div>

                  <div class="decision-card decision-card--rechazar">
                    <input class="decision-card__input" type="radio"
                      name="decision_proy_eval" id="flexRadioDefault3"
                      value="3">
                    <label class="decision-card__label" for="flexRadioDefault3">
                      <span class="decision-card__icon">
                        <i class="fa-solid fa-circle-xmark"></i>
                      </span>
                      <span class="decision-card__title">No aprobar</span>
                      <span class="decision-card__desc">La iniciativa sera cancelada.</span>
                    </label>
                  </div>

                </div>
              </div>
            </div>

            <br><br><br>

            <div class="d-grid gap-2 col-6 mx-auto">

              <button type="submit" class="btn btn-primary" id="Redirect" data-bs-dismiss="modal">Guardar</button>

            </div>

            <br><br>

          </form>

        </div>

        <div class="w3-teal modal-footer">
          <br><br>
        </div>

      </div>
    </div>
  </div>

  <!-- ------------------Codigo del modal para gestionar los riesgos para las riesgos ------------------ -->

  <div class="modal fade" id="Modal_agregar_riesgo" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="titulo_modal_riesgo" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

      <div class="modal-content">

        <div class="w3-container w3-teal">
          <br>
          <p class="modal-title" style="color: black;">Registrar nuevo riesgo</p>
          <br>
          <!--
          <div class="w3-center">
            <span
              class="closeAndRedirect w3-button w3-xlarge w3-hover-red w3-display-topright"
              title="Cerrar modal">
              &times;
            </span>
          </div>
              -->
          <!--
              <button type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Cerrar">
          </button>
           -->

        </div>

        <form id="form_agregar_riesgo" action="./proses_proyecto.php?act=insert_risk" method="POST">

          <div class="modal-body" style="color:black">

            <div class="mb-3">

              <label class="form-label">Nombre del riesgo *</label>

              <input type="text" class="form-control" id="new_riesgo" name="new_riesgo" required>

            </div>

            <div class="row">

              <div class="col-md-6 mb-3">

                <label class="form-label">Probabilidad *</label>

                <select class="form-select" name="new_riesgo_probabilidad" id="new_riesgo_probabilidad" required>
                  <option value="">Seleccione</option>
                  <option value="Baja">Baja</option>
                  <option value="Media">Media</option>
                  <option value="Alta">Alta</option>
                </select>

              </div>

              <div class="col-md-6 mb-3">

                <label class="form-label">Impacto *</label>

                <select class="form-select" name="new_riesgo_impacto" id="new_riesgo_impacto" required>

                  <option value="">Seleccione</option>
                  <option value="Baja">Baja</option>
                  <option value="Media">Media</option>
                  <option value="Alta">Alta</option>
                  <option value="Crítica">Crítica</option>

                </select>

              </div>

              <div class="col-md-6 mb-3">

                <label class="form-label">Nivel *</label>

                <select class="form-select" name="new_riesgo_nivel" id="new_riesgo_nivel" required>

                  <option value="">Seleccione</option>
                  <option value="Baja">Baja</option>
                  <option value="Media">Media</option>
                  <option value="Alta">Alta</option>
                  <option value="Crítica">Crítica</option>

                </select>

              </div>

            </div>

            <div class="mb-3">

              <label class="form-label">Acciones recomendadas *</label>

              <textarea class="form-control" name="new_riesgo_acciones" id="new_riesgo_acciones" rows="4" maxlength="300" placeholder="Describa las acciones preventivas." required></textarea>

            </div>

          </div>

          <div class="modal-footer">

            <button type="button" class="btn btn-secondary mb-0" data-bs-dismiss="modal"> Cancelar </button>

            <button type="submit" class="btn btn-primary mb-0" id="btn_guardar_riesgo"> <i class="material-icons text-sm">save</i> Guardar </button>

          </div>

        </form>

      </div>

    </div>
  </div>

  <!-- ------------------Codigo del modal menu para completar el plan de proyecto ------------------ -->

  <div class="modal fade" id="modal_menu_multiple" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="titulo_menu_multiple" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

      <div class="modal-content">

        <div class="w3-container w3-teal modal-header">

          <div>
            <h5 class="modal-title" id="titulo_menu_multiple">
              Gestión de la planificación
            </h5>

            <p class="modal-title">
              Seleccione el componente que desea completar.
            </p>

            <small class="modal-title">
              Identificador del plan:
              <strong id="numero_plan_seleccionado"></strong>
            </small>
          </div>

          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>

        </div>

        <div class="modal-body">

          <input type="hidden" id="id_project_plans_menu" name="id_project_plans_menu">
          <input type="hidden" id="id_proyecto_menu" name="id_proyecto_menu">

          <div class="row g-3">

            <div class="col-md-4 col-sm-6">

              <div class="card border h-100 mb-0">

                <div class="card-body">

                  <div class="mb-3">
                    <i class="fa-solid fa-bullseye fa-xl text-primary"></i>
                  </div>

                  <h6>Alcance y entregables</h6>

                  <p class="text-sm text-secondary"> Definición del alcance, entregables y criterios de aceptación. </p>

                  <button type="button" class="btn btn-outline-primary btn-sm mb-0" onclick="abrirModal_componente('modalAlcancePlan')">
                    <i class="fa-solid fa-pen-to-square me-1"></i>
                    Completar
                  </button>

                </div>
              </div>
            </div>

            <div class="col-md-4 col-sm-6">

              <div class="card border h-100 mb-0">

                <div class="card-body">

                  <div class="mb-3">
                    <i class="fa-solid fa-list-check fa-xl text-primary"></i>
                  </div>

                  <h6>Actividades y cronograma</h6>

                  <p class="text-sm text-secondary"> Actividades, responsables, fechas, hitos y dependencias.</p>

                  <button type="button" class="btn btn-outline-primary btn-sm mb-0" onclick="abrirModal_componente('modalActividadesPlan')">
                    <i class="fa-solid fa-pen-to-square me-1"></i>
                    Completar
                  </button>

                </div>
              </div>
            </div>

            <div class="col-md-4 col-sm-6">

              <div class="card border h-100 mb-0">

                <div class="card-body">

                  <div class="mb-3">
                    <i class="fa-solid fa-money-bill-wave fa-xl text-primary"></i>
                  </div>

                  <h6>Recursos y presupuesto</h6>

                  <p class="text-sm text-secondary"> Recursos humanos, materiales, tecnológicos y Presupuesto. </p>

                  <button type="button" class="btn btn-outline-primary btn-sm mb-0" onclick="abrirModal_componente('modalRecursosPresupuestoPlan')">
                    <i class="fa-solid fa-pen-to-square me-1"></i>
                    Completar
                  </button>

                </div>
              </div>
            </div>

            <div class="col-md-4 col-sm-6">

              <div class="card border h-100 mb-0">

                <div class="card-body">

                  <div class="mb-3">
                    <i class="fa-solid fa-triangle-exclamation fa-xl text-primary"></i>
                  </div>

                  <h6>Riesgos y supuestos</h6>

                  <p class="text-sm text-secondary">
                    Riesgos identificados, probabilidad,
                    impacto y respuestas previstas.
                  </p>

                  <button type="button"
                    class="btn btn-outline-primary btn-sm mb-0"
                    onclick="abrirModal_componente('modalRiesgosPlan')">
                    <i class="fa-solid fa-pen-to-square me-1"></i>
                    Completar
                  </button>

                </div>
              </div>
            </div>

            <div class="col-md-4 col-sm-6">

              <div class="card border h-100 mb-0">

                <div class="card-body">

                  <div class="mb-3">
                    <i class="fa-solid fa-chart-line fa-xl text-primary"></i>
                  </div>

                  <h6>Seguimiento y comunicación</h6>

                  <p class="text-sm text-secondary">
                    Indicadores, frecuencia de reportes
                    y responsables.
                  </p>

                  <button type="button" class="btn btn-outline-primary btn-sm mb-0" onclick="abrirModal_componente('modalSeguimientoPlan')"> <i class="fa-solid fa-pen-to-square me-1"></i> Completar </button>

                </div>
              </div>
            </div>

          </div>

        </div>

      </div>
    </div>
  </div>

  <!-- ------------------Codigos de los sub-modal menu para completar el plan de proyecto ------------------ -->

  <!--  MODAL: ALCANCE Y ENTREGABLES -->

  <div class="modal fade" id="modalAlcancePlan" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="titulo_modal_alcance" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">

      <div class="modal-content">

        <div class="w3-container w3-teal modal-header">

          <div>
            <h5 class="modal-title" id="titulo_modal_alcance">
              <i class="fa-solid fa-bullseye text-primary me-2"></i>
              Alcance y entregables
            </h5>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"> </button>

        </div>

        <div class="modal-body">

          <form id="formAlcancePlan" action="./proses_plan_project.php?act=insert_alcance_plan_proy" method="POST">

            <input type="hidden" id="id_project_plans_alcance" name="id_project_plans" value="">

            <div class="mb-4">
              <label for="alcance_incluido" class="form-label"> Alcance incluido <span class="text-danger">*</span> </label>
              <textarea class="form-control" id="proy_plan_alcance_incluido" name="proy_plan_alcance_incluido" rows="3" required></textarea>
            </div>

            <div class="mb-3">
              <label for="alcance_excluido" class="form-label"> Alcance excluido </label>
              <textarea class="form-control" id="proy_plan_alcance_excluido" name="proy_plan_alcance_excluido" rows="3" required></textarea>
            </div>

            <div class="mb-4">

              <input type="datetime-local" class="form-control" id="fecha_upt_plan_proy" name="fecha_upt_plan_proy" style="display:none" readonly>
              <script>
                var fechaActual = new Date();
                var formattedDateTime = fechaActual.getFullYear() + '-' + ('0' + (fechaActual.getMonth() + 1)).slice(-2) + '-' + ('0' + fechaActual.getDate()).slice(-2) + 'T' + ('0' + fechaActual.getHours()).slice(-2) + ':' + ('0' + fechaActual.getMinutes()).slice(-2);
                document.getElementById('fecha_upt_plan_proy').value = formattedDateTime;
              </script>

            </div>

            <div class="mb-4">
              <button type="submit" class="btn btn-primary mb-0" id="btnGuardarAlcance"> <i class="fa-solid fa-floppy-disk me-1"></i> Guardar alcance </button>
            </div>

          </form>

          <br><br>

          <div class="row g-3">

            <div class="col-md-12 mb-3">

              <div class="col-md-4" style="color:black">
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" id="check_form_entregable" checked>
                  <label class="form-check-label" for="check_form_entregable">Registrar Entregable</label>
                </div>
              </div>

              <div class="row g-3">
                <div class="col-md-12" style="color:black">

                  <label class="form-label">Entregables registrados:</label>
                  <br>
                  <br>

                  <div class="table-responsive">
                    <table id="tabla_data_entregables_plan" class="table table-hover table-striped align-middle">

                      <thead class="table-light">
                        <tr>
                          <th class="text-center">ID</th>
                          <th class="text-center">Entregable</th>
                          <th class="text-center">Crit. Aceptacion</th>
                          <th class="text-center">Fecha Estimada</th>
                          <th class="text-center">Responsable</th>
                          <th class="text-center">Acciones</th>
                        </tr>
                      </thead>

                      <tbody id="tbody_entregables_plan">
                        <tr>
                          <td colspan="6" class="text-center text-secondary">
                            Seleccione una planificación para consultar sus entregables.
                          </td>
                        </tr>
                      </tbody>

                      <tfoot>
                        <tr class="table-primary fw-bold">
                          <td class="text-center">—</td>
                          <td class="text-center"></td>
                          <td class="text-center">—</td>
                          <td class="text-center">—</td>
                          <td class="text-center">—</td>
                          <td class="text-center">—</td>
                        </tr>
                      </tfoot>

                    </table>
                  </div>

                </div>
              </div>

              <div>

              </div>



            </div>

          </div>

          <div class="row g-3" id="ver_form_entregables_container">

            <form id="formRegEntregable" action="./proses_plan_project.php?act=insert_entregable_plan_proy" method="POST">

              <input type="hidden" id="id_project_plans_entregable" name="id_project_plans" value="">

              <div class="row g-3">

                <div class="col-md-6">
                  <label class="form-label">Nombre del entregable: <span class="text-danger">*</span></label>
                  <input type="text" class="form-control border px-3" id="nom_entregable" name="nom_entregable" required>
                </div>

                <div class="mb-4">
                  <label for="alcance_incluido" class="form-label">Descripción del entregable: <span class="text-danger">*</span> </label>
                  <textarea class="form-control" id="descripcion_entre" name="descripcion_entre" rows="5" required></textarea>
                </div>

                <div class="mb-4">
                  <label for="alcance_incluido" class="form-label">Criterios de aceptación: <span class="text-danger">*</span> </label>
                  <textarea class="form-control" id="criterios_acept" name="criterios_acept" rows="5" required></textarea>
                </div>

                <div class="mb-4">
                  <label for="responsable" class="form-label">Responsable: </label>
                  <select class="form-select" id="id_respon_select" name="id_respon_select">
                    <option value="">Seleccione un reponsable</option>
                    <?php
                    $query_data = mysqli_query($conn, "SELECT * FROM users");

                    while ($miembro = mysqli_fetch_assoc($query_data)) {
                      $id_user = $miembro['id_usuario'];
                      $nombre = ($miembro['nombre_user']);
                      $apell = ($miembro['apellido_user']);
                      $esp = ($miembro['especialidad']);
                      echo "<option value=\"$id_user\">$nombre $apell | Especialidad: $esp</option>";
                    }
                    ?>
                  </select>
                </div>

                <div class="col-md-4">
                  <label class="form-label">Fecha de Entrega: <span class="text-danger">*</span></label>
                  <input type="date" class="form-control border px-3" id="fech_entregable" name="fech_entregable" required>
                </div>

                <div class="mb-4">

                  <input type="datetime-local" class="form-control" id="fecha_reg_entreg" name="fecha_reg_entreg" style="display:none" readonly>
                  <script>
                    var fechaActual = new Date();
                    var formattedDateTime = fechaActual.getFullYear() + '-' + ('0' + (fechaActual.getMonth() + 1)).slice(-2) + '-' + ('0' + fechaActual.getDate()).slice(-2) + 'T' + ('0' + fechaActual.getHours()).slice(-2) + ':' + ('0' + fechaActual.getMinutes()).slice(-2);
                    document.getElementById('fecha_reg_entreg').value = formattedDateTime;
                  </script>

                </div>

              </div>

              <div class="mb-4">
                <button type="submit" class="btn btn-primary mb-0" id="Guardar"> <i class="fa-solid fa-floppy-disk me-1"></i> Guardar Entregable </button>
              </div>

            </form>

          </div>

          <div class="modal-footer">

            <br><br><br>

          </div>

        </div>


      </div>

    </div>

  </div>

  <!--  MODAL: ACTVIDADES Y PERSONAL -->

  <div class="modal fade" id="modalActividadesPlan" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="titulo_modal_alcance" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
      <div class="modal-content">
        <div class="w3-container w3-teal modal-header">
          <div>
            <h5 class="modal-title" id="titulo_modal_alcance">
              <i class="fa-solid fa-list-check text-primary me-2"></i>
              Actividades y tareas
            </h5>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"> </button>

        </div>

        <div class="modal-body">

          <div class="row g-3">
            <div class="col-md-12" style="color:black">

              <label class="form-label">Tareas registrados:</label>
              <br>
              <div class="col-md-4" style="color:black">
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" id="check_form_actividades_tareas" checked>
                  <label class="form-check-label" for="check_form_actividades_tareas">Registrar nueva tarea</label>
                </div>
              </div>
              <br>

              <div class="table-responsive">
                <table id="tabla_data_actividades_tareas_plan" class="table table-hover table-striped align-middle">

                  <thead class="table-light">
                    <tr>
                      <th class="text-center">ID</th>
                      <th class="text-center">Actividad</th>
                      <th class="text-center">Descripción</th>
                      <th class="text-center">Fecha Inicio</th>
                      <th class="text-center">Fecha Fin</th>
                      <th class="text-center">Estado</th>
                      <th class="text-center">Acciones</th>
                    </tr>
                  </thead>

                  <tbody id="tbody_actividades_tareas_plan">
                    <tr>
                      <td colspan="7" class="text-center text-secondary">
                        Seleccione una planificación para consultar sus actividades.
                      </td>
                    </tr>
                  </tbody>

                </table>
              </div>

            </div>
          </div>

          <div class="row g-3" id="ver_form_act_tar_container">

            <form id="formAlcancePlan" action="./proses_plan_project.php?act=insert_actividad_tarea_plan_proy" method="POST">

              <input type="hidden" id="id_project_plans_alcance" name="id_project_plans" value="">

              <div class="card-body">
                <div class="row">

                  <div class="col-md-12 mb-3">
                    <label class="form-label">Nombre de la actividad *</label>
                    <input type="text" name="nombre_actividad_proy" id="nombre_actividad_proy" class="form-control border px-3" required>
                  </div>

                  <div class="col-md-12 mb-3">
                    <label class="form-label">Descripción de la actividad *</label>
                    <textarea name="descripcion_actividad_proy" id="descripcion_actividad_proy" class="form-control border px-3" maxlength="300" rows="3" required></textarea>
                    <div id="contador_descripcion_actividad_proy">300</div>
                  </div>

                  <div class="col-md-4 mb-3">
                    <label for="fecha" class="form-label">Asignar responsables: </label>
                    <select class="form-multi-select" id="respon_act_tarea" name="respon_act_tarea[]" multiple data-coreui-search="global">
                      <?php
                      $query_data = mysqli_query($conn, "SELECT * FROM users");

                      while ($miembro = mysqli_fetch_assoc($query_data)) {
                        $id = $miembro['id_usuario'];
                        $nombre = ($miembro['nombre_user']);
                        $apell = ($miembro['apellido_user']);
                        $esp = ($miembro['especialidad']);
                        echo "<option value=\"$id\">$nombre $apell | Especialidad: $esp</option>";
                      }
                      ?>
                    </select>
                  </div>

                  <div class="col-md-4 mb-3">
                    <label class="form-label">Fecha de inicio *</label>
                    <input type="date" name="fecha_ini_actividad_proy" id="fecha_ini_actividad_proy" class="form-control border px-3" required>
                  </div>

                  <div class="col-md-4 mb-3">
                    <label class="form-label">Fecha de finalización *</label>
                    <input type="date" name="fecha_fin_actividad_proy" id="fecha_fin_actividad_proy" class="form-control border px-3" required>
                  </div>

                  <div class="col-md-4 mb-3">
                    <label class="form-label">Duración de la actividad</label>
                    <input type="text" name="durac_actividad_proy" id="durac_actividad_proy" class="form-control border px-3" readonly>
                  </div>

                  <div class="col-md-12 mb-3">
                    <label class="form-label">Observación de la actividad *</label>
                    <textarea name="observacion_actividad_proy" id="observacion_actividad_proy" class="form-control border px-3" maxlength="300" rows="3" required></textarea>
                    <div id="contador_observacion_actividad_proy">300</div>
                  </div>

                  <div class="mb-4">
                    <input type="datetime-local" class="form-control" id="fecha_creac_actividad_proy" name="fecha_creac_actividad_proy" style="display:none" readonly>
                    <script>
                      var fechaActual = new Date();
                      var formattedDateTime = fechaActual.getFullYear() + '-' + ('0' + (fechaActual.getMonth() + 1)).slice(-2) + '-' + ('0' + fechaActual.getDate()).slice(-2) + 'T' + ('0' + fechaActual.getHours()).slice(-2) + ':' + ('0' + fechaActual.getMinutes()).slice(-2);
                      document.getElementById('fecha_creac_actividad_proy').value = formattedDateTime;
                    </script>
                  </div>

                </div>

                <div class="mb-4">
                  <button type="submit" class="btn btn-primary mb-0" id="btnGuardarAlcance"> <i class="fa-solid fa-floppy-disk me-1"></i> Guardar tarea </button>
                </div>

              </div>

            </form>

          </div>

          <br><br>

          <div class="row g-3">
            <div class="col-md-12" style="color:black">

              <label class="form-label">Hitos Planificados:</label>
              <br>
              <div class="col-md-4" style="color:black">
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" id="check_form_hitos_tareas" checked>
                  <label class="form-check-label" for="check_form_hitos_tareas">Registrar nuevo hito</label>
                </div>
              </div>
              <br>

              <div class="table-responsive">
                <table id="tabla_data_hitos_plan" class="table table-hover table-striped align-middle">

                  <thead class="table-light">
                    <tr>
                      <th class="text-center">ID</th>
                      <th class="text-center">Hitos</th>
                      <th class="text-center">Descripción</th>
                      <th class="text-center">Fecha del hito</th>
                      <th class="text-center">Estado</th>
                      <th class="text-center">Acciones</th>
                    </tr>
                  </thead>

                  <tbody id="tbody_hitos_ocurr_plan">
                    <tr>
                      <td colspan="6" class="text-center text-secondary">
                        Seleccione una planificación para consultar sus hitos.
                      </td>
                    </tr>
                  </tbody>

                </table>
              </div>

            </div>
          </div>

          <div class="row g-3" id="ver_form_nuevo_hito_container">

            <form id="formAlcancePlan" action="./proses_plan_project.php?act=insert_hitos_plan_proy" method="POST">

              <input type="hidden" id="id_project_plans_alcance" name="id_project_plans" value="">

              <div class="card-body">
                <div class="row">

                  <div class="col-md-12 mb-3">
                    <label class="form-label">Hito *</label>
                    <input type="text" name="nombre_hito_proy" id="nombre_hito_proy" class="form-control border px-3" required>
                  </div>

                  <div class="col-md-12 mb-3">
                    <label class="form-label">Descripción del hito *</label>
                    <textarea name="descripcion_hito_proy" id="descripcion_hito_proy" class="form-control border px-3" maxlength="300" rows="3" required></textarea>
                    <div id="contador_descripcion_hito_proy">300</div>
                  </div>

                  <div class="col-md-4 mb-3">
                    <label class="form-label">Fecha de ocurrencia *</label>
                    <input type="date" name="fecha_ocurren_hito_proy" id="fecha_ocurren_hito_proy" class="form-control border px-3" required>
                  </div>

                </div>

                <br>

                <div class="mb-4">
                  <button type="submit" class="btn btn-primary mb-0" id="btnGuardarAlcance"> <i class="fa-solid fa-floppy-disk me-1"></i> Guardar hito </button>
                </div>

              </div>

            </form>

          </div>

          <br><br>

          <div class="modal-footer">

            <br><br><br>

          </div>

        </div>


      </div>

    </div>

  </div>

  <!--  MODAL: RECURSOS Y PRESUPUESTO -->

  <div class="modal fade" id="modalRecursosPresupuestoPlan" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="titulo_modal_alcance" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg modal-recursos-presupuesto-dialog">
      <div class="modal-content">
        <div class="w3-container w3-teal modal-header">
          <div>
            <h5 class="modal-title" id="titulo_modal_alcance">
              <i class="fa-solid fa-money-bill-wave text-primary me-2"></i>
              Recursos y Presupuesto
            </h5>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"> </button>

        </div>

        <div class="modal-body">


          <div class="row g-3 align-items-stretch mb-3">

            <div class="col-12 col-xl-8">

              <div class="card h-100 mb-0">

                <div class="card-header pb-2 d-flex justify-content-between align-items-center flex-wrap gap-2">

                  <div>
                    <h6 class="mb-1">
                      <i class="fa-solid fa-gears text-primary me-2"></i>
                      Recursos necesarios
                    </h6>
                  </div>

                  <div class="form-check form-switch mb-0">
                    <input class="form-check-input" type="checkbox" id="check_form_recursos_nuevos" checked>
                    <label class="form-check-label" for="check_form_recursos_nuevos"> Registrar recurso</label>
                  </div>

                </div>

                <div class="card-body pt-2">

                  <div class="table-responsive">

                    <table id="tabla_data_recursos_plan" class="table table-hover table-striped align-middle">

                      <thead class="table-light">
                        <tr>
                          <th class="text-center">ID</th>
                          <th class="text-center">Tipo de recurso</th>
                          <th class="text-center">Descripción</th>
                          <th class="text-center">Cantidad / Dedicación</th>
                          <th class="text-center">Periodo</th>
                          <th class="text-center">Disponibilidad</th>
                          <th class="text-center">Responsable</th>
                          <th class="text-center">Acciones</th>
                        </tr>
                      </thead>

                      <tbody id="tbody_recursos_regist_plan">

                        <tr>
                          <td colspan="8" class="text-center text-secondary">
                            Seleccione una planificación para consultar sus recursos.
                          </td>
                        </tr>

                      </tbody>

                      <tfoot>
                        <tr class="table-primary fw-bold">
                          <td class="text-center">—</td>
                          <td class="text-center"></td>
                          <td class="text-center">—</td>
                          <td class="text-center">—</td>
                          <td class="text-center">—</td>
                        </tr>
                      </tfoot>

                    </table>

                  </div>

                </div>

              </div>

            </div>

            <div class="col-12 col-xl-4">

              <div class="card grafica-presupuesto-card mb-0">

                <div class="card-header pb-1">

                  <h6 class="mb-1">
                    <i class="fa-solid fa-boxes-packing text-primary me-2"></i>
                    Disponibilidad de recursos
                  </h6>

                  <small class="text-secondary">
                    Estado de los recursos principales.
                  </small>

                </div>

                <div class="card-body d-flex align-items-center">

                  <div class="grafica-presupuesto-container">

                    <canvas id="chart_disponibilidad_recursos" class="chart-canvas"></canvas>

                  </div>

                </div>

              </div>

            </div>

          </div>

          <br>

          <div class="row g-3" id="ver_form_recursos_new_container">

            <form id="formAlcancePlan" action="./proses_plan_project.php?act=insert_recurso_plan_proy" method="POST">

              <input type="hidden" id="id_project_plans_alcance" name="id_project_plans" value="">

              <input type="hidden" name="id_proyecto" id="id_proyecto_recursos" value="">

              <div class="card-body">
                <div class="row">

                  <div class="col-md-4 mb-3">
                    <label class="form-label">Tipo de Recurso *</label>
                    <input type="text" name="tipo_recurso_proy" id="tipo_recurso_proy" class="form-control border px-3" required>
                  </div>

                  <div class="col-md-12 mb-3">
                    <label class="form-label">Descripción del Recurso *</label>
                    <textarea name="descripcion_recurso_proy" id="descripcion_recurso_proy" class="form-control border px-3" maxlength="300" rows="3" required></textarea>
                    <div id="contador_descripcion_recurso_proy">300</div>
                  </div>

                  <div class="col-md-4 mb-3">
                    <label class="form-label">Cantidad/Dedicación *</label>
                    <input type="text" name="cant_dedic_recurso_proy" id="cant_dedic_recurso_proy" class="form-control border px-3" required>
                  </div>

                  <div class="col-md-4 mb-3">
                    <label class="form-label">Periodo *</label>
                    <input type="text" name="periodo_recur_plan_proy" id="periodo_recur_plan_proy" class="form-control border px-3" required>
                  </div>

                  <div class="col-md-4 mb-3">
                    <label class="form-label">Disponibilidad *</label>
                    <select name="disponib_recur_plan_proy" id="disponib_recur_plan_proy" class="form-select border px-3" required>
                      <option value="" disabled>Seleccione</option>
                      <option value="Confirmados">Confirmados</option>
                      <option value="Por Confirmar">Por Confirmar</option>
                      <option value="No disponibles">No disponibles</option>
                    </select>
                  </div>

                  <div class="col-md-4 mb-3">
                    <label for="fecha" class="form-label">Asignar responsable: </label>
                    <select class="form-select" id="id_respon_recurso_tarea" name="id_respon_recurso_tarea" required>
                      <option value="" disabled>Seleccione un Responsable</option>
                      <?php
                      $query_data = mysqli_query($conn, "SELECT * FROM users");

                      while ($miembro = mysqli_fetch_assoc($query_data)) {
                        $id = $miembro['id_usuario'];
                        $nombre = ($miembro['nombre_user']);
                        $apell = ($miembro['apellido_user']);
                        $esp = ($miembro['especialidad']);
                        echo "<option value=\"$id\">$nombre $apell | Especialidad: $esp</option>";
                      }
                      ?>
                    </select>
                  </div>

                </div>

                <div class="mb-4">
                  <button type="submit" class="btn btn-primary mb-0" id="btnGuardarAlcance"> <i class="fa-solid fa-floppy-disk me-1"></i> Guardar recurso </button>
                </div>

              </div>

            </form>

          </div>

          <br><br>

          <div class="row g-3 align-items-stretch mb-3">

            <div class="col-12 col-xl-7">

              <div class="card h-100 mb-0">

                <div class="card-header pb-2 d-flex justify-content-between align-items-center flex-wrap gap-2">

                  <div>
                    <h6 class="mb-1">
                      <i class="fa-solid fa-file-invoice-dollar text-primary me-2"></i>
                      Presupuesto planificado
                    </h6>
                  </div>

                  <div class="form-check form-switch mb-0">
                    <input class="form-check-input" type="checkbox" id="check_form_nuevo_presupuesto" checked>

                    <label class="form-check-label" for="check_form_nuevo_presupuesto">Agregar categoría</label>
                  </div>

                </div>

                <div class="card-body pt-2">

                  <div class="table-responsive">

                    <table id="tabla_data_presupuestos_plan" class="table table-hover table-striped align-middle">

                      <thead class="table-light">

                        <tr>
                          <th class="text-center">Categoría</th>
                          <th class="text-center">Descripción</th>
                          <th class="text-center">Monto (USD)</th>
                          <th class="text-center">% del total</th>
                          <th class="text-center">Acciones</th>
                        </tr>

                      </thead>

                      <tbody id="tbody_presupuestos_plan">

                        <tr>
                          <td colspan="5" class="text-center text-secondary">
                            Seleccione una planificación para consultar sus categorías.
                          </td>
                        </tr>

                      </tbody>

                      <tfoot>
                        <tr class="table-primary fw-bold">
                          <td class="text-center">—</td>
                          <td class="text-center"></td>
                          <td class="text-center">—</td>
                          <td class="text-center">—</td>
                          <td class="text-center">—</td>
                        </tr>
                      </tfoot>

                    </table>

                  </div>

                </div>

              </div>

            </div>


            <!-- GRÁFICA DE DISTRIBUCIÓN: 33,3% -->
            <div class="col-12 col-xl-5">

              <div class="card grafica-presupuesto-card mb-0">

                <div class="card-header pb-1">

                  <h6 class="mb-1">
                    <i class="fa-solid fa-file-invoice-dollar text-primary me-2"></i>
                    Distribución del presupuesto
                  </h6>

                  <small class="text-secondary">
                    Distribución de los montos por categoría.
                  </small>

                </div>

                <div class="card-body d-flex align-items-center">

                  <div class="grafica-presupuesto-container">

                    <canvas id="chart_distribucion_presupuesto" class="chart-canvas"></canvas>

                  </div>

                </div>

              </div>

            </div>

          </div>

          <br>

          <div class="row g-3" id="ver_form_nuevo_presupuesto_container">

            <form id="formAlcancePlan" action="./proses_plan_project.php?act=insert_presupuestos_plan_proy" method="POST">

              <input type="hidden" id="id_project_plans_alcance" name="id_project_plans" value="">

              <input type="hidden" id="id_proyecto_recursos" name="id_proyecto" value="">

              <div class="card-body">
                <div class="row">

                  <div class="col-md-6 mb-3">
                    <label class="form-label">Categoría *</label>
                    <input type="text" name="categoria_presup_proy" id="categoria_presup_proy" class="form-control border px-3" required>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="form-label">Monto *</label>
                    <input type="number" name="monto_presup_proy" id="monto_presup_proy" class="form-control border px-3" required>
                  </div>

                  <div class="col-md-12 mb-3">
                    <label class="form-label">Descripción del presupuesto *</label>
                    <textarea name="descripcion_presup_proy" id="descripcion_presup_proy" class="form-control border px-3" maxlength="300" rows="3" required></textarea>
                    <div id="contador_descripcion_presup_proy">300</div>
                  </div>

                </div>

                <br>

                <div class="mb-4">
                  <button type="submit" class="btn btn-primary mb-0" id="btnGuardarAlcance"> <i class="fa-solid fa-floppy-disk me-1"></i> Guardar categoria </button>
                </div>

              </div>

            </form>

          </div>

          <br><br>

          <div class="modal-footer">

            <br><br><br>

          </div>

        </div>


      </div>

    </div>

  </div>

  <!--  MODAL: RIESGOS Y SUPUESTOS -->

  <div class="modal fade" id="modalRiesgosPlan" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="titulo_modal_alcance" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg modal-recursos-presupuesto-dialog">
      <div class="modal-content">

        <div class="w3-container w3-teal modal-header">
          <div>
            <h5 class="modal-title" id="titulo_modal_alcance">
              <i class="fa-solid fa-triangle-exclamation text-primary me-2"></i>
              Riesgos y Supuestos
            </h5>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"> </button>

        </div>

        <div class="modal-body">


          <div class="row g-3 align-items-stretch mb-3">

            <div class="col-12 col-xl-12">

              <div class="card h-100 mb-0">

                <div class="card-header pb-2 d-flex justify-content-between align-items-center flex-wrap gap-2">

                  <div>
                    <h6 class="mb-1">
                      Riesgos del Proyecto
                    </h6>
                  </div>

                  <div class="form-check form-switch mb-0">
                    <input class="form-check-input" type="checkbox" id="check_form_riesgos_nuevos" checked>
                    <label class="form-check-label" for="check_form_riesgos_nuevos"> Registrar riesgo</label>
                  </div>

                </div>

                <div class="card-body pt-2">

                  <div class="table-responsive">

                    <table id="tabla_data_riesgos_plan" class="table table-hover table-striped align-middle">

                      <thead class="table-light">
                        <tr>
                          <th class="text-center">ID</th>
                          <th class="text-center">Riesgo</th>
                          <th class="text-center">Solución</th>
                          <th class="text-center">Probabilidad</th>
                          <th class="text-center">Impacto</th>
                          <th class="text-center">Nivel</th>
                          <th class="text-center">Responsable</th>
                          <th class="text-center">Estado</th>
                          <th class="text-center">Acciones</th>
                        </tr>
                      </thead>

                      <tbody id="tbody_riesgos_regist_plan">

                        <tr>
                          <td colspan="9" class="text-center text-secondary">
                            Seleccione una planificación para consultar sus riesgos.
                          </td>
                        </tr>

                      </tbody>

                      <tfoot>
                        <tr class="table-primary fw-bold">
                          <td class="text-center"></td>
                          <td class="text-center"></td>
                          <td class="text-center"></td>
                          <td class="text-center"></td>
                          <td class="text-center"></td>
                          <td class="text-center"></td>
                          <td class="text-center"></td>
                          <td class="text-center"></td>
                          <td class="text-center"></td>
                        </tr>
                      </tfoot>

                    </table>

                  </div>

                </div>

              </div>

            </div>

          </div>

          <br>

          <div class="row g-3" id="ver_form_nuevos_riesgos_container">

            <form id="formAlcancePlan" action="./proses_plan_project.php?act=insert_new_riesg_respon_proy" method="POST">

              <input type="hidden" id="id_project_plans_alcance" name="id_project_plans" value="">

              <input type="hidden" name="id_proyecto" id="id_proyecto_recursos" value="">

              <div class="card-body">
                <div class="row">

                  <div class="col-md-6 mb-3">
                    <label class="form-label">Riesgos *</label>

                    <select class="form-multi-select" id="list_riesgo_proy" name="list_riesgo_proy[]" multiple data-coreui-search="global">
                      <?php
                      $query_data = mysqli_query($conn, "SELECT * FROM risk");

                      while ($miembro = mysqli_fetch_assoc($query_data)) {
                        $id = $miembro['id_risk'];
                        $nombre = ($miembro['riesgo']);
                        $esp = ($miembro['probabilidad']);
                        echo "<option value=\"$id\">$nombre | Probabilidad: $esp</option>";
                      }
                      ?>
                    </select>

                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="form-label">Asignar Responsable *</label>
                    <select class="form-select" id="respon_riesgo_proy" name="respon_riesgo_proy">
                      <?php
                      $query_data = mysqli_query($conn, "SELECT * FROM users");

                      while ($miembro = mysqli_fetch_assoc($query_data)) {
                        $id = $miembro['id_usuario'];
                        $nombre = ($miembro['nombre_user']);
                        $apell = ($miembro['apellido_user']);
                        $esp = ($miembro['especialidad']);
                        $NombreComp = ("$nombre" . " " . "$apell");
                        echo "<option value=\"$NombreComp\">$nombre $apell | Especialidad: $esp</option>";
                      }
                      ?>
                    </select>
                  </div>

                  <div class="col-md-4 mb-3">
                    <label class="form-label">Estado *</label>
                    <select name="estado_risg_plan_proy" id="estado_risg_plan_proy" class="form-select border px-3" required>
                      <option value="" disabled>Seleccione</option>
                      <option value="Abierto">Abierto</option>
                      <option value="Identificados">Identificados</option>
                      <option value="Cerrado">Cerrado</option>
                    </select>
                  </div>

                </div>

                <div class="mb-4">
                  <button type="submit" class="btn btn-primary mb-0" id="btnGuardarAlcance"> <i class="fa-solid fa-floppy-disk me-1"></i> Guardar el riesgo </button>
                </div>

              </div>

            </form>

          </div>

          <br><br>

          <div class="row g-3 align-items-stretch mb-3">

            <div class="col-12 col-xl-12">

              <div class="card h-100 mb-0">

                <div class="card-header pb-2 d-flex justify-content-between align-items-center flex-wrap gap-2">

                  <div>
                    <h6 class="mb-1">
                      Supuestos del Proyecto
                    </h6>
                  </div>

                  <div class="form-check form-switch mb-0">
                    <input class="form-check-input" type="checkbox" id="check_form_supuestos_nuevos" checked>
                    <label class="form-check-label" for="check_form_supuestos_nuevos"> Agregar supuestos</label>
                  </div>

                </div>

                <div class="card-body pt-2">

                  <div class="table-responsive">

                    <table id="tabla_data_supuestos_plan" class="table table-hover table-striped align-middle">

                      <thead class="table-light">
                        <tr>
                          <th class="text-center">ID</th>
                          <th class="text-center">Supuesto</th>
                          <th class="text-center">Descripción</th>
                          <th class="text-center">Impacto si no se cumple</th>
                          <th class="text-center">Estado</th>
                          <th class="text-center">Acciones</th>
                        </tr>
                      </thead>

                      <tbody id="tbody_supestos_regist_proy">

                        <tr>
                          <td colspan="9" class="text-center text-secondary">
                            Seleccione una planificación para consultar sus supuestos.
                          </td>
                        </tr>

                      </tbody>

                      <tfoot>
                        <tr class="table-primary fw-bold">
                          <td class="text-center"></td>
                          <td class="text-center"></td>
                          <td class="text-center"></td>
                          <td class="text-center"></td>
                          <td class="text-center"></td>
                          <td class="text-center"></td>
                        </tr>
                      </tfoot>

                    </table>

                  </div>

                </div>

              </div>

            </div>

          </div>

          <br>

          <div class="row g-3" id="ver_form_nuevos_supuestos_container">

            <form id="formAlcancePlan" action="./proses_plan_project.php?act=insert_new_supuestos_proy" method="POST">

              <input type="hidden" id="id_project_plans_alcance" name="id_project_plans" value="">

              <input type="hidden" name="id_proyecto" id="id_proyecto_recursos" value="">

              <div class="card-body">
                <div class="row">

                  <div class="col-md-4 mb-3">
                    <label class="form-label">Supuestos *</label>
                    <input type="text" name="nom_supuestos_proy" id="nom_supuestos_proy" class="form-control border px-3" required>
                  </div>

                  <div class="col-md-12 mb-3">
                    <label class="form-label">Descripción del Supuestos *</label>
                    <textarea name="descripcion_supuesto_nuevo_proy" id="descripcion_supuesto_nuevo_proy" class="form-control border px-3" maxlength="300" rows="3" required></textarea>
                    <div id="contador_descripcion_supuesto_nuevo_proy">300</div>
                  </div>

                  <div class="col-md-12 mb-3">
                    <label class="form-label">Impacto si NO se cumple el Supuestos *</label>
                    <textarea name="impacto_supest_proy" id="impacto_supest_proy" class="form-control border px-3" maxlength="300" rows="3" required></textarea>
                    <div id="contador_impacto_supest_proy">300</div>
                  </div>

                  <div class="col-md-4 mb-3">
                    <label class="form-label">Estado *</label>
                    <select name="estado_supest_proy" id="estado_supest_proy" class="form-select border px-3" required>
                      <option value="" disabled>Seleccione</option>
                      <option value="Vigente">Vigente</option>
                      <option value="Identificados">Identificados</option>
                      <option value="Cerrado">Cerrado</option>
                    </select>
                  </div>

                </div>

                <div class="mb-4">
                  <button type="submit" class="btn btn-primary mb-0" id="btnGuardarAlcance"> <i class="fa-solid fa-floppy-disk me-1"></i> Guardar el supuesto </button>
                </div>

              </div>

            </form>

          </div>

          <br>

          <div class="row g-3 align-items-stretch mb-3">

            <div class="col-12 col-xl-12">

              <div class="card h-100 mb-0">

                <div class="card-header pb-2 d-flex justify-content-between align-items-center flex-wrap gap-2">

                  <div>
                    <h6 class="mb-1">
                      Restricciones del Proyecto
                    </h6>
                  </div>

                  <div class="form-check form-switch mb-0">
                    <input class="form-check-input" type="checkbox" id="check_form_resticciones_nuevos" checked>
                    <label class="form-check-label" for="check_form_resticciones_nuevos"> Agregar restricción</label>
                  </div>

                </div>

                <div class="card-body pt-2">

                  <div class="table-responsive">

                    <table id="tabla_data_restricciones_plan" class="table table-hover table-striped align-middle">

                      <thead class="table-light">
                        <tr>
                          <th class="text-center">ID</th>
                          <th class="text-center">Restricción</th>
                          <th class="text-center">Descripción</th>
                          <th class="text-center">Impacto</th>
                          <th class="text-center">Acciones</th>
                        </tr>
                      </thead>

                      <tbody id="tbody_restricciones_regist_proy">

                        <tr>
                          <td colspan="5" class="text-center text-secondary">
                            Seleccione una planificación para consultar sus restricciones.
                          </td>
                        </tr>

                      </tbody>

                      <tfoot>
                        <tr class="table-primary fw-bold">
                          <td class="text-center"></td>
                          <td class="text-center"></td>
                          <td class="text-center"></td>
                          <td class="text-center"></td>
                          <td class="text-center"></td>
                        </tr>
                      </tfoot>

                    </table>

                  </div>

                </div>

              </div>

            </div>

          </div>

          <br>

          <div class="row g-3" id="ver_form_nuevos_restricc_container">

            <form id="formAlcancePlan" action="./proses_plan_project.php?act=insert_new_restricciones_proy" method="POST">

              <input type="hidden" id="id_project_plans_alcance" name="id_project_plans" value="">

              <input type="hidden" name="id_proyecto" id="id_proyecto_recursos" value="">

              <div class="card-body">
                <div class="row">

                  <div class="col-md-4 mb-3">
                    <label class="form-label">Restriccines *</label>
                    <input type="text" name="nom_restricc_proy" id="nom_restricc_proy" class="form-control border px-3" required>
                  </div>

                  <div class="col-md-12 mb-3">
                    <label class="form-label">Descripción de la restricción *</label>
                    <textarea name="descripcion_restricc_nuevo_proy" id="descripcion_restricc_nuevo_proy" class="form-control border px-3" maxlength="300" rows="3" required></textarea>
                    <div id="contador_descripcion_restricc_nuevo_proy">300</div>
                  </div>

                  <div class="col-md-12 mb-3">
                    <label class="form-label">Impacto de la restricción *</label>
                    <textarea name="impacto_restricc_proy" id="impacto_restricc_proy" class="form-control border px-3" maxlength="300" rows="3" required></textarea>
                    <div id="contador_impacto_restricc_proy">300</div>
                  </div>

                </div>

                <div class="mb-4">
                  <button type="submit" class="btn btn-primary mb-0" id="btnGuardarAlcance"> <i class="fa-solid fa-floppy-disk me-1"></i> Guardar la restricción </button>
                </div>

              </div>

            </form>

          </div>

        </div>

        <div class="modal-footer">

          <br><br><br>

        </div>

      </div>



    </div>


  </div>

  <!--  MODAL: SEGUIMIENTO Y CALENDARIO -->

  <div class="modal fade" id="modalSeguimientoPlan" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="titulo_modal_alcance" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg modal-recursos-presupuesto-dialog">
      <div class="modal-content">

        <div class="w3-container w3-teal modal-header">
          <div>
            <h5 class="modal-title" id="titulo_modal_alcance">
              <i class="fa-solid fa-chart-line fa-xl text-primary me-2"></i>
              Seguimiento y Calendario
            </h5>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"> </button>

        </div>

        <div class="modal-body">


          <div class="row g-3 align-items-stretch mb-3">

            <div class="col-12 col-xl-12">

              <div class="card h-100 mb-0">

                <div class="card-header pb-2 d-flex justify-content-between align-items-center flex-wrap gap-2">

                  <div>
                    <h6 class="mb-1">
                      Seguimiento del Proyecto
                    </h6>
                  </div>

                  <div class="form-check form-switch mb-0">
                    <input class="form-check-input" type="checkbox" id="check_form_seguimiento_nuevos" checked>
                    <label class="form-check-label" for="check_form_seguimiento_nuevos"> Guardar seguimiento</label>
                  </div>

                </div>

                <div class="card-body pt-2">

                  <div class="table-responsive">

                    <table id="tabla_data_seguimiento_plan" class="table table-hover table-striped align-middle">

                      <thead class="table-light">
                        <tr>
                          <th class="text-center">ID</th>
                          <th class="text-center">Indicador</th>
                          <th class="text-center">Descripción</th>
                          <th class="text-center">Tipo</th>
                          <th class="text-center">Meta</th>
                          <th class="text-center">Peridiocidad</th>
                          <th class="text-center">Responsable</th>
                          <th class="text-center">Acciones</th>
                        </tr>
                      </thead>

                      <tbody id="tbody_seguimiento_regist_plan">

                        <tr>
                          <td colspan="9" class="text-center text-secondary">
                            Seleccione una planificación para consultar sus seguimientos.
                          </td>
                        </tr>

                      </tbody>

                      <tfoot>
                        <tr class="table-primary fw-bold">
                          <td class="text-center"></td>
                          <td class="text-center"></td>
                          <td class="text-center"></td>
                          <td class="text-center"></td>
                          <td class="text-center"></td>
                          <td class="text-center"></td>
                          <td class="text-center"></td>
                          <td class="text-center"></td>
                        </tr>
                      </tfoot>

                    </table>

                  </div>

                </div>

              </div>

            </div>

          </div>

          <br>

          <div class="row g-3" id="ver_form_nuevos_seguimiento_container">

            <form id="formAlcancePlan" action="./proses_plan_project.php?act=insert_new_riesg_respon_proy" method="POST">

              <input type="hidden" id="id_project_plans_alcance" name="id_project_plans" value="">

              <input type="hidden" name="id_proyecto" id="id_proyecto_recursos" value="">

              <div class="card-body">
                <div class="row">

                  <div class="col-md-6 mb-3">
                    <label class="form-label">Riesgos *</label>

                    <select class="form-multi-select" id="list_riesgo_proy" name="list_riesgo_proy[]" multiple data-coreui-search="global">
                      <?php
                      $query_data = mysqli_query($conn, "SELECT * FROM risk");

                      while ($miembro = mysqli_fetch_assoc($query_data)) {
                        $id = $miembro['id_risk'];
                        $nombre = ($miembro['riesgo']);
                        $esp = ($miembro['probabilidad']);
                        echo "<option value=\"$id\">$nombre | Probabilidad: $esp</option>";
                      }
                      ?>
                    </select>

                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="form-label">Asignar Responsable *</label>
                    <select class="form-select" id="respon_riesgo_proy" name="respon_riesgo_proy">
                      <?php
                      $query_data = mysqli_query($conn, "SELECT * FROM users");

                      while ($miembro = mysqli_fetch_assoc($query_data)) {
                        $id = $miembro['id_usuario'];
                        $nombre = ($miembro['nombre_user']);
                        $apell = ($miembro['apellido_user']);
                        $esp = ($miembro['especialidad']);
                        $NombreComp = ("$nombre" . " " . "$apell");
                        echo "<option value=\"$NombreComp\">$nombre $apell | Especialidad: $esp</option>";
                      }
                      ?>
                    </select>
                  </div>

                  <div class="col-md-4 mb-3">
                    <label class="form-label">Estado *</label>
                    <select name="estado_risg_plan_proy" id="estado_risg_plan_proy" class="form-select border px-3" required>
                      <option value="" disabled>Seleccione</option>
                      <option value="Abierto">Abierto</option>
                      <option value="Identificados">Identificados</option>
                      <option value="Cerrado">Cerrado</option>
                    </select>
                  </div>

                </div>

                <div class="mb-4">
                  <button type="submit" class="btn btn-primary mb-0" id="btnGuardarAlcance"> <i class="fa-solid fa-floppy-disk me-1"></i> Guardar el riesgo </button>
                </div>

              </div>

            </form>

          </div>

          <br><br>

          <div class="row g-3 align-items-stretch mb-3">

            <div class="col-12 col-xl-12">

              <div class="card h-100 mb-0">

                <div class="card-header pb-2 d-flex justify-content-between align-items-center flex-wrap gap-2">

                  <div>
                    <h6 class="mb-1">
                      Supuestos del Proyecto
                    </h6>
                  </div>

                  <div class="form-check form-switch mb-0">
                    <input class="form-check-input" type="checkbox" id="check_form_supuestos_nuevos" checked>
                    <label class="form-check-label" for="check_form_supuestos_nuevos"> Agregar supuestos</label>
                  </div>

                </div>

                <div class="card-body pt-2">

                  <div class="table-responsive">

                    <table id="tabla_data_fech_calend_plan" class="table table-hover table-striped align-middle">

                      <thead class="table-light">
                        <tr>
                          <th class="text-center">ID</th>
                          <th class="text-center">Periodo</th>
                          <th class="text-center">Fecha de corte</th>
                          <th class="text-center">Fecha de entrega</th>
                          <th class="text-center">Estado</th>
                          <th class="text-center">Acciones</th>
                        </tr>
                      </thead>

                      <tbody id="tbody_fech_calend_regist_proy">

                        <tr>
                          <td colspan="9" class="text-center text-secondary">
                            Seleccione una planificación para consultar su calendario.
                          </td>
                        </tr>

                      </tbody>

                      <tfoot>
                        <tr class="table-primary fw-bold">
                          <td class="text-center"></td>
                          <td class="text-center"></td>
                          <td class="text-center"></td>
                          <td class="text-center"></td>
                          <td class="text-center"></td>
                          <td class="text-center"></td>
                        </tr>
                      </tfoot>

                    </table>

                  </div>

                </div>

              </div>

            </div>

          </div>

          <br>

          <div class="row g-3" id="ver_form_nuevos_supuestos_container">

            <form id="formAlcancePlan" action="./proses_plan_project.php?act=insert_new_supuestos_proy" method="POST">

              <input type="hidden" id="id_project_plans_alcance" name="id_project_plans" value="">

              <input type="hidden" name="id_proyecto" id="id_proyecto_recursos" value="">

              <div class="card-body">
                <div class="row">

                  <div class="col-md-4 mb-3">
                    <label class="form-label">Supuestos *</label>
                    <input type="text" name="nom_supuestos_proy" id="nom_supuestos_proy" class="form-control border px-3" required>
                  </div>

                  <div class="col-md-12 mb-3">
                    <label class="form-label">Descripción del Supuestos *</label>
                    <textarea name="descripcion_supuesto_nuevo_proy" id="descripcion_supuesto_nuevo_proy" class="form-control border px-3" maxlength="300" rows="3" required></textarea>
                    <div id="contador_descripcion_supuesto_nuevo_proy">300</div>
                  </div>

                  <div class="col-md-12 mb-3">
                    <label class="form-label">Impacto si NO se cumple el Supuestos *</label>
                    <textarea name="impacto_supest_proy" id="impacto_supest_proy" class="form-control border px-3" maxlength="300" rows="3" required></textarea>
                    <div id="contador_impacto_supest_proy">300</div>
                  </div>

                  <div class="col-md-4 mb-3">
                    <label class="form-label">Estado *</label>
                    <select name="estado_supest_proy" id="estado_supest_proy" class="form-select border px-3" required>
                      <option value="" disabled>Seleccione</option>
                      <option value="Vigente">Vigente</option>
                      <option value="Identificados">Identificados</option>
                      <option value="Cerrado">Cerrado</option>
                    </select>
                  </div>

                </div>

                <div class="mb-4">
                  <button type="submit" class="btn btn-primary mb-0" id="btnGuardarAlcance"> <i class="fa-solid fa-floppy-disk me-1"></i> Guardar el supuesto </button>
                </div>

              </div>

            </form>

          </div>

          <br>

        </div>

        <div class="modal-footer">

          <br><br><br>

        </div>

      </div>



    </div>


  </div>

  </div>

  </div>

  </div>



  <!-- ------------------Codigos de los sub-modal menu para completar el plan de proyecto ------------------ -->

  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/coreui/coreui_bundle_min_js.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/jqery/jquery.js"></script>
  <script src="../assets/DataTable/datatables.min.js"></script>
  <script src="../assets/js/sweetalert2.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const modalMiembros = document.getElementById('modalMiembros');

      if (!modalMiembros) return;
      const botonesCerrar = modalMiembros.querySelectorAll('.closeAndRedirect');

      botonesCerrar.forEach(function(btn) {
        btn.addEventListener('click', function(e) {
          e.preventDefault();
          cerrarMiembrosYRedirigir();
        });
      });

      function cerrarMiembrosYRedirigir() {
        window.location.href = './project_gen_tables_jef.php';
      }
    });
  </script>

  <script>
    $(document).ready(function() {
      $('#tabla_valid_proyectos_pro').DataTable({
        //autoWidth: false,
        //responsive: true,    
        //pageLength: 5,
        "language": {
          "url": "../assets/js/DataEsp.json"
        },
        "ajax": {
          "url": "./consultas/consul_validar_proyectos.php",
          "dataSrc": ""
        },
        "columns": [{
            "data": "id_proyecto"
          },
          {
            "data": "nombre"
          },
          {
            "data": "nombre_unid"
          },
          {
            "data": null,
            "render": function(data, type, row) {
              let dat_pm_proy = "Sin asignar";
              if (row.estatus !== "Propuesto" && row.estatus !== "Evaluacion" && row.estatus !== "Aprobacion" && row.estatus !== "Cancelado") {
                if (row.id_manager && mapaPM[row.id_manager]) {
                  dat_pm_proy = mapaPM[row.id_manager];
                }
              }
              return dat_pm_proy;
            }
          },
          {
            "data": "estatus"
          },
          {
            "data": "salud",
            "render": function(data, type, row) {
              let clase = "";
              if (data === "En control") {
                clase = "estado-progreso";
              } else if (data === "En riesgo") {
                clase = "estado-ejecutar";
              } else if (data === "Critico") {
                clase = "estado-listo";
              }
              return `
            <span class="estado-badge ${clase}">
                ${data}
            </span>
        `;
            }
          },
          {
            "data": "fecha_inicio"
          },
          {
            "data": "fecha_fin"
          },
          {

            "data": "avance",
            "render": function(data, type, row) {

              let porcentaje = data ? parseInt(data) : 0;
              porcentaje = Math.max(0, Math.min(100, porcentaje));

              return `
            <div class="progreso-contenedor">

                <span class="progreso-porcentaje">
                    ${porcentaje}%
                </span>

                <div class="progreso-barra">

                    <div 
                        class="progreso-relleno"
                        style="width: ${porcentaje}%;">
                    </div>

                </div>

            </div>
        `;
            }

          },
          {
            "data": "prioridad"
          },
          {
            "data": null,
            "render": function(data, type, row) {

              let buttonHTML = `
              <div class="btn-group" role="group" aria-label="Basic example">
                    <button 
                        type="button"
                        onclick="abrirModalValidacion(${row.id_proyecto})"
                        class="btn-editar"
                        title="Realizar validación">

                        <i class="fa-solid fa-hourglass-half fa-beat" style="color: rgba(255, 213, 0, 1);"></i>

                    </button>
                </div>
                `;

              if (row.estatus === "Planificacion") {
                buttonHTML = `
                <a href="./new_project_planning.php?id=${row.id_proyecto}" class="btn-editar" title="Elaborar la Planificacion">
                      <i class="material-icons-round">edit_calendar</i>
                </a>
        `;
              };

              return buttonHTML;
            }
          }
        ]
      });
    });
  </script>

  <script>
    $(document).ready(function() {
      $('#tabla_planinn_proyectos').DataTable({
        //autoWidth: false,
        //responsive: true,    
        //pageLength: 5,
        "language": {
          "url": "../assets/js/DataEsp.json"
        },
        "ajax": {
          "url": "./consultas/consul_proyectos_pm.php",
          "dataSrc": ""
        },
        "columns": [{
            "data": "id_proyecto"
          },
          {
            "data": "nombre"
          },
          {
            "data": "nombre_unid"
          },
          {
            "data": null,
            "render": function(data, type, row) {
              let dat_pm_proy = "Sin asignar";
              if (row.estatus !== "Propuesto" && row.estatus !== "Evaluacion" && row.estatus !== "Aprobacion" && row.estatus !== "Cancelado") {
                if (row.id_manager && mapaPM[row.id_manager]) {
                  dat_pm_proy = mapaPM[row.id_manager];
                }
              }
              return dat_pm_proy;
            }
          },
          {
            "data": "estatus"
          },
          {
            "data": "salud",
            "render": function(data, type, row) {
              let clase = "";
              if (data === "En control") {
                clase = "estado-progreso";
              } else if (data === "En riesgo") {
                clase = "estado-ejecutar";
              } else if (data === "Critico") {
                clase = "estado-listo";
              }
              return `
            <span class="estado-badge ${clase}">
                ${data}
            </span>
        `;
            }
          },
          {
            "data": "fecha_inicio"
          },
          {
            "data": "fecha_fin"
          },
          {

            "data": "avance",
            "render": function(data, type, row) {

              let porcentaje = data ? parseInt(data) : 0;
              porcentaje = Math.max(0, Math.min(100, porcentaje));

              return `
            <div class="progreso-contenedor">

                <span class="progreso-porcentaje">
                    ${porcentaje}%
                </span>

                <div class="progreso-barra">

                    <div 
                        class="progreso-relleno"
                        style="width: ${porcentaje}%;">
                    </div>

                </div>

            </div>
        `;
            }

          },
          {
            "data": "prioridad"
          },
          {
            "data": null,
            "render": function(data, type, row) {

              let buttonHTML = ` `;
              if (row.estado_plan === "Propuesto") {
                buttonHTML = `
            <div class="btn-group" role="group">
                <button type="button" onclick="abrirModal_menu_multiple(${row.id_project_plans},${row.id_proyecto})" class="btn-editar" title="Editar Datos"><i class="fa-solid fa-layer-group" style="color: rgb(35, 77, 217);"></i></button>
            </div>
        `;
              };

              if (row.estado_plan === "Evaluacion") {
                buttonHTML = `
            <div class="btn-group" role="group">
                <button type="button" class="btn-editar" title="Evaluación en desarrollo" disabled><i class="fa-solid fa-hourglass-half fa-beat" style="color: rgba(255, 213, 0, 1);"></i></button>
            </div>
        `;
              };

              return buttonHTML;
            }
          }
        ]
      });
    });
  </script>

  <script>
    function cargarEntregablesPlan(idPlan) {
      const tabla = $('#tabla_data_entregables_plan');
      const tbody = document.getElementById('tbody_entregables_plan');

      if ($.fn.DataTable.isDataTable('#tabla_data_entregables_plan')) {
        tabla.DataTable().destroy();
      }

      tbody.innerHTML = `
        <tr>
          <td colspan="6" class="text-center text-secondary">
            Cargando entregables...
          </td>
        </tr>
      `;

      $.ajax({
        url: './consultas/consul_obtener_entregables_plan.php',
        type: 'GET',
        data: {
          id_project_plans: idPlan
        },
        dataType: 'json',
        success: function(respuesta) {
          console.log('Entregables recibidos:', respuesta);
          tbody.innerHTML = '';

          if (!respuesta.success) {
            tbody.innerHTML = `
              <tr>
                <td colspan="6" class="text-center text-danger">
                  ${respuesta.message}
                </td>
              </tr>
            `;
            return;
          }

          const entregables = respuesta.data || [];

          if (entregables.length === 0) {
            tbody.innerHTML = `
              <tr>
                <td colspan="6" class="text-center text-secondary">
                  No hay entregables registrados.
                </td>
              </tr>
            `;
            return;
          }

          entregables.forEach(function(entregable) {
            const fila = document.createElement('tr');

            const valores = [
              entregable.id_project_deliverables,
              entregable.nombre_entregable,
              entregable.criterio_aceptacion_entregable,
              entregable.fecha_objetivo_entregable,
              entregable.nom_apell_resp ?? entregable.responsable_entregable ?? ''
            ];

            valores.forEach(function(valor) {
              const celda = document.createElement('td');
              celda.className = 'text-center';
              celda.textContent = valor ?? '';
              fila.appendChild(celda);
            });

            // Celda de Acciones — agregar botones aquí cuando sea necesario
            const celdaAcciones = document.createElement('td');
            celdaAcciones.className = 'text-center';
            /* BOTONES: celdaAcciones.innerHTML = `...`; */
            fila.appendChild(celdaAcciones);

            tbody.appendChild(fila);
          });

          tabla.DataTable({
            autoWidth: false,
            pageLength: 5,
            lengthMenu: [
              [5, 10, 25],
              [5, 10, 25]
            ],
            language: {
              url: '../assets/js/DataEsp.json'
            },
            columnDefs: [{
              targets: 5,
              orderable: false,
              searchable: false
            }]
          });

          setTimeout(function() {
            if ($.fn.DataTable.isDataTable('#tabla_data_entregables_plan')) {
              tabla.DataTable().columns.adjust();
            }
          }, 100);
        },
        error: function(xhr, estado, error) {
          console.error('Error al consultar los entregables:');
          console.error('Estado:', estado);
          console.error('Error:', error);
          console.error('Respuesta PHP:', xhr.responseText);

          tbody.innerHTML = `
            <tr>
              <td colspan="6" class="text-center text-danger">
                Error al obtener los entregables.
              </td>
            </tr>
          `;
        }
      });
    }
  </script>

  <script>
    function cargaractividadestareasPlan(idPlan) {
      const tabla = $('#tabla_data_actividades_tareas_plan');
      const tbody = document.getElementById('tbody_actividades_tareas_plan');

      if ($.fn.DataTable.isDataTable('#tabla_data_actividades_tareas_plan')) {
        tabla.DataTable().destroy();
      }

      tbody.innerHTML = `
        <tr>
          <td colspan="7" class="text-center text-secondary">
            Cargando actividades...
          </td>
        </tr>
      `;

      $.ajax({
        url: './consultas/consul_obtener_actividades_plan.php',
        type: 'GET',
        data: {
          id_project_plans: idPlan
        },
        dataType: 'json',
        success: function(respuesta) {
          console.log('Actividades recibidas:', respuesta);
          tbody.innerHTML = '';

          if (!respuesta.success) {
            tbody.innerHTML = `
              <tr>
                <td colspan="7" class="text-center text-danger">
                  ${respuesta.message}
                </td>
              </tr>
            `;
            return;
          }

          const actividades = respuesta.data || [];

          if (actividades.length === 0) {
            tbody.innerHTML = `
              <tr>
                <td colspan="7" class="text-center text-secondary">
                  No hay actividades registradas.
                </td>
              </tr>
            `;
            return;
          }

          actividades.forEach(function(actividad) {
            const fila = document.createElement('tr');

            const valores = [
              actividad.id_project_activities,
              actividad.nombre_actividad,
              actividad.descripcion_actividad,
              actividad.fecha_inicio_plan_actividad,
              actividad.fecha_fin_plan_actividad,
              actividad.estado_actividad
            ];

            valores.forEach(function(valor) {
              const celda = document.createElement('td');
              celda.className = 'text-center';
              celda.textContent = valor ?? '';
              fila.appendChild(celda);
            });

            const celdaAcciones = document.createElement('td');
            celdaAcciones.className = 'text-center';
            fila.appendChild(celdaAcciones);

            tbody.appendChild(fila);
          });

          tabla.DataTable({
            autoWidth: false,
            pageLength: 5,
            lengthMenu: [
              [5, 10, 25],
              [5, 10, 25]
            ],
            language: {
              url: '../assets/js/DataEsp.json'
            },
            columnDefs: [{
              targets: 6,
              orderable: false,
              searchable: false
            }]
          });

          setTimeout(function() {
            if ($.fn.DataTable.isDataTable('#tabla_data_actividades_tareas_plan')) {
              tabla.DataTable().columns.adjust();
            }
          }, 100);
        },
        error: function(xhr, estado, error) {
          console.error('Error al consultar las actividades:');
          console.error('Estado:', estado);
          console.error('Error:', error);
          console.error('Respuesta PHP:', xhr.responseText);

          tbody.innerHTML = `
            <tr>
              <td colspan="7" class="text-center text-danger">
                Error al obtener las actividades.
              </td>
            </tr>
          `;
        }
      });
    }
  </script>

  <script>
    function cargarhitosPlan(idPlan) {
      const tabla = $('#tabla_data_hitos_plan');
      const tbody = document.getElementById('tbody_hitos_ocurr_plan');

      if ($.fn.DataTable.isDataTable('#tabla_data_hitos_plan')) {
        tabla.DataTable().destroy();
      }

      tbody.innerHTML = `
        <tr>
          <td colspan="6" class="text-center text-secondary">
            Cargando hitos...
          </td>
        </tr>
      `;

      $.ajax({
        url: './consultas/consul_obtener_hitos_plan.php',
        type: 'GET',
        data: {
          id_project_plans: idPlan
        },
        dataType: 'json',
        success: function(respuesta) {
          console.log('Hitos recibidos:', respuesta);
          tbody.innerHTML = '';

          if (!respuesta.success) {
            tbody.innerHTML = `
              <tr>
                <td colspan="6" class="text-center text-danger">
                  ${respuesta.message}
                </td>
              </tr>
            `;
            return;
          }

          const hitos = respuesta.data || [];

          if (hitos.length === 0) {
            tbody.innerHTML = `
              <tr>
                <td colspan="6" class="text-center text-secondary">
                  No hay hitos registrados.
                </td>
              </tr>
            `;
            return;
          }

          hitos.forEach(function(hito) {
            const fila = document.createElement('tr');

            const valores = [
              hito.id_project_plans_milestones,
              hito.nombre_hitos,
              hito.descripcion_hitos,
              hito.fecha_hito,
              hito.estado_hito
            ];

            valores.forEach(function(valor) {
              const celda = document.createElement('td');
              celda.className = 'text-center';
              celda.textContent = valor ?? '';
              fila.appendChild(celda);
            });

            const celdaAcciones = document.createElement('td');
            celdaAcciones.className = 'text-center';
            fila.appendChild(celdaAcciones);

            tbody.appendChild(fila);
          });

          tabla.DataTable({
            autoWidth: false,
            pageLength: 5,
            lengthMenu: [
              [5, 10, 25],
              [5, 10, 25]
            ],
            language: {
              url: '../assets/js/DataEsp.json'
            },
            columnDefs: [{
              targets: 5,
              orderable: false,
              searchable: false
            }]
          });

          setTimeout(function() {
            if ($.fn.DataTable.isDataTable('#tabla_data_hitos_plan')) {
              tabla.DataTable().columns.adjust();
            }
          }, 100);
        },
        error: function(xhr, estado, error) {
          console.error('Error al consultar los hitos:');
          console.error('Estado:', estado);
          console.error('Error:', error);
          console.error('Respuesta PHP:', xhr.responseText);

          tbody.innerHTML = `
            <tr>
              <td colspan="6" class="text-center text-danger">
                Error al obtener los hitos.
              </td>
            </tr>
          `;
        }
      });
    }
  </script>


  <script>
    function cargarrecursosPlan(idPlan) {

      const tabla = $('#tabla_data_recursos_plan');
      const tbody = document.getElementById('tbody_recursos_regist_plan');

      if ($.fn.DataTable.isDataTable('#tabla_data_recursos_plan')) {
        tabla.DataTable().destroy();
      }

      tbody.innerHTML = `
      <tr>
        <td colspan="8" class="text-center text-secondary">
          Cargando recursos...
        </td>
      </tr>
    `;

      $.ajax({

        url: './consultas/consul_obtener_recursos_plan.php',
        type: 'GET',

        data: {
          id_project_plans: idPlan
        },

        dataType: 'json',

        success: function(respuesta) {

          console.log('Recursos recibidos:', respuesta);

          tbody.innerHTML = '';

          if (!respuesta.success) {

            tbody.innerHTML = `
            <tr>
              <td colspan="8" class="text-center text-danger">
                ${respuesta.message}
              </td>
            </tr>
          `;

            return;
          }

          const recursos = respuesta.data || [];

          recursos.forEach(function(recurso) {

            const fila = document.createElement('tr');

            const valores = [
              recurso.id_project_resources,
              recurso.tipo_recurso,
              recurso.descripcion_recurso,
              recurso.cantidad_recurso,
              recurso.periodo_recurso,
              recurso.disponibilidad_recurso,
              recurso.nom_apell_resp
            ];

            valores.forEach(function(valor) {

              const celda = document.createElement('td');

              celda.className = 'text-center';
              celda.textContent = valor ?? '';

              fila.appendChild(celda);

            });

            const celdaAcciones = document.createElement('td');

            celdaAcciones.className = 'text-center';

            fila.appendChild(celdaAcciones);

            tbody.appendChild(fila);

          });

          tabla.DataTable({

            autoWidth: false,

            // Cantidad de registros por página.
            pageLength: 5,

            lengthMenu: [
              [5, 10, 25],
              [5, 10, 25]
            ],

            language: {
              url: '../assets/js/DataEsp.json',
            },

            columnDefs: [{
              targets: 7,
              orderable: false,
              searchable: false
            }]

          });

          // Ajustar columnas si la tabla está dentro de un modal.
          setTimeout(function() {

            if ($.fn.DataTable.isDataTable('#tabla_data_recursos_plan')) {

              tabla.DataTable().columns.adjust();

            }

          }, 100);

        },

        error: function(xhr, estado, error) {

          console.error('Error al consultar los recursos:');
          console.error('Estado:', estado);
          console.error('Error:', error);
          console.error('Respuesta PHP:', xhr.responseText);

          tbody.innerHTML = `
          <tr>
            <td colspan="8" class="text-center text-danger">
              Error al obtener los recursos.
            </td>
          </tr>
        `;

        }

      });

    }
  </script>

  <script>
    function cargarpresupuestosPlan(idPlan, idProyecto) {

      const tablaSelector = '#tabla_data_presupuestos_plan';
      const $tabla = $(tablaSelector);

      if ($.fn.DataTable.isDataTable(tablaSelector)) {
        $tabla.DataTable().destroy();
      }

      const tbody = document.getElementById('tbody_presupuestos_plan');
      tbody.innerHTML = `
        <tr>
          <td colspan="5" class="text-center text-secondary py-3">
            <i class="fa-solid fa-spinner fa-spin me-2"></i>Cargando presupuestos...
          </td>
        </tr>
      `;

      $.ajax({

        url: './consultas/consul_obtener_presupuestos_plan.php',
        type: 'GET',
        data: {
          id_project_plans: idPlan,
          id_proyecto: idProyecto
        },
        dataType: 'json',

        success: function(respuesta) {

          console.log('Presupuestos recibidos:', respuesta);

          if (!respuesta.success) {
            tbody.innerHTML = `
              <tr>
                <td colspan="5" class="text-center text-danger py-3">
                  <i class="fa-solid fa-triangle-exclamation me-2"></i>
                  ${respuesta.message || 'Error al obtener los presupuestos.'}
                </td>
              </tr>
            `;
            return;
          }

          const presupuestos = respuesta.data || [];

          let totalPorcentaje = 0;
          presupuestos.forEach(function(p) {
            totalPorcentaje += obtenerPorcentaje(p.porcentaje_presupuesto);
          });

          const presupuestoTotal =
            (respuesta.presupuesto_est === null ||
              respuesta.presupuesto_est === undefined ||
              respuesta.presupuesto_est === '') ?
            null :
            Number(respuesta.presupuesto_est);

          const excedente = totalPorcentaje - 100;
          const disponible = 100 - totalPorcentaje;
          const aviso = totalPorcentaje > 100 ?
            'No permitido: excede ' + formatearPorcentaje(excedente) :
            'Disponible: ' + formatearPorcentaje(disponible);
          const claseAviso = totalPorcentaje > 100 ? 'text-danger' : 'text-success';

          const pie = document.querySelector(tablaSelector + ' tfoot tr');
          if (pie && pie.cells.length >= 5) {
            pie.cells[0].textContent = 'TOTAL DEL PRESUPUESTO';
            pie.cells[1].textContent = '';
            pie.cells[2].textContent = (presupuestoTotal === null || !Number.isFinite(presupuestoTotal)) ?
              'No definido' :
              formatearPresupuesto(presupuestoTotal) + ' $';
            pie.cells[3].textContent = formatearPorcentaje(totalPorcentaje);
            pie.cells[4].textContent = aviso;
            pie.cells[4].className = 'text-center fw-bold ' + claseAviso;
          }

          tbody.innerHTML = '';

          $tabla.DataTable({

            data: presupuestos,

            language: {
              url: '../assets/js/DataEsp.json'
            },

            pageLength: 5,
            lengthMenu: [
              [5, 10, 25, 50],
              [5, 10, 25, 50]
            ],

            retrieve: false,

            columns: [{
                data: 'categoria_presupuesto',
                className: 'text-center',
                defaultContent: '—'
              },
              {
                data: 'descripcion_presupuesto',
                className: 'text-center',
                defaultContent: '—'
              },
              {
                data: 'monto_presupuesto',
                className: 'text-center',
                defaultContent: '0',
                render: function(data, type) {
                  if (type === 'sort' || type === 'type') return Number(data) || 0;
                  return formatearPresupuesto(data) + ' $';
                }
              },
              {
                data: 'porcentaje_presupuesto',
                className: 'text-center',
                defaultContent: '0',
                render: function(data, type) {
                  const pct = obtenerPorcentaje(data);
                  if (type === 'sort' || type === 'type') return pct;
                  return formatearPorcentaje(pct);
                }
              },
              {
                data: null,
                className: 'text-center',
                orderable: false,
                searchable: false,
                defaultContent: '',
                render: function() {
                  return '';
                }
              }
            ],

            order: [
              [0, 'asc']
            ],

            columnDefs: [{
              targets: '_all',
              defaultContent: ''
            }]

          });

        },

        error: function(xhr, estado, error) {

          console.error('Error al consultar los presupuestos:');
          console.error('Estado:', estado, '| Error:', error);
          console.error('Respuesta PHP:', xhr.responseText);

          tbody.innerHTML = `
            <tr>
              <td colspan="5" class="text-center text-danger py-3">
                <i class="fa-solid fa-triangle-exclamation me-2"></i>
                Error al obtener los presupuestos. Intente nuevamente.
              </td>
            </tr>
          `;
        }

      });

    }


    function formatearPresupuesto(valor) {

      return Number(valor || 0).toLocaleString('es-VE', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      });

    }


    function obtenerPorcentaje(valor) {

      const numero = Number(
        String(valor ?? '0')
        .replace('%', '')
        .replace(',', '.')
        .trim()
      );

      return Number.isFinite(numero) ? numero : 0;

    }


    function formatearPorcentaje(valor) {

      return Number(valor).toLocaleString('es-VE', {
        minimumFractionDigits: 0,
        maximumFractionDigits: 2
      }) + '%';

    }
  </script>

  <script>
    function cargarRiesgosPlan(idPlan, idProyecto) {
      const tabla = $('#tabla_data_riesgos_plan');
      const tbody = document.getElementById('tbody_riesgos_regist_plan');

      if ($.fn.DataTable.isDataTable('#tabla_data_riesgos_plan')) {
        tabla.DataTable().destroy();
      }

      tbody.innerHTML = `
        <tr>
          <td colspan="9" class="text-center text-secondary">
            Cargando riesgos...
          </td>
        </tr>
      `;

      $.ajax({
        url: './consultas/consul_obtener_riesgos_regist_plan.php',
        type: 'GET',
        data: {
          id_proyecto: idProyecto
        },
        dataType: 'json',
        success: function(respuesta) {
          console.log('Riesgos recibidos:', respuesta);
          tbody.innerHTML = '';

          if (!respuesta.success) {
            tbody.innerHTML = `
              <tr>
                <td colspan="9" class="text-center text-danger">
                  ${respuesta.message}
                </td>
              </tr>
            `;
            return;
          }

          const riesgos_plan = respuesta.data || [];

          if (riesgos_plan.length === 0) {
            tbody.innerHTML = `
              <tr>
                <td colspan="9" class="text-center text-secondary">
                  No hay riesgos registrados.
                </td>
              </tr>
            `;
            return;
          }

          riesgos_plan.forEach(function(riesgos_plan) {
            const fila = document.createElement('tr');

            const valores = [
              riesgos_plan.id_projects_risk,
              riesgos_plan.riesgo,
              riesgos_plan.acciones,
              riesgos_plan.probabilidad,
              riesgos_plan.impacto,
              riesgos_plan.nivel_risk,
              riesgos_plan.responsable_risk,
              riesgos_plan.estado_risk
            ];

            //console.log("Hola " + valores);

            valores.forEach(function(valor) {
              const celda = document.createElement('td');
              celda.className = 'text-center';
              celda.textContent = valor ?? '';
              fila.appendChild(celda);
            });

            const celdaAcciones = document.createElement('td');
            celdaAcciones.className = 'text-center';
            fila.appendChild(celdaAcciones);

            tbody.appendChild(fila);
          });

          tabla.DataTable({
            autoWidth: false,
            pageLength: 5,
            lengthMenu: [
              [5, 10, 25],
              [5, 10, 25]
            ],
            language: {
              url: '../assets/js/DataEsp.json'
            },
            columnDefs: [{
              targets: 5,
              orderable: false,
              searchable: false
            }]
          });

          setTimeout(function() {
            if ($.fn.DataTable.isDataTable('#tabla_data_riesgos_plan')) {
              tabla.DataTable().columns.adjust();
            }
          }, 100);
        },
        error: function(xhr, estado, error) {
          console.error('Error al consultar los riesgos:');
          console.error('Estado:', estado);
          console.error('Error:', error);
          console.error('Respuesta PHP:', xhr.responseText);

          tbody.innerHTML = `
            <tr>
              <td colspan="6" class="text-center text-danger">
                Error al obtener los riesgos.
              </td>
            </tr>
          `;
        }
      });
    }
  </script>

  <script>
    function cargarSupuestosPlan(idPlan, idProyecto) {
      const tabla = $('#tabla_data_supuestos_plan');
      const tbody = document.getElementById('tbody_supestos_regist_proy');

      if ($.fn.DataTable.isDataTable('#tabla_data_supuestos_plan')) {
        tabla.DataTable().destroy();
      }

      tbody.innerHTML = `
        <tr>
          <td colspan="9" class="text-center text-secondary">
            Cargando supuestos...
          </td>
        </tr>
      `;

      $.ajax({
        url: './consultas/consul_obtener_supuestos_regist_plan.php',
        type: 'GET',
        data: {
          id_project_plans: idPlan,
          id_proyecto: idProyecto
        },
        dataType: 'json',
        success: function(respuesta) {
          console.log('Riesgos recibidos:', respuesta);
          tbody.innerHTML = '';

          if (!respuesta.success) {
            tbody.innerHTML = `
              <tr>
                <td colspan="9" class="text-center text-danger">
                  ${respuesta.message}
                </td>
              </tr>
            `;
            return;
          }

          const plan_supuestos = respuesta.data || [];

          if (plan_supuestos.length === 0) {
            tbody.innerHTML = `
              <tr>
                <td colspan="9" class="text-center text-secondary">
                  No hay supuestos registrados.
                </td>
              </tr>
            `;
            return;
          }

          plan_supuestos.forEach(function(plan_supuestos) {
            const fila = document.createElement('tr');

            const valores = [
              plan_supuestos.id_project_plans_assumptions,
              plan_supuestos.nombre_supuesto,
              plan_supuestos.descripcion_supuesto,
              plan_supuestos.impacto_supuestos,
              plan_supuestos.estado_supuestos
            ];

            //console.log("Hola " + valores);

            valores.forEach(function(valor) {
              const celda = document.createElement('td');
              celda.className = 'text-center';
              celda.textContent = valor ?? '';
              fila.appendChild(celda);
            });

            const celdaAcciones = document.createElement('td');
            celdaAcciones.className = 'text-center';
            fila.appendChild(celdaAcciones);

            tbody.appendChild(fila);
          });

          tabla.DataTable({
            autoWidth: false,
            pageLength: 5,
            lengthMenu: [
              [5, 10, 25],
              [5, 10, 25]
            ],
            language: {
              url: '../assets/js/DataEsp.json'
            },
            columnDefs: [{
              targets: 5,
              orderable: false,
              searchable: false
            }]
          });

          setTimeout(function() {
            if ($.fn.DataTable.isDataTable('#tabla_data_supuestos_plan')) {
              tabla.DataTable().columns.adjust();
            }
          }, 100);
        },
        error: function(xhr, estado, error) {
          console.error('Error al consultar los supuestos:');
          console.error('Estado:', estado);
          console.error('Error:', error);
          console.error('Respuesta PHP:', xhr.responseText);

          tbody.innerHTML = `
            <tr>
              <td colspan="6" class="text-center text-danger">
                Error al obtener los supuestos.
              </td>
            </tr>
          `;
        }
      });
    }
  </script>

  <script>
    function cargarRestriccionesPlan(idPlan, idProyecto) {
      const tabla = $('#tabla_data_restricciones_plan');
      const tbody = document.getElementById('tbody_restricciones_regist_proy');

      if ($.fn.DataTable.isDataTable('#tabla_data_restricciones_plan')) {
        tabla.DataTable().destroy();
      }

      tbody.innerHTML = `
        <tr>
          <td colspan="9" class="text-center text-secondary">
            Cargando restricciones...
          </td>
        </tr>
      `;

      $.ajax({
        url: './consultas/consul_obtener_restricciones_regist_plan.php',
        type: 'GET',
        data: {
          id_project_plans: idPlan,
          id_proyecto: idProyecto
        },
        dataType: 'json',
        success: function(respuesta) {
          console.log('Restricciones recibidos:', respuesta);
          tbody.innerHTML = '';

          if (!respuesta.success) {
            tbody.innerHTML = `
              <tr>
                <td colspan="9" class="text-center text-danger">
                  ${respuesta.message}
                </td>
              </tr>
            `;
            return;
          }

          const ver_restricc_plan = respuesta.data || [];

          if (ver_restricc_plan.length === 0) {
            tbody.innerHTML = `
              <tr>
                <td colspan="5" class="text-center text-secondary">
                  No hay restricciones registrados.
                </td>
              </tr>
            `;
            return;
          }

          ver_restricc_plan.forEach(function(restriccion) {

            const fila = document.createElement('tr');

            const valores = [
              restriccion.project_plans_restriction,
              restriccion.nombre_restriccion,
              restriccion.descripcion_restriccion,
              restriccion.impacto_restriccion
            ];

            valores.forEach(function(valor) {
              const celda = document.createElement('td');
              celda.className = 'text-center';
              celda.textContent = valor ?? '';
              fila.appendChild(celda);
            });

            const celdaAcciones = document.createElement('td');
            celdaAcciones.className = 'text-center';
            const botonPlanificacion = document.createElement('a');

            botonPlanificacion.href = `./#?id=${encodeURIComponent(restriccion.project_plans_restriction)}`;

            botonPlanificacion.className = 'btn-editar';
            botonPlanificacion.title = 'Editar la restriccion';

            botonPlanificacion.innerHTML = `<i class="fa-solid fa-pen-to-square" style="color: rgb(35, 77, 217);"></i>`;

            celdaAcciones.appendChild(botonPlanificacion);
            fila.appendChild(celdaAcciones);
            tbody.appendChild(fila);

          });

          tabla.DataTable({
            autoWidth: false,
            pageLength: 5,
            lengthMenu: [
              [5, 10, 25],
              [5, 10, 25]
            ],
            language: {
              url: '../assets/js/DataEsp.json'
            },
            columnDefs: [{
              targets: 4,
              orderable: false,
              searchable: false
            }]
          });

          setTimeout(function() {
            if ($.fn.DataTable.isDataTable('#tabla_data_restricciones_plan')) {
              tabla.DataTable().columns.adjust();
            }
          }, 100);
        },
        error: function(xhr, estado, error) {
          console.error('Error al consultar las restricciones:');
          console.error('Estado:', estado);
          console.error('Error:', error);
          console.error('Respuesta PHP:', xhr.responseText);

          tbody.innerHTML = `
            <tr>
              <td colspan="5" class="text-center text-danger">
                Error al obtener las restricciones.
              </td>
            </tr>
          `;
        }
      });
    }
  </script>

  <!-- ------------------ Codigo JS del DataTables, tabla de selección de riesgos ------------------ -->

  <script>
    (function() {
      var selectedRiesgos = new Set();

      $(document).ready(function() {
        var tablaRiesgos = $('#tabla_riesgos_seleccion');

        if (!$.fn.DataTable.isDataTable('#tabla_riesgos_seleccion')) {
          tablaRiesgos.DataTable({
            autoWidth: false,
            pageLength: 5,
            lengthMenu: [
              [5, 10, 25],
              [5, 10, 25]
            ],
            language: {
              url: '../assets/js/DataEsp.json'
            },
            columnDefs: [{
              targets: 0,
              orderable: false,
              searchable: false,
              className: 'text-center'
            }],
            // Restaurar estado visual de checkboxes al dibujar cada página
            drawCallback: function() {
              $('#tabla_riesgos_seleccion tbody .chk_riesgo_seleccion').each(function() {
                var val = $(this).val();
                $(this).prop('checked', selectedRiesgos.has(val));
              });
            }
          });
        }

        $('#tabla_riesgos_seleccion tbody').on('change', '.chk_riesgo_seleccion', function() {
          var val = $(this).val();
          if ($(this).is(':checked')) {
            selectedRiesgos.add(val);
          } else {
            selectedRiesgos.delete(val);
          }
        });
      });
    })();
  </script>

  <script>
    const modalValidElemento = document.getElementById('Modal_valid');
    const modalRiesgoElemento = document.getElementById('Modal_agregar_riesgo');

    const modalValid = bootstrap.Modal.getOrCreateInstance(modalValidElemento);
    const modalRiesgo = bootstrap.Modal.getOrCreateInstance(modalRiesgoElemento);

    function abrirModalValidacion(id) {

      console.log("ID seleccionado:", id);

      document.getElementById('edit_id_Proy_2').value = id;

      //const modalElement = document.getElementById('Modal_valid');
      //const modal = new bootstrap.Modal(modalElement);

      modalValid.show();

      $.ajax({
        url: './consultas/consul_obtener_proyecto.php',
        type: 'GET',
        data: {
          id: id
        },
        dataType: 'json',

        success: function(respuesta) {

          console.log("Respuesta del servidor:", respuesta);

          if (!respuesta.success) {
            alert(respuesta.message);
            return;
          }

          const proyecto = respuesta.data;
          $('#edit_id_Proy_2').val(proyecto.id_proyecto);
          $('#edit_nombre_proy_2').val(proyecto.nombre);
          $('#edit_id_solic_proy_2').val(proyecto.id_solicitante);
          $('#edit_descripcion_proy_2').val(proyecto.descripcion);
          $('#edit_unidad_proy_2').val(proyecto.unidad);
          $('#edit_tipo_proy_2').val(proyecto.tipo);
          $('#edit_prioridad_proy_2').val(proyecto.prioridad);
          $('#edit_sponsor_proy_2').val(proyecto.sponsor);
          $('#edit_fecha_inicio_proy_2').val(proyecto.fecha_inicio);
          $('#edit_fecha_fin_proy_2').val(proyecto.fecha_fin);
          $('#edit_presupuesto_est_proy_2').val(proyecto.presupuesto_est);
          $('#edit_problema_proy_2').val(proyecto.problema);
          $('#edit_objetivos_proy_2').val(proyecto.objetivos);
          $('#edit_beneficios_proy_2').val(proyecto.objetivos);
          $('#edit_avance_proy_2').val(proyecto.avance);
          $('#edit_est_proy_2').val(proyecto.estatus);
          $('#edit_salud_proy_2').val(proyecto.salud);
          $('#presu_est_proy_valid').val(proyecto.presupuesto_est);
          $('#tecnica_proy_valid').val(proyecto.tecnica);
          $('#operativa_proy_valid').val(proyecto.operativa);
          $('#financiera_proy_valid').val(proyecto.financiera);
          $('#organizacional_proy_valid').val(proyecto.organizacional);
          $('#areas_imp_proy_valid').val(proyecto.areas_impacto);
          $('#nivel_imp_proy_valid').val(proyecto.nivel_impacto);
          $('#observa_eval_proy_valid').val(proyecto.observaciones_eval);
          $('#dur_est_proy_valid').val(proyecto.duracion_estimada);
          $('#recur_requer_proy_valid').val(proyecto.recursos_requeridos);
          $('#just_eval_proy_valid').val(proyecto.justificacion_eval);
        },

        error: function(xhr) {

          console.error("Error AJAX:");
          console.error(xhr.responseText);

          alert('Error al obtener los datos del proyecto.');

        }
      });

    }

    function abrirModalAgregarRiesgo() {

      modalValidElemento.addEventListener('hidden.bs.modal', function() {

        modalRiesgo.show();

      }, {
        once: true
      });

      modalRiesgoElemento.addEventListener('hidden.bs.modal', function() {

        modalValid.show();

      }, {
        once: true
      });

      modalValid.hide();

    }
  </script>

  <script>
    let idProjectPlansSeleccionado = 0;
    let idProyectoSeleccionado = 0;

    const modalMenuMultipleElemento = document.getElementById('modal_menu_multiple');

    const modalMenuMultiple = bootstrap.Modal.getOrCreateInstance(
      modalMenuMultipleElemento
    );

    const submodalesPlanMenu = {};

    const idsSubmodalesPlan = [
      'modalAlcancePlan',
      'modalActividadesPlan',
      'modalRecursosPresupuestoPlan',
      'modalRiesgosPlan',
      'modalSeguimientoPlan'
    ];


    idsSubmodalesPlan.forEach(function(idModal) {

      const elemento = document.getElementById(idModal);
      if (!elemento) {

        console.warn('Submodal pendiente de crear:', idModal);

        return;
      }

      submodalesPlanMenu[idModal] = {

        elemento: elemento,

        instancia: bootstrap.Modal.getOrCreateInstance(elemento)

      };

      elemento.addEventListener('hidden.bs.modal', function() {

        if (idProjectPlansSeleccionado > 0) {

          modalMenuMultiple.show();

        }

      });

    });

    function abrirModal_menu_multiple(idPlan, idProyecto) {

      idPlan = parseInt(idPlan, 10);
      idProyecto = parseInt(idProyecto, 10);

      if (!Number.isInteger(idPlan) || idPlan <= 0 || !Number.isInteger(idProyecto) || idProyecto <= 0) {
        console.error('Identificadores inválidos:', {
          idPlan,
          idProyecto
        });

        alert('No se pudo identificar la planificación o el proyecto.');
        return;
      }

      console.log('ID de planificación seleccionado:', idPlan);
      console.log('ID de proyecto seleccionado:', idProyecto);

      idProjectPlansSeleccionado = idPlan;
      idProyectoSeleccionado = idProyecto;
      document.getElementById('id_project_plans_menu').value = idPlan;
      document.getElementById('numero_plan_seleccionado').textContent = idPlan;
      document.getElementById('id_proyecto_menu').value = idProyecto;

      modalMenuMultiple.show();

    }

    function cargarAlcancePlan(id) {

      console.log("ID de planificación seleccionado:", id);

      const idPlan = Number(id);

      console.log('ID recibido en cargarAlcancePlan:', id);
      console.log('ID convertido:', idPlan);
      if (!Number.isInteger(idPlan) || idPlan <= 0) {
        console.error('ID de planificación inválido:', id);
        alert('No se recibió un identificador válido de planificación.');
        return;
      }

      //$('#id_project_plans_alcance').val(id);

      // Limpiar campos antes de consultar.
      //$('#proy_plan_alcance_incluido').val('');
      //$('#proy_plan_alcance_excluido').val('');

      $.ajax({

        url: './consultas/consul_obtener_alcance_plan.php',
        type: 'GET',
        data: {
          id: idPlan
        },
        dataType: 'json',

        success: function(respuesta) {

          console.log("Respuesta del servidor:", respuesta);

          if (!respuesta.success) {

            alert(respuesta.message);
            return;
          }
          const plan = respuesta.data;

          $('#id_project_plans_alcance').val(plan.id_project_plans);
          $('#proy_plan_alcance_incluido').val(plan.alcance_incluido);
          $('#proy_plan_alcance_excluido').val(plan.alcance_excluido);

        },

        error: function(xhr, estado, error) {

          console.error("Error AJAX:");
          console.error("Estado:", estado);
          console.error("Error:", error);
          console.error("Respuesta PHP:", xhr.responseText);

          alert('Error al obtener los datos del alcance.');

        }

      });

    }

    function abrirModal_componente(idModal) {

      const submodal = submodalesPlanMenu[idModal];

      if (!submodal || !submodal.elemento) {

        console.error('El submodal no existe:', idModal);
        return;
      }

      const idPlan = parseInt(
        document.getElementById('id_project_plans_menu').value,
        10
      );

      const idProyecto = parseInt(
        document.getElementById('id_proyecto_menu').value,
        10
      );

      if (
        !Number.isInteger(idPlan) || idPlan <= 0 ||
        !Number.isInteger(idProyecto) || idProyecto <= 0
      ) {

        alert('Primero debe seleccionar una planificación y un proyecto.');
        return;
      }

      console.log('ID de planificación:', idPlan);
      console.log('ID de proyecto:', idProyecto);


      submodal.elemento.dataset.idProjectPlans = idPlan;
      submodal.elemento.dataset.idProyecto = idProyecto;

      submodal.elemento.querySelectorAll(
        'input[name="id_project_plans"]'
      ).forEach(function(input) {

        input.value = idPlan;

      });

      submodal.elemento.querySelectorAll(
        'input[name="id_proyecto"]'
      ).forEach(function(input) {

        input.value = idProyecto;

      });


      modalMenuMultipleElemento.addEventListener(
        'hidden.bs.modal',
        function() {

          submodal.instancia.show();

          if (idModal === 'modalAlcancePlan') {

            cargarAlcancePlan(idPlan);
            cargarEntregablesPlan(idPlan);

          }

          if (idModal === 'modalActividadesPlan') {

            submodal.elemento.addEventListener('shown.bs.modal', function() {
              cargaractividadestareasPlan(idPlan);
              cargarhitosPlan(idPlan);
            }, {
              once: true
            });

          }

          if (idModal === 'modalRecursosPresupuestoPlan') {

            cargarpresupuestosPlan(idPlan, idProyecto);
            cargarrecursosPlan(idPlan);

            submodal.elemento.addEventListener('shown.bs.modal', function() {
              cargarGraficaDistribucionPresupuesto(idPlan);
              cargarGraficaViabilidadRecursos(idPlan)
            }, {
              once: true
            });

          }

          if (idModal === 'modalRiesgosPlan') {

            cargarRiesgosPlan(idPlan, idProyecto);
            cargarSupuestosPlan(idPlan, idProyecto);
            cargarRestriccionesPlan(idPlan, idProyecto);

          }

          if (idModal === 'modalSeguimientoPlan') {

            cargarRiesgosPlan(idPlan, idProyecto);
            cargarSupuestosPlan(idPlan, idProyecto);
            cargarRestriccionesPlan(idPlan, idProyecto);

          }

        }, {
          once: true
        }
      );

      modalMenuMultiple.hide();

    }
  </script>

  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>

  <script>
    const checkboxes = document.querySelectorAll('.form-check-input');

    checkboxes.forEach(checkbox => {
      const fileInputId = checkbox.id.replace('check_', '');
      const fileInput = document.getElementById(fileInputId);

      fileInput.style.display = checkbox.checked ? 'none' : 'block';

      checkbox.addEventListener('change', () => {
        if (checkbox.checked) {
          fileInput.style.display = 'none';
        } else {
          fileInput.style.display = 'block';
        }
      });
    });
  </script>

  <script>
    const asignSelect = document.getElementById('Asign');
    const estadoSelect = document.getElementById('estado');

    asignSelect.addEventListener('change', () => {
      const previousEstado = estadoSelect.value;
      const selectedUser = asignSelect.options[asignSelect.selectedIndex].value;

      if (previousEstado === 'Por Asignar' || previousEstado === '' || previousEstado === 'En Espera') {
        if (selectedUser !== '') {
          estadoSelect.value = 'Asignado';
        }
      }
    });
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const checkbox = document.getElementById('check_data_proyValid');
      const contenedor = document.getElementById('data_proy_container');

      function toggle() {
        contenedor.style.display = checkbox.checked ? 'none' : 'block';
      }

      toggle(); // estado inicial
      checkbox.addEventListener('change', toggle);
    });
  </script>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      document.querySelectorAll(".closeAndRedirect").forEach(function(boton) {
        boton.addEventListener("click", function() {
          window.location.href = "./project_gen_tables_jef.php";
        });
      });
    });
  </script>

  <script>
    const mapaPM = <?php echo json_encode($mapa_pm, JSON_UNESCAPED_UNICODE); ?>;
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const checkbox = document.getElementById('check_ver_riesgos');
      const contenedor = document.getElementById('ver_riesgos_container');

      function toggle() {
        contenedor.style.display = checkbox.checked ? 'none' : 'block';
      }

      toggle(); // estado inicial
      checkbox.addEventListener('change', toggle);
    });
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const checkbox = document.getElementById('check_form_entregable');
      const contenedor = document.getElementById('ver_form_entregables_container');

      function toggle() {
        contenedor.style.display = checkbox.checked ? 'none' : 'block';
      }

      toggle(); // estado inicial
      checkbox.addEventListener('change', toggle);
    });
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const checkbox = document.getElementById('check_form_actividades_tareas');
      const contenedor = document.getElementById('ver_form_act_tar_container');

      function toggle() {
        contenedor.style.display = checkbox.checked ? 'none' : 'block';
      }

      toggle(); // estado inicial
      checkbox.addEventListener('change', toggle);
    });
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const checkbox = document.getElementById('check_form_recursos_nuevos');
      const contenedor = document.getElementById('ver_form_recursos_new_container');

      function toggle() {
        contenedor.style.display = checkbox.checked ? 'none' : 'block';
      }

      toggle(); // estado inicial
      checkbox.addEventListener('change', toggle);
    });
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const checkbox = document.getElementById('check_form_nuevo_presupuesto');
      const contenedor = document.getElementById('ver_form_nuevo_presupuesto_container');

      function toggle() {
        contenedor.style.display = checkbox.checked ? 'none' : 'block';
      }

      toggle(); // estado inicial
      checkbox.addEventListener('change', toggle);
    });
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const checkbox = document.getElementById('check_form_hitos_tareas');
      const contenedor = document.getElementById('ver_form_nuevo_hito_container');

      function toggle() {
        contenedor.style.display = checkbox.checked ? 'none' : 'block';
      }

      toggle(); // estado inicial
      checkbox.addEventListener('change', toggle);
    });
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const checkbox = document.getElementById('check_form_riesgos_nuevos');
      const contenedor = document.getElementById('ver_form_nuevos_riesgos_container');

      function toggle() {
        contenedor.style.display = checkbox.checked ? 'none' : 'block';
      }

      toggle(); // estado inicial
      checkbox.addEventListener('change', toggle);
    });
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const checkbox = document.getElementById('check_form_supuestos_nuevos');
      const contenedor = document.getElementById('ver_form_nuevos_supuestos_container');

      function toggle() {
        contenedor.style.display = checkbox.checked ? 'none' : 'block';
      }

      toggle(); // estado inicial
      checkbox.addEventListener('change', toggle);
    });
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const checkbox = document.getElementById('check_form_resticciones_nuevos');
      const contenedor = document.getElementById('ver_form_nuevos_restricc_container');

      function toggle() {
        contenedor.style.display = checkbox.checked ? 'none' : 'block';
      }

      toggle(); // estado inicial
      checkbox.addEventListener('change', toggle);
    });
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {

      const fechaInicio = document.getElementById('fecha_ini_actividad_proy');
      const fechaFin = document.getElementById('fecha_fin_actividad_proy');
      const duracion = document.getElementById('durac_actividad_proy');

      function convertirFecha(valor) {

        const [anio, mes, dia] = valor.split('-').map(Number);

        return new Date(Date.UTC(anio, mes - 1, dia));
      }

      function sumarMeses(fecha, cantidad) {

        const anio = fecha.getUTCFullYear();
        const mes = fecha.getUTCMonth();
        const dia = fecha.getUTCDate();

        const indiceMes = anio * 12 + mes + cantidad;

        const nuevoAnio = Math.floor(indiceMes / 12);
        const nuevoMes = indiceMes % 12;

        const ultimoDia = new Date(
          Date.UTC(nuevoAnio, nuevoMes + 1, 0)
        ).getUTCDate();

        return new Date(
          Date.UTC(nuevoAnio, nuevoMes, Math.min(dia, ultimoDia))
        );
      }

      function calcularDuracion() {

        const inicioValor = fechaInicio.value;
        const finValor = fechaFin.value;

        duracion.value = '';

        fechaFin.setCustomValidity('');

        if (!inicioValor || !finValor) {
          return;
        }

        const inicio = convertirFecha(inicioValor);
        const fin = convertirFecha(finValor);

        if (fin < inicio) {

          fechaFin.setCustomValidity(
            'La fecha de finalización no puede ser anterior a la fecha de inicio.'
          );

          return;
        }

        let mesesTotales =
          (fin.getUTCFullYear() - inicio.getUTCFullYear()) * 12 +
          (fin.getUTCMonth() - inicio.getUTCMonth());

        let fechaBase = sumarMeses(inicio, mesesTotales);

        if (fechaBase > fin) {

          mesesTotales--;

          fechaBase = sumarMeses(inicio, mesesTotales);
        }

        const dias = Math.round(
          (fin.getTime() - fechaBase.getTime()) / 86400000
        );

        const anios = Math.floor(mesesTotales / 12);
        const meses = mesesTotales % 12;
        const resultado = [];

        if (anios > 0) {
          resultado.push(anios + (anios === 1 ? ' año' : ' años'));
        }

        if (meses > 0) {
          resultado.push(meses + (meses === 1 ? ' mes' : ' meses'));
        }

        if (dias > 0 || resultado.length === 0) {
          resultado.push(dias + (dias === 1 ? ' día' : ' días'));
        }

        duracion.value = resultado.join(' y ');
      }

      fechaInicio.addEventListener('change', function() {

        fechaFin.min = fechaInicio.value;

        calcularDuracion();

      });

      fechaFin.addEventListener('change', calcularDuracion);

    });
  </script>

  <script>
    function limitarTextarea(idTextarea, idContador, maximoCaracteres = 300) {
      const textarea = document.getElementById(idTextarea);
      const contador = document.getElementById(idContador);

      const mensajeError = document.createElement('p');
      mensajeError.classList.add('text-danger');
      mensajeError.textContent = 'Has superado el límite de caracteres (Reiniciar el Registro).';
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

    limitarTextarea("just_eval_proy_valid", "contador_just_eval_proy_valid", 300);
    limitarTextarea("recur_requer_proy_valid", "contador_recur_requer_proy_valid", 300);
    limitarTextarea("observa_eval_proy_valid", "contador_observa_eval_proy_valid", 300);
    limitarTextarea("descripcion_actividad_proy", "contador_descripcion_actividad_proy", 300);
    limitarTextarea("observacion_actividad_proy", "contador_observacion_actividad_proy", 300);
    limitarTextarea("descripcion_hito_proy", "contador_descripcion_hito_proy", 300);
    limitarTextarea("descripcion_presup_proy", "contador_descripcion_presup_proy", 300);
    limitarTextarea("descripcion_recurso_proy", "contador_descripcion_recurso_proy", 300);
    limitarTextarea("edit_descripcion_proy_2", "contador_edit_descripcion_proy_2", 300);
    limitarTextarea("edit_problema_proy_2", "contador_edit_problema_proy_2", 300);
    limitarTextarea("edit_objetivos_proy_2", "contador_edit_objetivos_proy_2", 300);
    limitarTextarea("edit_beneficios_proy_2", "contador_edit_beneficios_proy_2", 300);
    limitarTextarea("impacto_supest_proy", "contador_impacto_supest_proy", 300);
    limitarTextarea("descripcion_supuesto_nuevo_proy", "contador_descripcion_supuesto_nuevo_proy", 300);
  </script>

  <script>
    function limitarTextarea(idTextarea, idContador, maximoCaracteres = 300) {
      const textarea = document.getElementById(idTextarea);
      const contador = document.getElementById(idContador);

      const mensajeError = document.createElement('p');
      mensajeError.classList.add('text-danger');
      mensajeError.textContent = 'Has superado el límite de caracteres (Reiniciar el Registro).';
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

    limitarTextarea("impacto_supest_proy", "contador_impacto_supest_proy", 300);
    limitarTextarea("descripcion_supuesto_nuevo_proy", "contador_descripcion_supuesto_nuevo_proy", 300);
    limitarTextarea("descripcion_restricc_nuevo_proy", "contador_descripcion_restricc_nuevo_proy", 300);
    limitarTextarea("impacto_restricc_proy", "contador_impacto_restricc_proy", 300);
  </script>

  <script>
    let graficaViabilidadRecursos = null;

    function cargarGraficaViabilidadRecursos(idPlan) {

      $.ajax({

        url: "./consultas/consul_graf_recursos.php",

        type: "GET",

        dataType: "json",

        data: {
          id_project_plans: idPlan
        },

        success: function(respuesta) {

          console.log("Respuesta de consul_graf_recursos.php:");
          console.log(respuesta);

          if (!respuesta.success) {
            console.error(respuesta.message);
            return;
          }

          const estados = [];
          const cantidades = [];

          respuesta.data.forEach(function(item) {

            estados.push(item.estatus);
            cantidades.push(parseInt(item.Cantidad, 10) || 0);

          });

          const canvas = document.getElementById(
            "chart_disponibilidad_recursos"
          );

          if (!canvas) {
            console.error("No se encontró el canvas de recursos.");
            return;
          }

          // Destruir gráfica anterior antes de crear otra.
          if (graficaViabilidadRecursos) {
            graficaViabilidadRecursos.destroy();
          }

          const colores = [
            'rgba(22, 163, 74, 0.85)',
            'rgba(255, 193, 7, 0.85)',
            'rgba(220, 53, 69, 0.85)'
          ];

          graficaViabilidadRecursos = new Chart(
            canvas.getContext('2d'), {
              type: 'doughnut',

              data: {
                labels: estados,

                datasets: [{
                  label: 'Cantidad de recursos',
                  data: cantidades,
                  backgroundColor: colores,
                  borderColor: '#ffffff',
                  borderWidth: 2,
                  borderRadius: 5
                }]
              },

              options: {

                responsive: true,
                maintainAspectRatio: false,

                plugins: {

                  legend: {
                    position: 'right',

                    labels: {
                      font: {
                        size: 12
                      },
                      usePointStyle: true,
                      padding: 15
                    }
                  },

                  tooltip: {
                    callbacks: {
                      label: function(context) {
                        return context.label + ': ' +
                          context.raw + ' recursos';
                      }
                    }
                  }

                }

              }

            }
          );

          console.log('Gráfica de disponibilidad actualizada.');

        },

        error: function(xhr, estado, error) {

          console.error("Error al cargar la gráfica de recursos:");
          console.error("Estado:", estado);
          console.error("Error:", error);
          console.error("Respuesta PHP:", xhr.responseText);

        }

      });

    }
  </script>

  <script>
    let graficaDistribucionPresupuesto = null;

    function cargarGraficaDistribucionPresupuesto(idPlan) {

      const canvas = document.getElementById(
        'chart_distribucion_presupuesto'
      );

      if (!canvas) {
        console.error('No se encontró el canvas de distribución del presupuesto.');
        return;
      }

      const id = Number(idPlan);

      if (!Number.isInteger(id) || id <= 0) {
        console.error('Identificador de planificación inválido:', idPlan);
        return;
      }

      if (graficaDistribucionPresupuesto) {
        graficaDistribucionPresupuesto.destroy();
        graficaDistribucionPresupuesto = null;
      }

      $.ajax({

        url: './consultas/consul_graf_presupuesto.php',

        type: 'GET',

        data: {
          id_project_plans: idPlan
        },

        dataType: 'json',

        success: function(respuesta) {

          console.log('Respuesta de distribución del presupuesto:');
          console.log(respuesta);

          if (!respuesta.success) {

            console.error(respuesta.message);
            return;
          }

          const presupuestos = respuesta.data || [];

          const presupuestoTotal = Number(
            respuesta.valor_total_presupuesto
          ) || 0;

          const categorias = presupuestos.map(function(item) {
            return item.categoria_presupuesto;
          });

          const porcentajes = presupuestos.map(function(item) {
            return Number(item.porcentaje_presupuesto) || 0;
          });

          console.log('Categorías:', categorias);
          console.log('Porcentajes:', porcentajes);
          console.log('Presupuesto global:', presupuestoTotal);


          if (presupuestos.length === 0) {

            console.warn('No hay categorías de presupuesto registradas.');

            return;
          }

          const colores = [
            'rgba(37, 99, 235, 1)',
            'rgba(54, 191, 166, 1)',
            'rgba(255, 193, 7, 1)',
            'rgba(239, 68, 68, 1)',
            'rgba(96, 165, 250, 1)',
            'rgba(139, 92, 246, 1)',
            'rgba(249, 115, 22, 1)',
            'rgba(20, 184, 166, 1)'
          ];

          const coloresGrafica = categorias.map(function(categoria, index) {
            return colores[index % colores.length];
          });

          const formatoMoneda = presupuestoTotal.toLocaleString('en-US', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 2
          });
          const textoCentroPresupuesto = {

            id: 'textoCentroPresupuesto',

            afterDraw: function(chart) {

              const ctx = chart.ctx;

              const centroX =
                (chart.chartArea.left + chart.chartArea.right) / 2;

              const centroY =
                (chart.chartArea.top + chart.chartArea.bottom) / 2;

              ctx.save();

              ctx.textAlign = 'center';
              ctx.textBaseline = 'middle';
              ctx.font = 'bold 19px Arial';
              ctx.fillStyle = '#0b1648';

              ctx.fillText(
                '$ ' + formatoMoneda,
                centroX,
                centroY - 7
              );
              ctx.font = '12px Arial';
              ctx.fillStyle = '#0b1648';

              ctx.fillText(
                'USD',
                centroX,
                centroY + 15
              );

              ctx.restore();

            }

          };

          graficaDistribucionPresupuesto = new Chart(
            canvas.getContext('2d'), {
              type: 'doughnut',

              data: {

                labels: categorias,

                datasets: [{

                  label: 'Distribución del presupuesto',
                  data: porcentajes,
                  backgroundColor: coloresGrafica,
                  borderColor: '#ffffff',
                  borderWidth: 2,
                  borderRadius: 3,
                  hoverOffset: 6

                }]

              },

              plugins: [
                textoCentroPresupuesto
              ],

              options: {

                responsive: true,

                maintainAspectRatio: false,

                cutout: '62%',

                plugins: {

                  legend: {

                    position: 'right',

                    labels: {

                      usePointStyle: true,

                      pointStyle: 'circle',

                      padding: 15,

                      font: {
                        size: 12
                      }

                    }

                  },

                  tooltip: {

                    callbacks: {

                      label: function(context) {

                        const porcentaje = Number(context.raw);

                        return ' ' +
                          context.label + ': ' +
                          porcentaje.toLocaleString('es-VE') + '%';

                      }

                    }

                  }

                }

              }

            }
          );

          console.log('Gráfica de distribución creada correctamente.');

        },

        error: function(xhr, estado, error) {

          console.error('Error al consultar la distribución del presupuesto:');
          console.error('Estado:', estado);
          console.error('Error:', error);
          console.error('Respuesta PHP:', xhr.responseText);

        }

      });

    }
  </script>

</body>

</html>