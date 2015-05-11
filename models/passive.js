var passive = function() {
    this.machineName = 'passive';
    this.title = 'Passive Voice';
    this.passingScore = '10';
    this.passingText = '% or fewer';
    this.scoringType = 'punitive';
    this.ratioType = '% of sentences';
    this.fail = 'You didn\'t meet the criteria.';
    this.markup = "yellow";
    this.matches = [];
    this.process = function(rawText) {
    	var helpers = ['is','was','were','being','having','been'];
    	var count = 0;
    	var matches = [];
    	var irregularPast = this.corrections;
    	var words = wordArray(rawText);
    	for (var i in words) {
    		var previous = i - 1;
    		if (_.indexOf(_.keys(irregularPast), words[i]) != -1 || words[i].substr(-2, 2) == 'ed') {
    			if (_.indexOf(helpers, words[previous]) != -1) {
    				matches.push(words[previous] + ' ' + words[i]);
    				count = count + 1;
    			}
    		}
    	}
        this.matches = _.uniq(matches);
        return [this.matches, count];
        //return this.matches;
    };
    this.corrections = {
"arisen":"",
"babysat":"",
"been":"",
"beaten":"",
"become":"",
"bent":"",
"begun":"",
"bet":"",
"bound":"",
"bitten":"",
"bled":"",
"blown":"",
"broken":"",
"bred":"",
"brought":"",
"broadcast":"",
"built":"",
"bought":"",
"caught":"",
"chosen":"",
"come":"",
"cost":"",
"cut":"",
"dealt":"",
"dug":"",
"done":"",
"drawn":"",
"drunk":"",
"driven":"",
"eaten":"",
"fallen":"",
"fed":"",
"felt":"",
"fought":"",
"found":"",
"flown":"",
"forbidden":"",
"forgotten":"",
"forgiven":"",
"frozen":"",
"gotten":"",
"given":"",
"gone":"",
"grown":"",
"hung":"",
"had":"",
"heard":"",
"hidden":"",
"hit":"",
"held":"",
"hurt":"",
"kept":"",
"known":"",
"lain":"",
"led":"",
"left":"",
"lent":"",
"let":"",
"lain":"",
"lit":"",
"lost":"",
"made":"",
"meant":"",
"met":"",
"paid":"",
"put":"",
"quit":"",
"read":"",
"ridden":"",
"rung":"",
"risen":"",
"run":"",
"said":"",
"seen":"",
"sold":"",
"sent":"",
"set":"",
"shaken":"",
"shone":"",
"shot":"",
"shown":"",
"shut":"",
"sung":"",
"sunk":"",
"sat":"",
"slept":"",
"slid":"",
"spoken":"",
"spent":"",
"spun":"",
"spread":"",
"stood":"",
"stolen":"",
"stuck":"",
"stung":"",
"struck":"",
"sworn":"",
"swept":"",
"swum":"",
"swung":"",
"taken":"",
"taught":"",
"torn":"",
"told":"",
"thought":"",
"thrown":"",
"understood":"",
"woken":"",
"worn":"",
"won":"",
"withdrawn":"",
"written ":"",
"burned":"",
"burnt":"",
"dreamed":"",
"dreamt":"",
"learned":"",
"smelled":"",
"bet":"",
"broadcast":"",
"cut":"",
"hit":"",
"hurt":"",
"let":"",
"put":"",
"quit":"",
"read":"",
"set":"",
"shut":"",
"spread":"",
"awoken":"",
};
}
