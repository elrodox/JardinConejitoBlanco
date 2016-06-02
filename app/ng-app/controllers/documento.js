var app = angular.module('controllers.documento', ['ngRoute','ngStorage', 'ngAnimate','toaster']);

// app.factory("services", ['$http', function($http) {
//     var serviceBase = 'index.php/api/documento/';
//     var obj = {};
//     obj.getAllDocumento = function(){
//         return $http.get(serviceBase); //
//     };
//     return obj;   
// }]);

app.controller('listarDocumentoController', function($scope, $http, toaster) {
    $scope.documentos = [];
    $http.get('index.php/api/documento/')
	    .success(function(respuesta){
	        console.log("Respuesta>", respuesta);
	        $scope.documentos = respuesta;
	    })
	    .error(function(respuesta) {
	            console.log('Error: ' + respuesta);
	    });
});

// app.controller('uploadDocController', function($scope,upload, $location, toaster) 
// {
//     $scope.uploadDoc=function(){
//         console.log("docus");
//         var nombre= $scope.nameD;
//         var archivo= $scope.fileD;
//         console.log(nombre);
//         console.log(archivo);
//         upload.uploadFile(archivo,nombre).then(function(res){
//             console.log("entro");
//             toaster.pop('success', "OK", "Subida de archivo realizado correctamente!");
//             $location.path('documento-gestionar');
//         });
//     } ;  
// });
app.controller('crearDocumentoController', function($scope,uploadDocumento, $location, toaster, fechaActualService) 
{
    $scope.uploadFile=function(){
        var name= $scope.name;
        var file= $scope.file;
        var fecha= fechaActualService.get();
        console.log(name);
        console.log(file);
        uploadDocumento.uploadFile(file,name,fecha).then(function(res){
            console.log(res);
            toaster.pop('success', "OK", "Subida de archivo realizado correctamente!");
            $location.path('documento-gestionar');
        })
    }
   
 })

app.directive('uploaderModel', ["$parse", function ($parse) {
	return {
		restrict: 'A',
		link: function (scope, iElement, iAttrs){
			iElement.on("change", function(e){
				$parse(iAttrs.uploaderModel).assign(scope, iElement[0].files[0]);
			});
		}
	};
}])

app.service('uploadDocumento', ["$http", "$q", function ($http, $q, toaster){
	this.uploadFile = function(file, name, fecha){
		var deferred = $q.defer();
		var formData = new FormData();
		console.log(deferred);
		formData.append("name", name);
		formData.append("file", file);
		formData.append("fecha", fecha);
		return $http.post("index.php/documento/crear", formData, {
			headers: {
				"Content-type": undefined
			},
			transformRequest: formData
		})
		.success(function(res)
		{
			deferred.resolve(res);
            console.log('success', "OK", "documento cargada correctamente");
            console.log(res);
		})
		.error(function(msg, code)
		{
			console.log("error:", msg);
            deferred.reject(msg);
            toaster.pop('error', "Error","no se pudo cargar el documento");
		})
		return deferred.promise;
	}	
}]);




app.controller('eliminarDocumentoController', function($scope, $http, $location, toaster) {
    $scope.delete = function(index) {
        console.log("Enviando el siguiente parametro: ");
        console.log($scope.documento);
        if($scope.documento==undefined){
            toaster.pop('error', "Error", "No se pudo eliminar el documento");
        }else{
            $http.delete("index.php/api/documento/"+$scope.documento.id_documento)
                .success(function(result) {
                    $scope.documento=undefined;
                    $scope.documentos.splice(index, 1);
                    console.log(result);
                    toaster.pop('success', "OK", "documento eliminado correctamente");
                })
                .error(function(error) {
                    toaster.pop('error', "Error", "No se pudo eliminar el documento");
                    console.log("error", error);
                });
        }
    };    
});



app.controller('editarDocumentoController', function($scope, $http, $location,  $routeParams, toaster) {
  
    $http.get('index.php/api/documento/'+$routeParams.id_documento)
        .success(function(respuesta){
            console.log("Respuesta>", respuesta);
            $scope.documento = respuesta;
        })
        .error(function(respuesta) {
           toaster.pop('error', "Error", "No se encontró el documento");
            console.log('Error: ' + respuesta);
        });
    
    $scope.put=function(){
        console.log("Enviando el siguiente parametro: ");
        console.log($scope.documento);
        if($scope.documento==undefined){
            alert("documento no definido");
        }else{
            $http.put("index.php/api/documento/"+$routeParams.id_documento, $scope.documento)
                .success(function(res){
                    
                    toaster.pop('success', "OK", "documento editado correctamente!");
                    $location.path('/documento-gestionar/');
                })
                .error(function(respuesta) {
                    toaster.pop('error', "Error", "No se pudieron guardar los cambios");
                    
                    console.log('Error: ');
                    console.log(respuesta);
                });
        }
    };
});
