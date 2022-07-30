<?php
require_once "database.php";
require_once "product-server.php";
// session_start();

class Product extends Database
{
    public $productError = array();

    private function validateCategory($ctg)
    {
        $ctg = trim($ctg);
        if (empty($ctg)) {
            $this->productError['categoryError'] = "Select a category for your product";
        }
        else {
            return $ctg;
        }
    }

    private function validateName($name)
    {
        $name = trim($name);
        if (empty($name)) {
            $this->productError["nameError"] = "Input the product's name";
        }
        else if (!is_string($name)) {
            $this->productError["nameError"] = "Name can only contain letters, numbers or characters";
        }
        else if (count(explode(" ", $name)) > 25) {
            $this->productError['nameError'] = "Name cannot be greater than 25 words";
        }
        else {
            return $name;
        }
    }

    private function validateBrand($brand)
    {
        $brand = trim($brand);
        if (empty($brand)) {
            $this->productError["brandError"] = "Kindly input your brand";
        }
        else if (!is_string($brand)) {
            $this->productError["brandError"] = "Brand can only contain letters, numbers or characters";
        }
        else if (count(explode(" ", $brand)) > 4) {
            $this->productError['brandError'] = "Brand cannot be greater than 4 words";
        }
        else {
            return $brand;
        }
    }

    private function validatePrice($price)
    {
        $price = trim($price);
        if (empty($price)) {
            $this->productError['priceError'] = "Input the price of your product";
        }
        else if ($price <= 0) {
            $this->productError['priceError'] = "Price cannot be zero or negative";
        }
        else if (!is_numeric($price) and !is_int($price)) {
            $this->productError['priceError'] = "Only enter an integer";
        }
        else {
            return $price;
        }
    }

    private function validateQuantity($qty)
    {
        $qty = trim($qty);
        if (empty($qty)) {
            $this->productError['quantityError'] = "Input the available quantity of your product";
        }
        else if ($qty < 1) {
            $this->productError['quantityError'] = "Quantity cannot be less than 1";
        }
        else if (!is_numeric($qty) and !is_int($qty)) {
            $this->productError['quantityError'] = "Only enter an integer";
        }
        else {
            return $qty;
        }
    }

    private function validateDiscount($dis)
    {
        $dis = trim($dis);
        if (empty($dis)) {
            return 0;
        }
        else if ($dis < 0 or $dis > 99) {
            $this->productError['discountError'] = "Discount cannot be negative or greater than 99";
        }
        else if (!is_numeric($dis) and !is_int($dis)) {
            $this->productError['discountError'] = "Only enter an integer";
        }
        else {
            return $dis;
        }
    }

    private function newPrice($price, $discount)
    {
        $oldPrice = $this->validatePrice($price);
        $discount = $this->validateDiscount($discount);

        if (!$this->productError["priceError"] and !$this->productError["discountError"]) {
            $new_price = ceil(((100 - $discount) / 100) * $oldPrice);
            return $new_price;
        }
    }

    private function validateDescription($des)
    {
        $des = trim($des);
        if (empty($des)) {
            $this->productError["descriptionError"] = "Kindly input the description of your product";
        }
        else if (!is_string($des)) {
            $this->productError["descriptionError"] = "Description can only contain letters, numbers or characters";
        }
        else if (count(explode(" ", $des)) > 500) {
            $this->productError['descriptionError'] = "Description cannot be greater than 500 words";
        }
        else {
            return $des;
        }
    }

    private function validateImage($img)
    {
        $imageFile = $img;
        $rand = rand(1111111111, 9999999999) . "_";
        $file_name = $rand . basename($imageFile['name']);
        $error = $imageFile['error'];
        $size = $imageFile['size'];
        $temp_name = $imageFile['tmp_name'];
        $path = "../../product_images/$file_name";
        $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowedExt = ["jpg", "jpeg", "png"];

        if (empty(basename($imageFile['name']))) {
            $this->productError["imageError"] = "Upload your products's image";
        }
        else if (!in_array($extension, $allowedExt)) {
            $this->productError["imageError"] = "Only upload .jpg, .jpeg and .png format";
        }
        else if ($size > 5000000) {
            $this->productError["imageError"] = "Your image cannot be greater than 5MB";
        }
        else {
            if ($error != 0) {
                $this->productError["imageError"] = "There was an error uploading your image";
            }
            else {
                if (!$this->productError) {
                    move_uploaded_file($temp_name, $path);
                    return $file_name;
                }
            }
        }

    }

    public function validateProduct($category, $name, $brand, $price, $quantity, $discount, $description, $image)
    {
        $category = $this->validateCategory($category);
        $name = $this->validateName($name);
        $brand = $this->validateBrand($brand);
        $price = $this->validatePrice($price);
        $quantity = $this->validateQuantity($quantity);
        $discount = $this->validateDiscount($discount);
        $description = $this->validateDescription($description);
        $image = $this->validateImage($image);

        if (!$this->productError["priceError"] and !$this->productError["discountError"]) {
            $newPrice = $this->newPrice($price, $discount);
            $this->productError["newPrice"] = $newPrice;
        }

    // if (!$this->productError) {
    // }
    }
}

$product = new Product();

$product->validateProduct($_POST["prod-category"], $_POST["prod-name"], $_POST["prod-brand"], $_POST["prod-price"], $_POST["prod-quantity"], $_POST["prod-discount"], $_POST["prod-description"], $_FILES["prod-image"]);
echo json_encode($product->productError);
?>