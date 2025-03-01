<?php
session_start();
include 'config.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php"); // Redirect if not logged in
    exit();
}

// Handling candidate addition
if (isset($_POST['add_candidate'])) {
    $name = $_POST['name'];
    $position = $_POST['position'];
    
    // Handling file upload
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
    
    // Check if candidate already exists
    $check_sql = "SELECT * FROM candidates WHERE name = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $name,);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo "<script>alert('Candidate already exists!'); window.location='manage_candidates.php';</script>";
    } else {
        $sql = "INSERT INTO candidates (name, position, photo) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $position, $target_file);
        $stmt->execute();
    }
}

// Handling candidate deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM candidates WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

// Fetching candidates
$candidates = $conn->query("SELECT * FROM candidates");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Candidates</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('background.jpg') no-repeat center center/cover;
            text-align: center;
            color: #fff;
        }
        .container {
            background: rgba(0, 0, 0, 0.7);
            padding: 20px;
            margin: 50px auto;
            width: 300px;
            border-radius: 10px;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
        }
        button {
            background: #28a745;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background: #218838;
        }
        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="admin_dashboard.php">Dashboard</a></li>
            <li><a href="manage_voters.php">Manage Voters</a></li>
            <li><a href="view_results.php">View Results</a></li>
            <li><a href="admin_logout.php">Logout</a></li>
        </ul>
    </nav>
    
    <div class="container">
        <h2>Manage Candidates</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Candidate Name" required>
            <input type="text" name="position" placeholder="Position" required>
            <input type="file" name="photo" accept="image/*" required>
            <button type="submit" name="add_candidate">Add Candidate</button>
        </form>
        
        <h3>Candidate List</h3>
        <table>
            <tr><th>Photo</th><th>Name</th><th>Position</th><th>Action</th></tr>
            <?php while ($row = $candidates->fetch_assoc()): ?>
                <tr>
                    <td><img src="<?php echo $row['photo']; ?>" width="50" height="50"></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['position']; ?></td>
                    <td><a href="?delete=<?php echo $row['id']; ?>">Delete</a></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> @iscahkenya254. All Rights Reserved.</p>
    </footer>
</body>
</html>
