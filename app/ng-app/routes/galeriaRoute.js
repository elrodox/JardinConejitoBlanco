var app = angular.module('routes.galeria', ['ngRoute']);

app.config(function($routeProvider) {
    
    $routeProvider
        .when('/galeria-gestionar', {
            templateUrl : 'ng-app/views/galeria/gestionar_galeria.html',
            controller  : 'listarFotoController',
            access: ['admin', 'educadora']
        })
        .when('/galeria-editar/:id', {
            templateUrl : 'ng-app/views/galeria/editar_galeria.html',
            controller  : 'editarFotoController',
            access: ['admin', 'educadora']
        })
        
        .when('/galeria-crear', {
            templateUrl : 'ng-app/views/galeria/crear_galeria.html',
            controller  : 'crearGaleriaController',
            access: ['admin', 'educadora']
        });
        
});