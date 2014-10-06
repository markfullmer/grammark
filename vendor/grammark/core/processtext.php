<?php

class ProcessText {
    protected $clean;
    protected $sentences;
    protected $nopunctuation;

    public function __construct($submission) {
      $this->clean = strip_tags($submission); // remove html/javascript
    }
    public function getSentences() {
      $this->sentences['text'] = preg_replace('/[\.!?;]/', '.', $this->clean); // Unify terminators
      $this->sentences['array'] = explode(".", $pizza);
      $this->sentences['count'] = count($this->sentences['array']);
      return $this->sentences;
    }
    public function noPunctuation() {
      $this->sentences = $text;
      $text = preg_replace('/[,]/', '', $text); // Remove commas
      $text = preg_replace("[^\'A-Za-z-]", " ", html_entity_decode($text, ENT_QUOTES));
      return $text;
    }
}
?>
