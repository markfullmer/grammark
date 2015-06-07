'use strict';

var sentences = function() {
    this.machineName = 'sentences';
    this.title = 'Sentence-level Issues';
    this.passingScore = '2';
    this.passingText = '% or fewer';
    this.scoringType = 'punitive';
    this.ratioType = '% of sentences';
    this.fail = 'Hmmm. Your writing may have some sentence-level issues. Check the list below for potential fragments or run-ons.';
    this.pass = 'Bueno! Your sentences don\'t show any glaring errors.';
    this.markup = 'yellow';
        this.process = function(rawText) {
        var count = 0;
        var matches = [];
        var andbutor = ['And','But','Or '];
        var sentences = getSentences(rawText);
        for (var i in sentences) { // loop through sentences
            var words = [];
            words = sentences[i].split(/\s+/);
            if (words.length > 50) {
                matches.push('Long Sentence: "' + sentences[i].trim().substring(0,100) + '..."');
                count = count + 1;
            }
            var firstWord = sentences[i].trim().substring(0,3);
            if (_.indexOf(andbutor, firstWord) !== -1) {
                matches.push('Potential Fragment: "' + sentences[i].trim().substring(0,100) + '..."');
                count = count + 1;
            }
        }
        this.matches = _.uniq(matches);
        return [this.matches, count];
    };
    this.corrections = {};
};
