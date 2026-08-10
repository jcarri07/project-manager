<?php


require_once('../databases/conexion.php');


if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes' && isset($_GET['id'])) {
    $idProyecto = intval($_GET['id']);
    $sql = "UPDATE projects SET activo = 1 WHERE projects.id = $idProyecto";
    $resultado = mysqli_query($conn, $sql);

    if ($resultado && mysqli_affected_rows($conn) > 0) {
        header('Location: ./tables.php?msg=success&msg_text=Proyecto+restablecido+exitosamente');
    } else {
        header('Location: ./tables.php?msg=error&msg_text=No+se+pudo+restablecer+el+proyecto');
    }
    mysqli_close($conn);
    exit;
}


if (!isset($_GET['id'])) {
    header('Location: ./tables.php');
    exit;
}

$projectId = intval($_GET['id']);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Eliminar Proyecto</title>
    <script src="../assets/js/sweetalert2.js"></script>
</head>

<body>
    <script>
        const projectId = <?php echo json_encode($projectId); ?>;

        function goBack() {
            window.location.href = './tables.php';
        }

        if (typeof Swal === 'undefined') {
            goBack();
        } else {
            Swal.fire({
                title: "¿Estás seguro?",
                text: "¡No podrás revertir esta acción!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sí,  restablecer!",
                cancelButtonText: "Cancelar",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = window.location.href + '&confirm=yes';
                } else {
                    Swal.fire({
                        title: 'Cancelado',
                        text: 'El restablecimiento fue cancelado',
                        icon: 'info',
                        confirmButtonText: 'OK'
                    }).then(goBack);
                }
            });
        }
    </script>
</body>

</html>
<?php
if (isset($conn) && $conn) {
    mysqli_close($conn);
}
?>