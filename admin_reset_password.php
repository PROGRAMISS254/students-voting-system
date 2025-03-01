<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}
include 'config.php';

if (isset($_POST['reset'])) {
    $admin_id = $_SESSION['admin_id'];
    $current_password = $_POST['current_password'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    // Verify current password
    $sql = "SELECT password FROM admins WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    if ($admin && password_verify($current_password, $admin['password'])) {
        // Update password
        $update_sql = "UPDATE admins SET password = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("si", $new_password, $admin_id);
        $update_stmt->execute();
        $message = "Password updated successfully!";
    } else {
        $error = "Current password is incorrect!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <nav>
        <ul>
            <li><a href="admin_dashboard.php">Dashboard</a></li>
            <li><a href="admin_logout.php">Logout</a></li>
        </ul>
    </nav>

    <div class="container">
        <h2>Reset Password</h2>
        <?php if (isset($message)) echo "<p class='success'>$message</p>"; ?>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST" action="">
            <input type="password" name="current_password" placeholder="Current Password" required>
            <input type="password" name="new_password" placeholder="New Password" required>
            <button type="submit" name="reset">Update Password</button>
        </form>
    </div>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> @iscahkenya254. All Rights Reserved.</p>
    </footer>

</body>
</html>
