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

    .controller('FormCtrl', function ($scope, sharedProperties) {
        $scope.submitForm = function() {
            console.log("posting data...." + $scope.text);
            sharedProperties.setProperty($scope.text);
            window.location.assign("#/fix/passive");
        };
    })

    .filter('capitalize', function() {
    return function(input, all) {
      return (!!input) ? input.replace(/([^\W_]+[^\s-]*) */g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();}) : '';
    }
  })
