<?php

class Nominalizations extends ProcessText {
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
    public static $name = 'Nominalized word forms';
    public static $id = 'nominalizations';
    public static $table = '';
    public static $find = 'word';
    public static $suggestion = null;
    public static $fails_if = '>';
    public static $fail = 'Fail instructions';
    public static $pass = 'Pass instructions';
    public static $label = '% of sentences with nominalized word forms';
    public static $score_type = 'per_sentence';
    public static $standard = '50';
    public static $humanities = '50';
    public static $sciences = '60';
    public static $internet = '30';

    public function score($table) {
        $this->getSentences();
        $nominalizations = array(
            'ization' => 7,
            'ing' => 3,
            'ism' => 3,
            'ation' => 5,
            'ition' => 5,
            'ment' => 4,
            'ability' =>7,
            'ness' => 7,
            'ity' => 3,
            'ence' => 4
        );
        $wordlist = explode(' ', $this->nopunctuation);
        $gotverb = false;
        foreach($wordlist as $word) {
            foreach ($nominalizations as $nominalization => $length) {
                $pos = strpos($word, $nominalization);
                if ($pos !== false) {
                    if (strlen($word) > 8) {
                        if(strlen($word) - strlen($nominalization) == strrpos($word,$nominalization)) {
                            $caught[] = $word;
                        }
                    }
                }
            }
        }
        $this->nominalized = $caught;
        $this->raw_score = count($caught);
        $this->score = number_format(count($caught)/$this->sentences['count']*100);
    }
    public function highlight() {
        $result = $this->clean;
        foreach ($this->nominalized as $find) {
            $table['search'][] = $find;
            $table['replace'][] = '<span class="highlight">' . $find . '</span>';
        }
        foreach ($this->nominalized as $find) {
            $table['usearch'][] = ucfirst($find);
            $table['ureplace'][] = '<span class="highlight">' . ucfirst($find) . '</span>';
        }
        // If there is a correction table, append that to the replaces.
        $result = strtr($result, array_combine($table['search'], $table['replace']));
        $result = strtr($result, array_combine($table['usearch'], $table['ureplace']));
        $this->highlighted = $result;
    }
}
?>


