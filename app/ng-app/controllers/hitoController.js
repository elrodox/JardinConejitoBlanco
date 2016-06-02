var app = angular.module('controllers.hito', ['ngRoute', 'ngStorage', 'ngAnimate', 'toaster']);

// app.factory("services", ['$http', function($http) {
//   var serviceBase = 'index.php/api/parvulo/'
//     var obj = {};
//     obj.getAllParvulos = function(){
//         return $http.get(serviceBase + 'listar');
//     }

//     return obj;   
// }]);


// app.factory("services", ['$http', function($http) {
//     var serviceBase = 'index.php/api/parvulo/';
//     var obj = {};
//     obj.getAllParvulos = function(){
//         return $http.get(serviceBase); //
//     }
//     return obj;   
// }]);


app.controller('listarHitoController', function($scope, $http, toaster, $routeParams) {
    $scope.hitos = [];
    $scope.id_parvulo = $routeParams.id_parvulo;
    $scope.parvulo = undefined;
    
    $http.get('index.php/api/parvulo/'+$scope.id_parvulo)
        .success(function(respuesta){
            console.log("Respuesta>", respuesta);
            $scope.parvulo = respuesta;
        })
        .error(function(respuesta) {
                console.log('Error: ' + respuesta);
        });
        
    $http.get('index.php/api/parvulo/'+$scope.id_parvulo+'/hito')
        .success(function(respuesta){
            console.log("Respuesta>", respuesta);
            $scope.hitos = respuesta;
        })
        .error(function(respuesta) {
                console.log('Error: ' + respuesta);
        });
    console.log("fin");
    // service.getAllParvulos().then(function(data){
    //     console.log("Respuesta recibida :D");
    //     $scope.parvulos = data;
    // });
});

app.controller('crearHitoController', function($scope, $http, $location, toaster, fechaActualService, $routeParams) {
    $scope.parvulo = undefined;
    $scope.id_parvulo = $routeParams.id_parvulo;
    $http.get('index.php/api/parvulo/'+$routeParams.id_parvulo)
        .success(function(respuesta){
            console.log("Respuesta>", respuesta);
            $scope.parvulo = respuesta;
        })
        .error(function(respuesta) {
                console.log('Error: ' + respuesta);
        });
        
    $scope.enviar=function(){
        if($scope.hito==undefined){
            toaster.pop('error', "Error", "No se pudo registrar el hito, porfavor revise los datos ingresados");
        }else{
            $scope.id_parvulo = $routeParams.id_parvulo;
            $scope.hito.fecha = fechaActualService.get();
            console.log("Enviando el siguiente parametro: ");
            console.log($scope.hito);
            var link = "index.php/api/parvulo/"+$scope.id_parvulo+"/hito";
            console.log("link", link);
            $http.post("index.php/api/parvulo/"+$scope.id_parvulo+"/hito", $scope.hito)
                .success(function(res){
                  console.log(res);
                  $scope.hito=res;
                  $location.path('/hito-gestionar/'+$scope.id_parvulo);
                  toaster.pop('success', "OK", "Hito registrado correctamente");
                  //por supuesto podrás volcar la respuesta al modelo con algo como vm.res = res;
                })
                .error(function(respuesta) {
                    toaster.pop('error', "Error", "No se pudo crear el hito");
                    console.log('Error: ');
                    console.log(respuesta);
            });
        }
    };
});

app.controller('editarHitoController', function($scope, $http, $location,  $routeParams, toaster) {
    $scope.parvulo = undefined;
    $scope.id_parvulo = $routeParams.id_parvulo;
    $http.get('index.php/api/parvulo/'+$routeParams.id_parvulo)
        .success(function(respuesta){
            console.log("Respuesta>", respuesta);
            $scope.parvulo = respuesta;
        })
        .error(function(respuesta) {
                console.log('Error: ' + respuesta);
        });
        //console.log("Parvulo"+$scope.parvulo.nombre);
    $http.get('index.php/api/hito/'+$routeParams.id_hito)
        .success(function(respuesta){
            $scope.hito = respuesta;
            console.log("hito actual: ", $scope.hito);
        })
        .error(function(respuesta) {
            toaster.pop('error', "Error", "No se encontró el hito");
            console.log('Error: ' + respuesta);
        });
    
    $scope.put=function(){
        console.log("Enviando el siguiente parametro: ");
        console.log($scope.hito);
        if($scope.hito==undefined){
            alert("hito no definido");
        }else{
            $http.put("index.php/api/hito/"+$routeParams.id_hito, $scope.hito)
                .success(function(res){
                    // alertService.addAlert("success", "hito editado correctamente!");
                    toaster.pop('success', "OK", "hito editado correctamente!");
                    $location.path('/hito-gestionar/'+$scope.parvulo.id_parvulo);
                })
                .error(function(respuesta) {
                    toaster.pop('error', "Error", "No se pudieron guardar los cambios");
                    // alertService.addAlert("success", "No se pudieron guardar los cambios");
                    console.log('Error: ');
                    console.log(respuesta);
                });
        }
    };
});



app.controller('eliminarHitoController', function($scope, $http, $location, toaster) {
    $scope.delete = function(index) {
        console.log("Enviando el siguiente parametro: ");
        console.log($scope.hito);
        if($scope.hito==undefined){
            toaster.pop('error', "Error", "No se pudo eliminar el hito");
        }else{
            $http.delete("index.php/api/hito/"+$scope.hito.id_hito)
                .success(function(result) {
                    $scope.hito=undefined;
                    $scope.hitos.splice(index, 1);
                    console.log(result);
                    toaster.pop('success', "OK", "hito eliminado correctamente");
                })
                .error(function(error) {
                    toaster.pop('error', "Error", "No se pudo eliminar el hito");
                    console.log("error", error);
                });
        };
    }    
});

////Para Asistencia///
app.controller('asistenciaHitoController', function($scope, $http, $location){
    $scope.parvulos = [];
    
    $http.get('index.php/api/parvulo/')
    .success(function(respuesta){
        console.log("Respuesta>", respuesta);
        $scope.parvulos = respuesta;
    })
    .error(function(respuesta) {
            console.log('Error: ' + respuesta);
    });
    
    $scope.enviar=function(){
        console.log("Enviando el siguiente parametro: ");
        console.log($scope.parvulo);
        if($scope.parvulo==undefined){
            alert("Asistencia no definido");
        }else{
            $http.post("index.php/api/parvulo/", $scope.parvulo)
                .success(function(res){
                  console.log(res);
                  $scope.parvulo=res;
                  $location.path('/parvulo-asistencia');
                  //por supuesto podrás volcar la respuesta al modelo con algo como vm.res = res;
                })
                .error(function(respuesta) {
                console.log('Error: ' + respuesta);
            });
        }
    };
});
