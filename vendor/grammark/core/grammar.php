<?php

class Grammar extends ProcessText {
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
    public static $name = 'Grammar issues';
    public static $id = 'grammar';
    public static $table = 'miscellaneous';
    public static $find = 'error';
    public static $suggestion = null;
    public static $fails_if = '>';
    public static $fail = '<p>Gram<mark>mark</mark> identified grammar or spelling issues</b> from
    <a href="grammar-error-list">this list</a>. This doesn\'t mean those are all
    the errors. It\'s very difficult for computers to understand the nuances of
    natural language, and Gram<mark>mark</mark> cannot find things like sentence
    fragments, comma splices, subject-verb errors, pronoun agreement problems,
    and many other things.</p>';
    public static $pass = '<p>Your writing passed the grammar criteria. This doesn\'t mean your writing is perfect. Even now, it\'s very difficult for computers to understand the nuances of natural language, and Gram<mark>mark</mark> cannot find things like sentence fragments, comma splices, subject-verb errors, pronoun agreement problems, and many other things.</p>';
    public static $label = ' potential grammar issues';
    public static $score_type = 'total';
    public static $standard = '0';
    public static $humanities = '0';
    public static $sciences = '0';
    public static $internet = '0';
    public static $highlight_spacer = true;
}
?>


