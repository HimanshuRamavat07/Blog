<?php
class Database {
    private $db_host = "localhost";
    private $db_user = "root";
    private $db_pass = "";
    private $db_name = "himanshu_blog";

    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->db_host,$this->db_user,$this->db_pass,$this->db_name);

        if($this->conn->connect_error) {
            die("Error in connection".$this->conn->connect_error);
        }
    }

}

?>