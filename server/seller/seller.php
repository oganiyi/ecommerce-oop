<?php

class Seller extends Users
{
    public function getAllSellers()
    {
        $sellers = [];
        foreach ($this->getAllUsers() as $seller) {
            if ($seller['level'] != "Seller") {
                continue;
            }
            $sellers[] = $seller;
        }
        return $sellers;
    }

    public function getAllProducts()
    {
        $sql = "SELECT * FROM product
                    ORDER BY category ASC, name ASC";
        $result = $this->connectDb()->query($sql);
        if ($result->num_rows > 0) {
            $result = $result->fetch_all(MYSQLI_ASSOC);
            return $result;
        }
        else {
            return false;
        }
    }

    public function displaySpecificCategory($seller, $category)
    {
        if (empty($seller) and !empty($category)) {
            $sql = "SELECT * FROM product WHERE category='$category'
                    ORDER BY id DESC";
            $result = $this->connectDb()->query($sql);
        }
        else if (!empty($seller) and empty($category)) {
            $sql = "SELECT * FROM product WHERE added_by='$seller'
                    ORDER BY id DESC";
            $result = $this->connectDb()->query($sql);
        }
        else if (!empty($seller) and !empty($category)) {
            $sql = "SELECT * FROM product WHERE added_by='$seller' AND category='$category'
                    ORDER BY id DESC";
            $result = $this->connectDb()->query($sql);
        }
        else {
            $sql = "SELECT * FROM product
                    ORDER BY category ASC, name ASC";
            $result = $this->connectDb()->query($sql);
        }
        if ($result->num_rows > 0) {
            $result = $result->fetch_all(MYSQLI_ASSOC);
            return $result;
        }
        else {
            return false;
        }
    }

    public function addSelectedAttr($selectedOption, $optionValue)
    {
        return $selectedOption === $optionValue ? 'selected' : '';
    }
}

$sellers = new Seller();

$allSellers = $sellers->getAllSellers();

$products = array();

if ($sellers->getAllProducts()) {
    foreach ($sellers->getAllProducts() as $allProducts) {
        if ($_SESSION["level"] === "admin") {
            $products[] = $allProducts;
        }
        if ($_SESSION["level"] === "seller") {
            if ($allProducts["added_by"] !== $_SESSION["username"]) {
                continue;
            }
            $products[] = $allProducts;
        }
    }
}

if (isset($_POST['generate_product'])) {
    $products = [];
    if ($specificCategory = $sellers->displaySpecificCategory($_POST['sellers'], $_POST['category'])) {
        foreach ($specificCategory as $specific) {
            $products[] = $specific;
        }
    }
}

if (!$products) {
    $products = false;
}

// to determine which of the seller and category is selected when isset($_POST['generate_product'])

$selectedOptionSeller = "";
$selectedOptionCat = "";

if (isset($_POST['generate_product'])) {
    $selectedOptionSeller = $_POST['sellers'];
    $selectedOptionCat = $_POST['category'];
}

?>