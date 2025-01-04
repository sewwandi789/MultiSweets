<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>View Users</title>
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
            display: flex;
            flex-direction: column;
        }

        /* Dashboard Layout */
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

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #444;
            min-width: 160px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
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

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 2em;
            color: #444;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 2em;
            color: White;
        }

        .add-user {
            text-align: right;
            margin-bottom: 20px;
        }

        .add-user button {
            padding: 10px 20px;
            background: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .add-user button:hover {
            background: #218838;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        th, td {
            padding: 10px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #2d3e50;
            color: #fff;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .actions button {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .edit-btn {
            background: #ffc107;
            color: #fff;
        }

        .edit-btn:hover {
            background: #e0a800;
        }

        .delete-btn {
            background: #dc3545;
            color: #fff;
        }

        .delete-btn:hover {
            background: #c82333;
        }

        /* Close Button */
        .close-btn {
            font-size: 30px;
            color: #ff0000;
            cursor: pointer;
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 5px;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .close-btn:hover {
            background-color: #ffdddd;
            color: #cc0000;
            transform: scale(1.2);
        }

        .close-btn:active {
            background-color: #ffaaaa;
            color: #990000;
            transform: scale(1);
        }

        @media (max-width: 768px) {
            .dashboard {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                height: auto;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <!-- Sidebar -->
        <aside class="sidebar">
        <h2 class="text-primary fw-bold mb-0">Multi<span class="text-dark">Sweets</span> </h1>
            <nav>
                <a href="../src/dashboard.php">Dashboard</a>
                <a href="#">Reports</a>
                <a href="#">Analytics</a>
                <a href="#">Orders</a>
                <div class="dropdown">
                    <a href="#">Settings</a>
                    <div class="dropdown-content">
                        <a href="foodItemMain.php">Food Items</a>
                        <a href="userView.php">User Management</a>
                        <a href="userView.php">Gallery</a>
                    </div>
                </div>
                <a href="../index.php">Back to Web</a>
                <a href="../src/notificationView.php">Notifications</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <span class="close-btn" onclick="closePage()">&times;</span>
            <h1>View Users</h1>

            <div class="add-user">
                <button onclick="addUser()">Add User</button>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include_once '../query/dbconfig.php';
                        $sql = "SELECT id, name, email ,role FROM users";
                        $result = $conn->query($sql);

                        if ($result) {
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                        <td>{$row['id']}</td>
                                        <td>{$row['name']}</td>
                                        <td>{$row['email']}</td>
                                        <td>{$row['role']}</td>
                                        <td class='actions'>
                                            <button class='edit-btn' onclick='editUser({$row['id']})'>Edit</button>
                                            <button class='delete-btn' onclick='deleteUser({$row['id']})'>Delete</button>
                                        </td>
                                    </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4'>No users found</td></tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>Error fetching data: " . $conn->error . "</td></tr>";
                        }

                        $conn->close();
                    ?>
                </tbody>
            </table>
        </main>
    </div>

    <script>
        function addUser() {
            window.location.href = 'addUser.php';
        }

        function editUser(userId) {
            window.location.href = `editUser.php?id=${userId}`;
        }

        function deleteUser(userId) {
            if (confirm('Are you sure you want to delete this user?')) {
                window.location.href = `deleteUser.php?id=${userId}`;
            }
        }

        function closePage() {
            window.history.back();
        }
    </script>
</body>
</html>
