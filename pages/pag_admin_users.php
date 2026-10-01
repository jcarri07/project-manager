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

  <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">

  <link href="../assets/css/code_icon_navbar.css" rel="stylesheet">

  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />

  <link rel="stylesheet" href="../assets/Bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/material-modal.css">
  <link rel="stylesheet" href="../assets/css/dash-modal_miemb.css">
  <link rel="stylesheet" href="../assets/DataTable/datatables.min.css">
  <link rel="stylesheet" href="../assets/css/code_tables.css">
</head>

<body class="g-sidenav-show  bg-gray-200">
  <?php
  include("./code_navbar.php");
  ?>




  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

    <br>

    <div class="col-md-2 mt-2 card card-body pt-4 p-2">
      <div class="proyecto-switch mb-0">
        <input type="checkbox" id="flexSwitchCheckChecked" checked>
        <label for="flexSwitchCheckChecked">
          <span class="switch-slider"></span> <span class="switch-text">Tipo de Usuario</span>
        </label>
      </div>
    </div>
    <!-- ------------------------------------------------------------------------------------------------------------------ -->

    <div id="section1" class="section">
      <div class="row">
        <div class="col-md-4 mt-4">
          <div class="card">
            <div class="card-body pt-4 p-3">


              <?php

              if (empty($_GET['alert'])) {
                echo "";
              } elseif ($_GET['alert'] == 1) {
                echo "<div class='alert alert-success alert-dismissible text-white' role='alert'>
                  <span class='text-lg'>Datos agregados <a href='profile.php' class='alert-link text-white'>exitosamente</a>!</span>
                  <button type='button' class='btn-close text-lg py-3 opacity-10' data-bs-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                  </button>
                </div>";
              } elseif ($_GET['alert'] == 2) {
                echo "<div class='alert alert-success alert-dismissible text-white' role='alert'>
                  <span class='text-lg'>Datos modificados <a href='profile.php' class='alert-link text-white'>exitosamente</a>!</span>
                  <button type='button' class='btn-close text-lg py-3 opacity-10' data-bs-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                  </button>
                </div>";
              } elseif ($_GET['alert'] == 3) {
                echo "<div class='alert alert-danger alert-dismissible text-white' role='alert'>
                  <span class='text-lg'>No se completó, <a href='profile.php' class='alert-link text-white'>falla en la operación</a>!</span>
                  <button type='button' class='btn-close text-lg py-3 opacity-10' data-bs-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                  </button>
                </div>";
              } elseif ($_GET['alert'] == 4) {
                echo "<div class='alert alert-info alert-dismissible text-white' role='alert'>
                  <span class='text-lg'>Datos eliminados <a href='profile.php' class='alert-link text-white'>exitosamente</a>!</span>
                  <button type='button' class='btn-close text-lg py-3 opacity-10' data-bs-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                  </button>
                </div>";
              } elseif ($_GET['alert'] == 5) {
                echo "<div class='alert alert-danger alert-dismissible text-white' role='alert'>
                  <span class='text-lg'>Archivo cargado<a href='profile.php' class='alert-link text-white'>incorrecto</a>!</span>
                  <button type='button' class='btn-close text-lg py-3 opacity-10' data-bs-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                  </button>
                </div>";
              }

              ?>

              <div class="card-header pb-0 px-3">
                <h6 class="mb-0">Registro de Miembros</h6>
              </div>
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                  <form role="form" class="form-horizontal" method="POST" action="../pages/proses_users.php?act=insert_miembros" enctype="multipart/form-data">

                    <div class="input-group input-group-outline my-3">
                      <label class="form-label">Nombres</label>
                      <input type="text" name="nombres_reg_min" id="nombres_reg_min" class="form-control">
                    </div>

                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Apellidos</label>
                      <input type="text" name="apellidos_reg_min" id="apellidos_reg_min" class="form-control">
                    </div>

                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Cedula</label>
                      <input type="text" name="cedula_reg_min" id="cedula_reg_min" class="form-control">
                    </div>

                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Email</label>
                      <input type="text" name="email_reg_min" class="form-control">
                    </div>

                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Especialidad</label>
                      <input type="text" name="especialidad_reg_min" id="especialidad_reg_min" class="form-control">
                    </div>

                    <div class="input-group input-group-outline mb-3 is-filled">
                      <label class="form-label">Fotografia:</label>
                      <input type="file" class="form-control" name="foto_reg_min" id="foto_reg_min" required>
                    </div>

                    <div class="input-group input-group-outline mb-3 is-filled">
                      <label class="form-label">Fecha de Registro:</label><br>
                      <input type="datetime-local" class="form-control" id="fecha_reg_min" name="fecha_reg_min" readonly>
                    </div>
                    <script>
                      var fechaActual = new Date();
                      var formattedDateTime = fechaActual.getFullYear() + '-' + ('0' + (fechaActual.getMonth() + 1)).slice(-2) + '-' + ('0' + fechaActual.getDate()).slice(-2) + 'T' + ('0' + fechaActual.getHours()).slice(-2) + ':' + ('0' + fechaActual.getMinutes()).slice(-2);
                      document.getElementById('fecha_reg_min').value = formattedDateTime;
                    </script>
                    </br>

                    <div class="box-footer">
                      <div class="form-group text-center">
                        <div class="text-center">
                          <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0" name="Guardar" value="Guardar">Registrar</button>
                        </div>
                      </div>
                  </form>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <!-- ------------------------------------------------------------------------------------------------------------------ -->
        <div class="col-md-8 mt-4">
          <div class="card h-100 mb-4">
            <div class="card-body pt-4 p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">

                  <div class="table-responsive">
                    <table id="tabla_miembros" class="table align-items-center justify-content-center" style="width:100%">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">CEDULA</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NOMBRE</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">APELLIDO</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">CORREO</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ESPECIALIDAD</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">FOTO</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">EDITAR</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>

                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="section2" class="section" style="display: none;">

      <div class="row">
        <div class="col-md-4 mt-4">
          <div class="card">
            <div class="card-body pt-4 p-3">


              <?php

              if (empty($_GET['alert'])) {
                echo "";
              } elseif ($_GET['alert'] == 1) {
                echo "<div class='alert alert-success alert-dismissible text-white' role='alert'>
                  <span class='text-lg'>Datos agregados <a href='profile.php' class='alert-link text-white'>exitosamente</a>!</span>
                  <button type='button' class='btn-close text-lg py-3 opacity-10' data-bs-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                  </button>
                </div>";
              } elseif ($_GET['alert'] == 2) {
                echo "<div class='alert alert-success alert-dismissible text-white' role='alert'>
                  <span class='text-lg'>Datos modificados <a href='profile.php' class='alert-link text-white'>exitosamente</a>!</span>
                  <button type='button' class='btn-close text-lg py-3 opacity-10' data-bs-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                  </button>
                </div>";
              } elseif ($_GET['alert'] == 3) {
                echo "<div class='alert alert-danger alert-dismissible text-white' role='alert'>
                  <span class='text-lg'>No se completó, <a href='profile.php' class='alert-link text-white'>falla en la operación</a>!</span>
                  <button type='button' class='btn-close text-lg py-3 opacity-10' data-bs-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                  </button>
                </div>";
              } elseif ($_GET['alert'] == 4) {
                echo "<div class='alert alert-info alert-dismissible text-white' role='alert'>
                  <span class='text-lg'>Datos eliminados <a href='profile.php' class='alert-link text-white'>exitosamente</a>!</span>
                  <button type='button' class='btn-close text-lg py-3 opacity-10' data-bs-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                  </button>
                </div>";
              } elseif ($_GET['alert'] == 5) {
                echo "<div class='alert alert-danger alert-dismissible text-white' role='alert'>
                  <span class='text-lg'>Archivo cargado<a href='profile.php' class='alert-link text-white'>incorrecto</a>!</span>
                  <button type='button' class='btn-close text-lg py-3 opacity-10' data-bs-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                  </button>
                </div>";
              }

              ?>

              <div class="card-header pb-0 px-3">
                <h6 class="mb-0">Registro de Manager</h6>
              </div>
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                  <form role="form" class="form-horizontal" method="POST" action="../pages/proses_users.php?act=insert_members_users" enctype="multipart/form-data">

                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Nombres:</label>
                      <input type="text" class="form-control" name="nombres_reg" id="nombres_reg" required>
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Apellidos:</label>
                      <input type="text" class="form-control" name="apellidos_reg" id="apellidos_reg" required>
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Cedula:</label>
                      <input type="text" class="form-control" name="cedula_reg" id="cedula_reg" required>
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Correo:</label>
                      <input type="email" class="form-control" name="correo_reg" id="correo_reg" required>
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Especialidad:</label>
                      <input type="text" class="form-control" name="especialidad_reg" id="especialidad_reg" required>
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Contraseña:</label>
                      <input type="password" class="form-control" name="password_reg" id="password_reg" required>
                    </div>
                    <div class="input-group input-group-outline mb-3 is-filled">
                      <label class="form-label">Fotografia:</label>
                      <input type="file" class="form-control" name="foto_reg" id="foto_reg" required>
                    </div>
                    <div class="input-group input-group-outline mb-3 is-filled">
                      <label class="form-label">Fecha de Registro:</label><br>
                      <input type="datetime-local" class="form-control" id="fecha_reg" name="fecha_reg" readonly>
                    </div>
                    <script>
                      var fechaActual = new Date();
                      var formattedDateTime = fechaActual.getFullYear() + '-' + ('0' + (fechaActual.getMonth() + 1)).slice(-2) + '-' + ('0' + fechaActual.getDate()).slice(-2) + 'T' + ('0' + fechaActual.getHours()).slice(-2) + ':' + ('0' + fechaActual.getMinutes()).slice(-2);
                      document.getElementById('fecha_reg').value = formattedDateTime;
                    </script>

                    <div class="text-center">
                      <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0" name="Guardar" value="Guardar">Registrar</button>
                    </div>
                  </form>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <!-- ------------------------------------------------------------------------------------------------------------------ -->
        <div class="col-md-6 mt-4">
          <div class="card h-100 mb-4">
            <div class="card-body pt-4 p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">

                  <div class="table-responsive">
                    <table id="tabla_managers" class="table align-items-center justify-content-center" style="width:100%">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">CEDULA</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">CORREO</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">FECHA</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">FOTO</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>

                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

    </div>


  </main>

  <!-- --------------------------------------------------------------------------------------------------------------- -->

  <div class="modal w3-container" id="myModal_1" data-bs-backdrop="static" data-bs-keyboard="false">
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

          <form class="row g-3" action="../pages/proses_users.php?act=update_miembros" id="form-upload" enctype="multipart/form-data" method="POST">

            <input type="hidden" style="display:none" class="form-control" id="edit_id_miem" name="edit_id_miem" readonly>

            <div class="row g-3">

              <div class="col-md-4" style="color:black">
                <label for="Comando" class="form-label">Cedula: </label>
                <input type="text" class="form-control" id="edit_ced_miem" name="edit_ced_miem" readonly>
              </div>

              <div class="col-md-4" style="color:black">
                <label for="Comando" class="form-label">Nombre: </label>
                <input type="text" class="form-control" id="edit_nombre_miem" name="edit_nombre_miem">
              </div>

              <div class="col-md-4" style="color:black">
                <label for="Comando" class="form-label">Apellido: </label>
                <input type="text" class="form-control" id="edit_apell_miem" name="edit_apell_miem">
              </div>

            </div>

            <br>

            <div class="row g-3">

              <div class="col-md-4" style="color:black">
                <label for="Comando" class="form-label">Correo: </label>
                <input type="text" class="form-control" id="edit_corr_miem" name="edit_corr_miem">
              </div>

              <div class="col-md-4" style="color:black">
                <label for="Comando" class="form-label">Especialidad: </label>
                <input type="text" class="form-control" id="edit_esp_miem" name="edit_esp_miem">
              </div>

              <div class="col-md-4" style="color:black">
                <label for="fecha">Archivo Fotografico (PNG/JPG): </label><br>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" id="check_Arc_fot_miem" checked>
                  <label class="form-check-label" for="check_Arc_fot_miem"></label>
                </div>
                <input type="file" class="form-control" id="Arc_fot_miem" name="Arc_fot_miem">
              </div>

            </div>
            <br><br><br><br>

            <div class="d-grid gap-2 col-6 mx-auto">

              <button type="submit" class="btn btn-primary" id="Redirect" name="Guardar" value="Guardar" data-bs-dismiss="modal">Editar</button>

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
  <!--   Core JS Files   -->
  <script src="../assets/js/material-dashboard.min.js?v=3.0.4"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/jqery/jquery.js"></script>
  <script src="../assets/DataTable/datatables.min.js"></script>

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
      $('#tabla_miembros').DataTable({
        autoWidth: false,
        responsive: true,
        pageLength: 5,
        "language": {
          "url": "../assets/js/DataEsp.json"
        },
        "ajax": {
          "url": "./consultas/consul_miembros.php",
          "dataSrc": ""
        },
        "columns": [{
            "data": "cedula"
          },
          {
            "data": "nombre"
          },
          {
            "data": "apellido"
          },
          {
            "data": "email"
          },
          {
            "data": "especialidad"
          },
          {
            "data": "foto_personal",
            "render": function(data, type, row) {
              let img = data ? data : '../assets/img/default.png';
              return ` <div class="d-flex justify-content-center"> <img src="${img}" alt="foto" class="avatar avatar-lg border-radius-lg shadow-sm" style="width:55px; height:55px; object-fit:cover;"> </div> `;
            }
          },
          {
            "data": null,
            "render": function(data, type, row) {
              return `
            <button 
                type="button"
                onclick="abrirModalEditar(${row.id_miembro})"
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
      $('#tabla_managers').DataTable({
        autoWidth: false,
        responsive: true,
        pageLength: 5,
        "language": {
          "url": "../assets/js/DataEsp.json"
        },
        "ajax": {
          "url": "./consultas/consul_managers.php",
          "dataSrc": ""
        },
        "columns": [{
            "data": "cedula"
          },
          {
            "data": "email"
          },
          {
            "data": "fecha_creacion"
          },
          {
            "data": "foto_personal",
            "render": function(data, type, row) {
              let img = data ? data : '../assets/img/default.png';
              return ` <div class="d-flex justify-content-center"> <img src="${img}" alt="foto" class="avatar avatar-lg border-radius-lg shadow-sm" style="width:55px; height:55px; object-fit:cover;"> </div> `;
            }
          },
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
    function abrirModalEditar(id) {

      console.log("ID seleccionado:", id);

      document.getElementById('edit_id_miem').value = id;

      const modalElement = document.getElementById('myModal_1');
      const modal = new bootstrap.Modal(modalElement);

      modal.show();

      $.ajax({
        url: './consultas/consul_obt_dat_miemb.php',
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

          const data_personal = respuesta.data;
          $('#edit_id_miem').val(data_personal.id_miembro);
          $('#edit_ced_miem').val(data_personal.cedula);
          $('#edit_nombre_miem').val(data_personal.nombre);
          $('#edit_apell_miem').val(data_personal.apellido);
          $('#edit_corr_miem').val(data_personal.email);
          $('#edit_esp_miem').val(data_personal.especialidad);

        },

        error: function(xhr) {

          console.error("Error AJAX:");
          console.error(xhr.responseText);

          alert('Error al obtener los datos del miembros.');

        }
      });
    }
  </script>

  <script>
    const closeAndRedirectButton = document.getElementById("closeAndRedirect");
    if (closeAndRedirectButton) {
      closeAndRedirectButton.addEventListener("click", function() {
        window.location.href = "./pag_admin_users.php";
      });
    }
  </script>


</body>

</html>