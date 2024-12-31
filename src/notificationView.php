<?php
// Include your database connection file
include_once '../index/dbconfig.php';

// Initialize filter variables
$filter_status = isset($_GET['status']) ? $_GET['status'] : 'all';
$filter_name = isset($_GET['name']) ? $_GET['name'] : '';

// Prepare base SQL query
$sql = "SELECT * FROM contact_messages WHERE 1=1";

// Apply status filter
if ($filter_status !== 'all') {
    $sql .= " AND status = ?";
}

// Apply name filter
if (!empty($filter_name)) {
    $sql .= " AND name LIKE ?";
}

// Add ordering
$sql .= " ORDER BY created_at DESC";

$stmt = $conn->prepare($sql);

// Bind parameters dynamically
$params = [];
if ($filter_status !== 'all') {
    $params[] = $filter_status;
}
if (!empty($filter_name)) {
    $params[] = "%$filter_name%";
}

// Bind parameters to the statement
if (!empty($params)) {
    $stmt->bind_param(str_repeat("s", count($params)), ...$params);
}

// Execute query
$stmt->execute();
$result = $stmt->get_result();

// Mark as read functionality
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['mark_read'])) {
        $id = $_POST['id'];
        $sql_update = "UPDATE contact_messages SET status = 'read' WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("i", $id);
        if ($stmt_update->execute()) {
            echo "<script>alert('Notification marked as read'); window.location.reload();</script>";
        } else {
            echo "<script>alert('Error marking notification as read');</script>";
        }
        $stmt_update->close();
    }

    // Delete functionality
    if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $sql_delete = "DELETE FROM contact_messages WHERE id = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param("i", $id);
        if ($stmt_delete->execute()) {
            echo "<script>alert('Notification deleted'); window.location.reload();</script>";
        } else {
            echo "<script>alert('Error deleting notification');</script>";
        }
        $stmt_delete->close();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
    <title>Notification Management</title>
    <!-- Bootstrap for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            height: 100vh;
            overflow: hidden;
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

        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}



.dashboard {
    display: flex;
    flex: 1;
}

.sidebar {
    width: 250px;
    background: #2d3e50;
    color: #fff;
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 10px;
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
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

.main-content {
    flex: 1;
    margin-left: 200px; /* Push content to the right of the sidebar */
    padding: 20px;
    overflow-y: auto;
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

table {
    width: 100%;
    border-collapse: collapse;
    background: #000;
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
    </style>
</head>
<body>
    <div class="container mt-5">
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
                <a href="notification/notificationView.php">Notifications</a>
            </nav>
        </aside>
        <main class="main-content">
        <h1 class="text-center">Notifications</h1>
        
        <!-- Filter Form -->
        <form method="GET" action="" class="mb-4">
            <label for="status" class="form-label">Filter by Status</label>
            <select name="status" id="status" class="form-select" onchange="this.form.submit()">
                <option value="all" <?php echo $filter_status == 'all' ? 'selected' : ''; ?>>All</option>
                <option value="unread" <?php echo $filter_status == 'unread' ? 'selected' : ''; ?>>Unread</option>
                <option value="read" <?php echo $filter_status == 'read' ? 'selected' : ''; ?>>Read</option>
            </select>

            <label for="name" class="form-label mt-3">Filter by Name</label>
            <input type="text" name="name" id="name" class="form-control" value="<?php echo htmlspecialchars($filter_name); ?>" placeholder="Enter name" onkeyup="this.form.submit()">
        </form>

        <!-- Notification Table -->
        <?php if ($result->num_rows > 0) { ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { 
                        $status = $row['status'] == 'unread' ? 'Unread' : 'Read';
                        $statusClass = $row['status'] == 'unread' ? 'bg-warning' : 'bg-success';
                    ?>
                        <tr class="<?php echo $statusClass; ?>">
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['message']); ?></td>
                            <td><?php echo $status; ?></td>
                            <td class="actions">
                                <!-- Mark as Read Button -->
                                <form method="POST" action="" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="mark_read" class="btn btn-primary btn-sm">Mark as Read</button>
                                </form>

                                <!-- Delete Button -->
                                <form method="POST" action="" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="delete" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
                    </main>
        <?php } else { ?>
            <p class="text-center">No notifications found.</p>
        <?php } ?>
    </div>
</body>
</html>