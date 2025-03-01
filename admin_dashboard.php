<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}
include 'config.php';

// Fetch admin details
$admin_id = $_SESSION['admin_id'];
$sql = "SELECT * FROM admins WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <nav>
        <ul>
            <li><a href="admin_dashboard.php">Dashboard</a></li>
            <li><a href="manage_candidates.php">Manage Candidates</a></li>
            <li><a href="manage_voters.php">Manage Voters</a></li>
            <li><a href="view_results.php">View Results</a></li>
            <li><a href="admin_reset_password.php">Reset Password</a></li>
            <li><a href="admin_logout.php">Logout</a></li>
        </ul>
    </nav>

    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($admin['username']); ?>!</h2>
        <p>Manage the voting system using the links above.</p>
    </div>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> @iscahkenya254. All Rights Reserved.</p>
    </footer>

</body>
</html>
