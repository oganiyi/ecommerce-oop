<?php
require_once "database.php";
require_once "product-server.php";
session_start();

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
            $name = str_replace("'", "\'", $name);
            return $name;
        }
    }

    private function validateBrand($brand)
    {
        $brand = trim($brand);
        if (empty($brand)) {
            return "";
        }
        else if (!is_string($brand)) {
            $this->productError["brandError"] = "Brand can only contain letters, numbers or characters";
        }
        else if (count(explode(" ", $brand)) > 4) {
            $this->productError['brandError'] = "Brand cannot be greater than 4 words";
        }
        else {
            $brand = str_replace("'", "\'", $brand);
            return ucfirst($brand);
        }
    }

    private function validatePrice($price)
    {
        $price = trim($price);
        if (empty($price)) {
            $this->productError['priceError'] = "Input the price of your product";
        }
        else if (!is_numeric($price) and !is_int($price)) {
            $this->productError['priceError'] = "Only enter an integer";
        }
        else if ($price <= 0) {
            $this->productError['priceError'] = "Price cannot be zero or negative";
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
        else if (!is_numeric($qty) and !is_int($qty)) {
            $this->productError['quantityError'] = "Only enter an integer";
        }
        else if ($qty < 1) {
            $this->productError['quantityError'] = "Quantity cannot be less than 1";
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
        else if (!is_numeric($dis) and !is_int($dis)) {
            $this->productError['discountError'] = "Only enter an integer";
        }
        else if ($dis < 0 or $dis > 99) {
            $this->productError['discountError'] = "Discount cannot be negative or greater than 99";
        }
        else {
            return $dis;
        }
    }

    private function newPrice($price, $discount)
    {
        $new_price = ceil(((100 - $discount) / 100) * $price);
        return $new_price;
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
        else if (count(explode(" ", $des)) > 1000) {
            $this->productError['descriptionError'] = "Description cannot be greater than 1000 words";
        }
        else {
            $des = str_replace("'", "\'", $des);
            return $des;
        }
    }

    private function validateImage($img)
    {
        $rand = rand(1111111111, 9999999999) . "_";
        $file_name = $rand . basename($img['name']);
        $file_name = str_replace("'", "\'", $file_name);
        $error = $img['error'];
        $size = $img['size'];
        $temp_name = $img['tmp_name'];
        $path = "../../product_images/$file_name";
        $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowedExt = ["jpg", "jpeg", "png"];

        if (empty(basename($img['name']))) {
            $this->productError["imageError"] = "Upload your product's image";
        }
        else if (!in_array($extension, $allowedExt)) {
            $this->productError["imageError"] = "Only upload jpg, jpeg and png format";
        }
        else if ($size > 5000000) {
            $this->productError["imageError"] = "Your image cannot be greater than 5MB";
        }
        else {
            if ($error != 0) {
                $this->productError["imageError"] = "There was an error uploading your image";
            }
            else {
                $tempPathFileName = [];
                $tempPathFileName['temp_name'] = $temp_name;
                $tempPathFileName['path'] = $path;
                $tempPathFileName['file_name'] = $file_name;
                return $tempPathFileName;

            }
        }
    }

    private function validateAddedImages($img)
    {
        $i = 0;
        $addedImagesArray = [];

        foreach ($img['error'] as $key => $error) {
            $rand = rand(1111111111, 9999999999) . "_";
            $file_name = $rand . $img['name'][$key];
            $file_name = str_replace("'", "\'", $file_name);
            $error = $img['error'][$key];
            $size = $img['size'][$key];
            $temp_name = $img['tmp_name'][$key];
            $path = "../../added_product_images/$file_name";
            $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $allowedExt = ["jpg", "jpeg", "png"];
            if (empty($img['name'][$key])) {
                $this->productError["addedImagesError"][$key] = "Upload your product's additional image<br>";
            }
            else if (!in_array($extension, $allowedExt)) {
                $this->productError["addedImagesError"][$key] = "Only upload jpg, jpeg and png format<br>";
            }
            else if ($size > 5000000) {
                $this->productError["addedImagesError"][$key] = "Your image cannot be greater than 5MB<br>";
            }
            else {
                if ($error != 0) {
                    $this->productError["addedImagesError"][$key] = "There was an error uploading your image<br>";
                }
                else {
                    $tempPathFileName = [];
                    $tempPathFileName['temp_name'] = $temp_name;
                    $tempPathFileName['path'] = $path;
                    $tempPathFileName['file_name'] = $file_name;
                    $addedImagesArray[$i] = $tempPathFileName;
                    $i++;
                }
            }
        }
        return $addedImagesArray;
    }

    public function validateProduct($category, $name, $brand, $price, $quantity, $discount, $description, $image, $addedImages, $added_by)
    {
        $category = $this->validateCategory($category);
        $name = $this->validateName($name);
        $brand = $this->validateBrand($brand);
        $price = $this->validatePrice($price);
        $quantity = $this->validateQuantity($quantity);
        $discount = $this->validateDiscount($discount);
        $description = $this->validateDescription($description);
        $image = $this->validateImage($image);
        $yourAddedImages = [];
        if ($addedImages) {
            $yourAddedImages = $this->validateAddedImages($addedImages);
        }

        if (!$this->productError) {
            $this->productError["validity"] = "valid";
            $newPrice = $this->newPrice($price, $discount);
            $this->productError["newPrice"] = $newPrice;

            // Start- Insert product details into product table with a single image

            // Start - move the temp file into path
            move_uploaded_file($image['temp_name'], $image['path']);
            //Stop - move the temp file into path       
            $imageName = $image['file_name'];

            // set the start id to 1001
            $select = "SELECT id FROM product";
            $result = $this->connectDb()->query($select);
            if ($result->num_rows > 0) {
                $null = NULL;
                $product = "INSERT INTO product(id, category, name, brand, price, quantity, discount, new_price, image, description, added_by) 
            VALUES('$null', '$category', '$name', '$brand', '$price', '$quantity', '$discount', '$newPrice', '$imageName', '$description', '$added_by')";
                $this->connectDb()->query($product);
            }
            else {
                $start = 1001;
                $product = "INSERT INTO product(id, category, name, brand, price, quantity, discount, new_price, image, description, added_by) 
            VALUES('$start', '$category', '$name', '$brand', '$price', '$quantity', '$discount', '$newPrice', '$imageName', '$description', '$added_by')";
                $this->connectDb()->query($product);
            }

            // End- Insert product details into product table with a single image


            //Start - Insert additional product images into product table

            if ($addedImages) {
                $selectLastID = "SELECT id FROM product ORDER BY id DESC LIMIT 1";
                $selectResult = $this->connectDb()->query($selectLastID);
                if ($selectResult->num_rows > 0) {
                    $productID = $selectResult->fetch_all(MYSQLI_ASSOC);
                    foreach ($productID as $id) {
                        $id = $id["id"];
                        for ($a = 0; $a < count($yourAddedImages); $a++) {
                            $eachImg = $yourAddedImages[$a];
                            // Start - move the temp file into path
                            move_uploaded_file($eachImg['temp_name'], $eachImg['path']);
                            //End - move the temp file into path

                            $eachImgName = $eachImg['file_name'];
                            $additionalImageInsert = "INSERT INTO product_images(id, images) 
                            VALUES('$id', '$eachImgName')";
                            $this->connectDb()->query($additionalImageInsert);


                        }
                    }
                }
            }

        //End - Insert additional product images into product table

        }
        else {
            $this->productError["validity"] = "invalid";
        }
    }
}

$product = new Product();

if (array_key_exists("added_images", $_FILES)) {
    $product->validateProduct($_POST["prod-category"], $_POST["prod-name"], $_POST["prod-brand"], $_POST["prod-price"], $_POST["prod-quantity"], $_POST["prod-discount"], $_POST["prod-description"], $_FILES["prod-image"], $_FILES["added_images"], $_SESSION['username']);
}
else {
    $product->validateProduct($_POST["prod-category"], $_POST["prod-name"], $_POST["prod-brand"], $_POST["prod-price"], $_POST["prod-quantity"], $_POST["prod-discount"], $_POST["prod-description"], $_FILES["prod-image"], "", $_SESSION['username']);
}
echo json_encode($product->productError);

?>