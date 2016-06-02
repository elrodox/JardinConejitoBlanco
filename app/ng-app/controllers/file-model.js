angular.module('myApp')
    .directive('fileModel', [function() {
        return {
            controller: ['$parse', '$element', '$attrs', '$scope', function($parse, $element, $attrs, $scope){
                var exp = $parse($attrs.filesModel);
 
                $element.on('change', function(){
                    exp.assign($scope, this.files);
                    $scope.$apply();
                });
            }]
        }
    }]);