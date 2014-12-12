<?php

class Passive extends ProcessText {
    /**
    * The configuration settings for finding an existing trait in a text
    *
    * table = the database table from which to get errors & suggestions
    * find = the column in the table that provides the search array
    * suggestion = the column in the table that provides a corresponding suggestion
    * fail = the message to display if the score is below the limit (see score.php)
    * pass = the message to display
    * label = the semantic meaning of the score, displayed in guidance
    * score_type = the method to calculate the score. values can be per_sentence
    * or raw_count
    *
    * @static
    */
    public static $name = 'Passive voice sentences';
    public static $id = 'passive';
    public static $table = 'irregularpasttense';
    public static $find = 'word';
    public static $suggestion = null;
    public static $fails_if = '>';
    public static $fail = 'Generally, writing is clearer in active voice:<br />
    <ul><li>Compare "Planet Mars was eaten by Mark." (passive) to "Mark ate
    Planet Mars." (active)</li></ul>What to do: think "who did what" structure,
    not "what was done by whom." You\'ll probably need to reverse the sentence
    order: (was eaten by Mark --> Mark ate). Basically, avoid <i>is, was, were</i>
     or <i>be,being been</i> + past tense verb. Example fixes:
    <ul><li>it <span class="highlight"><span style="text-decoration:line-through;">is</span>
     accept<span style="text-decoration:line-through;">ed</span></span> that...
     --> we <b>accept</b> that...</li>
    <li>needs to <span class="highlight"><span style="text-decoration:line-through;">be</span>
     fund<span style="text-decoration:line-through;">ed</span></span> by X... -->
     X needs to <b>fund</b>...</li>
    <li>Y can <span class="highlight"><span style="text-decoration:line-through;">
    be</span> taught</span> by X... --> X can <b>teach</b> Y...</li></ul>';
    public static $pass = '<p>Your writing passed the criterion for passive sentences. Congrats!</p>';
    public static $label = '% sentences with passive voice';
    public static $score_type = 'per_sentence';
    public static $standard = '5';
    public static $humanities = '10';
    public static $sciences = '10';
    public static $internet = '0';

    public function score($table) {
        foreach ($table as $key => $value) {
            $simpleTable[] = $value['find'];
        }
        $this->getSentences();
        $verbs = array(
            'is','are','was','were','be','being','been',
            'Is','Are','Was','Were','Be','Being','Been'
        );
        $wordlist = explode(' ', $this->nopunctuation);
        $gotverb = false;
        foreach($wordlist as $word) {
            if ($gotverb) { // If the current word is a past participle
                if (substr($word,-2) == 'ed' || in_array($word,$simpleTable)) {
                    $passive[] = $gotverb. " ". $word;
                }
            }
            $gotverb = false;
            if (in_array($word,$verbs)) {
                $gotverb = $word;
            }
        }
        $this->passive = $passive;
        $this->raw_score = count($passive);
        $this->score = number_format(count($passive)/$this->sentences['count']*100);
    }
    public function highlight($table = array()) {

        $result = $this->clean;
        foreach ($this->passive as $find) {
            $table['search'][] = $find;
            $table['replace'][] = '<span class="highlight">' . $find . '</span>';
        }
        foreach ($this->passive as $find) {
            $table['usearch'][] = ucfirst($find);
            $table['ureplace'][] = '<span class="highlight">' . ucfirst($find) . '</span>';
        }
        // If there is a correction table, append that to the replaces.
        if (isset($table['search'][0])) {
            $result = strtr($result, array_combine($table['search'], $table['replace']));
            $result = strtr($result, array_combine($table['usearch'], $table['ureplace']));
        }
        $this->highlighted = stripslashes($result);
    }
}
?>


