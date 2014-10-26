<?php

class ProcessText {
    public $clean;
    public $sentences;
    public $nopunctuation;
    public $highlighted;
    public $config;
    public $score;
    public $raw_score;
    public $instances;
    public static $highlight_spacer;

    public function __construct($submission) {
      $this->clean = strip_tags($submission); // remove html/javascript
      $this->stripPunctuation();
    }

    public function getSentences() {
      $this->sentences['text'] = preg_replace('/[\.!?;]/', '.', $this->clean); // Unify terminators
      $this->sentences['array'] = explode(".", $this->clean);
      $this->sentences['count'] = count($this->sentences['array']);
    }
    public function sentenceVariety() {
      foreach ($this->sentences['array'] as $sentence) {
        $sentencecounts[] = str_word_count($sentence);
      }
      $words_per_sentence = number_format(str_word_count($this->clean)/$this->sentences['count']);
      foreach ($sentencecounts as $length) {
        $powers[] = pow($length-$words_per_sentence,2);
      }
      $standard_deviation = number_format(sqrt(array_sum($powers)/count($powers)));
      $this->sentences['variety'] = number_format($standard_deviation/$words_per_sentence*100);
    }
    public function stripPunctuation() {
      $text = preg_replace('/[\.!?;]/', '.', $this->clean); // Unify terminators
      $text = preg_replace('/[,.]/', '', $text); // Remove commas
      $text = preg_replace("[^\'A-Za-z-]", " ", html_entity_decode($text, ENT_QUOTES));
      $this->nopunctuation = $text;
    }
    public function highlight($table) {
      $result = $this->clean;
      foreach ($table['find'] as $find) {
        if ($this::$highlight_spacer) { $find = ' ' . $find . ' '; }
        $table['search'][] = $find;
        $table['replace'][] = '<span class="highlight">' . $find . '</span>';
      }
      foreach ($table['find'] as $find) {
        if ($this::$highlight_spacer) { $find = ' ' . $find . ' '; }
        $table['usearch'][] = ucfirst($find);
        $table['ureplace'][] = '<span class="highlight">' . ucfirst($find) . '</span>';
      }
      // If there is a correction table, append that to the replaces.
      $result = strtr($result, array_combine($table['search'], $table['replace']));
      $result = strtr($result, array_combine($table['usearch'], $table['ureplace']));
      $this->highlighted = $result;
    }
    public function score($table) {
      foreach($table['find'] as $find) {
        $count = substr_count($this->nopunctuation,' '. $find .' ');
        $ucount = substr_count($this->nopunctuation,' '. ucfirst($find) .' ');
        if ($count+$ucount > 0) { $this->instances[] = $find; }
        $total = $total+$count+$ucount;

      }
      if ($this::$score_type == 'per_sentence') {
        $this->getSentences();
        $score = number_format($total/$this->sentences['count']*100);
      }
      else {
        $score = $total;
      }
      $this->raw_score = $total;
      $this->score = $score;
    }
    public function guidance() {
      $guidance['score'] = $this->score;
      $guidance['label'] = $this::$label;
      $guidance['text'] = $this::$pass;
      $guidance['result'] = 'pass';
      $guidance['alt'] = 'passes the criterion';
      if ($this::$fails_if == '>') {
        $lesser = $this->score;
        $greater = $_SESSION['score']{$this::$name};
      }
      elseif ($this::$fails_if == '<') {
        $greater = $this->score;
        $lesser = $_SESSION['score']{$this::$name};
      }
      if ($lesser > $greater) {
        $guidance['text'] = $this::$fail;
        $guidance['result'] = 'fail';
        $guidance['alt'] = 'fails the criterion';
      }
      $guidance['goal'] = $_SESSION['score']{$this::$name};
      $this->guidance = $guidance;
    }

    public function alter() {

    }
}
?>
