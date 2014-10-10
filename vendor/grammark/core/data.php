<?php

class Data {

    protected $db;
    protected static $table;
    public function __construct() {
        $this->db = new PDO('mysql:host='.HOST.';dbname='.DB_NAME.';charset=utf8', USERNAME, PASSWORD);
    }

    public function getTable($obj) {
      $table = array();
      $sql = "SELECT * FROM " . $obj::$table;
      $stmt = $this->db->prepare($sql);
      $stmt->execute(array());
      $rows = $stmt
        ->fetchAll(PDO::FETCH_ASSOC);
      foreach($rows as $row) {
        $table['find'][] = $row{$obj::$find};
        if (isset($obj::$suggestion)) {
          $table['suggestion'][] = $row{$obj::$suggestion};
        }
      }
      return $table;
    }
}
?>
