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

    .controller('textCtrl', function ($scope, textProperties, $http) {

        $scope.find = textProperties.getFind('academic');
        $scope.text = textProperties.getCurrent();
        $scope.$watch( 'text',
        function(newValue, oldValue){
            var sanitized = String(newValue).replace(/<[^>]+>/gm, '') + ' ';
            var noPunctuation = sanitized.replace(/[\.,-\/#!$%\^&\*;:{}=\-_`~()]/g,"");
            var raw = sanitized.trim().split(/\s+/);
            $scope.wordcount = raw.length;
            $scope.hits = [];
            var arrayLength = $scope.find.length;
            for (var i = 0; i < arrayLength; i++) {
                if (noPunctuation.indexOf(' ' + $scope.find[i] + ' ') !=-1) {
                    $scope.hits.push($scope.find[i]);
                }
                var uppercase = $scope.find[i].substr(0, 1).toUpperCase() + $scope.find[i].substr(1);
                if (noPunctuation.indexOf(' ' + uppercase + ' ') !=-1) {
                    $scope.hits.push($scope.find[i]);
                }
            }
            $scope.hits = _.uniq($scope.hits);
        });

        $scope.change = function() {
            textProperties.setCurrent($scope.text);
        };

        $scope.reloadForm = function() {
            var arrayLength = $scope.hits.length;
            var text = $scope.text;
            for (var i = 0; i < arrayLength; i++) {
                var text = text.split($scope.hits[i]).join('<mark>' + $scope.hits[i] + '</mark>');
                var uppercase = $scope.hits[i].substr(0, 1).toUpperCase() + $scope.hits[i].substr(1);
                var text = text.split(uppercase).join('<mark>' + uppercase + '</mark>');
            }
            $scope.text = text;
            textProperties.setCurrent($scope.text);
            textProperties.setExisting($scope.text);
        };
    })

    .service('textProperties', function ($http) {
        var current = '';
        var existing = '';
        var begin = false;
        var find = [];

        return {
            getFind: function (value) {
                $http.get('data/' + value + '.json')
                .then(function(res){
                    var arrayLength = res.data.length;
                    for (var i = 0; i < arrayLength; i++) {
                        find[i] = res.data[i].error;
                    }
                });
                return find;
            },
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
