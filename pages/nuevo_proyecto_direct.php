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

if (!isset($_SESSION['id_usuario'])) {
  // Redirigir al usuario a la página de inicio de sesión
  header("Location: ../index.php");
}

$Data_ced = $_SESSION['id_usuario'];
$Nomb_solic = $_SESSION['nombre'] . " " . $_SESSION['apellido'];

//echo ("Hola $Data_ced");

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
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <link rel="stylesheet" href="../assets/coreui/coreui_min_css.css">
  <script src="../assets/coreui/coreui_bundle_min_js.js"></script>

  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
  <!-- Theme Override: Corporate Blue #194070 -->
  <link href="../assets/css/theme-override.css" rel="stylesheet">

</head>

<body class="g-sidenav-show bg-gray-200">
  <?php
  include("./code_navbar.php");
  ?>
  <div class="main-content position-relative max-height-vh-100 h-100">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Proyectos</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Proyectos</h6>
        </nav>

    </nav>
    <!-- End Navbar -->
    <?php
    if ($_GET['form'] == 'add') { ?>

      <div class="container-fluid px-3 px-md-4">

        <!-- Encabezado -->
        <div class="page-header min-height-200 border-radius-xl mt-4"
          style="background-image: url('../assets/img/curved-images/curved0.jpg');">
          <span class="mask bg-gradient-primary opacity-6"></span>
          <div class="position-relative p-4">
            <h3 class="text-white mb-1">Nuevo proyecto</h3>
          </div>
        </div>

        <div class="card card-body mx-2 mx-md-3 mt-n6">

          <form method="POST" action="../pages/proses_proyecto.php?act=insert_init_dir" enctype="multipart/form-data">

            <div class="card mb-4 shadow-none border">
              <div class="card-header pb-0">
                <h6 class="mb-1">
                  <i class="material-icons-round me-2 text-primary">description</i>
                  Sección 1 — Información básica
                </h6>
              </div>

              <div class="card-body">
                <div class="row">

                  <div class="col-md-12 mb-3">
                    <label class="form-label">Nombre *</label>
                    <input type="text" name="nombre_proy" id="nombre_proy" class="form-control border px-3" placeholder="Nombre del proyecto"
                      required>
                  </div>

                  <div class="col-md-12 mb-3">
                    <label class="form-label">Descripción *</label>
                    <textarea name="descripcion_proy" id="descripcion_proy" class="form-control border px-3" rows="3" placeholder="Describa brevemente el proyecto" required></textarea>
                    <div id="contador_descrip_proy">300</div>
                  </div>

                  <div class="col-md-4 mb-3">
                    <label class="form-label">Unidad *</label>
                    <select name="unidad_proy" id="unidad_proy" class="form-select border px-3" required>
                      <option value="">Seleccione una unidad</option>
                      <?php
                      $query_data = mysqli_query($conn, "SELECT * FROM unidad");

                      while ($miembro = mysqli_fetch_assoc($query_data)) {
                        $id = $miembro['id_unidad'];
                        $nombre = ($miembro['nombre_unid']);
                        echo "<option value=\"$id\">$nombre</option>";
                      }
                      ?>
                    </select>
                  </div>

                  <div class="col-md-4 mb-3">
                    <label class="form-label">Tipo *</label>
                    <select name="categoria_proy" id="categoria_proy" class="form-select border px-3" required>
                      <option value="">Seleccione un tipo</option>
                      <option value="Proyecto">Proyecto</option>
                      <option value="Mantenimiento">Mantenimiento</option>
                      <option value="Reparación">Reparación</option>
                    </select>
                  </div>

                  <div class="col-md-4 mb-3">
                    <label class="form-label">Prioridad *</label>
                    <select name="prioridad_proy" id="prioridad_proy" class="form-select border px-3" required>
                      <option value="">Seleccione la prioridad</option>
                      <option value="Baja">Baja</option>
                      <option value="Media">Media</option>
                      <option value="Alta">Alta</option>
                      <option value="Crítica">Crítica</option>
                    </select>
                  </div>

                </div>
              </div>
            </div>

            <div class="card mb-4 shadow-none border">
              <div class="card-header pb-0">
                <h6 class="mb-1">
                  <i class="material-icons-round me-2 text-primary">group</i>
                  Sección 2 — Solicitante
                </h6>
              </div>

              <div class="card-body">
                <div class="row">

                  <div class="col-md-4 mb-3">
                    <label class="form-label">Solicitante *</label>
                    <input type="text" name="s_nombre" id="s_nombre" class="form-control border px-3" value="<?php echo htmlspecialchars($Nomb_solic); ?>" placeholder="Solicitante" readonly>
                    <input type="hidden" name="solicitante_proy" id="solicitante_proy" class="form-control border px-3" value="<?php echo htmlspecialchars($Data_ced); ?>" placeholder="Solicitante" readonly>
                  </div>

                  <div class="col-md-4 mb-3">
                    <label class="form-label">Sponsor</label>
                    <input type="text" name="sponsor_proy" id="sponsor_proy" class="form-control border px-3" placeholder="Nombre del sponsor">
                  </div>



                  <div class="col-md-4 mb-3" id="co_autor_container">
                    <label for="fecha" class="form-label">Co-Autores: </label>
                    <select class="form-multi-select" id="co_autor_select" name="co_autor_select[]" multiple data-coreui-search="global">
                      <?php
                      $query_data = mysqli_query($conn, "SELECT * FROM users");

                      while ($miembro = mysqli_fetch_assoc($query_data)) {
                        $id = $miembro['id_usuario'];
                        $nombre = ($miembro['nombre_user']);
                        $apell = ($miembro['apellido_user']);
                        $esp = ($miembro['especialidad']);
                        echo "<option value=\"$id\">$nombre $apell | Especialidad: $esp</option>";
                      }
                      ?>
                    </select>
                  </div>

                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="check_co_autor_select" checked>
                    <label class="form-check-label" for="check_co_autor_select">Agregar co-autores</label>
                  </div>





                  <!--
                    <div class="col-md-4 mb-3">
                      <label class="form-label">PM</label>
                      <select name="lider_proy" id="lider_proy" class="form-select border px-3">
                        <option value="">Seleccione un responsable</option>
                        <?php
                        $query_data = mysqli_query($conn, "SELECT * FROM users WHERE users.id_usuario !=  '$Data_ced'");

                        while ($miembro = mysqli_fetch_assoc($query_data)) {
                          $id = $miembro['id_usuario'];
                          $nombre = ($miembro['nombre'] . ' ' . $miembro['apellido'] . ' | ' . $miembro['especialidad']);
                          echo "<option value=\"$id\">$nombre</option>";
                        }
                        ?>
                      </select>
                    </div>
                  -->

                </div>
              </div>
            </div>

            <div class="card mb-4 shadow-none border">
              <div class="card-header pb-0">
                <h6 class="mb-1">
                  <i class="material-icons-round me-2 text-primary">event</i>
                  Sección 3 — Estimación inicial
                </h6>
                <p class="text-sm text-secondary">
                  Fechas y presupuesto previstos.
                </p>
              </div>

              <div class="card-body">
                <div class="row">

                  <div class="col-md-4 mb-3">
                    <label class="form-label">Inicio estimado</label>
                    <input type="date" name="fecha_inicio_proy" id="fecha_inicio_proy" class="form-control border px-3">
                  </div>

                  <div class="col-md-4 mb-3">
                    <label class="form-label">Final estimado</label>
                    <input type="date" name="fecha_fin_proy" id="fecha_fin_proy" class="form-control border px-3">
                  </div>

                  <div class="col-md-4 mb-3">
                    <label class="form-label">Presupuesto estimado</label>
                    <div class="input-group input-group-outline">
                      <span class="input-group-text"></span>
                      <input type="number" name="presupuesto_estimado_proy" id="presupuesto_estimado_proy" class="form-control border px-3" min="0" step="0.01" placeholder="0.00$">
                    </div>
                  </div>

                </div>
              </div>
            </div>

            <!-- SECCIÓN 4: NECESIDAD EMPRESARIAL -->
            <div class="card mb-4 shadow-none border">
              <div class="card-header pb-0">
                <h6 class="mb-1">
                  <i class="material-icons-round me-2 text-primary">lightbulb</i>
                  Sección 4 — Necesidad empresarial
                </h6>
              </div>

              <div class="card-body">
                <div class="row">

                  <div class="col-md-12 mb-3">
                    <label class="form-label">Problema / Necesidad *</label>
                    <textarea name="problema_proy" id="problema_proy" class="form-control border px-3" rows="3" placeholder="Describa el problema o la necesidad que se desea resolver" required></textarea>
                    <div id="contador_problema_proy">300</div>
                  </div>

                  <div class="col-md-12 mb-3">
                    <label class="form-label">Objetivos *</label>
                    <textarea name="objetivos_proy" class="form-control border px-3" rows="3" placeholder="Indique el objetivo principal del proyecto" required></textarea>
                    <div id="contador_objetivos_proy">300</div>
                  </div>

                  <div class="col-md-12 mb-3">
                    <label class="form-label">Beneficios esperados *</label>
                    <textarea name="beneficios_esperados_proy" id="beneficios_esperados_proy" class="form-control border px-3" rows="3" placeholder="Describa los beneficios que se esperan obtener" required></textarea>
                    <div id="contador_beneficios_esperados_proy">300</div>
                  </div>

                  <input type="datetime-local" class="form-control" id="fecha_reg" name="fecha_reg" style="display:none" readonly>

                  <script>
                    var fechaActual = new Date();
                    var formattedDateTime = fechaActual.getFullYear() + '-' + ('0' + (fechaActual.getMonth() + 1)).slice(-2) + '-' + ('0' + fechaActual.getDate()).slice(-2) + 'T' + ('0' + fechaActual.getHours()).slice(-2) + ':' + ('0' + fechaActual.getMinutes()).slice(-2);
                    document.getElementById('fecha_reg').value = formattedDateTime;
                  </script>

                </div>
              </div>
            </div>

            <div class="d-flex flex-column flex-sm-row justify-content-end gap-2 pb-2">

              <a href="../pages/project_tables.php"
                class="btn btn-outline-secondary mb-0">
                Cancelar
              </a>

              <button type="submit" name="Borrador" value="Borrador"
                class="btn btn-outline-primary mb-0">
                <i class="material-icons-round me-1">save</i>
                Guardar borrador
              </button>

              <button type="submit" name="Guardar" value="Guardar"
                class="btn bg-gradient-primary mb-0">
                <i class="material-icons-round me-1">add_circle</i>
                Crear proyecto
              </button>

              <script>
                function limitarTextarea(idTextarea, idContador, maximoCaracteres = 300) {
                  const textarea = document.getElementById(idTextarea);
                  const contador = document.getElementById(idContador);

                  const mensajeError = document.createElement('p');
                  mensajeError.classList.add('text-danger');
                  mensajeError.textContent = 'Has superado el límite de caracteres. ERROR (Reiniciar el Registro).';
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

                limitarTextarea("descripcion_proy", "contador_descrip_proy", 300);
                limitarTextarea("problema_proy", "contador_problema_proy", 300);
                limitarTextarea("objetivos_proy", "contador_objetivos_proy", 300);
                limitarTextarea("beneficios_esperados_proy", "contador_beneficios_esperados_proy", 300);
              </script>

            </div>

          </form>
        </div>
      </div>

    <?php } ?>
</body>

</html>

<script>
  function updateRangeValue(value) {
    document.getElementById('rangeValue').textContent = value;
  }
</script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const checkbox = document.getElementById('check_co_autor_select');
    const contenedor = document.getElementById('co_autor_container');

    function toggle() {
      contenedor.style.display = checkbox.checked ? 'none' : 'block';
    }

    toggle(); // estado inicial
    checkbox.addEventListener('change', toggle);
  });
</script>