<?php

class TodoModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllTodos() {
        $sql = "SELECT * FROM todos";
        $result = mysqli_query($this->db, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

  
}

?>
