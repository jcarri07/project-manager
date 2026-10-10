<?php


require_once('../databases/conexion.php');
session_start();
$query = mysqli_query($conn, "SELECT * FROM project_miembro WHERE id_miembro='$_SESSION[id_miembro]'")
  or die('error: ' . mysqli_error($conn));


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
    Sistema de Gestion de Proyectos Super Admin
  </title>
  <link rel="stylesheet" href="../assets/Bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/dash-modal.css">

  <!--
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
-->

  <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">

  <link href="../assets/css/code_icon_navbar.css" rel="stylesheet">

  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />

  <link rel="stylesheet" href="../assets/Bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/DataTable/datatables.min.css">
  <link rel="stylesheet" href="../assets/css/code_tables_proyectos.css">
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
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
    <div class="alert alert-primary alert-dismissible text-white" role="alert">
      <span class="text-sm">Bienvenid@ <a href="javascript:;" class="alert-link text-white"><?php echo $_SESSION['cedula']; ?></a>, al sistema de Gestion de Proyectos</span>
      <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>


    <div class="row mt-4" style="padding-left:0px;">
      <div class="col-lg-6 col-md-6 mt-4 mb-4">
        <div class="card z-index-2 ">
          <div class="card-header card-body">
            <h6 class="mb-0 "> Grafica de los Proyectos </h6>
          </div>
          <div class="p-0 position-relative mx-3 mt-3 z-index-2 bg-transparent">
            <div class="bg-gradient border-radius-lg pe-1">
              <div class="chart-bars p-3 border rounded" style="height: 280px;">
                <canvas id="Grafico_proyectos"></canvas>
              </div>
            </div>
          </div>
          <br>
        </div>
      </div>
      <!-- --------------------------------------------------------------------------------------------------------------------------------- -->
      <div class="col-lg-6 col-md-6 mt-4 mb-3" style="padding-left:0px;">
        <div class="card z-index-2 ">
          <div class="card-header card-body">
            <h6 class="mb-0 ">2do Grafico</h6>
            <!-- <hr class="dark horizontal"> -->
          </div>
          <div class="p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
            <div class="bg-gradient border-radius-lg py-3 pe-1">
              <div class="chart">
                <canvas id="chart-line" class="chart-canvas" height="280"></canvas>
              </div>
            </div>
          </div>
          <br>
        </div>
      </div>
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="../assets/jqery/jquery.js"></script>

  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>

  <script>
    $(document).ready(function() {

      $.ajax({

        url: "./consultas/consul_graf.php",

        type: "GET",

        dataType: "json",

        success: function(data) {

          console.log("Respuesta de consul_graf.php:");
          console.log(data);

          const estados = [];
          const cantidades = [];

          data.forEach(function(item) {

            estados.push(item.estatus);
            cantidades.push(parseInt(item.Cantidad));

          });

          const canvas = document.getElementById("Grafico_proyectos");

          const colores = [
            'rgba(255, 209, 220, 1)',
            'rgba(198, 230, 255, 1)',
            'rgba(200, 245, 210, 1)',
            'rgba(178, 223, 219, 1)',
            'rgba(200, 182, 255, 1)',
            'rgba(255, 214, 170, 1)'
          ];

          new Chart(canvas, {

            type: "bar",

            data: {

              labels: estados,

              datasets: [{
                label: "Cantidad Total",

                data: cantidades,

                backgroundColor: colores,

                borderColor: colores,

                borderWidth: 1,

                borderRadius: 10,

                borderSkipped: false
              }]
            },

            options: {

              responsive: true,

              maintainAspectRatio: false,

              scales: {
                y: {
                  ticks: {
                    precision: 0
                  }
                }
              },

              plugins: {

                legend: {

                  labels: {
                    font: {
                      size: 20
                    }
                  }

                }

              }

            }

          });

        }

      });

    });
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

</body>

</html>