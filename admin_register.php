<?php
include 'config.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];

    $sql = "INSERT INTO admins (username, password) VALUES (?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        echo "<script>alert('Admin registered successfully!'); window.location='admin_login.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
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
    <script>
        function validateForm() {
            let username = document.getElementById("username").value;
            let email = document.getElementById("email").value;
            let password = document.getElementById("password").value;
            let errorMsg = document.getElementById("errorMsg");
            
            if (username.trim() === "" || email.trim() === "" || password.trim() === "") {
                errorMsg.innerHTML = "All fields are required.";
                return false;
            }
            
            if (password.length < 6) {
                errorMsg.innerHTML = "Password must be at least 6 characters long.";
                return false;
            }
            
            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Admin Registration</h2>
        <p id="errorMsg" class="error"></p>
        <form method="POST" action="" onsubmit="return validateForm()">
            <input type="text" id="username" name="username" placeholder="Username" required>
            <input type="email" id="email" name="email" placeholder="Email" required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <button type="submit" name="register">Register</button>
        </form>
    </div>
</body>
</html>
