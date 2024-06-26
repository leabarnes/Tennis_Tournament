<?php
class Database {
    private static $mysql;

    const DB_HOST = 'localhost';
    const DB_USER = 'adminuser';
    const DB_PASS = 'qwerty123';
    const DB_NAME = 'tennis';
    public static function connect() {
        self::$mysql = mysqli_connect(self::DB_HOST, self::DB_USER, self::DB_PASS, self::DB_NAME);
        if(mysqli_error(self::$mysql)){
            throw new Exception("Cannot connect to DB", 500);
        }
    }

    public static function runQuery($query){
        if(!self::$mysql){
            self::connect();
        }
        return self::$mysql->query($query);
    }

    public static function find($select, $tables, $where, $return_type = "array"){
        $query = "SELECT ".$select." FROM ".$tables." WHERE ". $where;
        $mysqli_result = self::runQuery($query);
        if(!$mysqli_result){
            return false;
        }
        switch($return_type){
            case "array":
                $results = array();
				while ($row = $mysqli_result->fetch_assoc()) {
					$results[] = $row;
				}
                break;
            case "single":
                if($mysqli_result->num_rows == 0){
                    return null;
                }
                $results = $mysqli_result->fetch_assoc();
        }
        return $results;
    }

    public static function insert($table, $values){
        $keys = array_keys($values);
        $query_values = array();
        $param_values = array();
        $type = "";
        foreach($values as $value){
            $type .= self::getTypeOfValues($value);
            $query_values[] = "?";
            $param_values[] = $value;
        }
        $query = "INSERT INTO ".$table." (".implode(",", $keys).") VALUES (".implode(", ", $query_values).")";
        $stmt = self::$mysql->prepare($query);
        $stmt->bind_param($type, ...$param_values);
        $stmt->execute();
        if(mysqli_stmt_errno($stmt) !== 0){
            var_dump(mysqli_error(self::$mysql));
            throw new Exception("Failed to save values in ".$table);
        }
    }

    private static function getTypeOfValues($value){
        if(is_float($value)){
            return "d";
        }elseif(is_integer($value)){
            return "i";
        }elseif(is_string($value)){
            return "s";
        }
        return "b";
    }

    public static function update($table, $values, $where){
        $update_array = array();
        foreach($values as $key => $value){
            $type = self::getTypeOfValues($value);
            if($type == "s"){
                $update_array[] = $key." = '".$value."'";
            } else {
                $update_array[] = $key." = ".$value;
            }
        }
        $update_string = implode(", ", $update_array);
        $query = "UPDATE ".$table." SET ".$update_string." WHERE ". $where;
        $result = self::runQuery($query);
        if(!$result){
            var_dump(mysqli_error(self::$mysql));
            throw new Exception("Failed to update values in ".$table);
        }
    }

    public static function delete($table, $where){
        if(empty($where) || !$where){
            throw new Exception("Delete query without where!", 9999);
        }
        $query = "DELETE FROM ".$table." WHERE ".$where;
        self::runQuery($query);
    }
}