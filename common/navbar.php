<!-- <?php session_start() ?> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/categories/category.css">
    <title><?php echo $pageTitle; ?></title>
</head>

<body>
    <nav class="navbar navbar-expand-lg  navbar-light  sticky-tOP">
        <div class="container-fluid ">
            <a class="navbar-brand  fw-bold" href="">JUMIA <i class="fas fa-star text-warning"></i> </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <input class="form-control  me-2" type="search" placeholder=" Search Product,Brands,Categories"
                aria-label="Search">
            <button class="btn btn-outline-warning fw-bold " type="submit">SEARCH</button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-tie"></i> Account
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a style="border:2px solid whitesmoke; border-radius:10px;"
                                    class="dropdown-item bg-warning text-white text-center fw-bold" href="">SIGN IN</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href=""><i class="fas fa-user"></i> My Account</a></li>
                            <li> <a class="dropdown-item" href=""><i class="fas fa-folder-plus m-1"></i>Order</a></li>
                            <li><a class="dropdown-item" href=""><i class="fas fa-heart m-1"></i>Saved Items</a></li>
                        </ul>
                </ul>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle " href="" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-question "></i> Help
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="">Help Center</a></li>
                                <li><a class="dropdown-item" href="">Place & track order</a></li>
                                <li><a class="dropdown-item" href="">Order cancellation</a></li>
                                <li><a class="dropdown-item" href="">Returns & Refunds </a></li>
                                <li><a class="dropdown-item" href="">Payments & jumia account </a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a style="border:2px solid whitesmoke; border-radius:20px; color: whitesmoke;  "
                                        class="dropdown-item bg-warning text-center fw-bold" href=""><i
                                            class="fas fa-quote-right"></i> LIVE CHAT</a></li>
                            </ul>
                        <li class="nav-item">
                            <a class="nav-link disabled text-dark" href="#" tabindex="-1" id="cart"
                                aria-disabled="true"><i class="fas fa-cart-plus m-2"></i>Cart</a>
                        </li>
                    </ul>

                </div>
            </div>
    </nav>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-sm-2">
                <p>
                    <button class="btn btn-dark" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Our Categories
                    </button>
                </p>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        <a href=""><i class="fab fa-apple"></i> Supermarket</a>
                        <a href=""><i class="fas fa-flask"></i> Health & Beauty</a>
                        <a href=""><i class="fas fa-home"></i> Home & Office</a>
                        <a href=""><i class="fas fa-mobile"></i> Phones & Tablets</a>
                        <a href=""><i class="fas fa-desktop"></i> computing</a>
                        <a href=""><i class="fas fa-plug"></i> Eletronics</a>
                        <a href=""><i class="fas fa-tshirt"></i> Fashions</a>
                        <a href=""><i class="fas fa-baby"></i> Baby Products</a>
                        <a href=""><i class="fas fa-gamepad"></i> Gaming</a>
                        <a href=""><i class="fas fa-dumbbell"></i> Sporting Goods</a>
                        <a href=""><i class="fas fa-car"></i> Automobile</a>
                        <a href=""><i class="fas fa-shoe-prints"></i> Shoes</a>
                        <hr>
                        <a href=""><i class="fas fa-circle"></i> Other Categories</a>
                    </div>
                </div>

            </div>

            <!-- <div class="col-sm-8 mt-2 ">
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="../images/Slider_DISCOVER.jpg" class="d-block " alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="../images/Slider_copy.jpg" class="d-block " alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="../images/Warranty-Guaranted-homepage-des-sli.jpg" class="d-block" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="../images/new_712x384v2.png" class="d-block" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="../images/pizza-week_712x384.jpg" class="d-block" alt="...">
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-sm-2">
                <img src="../images/clothes.jpeg" class="img" alt="">
                <img src="../images/jeans.jpeg" class="img" alt="">

            </div>
        </div> -->
            <!-- second -->