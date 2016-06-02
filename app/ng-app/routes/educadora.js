var app = angular.module('routes.educadora', ['ngRoute']);

app.config(function($routeProvider) {
    
    $routeProvider
        .when('/educadora-gestionar', {
            templateUrl : 'ng-app/views/educadora/gestionar.html',
            controller  : 'listarEducadoraController',
            access: ['admin']
        })
        .when('/educadora-dashboard', {
            templateUrl : 'ng-app/views/educadora/dashboard.html',
            controller  : 'informacionEducadoraController'
        })
         .when('/educadora-crear', {
            templateUrl : 'ng-app/views/educadora/crear.html',
            controller  : 'crearEducadoraController',
            access: ['admin']
        })
        .when('/educadora-papelera', {
            templateUrl : 'ng-app/views/educadora/papelera.html',
            controller  : 'listarEducadoraController',
            controllerAs: 'educadoraScope',
            access: ['admin']
        })
        .when('/educadora-editar/:id', {
            templateUrl : 'ng-app/views/educadora/editar.html',
            controller  : 'editarEducadoraController',
            controllerAs: 'educadoraScope',
            access: ['admin']
        });
});