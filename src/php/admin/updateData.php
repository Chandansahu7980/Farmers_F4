<?php
// error_reporting(0);
session_name('admin');
session_start();
$id = $_GET['id'];
$table = $_GET['table'];



include_once './../../db/config.php';

$sql = "SELECT * FROM $table WHERE id='$id';";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="./../../../favicon.ico" type="image/x-icon">

    <title>Update Data Page - Project F4</title>
    <link rel="stylesheet" href="./../css/adminPage.css">
</head>

<body>
    <div id="prev_img"></div>
    <div class="mid" align="center" style="margin: 1em;">
        <h1><?php echo $table; ?></h1>

        <?php
        if (isset($_SESSION['admin_id']) && isset($_POST['Farmers-update']) && isset($_GET['id'])) {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $pincode = $_POST['pincode'];
            $password = $_POST['password'];

            if (!empty($password) && strlen($password) >= 6) {
                // ✅ Hash the password securely
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            } else {
                echo "<script>alert('Password must be at least 6 characters long to update.');</script>";
                $hashedPassword = $row['password']; // keep the existing password if not updated
            }

            // ✅ Use prepared statement to prevent SQL injection
            $stmt = $conn->prepare("UPDATE `farmers` SET `name` = ?, `phone` = ?, `address` = ?, `pincode` = ?, `password` = ? WHERE `id` = ?");

            if (!$stmt) {
                die("Prepare failed: " . htmlspecialchars($conn->error));
            }

            $stmt->bind_param("sssssi", $name, $phone, $address, $pincode, $hashedPassword, $id);
            $success = $stmt->execute();

            if ($success) {
                header('Location: adminPage.php?status=updateSuccess');
                exit();
            } else {
                header('Location: adminPage.php?status=updateFailed');
                exit();
            }
        }

        if (isset($_SESSION['admin_id']) && isset($_POST['Expertise-update']) && isset($_GET['id'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $crop_id = $_POST['crop_id'];
            $password = $_POST['password'];

            if (!empty($password) && strlen($password) >= 6) {
                // ✅ Hash the password securely
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            } else {
                echo "<script>alert('Password must be at least 6 characters long to update.');</script>";
                $hashedPassword = $row['password']; // keep the existing password if not updated
            }


            // ✅ Use prepared statement
            $stmt = $conn->prepare("UPDATE `expertise` SET `name` = ?, `email` = ?, `phone` = ?, `address` = ?, `crop_id` = ?, `password` = ? WHERE `id` = ?");

            if (!$stmt) {
                die("Prepare failed: " . htmlspecialchars($conn->error));
            }

            $stmt->bind_param("ssssisi", $name, $email, $phone, $address, $crop_id, $hashedPassword, $id);
            $success = $stmt->execute();

            if ($success) {
                header('Location: adminPage.php?status=updateSuccess');
                exit();
            } else {
                header('Location: adminPage.php?status=updateFailed');
                exit();
            }
        }

        if (isset($_SESSION['admin_id']) && isset($_POST['Crop-update']) && isset($_GET['id'])) {
            $name = $_POST['name'];
            $crop_desc = $_POST['crop_desc'];
            $category_id = $_POST['category_id'];
            $best_location = $_POST['best_location'];
            $season = $_POST['season'];
            $soil = $_POST['soil'];

            // Set the image path
            if ($_FILES['img_src']['error'] === 0) {
                $file_name = basename($_FILES['img_src']['name']);
                $imgDest = './../../imgs/' . $file_name;

                // Delete the old image if it exists
                if (!empty($_SESSION['oldImgSrc']) && file_exists("./../../imgs/" . $_SESSION['oldImgSrc'])) {
                    unlink("./../../imgs/" . $_SESSION['oldImgSrc']);
                }

                move_uploaded_file($_FILES['img_src']['tmp_name'], $imgDest);
            } else {
                $file_name = $_SESSION['oldImgSrc']; // use existing image if no new upload
            }

            // Use prepared statement
            $stmt = $conn->prepare("UPDATE `crop` SET `name` = ?, `crop_desc` = ?, `img_src` = ?, `category_id` = ?, `best_location` = ?, `season` = ?, `soil` = ? WHERE `id` = ?;");

            if (!$stmt) {
                die("Prepare failed: " . htmlspecialchars($conn->error));
            }

            $stmt->bind_param("sssisssi", $name, $crop_desc, $file_name, $category_id, $best_location, $season, $soil, $id);
            $success = $stmt->execute();

            if ($success) {
                header('Location: adminPage.php?status=updateSuccess');
                exit();
            } else {
                header('Location: adminPage.php?status=updateFailed');
                exit();
            }
        }

        if (isset($_SESSION['admin_id']) && isset($_POST['Crop-category-update']) && isset($_GET['id'])) {
            $name = $_POST['name'];
            $category_desc = $_POST['category_desc'];

            // Check if the file was uploaded without errors
            if ($_FILES['img_src']['error'] === 0) {
                $file_name = basename($_FILES['img_src']['name']);
                $imgDest = './../../imgs/' . $file_name;

                if (!empty($_SESSION['oldImgSrc']) && file_exists("./../../imgs/" . $_SESSION['oldImgSrc'])) {
                    unlink("./../../imgs/" . $_SESSION['oldImgSrc']);
                }

                move_uploaded_file($_FILES['img_src']['tmp_name'], $imgDest);
            } else {
                $file_name = $_SESSION['oldImgSrc'];
            }

            // Use prepared statement to prevent SQL injection
            $stmt = $conn->prepare("UPDATE `crop_category` SET `name` = ?, `category_desc` = ?, `img_src` = ? WHERE `id` = ?;");

            if (!$stmt) {
                die("Prepare failed: " . htmlspecialchars($conn->error));
            }

            $stmt->bind_param("sssi", $name, $category_desc, $file_name, $id);
            $success = $stmt->execute();

            if ($success) {
                header('Location: adminPage.php?status=updateSuccess');
                exit();
            } else {
                header('Location: adminPage.php?status=updateFailed');
                exit();
            }
        }

        if (isset($_SESSION['admin_id']) && isset($_POST['harvest_step-update']) && isset($_GET['id'])) {
            $step_no = $_POST['step_no'];
            $step_name = $_POST['step_name'];
            $step_desc = $_POST['step_desc'];
            $crop_id = $_POST['crop_id'];

            // Handle image upload
            if ($_FILES['img_src']['error'] === 0) {
                $file_name = basename($_FILES['img_src']['name']);
                $imgDest = './../../imgs/' . $file_name;

                if (!empty($_SESSION['oldImgSrc']) && file_exists("./../../imgs/" . $_SESSION['oldImgSrc'])) {
                    unlink("./../../imgs/" . $_SESSION['oldImgSrc']);
                }

                move_uploaded_file($_FILES['img_src']['tmp_name'], $imgDest);
            } else {
                $file_name = $_SESSION['oldImgSrc'];
            }

            // Use prepared statement to prevent SQL injection
            $stmt = $conn->prepare("UPDATE `harvest_step` SET `step_no` = ?, `step_name` = ?, `step_desc` = ?, `img_src` = ?, `crop_id` = ? WHERE `id` = ?;");

            if (!$stmt) {
                die("Prepare failed: " . htmlspecialchars($conn->error));
            }

            $stmt->bind_param("isssii", $step_no, $step_name, $step_desc, $file_name, $crop_id, $id);
            $success = $stmt->execute();

            if ($success) {
                header('Location: adminPage.php?status=updateSuccess');
                exit();
            } else {
                header('Location: adminPage.php?status=updateFailed');
                exit();
            }
        }

        if (isset($_SESSION['admin_id']) && isset($_POST['machinary-update']) && isset($_GET['id'])) {
            $name = $_POST['name'];
            $machine_desc = $_POST['machine_desc'];
            $crop_id = $_POST['crop_id'];

            if ($_FILES['img_src']['error'] === 0) {
                $file_name = basename($_FILES['img_src']['name']);
                $imgDest = './../imgs/' . $file_name;

                if (!empty($_SESSION['oldImgSrc']) && file_exists("./../imgs/" . $_SESSION['oldImgSrc'])) {
                    unlink("./../imgs/" . $_SESSION['oldImgSrc']);
                }

                move_uploaded_file($_FILES['img_src']['tmp_name'], $imgDest);
            } else {
                $file_name = $_SESSION['oldImgSrc'];
            }

            // Prepare statement
            $stmt = $conn->prepare("UPDATE `machinary` SET `name` = ?, `img_src` = ?, `machine_desc` = ?, `crop_id` = ? WHERE `id` = ?;");

            if (!$stmt) {
                die("Prepare failed: " . htmlspecialchars($conn->error));
            }

            $stmt->bind_param("sssii", $name, $file_name, $machine_desc, $crop_id, $id);
            $success = $stmt->execute();

            if ($success) {
                header('Location: adminPage.php?status=updateSuccess');
                exit();
            } else {
                header('Location: adminPage.php?status=updateFailed');
                exit();
            }
        }

        if (isset($_SESSION['admin_id']) && isset($_POST['pesticides-update']) && isset($_GET['id'])) {
            $name = $_POST['name'];
            $pesticide_desc = $_POST['pesticide_desc'];
            $diseases = $_POST['diseases'];
            $crop_id = $_POST['crop_id'];

            if ($_FILES['img_src']['error'] === 0) {
                $file_name = basename($_FILES['img_src']['name']);
                $imgDest = './../../imgs/' . $file_name;

                if (!empty($_SESSION['oldImgSrc']) && file_exists("./../../imgs/" . $_SESSION['oldImgSrc'])) {
                    unlink("./../../imgs/" . $_SESSION['oldImgSrc']);
                }

                move_uploaded_file($_FILES['img_src']['tmp_name'], $imgDest);
            } else {
                $file_name = $_SESSION['oldImgSrc'];
            }

            // ✅ Use prepared statement
            $stmt = $conn->prepare("UPDATE `pesticides` SET `name` = ?, `pesticide_desc` = ?, `img_src` = ?, `diseases` = ?, `crop_id` = ? WHERE `id` = ?;");

            if (!$stmt) {
                die("Prepare failed: " . htmlspecialchars($conn->error));
            }

            $stmt->bind_param("ssssii", $name, $pesticide_desc, $file_name, $diseases, $crop_id, $id);
            $success = $stmt->execute();

            if ($success) {
                header('Location: adminPage.php?status=updateSuccess');
                exit();
            } else {
                header('Location: adminPage.php?status=updateFailed');
                exit();
            }
        }

        if (isset($_SESSION['admin_id']) && isset($_POST['fertilizer-update']) && isset($_GET['id'])) {
            $name = $_POST['name'];
            $fertilizer_desc = $_POST['fertilizer_desc'];
            $crop_id = $_POST['crop_id'];

            if ($_FILES['img_src']['error'] === 0) {
                $file_name = basename($_FILES['img_src']['name']); // prevent directory traversal
                $imgDest = './../../imgs/' . $file_name;

                if (!empty($_SESSION['oldImgSrc']) && file_exists("./../../imgs/" . $_SESSION['oldImgSrc'])) {
                    unlink("./../../imgs/" . $_SESSION['oldImgSrc']); // delete old image safely
                }
                move_uploaded_file($_FILES['img_src']['tmp_name'], $imgDest);
            } else {
                $file_name = $_SESSION['oldImgSrc']; // retain previous image if no new file
            }

            // Secure database update using prepared statement
            $stmt = $conn->prepare("UPDATE `fertilizer` SET `name` = ?, `fertilizer_desc` = ?, `img_src` = ?, `crop_id` = ? WHERE `id` = ?;");

            if (!$stmt) {
                die("Prepare failed: " . htmlspecialchars($conn->error));
            }

            $stmt->bind_param("sssii", $name, $fertilizer_desc, $file_name, $crop_id, $id);
            $success = $stmt->execute();

            if ($success) {
                header('Location: adminPage.php?status=updateSuccess');
                exit();
            } else {
                header('Location: adminPage.php?status=updateFailed');
                exit();
            }
        }

        if (isset($_SESSION['admin_id']) && isset($_POST['response-update']) && isset($_GET['id'])) {
            $responce_desc = $_POST['responce_desc'];

            // Use prepared statement to prevent SQL injection
            $stmt = $conn->prepare("UPDATE `response` SET `responce_desc` = ? WHERE `id` = ?");
            if (!$stmt) {
                die("Prepare failed: " . htmlspecialchars($conn->error));
            }

            $stmt->bind_param("si", $responce_desc, $id);
            $success = $stmt->execute();

            if ($success) {
                header('Location: adminPage.php?status=updateSuccess');
                exit();
            } else {
                header('Location: adminPage.php?status=updateFailed');
                exit();
            }
        }

        // farmer update table
        if ($table == 'farmers') {
        ?>
            <form method="post" onsubmit="return farmerResisterFormValid()" id="Form">
                <table border="1" cellspacing='0'>
                    <tr>
                        <th>name</th>
                        <td><input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required></td>
                    </tr>
                    <tr>
                        <th>phone</th>
                        <td><input type="text" id="phone" name="phone" value="<?php echo $row['phone']; ?>" required></td>
                    </tr>
                    <tr>
                        <th>address</th>
                        <td><input type="text" id="address" name="address" value="<?php echo $row['address']; ?>" required></td>
                    </tr>
                    <tr>
                        <th>pincode</th>
                        <td><input type="text" id="pincode" name="pincode" value="<?php echo $row['pincode']; ?>" required></td>
                    </tr>
                    <tr>
                        <th>password</th><span style="font-size: smaller;color: gray">N.B.:Keep password blank if you don't want to update the existing password</span>
                        <td><input type="text" id="password" name="password" value=""></td>
                    </tr>
                </table>
                <br>
                <input type="submit" name="Farmers-update" value="Farmers-update" class="btn">
            </form>
        <?php
        }

        // expertise update table
        if ($table == 'expertise') {
        ?>
            <form method="post" id="Form">
                <table border="1" cellspacing='0'>
                    <tr>
                        <th>name</th>
                        <td><input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required></td>
                    </tr>
                    <tr>
                        <th>email</th>
                        <td><input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required></td>
                    </tr>
                    <tr>
                        <th>phone</th>
                        <td><input type="text" id="phone" name="phone" value="<?php echo $row['phone']; ?>" required></td>
                    </tr>
                    <tr>
                        <th>address</th>
                        <td><input type="text" id="address" name="address" value="<?php echo $row['address']; ?>" required></td>
                    </tr>
                    <tr>
                        <th>crop_id</th>
                        <td><?php
                            $sqlCropId = "SELECT `id`, `name` FROM `crop`;";
                            $resultCropId = $conn->query($sqlCropId);
                            if ($resultCropId->num_rows > 0) {
                            ?>
                                <select name="crop_id" id="crop_id" required>
                                    <option selected value="<?php echo $row['crop_id']; ?>"><?php echo $row['crop_id']; ?></option>
                                    <?php
                                    while ($row2 = $resultCropId->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $row2['id']; ?>"><?php echo $row2['id'] . " - " . $row2['name']; ?></option>
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
                        <th>password</th><span style="font-size: smaller;color: gray">N.B.:Keep password blank if you don't want to update the existing password</span>
                        <td><input type="text" id="password" name="password"></td>
                    </tr>
                </table>
                <br>
                <input type="submit" name="Expertise-update" value="Expertise-update" class="btn">
            </form>
        <?php
        }

        // CROP update table
        if ($table == 'crop') {
        ?>
            <form method="post" enctype="multipart/form-data" id="Form">
                <table border="1" cellspacing='0'>
                    <tr>
                        <th>name</th>
                        <td><input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required></td>
                    </tr>
                    <tr>
                        <th>crop_desc</th>
                        <td><input type="text" id="crop_desc" name="crop_desc" value="<?php echo $row['crop_desc']; ?>" required></td>
                    </tr>
                    <tr>
                        <th>img_src</th>
                        <?php
                        $_SESSION['oldImgSrc'] = $row['img_src'];
                        ?>
                        <td><input type="file" name="img_src" id="img_src" accept="image/*" onchange="previewProduct()"></td>
                    </tr>
                    <tr>
                        <th>category_id</th>
                        <td>
                            <?php
                            $sqlCropId = "SELECT `id`, `name` FROM `crop_category`;";
                            $resultCropId = $conn->query($sqlCropId);
                            if ($resultCropId->num_rows > 0) {
                            ?>
                                <select name="category_id" id="category_id" required>
                                    <option value="<?php echo $row['category_id'] ?>"><?php echo $row['category_id']; ?></option>
                                    <?php
                                    while ($row3 = $resultCropId->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $row3['id']; ?>"><?php echo $row3['id'] . " - " . $row3['name']; ?></option>
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
                        <td><input type="text" id="best_location" name="best_location" value="<?php echo $row['best_location']; ?>" required></td>
                    </tr>
                    <tr>
                        <th>season</th>
                        <td><input type="text" id="season" name="season" value="<?php echo $row['season']; ?>" required></td>
                    </tr>
                    <tr>
                        <th>soil</th>
                        <td><input type="text" id="soil" name="soil" value="<?php echo $row['soil']; ?>" required></td>
                    </tr>
                </table>
                <br>
                <input type="submit" name="Crop-update" value="Crop-update" class="btn">
            </form>
        <?php
        }

        // crop category update table
        if ($table == 'crop_category') {
        ?>
            <form method="post" enctype="multipart/form-data" id="Form">
                <table border="1" cellspacing='0'>
                    <tr>
                        <th>name</th>
                        <td><input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required></td>
                    </tr>
                    <tr>
                        <th>category_desc</th>
                        <td><input type="text" id="category_desc" name="category_desc" value="<?php echo $row['category_desc']; ?>" required></td>
                    </tr>
                    <tr>
                        <th>img_src</th>
                        <?php
                        $_SESSION['oldImgSrc'] = $row['img_src'];
                        ?>
                        <td><input type="file" accept="image/*" id="img_src" name="img_src" onchange="previewProduct()"></td>
                    </tr>
                </table>
                <br>
                <input type="submit" name="Crop-category-update" value="Crop-category-update" class="btn">
            </form>
        <?php
        }

        // harvest_step update table
        if ($table == 'harvest_step') {
        ?>
            <form method="post" enctype="multipart/form-data" id="Form">
                <table border="1" cellspacing='0'>
                    <tr>
                        <th>step_no</th>
                        <td><input type="number" id="step_no" name="step_no" value="<?php echo $row['step_no']; ?>" required></td>
                    </tr>
                    <tr>
                        <th>step_name</th>
                        <td><input type="text" id="step_name" name="step_name" value="<?php echo $row['step_name']; ?>" required></td>
                    </tr>
                    <tr>
                        <th>step_desc</th>
                        <td><input type="text" id="step_desc" name="step_desc" value="<?php echo $row['step_desc']; ?>" required></td>
                    </tr>
                    <tr>
                        <th>img_src</th>
                        <?php
                        $_SESSION['oldImgSrc'] = $row['img_src'];
                        ?>
                        <td><input type="file" accept="image/*" id="img_src" name="img_src" onchange="previewProduct()"></td>
                    </tr>
                    <tr>
                        <th>crop_id</th>
                        <td><?php
                            $sqlCropId = "SELECT `id`, `name` FROM `crop`;";
                            $resultCropId = $conn->query($sqlCropId);
                            if ($resultCropId->num_rows > 0) {
                            ?>
                                <select name="crop_id" id="crop_id" required>
                                    <option selected value="<?php echo $row['crop_id'] ?>"><?php echo $row['crop_id']; ?></option>
                                    <?php
                                    while ($row3 = $resultCropId->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $row3['id']; ?>"><?php echo $row3['id'] . " - " . $row3['name']; ?></option>
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
                <input type="submit" name="harvest_step-update" value="harvest_step-update" class="btn">
            </form>
        <?php
        }

        // machinary update table
        if ($table == 'machinary') {
        ?>
            <form method="post" enctype="multipart/form-data" id="Form">
                <table border="1" cellspacing='0'>
                    <tr>
                        <th>name</th>
                        <td><input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required></td>
                    </tr>
                    <tr>
                        <th>img_src</th>
                        <?php
                        $_SESSION['oldImgSrc'] = $row['img_src'];
                        ?>
                        <td><input type="file" accept="image/*" id="img_src" name="img_src" onchange="previewProduct()"></td>
                    </tr>
                    <tr>
                        <th>machine_desc</th>
                        <td><input type="text" id="machine_desc" name="machine_desc" value="<?php echo $row['machine_desc']; ?>" required></td>
                    </tr>
                    <tr>
                        <th>crop_id</th>
                        <td>
                            <?php
                            $sqlCropId = "SELECT `id`, `name` FROM `crop`;";
                            $resultCropId = $conn->query($sqlCropId);
                            if ($resultCropId->num_rows > 0) {
                            ?>
                                <select name="crop_id" id="crop_id" required>
                                    <option disabled value="<?php echo $row['crop_id'] ?>">Select Crop</option>
                                    <?php
                                    while ($row3 = $resultCropId->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $row3['id']; ?>"><?php echo $row3['id'] . " - " . $row3['name']; ?></option>
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
                <input type="submit" name="machinary-update" value="machinary-update" class="btn">
            </form>
        <?php
        }

        // pesticides update table
        if ($table == 'pesticides') {
        ?>
            <form method="post" enctype="multipart/form-data" id="Form">
                <table border="1" cellspacing='0'>
                    <tr>
                        <th>name</th>
                        <td><input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required></td>
                    </tr>
                    <tr>
                        <th>pesticide_desc</th>
                        <td><input type="text" id="pesticide_desc" name="pesticide_desc" value="<?php echo $row['pesticide_desc']; ?>" required></td>
                    </tr>
                    <tr>
                        <th>img_src</th>
                        <?php
                        $_SESSION['oldImgSrc'] = $row['img_src'];
                        ?>
                        <td><input type="file" accept="image/*" id="img_src" name="img_src" onchange="previewProduct()"></td>
                    </tr>
                    <tr>
                        <th>diseases</th>
                        <td><input type="text" id="diseases" name="diseases" value="<?php echo $row['diseases']; ?>" required></td>
                    </tr>
                    <tr>
                        <th>crop_id</th>
                        <td><?php
                            $sqlCropId = "SELECT `id`, `name` FROM `crop`;";
                            $resultCropId = $conn->query($sqlCropId);
                            if ($resultCropId->num_rows > 0) {
                            ?>
                                <select name="crop_id" id="crop_id" required>
                                    <option selected value="<?php echo $row['crop_id'] ?>"><?php echo $row['crop_id']; ?></option>
                                    <?php
                                    while ($row3 = $resultCropId->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $row3['id']; ?>"><?php echo $row3['id'] . " - " . $row3['name']; ?></option>
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
                <input type="submit" name="pesticides-update" value="pesticides-update" class="btn">
            </form>
        <?php
        }

        // fertilizer update table
        if ($table == 'fertilizer') {
        ?>
            <form method="post" enctype="multipart/form-data" id="Form">
                <table border="1" cellspacing='0'>
                    <tr>
                        <th>name</th>
                        <td><input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required></td>
                    </tr>
                    <tr>
                        <th>fertilizer_desc</th>
                        <td><input type="text" id="fertilizer_desc" name="fertilizer_desc" value="<?php echo $row['fertilizer_desc']; ?>" required></td>
                    </tr>
                    <tr>
                        <th>img_src</th>
                        <?php
                        $_SESSION['oldImgSrc'] = $row['img_src'];
                        ?>
                        <td><input type="file" accept="image/*" id="img_src" name="img_src" onchange="previewProduct()"></td>
                    </tr>
                    <tr>
                        <th>crop_id</th>
                        <td><?php
                            $sqlCropId = "SELECT `id`, `name` FROM `crop`;";
                            $resultCropId = $conn->query($sqlCropId);
                            if ($resultCropId->num_rows > 0) {
                            ?>
                                <select name="crop_id" id="crop_id" required>
                                    <option selected value="<?php echo $row['crop_id']; ?>"><?php echo $row['crop_id']; ?></option>
                                    <?php
                                    while ($row3 = $resultCropId->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $row3['id']; ?>"><?php echo $row3['id'] . " - " . $row3['name']; ?></option>
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
                <input type="submit" name="fertilizer-update" value="fertilizer-update" class="btn">
            </form>
        <?php
        }

        // queries update table
        if ($table == 'queries') {
            echo "<h2 style='color:green'>You can't have rights to update the farmers query. But if is there any requirement then you can <span style='color:red'>delete</span> the query.</h2>";
        }

        // response update table
        if ($table == 'response') {
        ?>
            <form method="post" enctype="multipart/form-data" id="Form">
                <table border="1" cellspacing='0'>
                    <tr>
                        <th>responce_desc</th>
                        <td><input type="text" name="responce_desc" id="responce_desc" value="<?php echo $row['responce_desc'] ?>"></td>
                    </tr>
                </table>
                <br>
                <input type="submit" name="response-update" value="response-update" class="btn">
            </form>
        <?php
        }

        // feedback update table
        if ($table == 'feedback') {
            echo "<h2 style='color:green'>You can't have rights to update the visitors feedback. But if is there any requirement then you can <span style='color:red'>delete</span> the feedback.</h2>";
        }
        ?>
        <br>
        <button class="goBack btn" onclick="window.history.back();">Go Back</button>
    </div>


    <!-- SCRIPTING........... -->
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
            // if (password.value.length < 6) {
            //     alert("Password must be contain more than 6 character.");
            //     password.focus();
            //     return false;
            // }
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
    </script>
</body>

</html>