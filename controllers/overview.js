function overviewCtrl ($scope, $routeParams, cache, type, text, score) {
    $scope.title = "Potential Problems";
    $scope.score = [];
    var total = 0;
    var types = ['passive','wordiness','nominalizations','sentences','transitions','academic','grammar'];
    //var types = ['transitions'];

    text.parse(cache.get('text','This is totally, awoken an awesome really. seen Because man is used. Nevertheless. However.',' '));

    // Generate the scores & grades
    for (i = 0; i < types.length; i++) {
      var percent = '';
      var name = types[i];
      var scorename = 'score.' + name;
      var name_score = name + '_score';
      var name_grade = name + '_grade';
      var nameScore = name + 'Score';
      var name_passingScore = name + '_passingScore';

      text.process(cache.get('text','This is totally, awoken an awesome really. seen Because man is used. Nevertheless. However.',' '),name);

      type.get(name);
      if (type.data.ratioType != 'errors') {
        if (!isNaN(score.calculate(name)) && score.calculate(name) != 0) {
          percent = ' (' + score.calculate(name) + '%)';
        }
      }
      if (type.data.scoringType == 'punitive') {
        total = total + cache.get(name + '_count',text.getCount(name));
      }
      $scope.score[name] = cache.get(name_passingScore,type.data.passingScore);
      $scope[name_score] = cache.get(name + '_count',text.getCount(name)) + percent;
      $scope[name] = cache.get(name_passingScore, type.data.passingScore);
      $scope[name_grade] = score.grade(name);

    }

    $scope.totals = total;

    // Watchers
    $scope.$watch('score.passive', function (newValue, oldValue) {
      var thisType = 'passive';
      var thisType_grade = thisType + '_grade';
      cache.set(thisType + '_passingScore', newValue);
      $scope[thisType] = cache.get(thisType + '_passingScore',type.data.passingScore);
      $scope[thisType_grade] = score.grade(thisType);
    });

    $scope.$watch('score.grammar', function (newValue, oldValue) {
      var thisType = 'grammar';
      var thisType_grade = thisType + '_grade';
      cache.set(thisType + '_passingScore', newValue);
      $scope[thisType] = cache.get(thisType + '_passingScore',type.data.passingScore);
      $scope[thisType_grade] = score.grade(thisType);
    });

    $scope.$watch('score.academic', function (newValue, oldValue) {
      var thisType = 'academic';
      var thisType_grade = thisType + '_grade';
      cache.set(thisType + '_passingScore', newValue);
      $scope[thisType] = cache.get(thisType + '_passingScore',type.data.passingScore);
      $scope[thisType_grade] = score.grade(thisType);
    });

    $scope.$watch('score.nominalizations', function (newValue, oldValue) {
      var thisType = 'nominalizations';
      var thisType_grade = thisType + '_grade';
      cache.set(thisType + '_passingScore', newValue);
      $scope[thisType] = cache.get(thisType + '_passingScore',type.data.passingScore);
      $scope[thisType_grade] = score.grade(thisType);
    });

    $scope.$watch('score.wordiness', function (newValue, oldValue) {
      var thisType = 'wordiness';
      var thisType_grade = thisType + '_grade';
      cache.set(thisType + '_passingScore', newValue);
      $scope[thisType] = cache.get(thisType + '_passingScore',type.data.passingScore);
      $scope[thisType_grade] = score.grade(thisType);
    });

    $scope.$watch('score.sentences', function (newValue, oldValue) {
      var thisType = 'sentences';
      var thisType_grade = thisType + '_grade';
      cache.set(thisType + '_passingScore', newValue);
      $scope[thisType] = cache.get(thisType + '_passingScore',type.data.passingScore);
      $scope[thisType_grade] = score.grade(thisType);
    });

    $scope.$watch('score.transitions', function (newValue, oldValue) {
      var thisType = 'transitions';
      var thisType_grade = thisType + '_grade';
      cache.set(thisType + '_passingScore', newValue);
      $scope[thisType] = cache.get(thisType + '_passingScore',type.data.passingScore);
      $scope[thisType_grade] = score.grade(thisType);
    });

    // Presets
    $scope.humanities = function() {
      cache.set('passive_passingScore', '60');
      $scope.passive = cache.get('passive_passingScore',type.data.passingScore);
      $scope.score.passive = cache.get('passive_passingScore',type.data.passingScore);
      $scope.passive_grade = score.grade('passive');
      //$scope.transitions = $scope.score.transitions;
    };

}
