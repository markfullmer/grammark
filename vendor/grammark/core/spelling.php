<?php

class Spelling extends ProcessText {
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
    public static $name = 'Spelling';
    public static $id = 'spelling';
    public static $table = 'misspellings';
    public static $find = 'error';
    public static $suggestion = 'correct';
    public static $fails_if = '>';
    public static $fail = '<p>Your writing has spelling errors</b> from <a href="/spelling-list">this list</a>.</p>';
    public static $pass = 'You passed the criteria. Good work.</p>';
    public static $label = ' spelling errors';
    public static $score_type = 'total';
    public static $standard = '0';
    public static $humanities = '0';
    public static $sciences = '0';
    public static $internet = '0';
    public static $highlight_spacer = true;

    public function alter() {
        $this::$fail = t('<p>Your writing shows %number words as possible spelling errors: <b>%instances</b><br />
            (Not all of these may be actual errors, depending on context)',
            array(
                '%number' => count($this->instances),
                '%instances' => implode($this->instances,', ')
            )
        );
    }
}
?>


