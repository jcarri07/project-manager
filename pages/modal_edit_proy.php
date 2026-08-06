<!DOCTYPE html>
<html lang="en">

<head>
    <title>Editar Usuario</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../bibliotecas/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../code_css/CSS_Modal.css">
    <script src="../bibliotecas/Bootstrap/js/bootstrap.min.js"></script>
    <script src="../bibliotecas/jqery/jquery.js"></script>

</head>

<body>

    <?php
    $id = $_REQUEST["id"];
    include("./conexion.php");
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
        <div class="modal-dialog">
            <div class="modal-content w3-animate-opacity">
                <div class="w3-container w3-teal">
                    <p class="modal-title" style="color: black;">Datos Registrados</p>
                </div>

                <div class="w3-container modal-body" id="modalBody">
                    <?php
                    $sqlDat = ("SELECT * FROM tabla_proy WHERE tabla_proy.id_proy='$id'")
                    ?>
                    <form class="col-8 padding-8" action="./ejec_edit_proy.php" id="form-upload" enctype="multipart/form-data" method="POST">

                        <?php
                        $DatNot = mysqli_query($Conex, $sqlDat);
                        while ($row = mysqli_fetch_assoc($DatNot)) { ?>

                            <input type="hidden" style="display:none" class="form-control" value="<?php echo ($row["id_proy"]); ?>" id="edit_id" name="edit_id" readonly>

                            <div class="row g-3">
                                <div class="col-md-6" style="color:black">
                                    <label for="Comando" class="form-label">Comando: </label>
                                    <input type="text" class="form-control" value="<?php echo ($row["comando"]); ?>" id="edit_coman" name="edit_coman">
                                </div>

                                <div class="col-md-6" style="color:black">
                                    <label for="Comando" class="form-label">Escuadron: </label>
                                    <input type="text" class="form-control" value="<?php echo ($row["escuadron"]); ?>" id="edit_escu" name="edit_escu">
                                </div>
                            </div>
                            <br>

                            <div class="row g-3">
                                <div class="col-md-6" style="color:black">
                                    <label for="Comando" class="form-label">Unidad: </label>
                                    <input type="text" class="form-control" value="<?php echo ($row["unidad"]); ?>" id="edit_uni" name="edit_uni">
                                </div>
                                <div class="col-md-6" style="color:black">
                                    <label for="Caso" class="form-label">Caso: </label>
                                    <select class="form-select" id="edit_caso" name="edit_caso" required>
                                        <option selected value="<?php echo ($row["caso"]); ?>"><?php echo ($row["caso"]); ?></option>
                                        <option value="Proyecto">Proyecto</option>
                                        <option value="Mantenimiento">Mantenimiento</option>
                                        <option value="Reparacion">Reparación </option>
                                    </select>
                                </div>
                            </div>

                            <br>

                            <div class="row g-3">
                                <div class="col-md-6" style="color:black">
                                    <label for="Comando" class="form-label">Sistema: </label>
                                    <input type="text" class="form-control" value="<?php echo ($row["sistema"]); ?>" id="edit_sistema" name="edit_sistema">
                                </div>

                                <div class="col-md-6" style="color:black">
                                    <label for="Comando" class="form-label">Equipo: </label>
                                    <input type="text" class="form-control" value="<?php echo ($row["equipo"]); ?>" id="edit_equipo" name="edit_equipo">
                                </div>
                            </div>

                            <div class="col-md-6" style="color:black">
                                <label for="Caso" class="form-label">Condición: </label>
                                <select class="form-select" id="edit_condi" name="edit_condi" required>
                                    <option selected value="<?php echo ($row["condicion"]); ?>"><?php echo ($row["condicion"]); ?></option>
                                    <option value="Operativo">O</option>
                                    <option value="Inoperativo">I</option>
                                    <option value="No Aplicable">NA</option>
                                </select>
                            </div>

                            <br>

                            <div class="row g-3">
                                <div class="col-md-8" style="color:black">
                                    <label for="Grafica" class="form-label">Fecha: </label>
                                    <input type="text" class="form-control" id="edit_tiempo" name="edit_tiempo" value="<?php echo ($row["tiempo"]); ?>" required>
                                    <script>
                                        $(function() {
                                            $('input[name="edit_tiempo"]').daterangepicker({
                                                opens: 'left'
                                            }, function(start, end, label) {
                                                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                                            });
                                        });
                                    </script>
                                </div>

                                <div class="col-md-4" style="color:black">
                                    <label for="Comando" class="form-label">Area: </label>
                                    <input type="text" class="form-control" value="<?php echo ($row["area"]); ?>" id="edit_area" name="edit_area">
                                </div>
                            </div>

                            <br>

                            <div class="row g-3">
                                <div class="col-md-12" style="color:black">
                                    <label for="Grafica" class="form-label">Descripción: </label>
                                    <textarea name="edit_descrip" id="edit_descrip" cols="40" rows="4" class="ampliar" required><?php echo ($row["descripcion"]); ?></textarea>
                                </div>
                                <script>
                                    const textarea = document.getElementById('edit_descrip');
                                    const maximoCaracteres = 150;
                                    const actualizarContador = () => {
                                        const caracteresRestantes = maximoCaracteres - textarea.value.length;
                                        document.getElementById('contador').textContent = caracteresRestantes;
                                        if (caracteresRestantes < 0) {
                                            const mensajeError = document.createElement('p');
                                            mensajeError.classList.add('text-danger');
                                            mensajeError.textContent = 'Has superado el límite de caracteres. (Reinicie Por Favor)';
                                            textarea.parentNode.appendChild(mensajeError);
                                            mensajeError.style.display = 'none';
                                            mensajeError.style.display = 'block';
                                            textarea.disabled = true;
                                        } else {
                                            const mensajeError = document.createElement('p');
                                            mensajeError.classList.add('text-danger');
                                            mensajeError.textContent = 'Has superado el límite de caracteres. (Reinicie Por Favor)';
                                            textarea.parentNode.appendChild(mensajeError);
                                            mensajeError.style.display = 'none';
                                            mensajeError.style.display = 'none';
                                            textarea.disabled = false;
                                        }
                                    };
                                    textarea.addEventListener('input', actualizarContador);
                                    const divContador = document.createElement('div');
                                    divContador.id = 'contador';
                                    divContador.textContent = maximoCaracteres;
                                    textarea.parentNode.appendChild(divContador);

                                    const mostrarError = () => {
                                        mensajeError.style.display = 'block';
                                    };

                                    const ocultarError = () => {
                                        mensajeError.style.display = 'none';
                                    };

                                    textarea.addEventListener('focus', mostrarError);
                                    textarea.addEventListener('blur', ocultarError);

                                    actualizarContador();
                                </script>
                            </div>

                            <br>
                            <div class="row g-3">
                                <div class="col-md-6" style="color:black">
                                    <label for="Comando" class="form-label">División: </label>
                                    <input type="text" class="form-control" value="<?php echo ($row["division"]); ?>" id="edit_division" name="edit_division">
                                </div>

                                <div class="col-md-6" style="color:black">
                                    <label for="Comando" class="form-label">Presupuesto: </label>
                                    <input type="text" min="0" class="form-control" value="<?php echo ($row["presupuesto"]); ?>" id="edit_presupuesto" name="edit_presupuesto">
                                </div>
                            </div>

                            <br>
                            <div class="row g-3">
                                <div class="col-md-6" style="color:black">
                                    <label for="Comando" class="form-label">Porcentaje: </label>
                                    <input type="number" min="0" max="100" class="form-control" value="<?php echo ($row["data_grafica"]); ?>" id="edit_data_grafica" name="edit_data_grafica">
                                </div>

                                <div class="col-md-6" style="color:black">
                                    <label for="Comando" class="form-label">Ejecutor: </label>
                                    <input type="text" class="form-control" value="<?php echo ($row["ejecutor"]); ?>" id="edit_ejecutor" name="edit_ejecutor">
                                </div>
                            </div>
                        <?php

                        }
                        mysqli_free_result($DatNot);
                        ?>

                        <br>

                        <button type="submit" class="btn btn-primary" id="Redirect" data-bs-dismiss="modal">Editar</button>
                        <br><br>

                    </form>

                    <!-- -------------------------------------------------------------------------------------------------------------- -->

                </div>

                <!-- Modal footer -->
                <div class="w3-teal modal-footer">
                    <button type="button" class="btn btn-danger" id="closeAndRedirect" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

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



    <div> <?php include("./tables.php") ?> </div>
</body>

</html>