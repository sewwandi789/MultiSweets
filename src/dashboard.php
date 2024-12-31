<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
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
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f6fa;
            color: #333;
        }

        .dashboard {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: #2d3e50;
            color: #fff;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .sidebar .logo {
            font-size: 1.8em;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar nav a {
            display: block;
            color: #fff;
            margin: 10px 0;
            text-decoration: none;
            font-size: 1.1em;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .sidebar nav a:hover {
            background: #1c2833;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 20px;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .search-bar {
            padding: 10px;
            width: 300px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid #ddd;
        }

        /* Summary Section */
        .summary {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .summary-card {
            flex: 1;
            padding: 20px;
            background: #fff;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            cursor: pointer;
        }

        .summary-card:hover {
            transform: translateY(-5px);
        }

        /* Charts */
        .charts {
            display: flex;
            gap: 20px;
        }

        .chart-container {
            flex: 1;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Recent Orders */
        .orders table {
            width: 100%;
            background: #fff;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .orders th, .orders td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .orders th {
            background: #2d3e50;
            color: #fff;
        }

        .orders tbody tr:nth-child(even) {
            background: #f9f9f9;
        }

        .orders tbody tr:hover {
            background: #f1f1f1;
        }
        /* Style for the dropdown */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown .dropdown-content {
            display: none;
            position: absolute;
            background-color:rgb(37, 35, 35);
            min-width: 160px;
            box-shadow: 0px 8px 16px rgba(216, 210, 210, 0.2);
            z-index: 1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-content a {
            color: white;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }


        /* Responsive Design */
        @media (max-width: 768px) {
            .dashboard {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                height: auto;
            }

            .charts {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h1 class="text-primary fw-bold mb-0">Multi<span class="text-dark">Sweets</span> </h1>
            <nav>
                <a href="../src/dashboard.php">Dashboard</a>
                <a href="#">Reports</a>
                <a href="#">Analytics</a>
                <a href="#">Orders</a>
                <div class="dropdown">
                    <a href="#">Settings</a>
                    <div class="dropdown-content">
                        <a href="foodItemMain.php">Food Items</a>
                        <a href="userView.php">user managment</a>
                        <a href="userView.php">Gallery</a>
                    </div>
                </div>
                <a href="../index.php">Back to web</a>
                <a href="../src/notificationView.php">Notifications</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header>
                <input type="text" placeholder="Search" class="search-bar">
                <div class="user-info">
                    <img src="user-avatar.png" alt="User" class="avatar">
              
                </div>
            </header>

            <!-- Summary Section -->
            <section class="summary">
                <div class="summary-card">178+ Save Products</div>
                <div class="summary-card">20+ Stock Products</div>
                <div class="summary-card">190+ Sales Products</div>
                <div class="summary-card">12+ Job Applications</div>
                <div class="summary-card" id="viewUsersCard">50+ View Users</div>
            </section>

            <!-- Reports and Analytics -->
            <section class="charts">
                <div class="chart-container">
                    <h3>Reports</h3>
                    <canvas id="lineChart"></canvas>
                </div>
                <div class="chart-container">
                    <h3>Analytics</h3>
                    <canvas id="doughnutChart"></canvas>
                </div>
            </section>

            <!-- Recent Orders -->
            <section class="orders">
                <h3>Recent Orders</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Tracking No</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>In Stock</th>
                            <th>Total Order</th>
                            <th>Pending</th>
                            <th>Canceled</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#1001</td>
                            <td>Camera Lens</td>
                            <td>$178</td>
                            <td>1236</td>
                            <td>325</td>
                            <td>170</td>
                            <td>5</td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </section>
        </main>
    </div>

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
    <script>
        // Line Chart
        const ctxLine = document.getElementById('lineChart').getContext('2d');
        new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: ['10am', '11am', '12pm', '1pm', '2pm', '3pm', '4pm'],
                datasets: [{
                    label: 'Sales',
                    data: [20, 30, 50, 40, 60, 70, 100],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                }]
            }
        });

        // Doughnut Chart
        const ctxDoughnut = document.getElementById('doughnutChart').getContext('2d');
        new Chart(ctxDoughnut, {
            type: 'doughnut',
            data: {
                labels: ['Sale', 'Distribute', 'Return'],
                datasets: [{
                    label: 'Transactions',
                    data: [80, 15, 5],
                    backgroundColor: ['#36a2eb', '#ffcd56', '#ff6384']
                }]
            }
        });

        // Redirect to User View on Card Click
        document.getElementById('viewUsersCard').addEventListener('click', () => {
            window.location.href = 'userView.php';
        });
    </script>
</body>
</html>
