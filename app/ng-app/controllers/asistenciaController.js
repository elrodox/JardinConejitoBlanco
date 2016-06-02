var app = angular.module('controllers.asistencia', ['ngRoute', 'ngStorage', 'ngAnimate', 'toaster']);

app.controller('registrarAsistenciaController', function($scope, $http, $location, toaster, fechaActualService){
    $scope.parvulos = [];
    $scope.parvulosPresentes = [];
    
    console.log("hola");
    
    $scope.dt = new Date();
    $scope.maxDate = new Date();
    
    $scope.$watch('dt', function() {
        console.log($scope.dt);
        //if ($scope.dt == null) $scope.dt = fechaActualService.get();
        verificarAsistencia();
        
    });
    
    
    $http.get('index.php/api/parvulo/')
        .success(function(respuesta){
            console.log("[13] Respuesta:", respuesta);
            $scope.parvulos = respuesta;
            //verificarAsistencia();
        })
        .error(function(respuesta) {
                console.log('Error: ', respuesta);
        });
    
    var verificarAsistencia = function(){
        $http.post('index.php/asistencia/getParvulos', {fecha: fechaActualService.format($scope.dt)})
            .success(function(parvulosPresentes){
                console.log("[24] Respuesta:", parvulosPresentes);
                for (var i = 0; i < $scope.parvulos.length; i++) {
                    $scope.parvulos[i].check = false;
                }
                for (var i = 0; i < parvulosPresentes.length; i++) {
                    for (var j = 0; j < $scope.parvulos.length; j++) {
                        if( parvulosPresentes[i].id_parvulo == $scope.parvulos[j].id_parvulo ){
                            $scope.parvulos[j].check = true;
                        }
                    }
                    
                }
            })
            .error(function(respuesta) {
                    console.log('Error: ', respuesta);
            });
    }
    

        
    $scope.enviar=function(){
        var parvulo_array = $scope.parvulos;
        var error = false;
        
        for (var i = 0; i < parvulo_array.length; i++) {
            if(parvulo_array[i]!=undefined){
                if(parvulo_array[i].check == true){
                    parvulo_array[i].presente = "1";
                }else{
                    parvulo_array[i].presente = "0";
                }
            }
        }
        
        $http.post("index.php/asistencia/registrarParvulos", 
            {
                fecha: fechaActualService.format($scope.dt),
                parvulos: parvulo_array,
            })
            .success(function(resp){
                toaster.pop("success", "OK", "Asistencia registrada correctamente!");
                console.log('success: ', resp);
            }).error(function(resp){
                toaster.pop("error", "Error", "Hubo un error al registrar la asistencia. (De todas maneras corrobore si se ha guardado la asistencia)");
                console.log('Error: ', resp);
                error = true;
            }
        );
        
    };
});

app.controller('gestionarAsistenciaController', function($scope, $http, $location, toaster, fechaActualService){
    
 
  

  $scope.clear = function () {
    $scope.dt = null;
  };

  // Disable weekend selection
  $scope.disabled = function(date, mode) {
    return ( mode === 'day' && ( date.getDay() === 0 || date.getDay() === 6 ) );
  };

  $scope.toggleMin = function() {
    $scope.minDate = $scope.minDate ? null : new Date();
  };
  $scope.toggleMin();
  $scope.maxDate = new Date(2020, 5, 22);

  $scope.open = function($event) {
    $scope.status.opened = true;
  };

  $scope.setDate = function(year, month, day) {
    $scope.dt = new Date(year, month, day);
  };

  $scope.dateOptions = {
    formatYear: 'yy',
    startingDay: 1
  };

  $scope.formats = ['dd-MMMM-yyyy', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate'];
  $scope.format = $scope.formats[0];

  $scope.status = {
    opened: false
  };

  var tomorrow = new Date();
  tomorrow.setDate(tomorrow.getDate() + 1);
  var afterTomorrow = new Date();
  afterTomorrow.setDate(tomorrow.getDate() + 2);
  $scope.events =
    [
      {
        date: tomorrow,
        status: 'full'
      },
      {
        date: afterTomorrow,
        status: 'partially'
      }
    ];

  $scope.getDayClass = function(date, mode) {
    if (mode === 'day') {
      var dayToCheck = new Date(date).setHours(0,0,0,0);

      for (var i=0;i<$scope.events.length;i++){
        var currentDay = new Date($scope.events[i].date).setHours(0,0,0,0);

        if (dayToCheck === currentDay) {
          return $scope.events[i].status;
        }
      }
    }

    return '';
  };
  
});

app.controller('listarAsistenciaController', function($scope, $http, toaster, $routeParams) {
    $scope.asistencia = [];
    $scope.id_parvulo = $routeParams.id_parvulo;
    $scope.parvulo = undefined;
    $scope.maxDate = new Date();
    $scope.dt = new Date();
    $scope.events = [];
    
    
    $http.get('index.php/api/parvulo/'+$scope.id_parvulo)
        .success(function(respuesta){
            console.log("Respuesta>", respuesta);
            $scope.parvulo = respuesta;
        })
        .error(function(respuesta) {
                console.log('Error: ', respuesta);
        });
        
    $http.get('index.php/api/parvulo/'+$scope.id_parvulo+'/asistencia')
        .success(function(respuesta){
            console.log("Respuesta>", respuesta);
            $scope.asistencias = respuesta;
            // var date;
            // $scope.events = [];
            // for (var i = 0; i < $scope.asistencias.length; i++) {
            //     //var datosFecha = $scope.asistencias[i].split("-");
            //     console.log($scope.asistencias[i].fecha);
            //     date = new Date($scope.asistencias[i].fecha);
            //     $scope.events.push({date: date, status: 'parvuloPresente'});
            // }
            // console.log($scope.events);
        })
        .error(function(respuesta) {
                console.log('Error: ', respuesta);
        });
    console.log("fin");
    
    // $scope.getDayClass = function(date, mode) {
    //     if (mode === 'day') {
    //       var dayToCheck = new Date(date).setHours(0,0,0,0);
    
    //       for (var i=0;i<$scope.asistencia.length;i++){
    //         var currentDay = new Date($scope.asistencia[i].fecha).setHours(0,0,0,0);
    
    //         if (dayToCheck === currentDay) {
    //           return "parvuloPresente";
    //         }
    //       }
          
    //     }

    //     return '';
    // };
});