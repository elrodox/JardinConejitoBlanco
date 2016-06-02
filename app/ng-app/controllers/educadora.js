var app = angular.module('controllers.educadora', ['base64']);

//Controller utilizado para 
app.controller('listarEducadoraController', function($scope, $http, $localStorage) {
    $scope.educadoras = [];
    
    $http.get('index.php/api/educadora/')
    .success(function(respuesta){
        console.log("Respuesta>", respuesta);
        $scope.educadoras = respuesta;
        for (var i = 0; i < $scope.educadoras.length; i++) {
            if ($scope.educadoras[i].id_educadora == $localStorage.currentUser.id_educadora) {
                $scope.educadoras.splice(i,1);
            };
            if($scope.educadoras[i].administrador == 1){
                $scope.educadoras[i].administrador= 'Si';
            }else{
                $scope.educadoras[i].administrador='No'; 
            }
        };
    })
    .error(function(respuesta) {
            console.log('Error: ' + respuesta);
    });
});

app.controller('crearEducadoraController', function($scope, $http, $location, toaster) {
    $scope.enviar=function(){
        console.log("Enviando el siguiente parametro: ");
        console.log($scope.educadora);
        if($scope.educadora==undefined){
            toaster.pop('error', "Error", "No se pudo crear la educadora, porfavor revise los datos ingresados");
        }else{
            $scope.educadora.eliminado=0;
            if($scope.educadora.administrador == true){
                $scope.educadora.administrador=1;
            }else{
                $scope.educadora.administrador=0; 
            }
            $http.post("index.php/api/educadora/", $scope.educadora)
                .success(function(res){
                  console.log(res);
                  $scope.educadora=res;
                  $location.path('/educadora-gestionar');
                  toaster.pop('success', "OK", "Educadora creada correctamente");
                  //por supuesto podrás volcar la respuesta al modelo con algo como vm.res = res;
                })
                .error(function(respuesta) {
                    toaster.pop('error', "Error", "No se pudo crear la educadora");
                    console.log('Error: ');
                    console.log(respuesta);
            });
        }
    };
});
app.controller('eliminarEducadoraController', function($scope, $http, $location, toaster) {
    
    $scope.delete = function() {
        console.log("Enviando el siguiente parametro: ");
        console.log($scope.educadora);
        if($scope.educadora==undefined){
            toaster.pop('error', "Error", "No se pudo eliminar la educadora");
        }else{
            if($scope.educadora.administrador == 'Si'){
                $scope.educadora.administrador= 1;
            }else{
                $scope.educadora.administrador= 0; 
            }
            console.log($scope.educadora.administrador);
            $scope.educadora.eliminado=1;
            $http.put("index.php/api/educadora/"+$scope.educadora.id_educadora, $scope.educadora)
                .success(function(result) {
                    console.log(result);
                    toaster.pop('success', "OK", "Educadora eliminada correctamente");
                })
                .error(function(error) {
                    toaster.pop('error', "Error", "No se pudo eliminar la educadora");
                    console.log("error", error);
                });
        };
    }    
});
app.controller('activarEducadoraController', function($scope, $http, $location, toaster) {
    $scope.activar = function() {
        console.log("Enviando el siguiente parametro: ");
        console.log($scope.educadora);
        if($scope.educadora==undefined){
            toaster.pop('error', "Error", "No se pudo activar el educadora");
        }else{
            if($scope.educadora.administrador == 'Si'){
                $scope.educadora.administrador= 1;
            }else{
                $scope.educadora.administrador= 0; 
            }
            $scope.educadora.eliminado=0;
            $http.put("index.php/api/educadora/"+$scope.educadora.id_educadora, $scope.educadora)
                .success(function(result) {
                    console.log(result);
                    toaster.pop('success', "OK", "Educadora activada correctamente");
                })
                .error(function(error) {
                    toaster.pop('error', "Error", "No se pudo activar la educadora");
                    console.log("error", error);
                });
        };
    }    
});

app.controller('editarEducadoraController', function($scope, $http, $location,  $routeParams, toaster) {

    $http.get('index.php/api/educadora/'+$routeParams.id)
    .success(function(respuesta){
        $scope.educadora = respuesta;
        if($scope.educadora.administrador== 1){
            $scope.educadora.administrador= true;
        }else{
            $scope.educadora.administrador= false; 
        }
        console.log("educadora actual: ", $scope.educadora);
    })
    .error(function(respuesta) {
            console.log('Error: ' + respuesta);
    });;
    
    $scope.put=function(){
        console.log("Enviando el siguiente parametro: ");
        console.log($scope.educadora);
        if($scope.educadora==undefined){
            alert("Educadora no definido");
        }else{
            if($scope.educadora.administrador == true){
                $scope.educadora.administrador=1;
            }else{
                $scope.educadora.administrador=0; 
            }
            $http.put("index.php/api/educadora/"+$routeParams.id, $scope.educadora)
                .success(function(res){
                    toaster.pop('success', "OK", "Educadora editado correctamente!");
                    $location.path('educadora-gestionar');
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
//DATOS DEL USUARIO EDUCADORA O ADMINISTRADOR
app.controller('informacionEducadoraController', function($scope, $localStorage, $http){
    $scope.educadora=$localStorage.currentUser;
    $http.get('index.php/api/educadora/'+$scope.educadora.id_educadora)
    .success(function(respuesta){
        console.log("Respuesta>", respuesta);
        $scope.educadora = respuesta;
    })
    .error(function(respuesta) {
            console.log('Error: ' + respuesta);
    });
    $scope.usuario=undefined;
    if($scope.educadora.administrador==0){
        $scope.usuario='No';
    }else{
        $scope.usuario='Si';
    }
});
    
