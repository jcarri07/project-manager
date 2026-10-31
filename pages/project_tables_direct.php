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
  ?>




  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

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

                <h6 class="text-white text-capitalize mb-0">Proyectos</h6>

              </div>

              <br>

            </div>

            <div class="col-12 mt-3 px-3">

              <div class="d-flex flex-wrap align-items-center gap-3">

                <a href="../pages/nuevo_proyecto_direct.php?form=add" class="nav-link mb-0 px-3 py-2">
                  <i class="material-icons text-lg position-relative">person</i>
                  <span class="ms-1">Nuevo Proyecto</span>
                </a>

                <ul class="nav nav-pills flex-row p-1" id="proyectosTabs" role="tablist">

                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="proyectos_gen-tab" data-bs-toggle="tab" data-bs-target="#proyectos_gen-pane" type="button" role="tab" aria-controls="proyectos_gen-pane" aria-selected="true">Vista General</button>
                  </li>

                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="asig_valid-tab" data-bs-toggle="tab" data-bs-target="#asig_valid-pane" type="button" role="tab" aria-controls="asig_valid-pane" aria-selected="false">Propuestas para Validación</button>
                  </li>

                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="aprob_proy-tab" data-bs-toggle="tab" data-bs-target="#aprob_proy-pane" type="button" role="tab" aria-controls="aprob_proy-pane" aria-selected="false">Propuestas para Aprobación</button>
                  </li>

                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="proy_vig-tab" data-bs-toggle="tab" data-bs-target="#proy_vig-pane" type="button" role="tab" aria-controls="proy_vig-pane" aria-selected="false">Proyectos Vigentes</button>
                  </li>

                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="proy_personal-tab" data-bs-toggle="tab" data-bs-target="#proy_personal-pane" type="button" role="tab" aria-controls="proy_personal-pane" aria-selected="false">Propuestas Propias</button>
                  </li>

                </ul>

              </div>

            </div>

          </div>


          <div class="card-body px-3 pb-3">

            <div class="tab-content" id="proyectosTabsContent">

              <div class="tab-pane fade show active" id="proyectos_gen-pane" role="tabpanel" aria-labelledby="proyectos_gen-tab" tabindex="0">

                <div class="table-responsive">

                  <table id="tabla_proyectos_gen" class="table tabla-proyectos align-items-center justify-content-center" style="width:100%">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Proyecto</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unidad</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estado</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Salud</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Inicio</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fin</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Progreso</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Prioridad</th>

                      </tr>
                    </thead>

                    <tbody>
                    </tbody>

                  </table>

                </div>
              </div>

              <div class="tab-pane fade" id="asig_valid-pane" role="tabpanel" aria-labelledby="asig_valid-tab" tabindex="0">

                <div class="table-responsive">

                  <table id="tabla_proyectos_eval" class="table tabla-proyectos align-items-center justify-content-center" style="width:100%">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Proyecto</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unidad</th>
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

              <div class="tab-pane fade" id="aprob_proy-pane" role="tabpanel" aria-labelledby="aprob_proy-tab" tabindex="0">

                <div class="table-responsive">

                  <table id="tabla_proyectos_aprob" class="table tabla-proyectos align-items-center justify-content-center" style="width:100%">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Proyecto</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unidad</th>
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

              <div class="tab-pane fade show" id="proy_vig-pane" role="tabpanel" aria-labelledby="proy_vig-tab" tabindex="0">

                <div class="table-responsive">

                  <table id="tabla_proyectos_pers_aprob" class="table tabla-proyectos align-items-center justify-content-center" style="width:100%">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Proyecto</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unidad</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estado</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Salud</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Inicio</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fin</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Progreso</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Prioridad</th>

                      </tr>
                    </thead>

                    <tbody>
                    </tbody>

                  </table>

                </div>

              </div>

              <div class="tab-pane fade" id="proy_personal-pane" role="tabpanel" aria-labelledby="proy_personal-tab" tabindex="0">

                <div class="table-responsive">

                  <table id="tabla_proyectos_pers" class="table tabla-proyectos align-items-center justify-content-center" style="width:100%">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Proyecto</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unidad</th>
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

  </main>

  <!-- --------------------------------------------------------------------------------------------------------------- -->

  <!-- ------------------Codigo del modal para editar las propuestas propias ------------------ -->

  <div class="modal w3-container" id="Modal_edit" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content w3-animate-opacity">
        <div class="w3-container w3-teal">
          <br>
          <p class="modal-title" style="color: black;">Propuesta Propia</p>
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

          <form class="row g-3" action="./proses_proyecto.php?act=update_proy_propio" id="form-upload" enctype="multipart/form-data" method="POST">

            <input type="hidden" style="display:none" class="form-control" id="edit_id_Proy_1" name="edit_id_Proy_1" readonly>

            <div class="row g-3">

              <div class="col-md-3" style="color:black">
                <label for="Comando" class="form-label">Nombre del Proyecto: </label>
                <input type="text" class="form-control" id="edit_nombre_proy_1" name="edit_nombre_proy_1">
              </div>

              <div class="col-md-3" style="color:black">
                <label for="Cond" class="form-label">Unidad: </label>
                <select class="form-select" id="edit_unidad_proy_1" name="edit_unidad_proy_1">
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

              <div class="col-md-3" style="color:black">
                <label for="fecha" class="form-label">Agregar nuevos Co-Autores: </label>
                <select class="form-multi-select" id="edit_new_co_autor_1" name="edit_new_co_autor_1[]" multiple data-coreui-search="global">
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

              <div class="col-md-3" style="color:black">
                <label for="fecha" class="form-label">Quitar Co-Autores: </label>
                <select
                  class="form-multi-select" id="edit_quitar_co_autor_1" name="edit_quitar_co_autor_1[]" multiple data-coreui-multi-select data-coreui-search="global">
                </select>

                <small class="text-muted">
                  Selecciona únicamente los coautores que deseas quitar.
                </small>
              </div>

            </div>

            <br>

            <div class="row g-3">

              <div class="col-md-3" style="color:black">
                <label for="Comando" class="form-label">Tipo: </label>
                <input type="text" class="form-control" id="edit_tipo_proy_1" name="edit_tipo_proy_1">
              </div>

              <div class="col-md-3" style="color:black">
                <label for="Comando" class="form-label">Prioridad: </label>
                <input type="text" class="form-control" id="edit_prioridad_proy_1" name="edit_prioridad_proy_1">
              </div>

              <div class="col-md-3" style="color:black">
                <label for="Comando" class="form-label">Sponsor: </label>
                <input type="text" class="form-control" id="edit_sponsor_proy_1" name="edit_sponsor_proy_1">
              </div>

            </div>

            <br>

            <div class="row g-3">

              <div class="col-md-3" style="color:black">
                <label class="form-label">Inicio estimado</label>
                <input type="date" name="edit_fecha_inicio_proy_1" id="edit_fecha_inicio_proy_1" class="form-control border px-3">
              </div>

              <div class="col-md-3">
                <label class="form-label">Final estimado</label>
                <input type="date" name="edit_fecha_fin_proy_1" id="edit_fecha_fin_proy_1" class="form-control border px-3">
              </div>

              <div class="col-md-3" style="color:black">
                <label for="Comando" class="form-label">Presupesto: </label>
                <div class="input-group col-md-">
                  <input type="number" class="form-control" id="edit_presupuesto_est_proy_1" name="edit_presupuesto_est_proy_1">
                  <span class="input-group-text">$</span>
                </div>
              </div>

            </div>

            <div class="row g-3">

              <div class="col-md-3" style="color:black">
                <label for="Grafica" class="form-label">Problematica: </label>
                <textarea name="edit_problema_proy_1" id="edit_problema_proy_1" cols="40" rows="4" class="form-control"></textarea>
                <div id="contador_edit_problema_proy_1"></div>
              </div>

              <div class="col-md-3" style="color:black">
                <label for="Grafica" class="form-label">Objetivos del Proyecto: </label>
                <textarea name="edit_objetivos_proy_1" id="edit_objetivos_proy_1" cols="40" rows="4" class="form-control"></textarea>
                <div id="contador_edit_objetivos_proy_1"></div>
              </div>

              <div class="col-md-3" style="color:black">
                <label for="Grafica" class="form-label">Beneficios del Proyecto: </label>
                <textarea name="edit_beneficios_proy_1" id="edit_beneficios_proy_1" cols="40" rows="4" class="form-control"></textarea>
                <div id="contador_edit_beneficios_proy_1"></div>
              </div>

              <div class="col-md-3" style="color:black">
                <label for="Grafica" class="form-label">Descripción del Proyecto: </label>
                <textarea name="edit_descripcion_proy_1" id="edit_descripcion_proy_1" cols="40" rows="4" class="form-control"></textarea>
                <div id="contador_edit_descripcion_proy_1"></div>
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

                limitarTextarea("edit_descripcion_proy_1", "contador_edit_descripcion_proy_1", 300);
                limitarTextarea("edit_problema_proy_1", "contador_edit_problema_proy_1", 300);
                limitarTextarea("edit_objetivos_proy_1", "contador_edit_objetivos_proy_1", 300);
                limitarTextarea("edit_beneficios_proy_1", "contador_edit_beneficios_proy_1", 300);
              </script>

            </div>


            <br>

            <br><br><br>

            <div class="d-grid gap-2 col-6 mx-auto">

              <button type="submit" class="btn btn-primary" id="Redirect" data-bs-dismiss="modal">Editar</button>

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

  <!-- ------------------Codigo del modal para seleccionar un evaluador de proyecto ------------------ -->

  <div class="modal w3-container" id="Modal_Select_Eval" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content w3-animate-opacity">
        <div class="w3-container w3-teal">
          <br>
          <p class="modal-title" style="color: black;">Nuevo Proyecto Pendiente de Evaluación</p>
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

          <form class="row g-3" action="./proses_proyecto.php?act=update_asig_eval" id="form-upload" enctype="multipart/form-data" method="POST">

            <input type="hidden" style="display:none" class="form-control" id="edit_id_Proy_2" name="edit_id_Proy_2" readonly>

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
                  <span class="input-group-text">%</span>
                </div>
              </div>

            </div>

            <div class="row g-3">

              <div class="col-md-3" style="color:black">
                <label for="Grafica" class="form-label">Problematica: </label>
                <textarea name="edit_problema_proy_2" id="edit_problema_proy_2" cols="40" rows="4" class="form-control" readonly></textarea>
                <div id="contador_edit_problema_proy_2"></div>
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


            <br>

            <div class="row g-3">

              <div class="col-md-6" style="color:black">
                <label class="form-label">Asignar Evaluador:</label>
                <select class="form-select" id="select_id_eval_proy" name="select_id_eval_proy" required>
                  <option value="">Seleccione un evaluador</option>
                </select>
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

  <!-- ------------------Codigo del modal para aprobar el proyecto ------------------ -->

  <div class="modal w3-container" id="Modal_Decision_Proy" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content w3-animate-opacity">
        <div class="w3-container w3-teal">
          <br>
          <p class="modal-title" style="color: black;">Evaluación</p>
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

          <form class="row g-3" action="./proses_proyecto.php?act=insert_decision_proy" id="form-upload" enctype="multipart/form-data" method="POST">

            <input type="hidden" style="display:none" class="form-control" id="edit_id_Proy_3" name="edit_id_Proy_3" readonly>

            <div class="row g-3">

              <div class="col-md-4" style="color:black">
                <label for="Comando" class="form-label">Nombre del Proyecto: </label>
                <input type="text" class="form-control" id="edit_nombre_proy_3" name="edit_nombre_proy_3" disabled>
              </div>

              <div class="col-md-4" style="color:black">
                <label for="Cond" class="form-label">Solicitante: </label>
                <select class="form-select" id="edit_id_solic_proy_3" name="edit_id_solic_proy_3" disabled>
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
                <select class="form-select" id="edit_unidad_proy_3" name="edit_unidad_proy_3" disabled>
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
                <input type="text" class="form-control" id="edit_tipo_proy_3" name="edit_tipo_proy_3" disabled>
              </div>

              <div class="col-md-3" style="color:black">
                <label for="Comando" class="form-label">Prioridad: </label>
                <input type="text" class="form-control" id="edit_prioridad_proy_3" name="edit_prioridad_proy_3" disabled>
              </div>

              <div class="col-md-3" style="color:black">
                <label for="Comando" class="form-label">Sponsor: </label>
                <input type="text" class="form-control" id="edit_sponsor_proy_3" name="edit_sponsor_proy_3" disabled>
              </div>

            </div>

            <br>

            <div class="row g-3">

              <div class="col-md-3" style="color:black">
                <label class="form-label">Inicio estimado</label>
                <input type="date" name="edit_fecha_inicio_proy_3" id="edit_fecha_inicio_proy_3" class="form-control border px-3" disabled>
              </div>

              <div class="col-md-3">
                <label class="form-label">Final estimado</label>
                <input type="date" name="edit_fecha_fin_proy_3" id="edit_fecha_fin_proy_3" class="form-control border px-3" disabled>
              </div>

              <div class="col-md-3" style="color:black">
                <label for="Comando" class="form-label">Presupesto: </label>
                <div class="input-group col-md-">
                  <input type="number" class="form-control" id="edit_presupuesto_est_proy_3" name="edit_presupuesto_est_proy_3" disabled>
                  <span class="input-group-text">$</span>
                </div>
              </div>

              <div class="col-md-3" style="color:black">
                <label for="Comando" class="form-label">Avance: </label>
                <div class="input-group col-md-">
                  <input type="number" class="form-control" id="edit_avance_proy_3" name="edit_avance_proy_3" disabled>
                  <span class="input-group-text">%</span>
                </div>
              </div>

            </div>

            <div class="row g-3">

              <div class="col-md-12" style="color:black">
                <label for="Grafica" class="form-label">Problematica: </label>
                <textarea name="edit_problema_proy_3" id="edit_problema_proy_3" cols="40" rows="4" class="form-control" readonly></textarea>
                <div id="contador_edit_problema_proy_3"></div>
              </div>

              <div class="col-md-12" style="color:black">
                <label for="Grafica" class="form-label">Objetivos del Proyecto: </label>
                <textarea name="edit_objetivos_proy_3" id="edit_objetivos_proy_3" cols="40" rows="4" class="form-control" readonly></textarea>
                <div id="contador_edit_objetivos_proy_3"></div>
              </div>

              <div class="col-md-12" style="color:black">
                <label for="Grafica" class="form-label">Beneficios del Proyecto: </label>
                <textarea name="edit_beneficios_proy_2" id="edit_beneficios_proy_3" cols="40" rows="4" class="form-control" readonly></textarea>
                <div id="contador_edit_beneficios_proy_3"></div>
              </div>

              <div class="col-md-12" style="color:black">
                <label for="Grafica" class="form-label">Descripción del Proyecto: </label>
                <textarea name="edit_descripcion_proy_3" id="edit_descripcion_proy_3" cols="40" rows="4" class="form-control" readonly></textarea>
                <div id="contador_edit_descripcion_proy_3"></div>
              </div>

            </div>


            <br>

            <div class="row g-3">

              <div class="col-md-6" style="color:black">
                <label for="Comando" class="form-label">Dimensiones: </label>
                <div class="input-group col-md-">
                  <input type="text" class="form-control" id="edit_dimension_proy_3" name="edit_dimension_proy_3" disabled>
                </div>
              </div>

            </div>
            <div class="row g-3">

              <div class="col-md-6" style="color:black">
                <label for="Grafica" class="form-label">Evaluación del Proyecto: </label>
                <textarea name="edit_evaluacion_proy_3" id="edit_evaluacion_proy_3" cols="40" rows="4" class="form-control" readonly></textarea>
                <div id="contador_edit_evaluacion_proy_3"></div>
              </div>

              <div class="col-md-6" style="color:black">
                <label for="Grafica" class="form-label">Comentario del Proyecto: </label>
                <textarea name="edit_comentario_proy_3" id="edit_comentario_proy_3" cols="40" rows="4" class="form-control" readonly></textarea>
                <div id="contador_edit_comentario_proy_3"></div>
              </div>

            </div>

            <div class="row g-3">

              <div class="col-md-6" style="color:black">
                <label for="Grafica" class="form-label">Justificacion del Proyecto: </label>
                <textarea name="justificacion_proy_3" id="justificacion_proy_3" cols="40" rows="4" class="form-control"></textarea>
                <div id="contador_justificacion_proy_3">300</div>
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

                limitarTextarea("justificacion_proy_3", "contador_justificacion_proy_3", 300);
              </script>

            </div>

            <div class="row g-3">

              <div class="col-md-6" style="color:black">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="decision_proy" id="flexRadioDefault1" value="1" required>
                  <label class="form-check-label" for="flexRadioDefault1">
                    Aprobar el proyecto
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="decision_proy" id="flexRadioDefault2" value="2">
                  <label class="form-check-label" for="flexRadioDefault2">
                    Solicitar información adicional
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="decision_proy" id="flexRadioDefault3" value="3">
                  <label class="form-check-label" for="flexRadioDefault3">
                    No aprobar
                  </label>
                </div>
              </div>

              <div class="col-md-6" style="color:black">
                <label for="Cond" class="form-label">Progect Manager: </label>
                <select class="form-select" id="PM_proy" name="PM_proy" disabled>
                  <?php
                  $query_data = mysqli_query($conn, "SELECT * FROM users WHERE users.id_user_type != '3'");
                  while ($miembro = mysqli_fetch_assoc($query_data)) {
                    $id = $miembro['id_usuario'];
                    $nombre = ($miembro['nombre_user']);
                    $apell = ($miembro['apellido_user']);
                    echo "<option value=\"$id\">$nombre $apell</option>";
                  }
                  ?>
                </select>
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

  <!-- ------------------------------------------------------------------------------------------------------------------ -->

  </div>
  <!--   Core JS Files  -->
  <script src="../assets/js/material-dashboard.min.js?v=3.0.4"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/coreui/coreui_bundle_min_js.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/jqery/jquery.js"></script>
  <script src="../assets/DataTable/datatables.min.js"></script>
  <script src="../assets/js/sweetalert2.js"></script>

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
    $(document).ready(function() {
      $('#tabla_proyectos_gen').DataTable({
        //autoWidth: false,
        //responsive: true, consul_proyectos_valid_direct   consul_proyectos_aprob_direct
        //pageLength: 5,
        "language": {
          "url": "../assets/js/DataEsp.json"
        },
        "ajax": {
          "url": "./consultas/consul_proyectos_gen_direct.php",
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
          }
        ]
      });
    });
  </script>

  <script>
    $(document).ready(function() {
      $('#tabla_proyectos_eval').DataTable({
        //autoWidth: false,
        //responsive: true,    consul_proyectos_aprob_direct
        //pageLength: 5,
        "language": {
          "url": "../assets/js/DataEsp.json"
        },
        "ajax": {
          "url": "./consultas/consul_proyectos_valid_direct.php",
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
                    onclick="abrirModalSelectEval(${row.id_proyecto})"
                    class="btn-editar"
                    title="Asignar Evaluador">

                    <i class="fa-solid fa-person" style="color: rgb(0, 92, 255);"></i>

                </button>
            </div>
        `;
            }
          }
        ]
      });
    });
  </script>

  <script>
    $(document).ready(function() {
      $('#tabla_proyectos_pers').DataTable({
        //autoWidth: false,
        //responsive: true,    consul_proyectos_aprob_direct
        //pageLength: 5,
        "language": {
          "url": "../assets/js/DataEsp.json"
        },
        "ajax": {
          "url": "./consultas/consul_proyectos_personal.php",
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
            <div class="btn-group" role="group">
                <button type="button" onclick="abrirModalEditar(${row.id_proyecto})" class="btn-editar" title="Editar Datos"><i class="fa-regular fa-pen-to-square"></i></button>
            </div>
        `;
              if (row.estatus === "Propuesto") {

                buttonHTML += `
                <div class="btn-group" role="group">
                    <button type="button" onclick="confirmarValidacion(${row.id_proyecto})"class="btn-editar"title="Validar proyecto"><i class="fa-solid fa-bell" style="color: rgb(0, 92, 255);"></i></button>
                </div>
            `;

              }

              return buttonHTML;
            }
          }
        ]
      });
    });
  </script>

  <script>
    $(document).ready(function() {
      $('#tabla_proyectos_aprob').DataTable({
        //autoWidth: false,
        //responsive: true,    
        //pageLength: 5,
        "language": {
          "url": "../assets/js/DataEsp.json"
        },
        "ajax": {
          "url": "./consultas/consul_proyectos_aprob_direct.php",
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
                    onclick="abrirModalEvaluacion(${row.id_proyecto})"
                    class="btn-editar"
                    title="Editar Datos">

                    <i class="fa-regular fa-pen-to-square"></i>

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
      $('#tabla_proyectos_pers_aprob').DataTable({
        //autoWidth: false,
        //responsive: true, 
        //pageLength: 5,
        "language": {
          "url": "../assets/js/DataEsp.json"
        },
        "ajax": {
          "url": "./consultas/consul_proyectos_pers_aprob.php",
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
            <div class="btn-group" role="group">
                <button type="button" onclick="abrirModalEditar(${row.id_proyecto})" class="btn-editar" title="Editar Datos"><i class="fa-solid fa-gears" style="color: rgb(0, 92, 255);"></i></button>
            </div>
        `;

              return buttonHTML;
            }
          }
        ]
      });
    });
  </script>

  <script>
    function abrirModalEditar(id) {

      console.log("ID seleccionado:", id);

      document.getElementById('edit_id_Proy_1').value = id;

      const modalElement = document.getElementById('Modal_edit');
      const modal = new bootstrap.Modal(modalElement);

      modal.show();

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
          $('#edit_id_Proy_1').val(proyecto.id_proyecto);
          $('#edit_nombre_proy_1').val(proyecto.nombre);
          $('#edit_id_solic_proy_1').val(proyecto.id_solicitante);
          $('#edit_descripcion_proy_1').val(proyecto.descripcion);
          $('#edit_unidad_proy_1').val(proyecto.unidad);
          $('#edit_tipo_proy_1').val(proyecto.tipo);
          $('#edit_prioridad_proy_1').val(proyecto.prioridad);
          $('#edit_sponsor_proy_1').val(proyecto.sponsor);
          $('#edit_fecha_inicio_proy_1').val(proyecto.fecha_inicio);
          $('#edit_fecha_fin_proy_1').val(proyecto.fecha_fin);
          $('#edit_presupuesto_est_proy_1').val(proyecto.presupuesto_est);
          $('#edit_problema_proy_1').val(proyecto.problema);
          $('#edit_objetivos_proy_1').val(proyecto.objetivos);
          $('#edit_beneficios_proy_1').val(proyecto.objetivos);
          $('#edit_avance_proy_1').val(proyecto.avance);
          $('#edit_est_proy_1').val(proyecto.estatus);
          $('#edit_salud_proy_1').val(proyecto.salud);

          cargarCoautoresParaQuitar(proyecto.id_proyecto);

        },

        error: function(xhr) {

          console.error("Error AJAX:");
          console.error(xhr.responseText);

          alert('Error al obtener los datos del proyecto.');

        }
      });
    }

    function cargarCoautoresParaQuitar(idProyecto) {

      const elemento = document.getElementById('edit_quitar_co_autor_1');

      if (!elemento) {
        console.error(
          'No existe el selector #edit_quitar_co_autor_1. Revisa el ID del HTML.'
        );
        return;
      }

      console.log('Cargando coautores del proyecto:', idProyecto);

      $.ajax({
        url: './consultas/consul_coautores_proy_elim.php',
        type: 'GET',
        data: {
          id_proyecto: idProyecto
        },
        dataType: 'json',

        success: function(respuesta) {

          console.log('Respuesta de coautores:', respuesta);

          const coautores = Array.isArray(respuesta) ?
            respuesta :
            respuesta.data;

          if (!Array.isArray(coautores)) {
            console.error(
              'La respuesta del servidor no contiene una lista de coautores.',
              respuesta
            );
            return;
          }

          const opciones = coautores.map(function(usuario) {
            return {
              value: String(usuario.id_usuario),
              text: usuario.nombre_user + ' ' +
                usuario.apellido_user +
                ' | Especialidad: ' +
                (usuario.especialidad || 'No especificada')
            };
          });

          const MultiSelect = window.coreui &&
            window.coreui.MultiSelect;

          if (!MultiSelect) {
            console.error(
              'CoreUI MultiSelect no está disponible. Revisa coreui_bundle_min_js.js.'
            );
            return;
          }

          const instancia = typeof MultiSelect.getInstance === 'function' ?
            MultiSelect.getInstance(elemento) :
            null;

          if (instancia) {

            if (typeof instancia.update === 'function') {

              instancia.update({
                options: opciones,
                resetSelectionOnOptionsChange: true
              });

              console.log('Selector de coautores actualizado.');

            } else {
              console.error(
                'La instancia de CoreUI no dispone del método update().',
                instancia
              );
              return;
            }

          } else {

            elemento.replaceChildren();

            new MultiSelect(elemento, {
              name: elemento.name,
              multiple: true,
              search: true,
              options: opciones,
              resetSelectionOnOptionsChange: true
            });
          }

          console.log(
            'Cantidad de coautores encontrados:',
            coautores.length
          );
        },

        error: function(xhr, estado, error) {

          console.error('Error al cargar los coautores.');
          console.error('Estado:', estado);
          console.error('Error:', error);
          console.error('Respuesta PHP:', xhr.responseText);

          alert('No se pudieron cargar los coautores del proyecto.');
        }
      });
    }
  </script>

  <script>
    function confirmarValidacion(idProyecto) {

      Swal.fire({
        title: "¿Validar proyecto?",
        text: "¿Estás seguro de que solicitar la validacion del proyecto?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, validar",
        cancelButtonText: "Cancelar"
      }).then((result) => {

        if (result.isConfirmed) {

          const formulario = document.createElement("form");

          formulario.method = "POST";
          formulario.action = "./proses_proyecto.php?act=update_valid_proy_trab";

          const campoId = document.createElement("input");

          campoId.type = "hidden";
          campoId.name = "id_proyecto";
          campoId.value = idProyecto;

          formulario.appendChild(campoId);
          document.body.appendChild(formulario);

          formulario.submit();
        }

      });
    }
  </script>

  <script>
    function abrirModalSelectEval(id) {


      console.log("ID seleccionado:", id);

      document.getElementById('edit_id_Proy_2').value = id;

      const modalElement = document.getElementById('Modal_Select_Eval');
      const modal = new bootstrap.Modal(modalElement);

      modal.show();

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
            console.log("Prueba");
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
          $('#edit_beneficios_proy_2').val(proyecto.beneficios);
          $('#edit_avance_proy_2').val(proyecto.avance);
          $('#edit_est_proy_2').val(proyecto.estatus);
          $('#edit_salud_proy_2').val(proyecto.salud);

          $.ajax({
            url: './consultas/consul_evaluadores.php',
            type: 'GET',
            dataType: 'json',
            data: {
              id_excluir: proyecto.id_solicitante,
              id_proyecto: proyecto.id_proyecto
            },
            success: function(usuarios) {
              const select = $('#select_id_eval_proy');

              select.empty();
              select.append(
                $('<option>', {
                  value: '',
                  text: 'Seleccione un evaluador'
                })
              );

              usuarios.forEach(function(usuario) {
                select.append(
                  $('<option>', {
                    value: usuario.id_usuario,
                    text: usuario.nombre_user + ' ' + usuario.apellido_user + '| Especialidad: ' + usuario.especialidad
                  })
                );
              });
            },
            error: function(xhr) {
              console.error('Error al cargar evaluadores:', xhr.responseText);
            }
          });

        },

        error: function(xhr) {

          console.error("Error AJAX:");
          console.error(xhr.responseText);

          alert('Error al obtener los datos del proyecto.');

        }
      });
    }
  </script>

  <script>
    function abrirModalEvaluacion(id) {

      console.log("ID seleccionado:", id);

      document.getElementById('edit_id_Proy_3').value = id;

      const modalElement = document.getElementById('Modal_Decision_Proy');
      const modal = new bootstrap.Modal(modalElement);

      modal.show();

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
          $('#edit_id_Proy_3').val(proyecto.id_proyecto);
          $('#edit_nombre_proy_3').val(proyecto.nombre);
          $('#edit_id_solic_proy_3').val(proyecto.id_solicitante);
          $('#edit_descripcion_proy_3').val(proyecto.descripcion);
          $('#edit_unidad_proy_3').val(proyecto.unidad);
          $('#edit_tipo_proy_3').val(proyecto.tipo);
          $('#edit_prioridad_proy_3').val(proyecto.prioridad);
          $('#edit_sponsor_proy_3').val(proyecto.sponsor);
          $('#edit_fecha_inicio_proy_3').val(proyecto.fecha_inicio);
          $('#edit_fecha_fin_proy_3').val(proyecto.fecha_fin);
          $('#edit_presupuesto_est_proy_3').val(proyecto.presupuesto_est);
          $('#edit_problema_proy_3').val(proyecto.problema);
          $('#edit_objetivos_proy_3').val(proyecto.objetivos);
          $('#edit_beneficios_proy_3').val(proyecto.objetivos);
          $('#edit_avance_proy_3').val(proyecto.avance);
          $('#edit_est_proy_3').val(proyecto.estatus);
          $('#edit_salud_proy_3').val(proyecto.salud);
          $('#edit_dimension_proy_3').val(proyecto.dimension);
          $('#edit_evaluacion_proy_3').val(proyecto.evaluacion);
          $('#edit_comentario_proy_3').val(proyecto.comentario);

        },

        error: function(xhr) {

          console.error("Error AJAX:");
          console.error(xhr.responseText);

          alert('Error al obtener los datos del proyecto.');

        }
      });
    }
  </script>

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
    document.addEventListener("DOMContentLoaded", function() {
      document.querySelectorAll(".closeAndRedirect").forEach(function(boton) {
        boton.addEventListener("click", function() {
          window.location.href = "./project_tables_direct.php";
        });
      });
    });
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {

      const selectPM = document.getElementById('PM_proy');

      const decisiones = document.querySelectorAll(
        'input[name="decision_proy"]'
      );

      function actualizarProjectManager() {

        const decisionSeleccionada = document.querySelector(
          'input[name="decision_proy"]:checked'
        );

        const aprobado = decisionSeleccionada !== null &&
          decisionSeleccionada.value === '1';

        selectPM.disabled = !aprobado;

        if (!aprobado) {
          selectPM.value = '';
        }
      }

      decisiones.forEach(function(radio) {
        radio.addEventListener('change', actualizarProjectManager);
      });
      actualizarProjectManager();

    });
  </script>


</body>

</html>