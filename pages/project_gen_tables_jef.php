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
    const mapaPM = <?php echo json_encode($mapa_pm, JSON_UNESCAPED_UNICODE); ?>;
  </script>

  <?php include_once __DIR__ . '/complement_modal_jef_gen.php'; ?>

</body>

</html>