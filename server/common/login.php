<?php
require_once "database.php";
session_start();

class Login extends Database
{
    public $error = [];
    public $data = [];
    public function validateLogin($unameEmail, $pword)
    {
        $unameEmail = strtolower(trim($unameEmail));
        $pword = md5(trim($pword));
        $sql = "SELECT * FROM users 
        WHERE (username='$unameEmail' OR email='$unameEmail') AND password='$pword'";

        $stmt = $this->connectDb()->query($sql);
        if ($stmt->num_rows > 0) {
            $this->data = $stmt->fetch_all(MYSQLI_ASSOC);
        }
        else {
            $this->error['validity'] = "invalid";
        }
    }
}

$user = new Login();

$user->validateLogin($_POST['unameEmail'], $_POST['pword']);

if (!$user->error) {
    $user->error['validity'] = "valid";
    foreach ($user->data as $data) {
        $_SESSION['level'] = strtolower($data['level']);
        $_SESSION['username'] = $data['username'];
        $_SESSION['email'] = $data['email'];
        $user->error['level'] = $_SESSION['level'];
    }
}
echo json_encode($user->error);
?>