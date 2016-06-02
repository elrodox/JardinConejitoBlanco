<?php

class DocumentoController extends Controller
{
	
	public function actionListar() {
		parent::actionListar();
	}
	
	public function actionVer($id) {
		parent::actionVer($id);
	}
	
	public function actionCrear() {
		if(isset($_FILES['file']['name'])){
			$file_name = $_FILES["file"]["name"];
		
			$base_path = realpath(Yii::app()->getBasePath() . '/../files');
			
			$path = $base_path."/".$file_name;
			if(!is_dir($base_path)) mkdir($base_path,0777);
				
			if( $file_name && move_uploaded_file($_FILES["file"]["tmp_name"],$path) ) {
				$documentoModel = new Documento;
				$documentoModel->nombre = $_POST['name'];
				$documentoModel->link = Yii::app()->getBaseUrl() . "/files/" . $file_name;
				$documentoModel->fecha = $_POST['fecha'];
				if($documentoModel->save()){
					$this->sendResponse($documentoModel);
				}else{
					$this->sendResponse("No se pudo guardar el modelo", 500);
				}
				
			}else{
				$this->sendResponse("No se pudo guardar el archivo", 500);
			}
		}
	}
	
	public function actionActualizar($id){
		parent::actionActualizar($id);	
	}
	
	public function actionEliminar($id){
		parent::actionEliminar($id);
	}

}
