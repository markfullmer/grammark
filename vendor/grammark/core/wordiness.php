<?php

class Wordiness extends ProcessText {
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
    public static $name = 'Wordiness';
    public static $id = 'wordiness';
    public static $table = 'wordiness';
    public static $find = 'error';
    public static $suggestion = null;
    public static $fails_if = '>';
    public static $fail = '<p>Your writing has potential wordiness issues</b> from <a href="/wordiness">this list</a>. Why use 3 words when you can say it with 1? Consider the following examples:
<ul><li>it seems <span class="highlight">to be</span> effective --> it <b>seems</b> effective</li>
<li>the amount of energy <span class="highlight">being</span> used --> the amount of energy used</li>
<li><span class="highlight">each of us</span> can try --> <b>each</b> can try</li></ul>
Try to eliminate all wordiness.</p>';
    public static $pass = 'You passed the criteria. Good work.</p>';
    public static $label = ' instances of wordiness';
    public static $score_type = 'total';
    public static $standard = '5';
    public static $humanities = '10';
    public static $sciences = '10';
    public static $internet = '0';
    public static $highlight_spacer = true;
}
?>


