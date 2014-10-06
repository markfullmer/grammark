<php

class Transitions {
    /**
     * @var PDO The connection to the database
     */
    protected $db;

    public function __construct() {}

    /**
     * Sets the database connection
     * @param PDO $dbConn The connection to the database.
     */
    public function setDB($dbConn)
    {
        $this->db = $dbConn;
    }
}
?>
