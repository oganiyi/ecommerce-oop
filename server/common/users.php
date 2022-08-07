<?php
require_once "database.php";

class Users extends Database
{
    // protected $db = $this->connectDb();
    protected function getAllUsers()
    {
        $sql = "SELECT * FROM users
                ORDER BY first_name ASC, last_name ASC";
        $result = $this->connectDb()->query($sql);
        if ($result->num_rows > 0) {
            $allUsers = $result->fetch_all(MYSQLI_ASSOC);
            return $allUsers;
        }
    }
}
?>