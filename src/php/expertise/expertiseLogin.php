<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expertise Login - Project F4</title>
    <link rel="shortcut icon" href="./../../../favicon.ico" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #f0f0f0, rgb(161, 161, 161));
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: auto;
            padding: 0;
        }

        .middle-container {
            display: flex;
            flex-direction: column;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            max-width: 100%;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"],
        input[type="password"],
        select {
            width: calc(100% - 16px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        select {
            width: 100%;
            text-transform: capitalize;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background: #5cb85c;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background: #4cae4c;
        }

        .cancel-btn {
            color: #d9534f;
            cursor: pointer;
        }

        .cancel-btn:hover {
            text-decoration: underline;
        }

        #expertise-login-form {
            display: block;
        }

        #expertise-register-form {
            display: none;
        }

        #register,
        #login {
            color: #007bff;
            cursor: pointer;
        }

        #register:hover,
        #login:hover {
            text-decoration: underline;
        }

        #expertise-login-form>input[type="text"],
        #expertise-login-form>input[type="password"],
        #expertise-register-form>input[type="email"] {
            float: right;
        }
    </style>
</head>

<body>
    <?php
    session_name('expertise');
    session_start();
    require_once './../../db/config.php';

    if (isset($_POST['register'])) {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $address = trim($_POST['address']);
        $crop_id = trim($_POST['crop_id']);
        $password = trim($_POST['password']);
        $confirm_password = trim($_POST['confirm_password']);

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert into database
        $sqlInsert = "INSERT INTO `expertise` (`name`, `email`, `phone`, `address`, `crop_id`, `password`) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sqlInsert);
        $stmt->bind_param("ssssss", $name, $email, $phone, $address, $crop_id, $hashed_password);
        if ($stmt->execute()) {
            echo "<script>alert('Registration successful!');</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }
    }

    if (isset($_POST['login'])) {
        $email = trim($_POST['email']);
        $Entered_password = trim($_POST['password']);

        echo "<script>console.log('Entered Email: $email Entered Password: $Entered_password');</script>";

        // Fetch user from database
        $sqlFetch = "SELECT * FROM `expertise` WHERE `email` = ?";
        $stmt = $conn->prepare($sqlFetch);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $storedHashedPassword = $row['password']; // hashed password from DB
            // ✅ Verify hashed password
            if (password_verify($Entered_password, $storedHashedPassword)) {
                // ✅ Password correct: set session and redirect
                $_SESSION['expertise_id'] = $row['id'];
                header('Location: expertise.php');
                exit();
            } else {
                echo "<script>alert('Incorrect password! Please try again.');</script>";
            }
        } else {
            echo "<script>alert('No account found with that email.');</script>";
        }
    }
    ?>
    <div class="middle-container">
        <h1>Welcome to the Expertise Login / Register</h1>
        <form action="" method="post" id="expertise-login-form">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required placeholder="Enter your email">
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required placeholder="Enter your password">
            <br>
            <input type="submit" value="Login" name="login">
            <p>Not registered? Click on <span id="register">Register</span><b> / </b><span class="cancel-btn" onclick="window.location.href = './../';"> Cancel</span>.</p>
        </form>
        <form class="register-form" method="post" id="expertise-register-form">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" placeholder="Name" required>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="Email" required>
            <label for="phone">Phone:</label>
            <input type="text" name="phone" id="phone" placeholder="Phone" required pattern="[0-9]{10}">
            <label for="address">Address:</label>
            <input type="text" name="address" id="address" placeholder="Address" required>
            <br>
            <?php
            $sqlCropId = "SELECT `id`, `name` FROM `crop`;";
            $resultCropId = $conn->query($sqlCropId);
            if ($resultCropId->num_rows > 0) {
            ?>
                <label for="crop_id">Crop:</label>
                <select name="crop_id" id="crop_id" required>
                    <option disabled selected value="">Select Crop</option>
                    <?php
                    while ($row = $resultCropId->fetch_assoc()) {
                    ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo  $row['name']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            <?php
            }
            ?>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
            <br>
            <input type="submit" value="Register" name="register">
            <p>Already registered? Click on <span id="login">Login</span><b> / </b><span class="cancel-btn" onclick="window.location.href = './../';"> Cancel</span>.</p>
        </form>
    </div>

    <script>
        document.getElementById("register").onclick = function() {
            if (document.getElementById("confirm_password").value !== document.getElementById("password").value) {
                alert("Confirm Password should match Password!");
                document.getElementById("confirm_password").focus();
                return;
            }
            document.getElementById("expertise-login-form").style.display = "none";
            document.getElementById("expertise-register-form").style.display = "block";
        };
        document.getElementById("login").onclick = function() {
            document.getElementById("expertise-login-form").style.display = "block";
            document.getElementById("expertise-register-form").style.display = "none";
        };
    </script>
</body>

</html>