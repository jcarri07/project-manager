<?php
require_once('../databases/conexion.php');
session_start();

if (!isset($_SESSION['id_usuario'])) {
  header('Location: ../index.php');
  exit;
}

function dashboardContarProyectos($conn, $filtroSalud = '')
{
  $sql = "SELECT COUNT(*) AS total FROM projects WHERE activo = '1' AND estatus != 'Borrador'";

  if ($filtroSalud !== '') {

    $sql .= " AND (" . $filtroSalud . ")";
  }

  $resultado = mysqli_query($conn, $sql);
  if (!$resultado) {
    error_log('Error al contar proyectos del dashboard: ' . mysqli_error($conn));
    return 0;
  }

  $fila = mysqli_fetch_assoc($resultado);
  return (int) $fila['total'];
}

$totalProyectos = dashboardContarProyectos($conn);
$proyectosControl = dashboardContarProyectos($conn, "LOWER(salud) = 'en control'");
$proyectosRiesgo = dashboardContarProyectos($conn, "LOWER(salud) = 'en riesgo'");
$proyectosCriticos = dashboardContarProyectos($conn, "LOWER(salud) IN ('critico', 'crítico')");

$sqlVencimientos = "SELECT * FROM projects WHERE projects.activo = '1' AND projects.estatus != 'Borrador' AND projects.fecha_fin >= CURDATE() ORDER BY projects.fecha_fin ASC LIMIT 5";
$vencimientos = mysqli_query($conn, $sqlVencimientos);

$sqlAtencion = "SELECT * FROM projects,users WHERE projects.id_manager = users.id_usuario AND projects.activo = '1' AND projects.estatus != 'Borrador' AND LOWER(projects.salud) IN ('en riesgo', 'critico', 'crítico')
                ORDER BY CASE
                    WHEN LOWER(salud) IN ('critico', 'crítico') THEN 0
                    WHEN LOWER(salud) = 'en riesgo' THEN 1
                    ELSE 2
                END,
                projects.fecha_fin ASC
                LIMIT 5";
$proyectosAtencion = mysqli_query($conn, $sqlAtencion);
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>Sistema de Gestión de Proyectos</title>

  <link rel="stylesheet" href="../assets/Bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
  <link href="../assets/css/code_icon_navbar.css" rel="stylesheet">
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet">
  <!-- Theme Override: Corporate Blue #194070 -->
  <link href="../assets/css/theme-override.css" rel="stylesheet">
  <!-- <link rel="stylesheet" href="../assets/css/dashboard-resumen.css?v=1.0"> -->
  <link rel="stylesheet" href="../assets/css/new_dashboard-resumen.css">
</head>

<body class="g-sidenav-show bg-gray-200">

  <?php include('./code_navbar.php'); ?>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm">
              <a class="opacity-5 text-dark" href="javascript:;">Pages</a>
            </li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
          </ol>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center"></div>
          <ul class="navbar-nav justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="../logout.php" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Cerrar Sesión</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid py-3 dashboard-resumen">
      <section class="dashboard-panel dashboard-heading">
        <h4>DASHBOARD DIRECTOR</h4>
        <span>Resumen general de proyectos</span>
      </section>

      <section class="dashboard-kpis" aria-label="Resumen de proyectos">
        <article class="dashboard-kpi">
          <span class="kpi-label">Total</span>
          <strong class="kpi-value"><?php echo $totalProyectos; ?></strong>
          <span class="kpi-caption">Proyectos activos</span>
        </article>
        <article class="dashboard-kpi">
          <span class="kpi-label">En control</span>
          <div class="kpi-value-row">
            <strong class="kpi-value"><?php echo $proyectosControl; ?></strong>
            <span class="estado-punto punto-control" aria-label="En control"></span>
          </div>
          <span class="kpi-caption">Situación estable</span>
        </article>
        <article class="dashboard-kpi">
          <span class="kpi-label">En riesgo</span>
          <div class="kpi-value-row">
            <strong class="kpi-value"><?php echo $proyectosRiesgo; ?></strong>
            <span class="estado-punto punto-riesgo" aria-label="En riesgo"></span>
          </div>
          <span class="kpi-caption">Requieren seguimiento</span>
        </article>
        <article class="dashboard-kpi">
          <span class="kpi-label">Críticos</span>
          <div class="kpi-value-row">
            <strong class="kpi-value"><?php echo $proyectosCriticos; ?></strong>
            <span class="estado-punto punto-critico" aria-label="Crítico"></span>
          </div>
          <span class="kpi-caption">Atención prioritaria</span>
        </article>
      </section>

      <section class="dashboard-panel">
        <div class="dashboard-panel-heading">
          <h5>ESTADO DE LOS PROYECTOS</h5>
        </div>
        <div class="dashboard-panel-body">
          <div class="estado-lista" aria-live="polite">
            <div class="bg-gradient border-radius-lg py-3 pe-1">
              <div class="chart" style="height: 320px; position: relative;">
                <canvas
                  id="Grafico_proyectos"
                  class="chart-canvas">
                </canvas>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="dashboard-panel">
        <div class="dashboard-panel-heading">
          <h5>PRÓXIMOS VENCIMIENTOS</h5>
        </div>
        <div class="table-responsive">
          <table class="dashboard-table">
            <thead>
              <tr>
                <th>Proyecto</th>
                <th>Fecha</th>
                <th>Tipo</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($vencimientos && mysqli_num_rows($vencimientos) > 0): ?>
                <?php while ($fila = mysqli_fetch_assoc($vencimientos)) { ?>
                  <tr>
                    <td><?php echo ($fila['nombre']); ?></td>
                    <td><?php echo !empty($fila['fecha_fin']) ? date('d/m/Y', strtotime($fila['fecha_fin'])) : '—'; ?></td>
                    <td><span class="tipo-fecha"><?php echo ($fila['tipo']); ?></span></td>
                  </tr>
                <?php } ?>
              <?php else: ?>
                <tr>
                  <td colspan="3" class="dashboard-vacio">No hay vencimientos próximos registrados.</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </section>

      <section class="dashboard-panel">
        <div class="dashboard-panel-heading dashboard-heading-attention">
          <h5><i class="fa-solid fa-triangle-exclamation" aria-hidden="true"></i> PROYECTOS QUE REQUIEREN ATENCIÓN</h5>
        </div>
        <div class="table-responsive">
          <table class="dashboard-table">
            <thead>
              <tr>
                <th>Proyecto</th>
                <th>Situación</th>
                <th>Project Manager</th>
                <th>Salud</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($proyectosAtencion && mysqli_num_rows($proyectosAtencion) > 0) { ?>
                <?php while ($fila = mysqli_fetch_assoc($proyectosAtencion)): ?>
                  <?php
                  $saludNormalizada = strtolower($fila['salud']);
                  $esCritico = in_array($saludNormalizada, array('critico', 'crítico'), true);
                  $situacion = $esCritico ? 'Revisión prioritaria' : 'Seguimiento requerido';
                  ?>
                  <tr>
                    <td><?php echo ($fila['nombre']); ?></td>
                    <td><?php echo ($situacion); ?></td>
                    <td><?php echo ($fila['nombre_user'] . " " . $fila['apellido_user']); ?></td>
                    <td>
                      <span class="estado-punto <?php echo $esCritico ? 'punto-critico' : 'punto-riesgo'; ?>" title="<?php echo ($fila['salud']); ?>" aria-label="<?php echo ($fila['salud']); ?>"></span>
                      <span class="salud-texto"><?php echo ($fila['salud']); ?></span>
                    </td>
                  </tr>
                <?php endwhile; ?>
              <?php } else { ?>
                <tr>
                  <td colspan="4" class="dashboard-vacio">No hay proyectos marcados En riesgo o Crítico.</td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </section>
    </div>
  </main>

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
            'rgba(200, 182, 219, 1)',
            'rgba(255, 214, 170, 1)'
          ];

          const grafica = new Chart(canvas.getContext('2d'), {
            type: 'bar',

            data: {
              labels: estados,
              datasets: [{
                label: 'Cantidad Total',
                data: cantidades,
                backgroundColor: colores,
                borderColor: colores,
                borderWidth: 1,
                borderRadius: 10,
                borderSkipped: false
              }]
            },

            options: {
              indexAxis: 'y',

              responsive: true,
              maintainAspectRatio: false,

              elements: {
                bar: {
                  borderWidth: 2
                }
              },

              scales: {
                x: {
                  beginAtZero: true,
                  ticks: {
                    precision: 0
                  }
                },
                y: {
                  ticks: {
                    autoSkip: false
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

          console.log('Versión:', Chart.version);
          console.log('Orientación:', grafica.options.indexAxis);

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