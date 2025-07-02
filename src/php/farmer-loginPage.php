<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="./../../favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css"/>

    <title>Farmer Login / SignUp page</title>
    <link rel="stylesheet" href="./css/loginStyle.css"/>
</head>

<body>
    <div class="middle-continer">
        <div class="login-image" data-aos="fade-left" data-aos-duration="1500">

        </div>
        <div class="form" data-aos="zoom-in" data-aos-delay="800">
            <form class="login-form" method="post" id="farmer-login-form" onsubmit="return farmerLoginFormValid()">
                <h1>Login Form</h1>
                <input type="text" name="phone" id="phone" placeholder="Phone Number">
                <input type="password" name="password" id="password" placeholder="Password">
                <button type="submit" name="login">Login</button>
                <p>Not registered? Click on <span id="resister">Register</span><b> / </b><span class="cancel-btn" onclick="window.location.href = './';"> Cancel</span>.</p>
            </form>
            <form class="register-form" method="post" onsubmit="return farmerResisterFormValid()" id="farmer-register-form">
                <h1>Resister Form</h1>
                <input type="text" name="name" id="name" placeholder="Name" required>
                <input type="text" name="phone" id="phone" placeholder="Phone" required>
                <input type="text" name="address" id="address" placeholder="Address" required>
                <input type="text" name="pincode" id="pincode" placeholder="Pincode" required>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <button type="submit" name="register">Register</button>

                <p>Already registered? Click on <span id="login">Login</span><b> / </b><span class="cancel-btn" onclick="window.location.href = './';"> Cancel</span>.</p>
            </form>
        </div>
    </div>

    <?php
    error_reporting(0);
    session_name('farmer');
    session_start();

    include_once './../db/config.php';
    //login clicked event
    if (isset($_POST['login'])) {
        $enteredPhone = trim($_POST['phone']);
        $enteredPassword = $_POST['password'];

        // ✅ Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT id, name, password FROM farmers WHERE phone = ?");
        $stmt->bind_param("s", $enteredPhone);
        $stmt->execute();
        $result = $stmt->get_result();

        // ✅ Check if user exists
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $storedHashedPassword = $row['password']; // hashed password from DB
            // ✅ Verify hashed password
            if (password_verify($enteredPassword, $storedHashedPassword)) {
                // ✅ Password correct: set session and redirect
                $_SESSION['farmer_id'] = $row['id'];
                $_SESSION['farmer_name'] = $row['name'];
                header('Location: index.php');
                exit();
            } else {
                echo "<script>alert('Incorrect password! Please try again.');</script>";
            }
        } else {
            echo "<script>alert('No account found with that phone number.');</script>";
        }

        $stmt->close();
        $conn->close();
    }

    // register clicked event
    if (isset($_POST['register'])) {
        $name = trim($_POST['name']);
        $phone = trim($_POST['phone']);
        $address = trim($_POST['address']);
        $pincode = trim($_POST['pincode']);
        $password = $_POST['password'];

        // ✅ Step 1: Check if phone number already exists using prepared statement
        $stmt = $conn->prepare("SELECT id FROM farmers WHERE phone = ?");
        $stmt->bind_param("s", $phone);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "<script>alert('An account with this phone number already exists.');</script>";
        } else {
            // ✅ Step 2: Hash the password before storing it
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // ✅ Step 3: Insert using prepared statement
            $stmt = $conn->prepare("INSERT INTO farmers (name, phone, address, pincode, password) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $name, $phone, $address, $pincode, $hashed_password);

            if ($stmt->execute()) {
                echo "<script>alert('Your account was created successfully.');</script>";
            } else {
                echo "<script>alert('Error creating account.');</script>";
            }
        }

        $stmt->close();
        $conn->close();
    }


    ?>

    <script>
        var loginForm = document.getElementById('farmer-login-form');
        var registerForm = document.getElementById('farmer-register-form');
        var resBtn = document.getElementById("resister");
        var loginBtn = document.getElementById("login");

        resBtn.addEventListener('click', () => {
            loginForm.style.display = 'none';
            registerForm.style.display = 'block';
        });

        loginBtn.addEventListener('click', () => {
            registerForm.style.display = 'none';
            loginForm.style.display = 'block';
        });

        //Register form validation
        function farmerResisterFormValid() {
            var name = document.getElementById("name");
            var phone = document.getElementById("phone");
            var address = document.getElementById("address");
            var pin = document.getElementById("pincode");
            var password = document.getElementById("password");

            if (!isNaN(name.value)) {
                alert("Error in Name");
                name.focus();
                return false;
            }
            if (isNaN(phone.value)) {
                alert("Enter correct phone number.");
                phone.focus();
                return false;
            }
            // if (phone.value.length !== 10) {
            //     alert("Phone number must contain 10 digits.");
            //     phone.focus();
            //     return false;
            // }
            if (!isNaN(address.value)) {
                alert("Error in Address");
                address.focus();
                return false;
            }
            if (isNaN(pin.value) || pin.value.length !== 6) {
                alert("Please Provide Currect Pincode");
                pin.focus();
                return false;
            }
            // if (password.value.length < 6) {
            //     alert("Password must be contain more than 6 character.");
            //     password.focus();
            //     return false;
            // }
            return true;
        }

        //Login form validation
        function farmerLoginFormValid() {
            var phone = document.getElementById("phone");
            var password = document.getElementById("password");
            if (isNaN(phone.value) || phone.value.length !== 10) {
                alert("Phone number must contain 10 digits.");
                phone.focus();
                return false;
            }
            if (password.value.length < 6) {
                alert("Password must be contain more than 6 character.");
                password.focus();
                return false;
            }
            return true;
        }

        window.onload = function() {
            document.getElementById("farmer-login-form").reset();
            document.getElementById("farmer-register-form").reset();
        };
    </script>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            offset: 300,
            duration: 1000,
            easing: 'ease-in-out'
        });
        AOS.init({
            disable: function() {
                var maxWidth = 768;
                return window.innerWidth < maxWidth;
            }
        });
    </script>
</body>

</html>