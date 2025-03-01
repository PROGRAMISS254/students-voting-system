<?php
// Database connection
$host = "localhost";  // Change if needed
$user = "root";       // Change if needed
$password = "";       // Change if needed
$database = "voting_system"; // Change to your database name

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
   
    $password = trim($_POST["password"]);

    // Validate inputs
    if (empty($name) || empty($password)) {
        echo "<script>alert('All fields are required!'); window.location.href='register.php';</script>";
        exit();
    }

  
 

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into database
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $hashedPassword);

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Something went wrong. Please try again!'); window.location.href='register.php';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
