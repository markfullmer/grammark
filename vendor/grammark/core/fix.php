<?php

class Fix {
    /**
     * @var PDO The connection to the database
     */
    protected $db;
    protected $rows;
    protected $clean;
    protected $nopunctuation;
    protected $guidance = array(
      'fail' => array(
        "transitions" => "<p>Transitions help readers see your organization and
        thought process. Example:</p><ul><li><b>No transition:</b> <i>Martinez
        states that 70% of taxes are paid by the wealthiest 10%. Obama's argument
        about tax brackets seems...</i></li><li><b>Has transition:</b> <i>Martinez
        states that 70% of taxes are paid by the wealthiest 10%. <mark>Given
        this</mark> statistic, Obama's argument about tax brackets seems...</i></li>
        </ul><p><b>Goal:</b> Try to increase your transitions percentage to"
      ),
      'pass' => array(
        'transitions' => 'Transitions help readers see your organization and
        thought process. You writing reaches the transitions per sentence percentage goal of '
      ),
      'label' => array(
        'transitions' => '% sentences with transitions'
      )
    );
    public function setDB($dbConn) {
        $this->db = $dbConn;
    }

    public function sanitize() {
      $text = strip_tags($_SESSION['text']);
      $this->clean = $text;
      $text = preg_replace('/[\.!?;]/', '.', $text); // Unify terminators
      $text = preg_replace('/[,]/', '', $text); // Remove commas
      $text = preg_replace("[^\'A-Za-z-]", " ", html_entity_decode($text, ENT_QUOTES));
      $this->nopunctuation = $text;
    }

    public function getTable($table) {
      $stmt = $this->db->prepare("SELECT * FROM transitions");
      $stmt->execute(array());
      $rows = $stmt
        ->fetchAll(PDO::FETCH_ASSOC);
      foreach($rows as $row) {
        $trans[] = $row['transition'];
      }
      $this->rows = $trans;
    }

    public function highlight() {
      $text = $this->clean;
      foreach ($this->rows as $find) {
        $added = ' '. $find .' ';
        $pos = stripos($this->nopunctuation,$added);
        if(($pos !== false)) {
          $ufind = ucfirst($find);
          $highlighted = '<span class="highlight">' . $find . '</span>' ;
          $uhighlighted = '<span class="highlight">' . $ufind . '</span>' ;
          $text = preg_replace('/'.$find.'/',$highlighted,$text);
          $text = preg_replace('/'.$ufind.'/',$uhighlighted,$text);
          $count = $count+substr_count($this->nopunctuation,$find);
          $count = $count+substr_count($this->nopunctuation,$find);
        }
      }
      $this->count = $count;
      $this->score = $count;
      $this->highlighted = $text;
    }

    public function render($id = null) {
      $results = array(
        'guidance' => $this->guidance['fail'][$id],
        'result' => 'fail',
        'alt' => 'failed the test',

      );
      if ($this->score > $_SESSION['score'][$id]) {
        $results = array(
          'guidance' => $this->guidance['pass'][$id],
          'result' => 'pass',
          'alt' => 'passed the test'
        );
      }
      $results['output'] = nl2br($this->highlighted);
      $results['count'] = $this->count;
      $results['goal'] = $_SESSION['score'][$id];
      $results['score'] = $this->score;
      $results['label'] = $this->guidance['label'][$id];
    return $results;
  }
}
?>
