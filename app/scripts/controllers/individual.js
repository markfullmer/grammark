'use strict';

function individualController ($scope, type, text, cache, score, $routeParams) {
    $scope.title = '';
    $scope.score = '';
    $scope.scoreText = '';
    $scope.feedback = '';
    $scope.grade = '';
    $scope.text = '';
    $scope.raw = 0;
    $scope.number = 'instances';

    text.process(cache.get('text','Type or paste your writing here. Grammark does not store or reuse it in any way.'), $routeParams.postId);
    $scope.markup = type.data.markup; // type will have been set during text.process
    $scope.title = type.data.title; // one-time bind
    $scope.feedback = type.data.fail;
    $scope.goal = cache.get($routeParams.postId + '_passingScore', type.data.passingScore) + type.data.passingText;
    if (type.data.ratioType !== 'errors') {
        $scope.score = '(' + score.calculate($routeParams.postId) + type.data.ratioType + ')';
    }

    $scope.text = text.highlight($routeParams.postId); // one-time bind

    // Monitor the user input text for changes
    $scope.$watch( 'text', function (newValue) {
        cache.set('text', newValue); // record the new text value
        text.process(cache.get('text',' '), $routeParams.postId);
        $scope.matches = cache.get($routeParams.postId + '_matches', text.matches);
        $scope.grade = score.grade($routeParams.postId);
        $scope.raw = cache.get($routeParams.postId + '_count', 0);
        $scope.number = 'instances';
        if ($scope.raw === 1) {
            $scope.number = 'instance';
        }
        if (type.data.ratioType !== 'errors') {
            $scope.score = '(' + score.calculate($routeParams.postId) + type.data.ratioType + ')';
        }
        $scope.feedback = cache.get($routeParams.postId + '_fail','');
        if ($scope.grade === 'success') {
            $scope.feedback = cache.get($routeParams.postId + '_pass','');
        }
    });

    $scope.reHighlight = function() {
        $scope.text = text.highlight($routeParams.postId);
    };
}

individualController.$inject = ['$scope', 'type', 'text', 'cache', 'score', '$routeParams'];
