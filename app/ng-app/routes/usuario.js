var app = angular.module('routes.usuario', ['ngRoute']);

app.config(function($routeProvider) {
    
    $routeProvider
        .when('/password-recovery', {
            templateUrl : 'ng-app/views/usuario/password-recovery.html',
            controller  : 'UsuarioController',
            controllerAs: 'usuarioScope'
        })
        .when('/no-autorizado', {
            templateUrl : 'ng-app/views/usuario/no_autorizado.html'
        })
        .when('/cambio-password', {
            templateUrl : 'ng-app/views/usuario/cambio_password.html',
            controller:'cambioContrasenaController'
        })
        .when('/cambio-mail', {
            templateUrl : 'ng-app/views/usuario/cambio_mail.html',
            controller:'cambioMailController'
        });
        
});
