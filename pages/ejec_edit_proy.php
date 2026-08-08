<?php

require_once('../databases/conexion.php');

$D1 = $_REQUEST["edit_id_Proy"];
$D2 = $_REQUEST["edit_nombre_proy"];
$D3 = $_REQUEST["edit_avance"];
$D4 = $_REQUEST["edit_fecha_fin"];

$D5 = $_REQUEST["edit_categoria_proy"];
$D6 = $_REQUEST["edit_descrip_proy"];
$D7 = $_REQUEST["edit_objec_proy"];
$D8 = $_REQUEST["edit_objec_requer"];

$D9 = $_REQUEST["edit_est"];
$D10 = $_REQUEST["edit_ben_proy"];

$carpeta_destino = "../assets/img/img_proyect/";

$nombre_archivo1 = basename($_FILES["Arc_fot_proy"]["name"]);
$extension1 = strtolower(pathinfo($nombre_archivo1, PATHINFO_EXTENSION));

$Destino1 = $carpeta_destino . $nombre_archivo1;

if (($extension1 == "png") || ($extension1 == "jpg")) {

    if ((is_uploaded_file($_FILES["Arc_fot_proy"]["tmp_name"]) && move_uploaded_file($_FILES["Arc_fot_proy"]["tmp_name"], $carpeta_destino . $nombre_archivo1))) {


        $C1 = ("UPDATE projects SET imagen = '$Destino1'
        WHERE projects.id='$D1' ");

        $Carg1 = mysqli_query($conn, $C1);
    }
}

$sq1 = "UPDATE projects SET nombre = '$D2', avance = '$D3', fecha_fin = '$D4', categoria = '$D5', descripcion = '$D6', objetivos = '$D7',
beneficiarios = '$D10', requerimientos = '$D8', estatus = '$D9' WHERE projects.id='$D1' ";
$resultado = mysqli_query($conn, $sq1);

if ($resultado) {
    echo "
                <script src='../assets/js/sweetalert2.js'></script>
                <script language='JavaScript'>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Edición Completa',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                        timer: 5000
                        }).then(() => {
                        location.assign('./tables.php');
                        });
                });
                </script>";
} else {

    echo "
                            <script src='../assets/js/sweetalert2.js'></script>
                            <script language='JavaScript'>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error en la Edición',
                                    showCancelButton: false,
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'OK',
                                    timer: 5000
                                    }).then(() => {
                                    location.assign('./tables.php');
                                    });
                            });
                            </script>";
}
