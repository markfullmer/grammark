var nominalizations = function() {
    this.machineName = 'nominalizations';
    this.title = 'Nominalized Word Forms';
    this.passingScore = '6';
    this.passingText = '% or fewer';
    this.ratioType = '% of words';
    this.scoringType = 'punitive';
    this.fail = 'You didn\'t meet the criteria.';
    this.markup = "yellow";
    this.process = function(rawText) {
		var count = 0;
		var matches = [];
		var endings = this.corrections
		var words = wordArray(rawText);
		for (var i in words) { // loop through text
			for (var e in endings) { // loop through nominalized endings
				if (words[i].indexOf(e) > -1 && words[i].length > 7) {
					// word contains the ending and is longer than 7 letters
					var offset = endings[e]*-1;
					if (words[i].substr(offset,endings[e]) == e) {
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
        "ization":7,
        "izations":8,
        "ing":3,
        "ings":4,
        "ism":3,
        "isms":4,
        "ation":5,
        "ations":6,
        "ition":5,
        "itions":6,
        "ment":4,
        "ments":5,
        "ability":7,
        "abilities":9,
        "ness":4,
        "nesses":6,
        "ity":3,
        "ities":5,
        "ence":4,
        "ences":5,
	};
}
