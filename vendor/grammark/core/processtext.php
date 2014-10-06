<?php

class ProcessText {
    public $clean;
    public $sentences;
    public $nopunctuation;

    public function __construct($submission) {
      $this->clean = strip_tags($submission); // remove html/javascript
    }
    public function getSentences() {
      $this->sentences['text'] = preg_replace('/[\.!?;]/', '.', $this->clean); // Unify terminators
      $this->sentences['array'] = explode(".", $this->clean);
      $this->sentences['count'] = count($this->sentences['array']);
      return $this->sentences;
    }
    public function stripPunctuation() {
      $text = preg_replace('/[\.!?;]/', '.', $this->clean); // Unify terminators
      $text = preg_replace('/[,.]/', '', $text); // Remove commas
      $text = preg_replace("[^\'A-Za-z-]", " ", html_entity_decode($text, ENT_QUOTES));
      $this->nopunctuation = $text;
    }
}
?>
