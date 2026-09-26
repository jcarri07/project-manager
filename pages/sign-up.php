<?php
require_once('../databases/conexion.php');
?>

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

  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
</head>

<body class="">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-8 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-20 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-50 w-55 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('../assets/img/illustrations/ABAE.png'); background-size: cover;">
              </div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
              <div class="card card-plain">
                <div class="card-header">
                  <h4 class="font-weight-bolder" style="display: flex; justify-content: center;">Registrarse</h4>
                  <p class="mb-0" style="display: flex; justify-content: center;">Ingresa tus datos:</p>
                </div>
                <div class="card-body" style="padding-top: 5px;">
                  <form role="form" class="form-horizontal" method="POST" action="../pages/proses_sign-up.php?act=insert_init" enctype="multipart/form-data">

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
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-2 text-sm mx-auto">
                    Ya tienes una cuenta?
                    <a href="../index.php" class="text-primary text-gradient font-weight-bold">Inicia sesion</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.0.4"></script>
</body>

</html>