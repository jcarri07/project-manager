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
session_start();
$_SESSION["id_users"] = $_SESSION['id_miembro'];

$query = mysqli_query($conn, "SELECT * FROM members WHERE members.id_miembro='$_SESSION[id_miembro]'")
  or die('error: ' . mysqli_error($conn));
$data = mysqli_fetch_assoc($query);

$cedul_miemb = $data['cedula'];

$query2 = mysqli_query($conn, "SELECT * FROM users WHERE users.cedula='$cedul_miemb'")
  or die('error: ' . mysqli_error($conn));
$data_2 = mysqli_fetch_assoc($query2);

if (!isset($_SESSION['id_miembro'])) {
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

  <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">

  <link href="../assets/css/code_icon_navbar.css" rel="stylesheet">

  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />

  <link rel="stylesheet" href="../assets/Bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/material-modal.css">
  <link rel="stylesheet" href="../assets/css/dash-modal_miemb.css">
  <link rel="stylesheet" href="../assets/DataTable/datatables.min.css">
  <link rel="stylesheet" href="../assets/css/code_tables.css">
</head>

<body class="g-sidenav-show bg-gray-200">

  <?php
  include("./code_navbar.php");
  ?>

  <div class="main-content position-relative max-height-vh-100 h-100">
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Perfil</li>
          </ol>
        </nav>
    </nav>
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
    } elseif ($_GET['alert'] == 6) {
      echo "<div class='alert alert-danger alert-dismissible text-white' role='alert'>
  <span class='text-lg'>La imagen debe pesar <a href='profile.php' class='alert-link text-white'>menos de 1mb</a>!</span>
  <button type='button' class='btn-close text-lg py-3 opacity-10' data-bs-dismiss='alert' aria-label='Close'>
  <span aria-hidden='true'>&times;</span>
  </button>
</div>";
    } elseif ($_GET['alert'] == 7) {
      echo "<div class='alert alert-danger alert-dismissible text-white' role='alert'>
  <span class='text-lg'>Solo se admiten archivos: <a href='profile.php' class='alert-link text-white'>*.JPG, *.JPEG, *.PNG</a>!</span>
  <button type='button' class='btn-close text-lg py-3 opacity-10' data-bs-dismiss='alert' aria-label='Close'>
  <span aria-hidden='true'>&times;</span>
  </button>
</div>";
    }

    ?>

    <div class="container-fluid px-2 md-12">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/illustrations/photo-fond-profile.jpg');">
        <span class="mask  bg-gradient-primary  opacity-6"></span>
      </div>
      <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="row gx-5 mb-2">
          <div class="col-auto">


          </div>

          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                <?php echo $data['nombre']; ?>
              </h5>
              <p class="mb-0 font-weight-normal text-sm">
                <?php echo $data['especialidad']; ?>
              </p>
            </div>
          </div>
        </div>

        <div class="row">
          <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

            <div class="row">
              <div class="col-md-4 mt-4">
                <div class="card">
                  <div class="card-body pt-4 p-3">

                    <div class="card-header pb-0 px-3">
                      <h6 class="mb-0">Datos Managers</h6>
                    </div>
                    <ul class="list-group">
                      <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                        <form role="form" class="form-horizontal" method="POST" action="../pages/proses_users.php?act=insert_members_users" enctype="multipart/form-data">

                          <div class="input-group input-group-outline mb-3 is-filled">
                            <label class="form-label">Nombres:</label>
                            <input type="text" class="form-control" value="<?php echo $data['nombre']; ?>" name="nombres_users" id="nombres_users" required>
                          </div>
                          <div class="input-group input-group-outline mb-3 is-filled">
                            <label class="form-label">Apellidos:</label>
                            <input type="text" class="form-control" value="<?php echo $data['apellido']; ?>" name="apellidos_user" id="apellidos_user" required>
                          </div>
                          <div class="input-group input-group-outline mb-3 is-filled">
                            <label class="form-label">Cedula:</label>
                            <input type="text" class="form-control" value="<?php echo $data['cedula']; ?>" name="cedula_users" id="cedula_users" required>
                          </div>
                          <div class="input-group input-group-outline mb-3 is-filled">
                            <label class="form-label">Correo:</label>
                            <input type="email" class="form-control" value="<?php echo $data['email']; ?>" name="correo_user" id="correo_user" required>
                          </div>
                          <div class="input-group input-group-outline mb-3 is-filled">
                            <label class="form-label">Especialidad:</label>
                            <input type="text" class="form-control" value="<?php echo $data['especialidad']; ?>" name="especialidad_user" id="especialidad_user" required>
                          </div>
                          <div class="input-group input-group-outline mb-3 is-filled">
                            <label class="form-label">Contraseña:</label>
                            <input type="password" class="form-control" value="<?php echo $data_2['password_hash']; ?>" name="password_user" id="password_user" required>
                          </div>
                          <div class="input-group input-group-outline mb-3 is-filled">
                            <img src="<?php echo $data['foto_personal']; ?>" alt="ERROR">
                          </div>
                          <div class="input-group input-group-outline mb-3 is-filled">
                            <label class="form-label">Fotografia:</label>
                            <input type="file" class="form-control" name="foto_user" id="foto_user" required>
                          </div>

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




          </main>

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
    $(document).ready(function() {
      $('#example').DataTable({
        "language": {
          "url": "./js/DataEsp.json"
        },
        "ajax": {
          "url": "./Consul_blog_usu.php",
          "dataSrc": ""
        },
        "columns": [{
            "data": "ID_Memo"
          },
          {
            "data": "username"
          },
          {
            "data": "Asunto"
          },
          {
            "data": "Estado"
          },
          {
            "data": "Fecha_Ult_Actualizacion"
          }
        ]
      });
    });
  </script>

</body>

</html>