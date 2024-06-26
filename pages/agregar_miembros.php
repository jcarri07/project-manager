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
          <a class="nav-link text-white " href="../pages/tables.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Proyectos</span>
          </a>
        </li>
       <!--<li class="nav-item">
          <a class="nav-link text-white " href="../pages/billing.html">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">receipt_long</i>
            </div>
            <span class="nav-link-text ms-1">Billing</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="../pages/virtual-reality.html">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">view_in_ar</i>
            </div>
            <span class="nav-link-text ms-1">Virtual Reality</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="../pages/rtl.html">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">format_textdirection_r_to_l</i>
            </div>
            <span class="nav-link-text ms-1">RTL</span>
          </a>
        </li>-->
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
          <a class="nav-link text-white active bg-gradient-primary" href="../pages/profile.php">
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
        <!--<li class="nav-item">
          <a class="nav-link text-white " href="../pages/sign-up.html">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">assignment</i>
            </div>
            <span class="nav-link-text ms-1">Sign Up</span>
          </a>
        </li>
      </ul>
    </div>-->
    <!--<div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <div class="mx-3">
        <a class="btn bg-gradient-primary mt-4 w-100" href="https://www.creative-tim.com/product/material-dashboard-pro?ref=sidebarfree" type="button">Upgrade to pro</a>
      </div>
    </div>-->
  </aside>
  <div class="main-content position-relative max-height-vh-100 h-100">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Perfil</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Perfil</h6>
        </nav>
       <!--<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline">
              <label class="form-label">Type here...</label>
              <input type="text" class="form-control">
            </div>
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a class="btn btn-outline-primary btn-sm mb-0 me-3" target="_blank" href="https://www.creative-tim.com/builder/material?ref=navbar-dashboard">Online Builder</a>
            </li>-->
            <li class="nav-item d-flex align-items-center">
              <a href="../logout.php" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Cerrar Sesión</span>
              </a>
            </li>
           <!-- <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a>
            </li>
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-bell cursor-pointer"></i>
              </a>
              <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="../assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New message</span> from Laur
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          13 minutes ago
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="my-auto">
                        <img src="../assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm bg-gradient-dark  me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <span class="font-weight-bold">New album</span> by Travis Scott
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          1 day
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                      <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                        <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <title>credit-card</title>
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                              <g transform="translate(1716.000000, 291.000000)">
                                <g transform="translate(453.000000, 454.000000)">
                                  <path class="color-background" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z" opacity="0.593633743"></path>
                                  <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                                </g>
                              </g>
                            </g>
                          </g>
                        </svg>
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          Payment successfully completed
                        </h6>
                        <p class="text-xs text-secondary mb-0">
                          <i class="fa fa-clock me-1"></i>
                          2 days
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>-->
    </nav>
    <!-- End Navbar -->
<?php
if ($_GET['form']=='add') { ?>

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
                 Agregar datos: 
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


          <form role="form" class="form-horizontal" method="POST" action="../pages/proses_miembros.php?act=insert" enctype="multipart/form-data">
                <form role="form" class="text-start" >

                <input id="file-input" type="file" name="foto" style="display:none">
              
                <label class="form-label">Proyecto Participante</label>
                <div class="input-group input-group-outline my-2">
                  <select class="form-select-lg" name="proyecto" data-placeholder="-- Seleccionar proyecto --" autocomplete="off" required>
                    <option value=""></option>
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

                <label class="form-label">Nombres</label>
                  <div class="input-group input-group-outline my-2">
                    <input type="text" name="nombres" class="form-control">
                  </div>

                  <label class="form-label">Apellidos</label>
                  <div class="input-group input-group-outline mb-2">
                    <input type="text" name="apellidos" class="form-control">
                  </div>

                  <label class="form-label">Cedula</label>
                  <div class="input-group input-group-outline mb-2">
                    <input type="text" name="cedula" class="form-control">
                  </div>

                  <label class="form-label">Email</label>
                  <div class="input-group input-group-outline mb-2">
                    <input type="text" name="email" class="form-control">
                  </div>

                  <label class="form-label">Movil</label>
                  <div class="input-group input-group-outline mb-2">
                    <input type="text" name="movil" class="form-control">
                  </div>

                  <label class="form-label">Cargo</label>
                  <div class="input-group input-group-outline mb-2">
                    <input type="text" name="cargo" class="form-control">
                  </div>

                  <label class="form-label">Jefe</label>
                  <div class="input-group input-group-outline mb-2">
                    <select class="form-select-lg form-control" name="jefe" data-placeholder="-- Seleccionar proyecto --" autocomplete="off" required>
                    <option value=""></option>
                    <?php
                      $query_data = mysqli_query($conn, "SELECT id,nombres,apellidos,unidad FROM project_managers WHERE id='$_SESSION[id]'")
                                                            or die('error '.mysqli_error($conn));

                      while ($data_1 = mysqli_fetch_assoc($query_data)) {
                        echo"<option value=\"$data_1[id]\"> $data_1[nombres]  $data_1[apellidos] | $data_1[unidad]</option>";
                      }
                    ?>
                  </select>

                  </div>
                  <label class="form-label">Unidad</label>
                  <div class="input-group input-group-outline mb-2">
                    <input type="text" name="unidad" class="form-control">
                  </div>

                  

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
                  <a href="../pages/profile.php" class="btn btn-outline-primary w-30 my-4 mb-2">Cancelar</a>

                </div>
              </div>

                </form>
              </div>
              </div>


    </div>
  </div>
<?php
}elseif ($_GET['form']=='update') { 
  	if (isset($_GET['id'])) {

      $query = mysqli_query($conn, "SELECT * FROM members WHERE id='$_GET[id]'") 
                                      or die('error: '.mysqli_error($conn));
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
                 if ($data['foto']=="") { ?>
                   <td class='center'><img class='img-user' src='../assets/img/person.jpg' width='45' class="border-radius-lg shadow"></td>
                 <?php
                 } else{?>
                   
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
                <form role="form" class="text-start" >

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
                                                            or die('error '.mysqli_error($conn));
                                                            $data_2 = mysqli_fetch_assoc($query_data)?>

                  <select class="form-select-lg form-control" name="jefe" data-placeholder="-- Seleccionar proyecto --" autocomplete="off" required>
                    <option value="<?php echo $data['jefe']; ?>"><?php echo $data_2['nombres'],' ',$data_2['apellidos'] ,' | ', $data_2['unidad']; ?></option>
                    <?php
                      while ($data_2 = mysqli_fetch_assoc($query_data)) {
                        echo"<option value=\"$data_2[id]\"> $data_2[nombres]  $data_2[apellidos] | $data_2[unidad]</option>";
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