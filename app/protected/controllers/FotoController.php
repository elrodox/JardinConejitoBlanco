<?php



class FotoController extends Controller
{
	
	public function actionListar() {
	//AQUI SE INTENTA ACTUALIZAR
	// $nuevoTexto=$_POST['nuevoTexto'];
	// $idImagen=$_POST['idImagen'];
	// $ruta="imagenes";
	// $archivo=$_FILES['nuevaImagen']['tmp_name'];
	// $nombreArchivo=$_FILES['nuevaImagen']['name'];
	// move_uploaded_file($archivo,$ruta."/".$nombreArchivo);
	// $ruta=$ruta."/".$nombreArchivo;
	
	
	// include "conexion.php";
	
	// $actualizar=mysql_query("UPDATE imagenes SET imagen='".$ruta."',
	// texto='".$nuevoTexto."' WHERE id='".$idImagen."'",$conexion);
	
	// if ($actualizar)
	// {
	// 	echo "
	// 	<html>
	// 		<head>
	// 			<meta http-equiv='REFRESH' content='0 ; url=verImagenes.php'>
	// 			<script>
	// 				alert('Actualizada con exito!!!');
				
	// 			</script>
			
	// 		</head>
		
		
	// 	</html>
		
	// 	";
		
	// }
	// else
	// {
		
	// 	echo "
	// 	<html>
	// 		<head>
	// 			<meta http-equiv='REFRESH' content='0 ; url=verImagenes.php'>
	// 			<script>
	// 				alert('La actualizacion fallo');
				
	// 			</script>
			
	// 		</head>
		
		
	// 	</html>
		
	// 	";
	// }
	//AQUI TEMRINA
		
		parent::actionListar();
	}
	
	public function actionVer($id) {
		
	//AQUI SE INTENTA VER LAS IMAGENES
	// $consultar=mysql_query("SELECT * FROM imagenes");


	// echo "<table border='2' width='100%'>
	//         <tr>
	//             <th>Imagen</th>
	//             <th>Texto</th>
	//             <th>Eliminar</th>
	//             <th>Cambiar</th>
	        
	//         </tr>
	// ";
	
	// while($imagenes=mysql_fetch_array($consultar))
	// {
	//     $imagen=$imagenes['imagen'];
	//     $texto=$imagenes['texto'];
	// 	$idImagen=$imagenes['id'];
		
	//     echo "<tr>
	            
	//             <td><img src='$imagen' width='150' height='100'></td>
	//             <td>$texto</td>
	//             <td><a href='eliminarImagen.php?idImagen=$idImagen'>Eliminar</a></td>
	//             <td><a href='cambiarImagen.php?idImagen=$idImagen&texto=$texto&imagen=$imagen'>Cambiar</a></td>
	//         </tr>"  ;    
	
	
	// }
	
	// echo "</table>
	
	// 	<br/><br/>
	// 	  <form method='post' action='insertar.php' enctype='multipart/form-data'>
	//             <label>Elige Imagen:</label>
	//             <br/>
	//             <input type='file' name='imagen'/>
	//             <br/>
	//             <label>Descripcion:</label>
	//             <br/>
	//             <textarea cols='20' rows='10' name='texto'></textarea>
	//             <br/>
	//             <input type='submit' value='Enviar'/>
	            
	//         </form>
	
	
	// ";
	//HASTA AQUI
		
		parent::actionVer($id);
	}
	
	public function actionCrear() {
		
		// $file=$_FILES["file"]["name"]; 
		// if(!is_dir ("files/"))
		// 	mkdir("files/", 0777);
			
		// if($file && move_uploaded_file($_FILES["file"]["tmp_name"],"files/".$file))
		// {
		// 	$this->sendResponse("OK");
		// }

		
		if(isset($_FILES['file']['name'])){
			$file_name = $_FILES["file"]["name"];
		
			$base_path = realpath(Yii::app()->getBasePath() . '/../img/galeria');
			
			$path = $base_path."/".$file_name;
			//$this->sendResponse($base_path, 500);
			
			if(!is_dir($base_path)) mkdir($base_path,0777);
				
			if( $file_name && move_uploaded_file($_FILES["file"]["tmp_name"],$path) ) {
				$fotoModel = new Foto;
				$fotoModel->titulo = $_POST['name'];
				$fotoModel->link = Yii::app()->getBaseUrl() . "/img/galeria/" . $file_name;
				if($fotoModel->save()){
					$this->sendResponse($fotoModel);
				}else{
					$this->sendResponse("No se pudo guardar el modelo", 500);
				}
				
			}else{
				$this->sendResponse("No se pudo guardar el archivo", 500);
			}
		}
		
		//parent::actionCrear();

	}
	
	public function actionActualizar($id){
		parent::actionActualizar($id);	
	}
	
	public function actionEliminar($id){
	// 	$idImagen=$_GET['idImagen'];

	// include "conexion.php";
	
	// $eliminar=mysql_query("DELETE FROM imagenes WHERE id='".$idImagen."'");
	
	
	// if ($eliminar)
	// {
	// 	echo "
	// 	<html>
	// 		<head>
	// 			<meta http-equiv='REFRESH' content='0 ; url=verImagenes.php'>
	// 			<script >
	// 				alert('Eliminada con exito!!!');
	// 			</script>
	// 		</head>
		
	// 	</html>
		
	// 	";
		
		
	// }
	
	// else
	// {
		
	// 	echo "
	// 	<html>
	// 		<head>
	// 			<meta http-equiv='REFRESH' content='0 ; url=verImagenes.php'>
	// 			<script >
	// 				alert('No pudo ser eliminada');
	// 			</script>
	// 		</head>
		
	// 	</html>
		
	// 	";
		
	// }
		parent::actionEliminar($id);
	}

}
