<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */

class AuthController extends Controller {
    
    
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }
	//Yii::import('application.modules.user.models.*');
	
	public function accessRules() {
        return array(
            array('allow',
            	'actions' => array('login', 'token', 'passwordRecovery'),
            	'users' => array('*'),
            )
        );
    }
    
    public function actionLogin(){
		if( UsuarioAuth::auth() ){
			$this->sendResponse(UsuarioAuth::getModel());
		}else{
		    $this->sendResponse("Rut o contraseña incorrectos", 401);
		}
	}
	public function actionToken(){
	    
	}
	
	public function actionPasswordRecovery(){
	    //if( isset($_GET['rut']) ) $rut = $_GET['rut'];
	    $rut = $this->bodyRequest()['rut'];
	    if( !isset($rut) ) $this->sendResponse("Falta parametro rut", 500);
	    $error = true;
		$user = Educadora::model()->findByAttributes(array('rut_educadora'=>$rut));
		if($user !== null){
            $error = false;
		}else{
			$user = Parvulo::model()->findByAttributes(array('rut_parvulo'=>$rut));
			if($user !== null){
				$error = false;
			}
		}
		if(!$error){
		    mail(
                $user->email, 
                "Recuperación de Contraseña - Conejito Blanco", 
                "Su contraseña es: ".$user->password, 
                "From: noreply@jardinconejitoblanco.cl");
            $this->sendResponse("OK");
		}else{
			$this->sendResponse("No se encontro el rut ".$rut, 500);
		}
	}
}