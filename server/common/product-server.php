<?php
require_once 'database.php';
class SellServer extends Database
{
    function getCategories()
    {
        $sql = 'SELECT category_name FROM categories ORDER BY category_name ASC';
        $stmt = $this->connectDb()->query($sql);
        if ($stmt->num_rows > 0) {
            return $stmt->fetch_all(MYSQLI_ASSOC);
        }
    }

    function input($col, $name, $placeholder, $example)
    {
        $name = strtolower($name);
        $placeholder = ucfirst(strtolower($placeholder));
        $example = ucfirst($example);
        $id = "prod-" . $name;
        $title = ucfirst($name);
        $error = $id . "Err";
        return "
        <div class='my-3 $col'>
                <label for='$id' class='form-label'><b>$title</b></label>
                <input type='text' class='form-control p-3' id='$id'
                    placeholder='$placeholder' name='$id'>
                <div class='text-secondary'>Example: $example</div>
                <small id='$error' class='text-danger'></small>
            </div>
            ";
    }
}

$sellServer = new SellServer();
$categoriesNames = [];
$categoriesValues = [];
foreach ($sellServer->getCategories() as $value) {
    $categoriesNames[] = $value['category_name'];
    $categoriesValues[] = str_replace(' ', '', $value['category_name']);
}
?>