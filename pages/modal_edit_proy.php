<!DOCTYPE html>
<html lang="en">

<head>
    <title>Editar datos del Proyectos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../assets/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/material-modal.css">
    <link rel="stylesheet" href="../assets/css/dash-modal.css">
    <script src="../assets/Bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/jqery/jquery.js"></script>
    <script src="../assets/Daterangepicker/moment.min.js"></script>
    <script src="../assets/Daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" href="../assets/Daterangepicker/daterangepicker.css">

</head>

<body>

    <?php
    error_reporting(0);
    $id = $_REQUEST["id"];
    require_once('../databases/conexion.php');
    ?>


    </div>
    <button style="display: none;" type="button" class="btn btn-primary open-modal-btn" data-bs-toggle="modal" data-bs-target="#myModal">Editar Memorandum</button>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const editButton = document.querySelector(".btn.btn-primary.open-modal-btn");
            if (editButton) {
                editButton.click();
            }
        });
    </script>


    <div class="modal w3-container" id="myModal">
        <div class="modal-proyecto">
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
                    <?php
                    $sqlDat = ("SELECT * FROM projects WHERE projects.id='$id'")
                    ?>
                    <form class="row g-3" action="./ejec_edit_proy.php" id="form-upload" enctype="multipart/form-data" method="POST">

                        <?php
                        $DatNot = mysqli_query($conn, $sqlDat);
                        while ($row = mysqli_fetch_assoc($DatNot)) { ?>

                            <input type="hidden" style="display:none" class="form-control" value="<?php echo ($row["id"]); ?>" id="edit_id_Proy" name="edit_id_Proy" readonly>

                            <div class="row g-3">
                                <div class="col-md-4" style="color:black">
                                    <label for="Comando" class="form-label">Nombre del Proyecto: </label>
                                    <input type="text" class="form-control" value="<?php echo ($row["nombre"]); ?>" id="edit_nombre_proy" name="edit_nombre_proy">
                                </div>

                                <div class="col-md-1" style="color:black">
                                    <label for="Comando" class="form-label">Avance: </label>

                                    <div class="input-group mb-2">
                                        <input max="100" min="0" type="number" class="form-control" value="<?php echo ($row["avance"]); ?>" id="edit_avance" name="edit_avance">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>

                            <br>

                            <div class="row g-3">
                                <div class="col-md-4" style="color:black">
                                    <label for="Grafica" class="form-label">Fecha: </label>
                                    <input type="text" class="form-control" id="edit_fecha_fin" name="edit_fecha_fin" value="<?php echo ($row["fecha_fin"]); ?>" required>
                                    <script>
                                        $(function() {
                                            $('input[name="edit_fecha_fin"]').daterangepicker({
                                                opens: 'left'
                                            }, function(start, end, label) {
                                                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                                            });
                                        });
                                    </script>
                                </div>

                                <div class="col-md-4" style="color:black">
                                    <label for="Comando" class="form-label">Categoria: </label>
                                    <input type="text" class="form-control" value="<?php echo ($row["categoria"]); ?>" id="edit_categoria_proy" name="edit_categoria_proy">
                                </div>

                                <div class="col-md-4" style="color:black">
                                    <label for="Beneficiarios" class="form-label">Nombre del Beneficiarios: </label>
                                    <input type="text" class="form-control" value="<?php echo ($row["beneficiarios"]); ?>" id="edit_ben_proy" name="edit_ben_proy">
                                </div>

                            </div>

                            <br>

                            <div class="row g-3">

                                <div class="col-md-4" style="color:black">
                                    <label for="Grafica" class="form-label">Descripción del Proyecto: </label>
                                    <textarea name="edit_descrip_proy" id="edit_descrip_proy" cols="40" rows="4" class="form-control" required><?php echo ($row["descripcion"]); ?></textarea>
                                    <div id="contador_descrip_proy">150</div>
                                </div>

                                <div class="col-md-4" style="color:black">
                                    <label for="Grafica" class="form-label">Objetivos del Proyecto: </label>
                                    <textarea name="edit_objec_proy" id="edit_objec_proy" cols="40" rows="4" class="form-control" required><?php echo ($row["objetivos"]); ?></textarea>
                                    <div id="contador_objec_proy">150</div>
                                </div>

                                <div class="col-md-4" style="color:black">
                                    <label for="Grafica" class="form-label">Requerimientos del Proyecto: </label>
                                    <textarea name="edit_objec_requer" id="edit_objec_requer" cols="40" rows="4" class="form-control" required><?php echo ($row["requerimientos"]); ?></textarea>
                                    <div id="contador_requer">150</div>
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

                                    limitarTextarea("edit_descrip_proy", "contador_descrip_proy", 200);
                                    limitarTextarea("edit_objec_proy", "contador_objec_proy", 200);
                                    limitarTextarea("edit_objec_requer", "contador_requer", 200);
                                </script>

                            </div>

                            <br>

                            <div class="row g-3">

                                <div class="col-md-4" style="color:black">
                                    <label for="Cond" class="form-label">Condición: </label>
                                    <select class="form-select" id="edit_est" name="edit_est" required>
                                        <option selected value="<?php echo ($row["estatus"]); ?>"><?php echo ($row["estatus"]); ?></option>
                                        <option value="Por Ejecutar">Por Ejecutar</option>
                                        <option value="En progreso">En progreso</option>
                                        <option value="Terminado">Terminado</option>
                                    </select>
                                </div>

                                <div class="col-md-4" style="color:black">
                                    <label for="fecha">Archivo Fotografico (PNG/JPG): </label><br>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="check_Arc_fot_proy" checked>
                                        <label class="form-check-label" for="check_Arc_fot_proy"></label>
                                    </div>
                                    <input type="file" class="form-control" id="Arc_fot_proy" name="Arc_fot_proy">
                                </div>

                            </div>

                            <br>
                            <br>

                        <?php

                        }
                        mysqli_free_result($DatNot);
                        ?>

                        <br>

                        <div class="d-grid gap-2 col-6 mx-auto">

                            <button type="submit" class="btn btn-primary" id="Redirect" data-bs-dismiss="modal">Editar</button>

                        </div>

                        <br><br>

                    </form>

                </div>

                <div class="w3-teal modal-footer">
                    <br>
                </div>

            </div>
        </div>
    </div>



</body>

<script>
    document.getElementById("Redirect").addEventListener("click", function() {
        window.location.href = "./ejec_edit_proy.php";
    });
</script>

<script>
    const closeAndRedirectButton = document.getElementById("closeAndRedirect");
    if (closeAndRedirectButton) {
        closeAndRedirectButton.addEventListener("click", function() {
            window.location.href = "./tables.php";
        });
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


<script>
    const asignSelect = document.getElementById('Asign');
    const estadoSelect = document.getElementById('estado');

    asignSelect.addEventListener('change', () => {
        const previousEstado = estadoSelect.value;
        const selectedUser = asignSelect.options[asignSelect.selectedIndex].value;

        if (previousEstado === 'Por Asignar' || previousEstado === '' || previousEstado === 'En Espera') {
            if (selectedUser !== '') {
                estadoSelect.value = 'Asignado';
            }
        }
    });
</script>

</html>