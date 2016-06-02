var app = angular.module('routes.parvulo', ['ngRoute']);

app.config( function($routeProvider) {
    
    $routeProvider
        .when('/parvulo-crear', {
            templateUrl : 'ng-app/views/parvulo/crear.html',
            controller  : 'crearParvuloController',
            controllerAs: 'parvuloScope',
            access: ['admin', 'educadora']
        })
        
        // ruta para parvulo editar
        .when('/parvulo-editar/:id', {
            templateUrl : 'ng-app/views/parvulo/editar.html',
            controller  : 'editarParvuloController',
            controllerAs: 'parvuloScope',
            access: ['admin', 'educadora']
        })
        
        // ruta para parvulo crear editar
        .when('/parvulo-ver/:id', {
            templateUrl : 'ng-app/views/parvulo/ver.html',
            controller  : 'verParvuloController',
            controllerAs: 'parvuloScope',
            access: ['admin', 'educadora']
        })
        
        .when('/parvulo-gestionar', {
            templateUrl : 'ng-app/views/parvulo/gestionar.html',
            controller  : 'listarParvuloController',
            controllerAs: 'parvuloScope',
            access: ['admin', 'educadora']
        })
        
        // .when('/parvulo-eliminar/:id', {
        //     templateUrl : 'ng-app/views/parvulo/eliminar.html',
        //     controller  : 'eliminarParvuloController',
        //     controllerAs: 'parvuloScope',
        //     access: ['admin', 'educadora']
        // })
        

        
        .when('/parvulo-papelera', {
            templateUrl : 'ng-app/views/parvulo/papelera.html',
            controller  : 'listarParvuloController',
            controllerAs: 'parvuloScope',
            access: ['admin', 'educadora']
        })
        .when('/parvulo-activar:id', {
            templateUrl : 'ng-app/views/parvulo/activar.html',
            controller  : 'activarParvuloController',
            controllerAs: 'parvuloScope',
            access: ['admin', 'educadora']
        })
        .when('/hito-seleccionar', {
            templateUrl : 'ng-app/views/hito/seleccionar.html',
            controller  : 'listarParvuloController',
            controllerAs: 'parvuloScope',
            access: ['admin','educadora']
        })
        .when('/imprevisto-seleccionar', {
            templateUrl : 'ng-app/views/imprevisto/seleccionar.html',
            controller  : 'listarParvuloController',
            controllerAs: 'parvuloScope',
            access: ['admin','educadora']
        })
        .when('/parvulo-dashboard/', {
            templateUrl : 'ng-app/views/parvulo/dashboard.html',
            access: ['parvulo']
        });
});



// app.factory('authorizationService', function ($resource, $q, $rootScope, $location) {
//     return {
//         // We would cache the permission for the session,
//         //to avoid roundtrip to server
//         //for subsequent requests

//         permissionModel: {
//             permission: {},
//             isPermissionLoaded: false
//         },

//         permissionCheck: function (roleCollection) {

//             // we will return a promise .
//             var deferred = $q.defer();

//             //this is just to keep a pointer to parent scope from within promise scope.
//             var parentPointer = this;

//             //Checking if permission object(list of roles for logged in user) 
//             //is already filled from service
//             if (this.permissionModel.isPermissionLoaded) {
//                 //Check if the current user has required role to access the route
//                 this.getPermission(this.permissionModel, roleCollection, deferred);
//             } else {
//                 //if permission is not obtained yet, we will get it from  server.
//                 // 'api/permissionService' is the path of server web service , used for this example.

//                 $resource('/api/permissionService').get().$promise.then(function (response) {
//                     //when server service responds then we will fill the permission object
//                     parentPointer.permissionModel.permission = response;

//                     //Indicator is set to true that permission object is filled and 
//                     //can be re-used for subsequent route request for the session of the user
//                     parentPointer.permissionModel.isPermissionLoaded = true;

//                     //Check if the current user has required role to access the route
//                     parentPointer.getPermission(parentPointer.permissionModel, roleCollection, deferred);
//                 });
//             }
//             return deferred.promise;
//         },

//         //Method to check if the current user has required role to access the route
//         //'permissionModel' has permission information obtained from server for current user
//         //'roleCollection' is the list of roles which are authorized to access route
//         //'deferred' is the object through which we shall resolve promise
//         getPermission: function (permissionModel, roleCollection, deferred) {
//             var ifPermissionPassed = false;

//             angular.forEach(roleCollection, function (role) {
//                 switch (role) {
//                     case $rootScope.roles.superUser:
//                         if (permissionModel.permission.isSuperUser) {
//                             ifPermissionPassed = true;
//                         }
//                         break;
//                     case $rootScope.roles.admin:
//                         if (permissionModel.permission.isAdministrator) {
//                             ifPermissionPassed = true;
//                         }
//                         break;
//                     case $rootScope.roles.user:
//                         if (permissionModel.permission.isUser) {
//                             ifPermissionPassed = true;
//                         }
//                         break;
//                     default:
//                         ifPermissionPassed = false;
//                 }
//             });
//             if (!ifPermissionPassed) {
//                 //If user does not have required access, 
//                 //we will route the user to unauthorized access page
//                 $location.path(routeForUnauthorizedAccess);
//                 //As there could be some delay when location change event happens, 
//                 //we will keep a watch on $locationChangeSuccess event
//                 // and would resolve promise when this event occurs.
//                 $rootScope.$on('$locationChangeSuccess', function (next, current) {
//                     deferred.resolve();
//                 });
//             } else {
//                 deferred.resolve();
//             }
//         }
//     };
// });