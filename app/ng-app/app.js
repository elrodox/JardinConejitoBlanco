var app = angular.module('conejitoBlanco', 
    [
        'ngRoute', 
        'ngResource', 
        'ui.bootstrap', 
        'ngStorage',
        
        'routes.asistencia',
        'routes.usuario',
        'routes.paginas', 
        'routes.parvulo', 
        'routes.educadora', 
        'routes.documento', 
        'routes.noticia', 
        'routes.galeria',
        'routes.hito',
        'routes.imprevisto',
        
        'controllers.asistencia',
        'controllers.usuario',
        'controllers.parvulo', 
        'controllers.educadora', 
        'controllers.documento', 
        'controllers.noticia', 
        'controllers.galeria',
        'controllers.hito',
        'controllers.imprevisto'
    ]);


app.controller('appController', function($scope, $locationProvider) {
    $scope.message = 'hola, soy el message de appController';
    $scope.bigData = {};
    $scope.bigData.breakfast = false;
    $scope.bigData.lunch = false;
    $scope.bigData.dinner = false;
    $scope.path = $locationProvider.path();
    
});
app.controller('alertController', function($scope, alertService){
    console.log("alertcontroller...");
    $scope.alerts = alertService.alerts;
    
    $scope.closeAlert = function(index) {
        alertService.closeAlert(index);
    };
});

app.factory('alertService', function () {        
    var alertService= {  
        alerts: [],
        addAlert: function (type, msg) {
            this.alerts.push({type: type, msg: msg});
        },
        closeAlert: function(index) {
            this.alerts.splice(index, 1);
        }
    };
    return alertService;
});

app.factory('fechaActualService', function(){
    return {
        get : function(){
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth()+1; //January is 0!
            var yyyy = today.getFullYear();
            
            if(dd<10) {
                dd='0'+dd
            } 
            
            if(mm<10) {
                mm='0'+mm
            } 
            
            return yyyy+'-'+mm+'-'+dd;
        },
        format : function(date){
            var today = date;
            var dd = today.getDate();
            var mm = today.getMonth()+1; //January is 0!
            var yyyy = today.getFullYear();
            
            if(dd<10) {
                dd='0'+dd
            } 
            
            if(mm<10) {
                mm='0'+mm
            } 
            
            return yyyy+'-'+mm+'-'+dd;
        }
    }
});




app.directive('navbar', function() {
  return {
    templateUrl: 'ng-app/views/widgets/navbar.html'
  };
});

app.directive('header', function() {
  return {
    templateUrl: 'ng-app/views/widgets/header.html'
  };
});

app.directive('widget.enlaces.interes', function() {
  return {
    templateUrl: 'ng-app/views/widgets/enlaces_interes.html'
  };
});

app.directive('pagina.inicio', function() {
  return {
    templateUrl: 'ng-app/views/paginas/inicio.html'
  };
});

app.directive('menu.educadora', function() {
  return {
    templateUrl: 'ng-app/views/widgets/menu_educadora.html'
  };
});

app.directive('menu.parvulo', function() {
  return {
    templateUrl: 'ng-app/views/widgets/menu_parvulo.html'
  };
});

app.directive('login', function() {
  return {
    templateUrl: 'ng-app/views/widgets/login.html'
  };
});


app.directive('history-back', function() {
  return {
    link: function(scope, element, attrs) {
        element.on('click', function() {
            window.history.back();
        });
    }
  };
});



app.directive('access', function($rootScope, $localStorage){
    return {
        restrict: 'A',
        link: function (scope, element, attrs) {
            var makeVisible = function () {
                    element.removeClass('hidden');
                },
                makeHidden = function () {
                    element.addClass('hidden');
                },
                determineVisibility = function (resetFirst) {
                    //var result;
                    if (resetFirst) {
                        makeVisible();
                    }
                    var tienePermiso = false;
                    var currentUser = $localStorage.currentUser;
                    if(currentUser!=undefined){
                        for (var i = 0; i < roles.length; i++) {
                            switch(roles[i]){
                                case $rootScope.roles.admin:
                                    if (currentUser.isAdmin) tienePermiso=true;
                                    break;
                                case $rootScope.roles.educadora:
                                    if (currentUser.isEducadora) tienePermiso=true;
                                    break;
                                case $rootScope.roles.parvulo:
                                    if (currentUser.isParvulo) tienePermiso=true;
                            }
                        }
                    }
                    if( tienePermiso ) makeVisible();
                    else makeHidden();
                    
                },
                roles = attrs.access.split(',');
            if (roles.length > 0) {
                determineVisibility(true);
            }
        }
    }; 
});


app.run(['$rootScope', '$location' , '$localStorage', function($rootScope, $location, $localStorage) {
    $rootScope.$storage = $localStorage;
    $rootScope.location = $location;
    var roles = {
        admin: 'admin',
        educadora: 'educadora',
        parvulo: 'parvulo',
        logged: 'logged'
    };
    $rootScope.roles = roles;

    $rootScope.$on( "$routeChangeStart", function(event, next, current) {
        if(next===undefined) return;
        if(next.access!==undefined && next.access.length>0){
            var currentUser = $localStorage.currentUser;
            if(currentUser==undefined){
                $location.path("/no-autorizado");
            }else{
                var tienePermiso = false;
                for (var i = 0; i < next.access.length; i++) {
                    switch(next.access[i]){
                        case $rootScope.roles.admin:
                            if (currentUser.isAdmin) tienePermiso=true;
                            break;
                        case $rootScope.roles.educadora:
                            if (currentUser.isEducadora) tienePermiso=true;
                            break;
                        case $rootScope.roles.parvulo:
                            if (currentUser.isParvulo) tienePermiso=true;
                            break;
                        case $rootScope.roles.logged:
                            if ($localStorage.isLogged) tienePermiso=true;
                    }
                }
                if( !tienePermiso ) $location.path("/no-autorizado");
                // next.access.forEach(function(e){
                //     switch(e){
                //         case $rootScope.roles.admin:
                //             if (!currentUser.isAdmin) $location.path("/login");
                //             break;
                //         case $rootScope.roles.educadora:
                //             if (!currentUser.isEducadora) $location.path("/login");
                //             break;
                //         case $rootScope.roles.parvulo:
                //             if (!currentUser.isParvulo) $location.path("/login"); 
                //     }
                // });
            }
        } 
    });
    
}]);

// app.config(function($routeProvider) {
    
    
        
// });

// angular.module('myApp')
//     .config(function($urlRouterProvider, $stateProvider, $httpProvider,
//                      routerConfig, httpInterceptorConfig) {
//         routerConfig($urlRouterProvider, $stateProvider);
//         httpInterceptorConfig($httpProvider);
//     });

// // routerConfig.js
// angular.module('myApp')
//     .constant('routerConfig', function($urlRouterProvider, $stateProvider) {
//         ...
//     });
// });

// // httpInterceptorConfig.js
// angular.module('myApp')
//     .constant('httpInterceptorConfig', function($httpProvider) {          
//         ...
//     });
// });