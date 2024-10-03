<?php
class Database extends mysqli {
    private $servername = "localhost";
    private $db_username = "root";
    private $db_password = "";
    private $dbname = "rest_book";

    // Constructor to establish database connection
    public function __construct() {
        parent::__construct($this->servername, $this->db_username, $this->db_password, $this->dbname);

        // Check if connection is successful
        if ($this->connect_error) {
            throw new Exception("Connection failed: " . $this->connect_error);
        }
    }

    // Method to close the connection (inherited from mysqli)
    public function close() {
        parent::close();
    }
}
