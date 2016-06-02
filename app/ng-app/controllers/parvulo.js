var app = angular.module('controllers.parvulo', ['ngRoute', 'ngStorage', 'ngAnimate', 'toaster']);

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


app.controller('listarParvuloController', function($scope, $http, toaster, $location) {
    //console.log(window.location);
    $scope.parvulos = [];
    console.log("hola");
    $http.get('index.php/api/parvulo/')
    .success(function(respuesta){
        console.log("Respuesta>", respuesta);
        $scope.parvulos = respuesta;
        
    })
    .error(function(respuesta) {
            console.log('Error: ' + respuesta);
    });
    console.log("fin");
    
    // $scope.seleccionar = function(){
    //     console.log("entra");
    //     toaster.pop('alert', "Atencion", "Debe seleccionar un parvulo primero");
    // };
    
    // $scope.activar = function() {
    // console.log("Enviando el siguiente parametro: ");
    // console.log($scope.parvulo);
    // if($scope.parvulo==undefined){
    //     toaster.pop('error', "Error", "No se pudo actualizar el parvulo");
    // }else{
    //     $scope.parvulo.eliminado=0;
    //     console.log("aqui");
    //     $http.put("index.php/api/parvulo/"+$scope.parvulo.id_parvulo, $scope.parvulo)
    //         .success(function(result) {
    //             console.log(result);
    //             toaster.pop('success', "OK", "Parvulo activado correctamente");
    //         })
    //         .error(function(error) {
    //             toaster.pop('error', "Error", "No se pudo activar el parvulo");
    //             console.log("error", error);
    //         });
    // };
    
    // service.getAllParvulos().then(function(data){
    //     console.log("Respuesta recibida :D");
    //     $scope.parvulos = data;
    // });
    //}
});


app.controller('verParvuloController', function($scope, $http, $routeParams){
    $http.get('index.php/api/parvulo/'+$routeParams.id)
    .success(function(respuesta){
        console.log("Respuesta verParvuloController: ", respuesta);
        $scope.parvulo = respuesta;
    })
    .error(function(respuesta) {
            console.log('Error: ' + respuesta);
    });;
});

app.controller('editarParvuloController', function($scope, $http, $location,  $routeParams, toaster) {

    $http.get('index.php/api/parvulo/'+$routeParams.id)
    .success(function(respuesta){
        $scope.parvulo = respuesta;
        console.log("parvulo actual: ", $scope.parvulo);
    })
    .error(function(respuesta) {
            console.log('Error: ' + respuesta);
    });;
    
    $scope.put=function(){
        console.log("Enviando el siguiente parametro: ");
        console.log($scope.parvulo);
        if($scope.parvulo==undefined){
            alert("Parvulo no definido");
        }else{
            $http.put("index.php/api/parvulo/"+$routeParams.id, $scope.parvulo)
                .success(function(res){
                    // alertService.addAlert("success", "Parvulo editado correctamente!");
                    toaster.pop('success', "OK", "Parvulo editado correctamente!");
                    $location.path('parvulo-gestionar');
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

app.controller('crearParvuloController', function($scope, $http, $location, toaster) {
    $scope.enviar=function(){
        console.log("Enviando el siguiente parametro: ");
        console.log($scope.parvulo);
        if($scope.parvulo==undefined){
            toaster.pop('error', "Error", "No se pudo crear el parvulo, porfavor revise los datos ingresados");
        }else{
            $scope.parvulo.eliminado=0;
            $http.post("index.php/api/parvulo/", $scope.parvulo)
                .success(function(res){
                  console.log(res);
                  $scope.parvulo=res;
                  $location.path('/parvulo-gestionar');
                  toaster.pop('success', "OK", "Parvulo creado correctamente");
                  //por supuesto podrás volcar la respuesta al modelo con algo como vm.res = res;
                })
                .error(function(respuesta) {
                    toaster.pop('error', "Error", "No se pudo crear el parvulo");
                    console.log('Error: ');
                    console.log(respuesta);
            });
        }
    };
});

app.controller('eliminarParvuloController', function($scope, $http, $location, toaster) {
    $scope.delete = function() {
        console.log("Enviando el siguiente parametro: ");
        console.log($scope.parvulo);
        if($scope.parvulo==undefined){
            toaster.pop('error', "Error", "No se pudo eliminar el parvulo");
        }else{
            $scope.parvulo.eliminado=1;
            $http.put("index.php/api/parvulo/"+$scope.parvulo.id_parvulo, $scope.parvulo)
                .success(function(result) {
                    console.log(result);
                    toaster.pop('success', "OK", "Parvulo eliminado correctamente");
                })
                .error(function(error) {
                    toaster.pop('error', "Error", "No se pudo eliminar el parvulo");
                    console.log("error", error);
                });
        };
    }    
});
//activar Parvulo
app.controller('activarParvuloController', function($scope, $http, $location, toaster) {
    $scope.activar = function() {
        console.log("Enviando el siguiente parametro: ");
        console.log($scope.parvulo);
        if($scope.parvulo==undefined){
            toaster.pop('error', "Error", "No se pudo activar el parvulo");
        }else{
            $scope.parvulo.eliminado=0;
            $http.put("index.php/api/parvulo/"+$scope.parvulo.id_parvulo, $scope.parvulo)
                .success(function(result) {
                    console.log(result);
                    toaster.pop('success', "OK", "Parvulo activado correctamente");
                })
                .error(function(error) {
                    toaster.pop('error', "Error", "No se pudo activar el parvulo");
                    console.log("error", error);
                });
        };
    }    
});


