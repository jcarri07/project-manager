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
    <!-- 1. Material Dashboard -->
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />

    <!-- 2. CoreUI -->
    <link rel="stylesheet" href="../assets/coreui/coreui_min_css.css">

    <!-- 3. Bootstrap: una sola vez -->
    <link rel="stylesheet" href="../assets/Bootstrap/css/bootstrap.min.css">

    <!-- 4. Iconos -->
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">

    <!-- 5. Estilos propios del proyecto y de los modales -->
    <link rel="stylesheet" href="../assets/css/code_icon_navbar.css">
    <link rel="stylesheet" href="../assets/css/material-modal.css">
    <link rel="stylesheet" href="../assets/css/dash-modal_miemb.css">

    <!-- 6. DataTables -->
    <link rel="stylesheet" href="../assets/DataTable/datatables.min.css">
    <link rel="stylesheet" href="../assets/css/code_tables_miemb_users.css">
</head>

<body class="g-sidenav-show  bg-gray-200">
    <?php
    include("./code_navbar.php");
    ?>




    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tables</li>
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

        <div class="d-flex justify-content-center align-items-md-center mt-2">

            <div class="col-12 px-3">

                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">

                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">

                            <div class="d-flex align-items-center gap-3 px-3">

                                <h6 class="text-white text-capitalize mb-0">Proyectos</h6>

                            </div>

                            <br>

                        </div>

                    </div>


                    <div class="card-body px-3 pb-3">
                        <div class="table-responsive">

                            <table id="tabla_proyectos" class="table align-items-center justify-content-center" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Proyecto</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unidad</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estado</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Inicio</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fin</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Progreso</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Prioridad</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Opciones</th>

                                    </tr>
                                </thead>

                                <tbody>
                                </tbody>

                            </table>

                        </div>
                    </div>



                </div>
            </div>
        </div>

    </main>

    <!-- --------------------------------------------------------------------------------------------------------------- -->

    <div class="modal w3-container" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content w3-animate-opacity">
                <div class="w3-container w3-teal">
                    <br>
                    <p class="modal-title" style="color: black;">Datos Registrados</p>
                    <br>
                    <div class="w3-center">
                        <span onclick="document.getElementById('id01').style.display='none'" id="closeAndRedirect" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                    </div>
                </div>

                <div class="w3-container modal-body" id="modalBody">

                    <form class="row g-3" action="./proses_proyecto.php?act=insert_borr_init" id="form-upload" enctype="multipart/form-data" method="POST">

                        <input type="hidden" style="display:none" class="form-control" id="borra_id_Proy" name="borra_id_Proy" readonly>

                        <div class="row g-3">
                            <div class="col-md-4" style="color:black">
                                <label for="Comando" class="form-label">Nombre del Proyecto: </label>
                                <input type="text" class="form-control" id="borra_nombre_proy" name="borra_nombre_proy">
                            </div>

                            <div class="col-md-4" style="color:black">
                                <label for="Grafica" class="form-label">Descripción del Proyecto: </label>
                                <textarea name="borra_descrip_proy" id="borra_descrip_proy" cols="40" rows="4" class="form-control" required></textarea>
                                <div id="contador_descrip_proy">300</div>
                            </div>

                            <div class="col-md-4" style="color:black">
                                <label for="Cond" class="form-label">Unidad: </label>
                                <select class="form-select" id="borra_unidad_proy" name="borra_unidad_proy" required>
                                    <?php
                                    $query_data = mysqli_query($conn, "SELECT * FROM unidad");

                                    while ($miembro = mysqli_fetch_assoc($query_data)) {
                                        $id = $miembro['id_unidad'];
                                        $nombre = ($miembro['nombre_unid']);
                                        echo "<option value=\"$id\">$nombre</option>";
                                    }
                                    ?>
                                    ?>
                                </select>
                            </div>

                            <br>

                            <div class="row g-3">
                                <div class="col-md-4" style="color:black">
                                    <label for="Comando" class="form-label">Tipo: </label>
                                    <select name="borra_tipo_proy" id="borra_tipo_proy" class="form-select border px-3" required>
                                        <option value="Proyecto">Proyecto</option>
                                        <option value="Mantenimiento">Mantenimiento</option>
                                        <option value="Reparación">Reparación</option>
                                    </select>
                                </div>

                                <div class="col-md-4" style="color:black">
                                    <label for="Beneficiarios" class="form-label">Prioridad: </label>
                                    <select name="borra_prio_proy" id="borra_prio_proy" class="form-select border px-3" required>
                                        <option value="Baja">Baja</option>
                                        <option value="Media">Media</option>
                                        <option value="Alta">Alta</option>
                                        <option value="Crítica">Crítica</option>
                                    </select>
                                </div>

                                <div class="col-md-4" style="color:black">
                                    <label for="Comando" class="form-label">Presupuesto del Proyecto: </label>
                                    <input type="text" class="form-control" id="borra_pres_proy" name="borra_pres_proy">
                                    <span class="input-group-text">$</span>
                                </div>

                                <input type="hidden" class="form-control" id="borra_solic_proy" name="borra_solic_proy" readonly>
                            </div>

                            <br>

                            <div class="row g-3">

                                <div class="col-md-4" style="color:black">
                                    <label for="Comando" class="form-label">Sponsor Proyecto: </label>
                                    <input type="text" class="form-control" id="borra_sponsor_proy" name="borra_sponsor_proy">
                                </div>

                                <div class="col-md-4" style="color:black">
                                    <label for="Comando" class="form-label">Inicio del Proyecto: </label>
                                    <input type="date" class="form-control" id="borra_fech_ini_proy" name="borra_fech_ini_proy">
                                </div>

                                <div class="col-md-4" style="color:black">
                                    <label for="Comando" class="form-label">Fin del Proyecto: </label>
                                    <input type="date" class="form-control" id="borra_fech_fin_proy" name="borra_fech_fin_proy">
                                </div>

                            </div>

                            <br>

                            <div class="row g-3">

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Problema / Necesidad *</label>
                                    <textarea name="borra_problema_proy" id="borra_problema_proy" class="form-control border px-3" rows="3" placeholder="Describa el problema o la necesidad que se desea resolver" required></textarea>
                                    <div id="contador_problema_proy">300</div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Objetivos *</label>
                                    <textarea name="borra_objetivos_proy" id="borra_objetivos_proy" class="form-control border px-3" rows="3" placeholder="Describa el problema o la necesidad que se desea resolver" required></textarea>
                                    <div id="contador_objetivos_proy">300</div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Beneficios *</label>
                                    <textarea name="borra_beneficios_proy" id="borra_beneficios_proy" class="form-control border px-3" rows="3" placeholder="Describa el problema o la necesidad que se desea resolver" required></textarea>
                                    <div id="contador_benef_proy">300</div>
                                </div>

                            </div>

                            <script>
                                function limitarTextarea(idTextarea, idContador, maximoCaracteres = 200) {
                                    const textarea = document.getElementById(idTextarea);
                                    const contador = document.getElementById(idContador);

                                    const mensajeError = document.createElement('p');
                                    mensajeError.classList.add('text-danger');
                                    mensajeError.textContent = 'Has superado el límite de caracteres (Reiniciar el Registro).';
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

                                limitarTextarea("borra_descrip_proy", "contador_descrip_proy", 300);
                                limitarTextarea("borra_problema_proy", "contador_problema_proy", 300);
                                limitarTextarea("borra_objetivos_proy", "contador_objetivos_proy", 300);
                                limitarTextarea("borra_beneficios_proy", "contador_benef_proy", 300);
                            </script>

                            <br>
                            <br>

                            <br>

                            <div class="d-grid gap-2 col-6 mx-auto">

                                <button type="submit" class="btn btn-primary" id="Redirect" data-bs-dismiss="modal">Editar</button>

                            </div>

                            <br><br>

                    </form>

                </div>

                <div class="w3-teal modal-footer">
                    <br><br>
                </div>

            </div>
        </div>
    </div>

    <!-- ------------------------------------------------------------------------------------------------------------------ -->

    </div>
    <!--   Core JS Files   -->
    <script src="../assets/js/material-dashboard.min.js?v=3.0.4"></script>
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

    <script>
        const closeAndRedirectButton = document.getElementById("closeAndRedirect");
        if (closeAndRedirectButton) {
            closeAndRedirectButton.addEventListener("click", function() {
                window.location.href = "./project_tables_draft.php";
            });
        }
    </script>


    <script>
        $(document).ready(function() {
            $('#tabla_proyectos').DataTable({
                //autoWidth: false,
                //responsive: true,
                //pageLength: 5,
                "language": {
                    "url": "../assets/js/DataEsp.json"
                },
                "ajax": {
                    "url": "./consultas/consul_proyectos_draft.php",
                    "dataSrc": ""
                },
                "columns": [{
                        "data": "id_proyecto"
                    },
                    {
                        "data": "nombre"
                    },
                    {
                        "data": "unidad"
                    },
                    {
                        "data": "estatus"
                    },
                    {
                        "data": "fecha_inicio"
                    },
                    {
                        "data": "fecha_fin"
                    },
                    {

                        "data": "avance",
                        "render": function(data, type, row) {

                            let porcentaje = data ? parseInt(data) : 0;
                            porcentaje = Math.max(0, Math.min(100, porcentaje));

                            return `
            <div class="progreso-contenedor">

                <span class="progreso-porcentaje">
                    ${porcentaje}%
                </span>

                <div class="progreso-barra">

                    <div 
                        class="progreso-relleno"
                        style="width: ${porcentaje}%;">
                    </div>

                </div>

            </div>
        `;
                        }

                    },
                    {
                        "data": "prioridad"
                    },
                    {
                        "data": null,
                        "render": function(data, type, row) {
                            return `
              <div class="btn-group" role="group" aria-label="Basic example">
                <button 
                    type="button"
                    onclick="abrirModalBorrador(${row.id_proyecto})"
                    class="btn-editar"
                    title="Retomar Propuesta">

                    <i class="fa-regular fa-pen-to-square"></i>

                </button>
            </div>
        `;
                        }
                    }
                ]
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modalMiembros = document.getElementById('modalMiembros');

            if (!modalMiembros) return;
            const botonesCerrar = modalMiembros.querySelectorAll('.closeAndRedirect');

            botonesCerrar.forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    cerrarMiembrosYRedirigir();
                });
            });

            function cerrarMiembrosYRedirigir() {
                window.location.href = './project_tables_draft.php';
            }
        });
    </script>

    <script>
        function abrirModalBorrador(id) {

            console.log("ID seleccionado:", id);

            document.getElementById('borra_id_Proy').value = id;

            const modalElement = document.getElementById('myModal');
            const modal = new bootstrap.Modal(modalElement);

            modal.show();

            $.ajax({
                url: './consultas/consul_obtener_proyecto_draft.php',
                type: 'GET',
                data: {
                    id: id
                },
                dataType: 'json',

                success: function(respuesta) {

                    console.log("Respuesta del servidor:", respuesta);

                    if (!respuesta.success) {
                        alert(respuesta.message);
                        return;
                    }

                    const proyecto = respuesta.data;
                    $('#borra_id_Proy').val(proyecto.id_proyecto);
                    $('#borra_solic_proy').val(proyecto.id_solicitante);
                    $('#borra_nombre_proy').val(proyecto.nombre);
                    $('#borra_descrip_proy').val(proyecto.descripcion);
                    $('#borra_unidad_proy').val(proyecto.unidad);
                    $('#borra_tipo_proy').val(proyecto.tipo);
                    $('#borra_prio_proy').val(proyecto.prioridad);
                    $('#borra_sponsor_proy').val(proyecto.sponsor);
                    $('#borra_fech_ini_proy').val(proyecto.fecha_inicio);
                    $('#borra_fech_fin_proy').val(proyecto.fecha_fin);
                    $('#borra_pm_proy').val(proyecto.id_manager);
                    $('#borra_pres_proy').val(proyecto.presupuesto_est);
                    $('#borra_problema_proy').val(proyecto.problema);
                    $('#borra_objetivos_proy').val(proyecto.objetivos);
                    $('#borra_beneficios_proy').val(proyecto.beneficios);

                },

                error: function(xhr) {

                    console.error("Error AJAX:");
                    console.error(xhr.responseText);

                    alert('Error al obtener los datos del proyecto.');

                }
            });
        }
    </script>


</body>

</html>