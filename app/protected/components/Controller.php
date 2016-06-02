<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */

class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	// public function filters() {
 //       return array(
 //           'accessControl', // perform access control for CRUD operations
 //       );
 //   }
	// //Yii::import('application.modules.user.models.*');
	
	// public function accessRules() {
 //       return array(
 //           array('allow',
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
 //           	// 'expression' => "UsuarioAuth::auth()",
 //           	// 'expression' => "UsuarioAuth::auth() and UsuarioAuth::isParvulo()",
 //           	// 'expression' => "UsuarioAuth::auth() and UsuarioAuth::isEducadora()",
 //            //   'expression' => "UsuarioAuth::auth() and UsuarioAuth::isAdmin()",
 //            	'users' => array('*'),
 //               'deniedCallback' => array('Controller', 'sendNotAuthorizedError')
                
 //           ),
 //           array('deny', // deny all users
 //               'users' => array('*'),
 //               'deniedCallback' => array('Controller', 'sendNotAuthorizedError'),
 //           ),
 //       );
        
 //   }
	
	// protected function beforeAction($event) {
 //       $conf = new CensoConfig;
 //       $conf->configurar();
 //       return true;
 //   }

	// ------------ CRUD MODEL

	public function actionListar() {
		$model = $this->getCurrentModel()->findAll();
		$this->sendResponse($model);
	}

	public function actionVer($id) {
		$model=$this->loadModel($id);
		$this->sendResponse($model);
	}
	
	public function actionCrear() {
		$input_params = $this->bodyRequest();
		// if($input_params==null){
		//  	$input_params = $_POST;
		// }
		
		$model = $this->newModel();
		
		if(isset($input_params) || $input_params!=null) {
			$model->attributes=$input_params;
			if( Yii::app()->controller->id == "foto" ){
				$model->link = $_POST['link'];
			}
			//$this->sendResponse($model);
			if($model->save()){
				//$this->sendResponse( [ "rut_parvulo" => $model->rut_parvulo ] );
				$this->sendResponse($model->getPrimaryKey() );
			}
			else{
				$this->sendResponse("No se pudo guardar el modelo (ayuda: debe faltar un parámetro)", 500);
				//echo "no se pudo guardar el modelo";
			}
		}else{
			//echo CJSON::encode($input_params);
			$this->sendResponse('No se recibieron parametros', 500);
			//echo "no se recibió el parametro 'parvulo'";
		}
	}

	public function actionActualizar($id)
	{
		$input_params = $this->bodyRequest();
		if($input_params==null){
		 	$input_params = $_POST;
		}
		
		$model=$this->loadModel($id);
		if(isset($input_params) || $input_params==null) {
			$model->attributes=$input_params;
			//$this->sendResponse($model);
			if($model->save()){
				//$this->sendResponse( [ "rut_parvulo" => $model->rut_parvulo ] );
				$this->sendResponse('OK');
			}
			else{
				$this->sendResponse('No se pudo guardar el modelo', 500);
				//echo "no se pudo guardar el modelo";
			}
		}else{
			// echo CJSON::encode($input_params);
			$this->sendResponse('No se recibieron parametros', 500);
			//echo "no se recibió el parametro 'parvulo'";
		}
		
	}

	public function actionEliminar($id)
	{
		$this->loadModel($id)->delete();
		$this->sendResponse('OK');
	}
	
	// ------------ FIN CRUD MODEL
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	// ------------ CRUD RELACIONES
	
	// LISTAR
	// public function actionHitos($id){
	// 	$model = $this->loadModel($id);
	// 	$this->sendResponse($model->hitos);
	// }
	public function actionListarRelacion($id, $hijo_controller_id){
		$nombre_arreglo_de_hijos = $hijo_controller_id.'s';
		$modelo_hijo = $this->loadModel($id)->{$nombre_arreglo_de_hijos};
		$this->sendResponse($modelo_hijo);
	}
	
	
	// CREAR
	public function actionCrearRelacion($id, $hijo_controller_id){
		$modelo_padre = $this->loadModel($id);
		$nombre_clase_modelo_hijo = ucfirst($hijo_controller_id);
		//$this->sendResponse($hijo_controller_id);
		
		// creando modelo hijo. Si el modelo hijo es asistencia, se obtiene el record con la misma fecha, sino se crea el modelo
		if( $hijo_controller_id=='asistencia' ){
			$modelo_hijo = $this->getModelByControllerId($hijo_controller_id)->findByAttributes(
				array('fecha'=>$this->bodyRequest()['fecha'])
			);
			if($modelo_hijo==null){
				$modelo_hijo = new $nombre_clase_modelo_hijo();				
			}
		}else{
			$modelo_hijo = new $nombre_clase_modelo_hijo();
		}
		
		//agregando atributos al modelo hijo
		$modelo_hijo->attributes = $this->bodyRequest();
			// si es una relacion HAS_MANY, se agrega el valor fk en el modelo hijo
		if( $this->isHasMany($modelo_padre, $modelo_hijo) )
			$modelo_hijo->{$modelo_padre->tableSchema->primaryKey} = $id;
		
		// si guarda modelo hijo
		if( $modelo_hijo->save() ){
			// se agrega el hijo al padre
			$nombre_arreglo_de_hijos = $hijo_controller_id.'s';
			$modelo_padre->{$nombre_arreglo_de_hijos} = 
					array_merge(
						$modelo_padre->{$nombre_arreglo_de_hijos},
						array($modelo_hijo)
					);
			// si se guarda el padre
			if( $modelo_padre->save() ){
				// todo ok, enviamos la pk del hijo.
				$this->sendResponse($modelo_hijo->getPrimaryKey());
			}
			else{
				$this->sendResponse("No se pudo guardar el modelo padre", 500);
			}
		}else{
			$this->sendResponse("No se pudo guardar el modelo hijo", 500);
		}
	}
	
	// ACTUALIZAR
	public function actionActualizarRelacion($id, $hijo_controller_id, $hijo_id){
		$modelo_padre = $this->loadModel($id);
		$modelo_hijo = $this->getModelByControllerId($hijo_controller_id)->findByPk($hijo_id);
		if( $this->isHasMany($modelo_padre, $modelo_hijo) ){
			// Yii::import('application.controllers.SiteController');
   //             $obj = new SiteController(); 
   //             $obj->actionSitetest();
   			$controller_hijo = Yii::app()->createController(
   					ucfirst($hijo_controller_id))[0];
			$controller_hijo->actionActualizar($hijo_id);
		}else{
			
			$this->sendResponse("Controller.php:170. FALTA ESTE METODO LOCO!", 500);
		}
	}
	
	// ELIMINAR
	public function actionEliminarRelacion($id, $hijo_controller_id, $hijo_id){
		$modelo_padre = $this->loadModel($id);
		$modelo_hijo = $this->getModelByControllerId($hijo_controller_id)->findByPk($hijo_id);
		
		if( $this->isHasMany($modelo_padre, $modelo_hijo) ){
   			$controller_hijo = Yii::app()->createController(
   					ucfirst($hijo_controller_id))[0];
			$controller_hijo->actionEliminar($hijo_id);
		}else{
			$nombre_clase_modelo_hijo = ucfirst($hijo_controller_id);
			$nombre_clase_modelo_padre= ucfirst( $this->id );
			$nombre_clase_modelo_relacion = $nombre_clase_modelo_padre.$nombre_clase_modelo_hijo;
			$modelo_estatico_relacion = $this->loadModelByName($nombre_clase_modelo_relacion);
			
			if(
				$modelo_estatico_relacion->deleteByPk( 
					array( 
						$modelo_padre->tableSchema->primaryKey => $modelo_padre->getPrimaryKey(),
						$modelo_hijo->tableSchema->primaryKey  => $modelo_hijo->getPrimaryKey()
					) 
				)
			){
				$otras_relaciones = $modelo_estatico_relacion->findByAttributes(
					array($modelo_hijo->tableSchema->primaryKey  => $modelo_hijo->getPrimaryKey())
				);
				if($otras_relaciones==null){
					if( $modelo_hijo->delete() ){
						$this->sendResponse("OK");
					}else{
						$this->sendResponse("No se pudo eliminar el modelo hijo", 500);
					}
				}else{
					$this->sendResponse("OK");
				}
				
			}else{
				$this->sendResponse("No se pudo eliminar el modelo relacion", 500);
			}
			
			
		}
	}
	
	// ------------ FIN CRUD RELACIONES
	
	
	private function isHasMany($modelo_padre, $modelo_hijo){
		return $modelo_hijo->hasAttribute($modelo_padre->tableSchema->primaryKey);
	}

	// MODEL
	protected function loadModel($id)
	{
		$model=$this->getCurrentModel()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	protected function getModelByControllerId($controller_id){
		$model_class_name = ucfirst($controller_id);
		$model = call_user_func($model_class_name.'::model');
		return $model;
	}
	protected function getCurrentModel(){
		//$model_class = ucfirst( Yii::app()->controller );
		$model_class_name = ucfirst( $this->id );
		$model = call_user_func($model_class_name.'::model');
		return $model;
	}
	protected function loadModelByName($model_class_name){
		$model = call_user_func($model_class_name.'::model');
		return $model;
	}
	protected function newModel(){
		$model_class_name = ucfirst( $this->id );
		return new $model_class_name();
	}
	//FIN MODEL
	
	
	
	
	
	
	
	
	/**
	 * Send raw HTTP response
	 * @param int $status HTTP status code
	 * @param string $body The body of the HTTP response
	 * @param string $contentType Header content-type
	 * @return HTTP response 
	 */
	protected function sendResponse($body = '', $status = 200, $contentType = 'application/json')
	{
		// Set the status
		$statusHeader = 'HTTP/1.1 ' . $status . ' ' . $this->getStatusCodeMessage($status);
		header($statusHeader);
		// Set the content type
		//header('Content-type: ' . $contentType);
		header('Content-type: application/json');
	 
		echo CJSON::encode($body);
		Yii::app()->end();
	}
	
	protected function bodyRequest(){
		return CJSON::decode(file_get_contents('php://input'));
	}
	
	public static function sendNotAuthorizedError(){
		$status = 401;
		$body = "No te has logeado correctamente, o no tienes permiso para ver esta informacion";
		$statusHeader = 'HTTP/1.1 ' . $status . ' ' . Controller::getStatusCodeMessage($status);
		header($statusHeader);
		header('Content-type: application/json');
	 
		echo CJSON::encode($body);
		Yii::app()->end();
	}
	// protected function authRequest(){
	// 	if( isset($_GET['user']) && isset($_GET['pass'])){
	// 		return array($_GET['user'], $_GET['pass']);
	// 	}else if( isset($this->bodyRequest()['auth']) ) return $this->bodyRequest()['auth'];
	// 	else return null;
	// }
	
	/**
	 * Return the http status message based on integer status code
	 * @param int $status HTTP status code
	 * @return string status message
	 */
	protected static function getStatusCodeMessage($status)
	{
	    $codes = array(
			100 => 'Continue',
			101 => 'Switching Protocols',
			200 => 'OK',
			201 => 'Created',
			202 => 'Accepted',
			203 => 'Non-Authoritative Information',
			204 => 'No Content',
			205 => 'Reset Content',
			206 => 'Partial Content',
			300 => 'Multiple Choices',
			301 => 'Moved Permanently',
			302 => 'Found',
			303 => 'See Other',
			304 => 'Not Modified',
			305 => 'Use Proxy',
			306 => '(Unused)',
			307 => 'Temporary Redirect',
			400 => 'Bad Request',
			401 => 'Unauthorized',
			402 => 'Payment Required',
			403 => 'Forbidden',
			404 => 'Not Found',
			405 => 'Method Not Allowed',
			406 => 'Not Acceptable',
			407 => 'Proxy Authentication Required',
			408 => 'Request Timeout',
			409 => 'Conflict',
			410 => 'Gone',
			411 => 'Length Required',
			412 => 'Precondition Failed',
			413 => 'Request Entity Too Large',
			414 => 'Request-URI Too Long',
			415 => 'Unsupported Media Type',
			416 => 'Requested Range Not Satisfiable',
			417 => 'Expectation Failed',
			500 => 'Internal Server Error',
			501 => 'Not Implemented',
			502 => 'Bad Gateway',
			503 => 'Service Unavailable',
			504 => 'Gateway Timeout',
			505 => 'HTTP Version Not Supported',
	    );
	    return (isset($codes[$status])) ? $codes[$status] : '';
	}
	
	
}