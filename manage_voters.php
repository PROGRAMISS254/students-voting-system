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

// Fetching registered voters
$voters = $conn->query("SELECT * FROM users ");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Voters</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="admin_dashboard.php">Dashboard</a></li>
            <li><a href="manage_candidates.php">Manage Candidates</a></li>
            <li><a href="view_results.php">View Results</a></li>
            <li><a href="admin_logout.php">Logout</a></li>
        </ul>
    </nav>
    
    <div class="container">
        <h2>Manage Voters</h2>
        <table>
            <tr><th>ID</th><th>Username</th><th>Email</th></tr>
            <?php while ($row = $voters->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                   
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> @iscahkenya254. All Rights Reserved.</p>
    </footer>
</body>
</html>
