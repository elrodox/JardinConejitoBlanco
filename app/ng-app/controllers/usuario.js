var app = angular.module('controllers.usuario', ['base64', 'ngStorage', 'ngAnimate','toaster']);

//Controller utilizado para 
app.controller('UsuarioController', function($scope, $http, $location, $rootScope, $base64, $localStorage, toaster) {
    //$scope.datosLogin;
    $rootScope.$storage = $localStorage;
    
    $scope.passwordRecovery = function(){
        console.log("PasswordRecovery: enviando rut: ", $scope.user);
        $http.post("index.php/auth/passwordRecovery", $scope.user)
            .success(function(res){
                console.log("PasswordRecovery: Success: ",res);
            })
            .error(function(res){
                console.log("PasswordRecovery: Error: ",res);
            }) 
        ;
    };
  
    //$localStorage.$reset();
    $scope.logout = function(){
        $localStorage.$reset();
        $localStorage.isLogged = false;
        $location.path('/');
    };
    $scope.login = function(){
        // console.log($scope.datosLogin.rut);
        // console.log($scope.datosLogin.password);
        
        var authData = $base64.encode($scope.datosLogin.rut + ':' + $scope.datosLogin.password);
        $http.defaults.headers.common['Authorization'] = 'Basic ' + authData;
        
        $http.post("index.php/auth/login")
                .success(function(res){
                    console.log($rootScope.currentUser);
                    if(res!=""){
                        $scope.datosLogin.rut="";
                        $scope.datosLogin.password="";
                        $scope.loginForm.$setPristine();
                        
                        if( res.rut_educadora != undefined ){
                            res.isEducadora = true;
                            res.isParvulo = false;
                            res.isAdmin = res.administrador==1;
                            res.rut = res.rut_educadora;
                            res.dashboardLink = "/educadora-dashboard/";
                        }
                        else if( res.rut_parvulo != undefined ){
                            res.isEducadora = false;
                            res.isParvulo = true;
                            res.rut = res.rut_parvulo;
                            res.dashboardLink = "/parvulo-dashboard/";
                        }
                        
                        $localStorage.currentUser = res;
                        $localStorage.isLogged = true;
                        $location.path(res.dashboardLink);
                        // if(res.isAdmin){
                        //     $location.path('/educadora-dashboard/');
                        // }else if(res.isEducadora){
                        //     $location.path('/parvulo-gestionar/');
                        // }else if(res.isParvulo){
                        //     $location.path('/parvulo-ver/'+res.id_parvulo);
                        // }
                    }
                    else {
                        $localStorage.isLogged = false;
                        $rootScope.currentUser = null;
                        toaster.pop('error', "Error", "Error de usuario o contraseña");
                    }
                  //por supuesto podrás volcar la respuesta al modelo con algo como vm.res = res;
                })
                .error(function(respuesta) {
                    toaster.pop('error', "Error", "Usuario o contraseña incorrectos");
                    console.log('Error: ' + respuesta);
            });
    };
    $scope.$on('token_auth', function(event, args) {
        var user = $rootScope.currentUser;
        var authData = $base64.encode(user.rut + ':' + user.token);
        $http.defaults.headers.common['Authorization'] = 'Basic ' + authData;
        $http.post("index.php/auth/login")
                .success(function(res){
                    // if( res.rut_educadora != undefined ){
                    //     res.isEducadora = true;
                    //     res.isParvulo = false;
                    //     res.isAdmin = res.administrador==1;
                    // }
                    // else if( res.rut_parvulo != undefined ){
                    //     res.isEducadora = false;
                    //     res.isParvulo = true;
                    // }
                    // $rootScope.currentUser=res;
                    console.log($rootScope.currentUser);
                  //$location.path('/parvulo-gestionar');
                  //por supuesto podrás volcar la respuesta al modelo con algo como vm.res = res;
                })
                .error(function(respuesta) {
                    console.log('Error: ' + respuesta);
                }
            );
    });
});


//CAMBIO DE CONTRASENA
app.controller('cambioContrasenaController',function($scope, $http, $localStorage,$rootScope, toaster,$location){
    if($localStorage.currentUser.id_educadora!=null){
        $http.get('index.php/api/educadora/'+$localStorage.currentUser.id_educadora)
            .success(function(respuesta){
                $scope.educadora = respuesta;
                console.log("educadora actual: ", $scope.educadora);
            })
            .error(function(respuesta) {
                console.log('Error: ' + respuesta);
            });
        $scope.enviandoDatos=function(){
            if($scope.educadora.password==$scope.dato.passwordAntigua){
                console.log("contraseña ingresada y original son iguales");
                if($scope.dato.passwordNueva==$scope.dato.passwordCopiaNueva && $scope.dato.passwordNueva != null && $scope.dato.passwordCopiaNueva != null){
                    console.log("contraseñas nuevas ingresadas son iguales");
                    $scope.educadora.password=$scope.dato.passwordNueva;
                    $http.put("index.php/api/educadora/"+$localStorage.currentUser.id_educadora, $scope.educadora)
                        .success(function(res){
                            toaster.pop('success', "OK", "contrasena editada correctamente!");
                            $location.path('/educadora-dashboard');
                        })
                        .error(function(respuesta) {
                            toaster.pop('error', "Error", "No se pudieron guardar los cambios");
                            console.log('Error: ');
                            console.log(respuesta);
                        });
                }else{
                    console.log("contraseñas nuevas ingresadas son distintas");
                    toaster.pop('error', "Error", "Porfavor ingrese contraseñas correctamente");
                }
            }else{
                console.log("contraseña ingresada y original son distintas");
                toaster.pop('error', "Error", "Contraseña ingresada no corresponde");
            }
        };        
    }else{
        $http.get('index.php/api/parvulo/'+$localStorage.currentUser.id_parvulo)
        .success(function(respuesta){
            $scope.parvulo = respuesta;
            console.log("parvulo actual: ", $scope.parvulo);
        })
        .error(function(respuesta) {
            console.log('Error: ' + respuesta);
        });
    $scope.enviandoDatos=function(){
        if($scope.parvulo.password==$scope.dato.passwordAntigua){
            console.log("contraseña ingresada y original son iguales");
            if($scope.dato.passwordNueva==$scope.dato.passwordCopiaNueva && $scope.dato.passwordNueva != null && $scope.dato.passwordCopiaNueva != null){
                console.log("contraseñas nuevas ingresadas son iguales");
                $scope.parvulo.password=$scope.dato.passwordNueva;
                $http.put("index.php/api/parvulo/"+$localStorage.currentUser.id_parvulo, $scope.parvulo)
                    .success(function(res){
                        toaster.pop('success', "OK", "contrasena editada correctamente!");
                        $location.path('/parvulo-dashboard');
                    })
                    .error(function(respuesta) {
                        toaster.pop('error', "Error", "No se pudieron guardar los cambios");
                        console.log('Error: ');
                        console.log(respuesta);
                    });
            }else{
                console.log("contraseñas nuevas ingresadas son distintas");
                toaster.pop('error', "Error", "Porfavor ingrese contraseñas correctamente");
            }
        }else{
            console.log("contraseña ingresada y original son distintas");
            toaster.pop('error', "Error", "Contraseña ingresada no corresponde");
        }
    };    
    }
});

//CAMBIO DE MAIL
app.controller('cambioMailController',function($scope, $http, $localStorage,$rootScope, toaster,$location){
    if($localStorage.currentUser.id_educadora!=null){
        $http.get('index.php/api/educadora/'+$localStorage.currentUser.id_educadora)
            .success(function(respuesta){
                $scope.educadora = respuesta;
                console.log("educadora actual: ", $scope.educadora);
            })
            .error(function(respuesta) {
                console.log('Error: ' + respuesta);
            });
        $scope.enviandoDatos=function(){
            if($scope.educadora.password==$scope.dato.contrasena && $scope.dato.mail!=null){
                console.log("contraseña ingresada y original son iguales");
                console.log("contraseñas nuevas ingresadas son iguales");
                $scope.educadora.email=$scope.dato.mail;
                $http.put("index.php/api/educadora/"+$localStorage.currentUser.id_educadora, $scope.educadora)
                    .success(function(res){
                        toaster.pop('success', "OK", "E-mail editado correctamente!");
                        $location.path('/educadora-dashboard');
                    })
                    .error(function(respuesta) {
                        toaster.pop('error', "Error", "No se pudieron guardar los cambios");
                        console.log('Error: ');
                        console.log(respuesta);
                    });
            }else{
                console.log("contraseña ingresada y original son distintas");
                toaster.pop('error', "Error", "Contraseña ingresada o E-mail no corresponde");
            }
        };        
    }else{
        $http.get('index.php/api/parvulo/'+$localStorage.currentUser.id_parvulo)
            .success(function(respuesta){
                $scope.parvulo = respuesta;
                console.log("parvulo actual: ", $scope.parvulo);
            })
            .error(function(respuesta) {
                console.log('Error: ' + respuesta);
            });
        $scope.enviandoDatos=function(){
            if($scope.parvulo.password==$scope.dato.contraena && $scope.dato.mail!=null){
                console.log("contraseña ingresada y original son iguales");
                console.log("contraseñas nuevas ingresadas son iguales");
                $scope.parvulo.email=$scope.dato.mail;
                $http.put("index.php/api/parvulo/"+$localStorage.currentUser.id_parvulo, $scope.parvulo)
                    .success(function(res){
                        toaster.pop('success', "OK", "E-mail editado correctamente!");
                        $location.path('/parvulo-dashboard');
                    })
                    .error(function(respuesta) {
                        toaster.pop('error', "Error", "No se pudieron guardar los cambios");
                        console.log('Error: ');
                        console.log(respuesta);
                    });
            }else{
                console.log("contraseña ingresada y original son distintas");
                toaster.pop('error', "Error", "Contraseña ingresada o E-mail no corresponde");
            }
        };        
    }
});