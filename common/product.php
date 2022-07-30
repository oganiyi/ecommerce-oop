<?php
$pageTitle = "Product";
require_once "admin-seller-nav.php";
require_once "../server/common/product-server.php";
if (!isset($_SESSION['email'])) {
    header('location:../login.php');
}
?>

<div class="container-fluid">
    <div id="validity" class="my-3 alert alert-dismissible"></div>
    <form name="sell_form" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="form-floating my-3 col-md-4">
                <select class="form-select" name="prod-category">
                    <option value="">Choose...</option>
                    <?php
$i = 0;
while ($i < count($categoriesNames)) {
    echo "<option value='$categoriesValues[$i]'>$categoriesNames[$i]</option>";
    $i++;
}?>
                </select>
                <label for="category" class="ps-4 form-label">Category</label>
                <small id="prod-categoryErr" class="text-danger"></small>
            </div>

            <?php
echo $sellServer->input("12", "name", "product name", "XIAOMI Redmi 9C, 4GB/128GB Memory, Android 10 - Aura Green");
echo $sellServer->input("col-6 col-sm-4 col-md-3", "brand", "product brand", "infinix");
echo $sellServer->input("col-6 col-sm-4 col-md-3", "price", "product price", "24, 150, 1000, etc. Do not include decimal");
echo $sellServer->input("col-6 col-sm-4 col-md-3", "quantity", "quantity available", "10, 1, 50, etc. Do not include decimal");
echo $sellServer->input("col-6 col-sm-4 col-md-3", "discount", "product discount", "2,45,20, etc. Do not include decimal and %");
?>

            <div class="my-3 col-12">
                <label for="prod-description" class="form-label"><b>Description</b></label>
                <textarea class="form-control mb-3" name="prod-description" id="prod-description"
                    placeholder="Description of your product" rows="15"></textarea>
                <small id="prod-descriptionErr" class="text-danger"></small>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-8">
                <label for="image" class="form-label"><b>Upload picture</b></label>
                <input type="file" class="form-control p-3" id="image" name="prod-image">
                <small id="imageErr" class="text-danger"></small>
            </div>
            <div class="col-sm-4 mt-2 mt-sm-5">
                <button name="add-more-images" id="add-more-images" type="button" class="btn btn-success p-2">Add more
                    images</button>
            </div>
        </div>
</div>
<input type="submit" name="sell" value="Upload product" class="btn btn-success m-3">
</form>
</div>
<script src="../js/common/product.js"></script>