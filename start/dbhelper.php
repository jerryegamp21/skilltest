<?php
class DbHelper {
    private $conn;

    public function __construct($host, $user, $password, $dbname) {
        $this->conn = new mysqli($host, $user, $password, $dbname);
        
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function createStudent($name, $age, $email) {
        $stmt = $this->conn->prepare("INSERT INTO students (name, age, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sis", $name, $age, $email);
        return $stmt->execute();
    }

    public function getStudents() {
        $result = $this->conn->query("SELECT * FROM students");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateStudent($id, $name, $age, $email) {
        $stmt = $this->conn->prepare("UPDATE students SET name=?, age=?, email=? WHERE id=?");
        $stmt->bind_param("sisi", $name, $age, $email, $id);
        return $stmt->execute();
    }

    public function deleteStudent($id) {
        $stmt = $this->conn->prepare("DELETE FROM students WHERE id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function __destruct() {
        $this->conn->close();
    }
}
?>