<?php

class EducadoraController extends Controller
{
	
	public function actionListar() {
		parent::actionListar();
	}
	
	public function actionVer($id) {
		parent::actionVer($id);
	}
	
	public function actionCrear() {
		$input_params = $this->bodyRequest();
		$rut = $input_params['rut_educadora'];
		if( !isset($rut) ) $this->sendResponse("Falta parametro rut_educadora", 500);
		$user = Educadora::model()->findByAttributes(array('rut_educadora'=>$rut));
		if($user === null){
			$user = Parvulo::model()->findByAttributes(array('rut_parvulo'=>$rut));
			if($user === null){
				$_POST['eliminado'] = 0;
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
	
	public function actionActualizar($id){
		parent::actionActualizar($id);	
	}
	
	public function actionEliminar($id){
		parent::actionEliminar($id);
	}

}
