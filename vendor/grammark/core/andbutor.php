<?php

class AndButOr extends ProcessText {
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
    public static $name = 'And/But/Or sentences';
    public static $id = 'andbutor';
    public static $table = null;
    public static $find = null;
    public static $suggestion = null;
    public static $fails_if = '>';
    public static $pass = 'sentences pass feedback';
    public static $fail = 'default fail text';
    public static $label = ' sentence-level issues';
    public static $score_type = 'total';
    public static $standard = '7';
    public static $humanities = '10';
    public static $sciences = '10';
    public static $internet = '0';
    public static $fragments = array('. And','. But','. Or');
    public $runons;

    public function score($table) {
        $total = 0;
        $this->getSentences();
        $this->sentenceVariety();
        foreach($this::$fragments as $find) {
            $count = substr_count($this->clean,$find);
            $total = $total+$count;
        }
        $this::$fail = t('<p>Sentences beginning with And, But, Or: %count</p>',array('%count' => $total));
        foreach ($this->sentences['array'] as $sentence) {
            if (str_word_count($sentence) > '40') {
                $this->runons[] = $sentence;
                $total++;
            }
        }
        $this::$fail .= t('<p>Run-on sentences: %count (longer than 50 words)</p>',array('%count' => count($this->runons)));
        $this::$fail .= t('<p>Sentence variety: %count% (based on standard deviation)</p>',array('%count' => $this->sentences['variety']));
        $this::$fail .= t('<p>Sentence count: %count</p>',array('%count' => $this->sentences['count']));
        $this::$pass = $this::$fail;
        $this->score = $total;
        $this->raw_score = $total;
    }
    public function highlight($table = array()) {
        $result = $this->clean;
        foreach ($this::$fragments as $find) {
            $table['search'][] = $find;
            $table['replace'][] = '<span class="highlight">' . $find . '</span>';
        }
        foreach ($this->runons as $runon) {
            $table['search'][] = $runon;
            $table['replace'][] = '<span class="highlight">' . $runon . '</span>';
        }
        if (isset($table['search'][0])) {
            $result = strtr($result, array_combine($table['search'], $table['replace']));
        }
        $this->highlighted = $result;
    }
}
?>


