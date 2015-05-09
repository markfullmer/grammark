angular.module('grammarkApp',['underscore','ngRoute'])

// Setting configuration for application
.config(function ($routeProvider) {
    $routeProvider.when('/overview', {
        controller: overviewCtrl,
        templateUrl: 'views/overview.html'
    });
    $routeProvider.when('/fix/:postId', {
        controller: individualCtrl,
        templateUrl: 'views/individual.html'
    });
    $routeProvider.when('/page/:postId', {
        controller: pageCtrl,
        templateUrl: 'views/page.html'
    });
    $routeProvider.otherwise({
        redirectTo: '/',
        templateUrl: 'views/front.html'
    });

})

.config(['$httpProvider', function ($httpProvider) {
        // enable http caching
       $httpProvider.defaults.cache = true;
}])

.controller ('formCtrl', function ($scope, $routeParams, cache, text) {
    $scope.submitForm = function() {
        cache.set('text', $scope.text);
        window.location.assign("#/overview");
    };
    $scope.view = function() {
        window.location.assign("#/fix/passive");
    };
    $scope.resetForm = function() {
        cache.clearAll();
        window.location.assign("#/");
    };
    $scope.highlight = function() {
        text.highlight();
    }
})

.service('text', function (cache, type, $routeParams) {
    var current = '';
    var existing = '';
    var sanitized = '';
    var sentencecount = '';
    var wordcount = '';
    var matches = [];
    var matchIds = [];
    var find = [];
    var highlighted = '';
    var instances = 0;

    return {
        parse : function (rawText) {

            var withLineBreaks = rawText.replace(/<br>/g,'LINEBREAK');
            var withLineBreaks = withLineBreaks.replace(/<br \/>/g,'LINEBREAK');
            var withLineBreaks = withLineBreaks.replace(/<p (.*?)>/gi,'PARAGRAPHSTART');
/*            withLineBreaks.replace(/[This]/g,'fullmer');
            withLineBreaks.replace(/<br \/>/g,'fullmer');*/
            var noSuggestions = String(withLineBreaks).replace(/<div class="suggestion">(.*?)<\/div>/gi, '');
            this.sanitized = String(noSuggestions).replace(/<[^>]+>/gm, '');
            //this.sanitized = noSuggestions;
            this.noLineBreaks = this.sanitized.replace(/PARAGRAPHEND/g,' ');
            this.noLineBreaks = this.noLineBreaks.replace(/PARAGRAPHSTART/g,' ');
            this.noLineBreaks = this.noLineBreaks.replace(/LINEBREAK/g,' ');
            this.semicolonsAndPeriods = this.noLineBreaks.replace(/[,\-\/#!$%\^&\*:{}=\-_`~()]/g,'');
            this.sentences = this.semicolonsAndPeriods.replace(/[;]/g,'.');
            this.sentenceCount = this.sentences.trim().split(/[\.]/g).length -1;
            this.noPunctuation = ' ' + this.sentences.replace(/[\.]/g,'').toLowerCase() + ' ';
            this.words = this.noPunctuation.trim().split(/\s+/);
            this.wordCount = this.words.length;
        },

        process: function (rawText, analysisType) {
            //console.log(this.sanitized);
            var matches = []; // reset
            var count = 0;

            type.get(analysisType);
            var corrections = type.data.corrections;
            for (var i in corrections) {

                var needle = i.replace(/[,\-\/#!$%\^&\*:{}=\-_`~();\.]/g,'');
                if (this.noPunctuation.indexOf(' ' + needle + ' ') !=-1) {
                    matches.push(i);
                    count = count + this.countOccurrences(this.noPunctuation,' ' + needle + ' ');
                }
                var uppercase = needle.substr(0, 1).toUpperCase() + needle.substr(1);
                if (this.noPunctuation.indexOf(' ' + uppercase + ' ') !=-1) {
                    matches.push(i);
                    // count does not need to be performed, as case-insensitive regex
                }
            }
            this.matches = _.uniq(matches);
           // console.log(_.uniq(matches));
            cache.set(analysisType + '_count', count);
            cache.set(analysisType + '_matches', this.matches);
        },

        highlight: function () {
            this.highlighted = this.sanitized;
            this.highlighted = this.highlighted.split("LINEBREAK").join("<br>");
            this.highlighted = this.highlighted.split("PARAGRAPHSTART").join("<br><br>");
            //var cachename = $routeParams.postId + '_matches';
            //cache.get(cachename,['empty']);
            type.get($routeParams.postId);
            for (i = 0; i < this.matches.length; i++) {
                var match = this.matches[i];
                var suggestion = '';
                if (type.data.corrections[match] != '') {
                    var suggestion = '<div class="suggestion">' + type.data.corrections[match] + '</div>';
                }
                this.highlighted = this.highlighted.split(' ' + match + ' ').join(' <mark>' + match + suggestion + '</mark> ');
                this.highlighted = this.highlighted.split(' ' + match + '.').join(' <mark>' + match + suggestion + '</mark>.');
                this.highlighted = this.highlighted.split(' ' + match + ',').join(' <mark>' + match + suggestion + '</mark>,');
                var uppercase = match.substr(0, 1).toUpperCase() + match.substr(1);
                this.highlighted = this.highlighted.split(uppercase).join('<mark>' + uppercase + '</mark>');
            }

            return this.highlighted;
        },

        getCount: function (analysisType) {
            this.process(cache.get('text',' '), analysisType);
            return cache.print(analysisType + '_count');
        },

        getMatches: function (analysisType) {
            this.process(cache.get('text',' '), analysisType);
            return cache.print(analysisType + '_matches');
        },

        countOccurrences: function (str, value) {
            var regExp = new RegExp(value, "gi");
            return str.match(regExp) ? str.match(regExp).length : 0;
        },
    };
})

.service('cache', function() {
    var cache = [];

    return {
        get: function (name, defaultvalue) {
            if (!(name in cache)) {
                this.set(name,defaultvalue);
                console.log('not in cache. Saved.');
            }
            return cache[name];
        },
        isset: function (name) {
            var result = true;
            if (!(name in cache)) {
                result = false;
            }
            return result;
        },
        print: function(name) {
            var result = 'Cache ' + name + 'not set';
            if (name in cache) {
                result = cache[name];
            }
            return result;
        },
        set: function (name, value) {
            cache[name] = value;
        },
        clear: function (name) {
            cache.name = [];
        },
        clearAll: function () {
            cache = [];
        },
        getAll: function() {
            return cache;
        }
    };
})

.service('score', function ($routeParams, type, text, cache) {

    this.calculate = function(analysisType) {
        var result = 0;
        var count = cache.get(analysisType + '_count', '10');
        var ratioType = cache.get(analysisType + '_ratioType','errors');
        switch (ratioType) {
            case 'errors':
                result = count;
                break;
            case '% of sentences':
                result = (count/text.sentenceCount)*100;
                break;
            case ' per sentence':
                result = (count/text.sentenceCount);
                break;
            case '% of words':
                result = (count/text.wordCount)*100;
                break;
        }
        return parseInt(result, 10);
    }
    this.grade = function(analysisType) {
        var result = 'success'; // default
        var passingScore = analysisType + '_passingScore';
        var scoringType = analysisType + '_scoringType';
        if (!cache.isset(passingScore) || !cache.isset(scoringType)) {
            type.get(analysisType);
            //console.log('loaded analysis Type');
        }
        var criterion = cache.get(passingScore, type.data.passingScore);
        var scoreType = cache.get(scoringType, type.data.scoringType);
        //console.log('cached');

        switch (scoreType) {
        case 'punitive':
            if (this.calculate(analysisType) > criterion) {
                result = 'warning';
            }
            break;
        case 'positive':
            if (this.calculate(analysisType) < criterion) {
                result = 'warning';
            }
            break;
        }
        return result;
    }
})

.service('type', function (cache) {
    var data = '';

    this.get = function(value) {
        switch (value) {
        case 'passive':
            var data = new passive();
            cache.set('passive_scoringType',data.scoringType);
            cache.set('passive_ratioType',data.ratioType);
            break;
        case 'wordiness':
            var data = new wordiness();
            cache.set('wordiness_scoringType',data.scoringType);
            cache.set('wordiness_ratioType',data.ratioType);
            break;
        case 'grammar':
            var data = new grammar();
            cache.set('grammar_scoringType',data.scoringType);
            cache.set('grammar_ratioType',data.ratioType);
            break;
        case 'academic':
            var data = new academic();
            cache.set('academic_scoringType',data.scoringType);
            cache.set('grammar_ratioType',data.ratioType);
            break;
        case 'transitions':
            var data = new transitions();
            cache.set('transitions_scoringType',data.scoringType);
            cache.set('transitions_ratioType',data.ratioType);
            break;
        case 'nominalizations':
            var data = new nominalizations();
            cache.set('nominalizations_scoringType',data.scoringType);
            cache.set('nominalizations_ratioType',data.ratioType);
            break;
        case 'sentences':
            var data = new sentences();
            cache.set('sentences_scoringType',data.scoringType);
            cache.set('sentences_ratioType',data.ratioType);
            break;
        }
        this.data = data;
        return data;
    }
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
