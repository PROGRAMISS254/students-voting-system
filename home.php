<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>voting system</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: url('background.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
        }
        header {
            background: rgba(0, 0, 0, 0.7);
            padding: 20px;
            text-align: center;
        }
        nav a {
            color: white;
            margin: 0 15px;
            text-decoration: none;
            font-weight: bold;
        }
        .slider {
            display: flex;
            overflow: hidden;
            position: relative;
            height: 300px;
        }
        .slides {
            display: flex;
            width: 400%;
            animation: slide 3600s infinite;
        }
        .slides img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }
        @keyframes slide {
            0% { transform: translateX(0); }
            25% { transform: translateX(-100%); }
            50% { transform: translateX(-200%); }
            75% { transform: translateX(-300%); }
            100% { transform: translateX(0); }
        }
        .content {
            padding: 20px;
            background: rgba(0, 0, 0, 0.5);
        }
        video {
            width: 100%;
            margin-top: 20px;
            border: 3px solid white;
        }
    </style>
</head>
<body>
    

    <header>
        <h1>Welcome to students electronic management system </h1><br><br>
        <nav>
        <ul>
            <li><a href="video.php">HOW TO VOTE</a></li>
            <li><a href="home.php">Home</a></li>
            <li><a href="index.php">Voter Login</a></li>
            <li><a href="admin_login.php">Admin Login</a></li>
        </ul>
    </nav>
      

        </nav>
    </header>

    <div class="slider">
        <div class="slides">
            <img src="slide1.jpg" alt="Milk Image 1">
            <img src="slide2.jpg" alt="Milk Image 2">
            <img src="slide3.jpg" alt="Milk Image 3">
            <img src="slide1a.jpg" alt="Milk Image 4">
        </div>
    </div>

   
    

    <div class="container">
        <h2>Welcome to the Student Electronic Voting System</h2>
        <p>Secure, Transparent, and Efficient Voting System</p>
        
        <a href="index.php" class="btn">Voter Login</a>
        <a href="admin_login.php" class="btn">Admin Login</a>
    </div>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> @iscahkenya254. All Rights Reserved.</p>
    </footer>
</body>
</html>
</body>
</html>
