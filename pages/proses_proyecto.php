

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


/*else {*/

	if ($_GET['act']=='insert') {
		if (isset($_POST['Guardar'])) {
			
			$nombre = mysqli_real_escape_string($conn, trim($_POST['nombre']));
			$descripcion  = mysqli_real_escape_string($conn, trim($_POST['descripcion']));
			$lider = mysqli_real_escape_string($conn, trim($_POST['lider']));
			$categoria = mysqli_real_escape_string($conn, trim($_POST['categoria']));
            $objetivos = mysqli_real_escape_string($conn, trim($_POST['objetivos']));
			$beneficiarios = mysqli_real_escape_string($conn, trim($_POST['beneficiarios']));
            $requerimientos = mysqli_real_escape_string($conn, trim($_POST['requerimientos']));
            $estatus = mysqli_real_escape_string($conn, trim($_POST['estatus']));
			$avance = mysqli_real_escape_string($conn, trim($_POST['rango']));
			$fecha_inicio = mysqli_real_escape_string($conn, trim($_POST['fecha_inicio']));
			$fecha_fin = mysqli_real_escape_string($conn, trim($_POST['fecha_fin']));

			$name_file          = $_FILES['foto']['name'];
									$ukuran_file        = $_FILES['foto']['size'];
									$tipe_file          = $_FILES['foto']['type'];
									$tmp_file           = $_FILES['foto']['tmp_name'];
									
							
									$allowed_extensions = array('jpg','jpeg','png');
									
								
									$path_file          = "../assets/img/".$name_file;
							
									$file               = explode(".", $name_file);
									$extension          = array_pop($file);
												                    			
									                  if (empty($_FILES['foto']['name'])) {
														
															$query = mysqli_query($conn, "INSERT INTO projects(nombre, descripcion, avance, fecha_inicio, fecha_fin, categoria, objetivos, beneficiarios, requerimientos, estatus)
																						VALUES('$nombre','$descripcion','$avance','$fecha_inicio','$fecha_fin','$categoria','$objetivos','$beneficiarios','$requerimientos','$estatus')")
																						or die('error: '.mysqli_error($conn)); 

														if ($query) {
															
															header("location: ../pages/profile.php?alert=1");

														}else {
																		
															header("location: ../pages/profile.php?alert=3");
														}
														
													}	elseif (!empty($_FILES['foto']['name'])) {
								
														if (in_array($extension, $allowed_extensions)) {
														
															if($ukuran_file <= 1000000) { 
																
																if(move_uploaded_file($tmp_file, $path_file)) { 
				
																	$query = mysqli_query($conn, "INSERT INTO projects(nombre, descripcion, avance, fecha_inicio, fecha_fin, categoria, objetivos, beneficiarios, requerimientos, estatus,imagen)
																	VALUES('$nombre','$descripcion','$avance','$fecha_inicio','$fecha_fin','$categoria','$objetivos','$beneficiarios','$requerimientos','$estatus','$name_file')")
																	or die('error: '.mysqli_error($conn)); 

																			if ($query) {
				
																					header("location: ../pages/profile.php?alert=2");
																						}
																	
																													}
																} else {
																   
																	header("location: ../pages/profile.php?alert=5");
																}
															} else {
															   
																header("location: ../pages/profile.php?alert=6");
															}
														} else {
														   
															header("location: ../pages/profile.php?alert=7");
														} 
							}
													
													else {
														
														if (in_array($extension, $allowed_extensions)) {
														   
															if($ukuran_file <= 1000000) { 
															   
																if(move_uploaded_file($tmp_file, $path_file)) { 
				
																	$query = mysqli_query($conn, "INSERT INTO projects(nombre, descripcion, avance, fecha_inicio, fecha_fin, categoria, objetivos, beneficiarios, requerimientos, estatus,imagen)
																	VALUES('$nombre','$descripcion','$avance','$fecha_inicio','$fecha_fin','$categoria','$objetivos','$beneficiarios','$requerimientos','$estatus','$name_file')")
																	or die('error: '.mysqli_error($conn)); 
				
																			if ($query) {
				
																					header("location: ../pages/profile.php?alert=2");
																						}
																} else {
																	
																	header("location: ../pages/profile.php?alert=5");
																}
															} else {
															   
																header("location: ../pages/profile.php?alert=6");
															}
														} else {
														
															header("location: ../pages/profile.php?alert=7");
														} 
													}
						}
					
	


	elseif ($_GET['act']=='update') {
		if (isset($_POST['Guardar'])) {
			if (isset($_POST['id'])) {
                   
			$nombres  = mysqli_real_escape_string($conn, trim($_POST['nombres']));
			$apellidos  = mysqli_real_escape_string($conn, trim($_POST['apellidos']));
			$cargo = mysqli_real_escape_string($conn, trim($_POST['cargo']));
			$jefe = mysqli_real_escape_string($conn, trim($_POST['jefe']));
			//$foto = mysqli_real_escape_string($conn, trim($_POST['foto']));
            $unidad = mysqli_real_escape_string($conn, trim($_POST['unidad']));
			$cedula = mysqli_real_escape_string($conn, trim($_POST['cedula']));
            $movil = mysqli_real_escape_string($conn, trim($_POST['movil']));
            $email = mysqli_real_escape_string($conn, trim($_POST['email']));
            $id = mysqli_real_escape_string($conn, trim($_POST['id']));
			//$proyecto = mysqli_real_escape_string($conn, trim($_POST['proyecto']));
				  		

					$name_file          = $_FILES['foto']['name'];
									$ukuran_file        = $_FILES['foto']['size'];
									$tipe_file          = $_FILES['foto']['type'];
									$tmp_file           = $_FILES['foto']['tmp_name'];
									
							
									$allowed_extensions = array('jpg','jpeg','png');
									
								
									$path_file          = "../assets/img/".$name_file;
							
									$file               = explode(".", $name_file);
									$extension          = array_pop($file);
												                    				
									if (empty($_FILES['foto']['name'])) {
										
										$query = mysqli_query($conn, "UPDATE members SET        nombres 	= '$nombres',
										                                                        apellidos 	= '$apellidos',
																								cargo        = '$cargo', 
																								jefe       ='$jefe',
																								cedula = '$cedula', 
																								email       = '$email',
																								movil     = '$movil',
																								unidad 		= '$unidad'
								  
																					WHERE id='$id'")
			 															 or die('error : '.mysqli_error($conn));

												 if ($query) {

														header("location: ../pages/profile.php?alert=2");
															} else {
	                           
																header("location: ../pages/profile.php?alert=3");
															}
												}
							
								
									elseif (!empty($_FILES['foto']['name'])) {
								
										if (in_array($extension, $allowed_extensions)) {
										
											if($ukuran_file <= 1000000) { 
												
												if(move_uploaded_file($tmp_file, $path_file)) { 

													$query = mysqli_query($conn, "UPDATE members SET        nombres 	= '$nombres',
																											apellidos 	= '$apellidos',
																											cargo        = '$cargo', 
																											jefe       ='$jefe',
																											cedula = '$cedula', 
																											email       = '$email',
																											foto        = '$name_file',
																											movil     = '$movil',
																											unidad 		= '$unidad'

																								WHERE id='$id'")
																					or die('error : '.mysqli_error($conn));

															if ($query) {

																	header("location: ../pages/profile.php?alert=2");
																		}
													
																									}
												} else {
												   
													header("location: ../pages/profile.php?alert=5");
												}
											} else {
											   
												header("location: ../pages/profile.php?alert=6");
											}
										} else {
										   
											header("location: ../pages/profile.php?alert=7");
										} 
			}
									
									else {
										
										if (in_array($extension, $allowed_extensions)) {
										   
											if($ukuran_file <= 1000000) { 
											   
												if(move_uploaded_file($tmp_file, $path_file)) { 

													$query = mysqli_query($conn, "UPDATE members SET        nombres 	= '$nombres',
																											apellidos 	= '$apellidos',
																											cargo        = '$cargo', 
																											jefe       ='$jefe',
																											cedula = '$cedula', 
																											email       = '$email',
																											foto        = '$name_file',
																											movil     = '$movil',
																											unidad 		= '$unidad'

																								WHERE id='$id'")
																					or die('error : '.mysqli_error($conn));

															if ($query) {

																	header("location: ../pages/profile.php?alert=2");
																		}
												} else {
													
													header("location: ../pages/profile.php?alert=5");
												}
											} else {
											   
												header("location: ../pages/profile.php?alert=6");
											}
										} else {
										
											header("location: ../pages/profile.php?alert=7");
										} 
									}
		}
	}
					


					elseif ($_GET['act']=='delete' /*&& $_SESSION['permisos_acceso'] == "Super Admin"*/) {

						if (isset($_GET['id'])) {
							$id_user = $_GET['id'];
					  
							$query = mysqli_query($conn, "DELETE FROM members WHERE id=  '$id_user'")
															or die('error '.mysqli_error($conn));				
													
							if ($query) {
					 
								header("location: ../pages/profile.php?alert=4");
							}
						}
					}
	
?>