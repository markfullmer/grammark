angular.module('grammarkApp', ['ngRoute'])
    // Setting configuration for application
    .config(function ($routeProvider) {
        $routeProvider.when('/overview', {
            controller: overviewCtrl,
            templateUrl: 'templates/overview.html'
        });
        $routeProvider.when('/fix/:postId', {
            controller: fixCtrl,
            templateUrl: 'templates/fix.html'
        });
        $routeProvider.when('/page/:postId', {
            controller: pageCtrl,
            templateUrl: 'templates/page.html'
        });
        $routeProvider.otherwise({
            redirectTo: '/',
            templateUrl: 'templates/home.html'
        });

    })
    .service('sharedProperties', function () {
        var property = '';

        return {
            getProperty: function () {
                return property;
            },
            setProperty: function(value) {
                property = value;
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

    .controller('FormCtrl', function ($scope, sharedProperties) {
        $scope.submitForm = function() {
            console.log("posting data...." + $scope.text);
            sharedProperties.setProperty($scope.text);
            window.location.assign("#/fix/passive");
        };
    })

    .controller('textCtrl', function ($scope, sharedProperties) {
      $scope.counter = 0;
      $scope.change = function() {
        sharedProperties.setProperty($scope.text);
      };
    })

    .filter('capitalize', function() {
    return function(input, all) {
      return (!!input) ? input.replace(/([^\W_]+[^\s-]*) */g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();}) : '';
    }
  })
