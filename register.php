<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }

        .container {
            width: 350px;
            background: white;
            padding: 20px;
            margin: 100px auto;
            box-shadow: 0px 0px 10px gray;
            border-radius: 10px;
        }

        h2 {
            margin-bottom: 20px;
        }

        input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: green;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: darkgreen;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Student Registration</h2>
        <form id="registrationForm" action="process_register.php" method="POST">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("registrationForm").addEventListener("submit", function (event) {
                let name = document.querySelector('input[name="name"]').value.trim();
               
                let password = document.querySelector('input[name="password"]').value.trim();

                if (name === "" ||  password === "") {
                    alert("Please fill in all fields before registering.");
                    event.preventDefault();
                }
            });
        });
    </script>

</body>
</html>
