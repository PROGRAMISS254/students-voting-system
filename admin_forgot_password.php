<?php
include 'config.php';

if (isset($_POST['reset'])) {
    $username = $_POST['username'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    $sql = "SELECT * FROM admins WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    if ($admin) {
        $update_sql = "UPDATE admins SET password = ? WHERE username = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ss", $new_password, $username);
        $update_stmt->execute();
        $message = "Password reset successfully!";
    } else {
        $error = "Admin not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <nav>
        <ul>
            <li><a href="admin_login.php">Back to Login</a></li>
        </ul>
    </nav>

    <div class="container">
        <h2>Forgot Password</h2>
        <?php if (isset($message)) echo "<p class='success'>$message</p>"; ?>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Enter Username" required>
            <input type="password" name="new_password" placeholder="New Password" required>
            <button type="submit" name="reset">Reset Password</button>
        </form>
    </div>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> @iscahkenya254. All Rights Reserved.</p>
    </footer>

</body>
</html>
