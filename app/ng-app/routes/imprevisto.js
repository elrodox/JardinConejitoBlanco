var app = angular.module('routes.imprevisto', ['ngRoute']);

app.config(function($routeProvider) {
    
    $routeProvider
        .when('/imprevisto-gestionar/:id_parvulo', {
            templateUrl : 'ng-app/views/imprevisto/gestionar.html',
            controller  : 'listarImprevistoController',
            controllerAs: 'imprevistoScope'
        })
        .when('/imprevisto-crear/:id_parvulo', {
            templateUrl : 'ng-app/views/imprevisto/crear.html',
            controller  : 'crearImprevistoController',
            controllerAs: 'imprevistoScope'
        })
        .when('/imprevisto-editar/:id_parvulo/:id_imprevisto', {
            templateUrl : 'ng-app/views/imprevisto/editar.html',
            controller  : 'editarImprevistoController',
            controllerAs: 'imprevistoScope'
        })
        .when('/imprevisto-ver/:id_parvulo', {
            templateUrl : 'ng-app/views/imprevisto/ver.html',
            controller  : 'listarImprevistoController',
            controllerAs: 'imprevistoScope'
        });
});