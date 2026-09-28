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
        <li class="nav-item d-flex align-items-center">
          <a href="../logout.php" class="nav-link text-body font-weight-bold px-0">
            <i class="fa fa-user me-sm-1"></i>
            <span class="d-sm-inline d-none">Cerrar Sesión</span>
          </a>
        </li>

    </nav>
    <!-- End Navbar -->
    <?php
    if ($_GET['form'] == 'add') { ?>

      <div class="container-fluid px-2 px-md-10">
        <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
          <span class="mask  bg-gradient-primary  opacity-6"></span>
        </div>
        <div class="card card-body mx-3 mx-md-4 mt-n6">
          <div class="row gx-5 mb-2">
            <div class="col-auto">

              <div class="avatar avatar-xl position-relative">
                <div class="image-upload avatar avatar-xl position-relative">
                  <label for="file-input" class='center fas fa-edit'>
                    <img class='img-user' src='../assets/img/person.jpg' width='45' class="border-radius-lg shadow">
                  </label>
                </div>
              </div>
            </div>

            <div class="col-auto my-auto">
              <div class="h-100">
                <h5 class="mb-1">
                  Agregar:
                </h5>
                <p class="mb-0 font-weight-normal text-sm">
                  Proyecto
                </p>
              </div>
            </div>

            <div class="container my-auto">
              <div class="row">
                <div class="col-lg-8 col-md-8 col-12 mx-auto">
                  <div class="card-body">


                    <form role="form" class="form-horizontal" method="POST" action="../pages/proses_proyecto.php?act=insert" enctype="multipart/form-data">
                      <form role="form" class="text-start">

                        <input id="file-input" type="file" name="foto" style="display:none">

                        <label class="form-label">Lider del Proyecto</label>
                        <div class="input-group input-group-outline my-2">
                          <select class="form-select-lg" name="lider" data-placeholder="-- Seleccionar proyecto --" autocomplete="off" required>
                            <option value=""></option>
                            <?php
                            $query_data = mysqli_query($conn, "SELECT id_miembro ,nombre, apellido, especialidad FROM members")
                              or die('error ' . mysqli_error($conn));

                            while ($data_1 = mysqli_fetch_assoc($query_data)) {
                              echo "<option value=\"$data_1[id_miembro]\"> $data_1[especialidad]  | $data_1[nombre] $data_1[apellido] </option>";
                            }
                            echo $data_1['project_id'];
                            ?>
                          </select>
                        </div>

                        <label class="form-label">Nombre del Proyecto</label>
                        <div class="input-group input-group-outline my-2">
                          <input type="text" name="nombre" class="form-control">
                        </div>

                        <label class="form-label">Descripcion</label>
                        <div class="input-group input-group-outline my-2">
                          <input type="text" name="descripcion" class="form-control">
                        </div>

                        <label class="form-label">Categoria</label>
                        <div class="input-group input-group-outline mb-2">
                          <input type="text" name="categoria" class="form-control">
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <label class="form-label">Fecha de Inicio</label>
                            <div class="input-group input-group-outline my-2">
                              <input type="date" name="fecha_inicio" class="form-control" lang="es">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <label class="form-label">Fecha de Culminación</label>
                            <div class="input-group input-group-outline my-2">
                              <input type="date" name="fecha_fin" class="form-control" data-date-format="DD MMMM YYYY">
                            </div>
                          </div>
                        </div>
                        <label class="form-label">Objetivos</label>
                        <div class="input-group input-group-outline mb-2">
                          <input type="text" name="objetivos" class="form-control">
                        </div>

                        <label class="form-label">Beneficiarios</label>
                        <div class="input-group input-group-outline mb-2">
                          <input type="text" name="beneficiarios" class="form-control">
                        </div>

                        <label class="form-label">Requerimientos</label>
                        <div class="input-group input-group-outline mb-2">
                          <input type="text" name="requerimientos" class="form-control">
                        </div>

                        <label class="form-label">Estatus</label>
                        <div class="input-group input-group-outline mb-2">
                          <select class="form-select-lg form-control" name="estatus" data-placeholder="-- Seleccionar proyecto --" autocomplete="off" required>
                            <option value="Por Ejecutar">Por ejecutar</option>
                            <option value="En progreso">En progreso</option>
                            <option value="Terminado">Terminado</option>
                          </select>
                        </div>

                        <label for="fecha">Archivo Fotografico (PNG/JPG): </label>
                        <div class="input-group input-group-outline mb-2 form-check form-switch">
                          <input class="form-check-input" type="checkbox" id="check_foto" checked>
                        </div>
                        <input type="file" class="form-control" id="foto" name="foto">

                        <div class="row">
                          <div class="col-md-11">
                            <label class="form-label">Avance del Proyecto</label>
                            <div class="input-group input-group-outline my-2">
                              <label for="customRange1" class="form-label"></label>
                              <input type="range" class="form-range" id="customRange1" name="rango" min="0" max="100" oninput="updateRangeValue(this.value)">
                            </div>
                          </div>
                          <div class="col-md-1">
                            <label class="form-label"></label>
                            <div class="input-group input-group-outline my-2">
                              <div><span id="rangeValue">50</span></div>
                            </div>
                          </div>
                        </div>

                        <input type="datetime-local" class="form-control" id="fecha_reg" name="fecha_reg" style="display:none" readonly>

                        <script>
                          var fechaActual = new Date();
                          var formattedDateTime = fechaActual.getFullYear() + '-' + ('0' + (fechaActual.getMonth() + 1)).slice(-2) + '-' + ('0' + fechaActual.getDate()).slice(-2) + 'T' + ('0' + fechaActual.getHours()).slice(-2) + ':' + ('0' + fechaActual.getMinutes()).slice(-2);
                          document.getElementById('fecha_reg').value = formattedDateTime;
                        </script>

                        <!-- <div class="form-group">
                <label class="col-sm-2 control-label">Foto</label>
                <div class="col-sm-5">
                  <input type="file" name="foto">
               </div>
              </div>-->
                        </br>

                        <div class="box-footer">
                          <div class="form-group text-center">
                            <div class="col-sm-offset-4 col-sm-12">
                              <input type="submit" class="btn bg-gradient-primary w-30 my-4 mb-2" name="Guardar" value="Guardar">
                              <a href="../pages/tables.php" class="btn btn-outline-primary w-30 my-4 mb-2">Cancelar</a>

                            </div>
                          </div>

                      </form>
                  </div>
                </div>


              </div>
            </div>
          <?php
        } elseif ($_GET['form'] == 'update') {
          if (isset($_GET['id'])) {

            $query = mysqli_query($conn, "SELECT * FROM members WHERE id='$_GET[id]'")
              or die('error: ' . mysqli_error($conn));
            $data  = mysqli_fetch_assoc($query);
          }
          ?>
            <div class="container-fluid px-2 px-md-10">
              <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
                <span class="mask  bg-gradient-primary  opacity-6"></span>
              </div>
              <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="row gx-5 mb-2">
                  <div class="col-auto">

                    <div class="avatar avatar-xl position-relative">
                      <div class="image-upload avatar avatar-xl position-relative">
                        <label for="file-input" class='center fas fa-edit'>
                          <?php
                          if ($data['foto'] == "") { ?>
                            <td class='center'><img class='img-user' src='../assets/img/person.jpg' width='45' class="border-radius-lg shadow"></td>
                          <?php
                          } else { ?>

                            <td class='center'><img src="../assets/img/<?php echo $data['foto']; ?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm"></td>
                          <?php } ?>
                        </label>

                      </div>
                    </div>
                  </div>

                  <div class="col-auto my-auto">
                    <div class="h-100">
                      <h5 class="mb-1">
                        Modificar datos:
                      </h5>
                      <p class="mb-0 font-weight-normal text-sm">
                        Miembros
                      </p>
                    </div>
                  </div>

                  <div class="container my-auto">
                    <div class="row">
                      <div class="col-lg-8 col-md-8 col-12 mx-auto">
                        <div class="card-body">


                          <form role="form" class="form-horizontal" method="POST" action="../pages/proses_miembros.php?act=update" enctype="multipart/form-data">
                            <form role="form" class="text-start">

                              <input id="file-input" type="file" name="foto" style="display:none">
                              <input type="hidden" name="id" class="form-control" value="<?php echo $data['id']; ?>">

                              <label class="form-label">Nombres</label>
                              <div class="input-group input-group-outline my-2">
                                <input type="text" name="nombres" class="form-control" value="<?php echo $data['nombres']; ?>">
                              </div>

                              <label class="form-label">Apellidos</label>
                              <div class="input-group input-group-outline mb-2">
                                <input type="text" name="apellidos" class="form-control" value="<?php echo $data['apellidos']; ?>">
                              </div>

                              <label class="form-label">Cedula</label>
                              <div class="input-group input-group-outline mb-2">
                                <input type="text" name="cedula" class="form-control" value="<?php echo $data['cedula']; ?>">
                              </div>

                              <label class="form-label">Cargo</label>
                              <div class="input-group input-group-outline mb-2">
                                <input type="text" name="cargo" class="form-control" value="<?php echo $data['cargo']; ?>">
                              </div>

                              <label class="form-label">Jefe</label>
                              <div class="input-group input-group-outline mb-2">
                                <?php
                                $query_data = mysqli_query($conn, "SELECT id,nombres,apellidos,unidad FROM project_managers")
                                  or die('error ' . mysqli_error($conn));
                                $data_2 = mysqli_fetch_assoc($query_data) ?>

                                <select class="form-select-lg form-control" name="jefe" data-placeholder="-- Seleccionar proyecto --" autocomplete="off" required>
                                  <option value="<?php echo $data['jefe']; ?>"><?php echo $data_2['nombres'], ' ', $data_2['apellidos'], ' | ', $data_2['unidad']; ?></option>
                                  <?php
                                  while ($data_2 = mysqli_fetch_assoc($query_data)) {
                                    echo "<option value=\"$data_2[id]\"> $data_2[nombres]  $data_2[apellidos] | $data_2[unidad]</option>";
                                  }
                                  ?>
                                </select>
                              </div>

                              <label class="form-label">Unidad</label>
                              <div class="input-group input-group-outline mb-2">
                                <input type="text" name="unidad" class="form-control" value="<?php echo $data['unidad']; ?>">
                              </div>

                              <label class="form-label">Email</label>
                              <div class="input-group input-group-outline mb-2">
                                <input type="text" name="email" class="form-control" value="<?php echo $data['email']; ?>">
                              </div>

                              <label class="form-label">Movil</label>
                              <div class="input-group input-group-outline mb-2">
                                <input type="text" name="movil" class="form-control" value="<?php echo $data['movil']; ?>">
                              </div>
                              </br>

                              <div class="box-footer">
                                <div class="form-group text-center">
                                  <div class="col-sm-offset-4 col-sm-12">
                                    <input type="submit" class="btn bg-gradient-primary w-30 my-4 mb-2" name="Guardar" value="Guardar">
                                    <a href="../pages/profile.php" class="btn btn-outline-primary w-30 my-4 mb-2">Cancelar</a>

                                  </div>
                                </div>

                            </form>
                        </div>
                      </div>


                    </div>
                  </div>
                <?php
              }
                ?>

</body>

</html>

<script>
  function updateRangeValue(value) {
    document.getElementById('rangeValue').textContent = value;
  }
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