<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['candidate'])) {
    $user_id = $_SESSION['user_id'];
    $candidate_id = $_POST['candidate'];

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

    // Record vote
    $conn->query("UPDATE candidates SET votes = votes + 1 WHERE id = $candidate_id");
    $conn->query("UPDATE users SET voted = 1 WHERE id = $user_id");

    echo "<p>Vote cast successfully! <a href='results.php'>View Results</a></p>";
    exit();
} else {
    echo "<p>Invalid request. <a href='vote.php'>Go back</a></p>";
    exit();
}
?>
