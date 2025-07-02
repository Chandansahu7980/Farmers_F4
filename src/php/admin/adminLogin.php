<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./../../../favicon.ico" type="image/x-icon">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        h1 {
            text-align: center;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 3px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        .home-btn {
            background-color: #007bff;
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 3px;
            display: inline-block;
            margin-top: 10px;
        }
        .home-btn:hover {
            background-color: #0056b3;
        }
        .home-btn a {
            color: white;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <?php
    error_reporting(0);
    ?>
    <h1>Admin Login</h1>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit" name="loginAdmin">Login</button>
        <button class="home-btn"><a href="./../">Home</a></button>
    </form>
    <?php

    if (isset($_POST['loginAdmin'])) {
        include_once './config.php';
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Query to check admin credentials
        if ($username === 'admin' && $password === '969696') {
            session_name('admin');
            session_start();
            $_SESSION['admin_id'] = 1; // Set a session variable to indicate admin login
            header("Location: adminPage.php"); // Redirect to admin page
            exit();
        } else {
            echo "<script>alert('Invalid username or password!');</script>";
        }
    }
    ?>
</body>

</html>

</body>

</html>