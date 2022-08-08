<?php
$pageTitle = "Dashboard";

//include navigation
require_once "admin-seller-nav.php";

// include category
require_once "../server/common/product-server.php";

//include all users
require_once "../server/common/users.php";

//include sellers gottten from users. sellers' products can be gotten here
require_once "../server/seller/seller.php";

if (!isset($_SESSION['email'])) {
    header('location:../login.php');
}
    // $pageTitle = $_SESSION['role'] . " " . "dashboard";
?>

<section id="dashboard" class="container-fluid">
    <h5 class="mt-3">What would you like to do today?</h5>
    <form name="display_form" method="POST">
        <div class="row">
            <div class="form-floating my-3 col-sm-3">
                <select class="form-select" name="sellers">
                    <?php
                    if($_SESSION['level'] === "admin"){
                        echo "<option value=''>All</option>";
                    }                   
                    foreach($allSellers as $eachSeller){
                        $fullName = $eachSeller['first_name']  . " " . $eachSeller['last_name'] . " - " . $eachSeller['username'];
                        $username = $eachSeller['username'];
                        if($_SESSION['level'] === "admin") { ?>
                    <option value='<?php echo $username ?>'
                        <?php echo $sellers->addSelectedAttr($selectedOptionSeller, $username) ?>>
                        <?php echo $fullName ?>
                    </option>;
                    <?php }
                    if($_SESSION['level'] === "seller" and $_SESSION['username'] === $username) { ?>
                    <option value='<?php echo $username?>'>
                        <?php echo $fullName ?>
                    </option>
                    <?php }} ?>
                </select>
                <label for="sellers" class="ps-4 form-label"><?php
                    if($_SESSION['level'] == "admin"){
                        echo "Sellers";
                    }
                    if ($_SESSION['level'] == "seller") {
                        echo "Seller";
                    }
                    ?>
                </label>
            </div>

            <div class="form-floating my-3 col-sm-3">
                <select class="form-select" name="category">
                    <option value=''>All</option>
                    <?php
$i = 0;
while ($i < count($categoriesNames)) { ?>
                    <option value='<?php echo $categoriesValues[$i] ?>'
                        <?php echo $sellers->addSelectedAttr($selectedOptionCat, $categoriesValues[$i]) ?>>
                        <?php echo $categoriesNames[$i] ?>
                    </option>
                    <?php $i++;
                    }?>
                </select>
                <label for="category" class="ps-4 form-label">Product Category</label>
            </div>

            <div class="col-sm-3 my-4 ">
                <button name="generate_product" type="submit" class="btn btn-success">Get products</button>
            </div>
        </div>
    </form>

    <?php
        if ($products) { ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th>S/N</th>
                    <th>Product ID</th>
                    <?php
    if (!isset($_POST['generate_product']) or (isset($_POST['generate_product']) and !$_POST['category'])) {
        echo "<th>Category</th>";
    }?>
                    <th>Product Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <?php
                if((!isset($_POST['generate_product']) and $_SESSION['level'] == "admin") or (isset($_POST['generate_product']) and !$_POST['sellers'])){
                    echo "<th>Seller username</th>";
                }?>
                    <th colspan="3">Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php
            $i = 0;
            foreach ($products as $eachProduct) {
                $sn = ++$i;
                $id = $eachProduct['id'];
                $category = $eachProduct['category'];
                $name = $eachProduct['name'];
                $image = $eachProduct['image'];
                $price = $eachProduct['new_price'];
                $quantity = $eachProduct['quantity'];
                $username = $eachProduct['added_by'];
                echo "
                <tr>
                    <td>$sn</td>
                    <td>$id</td>";
                    if(!isset($_POST['generate_product']) or (isset($_POST['generate_product']) and !$_POST['category'])){
                        echo "<td>$category</td>";
                    }
                    echo "
                    <td>$name</td>
                    <td><img src='../product_images/$image' class='img-fluid' width='100px' alt='$name' title='$name'></td>
                    <td>$price</td>
                    <td>$quantity</td>";

                    if ((!isset($_POST['generate_product']) and $_SESSION['level'] == "admin") or (isset($_POST['generate_product']) and !$_POST['sellers'])) {
                        echo "<td>$username</td>";
                                }
                    echo "
                    <td>
                        <a class='btn btn-success' target='_blank' href=''>View</a>
                    </td>
                    <td>
                        <a class='btn btn-primary' target='_blank' href=''>Update</a>
                    </td>
                    <td>
                        <form action='database_details.php' method='get'>
                            <input name='deleteUser' type='hidden' value=''>
                            <button name='delete' class='btn btn-danger'>Delete</button>
                        </form>
                    </td>
                </tr>
                        ";

                }?>
            </tbody>
        </table>
    </div>
    <?php }
        else {
            echo "<h5>No product available for the seller in the selected category.</h5>";
        }
    ?>

</section>