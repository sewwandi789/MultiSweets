<?php
// Include database connection
include_once '../query/dbconfig.php';

// Add Food Item
if (isset($_POST['add_food'])) {
    $name = $_POST['food_name'];
    $Category = $_POST['food_cat']; // Ensure this is set and not empty
    $price = $_POST['food_price'];
    $description = $_POST['food_description'];
    $image = $_FILES['food_image']['name'];

    // Upload image to a folder (food_images)
    $target_dir = "food_images/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0755, true);
    }
    $target_file = $target_dir . basename($image);

    // Move the uploaded image
    if (move_uploaded_file($_FILES['food_image']['tmp_name'], $target_file)) {
        // Enclose $Category in single quotes (since it's a string)
        $sql = "INSERT INTO food_items (name, price, food_description, image, category, AddBy) 
                VALUES ('$name', '$price', '$description', '$target_file', '$Category', 'Admin')";
                
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('New food item added successfully.');</script>";
            header('Location: ' . 'foodItemMain.php');
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
            exit;
        }
    } else {
        echo "<script>alert('Failed to upload image.');</script>";
        exit;
    }
}

// Delete Food Item
if (isset($_GET['delete'])) {
    $food_id = $_GET['delete'];
    $sql = "DELETE FROM food_items WHERE id = '$food_id'";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Food item deleted successfully.');</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}

// Update Food Item
if (isset($_POST['update_food'])) {
    $food_id = $_POST['food_id'];
    $Category = $_POST['food_cat']; // Ensure this is set
    $name = $_POST['food_name'];
    $price = $_POST['food_price'];
    $description = $_POST['food_description'];
    $image = $_FILES['food_image']['name'];

    if ($image) {
        $target_dir = "food_images/";
        $target_file = $target_dir . basename($image);
        move_uploaded_file($_FILES['food_image']['tmp_name'], $target_file);
        $sql = "UPDATE food_items 
                SET name='$name', category='$Category', price='$price', food_description='$description', image='$target_file' 
                WHERE id='$food_id'";
    } else {
        $sql = "UPDATE food_items 
                SET name='$name', category='$Category', price='$price', food_description='$description' 
                WHERE id='$food_id'";
    }

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Food item updated successfully.');</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}

// Fetch all food items from the database
$query = "SELECT * FROM food_items";
$result = mysqli_query($conn, $query);

// Fetch single food item for edit
$edit_food = null;
if (isset($_GET['edit'])) {
    $food_id = $_GET['edit'];
    $edit_query = "SELECT * FROM food_items WHERE id = '$food_id'";
    $edit_result = mysqli_query($conn, $edit_query);
    if (mysqli_num_rows($edit_result) > 0) {
        $edit_food = mysqli_fetch_assoc($edit_result);
    } else {
        echo "<script>alert('Food item not found.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Items</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
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
        /* Sidebar styles */
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 20px;
        }
        .sidebar a {
            color: white;
            padding: 15px 20px;
            text-decoration: none;
            display: block;
        }
        .sidebar a:hover {
            background-color: #575757;
        }
        .content {
            margin-left: 260px;
            padding: 20px;
        }
        .food-form input, .food-form textarea, .food-form button {
            margin-bottom: 15px;
            width: 100%;
        }
      /* General Table Styling */
.table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
}

.table th, 
.table td {
    padding: 12px;
    text-align: center;
    vertical-align: middle;
}

.table th {
    background-color: #343a40;
    color: white;
    font-weight: bold;
}

.table-hover tbody tr:hover {
    background-color: #f1f1f1;
}

.table-bordered {
    border: 1px solid #ddd;
}

.table-bordered th, 
.table-bordered td {
    border: 1px solid #ddd;
}

/* Table Image */
.table img {
    border-radius: 5px;
    object-fit: cover;
}

/* Buttons in Table */
.btn-sm {
    padding: 5px 10px;
    font-size: 0.875rem;
}
        .btn-edit, .btn-delete {
            margin: 5px;
        }
        .no-items-message {
            color: #ff0000;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }
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
        /* Card styling */
        .card {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Form container */
        .food-form {
            max-width: 500px;
            margin: 0 auto;
        }

        /* Input fields */
        .food-form .form-control {
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 10px;
            font-size: 1rem;
        }

        /* Form labels */
        .food-form .form-label {
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }
          /* Submit button */
        .food-form button {
            background: #007bff;
            color: white;
            padding: 10px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .food-form button:hover {
            background: #0056b3;
        }

        /* Form title */
        .text-primary {
            color: #007bff;
            font-size: 2em;
            margin-bottom: 20px;
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
        /* Main container adjustments */
        .content1 {
            padding: 10px;
            margin-left: -250px; /* Adjust based on your sidebar width */
        }

        /* Card styling */
        .card {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            margin: 0 auto; /* Center the card */
            padding: 20px;
        }

        /* Form input styling */
        .food-form .form-control {
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 10px;
            font-size: 16px;
        }

        /* Form labels */
        .food-form .form-label {
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
            font-size: 14px;
        }

        /* Button styling */
        .food-form button {
            background: #007bff;
            color: white;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .food-form button:hover {
            background: #0056b3;
        }

        /* Title Styling */
        .text-primary {
            color:rgb(249, 251, 252);
            font-size: 1.5rem;
            text-align: center;
        }
        .custom-btn {
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .custom-btn:hover {
            background-color: #007bff;
            color: white;
        }

        /* Add Food Button Custom Style */
        #addFoodBtn {
            font-size: 16px;
            padding: 12px 25px;
            border-radius: 8px;
            background-color: #28a745;
            color: white;
            transition: background-color 0.3s ease;
        }

        #addFoodBtn:hover {
            background-color: #218838;
        }

        /* Edit Button Custom Style */
        .btn-sm.custom-btn {
            font-size: 14px;
            padding: 6px 12px;
            border-radius: 6px;
        }

        .btn-sm.custom-btn:hover {
            background-color: #0056b3;
            color: white;
        }
        .close-icon {
                    font-size: 1.5rem;
                    cursor: pointer;
                    color: #dc3545; /* Bootstrap danger color */
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
        }
    </style>
</head>
<body>>
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
                <a href="notificationView.php">Notifications</a>
            </nav>
        </aside>

    <!-- Main content -->
    <div class="content">
     <!-- Add Food Button -->
     <div class="d-flex justify-content-end mb-3">
            <button id="addFoodBtn" class="btn btn-success">
                Add Food Item
            </button>
        </div>

<!-- Food Form -->
<div class="card mt-3" id="foodFormCard" style="display: none;">
    <div class="card-body">
        <!-- Close Icon -->
        <span id="closeFormIcon" class="close-icon position-absolute top-0 end-0 m-2" onclick="closePage()">&times;</span>

        <h4 class="text-primary">
            <?php echo isset($edit_food) && !empty($edit_food) ? "Edit Food Item" : "Add Food Item"; ?>
        </h4>
        <form action="" method="post" enctype="multipart/form-data" class="food-form">
            <!-- Hidden food ID for editing -->
            <?php if (isset($edit_food) && !empty($edit_food)): ?>
                <input type="hidden" name="food_id" value="<?php echo $edit_food['id']; ?>">
            <?php endif; ?>

            <!-- Food Name Field -->
            <div class="form-group">
                <label for="food_name" class="form-label">Food Name</label>
                <input type="text" id="food_name" name="food_name" class="form-control"
                       value="<?php echo isset($edit_food['name']) ? $edit_food['name'] : ''; ?>" required>
            </div>

            <!-- Food Price Field -->
            <div class="form-group">
                <label for="food_price" class="form-label">Price</label>
                <input type="number" id="food_price" name="food_price" class="form-control"
                       value="<?php echo isset($edit_food['price']) ? $edit_food['price'] : ''; ?>" required>
            </div>

            <!-- Food Description Field -->
            <div class="form-group">
                <label for="food_description" class="form-label">Description</label>
                <textarea id="food_description" name="food_description" class="form-control"
                          required><?php echo isset($edit_food['food_description']) ? $edit_food['food_description'] : ''; ?></textarea>
            </div>

            <!-- Category Dropdown -->
            <div class="form-group">
                <label for="food_category" class="form-label">Category</label>
                <select id="food_category" name="food_cat" class="form-control" required>
                    <option value="">Select Category</option>
                    <option value="Offers" <?php echo isset($edit_food['category']) && $edit_food['category'] == 'Offers' ? 'selected' : ''; ?>>Offers</option>
                    <option value="Our Special" <?php echo isset($edit_food['category']) && $edit_food['category'] == 'Our Special' ? 'selected' : ''; ?>>Our Special</option>
                </select>
            </div>

            <!-- Image Upload -->
            <div class="form-group">
                <label for="food_image" class="form-label">Image</label>
                <input type="file" id="food_image" name="food_image" class="form-control" onchange="previewImage(event)">
                
                <!-- Image Preview Section -->
                <div id="image_preview" style="display: none;">
                    <img id="preview_img" src="" alt="Image Preview" class="img-thumbnail mt-2" width="150">
                    <button type="button" class="btn btn-danger mt-2" onclick="clearImage()">Clear Image</button>
                </div>

                <!-- Existing Image (if editing an existing food item) -->
                <?php if (isset($edit_food['image']) && !empty($edit_food['image'])): ?>
                    <img src="<?php echo $edit_food['image']; ?>" alt="Food Image" class="img-thumbnail mt-2" width="150">
                <?php endif; ?>
            </div>

            <!-- Submit Button -->
            <button type="submit" name="<?php echo isset($edit_food) && !empty($edit_food) ? 'update_food' : 'add_food'; ?>"
                    class="btn btn-primary">
                <?php echo isset($edit_food) && !empty($edit_food) ? "Update Food" : "Add Food"; ?>
            </button>
        </form>
    </div>
</div>


        <!-- Food Items Table -->
        <table class="table table-bordered table-hover mt-3">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['category']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['food_description']; ?></td>
                        <td><img src="<?php echo $row['image']; ?>" alt="Food Image" width="100"></td>
                        <td>
                            <!-- Edit button opens the form and passes the food_id in the URL -->
                            <a href="?edit=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary"
                               id="editBtn" data-id="<?php echo $row['id']; ?>">Edit</a>
                            <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger"
                               onclick="return confirm('Are you sure?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">No food items found.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const addFoodBtn = document.getElementById('addFoodBtn');
            const foodFormCard = document.getElementById('foodFormCard');
            const editBtns = document.querySelectorAll('#editBtn');
            const foodForm = document.querySelector('.food-form');
            

            // Reset the form fields
            function resetForm() {
                foodForm.reset();
                foodForm.querySelectorAll('input, textarea').forEach((field) => {
                    field.value = ''; // Reset value
    
                });
            }
            // Function to clear the image preview and reset the input
            function clearImage() {
                    // Clear the file input and reset the preview
                    document.getElementById('food_image').value = "";  // Clear the file input
                    document.getElementById('image_preview').style.display = 'none';  // Hide the preview div
                    document.getElementById('preview_img').src = "";  // Reset the image source
            }
                            

            // Show the food form for adding a new item
            addFoodBtn.addEventListener('click', () => {
                resetForm(); // Clear form fields
                foodFormCard.style.display = 'block'; // Show form
                const url = new URL(window.location);
                url.searchParams.delete('edit'); // Remove edit param if present
                history.pushState({}, '', url); // Update the URL
            });

            // Handle "Edit" button clicks
            editBtns.forEach((btn) => {
                btn.addEventListener('click', (event) => {
                    const foodId = event.target.getAttribute('data-id');
                    const url = new URL(window.location);
                    url.searchParams.set('edit', foodId); // Add the edit parameter
                    window.location.href = url.toString(); // Reload page with edit param
                });
            });
            function closePage() {
            window.history.back(); // Close or navigate back to the previous page
            }


            // Automatically show the form when editing
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('edit')) {
                foodFormCard.style.display = 'block'; // Show form
            }
        });
    </script>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>