

<?php
/*session_start();

$NombreUser = $_SESSION['name_user'];
$iduser = $_SESSION['id_user'];
$accion = "";
$cedulauser = $_SESSION['cedula_user'];

require_once "../../config/database.php";


if (empty($_SESSION['username']) && empty($_SESSION['password'])){
	echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
}*/

require_once('../databases/conexion.php');
session_start();


/*else {*/

	if ($_GET['act']=='insert') {
		if (isset($_POST['Guardar'])) {
			
			$nombres  = mysqli_real_escape_string($conn, trim($_POST['nombres']));
			$apellidos  = mysqli_real_escape_string($conn, trim($_POST['apellidos']));
			$cargo = mysqli_real_escape_string($conn, trim($_POST['cargo']));
			$jefe = mysqli_real_escape_string($conn, trim($_POST['jefe']));
			//$foto = mysqli_real_escape_string($conn, trim($_POST['foto']));
            $unidad = mysqli_real_escape_string($conn, trim($_POST['unidad']));
			$cedula = mysqli_real_escape_string($conn, trim($_POST['cedula']));
            $movil = mysqli_real_escape_string($conn, trim($_POST['movil']));
            $email = mysqli_real_escape_string($conn, trim($_POST['email']));
			$proyecto = mysqli_real_escape_string($conn, trim($_POST['proyecto']));

            $query = mysqli_query($conn, "INSERT INTO members(project_id,nombres,apellidos,cargo,jefe,unidad,cedula,movil,email)
                                            VALUES('$proyecto','$nombres','$apellidos','$cargo','$jefe','$unidad','$cedula','$movil','$email')")
                                            or die('error: '.mysqli_error($conn)); 

            if ($query) {
				
				header("location: ../pages/profile.php?alert=1");

            }
			
		}	
	}
	elseif ($_GET['act']=='update') {
		if (isset($_POST['Guardar'])) {
                   
			$nombres  = mysqli_real_escape_string($conn, trim($_POST['nombres']));
			$apellidos  = mysqli_real_escape_string($conn, trim($_POST['apellidos']));
			$cargo = mysqli_real_escape_string($conn, trim($_POST['cargo']));
			//$jefe = mysqli_real_escape_string($conn, trim($_POST['jefe']));
			//$foto = mysqli_real_escape_string($conn, trim($_POST['foto']));
            $unidad = mysqli_real_escape_string($conn, trim($_POST['unidad']));
			$cedula = mysqli_real_escape_string($conn, trim($_POST['cedula']));
            $movil = mysqli_real_escape_string($conn, trim($_POST['movil']));
            $email = mysqli_real_escape_string($conn, trim($_POST['email']));
            $id = $_SESSION['id'];
			//$proyecto = mysqli_real_escape_string($conn, trim($_POST['proyecto']));
				  		
			                    $query = mysqli_query($conn, "UPDATE project_managers SET nombres 	= '$nombres',
			                    													      apellidos 	= '$apellidos',
			                    													      cargo        = '$cargo', 
			                    													      cedula = '$cedula', 
			                    													      email       = '$email',
			                    													      movil     = '$movil',
			                    													      unidad 		= '$unidad'
			                    													
			                                                                  WHERE id='$id'")
			                                                    or die('error : '.mysqli_error($conn));

			                    if ($query) {
			                    
			                        header("location: ../pages/profile.php?alert=2");
			                    }
                        	} else {
	                           
	                            //header("location: ../../main.php?module=user&alert=5");
	                        }
	                    } 

    


/*

	elseif ($_GET['act']=='delete' && $_SESSION['permisos_acceso'] == "Super Admin") {

        if (isset($_GET['id'])) {
            $id_user = $_GET['id'];
      
            $query = mysqli_query($conn, "DELETE FROM usuarios WHERE id_user =  '$id_user'")
                                            or die('error '.mysqli_error($conn));

            $accion = "Eliminacion de Usuario";

            $query = mysqli_query($conn, "INSERT INTO history(nombre, accion, cedula, permiso, fecha, hora) 
                                            VALUES('$NombreUser','$accion','$cedulauser', '$iduser', NOW(), DATE_FORMAT(NOW( ), '%H:%I:%S' ))")
                                            or die('error '.mysqli_error($conn)); 


            if ($query) {
     
                header("location: ../../main.php?module=user&alert=4");
            }
        }
    }

    elseif ($_GET['act']=='on' && $_SESSION['permisos_acceso'] != "Super Admin") {
    	echo'<script type="text/javascript">
    		alert("No puede desbloquear un nivel superior");
    		</script>';

    		header("location: ../../main.php?module=user");
    }

    elseif ($_GET['act']=='off' && $_SESSION['permisos_acceso'] != "Super Admin") {
    	echo'<script type="text/javascript">
    		alert("No puede bloquear un nivel superior");
    		
    		</script>';

    		header("location: ../../main.php?module=user");
    }

    elseif ($_GET['act']=='delete' && $_SESSION['permisos_acceso'] != "Super Admin") {
    		
    		echo'<script type="text/javascript">
    		alert("No puede eliminar un nivel superior");
    		</script>';

    		header("location: ../../main.php?module=user");
    }
}	*/	
?>