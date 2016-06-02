var app = angular.module('controllers.noticia', ['ngRoute', 'ngStorage', 'ngAnimate', 'toaster']);

// app.factory("services", ['$http', function($http) {
//   var serviceBase = 'index.php/parvulo/'
//     var obj = {};
//     obj.getAllParvulos = function(){
//         return $http.get(serviceBase + 'listar');
//     }

//     return obj;   
// }]);



// app.factory("services", ['$http', function($http) {
//     var serviceBase = 'index.php/noticia/'
//     var obj = {};
//     obj.getAllNoticia = function(){
//         return $http.get(serviceBase); //
//     }
//     return obj;   
// }]);

app.controller('listarNoticiaController', function($scope, $http, toaster) {
    $scope.noticias = [];
    console.log("hola");
    $http.get('index.php/api/noticia/')
        .success(function(respuesta){
            
            for (var i = 0; i < respuesta.length; i++) {
                if(respuesta[i].importante == 1){
                    respuesta[i].importante= 'Si';
                }else{
                    respuesta[i].importante='No'; 
                }
            }
            $scope.noticias = respuesta;
            console.log("Respuesta>", respuesta);
            console.log("$scope.noticias>", $scope.noticias);
        })
        .error(function(respuesta) {
                console.log('Error: ' + respuesta);
        });
    console.log("fin");
});

app.controller('crearNoticiaController', function($scope, $http, $location, toaster, fechaActualService) {
    $scope.enviar=function(){
        console.log("Enviando el siguiente parametro: ");
        console.log($scope.noticia);
        if($scope.noticia==undefined){
            toaster.pop('error', "Error", "No se pudo crear la noticia, porfavor revise los datos ingresados");
        }else{
            if($scope.noticia.importante== true){
                $scope.noticia.importante= 1;
            }else{
                $scope.noticia.importante=0; 
            }
            $scope.noticia.fecha= fechaActualService.get();
            $http.post("index.php/api/noticia/", $scope.noticia)
                .success(function(res){
                  console.log(res);
                  $scope.parvulo=res;
                  $location.path('/noticia-gestionar');
                  toaster.pop('success', "OK", "Noticia creada correctamente");
                  //por supuesto podrás volcar la respuesta al modelo con algo como vm.res = res;
                })
                .error(function(res) {
                    toaster.pop('error', "Error", "No se pudo crear la noticia");
                    console.log('Error: ');
                    console.log(res);
            });
        }
    };
});

app.controller('editarNoticiaController', function($scope, $http, $location,  $routeParams, toaster) {

    $http.get('index.php/api/noticia/'+$routeParams.id)
    .success(function(respuesta){
        $scope.noticia = respuesta;
        if($scope.noticia.importante== 1){
                $scope.noticia.importante= true;
        }else{
            $scope.noticia.importante=false; 
        }
        console.log("Noticia actual: ", $scope.noticia);
    })
    .error(function(respuesta) {
            console.log('Error: ' + respuesta);
    });;
    
    $scope.put=function(){
        console.log("Enviando el siguiente parametro: ");
        console.log($scope.noticia);
        if($scope.noticia==undefined){
            alert("Noticia no definido");
        }else{
            if($scope.noticia.importante== true){
                $scope.noticia.importante= 1;
            }else{
                $scope.noticia.importante=0; 
            }
            $http.put("index.php/api/noticia/"+$routeParams.id, $scope.noticia)
                .success(function(res){
                    // alertService.addAlert("success", "Parvulo editado correctamente!");
                    toaster.pop('success', "OK", "Noticia editada correctamente!");
                    $location.path('noticia-gestionar');
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
app.controller('eliminarNoticiaController', function($scope, $http, $location, toaster) {
    $scope.delete = function(index) {
        console.log("Enviando el siguiente parametro: ");
        console.log($scope.noticia);
        if($scope.noticia==undefined){
            toaster.pop('error', "Error", "No se pudo eliminar la noticia");
        }else{
            $http.delete('index.php/api/noticia/'+$scope.noticia.id_noticia)
                .success(function(){
                    $scope.noticias.splice(index, 1);
                    toaster.pop('success', "OK", "Noticia eliminada correctamente");
                })
                .error(function(){
                    toaster.pop('error', "Error", "No se pudo eliminar la noticia");
                })
        };
    }    
});