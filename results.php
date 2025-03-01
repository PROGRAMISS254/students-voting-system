<?php
session_start();
include 'config.php';

// Fetch election results
$candidates = $conn->query("SELECT * FROM candidates ORDER BY votes DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Election Results - Student Voting System</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    
    <div class="container">
        <h2>Election Results</h2>
        <table>
            <tr>
                <th>Candidate</th>
                <th>Votes</th>
            </tr>
            <?php while ($row = $candidates->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['votes']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> @iscahkenya254. All Rights Reserved.</p>
    </footer>
</body>
</html>
