<?php
require_once "../common/database.php";

class Registration extends Database
{
    public $registrationError = [];
    // public $fillable = array('fname', 'lname', 'email', 'pnum', 'level', 'pword', 'cpword');

    private function validateFirstname($fname)
    {
        $fname = trim($fname);
        if (empty($fname)) {
            $this->registrationError['firstNameError'] = "First name cannot be empty";
        }
        else if (count(explode(" ", $fname)) != 1) {
            $this->registrationError['firstNameError'] = "First name should only be a single name";
        }
        else if (!preg_match("/^[a-zA-Z-' ]*$/", $fname)) {
            $this->registrationError['firstNameError'] = "Please enter a valid name";
        }
        else {
            return ucfirst(strtolower($fname));
        }
    }

    private function validateLastname($lname)
    {
        $lname = trim($lname);
        if (empty($lname)) {
            $this->registrationError['lastNameError'] = "Last name cannot be empty";
        }
        else if (count(explode(" ", $lname)) != 1) {
            $this->registrationError['lastNameError'] = "Last name should only be a single name";
        }
        else if (!preg_match("/^[a-zA-Z-' ]*$/", $lname)) {
            $this->registrationError['lastNameError'] = "Please enter a valid name";
        }
        else {
            return ucfirst(strtolower($lname));
        }
    }

    private function rowExist($col, $row)
    {
        // this functon is used to check if email, phone number and username already exist in the database.
        $sql = "SELECT $col from users WHERE $col='$row'";
        $stmt = $this->connectDb()->query($sql);
        if ($stmt->num_rows > 0) {
            return true;
        }
    }

    private function validateEmail($mail)
    {
        $mail = trim($mail);
        if (empty($mail)) {
            $this->registrationError["emailError"] = "Email cannot be empty";
        }
        else if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $this->registrationError['emailError'] = "Enter a valid email address";
        }
        else {
            if ($this->rowExist('email', strtolower($mail))) {
                $this->registrationError['emailError'] = "Email already exist";
            }
            else {
                return strtolower($mail);
            }
        }
    }

    private function validatePhoneNumber($pnum)
    {
        $pnum = trim($pnum);
        $firstThreeDigit = substr($pnum, 0, 3);
        if (empty($pnum)) {
            $this->registrationError['phoneNumberError'] = "Please input a phone number of length 11";
        }
        else if ((!is_numeric($pnum) && !is_int($pnum)) || ($firstThreeDigit != "070" && $firstThreeDigit != "080" && $firstThreeDigit != "081" && $firstThreeDigit != "090" && $firstThreeDigit != "091")) {
            $this->registrationError['phoneNumberError'] = "Please only enter number without country code starting with 080, 081, 091 etc.";
        }
        else if (strlen($pnum) != 11) {
            $this->registrationError['phoneNumberError'] = "Your phone number cannot be less or greater than 11";
        }
        else {
            if ($this->rowExist('phone_number', $pnum)) {
                $this->registrationError['phoneNumberError'] = "Phone number already exist";
            }
            else {
                return $pnum;
            }
        }
    }

    private function validateUsername($uname)
    {
        $uname = trim($uname);
        if (empty($uname)) {
            $this->registrationError['usernameError'] = "Username cannot be empty";
        }
        else if (count(explode(" ", $uname)) != 1) {
            $this->registrationError['usernameError'] = "Username should only be a single name";
        }
        else if (!is_string($uname)) {
            $this->registrationError['usernameError'] = "Only enter letters, numbers or characters";
        }
        else if (strlen($uname) < 6 or strlen($uname) > 12) {
            $this->registrationError['usernameError'] = "Username cannot be less than 6 or greater than 12";
        }
        else {
            if ($this->rowExist('username', strtolower($uname))) {
                $this->registrationError['usernameError'] = "Username already exist";
            }
            else {
                return strtolower($uname);
            }
        }
    }

    private function validateLevel($lvl)
    {
        $lvl = trim($lvl);
        if (empty($lvl)) {
            $this->registrationError["levelError"] = "Select a level";
        }
        else if ($lvl !== "admin" && $lvl !== "seller") {
            $this->registrationError["levelError"] = "Invalid level";
        }
        else {
            return ucfirst(strtolower($lvl));
        }
    }

    private function validatePassword($pwd)
    {
        $pwd = trim($pwd);
        if (empty($pwd)) {
            $this->registrationError['passwordError'] = "Password cannot be empty";
        }
        else if (!is_string($pwd)) {
            $this->registrationError['passwordError'] = "Only enter letters, numbers or characters";
        }
        else if (strlen($pwd) < 6 or strlen($pwd) > 12) {
            $this->registrationError['passwordError'] = "Password cannot be less than 6 or greater than 12";
        }
        else {
            return md5($pwd);
        }
    }

    private function validateConfirmPassword($pwd, $cpwd)
    {
        $cpwd = trim($cpwd);
        if (empty($cpwd)) {
            $this->registrationError['confirmPasswordError'] = "Confirm your password";
        }
        else if (!is_string($cpwd)) {
            $this->registrationError['confirmPasswordError'] = "Only enter letters, numbers or characters";
        }
        else if ($pwd != $cpwd) {
            $this->registrationError['confirmPasswordError'] = "Password does not match";
        }
        else {
            return md5($cpwd);
        }
    }

    public function validateRegistration($fname, $lname, $mail, $pnum, $uname, $level, $pwd, $cpwd)
    {
        $firstName = $this->validateFirstname($fname);
        $lastName = $this->validateLastname($lname);
        $email = $this->validateEmail($mail);
        $phoneNumber = $this->validatePhoneNumber($pnum);
        $username = $this->validateUsername($uname);
        $level = $this->validateLevel($level);
        $password = $this->validatePassword($pwd);
        $confirmPassword = $this->validateConfirmPassword($pwd, $cpwd);

        if (!$this->registrationError) {
            $this->registrationError['validity'] = "valid";
            // $sql = "INSERT INTO users(level, first_name, last_name, email, phone_number, username, password)
            //     VALUES(?,?,?,?,?,?,?)";
            // $stmt = $this->connectDb()->prepare($sql);
            // $stmt->execute([$level, $firstName, $lastName, $email, $phoneNumber, $username, $confirmPassword]);
            $sql = "INSERT INTO users(level, first_name, last_name, email, phone_number, username, password)
                VALUES('$level', '$firstName', '$lastName', '$email', '$phoneNumber', '$username', '$confirmPassword')";
            $stmt = $this->connectDb()->query($sql);

        }
        else {
            $this->registrationError['validity'] = "invalid";
        }
    }
}

$user = new Registration();

$user->validateRegistration($_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['pnum'], $_POST['uname'], $_POST['level'], $_POST['pword'], $_POST['cpword']);
echo json_encode($user->registrationError);

?>