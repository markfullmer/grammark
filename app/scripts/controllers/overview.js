'use strict';

function overviewController ($scope, $routeParams, cache, type, text, score) {
    $scope.title = 'Potential Problems:';
    $scope.score = [];
    var total = 0;
    var types = ['passive','wordiness','nominalizations','sentences','transitions','academic','grammar','eggcorns'];
    //var types = ['transitions'];

    text.parse(cache.get('text','Type or paste your writing here. Grammark does not store or reuse it in any way.',' '));

    // Generate the scores & grades
    var i = 0;
    for (i = 0; i < types.length; i++) {
      var percent = '';
      var name = types[i];
      var scorename = 'score.' + name;
      var name_score = name + '_score';
      var name_grade = name + '_grade';
      var nameScore = name + 'Score';
      var name_passingScore = name + '_passingScore';

      text.process(cache.get('text','Type or paste your writing here. Grammark does not store or reuse it in any way.',' '),name);

      type.get(name);
      if (type.data.ratioType !== 'errors') {
        if (!isNaN(score.calculate(name))) {
          percent = ' (0%)';
          if (score.calculate(name) !== 0) {
            percent = ' (' + score.calculate(name) + '%)';
          }
        }
      }
      $scope.score[name] = cache.get(name_passingScore,type.data.passingScore);
      $scope[name_score] = cache.get(name + '_count',text.getCount(name)) + percent;
      $scope[name] = cache.get(name_passingScore, type.data.passingScore);
      $scope[name_grade] = score.grade(name);
      if (type.data.scoringType === 'punitive' && $scope[name_grade] === 'warning') {
        total = total + cache.get(name + '_count',text.getCount(name));
      }

    }
    $scope.totals = total;
    if (total === 0) {
      $scope.totals = '';
      $scope.title = 'Woot! This writing looks pretty snazzy.'
    }



    // Watchers
    $scope.$watch('score.passive', function (newValue) {
      var thisType = 'passive';
      var thisType_grade = thisType + '_grade';
      cache.set(thisType + '_passingScore', newValue);
      $scope[thisType] = cache.get(thisType + '_passingScore',type.data.passingScore);
      $scope[thisType_grade] = score.grade(thisType);
    });

    $scope.$watch('score.grammar', function (newValue) {
      var thisType = 'grammar';
      var thisType_grade = thisType + '_grade';
      cache.set(thisType + '_passingScore', newValue);
      $scope[thisType] = cache.get(thisType + '_passingScore',type.data.passingScore);
      $scope[thisType_grade] = score.grade(thisType);
    });

    $scope.$watch('score.academic', function (newValue) {
      var thisType = 'academic';
      var thisType_grade = thisType + '_grade';
      cache.set(thisType + '_passingScore', newValue);
      $scope[thisType] = cache.get(thisType + '_passingScore',type.data.passingScore);
      $scope[thisType_grade] = score.grade(thisType);
    });

    $scope.$watch('score.nominalizations', function (newValue) {
      var thisType = 'nominalizations';
      var thisType_grade = thisType + '_grade';
      cache.set(thisType + '_passingScore', newValue);
      $scope[thisType] = cache.get(thisType + '_passingScore',type.data.passingScore);
      $scope[thisType_grade] = score.grade(thisType);
    });

    $scope.$watch('score.wordiness', function (newValue) {
      var thisType = 'wordiness';
      var thisType_grade = thisType + '_grade';
      cache.set(thisType + '_passingScore', newValue);
      $scope[thisType] = cache.get(thisType + '_passingScore',type.data.passingScore);
      $scope[thisType_grade] = score.grade(thisType);
    });

    $scope.$watch('score.sentences', function (newValue) {
      var thisType = 'sentences';
      var thisType_grade = thisType + '_grade';
      cache.set(thisType + '_passingScore', newValue);
      $scope[thisType] = cache.get(thisType + '_passingScore',type.data.passingScore);
      $scope[thisType_grade] = score.grade(thisType);
    });

    $scope.$watch('score.transitions', function (newValue) {
      var thisType = 'transitions';
      var thisType_grade = thisType + '_grade';
      cache.set(thisType + '_passingScore', newValue);
      $scope[thisType] = cache.get(thisType + '_passingScore',type.data.passingScore);
      $scope[thisType_grade] = score.grade(thisType);
    });

    $scope.$watch('score.eggcorns', function (newValue) {
      var thisType = 'eggcorns';
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

overviewController.$inject = ['$scope', '$routeParams', 'cache', 'type', 'text', 'score'];
