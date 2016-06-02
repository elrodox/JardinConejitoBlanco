var app = angular.module('routes.paginas', ['ngRoute']);
app.config(function($routeProvider) {
    $routeProvider
        // route for the home page
        .when('/', {
            templateUrl : 'ng-app/views/paginas/inicio.html'
        })
        //ruta para galeria
        .when('/galeria', {
            templateUrl : 'ng-app/views/paginas/galeria.html',
            controller  : 'listarFotoController'
        })
        //ruta para mision vision pagina
        .when('/mision-vision', {
            templateUrl : 'ng-app/views/paginas/mision_vision.html'
        })
        //ruta para Quienes Somos pagina
        .when('/quienes-somos', {
            templateUrl : 'ng-app/views/paginas/quienes_somos.html'
        })
        // ruta para Organigrama pagina
        .when('/organigrama', {
            templateUrl : 'ng-app/views/paginas/organigrama.html'
        })
        //ruta para Proyecto Educativo pagina
        .when('/proyecto-educativo', {
            templateUrl : 'ng-app/views/paginas/proyecto_educativo.html'
        })
        //ruta para Planes de Emergencia pagina
        .when('/planes-emergencia', {
            templateUrl : 'ng-app/views/paginas/planes_emergencia.html'
        })
        //ruta para Experiencia Pedagogica pagina
        .when('/experiencia-pedagogica', {
            templateUrl : 'ng-app/views/paginas/experiencia_pedagogica.html'
        })
        
        //ruta para centro de padres
        .when('/centro-padres', {
            templateUrl : 'ng-app/views/paginas/centro_padres.html'
        })
         //ruta para centro de padres
        .when('/niveles-educativos', {
            templateUrl : 'ng-app/views/paginas/niveles_educativos.html'
        })
        
        //ruta para Contacto y Ubicacion pagina
        .when('/contacto-ubicacion', {
            templateUrl : 'ng-app/views/paginas/contacto_ubicacion.html'
        });
});



