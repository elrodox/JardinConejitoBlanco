var app = angular.module('routes.asistencia', ['ngRoute']);

app.config(function($routeProvider) {
    $routeProvider
        // .when('/asistencia-gestionar', {
        //     templateUrl : 'ng-app/views/asistencia/gestionar_asistencia.html',
        //     controller  : 'gestionarAsistenciaController',
        //     access: ['admin', 'educadora']
        // })
        .when('/asistencia-registrar', {
            templateUrl : 'ng-app/views/asistencia/registrar_asistencia.html',
            access: ['admin', 'educadora']
        })
        .when('/asistencia-ver/:id_parvulo', {
            templateUrl : 'ng-app/views/asistencia/ver_asistencia.html',
            controller  : 'listarAsistenciaController',
            controllerAs: 'asistenciaScope',
            access: ['admin', 'educadora', 'parvulo']
        });
        
});
