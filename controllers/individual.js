function individualCtrl ($scope, type, text, cache) {
    $scope.title = '';
    $scope.score = '';
    $scope.scoreText = '';
    $scope.feedback = '';
    $scope.graphic = '';
    $scope.text = '';
    $scope.matches = '';

    type.get();
    text.process();
    $scope.markup = type.data.markup;
    $scope.title = type.data.title; // one-time bind
    $scope.feedback = type.data.fail;
    $scope.text = text.highlight(); // one-time bind

    $scope.$watch( 'text',
        function(newValue, oldValue){
            cache.set('text', newValue);
            text.process();
            $scope.matches = text.matches;

        });

    $scope.reHighlight = function() {
        $scope.text = text.highlight();
    };
}


