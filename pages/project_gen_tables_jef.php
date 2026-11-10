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

                <h6 class="text-white text-capitalize mb-0">
                  <h3>Proyectos</h3>
                </h6>

              </div>

              <br>

            </div>

            <div class="col-12 mt-3 px-3">

              <div class="d-flex flex-wrap align-items-center gap-3">

                <ul class="nav nav-pills flex-row p-1" id="proyectosTabs" role="tablist">

                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="valid_pro-tab" data-bs-toggle="tab" data-bs-target="#valid_pro-pane" type="button" role="tab" aria-controls="valid_pro-pane" aria-selected="false">Propuestas a Validar</button>
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

                  limitarTextarea("edit_descripcion_proy_2", "contador_edit_descripcion_proy_2", 300);
                  limitarTextarea("edit_problema_proy_2", "contador_edit_problema_proy_2", 300);
                  limitarTextarea("edit_objetivos_proy_2", "contador_edit_objetivos_proy_2", 300);
                  limitarTextarea("edit_beneficios_proy_2", "contador_edit_beneficios_proy_2", 300);
                </script>

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
                    <table class="table table-hover table-striped align-middle">

                      <thead class="table-light">
                        <tr>
                          <th class="text-center">Seleccionar</th>
                          <th class="text-center">Riesgo</th>
                          <th class="text-center">Probabilidad</th>
                          <th class="text-center">Impacto</th>
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
                            $acciones = htmlspecialchars($riesgo['acciones']);
                        ?>

                            <tr>
                              <td>
                                <input type="checkbox" class="form-check-input" id="riesgos_proy_valid" name="riesgos_proy_valid[]" value="<?php echo $id_riesgo; ?>">
                              </td>
                              <td class="text-center"><?php echo $nombre_riesgo; ?></td>
                              <td class="text-center"><?php echo $probabilidad; ?></td>
                              <td class="text-center"><?php echo $impacto; ?></td>
                              <td class="text-center"><?php echo $acciones; ?></td>
                            </tr>

                          <?php
                          }
                        } else {
                          ?>

                          <tr>
                            <td colspan="5" class="text-center text-secondary">
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
              </script>

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

  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/coreui/coreui_bundle_min_js.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/jqery/jquery.js"></script>
  <script src="../assets/DataTable/datatables.min.js"></script>
  <script src="../assets/js/sweetalert2.js"></script>

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
              return `
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
            }
          }
        ]
      });
    });
  </script>

  <!-- ------------------ Codigo del script para ver las propuestas vigentes ------------------ -->

  <script>
    $(document).ready(function() {

      $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {

        const destino = e.target.getAttribute('data-bs-target');
        const tabla = document.querySelector(destino + ' table');

        if (
          tabla &&
          $.fn.DataTable.isDataTable(tabla)
        ) {
          const dt = $(tabla).DataTable();

          dt.columns.adjust();
          if (dt.responsive) {
            dt.responsive.recalc();
          }
        }

      });

    });
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
    const avance = document.getElementById("edit_avance");
    const estado = document.getElementById("edit_est");

    avance.addEventListener("input", function() {

      let valor = parseInt(this.value);

      if (isNaN(valor)) {
        return;
      }

      if (valor < 0) {
        this.value = 0;
        valor = 0;
      }

      if (valor > 100) {
        this.value = 100;
        valor = 100;
      }

      if (valor === 100) {
        estado.value = "Completado";
      } else if (estado.value === "Completado") {
        estado.value = "En progreso";
      }
    });

    estado.addEventListener("change", function() {

      if (this.value === "Completado") {
        avance.value = 100;
      } else if (
        this.value === "En progreso" ||
        this.value === "Por Ejecutar"
      ) {

        if (parseInt(avance.value) >= 100 || avance.value === "") {
          avance.value = 99;
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

</body>



</html>