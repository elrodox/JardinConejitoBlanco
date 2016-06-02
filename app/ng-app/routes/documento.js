var app = angular.module('routes.documento', ['ngRoute']);

app.config(function($routeProvider) {
    
    $routeProvider
        .when('/documento-gestionar', {
            templateUrl : 'ng-app/views/documento/gestionar.html',
            controller  : 'listarDocumentoController',
            access: ['admin', 'educadora']
        })
        .when('/documento-crear', {
            templateUrl : 'ng-app/views/documento/crear.html',
            controller  : 'crearDocumentoController',
            access: ['admin', 'educadora']
        }) 
        .when('/documento-editar/:id_documento', {
            templateUrl : 'ng-app/views/documento/editar.html',
            controller  : 'editarDocumentoController',
            access: ['admin', 'educadora']
        })
        .when('/ver-documentos', {
            templateUrl : 'ng-app/views/documento/ver.html',
            controller  : 'listarDocumentoController',
            access: ['admin', 'educadora', 'parvulo']
        });
        
        
});
