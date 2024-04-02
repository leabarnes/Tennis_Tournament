<?php
class Database {
    private $db_connected = false;
    function connect($dbhost, $dbuser, $dbpass, $dbname) {
        if(!$this->db_connected) {
            $mysql = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
            if(mysqli_error($mysql))
            $this->db_connected = true;
        }
    }
}