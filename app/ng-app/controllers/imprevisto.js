var app = angular.module('controllers.imprevisto', ['ngRoute', 'ngStorage', 'ngAnimate', 'toaster']);







//VER
app.controller('listarImprevistoController', function($scope, $http, toaster, $routeParams) {
    $scope.imprevistos = [];
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
        
    $http.get('index.php/api/parvulo/'+$scope.id_parvulo+'/imprevisto')
        .success(function(respuesta){
            console.log("Respuesta>", respuesta);
            $scope.imprevistos = respuesta;
            console.log("imprevistos : ",$scope.imprevistos.length);
            
            
            
            //   $scope.numPages = function () {
            //     return Math.ceil($scope.imprevistos.length / $scope.numPerPage);
            
            
        })
        .error(function(respuesta) {
                console.log('Error: ' + respuesta);
        });
        
    console.log("fin");
    
    
    
    //   $scope.$watch('currentPage + numPerPage', function() {
    //     var begin = (($scope.currentPage - 1) * $scope.numPerPage)
    //     , end = begin + $scope.numPerPage;
    
    //     $scope.imprevistos = $scope.todos.slice(begin, end);
    //   });
    
    
});

//CREAR
app.controller('crearImprevistoController', function($scope, $location, $http, $routeParams, fechaActualService, toaster) {
    $scope.parvulo=undefined;
    $scope.id_parvulo = $routeParams.id_parvulo;
    $http.get('index.php/api/parvulo/'+$routeParams.id_parvulo)
        .success(function(informacionP){
            console.log("Se realizo la consulta", informacionP);
            $scope.parvulo=informacionP;
        })
        .error(function(respuesta){
            console.log("No se pudo realizar la consulta", respuesta);
        });
    
    $scope.enviar=function(){
        if($scope.imprevisto==undefined){
            console.log($scope.imprevisto);
            toaster.pop('error', "Error", "No se pudo registrar el imprevisto, porfavor revise los datos ingresados");
        }else{
            $scope.id_parvulo = $routeParams.id_parvulo;
            $scope.imprevisto.fecha = fechaActualService.get();
            console.log("Enviando el siguiente parametro: ");
            console.log($scope.imprevisto);
            var link = "index.php/api/parvulo/"+$scope.id_parvulo+"/imprevisto";
            console.log("link", link);
            $http.post("index.php/api/parvulo/"+$scope.id_parvulo+"/imprevisto", $scope.imprevisto)
                .success(function(respuesta){
                  console.log(respuesta);
                  $scope.imprevisto=respuesta;
                  $location.path('/imprevisto-gestionar/'+$scope.id_parvulo);
                  console.log($location.path);
                  toaster.pop('success', "OK", "Imprevisto registrado correctamente");
                  
                })
                .error(function(respuesta) {
                    toaster.pop('error', "Error", "No se pudo crear el Imprevisto");
                    console.log('Error: ');
                    console.log(respuesta);
            });
        }
    };
    
});

//EDITAR
app.controller('editarImprevistoController', function($scope, $http, $location,  $routeParams, toaster) {
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
        
    $http.get('index.php/api/imprevisto/'+$routeParams.id_imprevisto)
        .success(function(respuesta){
            $scope.imprevisto = respuesta;
            console.log("imprevisto actual: ", $scope.imprevisto);
        })
        .error(function(respuesta) {
            toaster.pop('error', "Error", "No se encontró el imprevisto");
            console.log('Error: ' + respuesta);
        });
    
    $scope.put=function(){
        console.log("Enviando el siguiente parametro: ");
        console.log($scope.imprevisto);
        if($scope.imprevisto==undefined){
            alert("imprevisto no definido");
        }else{
            $http.put("index.php/api/imprevisto/"+$routeParams.id_imprevisto, $scope.imprevisto)
                .success(function(res){
                    
                    toaster.pop('success', "OK", "imprevisto editado correctamente!");
                    $location.path('/imprevisto-gestionar/'+$scope.parvulo.id_parvulo);
                })
                .error(function(respuesta) {
                    toaster.pop('error', "Error", "No se pudieron guardar los cambios");
                    
                    console.log('Error: ');
                    console.log(respuesta);
                });
        }
    };
});

//ELIMINAR
app.controller('eliminarImprevistoController', function($scope, $http, $location, toaster) {
    $scope.delete = function(index) {
        console.log("Enviando el siguiente parametro: ");
        console.log($scope.imprevisto);
        if($scope.imprevisto==undefined){
            toaster.pop('error', "Error", "No se pudo eliminar el imprevisto");
        }else{
            $http.delete("index.php/api/imprevisto/"+$scope.imprevisto.id_imprevisto)
                .success(function(result) {
                    $scope.imprevisto=undefined;
                    $scope.imprevistos.splice(index, 1);
                    console.log(result);
                    toaster.pop('success', "OK", "imprevisto eliminado correctamente");
                })
                .error(function(error) {
                    toaster.pop('error', "Error", "No se pudo eliminar el imprevisto");
                    console.log("error", error);
                });
        }
    };    
});

