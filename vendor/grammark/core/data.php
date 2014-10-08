<?php

class Data {

    protected $db;
    protected static $table;
    public function __construct() {
        $this->db = new PDO('mysql:host='.HOST.';dbname='.DB_NAME.';charset=utf8', USERNAME, PASSWORD);
    }

    public function getTable($config) {
      $table = array();
      $sql = "SELECT * FROM " . $config['table'];
      $stmt = $this->db->prepare($sql);
      $stmt->execute(array());
      $rows = $stmt
        ->fetchAll(PDO::FETCH_ASSOC);
      foreach($rows as $row) {
        $table['find'][] = $row{$config['find']};
        if (isset($config['suggestion'])) {
          $table['suggestion'][] = $row{$config['suggestion']};
        }
      }
      return $table;
    }
}
?>
