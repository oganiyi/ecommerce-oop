<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <?php
if ($pageTitle === "Register") { ?>
    <link rel="stylesheet" href="../css/admin/register.css">
    <?php
    if ($pageTitle === "Product") { ?>
    <link rel="stylesheet" href="../css/common/product.css">
    <?php
    }
}
?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="../common/dashboard.php"><?php
if ($_SESSION['level'] === "admin") {
    echo "Admin";
}
if ($_SESSION['level'] === "seller") {
    echo "Seller";
}
?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapsibleNavbarSecond">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbarSecond">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../common/dashboard.php">Home</a>
                    </li>
                    <?php if ($_SESSION['level'] === "admin") {
    echo "<li class='nav-item'>
                        <a class='nav-link' href='../admin/register.php'>Register</a>
                    </li>";
}?>
                    <li class="nav-item">
                        <a class="nav-link" href="../common/product.php">Product</a>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown">Register</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="register/agent.php">Agent</a></li>
                            <li><a class="dropdown-item" href="#">Author</a></li>
                        </ul>
                    </li> -->
                </ul>
                <a href="../index.php" class="btn btn-primary me-3">Go to website</a>
                <a href="../logout.php" class="btn btn-danger me-2">Logout <i class="fa fa-power-off"
                        aria-hidden="true"></i>
                </a>
            </div>

        </div>
    </nav>