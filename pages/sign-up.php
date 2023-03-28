<!--
=========================================================
* Material Dashboard 2 - v3.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->

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
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
</head>

<body class="">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- Navbar 
        <nav class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0 mx-4">
          <div class="container-fluid ps-2 pe-0">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="../pages/dashboard.php">
              Material Dashboard 2
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
              <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                  <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="../pages/dashboard.php">
                    <i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>
                    Dashboard
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2" href="../pages/profile.html">
                    <i class="fa fa-user opacity-6 text-dark me-1"></i>
                    Perfil
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2" href="../pages/sign-up.php">
                    <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                    Registrarse
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2" href="../pages/sign-in.php">
                    <i class="fas fa-key opacity-6 text-dark me-1"></i>
                    Iniciar sesion
                  </a>
                </li>
              </ul>
              <ul class="navbar-nav d-lg-flex d-none">
                <li class="nav-item d-flex align-items-center">
                  <a class="btn btn-outline-primary btn-sm mb-0 me-2" target="_blank" href="https://www.creative-tim.com/builder/material?ref=navbar-dashboard">Online Builder</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/product/material-dashboard" class="btn btn-sm mb-0 me-1 bg-gradient-dark">Free download</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>-->
        <!-- End Navbar -->
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
                  <h4 class="font-weight-bolder">Registrarse</h4>
                  <p class="mb-0">Ingresa tus datos:</p>
                </div>
                <div class="card-body">
                <form role="form" class="form-horizontal" method="POST" action="../pages/proses_sign-up.php?act=insert" enctype="multipart/form-data">

                <div class="input-group input-group-outline mb-3">
                  <select class="form-select-lg " name="proyecto" placeholder="--Seleccione proyecto participante--" autocomplete="off" required>
                    <option value="">-- Proyecto Participante --</option>
                    <?php
                      $query_data = mysqli_query($conn, "SELECT id, estatus, nombre FROM projects")
                                                            or die('error '.mysqli_error($conn));

                      while ($data_1 = mysqli_fetch_assoc($query_data)) {
                        echo"<option value=\"$data_1[id]\"> $data_1[estatus] | $data_1[nombre] </option>";
                      }
                      echo $data_1['project_id'];
                    ?>
                 </select>
                </div>

                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Nombres</label>
                      <input type="text" class="form-control" name="nombres">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Apellidos</label>
                      <input type="text" class="form-control" name="apellidos">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Cedula</label>
                      <input type="text" class="form-control" name="cedula">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Cargo</label>
                      <input type="text" class="form-control" name="cargo">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Contraseña</label>
                      <input type="password" class="form-control"  name="password">
                    </div>
                    <!--<div class="form-check form-check-info text-start ps-0">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                      <label class="form-check-label" for="flexCheckDefault">
                        Acepto <a href="javascript:;" class="text-dark font-weight-bolder">los terminos y condiciones</a>
                      </label>
                    </div>-->
                    <div class="text-center">
                      <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0" name="Guardar" value="Guardar">Registrar</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-2 text-sm mx-auto">
                    Ya tienes una cuenta?
                    <a href="../pages/sign-in.php" class="text-primary text-gradient font-weight-bold">Inicia sesion</a>
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
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.0.4"></script>
</body>

</html>