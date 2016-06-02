var app = angular.module('routes.hito', ['ngRoute']);

app.config(function($routeProvider) {
    
    $routeProvider
        .when('/hito-gestionar/:id_parvulo', {
            templateUrl : 'ng-app/views/hito/gestionar_hito.html',
            controller  : 'listarHitoController',
            controllerAs: 'hitoScope',
            access: ['admin', 'educadora']
        })
        .when('/hito-crear/:id_parvulo', {
            templateUrl : 'ng-app/views/hito/crear_hito.html',
            controller  : 'crearHitoController',
            controllerAs: 'hitoScope'
        })
        .when('/hito-editar/:id_parvulo/:id_hito', {
            templateUrl : 'ng-app/views/hito/editar_hito.html',
            controller  : 'editarHitoController',
            controllerAs: 'hitoScope'
        })
        .when('/hito-ver/:id_parvulo', {
            templateUrl : 'ng-app/views/hito/ver.html',
            controller  : 'listarHitoController',
            controllerAs: 'hitoScope',
            access: ['admin', 'educadora', 'parvulo']
        });
});