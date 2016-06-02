<?php

class ParvuloController extends Controller
{
	// public function filters() {
 //       return array(
 //           'accessControl',
 //       );
 //   }
    public function actionCrear() {
		$input_params = $this->bodyRequest();
		$rut = $input_params['rut_parvulo'];
		if( !isset($rut) ) $this->sendResponse("Falta parametro rut_parvulo", 500);
		$user = Parvulo::model()->findByAttributes(array('rut_parvulo'=>$rut));
		if($user === null){
			$user = Educadora::model()->findByAttributes(array('rut_educadora'=>$rut));
			if($user === null){
				//$_POST['eliminado'] = 0;
				parent::actionCrear();	
			} 
			else $error = true;
		}else{
			$error = true;
		}
		if($error){
			$msj = "El rut ".$rut." ya existe";
			$this->sendResponse($msj, 500);
		}
	}
	
	// public function actionAsistencia(){
	// 	$fecha = $this->bodyRequest()['fecha'];
	// 	$inasistentes = $this->bodyRequest()['inasistentes'];
	// 	$asistentes = $this->bodyRequest()['presentes'];
		
		
	// 	$asistenciaModel = Asistencia::model()->findByAttributes(
	// 			array('fecha'=>$fecha)
	// 		);
	// 	if($asistenciaModel==null){
	// 		$asistenciaModel = new Asistencia;
	// 		$asistenciaModel->fecha = $fecha;
	// 		if( !$asistenciaModel->save() ) 
	// 			$this->sendResponse("No se pudo guardar asistencia model", 500);
	// 	}
		
	// 	foreach($inasistentes as $inasistente){
	// 		$relacionModel = ParvuloAsistencia::model()->findByAttributes(
	// 			array('id_asistencia'=>$asistenciaModel->id_asistencia,
	// 				  'id_parvulo'=>$inasistente->id_parvulo));
	// 		if($relacionModel!=null){
	// 			$relacionModel->delete(); 
	// 			$asistenciaModel->delete();
	// 		}
	// 	}
	// 	foreach($asistentes as $asistente){
			
	// 		ParvuloAsistencia::model()->findByAttributes(
	// 			array('id_asistencia'=>$asistenciaModel->id_asistencia,
	// 				  'id_parvulo'=>$asistente->id_parvulo));
	// 		if($relacionModel==null){
	// 			$relacionModel = new ParvuloAsistencia;
	// 			$relacionModel->id_asistencia = $asistenciaModel->id_asistencia;
	// 			$relacionModel->id_parvulo = $asistente->id_parvulo;
	// 		}
			
	// 	}
	// 	sendResponse("No se si este bien... verifique en mysql..");
		
		
	// }
	
	// public function actionCrearRelacion($id, $hijo_controller_id) {
	// 	$input_params = $this->bodyRequest();
	// 	$relacionModel = new ParvuloAsistencia;
	// 	$asistenciaModel = Asistencia::model()->findByAttributes(
	// 			array('fecha'=>$input_params['fecha'])
	// 		);
	// 	if($asistenciaModel==null){
	// 		$asistenciaModel = new Asistencia;
	// 		$asistenciaModel->fecha = $input_params['fecha'];
	// 		if( !$asistenciaModel->save() ) 
	// 			$this->sendResponse("No se pudo guardar asistencia model", 500);
	// 	}
	// 	$relacionModel->id_parvulo = $id;
	// 	$relacionModel->id_asistencia = $asistenciaModel->id_asistencia;
	// 	if( $relacionModel->save() ){
	// 		$this->sendResponse("WENA SHORO!");	
	// 	}else{
	// 		$this->sendResponse("No se pudo guardar la relacion parv-asist model", 500);
	// 	}
		
	// 	parent::actionCrear();
	// }

	
	// public function accessRules() {
 //       return array(
 //           array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
 //               'actions' => array(
 //               	'listar', 
 //               	'ver', 
 //               	'actualizar', 
 //               	'eliminar', 
 //               	'crear', 
 //               	'listarRelacion',
 //               	'actualizarRelacion', 
 //               	'eliminarRelacion', 
 //               	'crearRelacion'
 //           	),
 //               'users' => array("*")
 //               // 'users' => array('*'),
 //           ),
 //           array('deny', // deny all users
 //               'users' => array('*'),
 //           ),
 //       );
 //   }
	
	// public function actionListar() {
	// 	parent::actionListar();
	// }
	
	// public function actionVer($id) {
	// 	parent::actionVer($id);
	// }
	
	// public function actionCrear() {
	// 	parent::actionCrear();
	// }
	
	// public function actionActualizar($id){
	// 	parent::actionActualizar($id);	
	// }
	
	// public function actionEliminar($id){
	// 	parent::actionEliminar($id);
	// }

}
