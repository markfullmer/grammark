'use strict';

/**
 * @ngdoc overview
 * @name grammarkApp
 * @description
 * # grammarkApp
 *
 * Main module of the application.
 */
angular
  .module('grammarkApp', [
    'ngRoute',
    'ngSanitize',
    'underscore',
  ])
// Setting configuration for application
.config(function ($routeProvider) {
  $routeProvider.when('/overview', {
      controller: overviewController,
      templateUrl: 'views/overview.html'
  });
  $routeProvider.when('/fix/:postId', {
      controller: individualController,
      templateUrl: 'views/individual.html'
  });
  $routeProvider.when('/page/:postId', {
      controller: pageController,
      templateUrl: 'views/page.html'
  });
  $routeProvider.when('/contact', {
      controller: ContactController,
      templateUrl: 'models/contact.html'
  });
  $routeProvider.when('/resources/:postId', {
      controller: resourceController,
      templateUrl: 'views/resources.html'
  });
  $routeProvider.otherwise({
      redirectTo: '/',
      templateUrl: 'views/front.html'
  });
})

.controller ('formCtrl', function ($scope, $routeParams, cache, text) {
    $scope.submitForm = function() {
        cache.set('text', $scope.text);
        document.body.scrollTop = document.documentElement.scrollTop = 0;
        window.location.assign('#/overview');
    };
    $scope.view = function() {

        window.location.assign('#/fix/passive');
    };
    $scope.resetForm = function() {
        //document.cookie = 'text=';
        cache.clearAll();
        document.body.scrollTop = document.documentElement.scrollTop = 0;
        window.location.assign('#/');
    };
})

.controller ('navController', function ($scope, $routeParams, cache, text) {
    $scope.tabs = [{
        title: 'Overview',
        url: 'overview',
        active: '',
    }, {
        title: 'Passive Voice',
        url: 'fix/passive',
        active: '',
    }, {
        title: 'Wordiness',
        url: 'fix/wordiness',
        active: '',
    }, {
        title: 'Academic Style',
        url: 'fix/academic',
        active: '',
    }, {
        title: 'Grammar',
        url: 'fix/grammar',
        active: '',
    }, {
        title: 'Nominalizations',
        url: 'fix/nominalizations',
        active: '',
    }, {
        title: 'Sentences',
        url: 'fix/sentences',
        active: '',
    }, {
        title: 'Eggcorns',
        url: 'fix/eggcorns',
        active: '',
    }, {
        title: 'Transitions',
        url: 'fix/transitions',
        active: '',
  }];

    angular.forEach($scope.tabs, function(tab) {
        console.log($routeParams.postId);
        if (tab.url === 'fix/' + $routeParams.postId) {
            tab.active = 'secondary';
        }

    });
})

.service('text', function (cache, type) {
    var current = '';
    var existing = '';
    var sanitized = '';
    var sentenceCount = '';
    var wordcount = '';
    var matches = [];
    var matchIds = [];
    var find = [];
    var highlighted = '';
    var instances = 0;

    return {
        parse : function (rawText) {

            var withLineBreaks = rawText.replace(/<br(.*?)>/g,'LINEBREAK');
            withLineBreaks = withLineBreaks.replace(/<p(.*?)>/gi,'PARAGRAPHSTART');
            var simpleQuotes= withLineBreaks.replace(/[\u2018\u2019]/g, "'").replace(/[\u201C\u201D]/g, '"');
            var noSuggestions = String(simpleQuotes).replace(/<span class="suggestion">(.*?)<\/span>/gi, '');
            this.sanitized = String(noSuggestions).replace(/<[^>]+>/gm, '');
            this.noLineBreaks = this.sanitized.replace(/PARAGRAPHEND/g,' ');
            this.noLineBreaks = this.noLineBreaks.replace(/PARAGRAPHSTART/g,' ');
            this.noLineBreaks = this.noLineBreaks.replace(/LINEBREAK/g,' ');
            var placeholder = this.noLineBreaks.replace(/[\-\/#!\"$%\^&\*:{}=\-_`~()]/g,'');
            this.spacedPunctuation = placeholder.replace(/[\.,;]/g,' .');
            this.semicolonsAndPeriods = this.noLineBreaks.replace(/[,\-\/#!\"$%\^&\*:{}=\-_`~()]/g,'');
            this.sentences = this.semicolonsAndPeriods.replace(/[?;]/g,'.');
            this.sentenceCount = this.sentences.trim().split(/[\.]/g).length -1;
            this.noPunctuation = ' ' + this.sentences.replace(/[\.]/g,'').toLowerCase() + ' ';
            this.words = this.noPunctuation.trim().split(/\s+/);
            this.wordCount = this.words.length;
        },

        process: function (rawText, analysisType) {
            type.get(analysisType);
            this.parse(rawText);
            var count = 0;
            if (typeof type.data.process === 'function') {
                var result = type.data.process(this.spacedPunctuation);
                this.matches = result[0];
                count = result[1];
            }
            else {
                var matches = []; // reset
                var corrections = type.data.corrections;
                for (var i in corrections) {

                    var needle = i.replace(/[\.]/g,' .');
                    if (this.spacedPunctuation.indexOf(' ' + needle + ' ') !==-1) {
                        matches.push(i);
                        count = count + this.countOccurrences(this.spacedPunctuation,' ' + needle + ' ');
                    }
                    var uppercase = needle.substr(0, 1).toUpperCase() + needle.substr(1);
                    if (this.spacedPunctuation.indexOf(' ' + uppercase + ' ') !==-1) {
                        matches.push(i);
                        count = count + this.countOccurrences(this.spacedPunctuation,' ' + uppercase + ' ');
                    }
                }
                this.matches = _.uniq(matches);
            }
            cache.set(analysisType + '_count', count);
            cache.set(analysisType + '_matches', this.matches);
        },

        highlight: function (analysisType) {
            // todo -- what about getting the latest text?
            this.highlighted = this.sanitized;
            this.highlighted = this.highlighted.split('LINEBREAK').join('<br>');
            this.highlighted = this.highlighted.split('PARAGRAPHSTART').join('<br><br>');
            this.highlighted = this.highlighted.replace(/\n{2}/g, ' </p><p>');
            this.highlighted = this.highlighted.replace(/\n/g, ' <br />');
            this.highlighted = this.highlighted.replace(/\n/g, ' <br />');
            this.highlighted = this.highlighted.replace('&nbsp;', ' ');
            type.get(analysisType);
            var i = 0;
            for (i = 0; i < this.matches.length; i++) {
                var match = this.matches[i];
                var suggestion = '';
                if (type.data.corrections[match] !== undefined) {
                    suggestion = '<span class="suggestion">' + type.data.corrections[match] + '</span>';
                }
                this.highlighted = this.highlighted.split(' ' + match + ' ').join(' <mark>' + suggestion + match + '</mark> ');
                this.highlighted = this.highlighted.split(' ' + match + '.').join(' <mark>' + suggestion + match + '</mark>.');
                this.highlighted = this.highlighted.split(' ' + match + ',').join(' <mark>' + suggestion + match + '</mark>,');
                this.highlighted = this.highlighted.split(' ' + match + ';').join(' <mark>' + suggestion + match + '</mark>;');
                this.highlighted = this.highlighted.split('"' + match + ',').join('"<mark>' + suggestion + match + '</mark>,');
                this.highlighted = this.highlighted.split('"' + match + '"').join('"<mark>' + suggestion + match + '</mark>"');
                this.highlighted = this.highlighted.split('<br>' + match + ' ').join('<br><mark>' + suggestion + match + '</mark> ');
                var uppercase = match.substr(0, 1).toUpperCase() + match.substr(1);
                this.highlighted = this.highlighted.split(' ' + uppercase + ' ').join(' <mark>' + suggestion + uppercase + '</mark> ');
                this.highlighted = this.highlighted.split(' ' + uppercase + '.').join(' <mark>' + suggestion + uppercase + '</mark>.');
                this.highlighted = this.highlighted.split(' ' + uppercase + ',').join(' <mark>' + suggestion + uppercase + '</mark>,');
                this.highlighted = this.highlighted.split(' ' + uppercase + ';').join(' <mark>' + suggestion + uppercase + '</mark>;');
                this.highlighted = this.highlighted.split('"' + uppercase + ',').join('"<mark>' + suggestion + uppercase + '</mark>,');
                this.highlighted = this.highlighted.split('"' + uppercase + '"').join('"<mark>' + suggestion + uppercase + '</mark>"');
                this.highlighted = this.highlighted.split('<br>' + uppercase + ' ').join('<br><mark>' + suggestion + uppercase + '</mark> ');
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
            var regExp = new RegExp(value, 'g');
            return str.match(regExp) ? str.match(regExp).length : 0;
        },
    };
})

.service('cache', function () {
    var cache = [];

    return {
        get: function (name, defaultValue) {
            if (!(name in cache)) {
                this.set(name,defaultValue);
                //console.log('not in cache. Saved.');
/*                if (name == 'text') {
                    document.cookie = "text=" + defaultValue;
                }*/
            }
/*            if (name == 'text') {
                cache[name] = $cookies.text;
            }*/
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
            if (name === 'text') {
                    document.cookie = 'text=' + value;
            }
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

.service('score', function (type, text, cache) {

    this.calculate = function(analysisType) {
        var result = 0;
        var count = cache.get(analysisType + '_count', '10');
        var ratioType = cache.get(analysisType + '_ratioType','errors');
        var sentenceCount = 1;
        var wordCount = 1;
        if (text.sentenceCount !== 0) {
            sentenceCount = text.sentenceCount;
        }
        if (text.wordCount !== 0) {
            wordCount = text.wordCount;
        }
        switch (ratioType) {
            case 'errors':
                result = count;
                break;
            case '% of sentences':
                result = (count/sentenceCount)*100;
                break;
            case ' per sentence':
                result = (count/sentenceCount);
                break;
            case '% of words':
                result = (count/wordCount)*100;
                break;
        }
        return parseInt(result, 10);
    };
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
    };
})

.service('type', function (cache) {
    var data = [];
    var name = '';

    this.get = function(value) {
        switch (value) {
        case 'passive':
            data = new passive();
            name = 'passive';
            break;
        case 'wordiness':
            data = new wordiness();
            name = 'wordiness';
            break;
        case 'grammar':
            data = new grammar();
            name = 'grammar';
            break;
        case 'academic':
            data = new academic();
            name = 'academic';
            break;
        case 'transitions':
            data = new transitions();
            name = 'transitions';
            break;
        case 'nominalizations':
            data = new nominalizations();
            name = 'nominalizations';
            break;
        case 'sentences':
            data = new sentences();
            name = 'sentences';
            break;
        case 'eggcorns':
            data = new eggcorns();
            name = 'eggcorns';
            break;
        }
        cache.set(name + '_scoringType',data.scoringType);
        cache.set(name + '_ratioType',data.ratioType);
        cache.set(name + '_pass',data.pass);
        cache.set(name + '_fail',data.fail);
        this.data = data;
        return data;
    };
})

.directive('contenteditable', function() {
  return {
    restrict: 'A',
    require: 'ngModel',
    link: function(scope, element, attrs, ngModel) {

      function read() {
        ngModel.$setViewValue(element.html());
      }

      ngModel.$render = function() {
        element.html(ngModel.$viewValue || '');
      };

      element.bind('blur keyup change', function() {
        scope.$apply(read);
      });
    }
  };
})

.filter('capitalize', function() {
  return function(input, all) {
    return (!!input) ? input.replace(/([^\W_]+[^\s-]*) */g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();}) : '';
  };
});

var countOccurrences = function (str, value) {
    var regExp = new RegExp(value, 'gi');
    return str.match(regExp) ? str.match(regExp).length : 0;
};

var wordArray = function (rawText) {
    var sanitized = sanitize(rawText);
    var semicolonsAndPeriods = sentenceMarkers(sanitized);
    var noPunctuation = semicolonsAndPeriods.replace(/[;\.]/g,' ');
    var lowercase = ' ' + noPunctuation.replace(/[\.]/g,'').toLowerCase() + ' ';
    return lowercase.trim().split(/\s+/);
};

var sanitize = function (rawText) {
    return String(rawText).replace(/<[^>]+>/gm, '');
};

var sentenceMarkers = function (rawText) {
    return String(rawText).replace(/[,\-\/#!$%\^&\*:{}=\-_`~()]/g,'');
};

var getSentences = function(rawText) {
    var sanitized = sanitize(rawText);
    var removePunctuation = sanitized.replace(/[\-\/#!$%\^,&\*:{}=\-_`~()]/g,'');
    var sentences = removePunctuation.replace(/[?;]/g,'.');
    return sentences.trim().split(/[\.]/g);
};
