<?php

class ProcessText {
    public $clean;
    public $sentences;
    public $nopunctuation;

    public function __construct($submission) {
      $this->clean = strip_tags($submission); // remove html/javascript
      $this->stripPunctuation();
    }
    public function getSentences() {
      $this->sentences['text'] = preg_replace('/[\.!?;]/', '.', $this->clean); // Unify terminators
      $this->sentences['array'] = explode(".", $this->clean);
      $this->sentences['count'] = count($this->sentences['array']);
    }
    public function stripPunctuation() {
      $text = preg_replace('/[\.!?;]/', '.', $this->clean); // Unify terminators
      $text = preg_replace('/[,.]/', '', $text); // Remove commas
      $text = preg_replace("[^\'A-Za-z-]", " ", html_entity_decode($text, ENT_QUOTES));
      $this->nopunctuation = $text;
    }
    public function highlight($config,$table) {
      $result = $this->clean;
      foreach ($table['find'] as $find) {
        $table['search'][] = '/'.$find.'/';
        $table['replace'][] = '<span class="highlight">' . $find . '</span>';
      }
      foreach ($table['find'] as $find) {
        $table['ufind'][] = ucfirst($find);
        $table['ureplace'][] = '<span class="highlight">' . ucfirst($find) . '</span>';
      }
      // If there is a correction table, append that to the replaces.
      $result = strtr($result, array_combine($table['find'], $table['replace']));
      $result = strtr($result, array_combine($table['ufind'], $table['ureplace']));
      return $result;
    }
}
?>
