var app = angular.module('routes.noticia', ['ngRoute']);

app.config(function($routeProvider) {
    
    $routeProvider
        .when('/noticia-gestionar', {
            templateUrl : 'ng-app/views/noticia/gestionar.html',
            controller  : 'listarNoticiaController',
            controllerAs: 'noticiaScope',
            access: ['admin', 'educadora']
        })
        .when('/noticia-crear', {
            templateUrl : 'ng-app/views/noticia/crear.html',
            controller  : 'crearNoticiaController',
            controllerAs: 'noticiaScope',
            access: ['admin', 'educadora']
        })
        .when('/noticia-editar/:id', {
            templateUrl : 'ng-app/views/noticia/editar.html',
            controller  : 'editarNoticiaController',
            controllerAs: 'noticiaScope',
            access: ['admin', 'educadora']
        })
        .when('/noticia-listar', {
            templateUrl : 'ng-app/views/noticia/listar.html',
            controller  : 'listarNoticiaController'
        });
});