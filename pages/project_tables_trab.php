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
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />

  <link rel="stylesheet" href="../assets/Bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
  <link href="../assets/css/code_icon_navbar.css" rel="stylesheet">


  <link rel="stylesheet" href="../assets/Bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/material-modal.css">
  <link rel="stylesheet" href="../assets/css/dash-modal_miemb.css">
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

                <a href="../pages/nuevo_proyecto_trab.php?form=add" class="nav-link mb-0 px-3 py-2">
                  <i class="material-icons text-lg position-relative">person</i>
                  <span class="ms-1">Nuevo Proyecto</span>
                </a>

                <ul class="nav nav-pills flex-row p-1" id="proyectosTabs" role="tablist">

                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="vista_gen-tab" data-bs-toggle="tab" data-bs-target="#vista_gen-pane" type="button" role="tab" aria-controls="vista_gen-pane" aria-selected="true">Propuestas Propias</button>
                  </li>

                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="new_pro-tab" data-bs-toggle="tab" data-bs-target="#new_pro-pane" type="button" role="tab" aria-controls="new_pro-pane" aria-selected="false">Nuevas Propuestas</button>
                  </li>

                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="espera_pro-tab" data-bs-toggle="tab" data-bs-target="#espera_pro-pane" type="button" role="tab" aria-controls="espera_pro-pane" aria-selected="false">Propuestas en Espera</button>
                  </li>

                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="proy_vig-tab" data-bs-toggle="tab" data-bs-target="#proy_vig-pane" type="button" role="tab" aria-controls="proy_vig-pane" aria-selected="false">Proyectos Vigentes</button>
                  </li>

                </ul>

              </div>

            </div>

          </div>


          <div class="card-body px-3 pb-3">

            <div class="tab-content" id="proyectosTabsContent">

              <div class="tab-pane fade show active" id="vista_gen-pane" role="tabpanel" aria-labelledby="vista_gen-tab" tabindex="0">

                <div class="table-responsive">

                  <table id="tabla_proyectos_pers" class="table align-items-center justify-content-center" style="width:100%">
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

              <div class="tab-pane fade show" id="new_pro-pane" role="tabpanel" aria-labelledby="new_pro-tab" tabindex="0">

                <div class="table-responsive">

                  <table id="tabla_proyectos_new_pro" class="table align-items-center justify-content-center" style="width:100%">
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

              <div class="tab-pane fade show" id="espera_pro-pane" role="tabpanel" aria-labelledby="espera_pro-tab" tabindex="0">

                <div class="table-responsive">

                  <table id="tabla_proyectos_pers_espera" class="table align-items-center justify-content-center" style="width:100%">
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

            </div>

          </div>

        </div>
      </div>
    </div>

  </main>

  <!-- --------------------------------------------------------------------------------------------------------------- -->

  <div class="modal w3-container" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content w3-animate-opacity">
        <div class="w3-container w3-teal">
          <br>
          <p class="modal-title" style="color: black;">Datos Registrados</p>
          <br>
          <div class="w3-center">
            <span onclick="document.getElementById('id01').style.display='none'" id="closeAndRedirect" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
          </div>
        </div>

        <div class="w3-container modal-body" id="modalBody">

          <form class="row g-3" action="./ejec_edit_proy.php" id="form-upload" enctype="multipart/form-data" method="POST">

            <input type="hidden" style="display:none" class="form-control" id="edit_id_Proy" name="edit_id_Proy" readonly>

            <div class="row g-3">
              <div class="col-md-4" style="color:black">
                <label for="Comando" class="form-label">Nombre del Proyecto: </label>
                <input type="text" class="form-control" id="edit_nombre_proy" name="edit_nombre_proy">
              </div>

              <div class="col-md-2" style="color:black">
                <label for="Comando" class="form-label">Avance: </label>

                <div class="input-group col-md-">
                  <input max="100" min="0" type="number" class="form-control" id="edit_avance" name="edit_avance">
                  <span class="input-group-text">%</span>
                </div>
              </div>
            </div>

            <br>

            <div class="row g-3">
              <div class="col-md-4" style="color:black">
                <label for="Grafica" class="form-label">Fecha: </label>
                <input type="text" class="form-control" id="edit_fecha_fin" name="edit_fecha_fin" required>
                <script>
                  $(function() {
                    $('input[name="edit_fecha_fin"]').daterangepicker({
                      singleDatePicker: true,
                      showDropdowns: true,
                      opens: 'left',
                      locale: {
                        format: 'YYYY-MM-DD'
                      }
                    });
                  });
                </script>
              </div>

              <div class="col-md-4" style="color:black">
                <label for="Comando" class="form-label">Categoria: </label>
                <input type="text" class="form-control" id="edit_categoria_proy" name="edit_categoria_proy">
              </div>

              <div class="col-md-4" style="color:black">
                <label for="Beneficiarios" class="form-label">Nombre del Beneficiarios: </label>
                <input type="text" class="form-control" id="edit_ben_proy" name="edit_ben_proy">
              </div>

            </div>

            <br>

            <div class="row g-3">

              <div class="col-md-4" style="color:black">
                <label for="Grafica" class="form-label">Descripción del Proyecto: </label>
                <textarea name="edit_descrip_proy" id="edit_descrip_proy" cols="40" rows="4" class="form-control" required></textarea>
                <div id="contador_descrip_proy">150</div>
              </div>

              <div class="col-md-4" style="color:black">
                <label for="Grafica" class="form-label">Objetivos del Proyecto: </label>
                <textarea name="edit_objec_proy" id="edit_objec_proy" cols="40" rows="4" class="form-control" required></textarea>
                <div id="contador_objec_proy">150</div>
              </div>

              <div class="col-md-4" style="color:black">
                <label for="Grafica" class="form-label">Requerimientos del Proyecto: </label>
                <textarea name="edit_objec_requer" id="edit_objec_requer" cols="40" rows="4" class="form-control" required></textarea>
                <div id="contador_requer">150</div>
              </div>

              <script>
                function limitarTextarea(idTextarea, idContador, maximoCaracteres = 200) {
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

                limitarTextarea("edit_descrip_proy", "contador_descrip_proy", 200);
                limitarTextarea("edit_objec_proy", "contador_objec_proy", 200);
                limitarTextarea("edit_objec_requer", "contador_requer", 200);
              </script>

            </div>

            <br>

            <div class="row g-3">

              <div class="col-md-4" style="color:black">
                <label for="Cond" class="form-label">Condición: </label>
                <select class="form-select" id="edit_est" name="edit_est" required>
                  <option value="Por Ejecutar">Por Ejecutar</option>
                  <option value="En progreso">En progreso</option>
                  <option value="Completado">Completado</option>
                </select>
              </div>

            </div>

            <br>
            <br>

            <br>

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

  <!-- ------------------------------------------------------------------------------------------------------------------ -->

  </div>
  <!--   Core JS Files  -->
  <script src="../assets/js/material-dashboard.min.js?v=3.0.4"></script>
  <script src="../assets/js/core/popper.min.js"></script>
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
      $('#tabla_proyectos_pers').DataTable({
        //autoWidth: false,
        //responsive: true, consul_proyectos_pers_espera
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
          }
        ]
      });
    });
  </script>

  <script>
    $(document).ready(function() {
      $('#tabla_proyectos_new_pro').DataTable({
        //autoWidth: false,
        //responsive: true,    consul_proyectos_aprob_direct
        //pageLength: 5,
        "language": {
          "url": "../assets/js/DataEsp.json"
        },
        "ajax": {
          "url": "./consultas/consul_proyectos_pers_new_pro.php",
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
            data: null,
            render: function(data, type, row) {
              return `
            <div class="btn-group" role="group">
                <button type="button" onclick="confirmarValidacion(${row.id_proyecto})" class="btn-editar" title="Validar proyecto">
                    <i class="fa-solid fa-bell"style="color: rgb(0, 92, 255);"></i>
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
      $('#tabla_proyectos_pers_espera').DataTable({
        //autoWidth: false,
        //responsive: true, 
        //pageLength: 5,
        "language": {
          "url": "../assets/js/DataEsp.json"
        },
        "ajax": {
          "url": "./consultas/consul_proyectos_pers_espera.php",
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
    function abrirModalEditar(id) {

      console.log("ID seleccionado:", id);

      document.getElementById('edit_id_Proy').value = id;

      const modalElement = document.getElementById('myModal');
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
          $('#edit_id_Proy').val(proyecto.id_proyecto);
          $('#edit_nombre_proy').val(proyecto.nombre);
          $('#edit_avance').val(proyecto.avance);
          $('#edit_fecha_fin').val(proyecto.fecha_fin);
          $('#edit_categoria_proy').val(proyecto.categoria);
          $('#edit_ben_proy').val(proyecto.beneficiarios);
          $('#edit_descrip_proy').val(proyecto.descripcion);
          $('#edit_objec_proy').val(proyecto.objetivos);
          $('#edit_objec_requer').val(proyecto.requerimientos);
          $('#edit_est').val(proyecto.estatus);

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
    const closeAndRedirectButton = document.getElementById("closeAndRedirect");
    if (closeAndRedirectButton) {
      closeAndRedirectButton.addEventListener("click", function() {
        window.location.href = "./project_tables_direct.php";
      });
    }
  </script>


</body>

</html>