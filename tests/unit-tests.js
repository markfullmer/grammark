function TestController ($scope, type, text, cache, score, $routeParams, $cookies) {
    $scope.title = '';
    $scope.score = '';
    $scope.scoreText = '';
    $scope.feedback = '';
    $scope.grade = '';
    $scope.text = '';
    $scope.raw = 0;
    $scope.number = 'instances';
    var name = 'passive';
    var rawText = 'Here is some totally being awoken totally awesome text provided by nevertheless. Me. Obviously.';
    var wordsGoal = ["here","is","some","totally","being","awoken","totally","awesome","text","provided","by","nevertheless","me","obviously"];
    text.parse(cache.get('text',rawText));

    $scope.sentenceCount = text.sentenceCount;
    $scope.wordCount = text.wordCount;
    $scope.words = text.words;
    $scope.wordsGoal = wordsGoal;
    $scope.wordsResult = 'FAIL';

    $scope.sentences = text.sentences;
    $scope.hits = text.matches;
    if (_.isEqual(text.words, wordsGoal)) {
        $scope.wordsResult = 'PASS';
    }
    /*text.process(cache.get('text',' '), name);
    $scope.markup = type.data.markup; // type will have been set during text.process
    $scope.title = type.data.title; // one-time bind
    $scope.feedback = type.data.fail;
    $scope.goal = cache.get(name + '_passingScore', type.data.passingScore) + type.data.passingText;
    if (type.data.ratioType != 'errors') {
        $scope.score = '(' + score.calculate(name) + type.data.ratioType + ')';
    }
    console.log(text);

    $scope.text = text.highlight(name); // one-time bind

    $scope.sentenceCount = text.sentenceCount;
    $scope.wordCount = text.wordCount;
    $scope.words = text.words;
    $scope.sentences = text.sentences;
    $scope.hits = text.matches;
    $scope.hitsResult = 'PASS';
    var hitsGoal = ["being awoken"];
    if ($scope.hits != hitsGoal) {
        $scope.hitsResult = 'FAIL';
    }
    // Monitor the user input text for changes
    $scope.$watch( 'text', function (newValue, oldValue) {
        //cache.set('text', newValue); // record the new text value
        text.parse(cache.get('text'), ' ');
        text.process(cache.get('text',' '), name);
        $scope.matches = cache.get(name + '_matches', text.matches);
        $scope.grade = score.grade(name);
        $scope.raw = cache.get(name + '_count', 0);
        $scope.number = 'instances';
        if ($scope.raw == 1) {
            $scope.number = 'instance';
        }
        if (type.data.ratioType != 'errors') {
            $scope.score = '(' + score.calculate(name) + type.data.ratioType + ')';
        }
        $scope.feedback = cache.get(name + '_fail','');
        if ($scope.grade == 'success') {
            $scope.feedback = cache.get(name + '_pass','');
        }
    });

    $scope.reHighlight = function() {
        $scope.text = text.highlight(name);
    };*/
}

// This is an obviously totally awesome man. totally totally totally totally totally totally totally totally totally totally totally totally totally totally totally
// This is an obviously totally aweso however, although moreover furthermore nevertheless in conclusion in contrast in addition additionally in sum alternately alternatively besides
