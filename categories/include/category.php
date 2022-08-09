<?php
require_once "../server/common/users.php";
require_once "../server/seller/seller.php"; ?>

<section id="category" class="container-fluid my-3">
    <?php foreach ($sellers->getAllProducts() as $productCategory) {
        if ($productCategory['category'] !== $pageTitle) {
            continue;
        }
        $name = $productCategory["name"];
        $image = $productCategory["image"];
        $oldPrice = $productCategory["price"];
        $newPrice = $productCategory["new_price"];
        $discount = $productCategory["discount"];
?>
    <div class="card">
        <img class="card-img-top rounded img-fluid" width="50px" src="../product_images/<?php echo $image ?>"
            alt="Card image">
        <div class="card-body">
            <p class="card-title">
                <?php
                if(count(explode(' ', $name)) > 7){
                echo implode(' ', array_slice(explode(' ', $name), 0, 7)) . "...";
                }
                else{
                    echo $name;
                } ?>
            </p>
            <p class="card-text">Card text</p>
            <button class="btn btn-primary">Add to cart</button>
        </div>
    </div>
    <?php
    
}?>
</section>