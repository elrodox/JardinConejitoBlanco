var app = angular.module('controllers.galeria', ['ngRoute','ngStorage', 'ngAnimate','toaster']);

 

// app.factory("services", ['$http', function($http) {
//     var serviceBase = 'index.php/api/foto/'
//     var obj = {};
//     obj.getAllGaleria = function(){
//         return $http.get(serviceBase); //
//     }
//     return obj;   
// }]);

app.controller('listarFotoController', function($scope, $http, toaster, $routeParams) {
    $scope.fotos = [];
    
    $http.get('index.php/api/foto/')
        .success(function(respuesta){
            console.log("Respuesta>", respuesta);
            $scope.fotos = respuesta;
        })
        .error(function(respuesta) {
                console.log('Error: ' + respuesta);
        });
});
app.controller('crearGaleriaController', function($scope,upload, $location, toaster) 
{
    $scope.uploadFile=function(){
        var name= $scope.name;
        var file= $scope.file;
        console.log(name);
        console.log(file);
        upload.uploadFile(file,name).then(function(res){
            console.log(res);
            toaster.pop('success', "OK", "Subida de archivo realizado correctamente!");
            $location.path('galeria-gestionar');
        })
    }
   
    });
    
    

app.directive('uploaderModel',['$parse', function($parse)   {
    return {
        restrict:'A',
        link:function(scope,iElement,iAttrs){
            iElement.on("change", function(e){
                $parse(iAttrs.uploaderModel).assign(scope,iElement[0].files[0]);
                
            });
        }
        
    };

/*for (var i=0;i<1;i++){
    $scope.addPics(i);
}   */   
    
}]);

app.service('upload',["$http","$q",function($http,$q,toaster){
    this.uploadFile=function(file,name){
        var deferred= $q.defer();
        var formData= new FormData();
        formData.append("name", name);
        formData.append("file", file);
        return $http.post("index.php/foto/crear", formData,{
            
            headers:{
                "Content-type":undefined
            },
            transformRequest: formData
        })
        .success(function(res){
            deferred.resolve(res);
            console.log('success', "OK", "imagen cargada correctamente");
            console.log(res);
        })
        .error(function(msg,code){
            console.log("error:", msg);
            deferred.reject(msg);
            toaster.pop('error', 'Error,"no se pudo cargar la imagen');
        })
        return deferred.promise ;
    }
        
        
      
}]);
app.controller('eliminarFotoController', function($scope, $http, $location, toaster){
    $scope.delete=function(index){
        console.log("Enviando el siguiente parametro: ");
        console.log($scope.foto);
        if($scope.foto==undefined){
            toaster.pop('error', "ERROR","foto no pudo ser eliminada correctamente");
        }
        else {
            $http.delete("index.php/api/foto/"+$scope.foto.id_foto)
            .success(function(result){
                $scope.fotos.splice(index, 1);
                console.log(result);
                toaster.pop('success', "OK", "Foto Eliminada correctamente");
            })
            .error(function(error){
                toaster.pop('error', "ERROR", "Foto no pudo ser eliminada correctamente");
                console.log('error', error)
            });
            
        };
    }
    
});

app.controller('editarFotoController', function($scope, $http, $location,  $routeParams, toaster){
   
 $http.get('index.php/api/foto/'+$routeParams.id)
        .success(function(respuesta){
            $scope.foto = respuesta;
            console.log("foto actual: ", $scope.foto);
        })
        .error(function(respuesta) {
            toaster.pop('error', "Error", "No se encontró la foto");
            console.log('Error: ' + respuesta);
        });
    
    $scope.put=function(){
        console.log("Enviando el siguiente parametro: ");
        console.log($scope.foto);
        if($scope.foto==undefined){
            alert("foto no definido");
        }else{
            $http.put('index.php/api/foto/'+$routeParams.id, $scope.foto)
                .success(function(res){
                    // alertService.addAlert("success", "hito editado correctamente!");
                    toaster.pop('success', "OK", "nombre editado correctamente!");
                    $location.path('/galeria-gestionar/');
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