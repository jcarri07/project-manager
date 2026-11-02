<?php
require_once('../databases/conexion.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$query_2 = mysqli_query($conn, "SELECT * FROM users WHERE users.cedula = '$_SESSION[cedula]'")
    or die('error: ' . mysqli_error($conn));

$rows  = mysqli_num_rows($query_2);
$data  = mysqli_fetch_assoc($query_2);
//$val_typ = $_SESSION['cedula'];
$val_typ = $data['id_user_type'];

$ID_user = $data['id_usuario'];


if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../index.php");
}
?>

<style>
    #sidenav-main .nav-item-dropdown {
        width: 100% !important;
        margin: 0 0 12px 0 !important;
        padding: 0 !important;
    }

    #sidenav-main .nav-item-dropdown .dropdown {
        position: relative !important;
        display: block !important;
        width: 100% !important;
    }

    /* Botón principal */
    #sidenav-main .sidenav-project-toggle {
        position: relative;

        display: flex !important;
        flex-direction: row !important;
        align-items: center !important;
        justify-content: flex-start !important;

        width: 90% !important;
        min-height: 40px !important;

        padding: 12px 16px !important;
        margin: 0 auto !important;

        background: linear-gradient(110deg,
                #1879ed 0%,
                #419ce9 100%) !important;

        border: none !important;
        border-radius: 9px !important;

        color: #ffffff !important;
        text-align: left !important;
    }

    /* Icono */
    #sidenav-main .sidenav-project-toggle>div {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;

        flex: 0 0 26px;
        width: 26px;
        margin: 0 12px 0 0 !important;
    }

    #sidenav-main .sidenav-project-toggle .material-icons {
        color: #ffffff !important;
        font-size: 22px;
    }

    /* Texto */
    #sidenav-main .sidenav-project-toggle .nav-link-text {
        flex: 1;
        text-align: left !important;
        color: #ffffff !important;
        margin: 0 !important;
    }

    /* Flecha */
    #sidenav-main .sidenav-project-toggle::after {
        margin-left: auto !important;
    }

    /* ==========================================
    SUBMENÚ FLOTANTE
    ========================================== */

    #sidenav-main .sidenav-project-menu {
        position: absolute !important;

        top: calc(100% + 5px) !important;
        left: 0 !important;
        right: auto !important;

        width: 100% !important;
        min-width: 100% !important;

        margin: 0 !important;
        transform: none !important;

        z-index: 1080 !important;
    }

    #sidenav-main .sidenav-project-menu:not(.show) {
        display: none !important;
    }

    #sidenav-main .sidenav-project-menu.show {
        display: block !important;
    }

    #sidenav-main .sidenav-project-menu li {
        margin: 0 !important;
        padding: 0 !important;
    }

    #sidenav-main .nav-item-dropdown+.nav-item {
        margin-top: 0 !important;
    }
</style>

<?php
if ($val_typ == 1) {
?>

    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href=" # " target="_blank">
                <img src="../assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold text-white">Gestion de Proyectos</span>
            </a>
        </div>
        <hr class="horizontal light mt-0 mb-2">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item mb-3">
                    <a class="nav-link text-white bg-gradient-info sidenav-project-toggle" href="../pages/dashboard_admin_director.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item mb-3">
                    <div class="dropdown">
                        <button class="btn nav-link text-white dropdown-toggle sidenav-project-toggle" type="button" id="dropdownMenuButton2" data-coreui-toggle="dropdown" aria-expanded="false">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">table_view</i>
                            </div>
                            <span class="nav-link-text ms-1">Proyectos</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark sidenav-project-menu" aria-labelledby="dropdownMenuButton2">
                            <li><a class="dropdown-item" href="../pages/project_gen_tables_direct.php">V.General de los Proyectos</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../pages/project_indiv_tables_direct.php">V.Proyectos Propios</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item mb-3">
                    <a class="nav-link text-white bg-gradient-info sidenav-project-toggle" href="../pages/pag_admin_users.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <span class="nav-link-text ms-1">Lista de Miembros</span>
                    </a>
                </li>

                <li class="nav-item mb-3">
                    <a class="nav-link text-white bg-gradient-info sidenav-project-toggle" href="../pages/reportes.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">notifications</i>
                        </div>
                        <span class="nav-link-text ms-1">Reporte</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Cuenta:</h6>
                </li>

                <li class="nav-item mb-3">
                    <a class="nav-link text-white bg-gradient-info sidenav-project-toggle" href="../logout.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">login</i>
                        </div>
                        <span class="nav-link-text ms-1">Cerrar Sesión</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

<?php
}

if ($val_typ == 2) { ?>

    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href=" # " target="_blank">
                <img src="../assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold text-white">Gestion de Proyectos</span>
            </a>
        </div>
        <hr class="horizontal light mt-0 mb-2">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item mb-3">
                    <a class="nav-link text-white bg-gradient-info sidenav-project-toggle" href="../pages/dashboard_jefe_unid.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item mb-3">
                    <div class="dropdown">
                        <button class="btn nav-link text-white dropdown-toggle sidenav-project-toggle" type="button" id="dropdownMenuButton2" data-coreui-toggle="dropdown" aria-expanded="false">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">table_view</i>
                            </div>
                            <span class="nav-link-text ms-1">Proyectos</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark sidenav-project-menu" aria-labelledby="dropdownMenuButton2">
                            <li><a class="dropdown-item" href="../pages/project_gen_tables_jef.php">V.General de los Proyectos</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../pages/project_indiv_tables_jef.php">V.Proyectos Propios</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item mb-3">
                    <a class="nav-link text-white bg-gradient-info sidenav-project-toggle" href="../pages/reportes.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">notifications</i>
                        </div>
                        <span class="nav-link-text ms-1">Reporte</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Cuenta:</h6>
                </li>
                <li class="nav-item mb-3">
                    <a class="nav-link text-white bg-gradient-info sidenav-project-toggle" href="../logout.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">login</i>
                        </div>
                        <span class="nav-link-text ms-1">Cerrar Sesión</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

<?php
}

if ($val_typ == 3) { ?>

    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href=" # " target="_blank">
                <img src="../assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold text-white">Gestion de Proyectos</span>
            </a>
        </div>
        <hr class="horizontal light mt-0 mb-2">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item mb-3">
                    <a class="nav-link text-white bg-gradient-info sidenav-project-toggle" href="../pages/dashboard_trab.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item mb-3">
                    <a class="nav-link text-white bg-gradient-info sidenav-project-toggle" href="../pages/project_tables_trab.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text ms-1">Proyectos</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Cuenta:</h6>
                </li>
                <li class="nav-item mb-3">
                    <a class="nav-link text-white sidenav-project-toggle" href="../logout.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">login</i>
                        </div>
                        <span class="nav-link-text ms-1">Cerrar Sesión</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

<?php
}
?>