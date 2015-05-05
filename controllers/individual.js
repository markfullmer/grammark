function individualCtrl ($scope, type, text, cache, score) {
    $scope.title = '';
    $scope.score = '';
    $scope.scoreText = '';
    $scope.feedback = '';
    $scope.grade = '';
    $scope.text = '';
    $scope.matches = '';
    $scope.raw = '';
    $scope.number = 'instances';

    type.get();
    text.process();
    $scope.markup = type.data.markup;
    $scope.title = type.data.title; // one-time bind
    $scope.feedback = type.data.fail;
    $scope.text = text.highlight(); // one-time bind
    $scope.grade = score.grade();
    $scope.raw = text.instances;
    if (text.instances == 1) {
        $scope.number = 'instance';
    }
    $scope.goal = type.data.passingScore + type.data.passingText;
    if (type.data.ratioType != 'errors') {
        $scope.score = '(' + score.calculate() + type.data.ratioType + ')';
    }


    // Monitor the user input text for changes
    $scope.$watch( 'text',
        function(newValue, oldValue){
            cache.set('text', newValue); // record the new text value
            text.process();
            $scope.matches = text.matches;
            $scope.grade = score.grade();
            $scope.raw = text.instances;
            $scope.number = 'instances';
            if (text.instances == 1) {
                $scope.number = 'instance';
            }
            if (type.data.ratioType != 'errors') {
                $scope.score = '(' + score.calculate() + type.data.ratioType + ')';
            }
        });

    $scope.reHighlight = function() {
        $scope.text = text.highlight();
    };
}

// This is an obviously totally awesome man. totally totally totally totally totally totally totally totally totally totally totally totally totally totally totally
// This is an obviously totally aweso however, although moreover furthermore nevertheless in conclusion in contrast in addition additionally in sum alternately alternatively besides
