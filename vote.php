<?php
session_start();
include 'config.php';

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Check if user has already voted
$sql = "SELECT voted FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user['voted']) {
    echo "<p>You have already voted.</p>";
    exit();
}

// Fetch candidates
$candidates = $conn->query("SELECT * FROM candidates");

// Handle voting submission
if (isset($_POST['vote'])) {
    $candidate_id = $_POST['candidate'];
    
    if (!empty($candidate_id)) {
        // Update vote count
        $updateVote = $conn->prepare("UPDATE candidates SET votes = votes + 1 WHERE id = ?");
        $updateVote->bind_param("i", $candidate_id);
        $updateVote->execute();

        // Mark user as voted
        $markVoted = $conn->prepare("UPDATE users SET voted = 1 WHERE id = ?");
        $markVoted->bind_param("i", $user_id);
        $markVoted->execute();

        echo "<script>alert('Vote cast successfully!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Please select a candidate before voting!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote - Student Voting System</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    
    <div class="container">
        <h2>Vote for Your Candidate</h2>
        <form method="POST" action="">
            <?php while ($row = $candidates->fetch_assoc()): ?>
                <div class="candidate">
                    <img src="<?php echo $row['photo']; ?>" alt="<?php echo $row['name']; ?>" width="100">
                    <p><?php echo $row['name']; ?></p>
                    <input type="radio" name="candidate" value="<?php echo $row['id']; ?>" required>
                </div>
            <?php endwhile; ?>
            <button type="submit" name="vote">Submit Vote</button>
        </form>
    </div>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> @iscahkenya254. All Rights Reserved.</p>
    </footer>
</body>
</html>
