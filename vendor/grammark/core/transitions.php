<?php

class Transitions extends ProcessText {
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
    public static $name = 'Transitions';
    public static $id = 'transitions';
    public static $table = 'transitions';
    public static $find = 'transition';
    public static $suggestion = null;
    public static $fails_if = '<';
    public static $fail = '<p>Transitions help readers see your organization and
        thought process. Example:</p><ul><li><b>No transition:</b> <i>Martinez
        states that 70% of taxes are paid by the wealthiest 10%. Obama\'s argument
        about tax brackets seems...</i></li><li><b>Has transition:</b> <i>Martinez
        states that 70% of taxes are paid by the wealthiest 10%. <mark>Given
        this</mark> statistic, Obama\'s argument about tax brackets seems...</i></li>
        </ul><p><b>Goal:</b> Try to increase your transitions percentage to';
    public static $pass = 'Transitions help readers see your organization and thought
        process. Your writing reaches the transitions per sentence percentage goal of ';
    public static $label = '% sentences with transitions';
    public static $score_type = 'per_sentence';
    public static $standard = '25';
    public static $humanities = '25';
    public static $sciences = '25';
    public static $internet = '15';
}
?>
