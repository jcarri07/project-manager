<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../databases/conexion.php';


// Identificar la acción
$act = $_GET['act'] ?? $_POST['act'] ?? '';


function salidaHTML($valor)
{
    return htmlspecialchars((string)($valor ?? ''), ENT_QUOTES, 'UTF-8');
}


if ($act === 'ejec_edit_restricciones') {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        header('Content-Type: application/json; charset=utf-8');

        $idRestriccion = filter_var(
            $_POST['id_data'] ?? '',
            FILTER_VALIDATE_INT
        );

        $nombre = trim($_POST['nombre_restriccion'] ?? '');
        $descripcion = trim($_POST['descripcion_restriccion'] ?? '');
        $impacto = trim($_POST['impacto_restriccion'] ?? '');

        if (!$idRestriccion || $idRestriccion <= 0) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => 'Identificador inválido.'
            ]);
            exit;
        }

        if ($nombre === '' || $descripcion === '' || $impacto === '') {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => 'Debes completar todos los campos.'
            ]);
            exit;
        }

        $sql = "UPDATE project_plans_restriction
                SET nombre_restriccion = ?,
                    descripcion_restriccion = ?,
                    impacto_restriccion = ?
                WHERE project_plans_restriction = ?";

        $stmt = mysqli_prepare($conn, $sql);

        if (!$stmt) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Error al preparar la consulta.'
            ]);
            exit;
        }

        mysqli_stmt_bind_param(
            $stmt,
            "sssi",
            $nombre,
            $descripcion,
            $impacto,
            $idRestriccion
        );

        if (mysqli_stmt_execute($stmt)) {

            // Recuperar los identificadores asociados
            $sqlDatos = "SELECT id_proyecto, id_project_plan
                         FROM project_plans_restriction
                         WHERE project_plans_restriction = ?
                         LIMIT 1";

            $stmtDatos = mysqli_prepare($conn, $sqlDatos);

            mysqli_stmt_bind_param($stmtDatos, "i", $idRestriccion);
            mysqli_stmt_execute($stmtDatos);

            $resultado = mysqli_stmt_get_result($stmtDatos);
            $datos = mysqli_fetch_assoc($resultado);

            echo json_encode([
                'success' => true,
                'message' => 'Restricción actualizada correctamente.',
                'id_proyecto' => $datos['id_proyecto'],
                'id_project_plan' => $datos['id_project_plan']
            ], JSON_UNESCAPED_UNICODE);

            mysqli_stmt_close($stmtDatos);
        } else {

            http_response_code(500);

            echo json_encode([
                'success' => false,
                'message' => 'No se pudo actualizar la restricción.'
            ]);
        }

        mysqli_stmt_close($stmt);
        exit;
    }


    /* =============================================
       B. CONSULTAR REGISTRO (GET)
    ============================================= */

    $idRestriccion = filter_var(
        $_GET['id_data'] ?? '',
        FILTER_VALIDATE_INT
    );

    if (!$idRestriccion || $idRestriccion <= 0) {
        http_response_code(400);
        exit('Identificador de restricción inválido.');
    }

    $sql = "SELECT
                project_plans_restriction,
                id_proyecto,
                id_project_plan,
                nombre_restriccion,
                descripcion_restriccion,
                impacto_restriccion
            FROM project_plans_restriction
            WHERE project_plans_restriction = ?
            LIMIT 1";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $idRestriccion);
    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);
    $restriccion = mysqli_fetch_assoc($resultado);

    mysqli_stmt_close($stmt);

    if (!$restriccion) {
        http_response_code(404);
        exit('No se encontró la restricción.');
    }

?>

    <!-- MODAL DE EDICIÓN -->

    <div class="modal fade"
        id="modalEditarRestriccion"
        tabindex="-1"
        aria-labelledby="tituloEditarRestriccion"
        aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered modal-lg">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="tituloEditarRestriccion">
                        <i class="material-icons-round align-middle">edit_note</i>
                        Editar restricción
                    </h5>

                    <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>

                </div>

                <form id="formEditarRestriccion">

                    <div class="modal-body">

                        <input type="hidden" name="act" value="ejec_edit_restricciones">

                        <input type="hidden"
                            name="id_data"
                            value="<?php echo salidaHTML($restriccion['project_plans_restriction']); ?>">

                        <input type="hidden"
                            id="id_proyecto_restriccion"
                            value="<?php echo salidaHTML($restriccion['id_proyecto']); ?>">

                        <input type="hidden"
                            id="id_project_plan_restriccion"
                            value="<?php echo salidaHTML($restriccion['id_project_plan']); ?>">

                        <div class="mb-3">

                            <label class="form-label">
                                Nombre de la restricción
                            </label>

                            <input type="text"
                                class="form-control"
                                name="nombre_restriccion"
                                value="<?php echo salidaHTML($restriccion['nombre_restriccion']); ?>"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Descripción
                            </label>

                            <textarea class="form-control"
                                name="descripcion_restriccion"
                                rows="3"
                                required><?php echo salidaHTML($restriccion['descripcion_restriccion']); ?></textarea>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Impacto de la restricción
                            </label>

                            <textarea class="form-control"
                                name="impacto_restriccion"
                                rows="3"
                                required><?php echo salidaHTML($restriccion['impacto_restriccion']); ?></textarea>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                            Cancelar
                        </button>

                        <button type="submit"
                            class="btn btn-primary">
                            <i class="material-icons-round align-middle">save</i>
                            Guardar cambios
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

<?php

    exit;
}


// Acción no reconocida
http_response_code(400);
exit('Acción no válida.');

?>