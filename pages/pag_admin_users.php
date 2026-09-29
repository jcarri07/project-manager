<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Material Dashboard 2 by Creative Tim
  </title>
  <link rel="stylesheet" href="../assets/Bootstrap/css/bootstrap.min.css">
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
  <link href="../assets/css/code_icon_navbar.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/DataTable/datatables.min.css">
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/css/code_tables.css">
</head>

<body class="g-sidenav-show  bg-gray-200">
  <?php
  include("./code_navbar.php");
  ?>




  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">



    <!-- ------------------------------------------------------------------------------------------------------------------ -->
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
                      <div class="col-sm-offset-4 col-sm-4">
                        <input type="submit" class="btn bg-gradient-primary" name="Guardar" value="Guardar">
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
  </main>

  <!-- ------------------------------------------------------------------------------------------------------------------ -->

  </div>
  <!--   Core JS Files   -->
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
  <script src="../assets/js/material-dashboard.min.js?v=3.0.4"></script>

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
              return ` <div class="d-flex justify-content-center"> <img src="${img}" alt="Proyecto" class="avatar avatar-lg border-radius-lg shadow-sm" style="width:55px; height:55px; object-fit:cover;"> </div> `;
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

</body>

</html>