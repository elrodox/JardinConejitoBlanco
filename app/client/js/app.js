(function() {
    
var app = angular.module('conejitoBlanco', ['ngRoute', 'ngResource']);


app.directive('mision', function() {
  return {
    templateUrl: '?r=site/misionVision'
  };
});

app.directive('navbar', function() {
  return {
    templateUrl: 'views/navbar.html'
  };
});

});