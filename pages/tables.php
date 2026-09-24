<?php
require_once('../databases/conexion.php');
session_start();


if (!isset($_SESSION['id'])) {
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

  <link rel="stylesheet" href="../assets/Bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/material-modal.css">
  <link rel="stylesheet" href="../assets/css/dash-modal.css">

  <!--
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
-->

  <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />

  <link rel="stylesheet" href="../assets/Bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/material-modal.css">
  <link rel="stylesheet" href="../assets/css/dash-modal.css">
  <link rel="stylesheet" href="../assets/DataTable/datatables.min.css">
  <link rel="stylesheet" href="../assets/css/code_tables.css">
</head>


<body class="g-sidenav-show  bg-gray-200">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
        <img src="../assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">Gestion de Proyectos</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white " href="../pages/dashboard.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="../pages/tables.html">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Proyectos</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="../pages/reportes.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">notifications</i>
            </div>
            <span class="nav-link-text ms-1">Reporte</span>
          </a>
        </li>

        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Cuenta:</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="../pages/profile.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">person</i>
            </div>
            <span class="nav-link-text ms-1">Perfil</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="../logout.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">login</i>
            </div>
            <span class="nav-link-text ms-1">Cerrar Sesión</span>
          </a>
        </li>
  </aside>
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

                <h6 class="text-white text-capitalize mb-0">Proyectos</h6>
                <div class="proyecto-switch mb-0">
                  <input type="checkbox" id="flexSwitchCheckChecked" checked>
                  <label for="flexSwitchCheckChecked">
                    <span class="switch-slider"></span> <span class="switch-text">Estado</span>
                  </label>
                </div>

              </div>

              <br>

            </div>

            <div class="col-lg-2 col-md-5 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3" style="padding-top: 30px;">
              <div class="nav-wrapper position-relative end-0">
                <ul class="nav nav-pills nav-fill p-1" role="tablist">

                  <li class="nav-item">
                    <a class="nav-link mb-0 px-0 py-1 " href="../pages/nuevo_proyecto.php?form=add" role="tab" aria-selected="false">
                      <i class="material-icons text-lg position-relative">person</i>
                      <span class="ms-1">Nuevo Proyecto</span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>

          </div>

          <div id="section1" class="section">

            <div class="card-body px-3 pb-3">
              <div class="table-responsive">

                <table id="tabla_proyectos" class="table align-items-center justify-content-center" style="width:100%">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Proyectos</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Beneficiarios</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estado</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Avance</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Imagen</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Editar</th>

                    </tr>
                  </thead>

                  <tbody>
                  </tbody>

                </table>

              </div>
            </div>

          </div>

          <div id="section2" class="section" style="display: none;">

            <div class="card-body px-3 pb-3">
              <div class="table-responsive">

                <table id="tabla_proyectos_elim" class="table align-items-center justify-content-center" style="width:100%">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Proyectos</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Beneficiarios</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estado</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Avance</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Imagen</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Editar</th>

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

              <div class="col-md-4" style="color:black">
                <label for="fecha">Archivo Fotografico (PNG/JPG): </label><br>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" id="check_Arc_fot_proy" checked>
                  <label class="form-check-label" for="check_Arc_fot_proy"></label>
                </div>
                <input type="file" class="form-control" id="Arc_fot_proy" name="Arc_fot_proy">
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

  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/jqery/jquery.js"></script>
  <script src="../assets/DataTable/datatables.min.js"></script>


  <script>
    const closeAndRedirectButton = document.getElementById("closeAndRedirect");
    if (closeAndRedirectButton) {
      closeAndRedirectButton.addEventListener("click", function() {
        window.location.href = "./tables.php";
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
          $('#edit_id_Proy').val(proyecto.id);
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
      $('#tabla_proyectos').DataTable({
        autoWidth: false,
        responsive: true,
        pageLength: 5,
        "language": {
          "url": "../assets/js/DataEsp.json"
        },
        "ajax": {
          "url": "./consultas/consul_proyectos.php",
          "dataSrc": ""
        },
        "columns": [{
            "data": "nombre"
          },
          {
            "data": "beneficiarios"
          },
          {
            "data": "estatus",
            "render": function(data, type, row) {
              let clase = "";
              if (data === "En progreso") {
                clase = "estado-progreso";
              } else if (data === "Por Ejecutar") {
                clase = "estado-ejecutar";
              } else if (data === "Listo") {
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
            "data": "imagen",
            "render": function(data, type, row) {
              let img = data ? data : '../assets/img/default.png';
              return ` <div class="d-flex justify-content-center"> <img src="${img}" alt="Proyecto" class="avatar avatar-lg border-radius-lg shadow-sm" style="width:55px; height:55px; object-fit:cover;"> </div> `;
            }
          },
          {
            "data": null,
            "render": function(data, type, row) {
              return `
            <button 
                type="button"
                onclick="abrirModalEditar(${row.id})"
                class="btn-editar"
                title="Editar Datos">

                <i class="fa-regular fa-pen-to-square"></i>

            </button>
        `;
            }
          }
        ]
      });
    });
  </script>

  <script>
    $(document).ready(function() {
      $('#tabla_proyectos_elim').DataTable({
        autoWidth: false,
        responsive: true,
        pageLength: 5,
        "language": {
          "url": "../assets/js/DataEsp.json"
        },
        "ajax": {
          "url": "./consultas/consul_proyectos_comp.php",
          "dataSrc": ""
        },
        "columns": [{
            "data": "nombre"
          },
          {
            "data": "beneficiarios"
          },
          {
            "data": "estatus",
            "render": function(data, type, row) {
              let clase = "";
              if (data === "En progreso") {
                clase = "estado-progreso";
              } else if (data === "Por Ejecutar") {
                clase = "estado-ejecutar";
              } else if (data === "Listo" || data === "Completado") {
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
            "data": "imagen",
            "render": function(data, type, row) {
              let img = data ? data : '../assets/img/default.png';
              return ` <div class="d-flex justify-content-center"> <img src="${img}" alt="Proyecto" class="avatar avatar-lg border-radius-lg shadow-sm" style="width:55px; height:55px; object-fit:cover;"> </div> `;
            }
          },
          {
            "data": null,
            "render": function(data, type, row) {
              return `
            <button
                type="button"
                class="btn-editar"
                title="Editar Datos"
                onclick="abrirModalEditar(${row.id})">

                <i class="fa-regular fa-pen-to-square"></i>

            </button>
        `;
            }
          }
        ]
      });
    });
  </script>


  <script>
    const switchElement = document.getElementById("flexSwitchCheckChecked");
    const section1 = document.getElementById("section1");
    const section2 = document.getElementById("section2");

    switchElement.addEventListener("change", function() {
      const isChecked = this.checked;

      if (isChecked) {
        section1.style.display = "block";
        section2.style.display = "none";
      } else {
        section1.style.display = "none";
        section2.style.display = "block";
      }
    });
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

</body>



</html>