<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Jardin Conejito Blanco',

	// preloading 'log' component
	'preload' => array('log'),
	
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*'
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'paulogay123456!',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1', $_SERVER['REMOTE_ADDR']),
		),
		
	),

	// application components
	'components'=>array(
		// 'user'=>array(
		// 	// enable cookie-based authentication
		// 	'allowAutoLogin'=>false,
		// ),
		// uncomment the following to enable URLs in path-format

   //     'urlManager'=>array(
			// 'urlFormat'=>'path',
			// 'rules'=> array( 
   //             array('parvulo/index',  'pattern' => 'api/parvulos', 'verb' => 'GET', 'parsingOnly' => true),
   //             array('parvulo/create', 'pattern' => 'api/parvulo', 'verb' => 'POST', 'parsingOnly' => true),
   //             array('parvulo/view',   'pattern' => 'api/parvulo/<rut_parvulo>', 'verb' => 'GET', 'parsingOnly' => true),
   //             array('parvulo/view',   'pattern' => 'api/parvulo/ver/<nombre>', 'verb' => 'GET', 'parsingOnly' => true),
   //             array('parvulo/update', 'pattern' => 'api/parvulo/<rut_parvulo>', 'verb' => 'PUT', 'parsingOnly' => true),
   //             array('parvulo/delete', 'pattern' => 'api/parvulo/<rut_parvulo>', 'verb' => 'DELETE', 'parsingOnly' => true),
   //         ),
   //         'showScriptName'=>false,
   //     ),
   
   		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				array('<controller>/ver'	,		'pattern'=>'api/<controller:\w+>/<id:\d+>'	,	'verb'=>'GET'),
				array('<controller>/listar'	,		'pattern'=>'api/<controller:\w+>'			,	'verb'=>'GET'),
				array('<controller>/crear'	,		'pattern'=>'api/<controller:\w+>'			,	'verb'=>'POST'),
				array('<controller>/actualizar'	,	'pattern'=>'api/<controller:\w+>/<id:\d+>'	,	'verb'=>'PUT'),
				array('<controller>/eliminar'	,	'pattern'=>'api/<controller:\w+>/<id:\d+>'	,	'verb'=>'DELETE'),
				
				// CRUD RELACIONES
				//array('parvulo/verRelacion'	,		'pattern'=>'parvulo/<id:\d+>/<hijo_controller_id:\w+>/<id_hijo:\d+>',	'verb'=>'GET'),  // VER NO ES NECESARIO AQUI
				array('<controller>/listarRelacion'	,		'pattern'=>'api/<controller:\w+>/<id:\d+>/<hijo_controller_id:\w+>',	'verb'=>'GET'),
				array('<controller>/crearRelacion'	,		'pattern'=>'api/<controller:\w+>/<id:\d+>/<hijo_controller_id:\w+>',	'verb'=>'POST'),
				array('<controller>/actualizarRelacion',	'pattern'=>'api/<controller:\w+>/<id:\d+>/<hijo_controller_id:\w+>/<hijo_id:\d+>',	'verb'=>'PUT'),
				array('<controller>/eliminarRelacion'	,	'pattern'=>'api/<controller:\w+>/<id:\d+>/<hijo_controller_id:\w+>/<hijo_id:\d+>',	'verb'=>'DELETE'),
				
				
				// array('educadora/ver'	,	'pattern'=>'educadora/<id:\d+>'	,	'verb'=>'GET'),
				// array('educadora/listar'	,	'pattern'=>'educadora'			,	'verb'=>'GET'),
				// array('educadora/crear'	,	'pattern'=>'educadora'				,	'verb'=>'POST'),
				// array('educadora/actualizar'	,	'pattern'=>'educadora/<id:\d+>'		,	'verb'=>'PUT'),
				// array('educadora/eliminar'	,	'pattern'=>'educadora/<id:\d+>'		,	'verb'=>'DELETE'),
				
				
				// array('noticia/ver'	,	'pattern'=>'noticia/<id:\d+>'	,	'verb'=>'GET'),
				// array('noticia/listar'	,	'pattern'=>'noticia/'			,	'verb'=>'GET'),
				// array('noticia/crear'	,	'pattern'=>'noticia'				,	'verb'=>'POST'),
				// array('noticia/actualizar'	,	'pattern'=>'noticia/<id:\d+>'		,	'verb'=>'PUT'),
				// array('noticia/eliminar'	,	'pattern'=>'noticia/<id:\d+>'		,	'verb'=>'DELETE'),
				
				// array('asistencia/ver'	,	'pattern'=>'asistencia/<id:\d+>'	,	'verb'=>'GET'),
				// array('asistencia/listar'	,	'pattern'=>'asistencia/'			,	'verb'=>'GET'),
				// array('asistencia/crear'	,	'pattern'=>'asistencia'				,	'verb'=>'POST'),
				// array('asistencia/actualizar'	,	'pattern'=>'asistencia/<id:\d+>'		,	'verb'=>'PUT'),
				// array('asistencia/eliminar'	,	'pattern'=>'asistencia/<id:\d+>'		,	'verb'=>'DELETE'),
				
				// array('imprevisto/ver'	,	'pattern'=>'imprevisto/<id:\d+>'	,	'verb'=>'GET'),
				// array('imprevisto/listar'	,	'pattern'=>'imprevisto/'			,	'verb'=>'GET'),
				// array('imprevisto/crear'	,	'pattern'=>'imprevisto'				,	'verb'=>'POST'),
				// array('imprevisto/actualizar'	,	'pattern'=>'imprevisto/<id:\d+>'		,	'verb'=>'PUT'),
				// array('imprevisto/eliminar'	,	'pattern'=>'imprevisto/<id:\d+>'		,	'verb'=>'DELETE'),
				
				// array('hito/ver'	,	'pattern'=>'hito/<id:\d+>'	,	'verb'=>'GET'),
				// array('hito/listar'	,	'pattern'=>'hito/'			,	'verb'=>'GET'),
				// array('hito/crear'	,	'pattern'=>'hito'				,	'verb'=>'POST'),
				// array('hito/actualizar'	,	'pattern'=>'hito/<id:\d+>'		,	'verb'=>'PUT'),
				// array('hito/eliminar'	,	'pattern'=>'hito/<id:\d+>'		,	'verb'=>'DELETE'),
				
				
				'<controller:\w+>/<id:\d+>'				=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'			=>'<controller>/<action>',
			),
		),
        
		// 'urlManager'=>array(
		// 	'urlFormat'=>'path',
		// 	'rules'=>array(
		// 		'<controller:\w+>/<id:\d+>'=>'<controller>/view',
		// 		'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
		// 		'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
		// 	),
		// ),
		
		// 'db'=>array(
		// 	'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		// ),
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=jardin',
			'emulatePrepare' => true,
			'username' => 'elrodox',
			'password' => '',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);