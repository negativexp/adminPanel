<?php
class Database {
    private $servername = "localhost";
    private $dbusername = "root";
    private $dbpassword = "pass";
    private $database = "db_name";
    private $conn;
    public function __construct() {
        $this->connect();
    }
    private function connect() {
        $this->conn = new mysqli($this->servername, $this->dbusername, $this->dbpassword, $this->database);
        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    private function disconnect() {
        $this->conn->close();
    }
    public function getLastInsertedId() {
        return $this->conn->insert_id;
    }
    public function executeQuery($sql, $params = [], $returnResult = true) {
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            die("Chyba v priprave statementu: " . $this->conn->error);
        }
        if (!empty($params)) {
            $types = '';
            $bindParams = [&$types];
            foreach ($params as &$param) {
                if (is_int($param)) {
                    $types .= 'i';
                } elseif (is_float($param)) {
                    $types .= 'd';
                } elseif (is_string($param)) {
                    $types .= 's';
                } else {
                    $types .= 'b';
                }
                $bindParams[] = &$param;
            }
            call_user_func_array([$stmt, 'bind_param'], $bindParams);
        }
        $stmt->execute();
        if ($stmt->error) {
            die("chyba zpusteni statementu: " . $stmt->error);
        }
        if ($returnResult) {
            $result = $stmt->get_result();
            if ($result === false) {
                die("chyba ziskani hodnoty: " . $stmt->error);
            }
            return $result;
        }

        $success = ($stmt->affected_rows > 0) ? true : false;
        $stmt->close();
        $this->disconnect();
        return $success;
    }
    public function fetchRows($result) {
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }
    public function fetchSingleRow($result) {
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
}