<?php
session_start();
include 'config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php"); // Redirect if not logged in
    exit();
}

// Fetching election results
$results = $conn->query("SELECT candidates.name, candidates.position, COUNT(votes.candidate_id) AS vote_count FROM candidates LEFT JOIN votes ON candidates.id = votes.candidate_id GROUP BY candidates.id ORDER BY vote_count DESC");

$results = $conn->query("SELECT name, position, votes FROM candidates");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Results</title>
    <style>
        /* Reset default margin and padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* Navigation bar styling */
        nav {
            background-color: #222;
            padding: 15px;
        }

        nav ul {
            list-style-type: none;
            display: flex;
            justify-content: center;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            text-decoration: none;
            color: white;
            font-size: 16px;
            font-weight: bold;
            transition: 0.3s;
        }

        nav ul li a:hover {
            color: #ffcc00;
        }

        /* Container for election results */
        .container {
            width: 80%;
            margin: 30px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #444;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #ddd;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 15px;
            background-color: #222;
            color: white;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="admin_dashboard.php">Dashboard</a></li>
            <li><a href="manage_candidates.php">Manage Candidates</a></li>
            <li><a href="manage_voters.php">Manage Voters</a></li>
            <li><a href="admin_logout.php">Logout</a></li>
        </ul>
    </nav>
    
    <div class="container">
        <h2>Election Results</h2>
        <table>
            <tr><th>Candidate Name</th><th>Position</th><th>Votes</th></tr>
            <?php while ($row = $results->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['position']; ?></td>
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
