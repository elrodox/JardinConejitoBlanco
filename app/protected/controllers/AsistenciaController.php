<?php

class AsistenciaController extends Controller
{
	

	
	public function actionListar() {
		parent::actionListar();
	}
	
	public function actionVer($id) {
		parent::actionVer($id);
	}
	
	// public function actionGetId(){
	// 	// $this->sendResponse($this->bodyRequest(), 500);
	// 	$fecha = $this->bodyRequest()['fecha'];
	// 	if(!isset($fecha)) $this->sendResponse("No se recibio parametro fecha", 500);
		
	// 	$asistenciaModel = Asistencia::model()->findByAttributes( array('fecha'=>$fecha) );
	// 	if($asistenciaModel!=null){
	// 		$this->sendResponse($asistenciaModel);
	// 	}else{
	// 		$asistenciaModel = new Asistencia;
	// 		$asistenciaModel->fecha = $fecha;
	// 		if ($asistenciaModel->save())
	// 			$this->sendResponse($asistenciaModel);
	// 		else
	// 			$this->sendResponse("[AsistenciaController.php:30] No se pudo guardar modelo", 500);
	// 	}
	// }
	public function actionRegistrarParvulos(){
		$params = $this->bodyRequest();
		$parvulos = $params['parvulos'];
		$fecha = $params['fecha'];
		
		$asistenciaModel = Asistencia::model()->findByAttributes(
				array('fecha'=>$fecha)
			);
		if($asistenciaModel==null){
			$asistenciaModel = new Asistencia;
			$asistenciaModel->fecha = $fecha;
			if( !$asistenciaModel->save() ) 
				$this->sendResponse("No se pudo guardar asistencia model", 500);
		}
		$error = false;
		foreach($parvulos as $parvulo){
			$id_parvulo_errores = array();
			$relacionModel = ParvuloAsistencia::model()->findByAttributes(
					array('id_asistencia'=>$asistenciaModel->id_asistencia,
						  'id_parvulo'=>$parvulo['id_parvulo']));
						  
			if( $parvulo['presente'] == "1" && $relacionModel==null){
				$relacionModel = new ParvuloAsistencia;
				$relacionModel->id_asistencia = $asistenciaModel->id_asistencia;
				$relacionModel->id_parvulo = $parvulo['id_parvulo'];
				if( !$relacionModel->save() ) {
					$error = true;
					$id_parvulo_errores[] = $parvulo['id_parvulo'];
				}
				
			}else if($parvulo['presente'] == "0" && $relacionModel!=null){
				$relacionModel->delete();
				$hayOtraRelacion = ParvuloAsistencia::model()->findByAttributes( 
					array('id_asistencia'=>$asistenciaModel->id_asistencia) );
				if( $hayOtraRelacion == null) $asistenciaModel->delete();	
			}
		}
		if(!$error) {
			$this->sendResponse("OK");
		}else{
			$this->sendResponse(array( "mensaje" => "No se pudieron guardar los siguientes ids_parvulo", 
									   "ids_parvulos" => $id_parvulo_errores ), 500);
		}
		
		
	}
		
	public function actionGetParvulos(){
		$fecha = $this->bodyRequest()['fecha'];
		if(!isset($fecha)) $this->sendResponse("No se recibio parametro fecha", 500);
		
		$asistenciaModel = Asistencia::model()->findByAttributes( array('fecha'=>$fecha) );
		
		// $ids_parvulos = ParvuloAsistencia::model()->findByAttributes( array('id_asistencia' => $asistenciaModel->id_asistencia) );
		// $parvulos = Parvulo::model()->findByAttributes([]);
		
		if($asistenciaModel!=null){
			$this->sendResponse($asistenciaModel->parvulos);
			
		}else{
			// $asistenciaModel = new Asistencia;
			// $asistenciaModel->fecha = 
			$this->sendResponse(array());
		}
	}
	
	
	public function actionActualizar($id){
		parent::actionActualizar($id);	
	}
	
	public function actionEliminar($id){
		parent::actionEliminar($id);
	}
	

	
}
