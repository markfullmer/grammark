angular.module('grammarkApp',['underscore','ngRoute'])
    // Setting configuration for application
    .config(function ($routeProvider) {
        $routeProvider.when('/overview', {
            controller: overviewCtrl,
            templateUrl: 'templates/overview.html'
        });
        $routeProvider.when('/fix/:postId', {
            controller: individualCtrl,
            templateUrl: 'templates/individual.html'
        });
        $routeProvider.when('/page/:postId', {
            controller: pageCtrl,
            templateUrl: 'templates/page.html'
        });
        $routeProvider.otherwise({
            redirectTo: '/',
            templateUrl: 'templates/front.html'
        });

    })

    .controller('formCtrl', function ($scope, textProperties, $routeParams) {
        $scope.submitForm = function() {
            textProperties.setCurrent($scope.text);
            window.location.assign("#/overview");
        };
        $scope.resetForm = function() {
            textProperties.setCurrent('');
            textProperties.setExisting('');
            window.location.assign("#/");
        };
    })

    .controller('textCtrl', function ($scope, textProperties) {
        $scope.text = textProperties.getCurrent();
        $scope.$watch( 'text',
        function(newValue, oldValue){
            var output = String(newValue).replace(/<[^>]+>/gm, '');
            var raw = output.trim().split(/\s+/);
            $scope.wordcount = raw.length;
            $scope.words = _.uniq(raw);
        });
        $scope.change = function() {
            textProperties.setCurrent($scope.text);
        };
        $scope.reloadForm = function() {
            $scope.text = ($scope.text).replace('hello','<b>hello</b>');
            textProperties.setCurrent($scope.text);
            textProperties.setExisting($scope.text);
        };
    })

    .service('textProperties', function () {
        var current = '';
        var existing = '';
        var begin = false;

        return {
            getCurrent: function () {
                return current;
            },
            setCurrent: function(value) {
                current = value;
            },
            getExisting: function(value) {
                return existing;
            },
            setExisting: function(value) {
                existing = value;
            }
        };
    })

    .directive("contenteditable", function() {
      return {
        restrict: "A",
        require: "ngModel",
        link: function(scope, element, attrs, ngModel) {

          function read() {
            ngModel.$setViewValue(element.html());
          }

          ngModel.$render = function() {
            element.html(ngModel.$viewValue || "");
          };

          element.bind("blur keyup change", function() {
            scope.$apply(read);
          });
        }
      }
    })

    .filter('capitalize', function() {
    return function(input, all) {
      return (!!input) ? input.replace(/([^\W_]+[^\s-]*) */g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();}) : '';
    }
  })
