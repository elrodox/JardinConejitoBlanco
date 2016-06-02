
var app = angular.module('conejitoBlanco', ['ngRoute', 'ngResource'])

.directive('navbar', function() {
  return {
    templateUrl: 'views/navbar.html'
  };
});
