<?php
// Include database configuration
include_once './index/dbconfig.php';

// Fetch Menu Items
$offers = [];
$specials = [];

// Fetch Offers
$sqlOffers = "SELECT * FROM food_items WHERE category = 'Offers'";
$resultOffers = $conn->query($sqlOffers);
if ($resultOffers->num_rows > 0) {
    $offers = $resultOffers->fetch_all(MYSQLI_ASSOC);
}

// Fetch Specials
$sqlSpecials = "SELECT * FROM food_items WHERE category = 'Our Special'";
$resultSpecials = $conn->query($sqlSpecials);
if ($resultSpecials->num_rows > 0) {
    $specials = $resultSpecials->fetch_all(MYSQLI_ASSOC);
}

$sqlStarter = "SELECT * FROM food_items WHERE category = 'Starter'";
$resultStarter = $conn->query($sqlStarter);
if ($resultStarter->num_rows > 0) {
    $Starter = $resultStarter->fetch_all(MYSQLI_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Multi Sweets</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Playball&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/owl.carousel.min.css" rel="stylesheet">

    <!-- Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

   <!-- Template Stylesheet -->
   <link href="../css/style.css" rel="stylesheet">

    <style>
        .menu-container {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .menu-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #e6d5b8;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .menu-item img {
            width: 100px;
            height: 100px;
            border-radius: 8px;
            margin-right: 20px;
        }

        .menu-item h3 {
            font-size: 1.5rem;
            color: #e6b552;
            margin: 0;
        }

        .menu-item p {
            margin: 5px 0;
            font-size: 1rem;
            color: #555;
        }

        .menu-item .price {
            font-size: 1.2rem;
            font-weight: bold;
            color: #000;
        }

        .button {
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: bold;
            color: #fff;
            background-color: #e6b552; /* Gold buttons */
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
            display: inline-block;
        }

        .button:hover {
            background-color: #d4a143;
        }
    </style>
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar Start -->
    <div class="container-fluid nav-bar">
            <div class="container">
                <nav class="navbar navbar-light navbar-expand-lg py-4">
                    <a href="index.php" class="navbar-brand">
                        <h1 class="text-primary fw-bold mb-0">Multi<span class="text-dark">Sweets</span> </h1>
                    </a>
                    <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <div class="navbar-nav mx-auto">
                            <a href="index.php" class="nav-item nav-link">Home</a>
                            <a href="about.php" class="nav-item nav-link">About</a>
                            <a href="service.php" class="nav-item nav-link">Services</a>
                            <a href="event.php" class="nav-item nav-link">Events</a>
                            <a href="menu.php" class="nav-item nav-link active">Menu</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                                <div class="dropdown-menu bg-light">
                                    <a href="book.php" class="dropdown-item">Booking</a>
                                    <a href="blog.php" class="dropdown-item">Our Blog</a>
                                    <a href="team.php" class="dropdown-item">Our Team</a>
                                    <a href="testimonial.php" class="dropdown-item">Testimonial</a>
                                    <a href="404.php" class="dropdown-item">404 Page</a>
                                </div>
                            </div>
                            <a href="contact.php" class="nav-item nav-link">Contact</a>
                        </div>
                        <button class="btn-search btn btn-primary btn-md-square me-4 rounded-circle d-none d-lg-inline-flex" data-bs-target="#searchModal" onclick="window.location.href='LoginPage.php'"><i class="fas fa-user" ></i></button>                      
                        <button class="btn-search btn btn-primary btn-md-square me-4 rounded-circle d-none d-lg-inline-flex" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search"></i></button>
                        <a href="" class="btn btn-primary py-2 px-4 d-none d-xl-inline-block rounded-pill">Book Now</a>
                    </div>
                </nav>
            </div>
        </div>
    <!-- Navbar End -->

    <!-- Menu Section -->
    <div class="container-fluid menu py-6">
        <div class="container">
            <div class="text-center">
                <small class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Our Menu</small>
                <h1 class="display-5 mb-5">Most Popular Food in the World</h1>
            </div>
            <div class="tab-class text-center">
                <ul class="nav nav-pills d-inline-flex justify-content-center mb-5">
                    <li class="nav-item p-2">
                        <a class="nav-link d-flex py-2 mx-2 border border-primary bg-white rounded-pill active" data-bs-toggle="pill" href="#tab-offers">
                            <span class="text-dark" style="width: 150px;">Offers</span>
                        </a>
                    </li>
                    <li class="nav-item p-2">
                        <a class="nav-link d-flex py-2 mx-2 border border-primary bg-white rounded-pill" data-bs-toggle="pill" href="#tab-special">
                            <span class="text-dark" style="width: 150px;">Our Special</span>
                        </a>
                    </li>
                    
                </ul>
                <div class="tab-content">
                    <!-- Offers Tab -->
                    <div id="tab-offers" class="tab-pane fade show active">
                        <div class="menu-container">
                            <?php if (!empty($offers)) : ?>
                                <?php foreach ($offers as $offer) : ?>
                                    <div class="menu-item">
                                        <img src="<?php echo 'src/' . $offer['image']; ?>" alt="<?php echo $offer['name']; ?>" class="img-fluid">
                                        <div>
                                            <h3><?php echo $offer['name']; ?></h3>
                                            <p><?php echo $offer['food_description']; ?></p>
                                        </div>
                                        <div>
                                            <p class="price">$<?php echo number_format($offer['price'], 2); ?></p>
                                            <a href="order.php?id=<?php echo $offer['id']; ?>" class="button">Order</a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <p class="text-muted">No offers available at the moment.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- Specials Tab -->
                    <div id="tab-special" class="tab-pane fade">
                        <div class="menu-container">
                            <?php if (!empty($specials)) : ?>
                                <?php foreach ($specials as $special) : ?>
                                    <div class="menu-item">
                                        <img src="<?php echo 'src/' . $special['image']; ?>" alt="<?php echo $special['name']; ?>" class="img-fluid">
                                        <div>
                                            <h3><?php echo $special['name']; ?></h3>
                                            <p><?php echo $special['food_description']; ?></p>
                                        </div>
                                        <div>
                                            <p class="price">$<?php echo number_format($special['price'], 2); ?></p>
                                            <a href="order.php?id=<?php echo $special['id']; ?>" class="button">Order</a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <p class="text-muted">No specials available at the moment.</p>
                            <?php endif; ?>
                        </div>
                    </div>


            </div>
        </div>
    </div>
    <!-- Menu Section End -->
  
  <!-- Footer Start -->
  <div class="container-fluid footer py-6 my-6 mb-0 bg-light wow bounceInUp" data-wow-delay="0.1s">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-item">
                            <h1 class="text-primary">Multi<span class="text-dark">Sweets</span></h1>
                            <p class="lh-lg mb-4">Experience the joy of handmade sweets made with love and the finest ingredients. Satisfy your cravings with our special offerings!</p>
                            <div class="footer-icon d-flex">
                                <a class="btn btn-primary btn-sm-square me-2 rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-primary btn-sm-square me-2 rounded-circle" href=""><i class="fab fa-twitter"></i></a>
                                <a href="#" class="btn btn-primary btn-sm-square me-2 rounded-circle"><i class="fab fa-instagram"></i></a>
                                <a href="#" class="btn btn-primary btn-sm-square rounded-circle"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-item">
                            <h4 class="mb-4">Special Facilities</h4>
                            <div class="d-flex flex-column align-items-start">
                                <a class="text-body mb-3" href=""><i class="fa fa-check text-primary me-2"></i>Oil Cakes</a>
                                <a class="text-body mb-3" href=""><i class="fa fa-check text-primary me-2"></i>Mun Kewum</a>
                                <a class="text-body mb-3" href=""><i class="fa fa-check text-primary me-2"></i>Ruhuna Tea</a>
                                <a class="text-body mb-3" href=""><i class="fa fa-check text-primary me-2"></i>Special Sweets</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-item">
                            <h4 class="mb-4">Contact Us</h4>
                            <div class="d-flex flex-column align-items-start">
                                <p><i class="fa fa-map-marker-alt text-primary me-2"></i> 123 Street, New York, USA</p>
                                <p><i class="fa fa-phone-alt text-primary me-2"></i> + 94 70 44 53 964</p>
                                <p><i class="fa fa-phone-alt text-primary me-2"></i> + 94 71 33 43 564</p>
                                <p><i class="fas fa-envelope text-primary me-2"></i> PriyaSweetHome@gmail.com</p>
                                <p><i class="fa fa-clock text-primary me-2"></i> 24/7 Hours Service</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-item">
                            <h4 class="mb-4">Social Gallery</h4>
                            <div class="row g-2">
                                <div class="col-4">
                                     <img src="../img/menu-01.jpg" class="img-fluid rounded-circle border border-primary p-2" alt="">
                                </div>
                                <div class="col-4">
                                     <img src="../img/menu-02.jpg" class="img-fluid rounded-circle border border-primary p-2" alt="">
                                </div>
                                <div class="col-4">
                                     <img src="../img/menu-03.jpg" class="img-fluid rounded-circle border border-primary p-2" alt="">
                                </div>
                                <div class="col-4">
                                     <img src="../img/menu-04.jpg" class="img-fluid rounded-circle border border-primary p-2" alt="">
                                </div>
                                <div class="col-4">
                                     <img src="../img/menu-05.jpg" class="img-fluid rounded-circle border border-primary p-2" alt="">
                                </div>
                                <div class="col-4">
                                     <img src="../img/menu-06.jpg" class="img-fluid rounded-circle border border-primary p-2" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Copyright Start -->
        <div class="container-fluid copyright bg-dark py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        <span class="text-light"><a href="#">All right reserved.</span>
                    </div>
                    <div class="col-md-6 my-auto text-center text-md-end text-white">
                    By <a class="border-bottom" href="#">TTs software solution</a> Distributed By <a class="border-bottom" href="https://themewagon.com">ThemeWagon</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->



        <!-- Back to Top -->
        <a href="#" class="btn btn-md-square btn-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('spinner').classList.add('d-none');
        });
    </script>
</body>

</html>
