<?php
session_name('admin');
session_start();
$table = $_GET['table'];
include_once './../../db/config.php';
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="./../../../favicon.ico" type="image/x-icon">

    <title>Inserting New Record - project F4</title>
    <link rel="stylesheet" href="./../css/adminPage.css">
</head>

<body>
    <div id="prev_img"></div>

    <h1 style="text-transform: capitalize;"><?php echo $table; ?></h1><hr>

    <div class="mid" align="center" style="margin: 1em;">
        <?php
        //inserting code
        if (isset($_SESSION['admin_id']) && isset($_POST['Crop-insert'])) {
            $name = $_POST['name'];
            $crop_desc = $_POST['crop_desc'];

            $file_name = $_FILES['img_src']['name'];
            $imgDest = './../../imgs/' . basename($file_name); // secure the file name

            $category_id = $_POST['category_id'];
            $best_location = $_POST['best_location'];
            $season = $_POST['season'];
            $soil = $_POST['soil'];

            // Move the uploaded image to the destination folder
            if (move_uploaded_file($_FILES['img_src']['tmp_name'], $imgDest)) {

                // Use prepared statements to prevent SQL injection
                $stmt = $conn->prepare("INSERT INTO `crop` (`name`, `crop_desc`, `img_src`, `category_id`, `best_location`, `season`, `soil`) VALUES (?, ?, ?, ?, ?, ?, ?)");

                if ($stmt === false) {
                    // Handle prepare error
                    die('Prepare failed: ' . htmlspecialchars($conn->error));
                }

                // Bind parameters (s = string, i = integer)
                $stmt->bind_param(
                    "sssssss",
                    $name,
                    $crop_desc,
                    $file_name,
                    $category_id,
                    $best_location,
                    $season,
                    $soil
                );

                // Execute the statement
                $success = $stmt->execute();

                if ($success) {
                    header('Location: adminPage.php?status=insertSuccess');
                    exit;
                } else {
                    header('Location: adminPage.php?status=insertNotSuccess');
                    exit;
                }
            } else {
                header('Location: adminPage.php?status=fileUploadError');
                exit;
            }
        }

        if (isset($_SESSION['admin_id']) && isset($_POST['Crop-category-insert'])) {
            $name = $_POST['name'];
            $category_desc = $_POST['category_desc'];

            // Sanitize filename to prevent directory traversal
            $file_name = basename($_FILES['img_src']['name']);
            $imgDest = './../../imgs/' . $file_name;

            // Move uploaded file to target directory
            if (move_uploaded_file($_FILES['img_src']['tmp_name'], $imgDest)) {

                // Secure SQL using prepared statement
                $stmt = $conn->prepare("INSERT INTO `crop_category`(`name`, `category_desc`, `img_src`) VALUES (?, ?, ?)");

                if (!$stmt) {
                    die("Prepare failed: " . htmlspecialchars($conn->error));
                }

                $stmt->bind_param("sss", $name, $category_desc, $file_name);
                $success = $stmt->execute();

                if ($success) {
                    header('Location: adminPage.php?status=insertSuccess');
                    exit;
                } else {
                    header('Location: adminPage.php?status=insertNotSuccess');
                    exit;
                }
            } else {
                header('Location: adminPage.php?status=fileUploadError');
                exit;
            }
        }

        if (isset($_SESSION['admin_id']) && isset($_POST['Farmers-insert'])) {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $pincode = $_POST['pincode'];
            $password = $_POST['password'];

            // ✅ Hash the password before storing
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // ✅ Use prepared statements to prevent SQL injection
            $stmt = $conn->prepare("INSERT INTO `farmers`(`name`, `phone`, `address`, `pincode`, `password`) VALUES (?, ?, ?, ?, ?)");

            if (!$stmt) {
                die("Prepare failed: " . htmlspecialchars($conn->error));
            }

            $stmt->bind_param("sssss", $name, $phone, $address, $pincode, $hashedPassword);
            $success = $stmt->execute();

            if ($success) {
                header('Location: adminPage.php?status=insertSuccess');
                exit;
            } else {
                header('Location: adminPage.php?status=insertNotSuccess');
                exit;
            }
        }

        if (isset($_SESSION['admin_id']) && isset($_POST['Expertise-insert'])) {
            $name     = $_POST['name'];
            $email    = $_POST['email'];
            $phone    = $_POST['phone'];
            $address  = $_POST['address'];
            $crop_id  = $_POST['crop_id'];
            $password = $_POST['password'];

            // ✅ Securely hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // ✅ Use prepared statement to avoid SQL injection
            $stmt = $conn->prepare("INSERT INTO `expertise` (`name`, `email`, `phone`, `address`, `crop_id`, `password`) VALUES (?, ?, ?, ?, ?, ?)");

            if (!$stmt) {
                die("Prepare failed: " . htmlspecialchars($conn->error));
            }

            $stmt->bind_param("ssssis", $name, $email, $phone, $address, $crop_id, $hashedPassword);
            $success = $stmt->execute();

            if ($success) {
                header('Location: adminPage.php?status=insertSuccess');
                exit;
            } else {
                header('Location: adminPage.php?status=insertNotSuccess');
                exit;
            }
        }

        if (isset($_SESSION['admin_id']) && isset($_POST['harvest_step-insert'])) {
            $step_no    = $_POST['step_no'];
            $step_name  = $_POST['step_name'];
            $step_desc  = $_POST['step_desc'];
            $crop_id    = $_POST['crop_id'];

            // Prevent directory traversal in the file name
            $file_name = basename($_FILES['img_src']['name']);
            $imgDest   = './../../imgs/' . $file_name;

            // Move uploaded file
            if (move_uploaded_file($_FILES['img_src']['tmp_name'], $imgDest)) {
                // Use prepared statements to prevent SQL injection
                $stmt = $conn->prepare("INSERT INTO `harvest_step`(`step_no`, `step_name`, `step_desc`, `img_src`, `crop_id`) VALUES (?, ?, ?, ?, ?)");

                if (!$stmt) {
                    die("Prepare failed: " . htmlspecialchars($conn->error));
                }

                // Bind parameters
                $stmt->bind_param("isssi", $step_no, $step_name, $step_desc, $file_name, $crop_id);
                $success = $stmt->execute();

                if ($success) {
                    header('Location: adminPage.php?status=insertSuccess');
                    exit;
                } else {
                    header('Location: adminPage.php?status=insertNotSuccess');
                    exit;
                }
            } else {
                header('Location: adminPage.php?status=fileUploadError');
                exit;
            }
        }

        if (isset($_SESSION['admin_id']) && isset($_POST['machinary-insert'])) {
            $name = $_POST['name'];
            $machine_desc = $_POST['machine_desc'];
            $crop_id = $_POST['crop_id'];

            // Sanitize filename to prevent directory traversal
            $file_name = basename($_FILES['img_src']['name']);
            $imgDest = './../imgs/' . $file_name;

            // Move uploaded file safely
            if (move_uploaded_file($_FILES['img_src']['tmp_name'], $imgDest)) {
                // Use prepared statements to prevent SQL injection
                $stmt = $conn->prepare("INSERT INTO `machinary` (`name`, `img_src`, `machine_desc`, `crop_id`) VALUES (?, ?, ?, ?)");

                if (!$stmt) {
                    die("Prepare failed: " . htmlspecialchars($conn->error));
                }

                $stmt->bind_param("sssi", $name, $file_name, $machine_desc, $crop_id);
                $success = $stmt->execute();

                if ($success) {
                    header('Location: adminPage.php?status=insertSuccess');
                    exit;
                } else {
                    header('Location: adminPage.php?status=insertNotSuccess');
                    exit;
                }
            } else {
                header('Location: adminPage.php?status=fileUploadError');
                exit;
            }
        }

        if (isset($_SESSION['admin_id']) && isset($_POST['pesticides-insert'])) {
            $name = $_POST['name'];
            $pesticide_desc = $_POST['pesticide_desc'];
            $diseases = $_POST['diseases'];
            $crop_id = $_POST['crop_id'];

            // Sanitize filename to prevent directory traversal attacks
            $file_name = basename($_FILES['img_src']['name']);
            $imgDest = './../../imgs/' . $file_name;

            if (move_uploaded_file($_FILES['img_src']['tmp_name'], $imgDest)) {
                // Use prepared statements for SQL injection protection
                $stmt = $conn->prepare("INSERT INTO `pesticides`(`name`, `pesticide_desc`, `img_src`, `diseases`, `crop_id`) VALUES (?, ?, ?, ?, ?)");

                if (!$stmt) {
                    die("Prepare failed: " . htmlspecialchars($conn->error));
                }

                $stmt->bind_param("ssssi", $name, $pesticide_desc, $file_name, $diseases, $crop_id);
                $success = $stmt->execute();

                if ($success) {
                    header('Location: adminPage.php?status=insertSuccess');
                    exit;
                } else {
                    header('Location: adminPage.php?status=insertNotSuccess');
                    exit;
                }
            } else {
                header('Location: adminPage.php?status=fileUploadError');
                exit;
            }
        }

        if (isset($_SESSION['admin_id']) && isset($_POST['fertilizer-insert'])) {
            $name = $_POST['name'];
            $fertilizer_desc = $_POST['fertilizer_desc'];
            $crop_id = $_POST['crop_id'];

            // Use basename() to prevent directory traversal in the filename
            $file_name = basename($_FILES['img_src']['name']);
            $imgDest = './../../imgs/' . $file_name;

            // Move the uploaded file
            if (move_uploaded_file($_FILES['img_src']['tmp_name'], $imgDest)) {
                // Use prepared statements to prevent SQL injection
                $stmt = $conn->prepare("INSERT INTO `fertilizer` (`name`, `fertilizer_desc`, `img_src`, `crop_id`) VALUES (?, ?, ?, ?)");

                if (!$stmt) {
                    die("Prepare failed: " . htmlspecialchars($conn->error));
                }

                $stmt->bind_param("sssi", $name, $fertilizer_desc, $file_name, $crop_id);
                $success = $stmt->execute();

                if ($success) {
                    header('Location: adminPage.php?status=insertSuccess');
                    exit;
                } else {
                    header('Location: adminPage.php?status=insertNotSuccess');
                    exit;
                }
            } else {
                header('Location: adminPage.php?status=fileUploadError');
                exit;
            }
        }

        // *************************************************************** //

        //inserting forms
        // crop insert tbale ...
        if ($table == 'crop') {
        ?>
            <form method="post" enctype="multipart/form-data" id="Form">
                <table border="1" cellspacing='0'>
                    <tr>
                        <th>name</th>
                        <td><input type="text" id="name" name="name" required></td>
                    </tr>
                    <tr>
                        <th>crop_desc</th>
                        <td><input type="text" id="crop_desc" name="crop_desc" required></td>
                    </tr>
                    <tr>
                        <th>img_src</th>
                        <td><input type="file" name="img_src" id="img_src" accept="image/*" onchange="previewProduct()"></td>
                    </tr>
                    <tr>
                        <th>category_id</th>
                        <td><?php
                            $sqlCropId = "SELECT `id`, `name` FROM `crop_category`;";
                            $resultCropId = $conn->query($sqlCropId);
                            if ($resultCropId->num_rows > 0) {
                            ?>
                                <select name="category_id" id="category_id" required>
                                    <option disabled selected value="">Select Crop-category</option>
                                    <?php
                                    while ($row = $resultCropId->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['id'] . " - " . $row['name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>best_location</th>
                        <td><input type="text" id="best_location" name="best_location" required></td>
                    </tr>
                    <tr>
                        <th>season</th>
                        <td><input type="text" id="season" name="season" required></td>
                    </tr>
                    <tr>
                        <th>soil</th>
                        <td><input type="text" id="soil" name="soil" required></td>
                    </tr>
                </table>
                <br>
                <input type="submit" name="Crop-insert" value="Crop-insert" class="btn">
            </form>
        <?php
        }

        // crop_category insert table ...
        if ($table == 'crop_category') {
        ?>
            <form method="post" enctype="multipart/form-data" id="Form">
                <table border="1" cellspacing='0'>
                    <tr>
                        <th>name</th>
                        <td><input type="text" id="name" name="name" required></td>
                    </tr>
                    <tr>
                        <th>category_desc</th>
                        <td><input type="text" id="category_desc" name="category_desc" required></td>
                    </tr>
                    <tr>
                        <th>img_src</th>
                        <td><input type="file" id="img_src" name="img_src" accept="image/*" required onchange="previewProduct()"></td>
                    </tr>
                </table>
                <br>
                <input type="submit" name="Crop-category-insert" value="Crop-category-insert" class="btn">
            </form>
        <?php
        }

        // farmers insert table...
        if ($table == 'farmers') {
        ?>
            <form method="post" onsubmit="return farmerResisterFormValid()" id="Form">
                <table border="1" cellspacing='0'>
                    <tr>
                        <th>name</th>
                        <td><input type="text" id="name" name="name" required></td>
                    </tr>
                    <tr>
                        <th>phone</th>
                        <td><input type="text" id="phone" name="phone" required></td>
                    </tr>
                    <tr>
                        <th>address</th>
                        <td><input type="text" id="address" name="address" required></td>
                    </tr>
                    <tr>
                        <th>pincode</th>
                        <td><input type="text" id="pincode" name="pincode" required></td>
                    </tr>
                    <tr>
                        <th>password</th>
                        <td><input type="text" id="password" name="password" required></td>
                    </tr>
                </table>
                <br>
                <input type="submit" name="Farmers-insert" value="Farmers-insert" class="btn">
            </form>
        <?php
        }

        // expertise insert table...
        if ($table == 'expertise') {
        ?>
            <form method="post" id="Form">
                <table border="1" cellspacing='0'>
                    <tr>
                        <th>name</th>
                        <td><input type="text" id="name" name="name" required></td>
                    </tr>
                    <tr>
                        <th>email</th>
                        <td><input type="email" id="email" name="email" required></td>
                    </tr>
                    <tr>
                        <th>phone</th>
                        <td><input type="text" id="phone" name="phone" required></td>
                    </tr>
                    <tr>
                        <th>address</th>
                        <td><input type="text" id="address" name="address" required></td>
                    </tr>
                    <tr>
                        <th>crop_id</th>
                        <td><?php
                            $sqlCropId = "SELECT `id`, `name` FROM `crop`;";
                            $resultCropId = $conn->query($sqlCropId);
                            if ($resultCropId->num_rows > 0) {
                            ?>
                                <select name="crop_id" id="crop_id" required>
                                    <option disabled selected value="">Select Crop</option>
                                    <?php
                                    while ($row = $resultCropId->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['id'] . " - " . $row['name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>password</th>
                        <td><input type="text" id="password" name="password" required></td>
                    </tr>
                </table>
                <br>
                <input type="submit" name="Expertise-insert" value="Expertise-insert" class="btn">
            </form>
        <?php
        }

        // harvest_step insert table ...
        if ($table == 'harvest_step') {
        ?>
            <form method="post" enctype="multipart/form-data" id="Form">
                <table border="1" cellspacing='0'>
                    <tr>
                        <th>step_no</th>
                        <td><input type="number" id="step_no" name="step_no" required></td>
                    </tr>
                    <tr>
                        <th>step_name</th>
                        <td><input type="text" id="step_name" name="step_name" required></td>
                    </tr>
                    <tr>
                        <th>step_desc</th>
                        <td><input type="text" id="step_desc" name="step_desc" required></td>
                    </tr>
                    <tr>
                        <th>img_src</th>
                        <td><input type="file" accept="image/*" name="img_src" id="img_src" required onchange="previewProduct()"></td>
                    </tr>
                    <tr>
                        <th>crop_id</th>
                        <td><?php
                            $sqlCropId = "SELECT `id`, `name` FROM `crop`;";
                            $resultCropId = $conn->query($sqlCropId);
                            if ($resultCropId->num_rows > 0) {
                            ?>
                                <select name="crop_id" id="crop_id" required>
                                    <option disabled selected value="">Select Crop</option>
                                    <?php
                                    while ($row = $resultCropId->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['id'] . " - " . $row['name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                </table>
                <br>
                <input type="submit" name="harvest_step-insert" value="harvest_step-insert" class="btn">
            </form>
        <?php
        }

        // machinary insert table ...
        if ($table == 'machinary') {
        ?>
            <form method="post" enctype="multipart/form-data" id="Form">
                <table border="1" cellspacing='0'>
                    <tr>
                        <th>name</th>
                        <td><input type="text" id="name" name="name" required></td>
                    </tr>
                    <tr>
                        <th>img_src</th>
                        <td><input type="file" name="img_src" id="img_src" accept="image/*" required onchange="previewProduct()"></td>
                    </tr>
                    <tr>
                        <th>machine_desc</th>
                        <td><input type="text" id="machine_desc" name="machine_desc" required></td>
                    </tr>
                    <tr>
                        <th>crop_id</th>
                        <td><?php
                            $sqlCropId = "SELECT `id`, `name` FROM `crop`;";
                            $resultCropId = $conn->query($sqlCropId);
                            if ($resultCropId->num_rows > 0) {
                            ?>
                                <select name="crop_id" id="crop_id" required>
                                    <option disabled selected value="">Select Crop</option>
                                    <?php
                                    while ($row = $resultCropId->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['id'] . " - " . $row['name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                </table>
                <br>
                <input type="submit" name="machinary-insert" value="machinary-insert" class="btn">
            </form>
        <?php
        }

        // pesticide insert table ...
        if ($table == 'pesticides') {
        ?>
            <form method="post" enctype="multipart/form-data" id="Form">
                <table border="1" cellspacing='0'>
                    <tr>
                        <th>name</th>
                        <td><input type="text" id="name" name="name" required></td>
                    </tr>
                    <tr>
                        <th>pesticide_desc</th>
                        <td><input type="text" id="pesticide_desc" name="pesticide_desc" required></td>
                    </tr>
                    <tr>
                        <th>img_src</th>
                        <td><input type="file" name="img_src" id="img_src" accept="image/*" required onchange="previewProduct()"></td>
                    </tr>
                    <tr>
                        <th>diseases</th>
                        <td><input type="text" id="diseases" name="diseases" required></td>
                    </tr>
                    <tr>
                        <th>crop_id</th>
                        <td><?php
                            $sqlCropId = "SELECT `id`, `name` FROM `crop`;";
                            $resultCropId = $conn->query($sqlCropId);
                            if ($resultCropId->num_rows > 0) {
                            ?>
                                <select name="crop_id" id="crop_id" required>
                                    <option disabled selected value="">Select Crop</option>
                                    <?php
                                    while ($row = $resultCropId->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['id'] . " - " . $row['name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                </table>
                <br>
                <input type="submit" name="pesticides-insert" value="pesticides-insert" class="btn">
            </form>
        <?php
        }

        // fertilizer insert table ...
        if ($table == 'fertilizer') {
        ?>
            <form method="post" enctype="multipart/form-data" id="Form">
                <table border="1" cellspacing='0'>
                    <tr>
                        <th>name</th>
                        <td><input type="text" id="name" name="name" required></td>
                    </tr>
                    <tr>
                        <th>fertilizer_desc</th>
                        <td><input type="text" id="fertilizer_desc" name="fertilizer_desc" required></td>
                    </tr>
                    <tr>
                        <th>img_src</th>
                        <td><input type="file" name="img_src" id="img_src" accept="image/*" required onchange="previewProduct()"></td>
                    </tr>
                    <tr>
                        <th>crop_id</th>
                        <td><?php
                            $sqlCropId = "SELECT `id`, `name` FROM `crop`;";
                            $resultCropId = $conn->query($sqlCropId);
                            if ($resultCropId->num_rows > 0) {
                            ?>
                                <select name="crop_id" id="crop_id" required>
                                    <option disabled selected value="">Select Crop</option>
                                    <?php
                                    while ($row = $resultCropId->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['id'] . " - " . $row['name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                </table>
                <br>
                <input type="submit" name="fertilizer-insert" value="fertilizer-insert" class="btn">
            </form>
        <?php
        }

        // queries insert table...
        if ($table == 'queries') {
            echo "<h2 style='color:green;'>Only Logged in farmers can enter query.</h2>";
        }

        // response insert table...
        if ($table == 'response') {
            echo "<h2 style='color:green;'>Only Corresponding Expert can enter respond to the query. After answered by expert you can update the answer. </h2>";
        }

        // feedback insert table...
        if ($table == 'feedback') {
            echo "<h2 style='color:green;'>It can be inserted by any of our website visitos . You can see the feedback and if you want to connect then you can connect through given phone number.</h2>";
        }
        ?>

        <br>
        <button style="padding: 5px 10px;" class="goBack btn" onclick="window.location.replace('./adminPage.php')">Go Back</button>

    </div>

    <script>
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
            if (phone.value.length !== 10) {
                alert("Phone number must contain 10 digits.");
                phone.focus();
                return false;
            }
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
            if (password.value.length < 6) {
                alert("Password must be contain more than 6 character.");
                password.focus();
                return false;
            }
            return true;
        }

        function previewProduct() {
            var imageInput = document.getElementById("img_src");
            var previewImage = document.getElementById("prev_img");
            if (imageInput.files && imageInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.style.backgroundImage = `url(${e.target.result})`;
                }
                reader.readAsDataURL(imageInput.files[0]);
            }
        }

        window.onload = function() {
            document.getElementById("Form").reset();
        };
    </script>

</body>

</html>