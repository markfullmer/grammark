'use strict';

function resourceController ($scope, $routeParams, type) {
    $scope.title = 'Error';
    $scope.content = 'No page with that ID';
    var table = [];
    var count = 0;
    var values = [];
    switch ($routeParams.postId) {
        case 'transitions':
            $scope.title = 'Transitions';
            type.get('transitions');
            table = [];
            count = 0;
            values = type.data.corrections;
            for (var i in values) {
                table.push({
                    find: i,
                    suggestion: values[i],
                });
            }
            $scope.data = table;
            break;
        case 'wordiness':
            $scope.title = 'Wordiness';
            type.get('wordiness');
            table = [];
            count = 0;
            values = type.data.corrections;
            for (var i in values) {
                table.push({
                    find: i,
                    suggestion: values[i],
                });
            }
            $scope.data = table;
            break;
        case 'grammar':
            $scope.title = 'Grammar';
            type.get('grammar');
            table = [];
            count = 0;
            values = type.data.corrections;
            for (var i in values) {
                table.push({
                    find: i,
                    suggestion: values[i],
                });
            }
            $scope.data = table;
            break;
        case 'eggcorns':
            $scope.title = 'Eggcorns';
            type.get('eggcorns');
            table = [];
            count = 0;
            values = type.data.corrections;
            for (var i in values) {
                table.push({
                    find: i,
                    suggestion: values[i],
                });
            }
            $scope.data = table;
            break;
    }
}

resourceController.$inject = ['$scope', '$routeParams','type'];

