'use strict';

var nominalizations = function() {
    this.machineName = 'nominalizations';
    this.title = 'Nominalized Word Forms';
    this.passingScore = '6';
    this.passingText = '% or fewer';
    this.ratioType = '% of words';
    this.scoringType = 'punitive';
    this.fail = 'Most of the words highlighted below are perfectly acceptable. However, you use many of these "nominalized" (non root-form) words. They bog down writing and decrease readability:<ul><li><b>Nominalized usage:</b> The <mark>distribution</mark> of <mark>monetization</mark> will show <mark>financial</mark> <mark>improvement</mark>.</li><li><b>Root form usage:</b> <mark class="green">Finances</mark> will <mark class="green">improve</mark> if we <mark class="green">distribute</mark> <mark class="green">money</mark>.</li></ul>Pick a number of the more glaringly obvious nominalized forms below and ask yourself, "How can I say the same thing with a root form word?"';
    this.pass = 'Rock on. Your writing has a reasonable number of "nominalized" word forms, highlighted below. You probably don\'t need to reduce these any further.';
    this.markup = 'yellow';
    this.process = function(rawText) {
    	var count = 0;
    	var matches = [];
    	var endings = this.corrections;
    	var words = wordArray(rawText);
    	for (var i in words) { // loop through text
    		for (var e in endings) { // loop through nominalized endings
    			if (words[i].indexOf(e) > -1 && words[i].length > 7) {
    				// word contains the ending and is longer than 7 letters
    				var offset = endings[e]*-1;
    				if (words[i].substr(offset,endings[e]) === e) {
    					// the ending is in the ending position
    					matches.push(words[i]);
    					count = count + 1;
    					break; // ensure that one word is not double counted
    				}
    			}
    		}
    	}
        this.matches = _.uniq(matches);
        return [this.matches, count];
	};
    this.corrections = {
        'ization':7,
        'izations':8,
        'ing':3,
        'ings':4,
        'ism':3,
        'isms':4,
        'ation':5,
        'ations':6,
        'ition':5,
        'itions':6,
        'ment':4,
        'ments':5,
        'ability':7,
        'abilities':9,
        'ness':4,
        'nesses':6,
        'ity':3,
        'ities':5,
        'ence':4,
        'ences':5,
	};
};
