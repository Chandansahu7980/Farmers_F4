<?php
error_reporting(0);
session_name('admin');
session_start();

$table = $_GET['table'];
$id = $_GET['id'];

include_once './../../db/config.php';
$sql = "SELECT * FROM $table WHERE id='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$imgDest = $row['img_src'];
?>

<html>

<head>
    <title>Delete data page - project F4</title>

    <link rel="shortcut icon" href="./../../../favicon.ico" type="image/x-icon">

    <style>
        * {
            border: 0;
            outline: 0;
        }

        .form-middle {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translate(-50%, -0%);
        }

        .forms {
            display: flex;
            justify-content: start;
            flex-wrap: wrap;
        }

        input {
            padding: 10px;
            border-radius: 5px;
            margin-right: 100px;
            cursor: pointer;
        }

        #Cancel {
            background-color: red;
            color: white;
        }

        #Confirm {
            background-color: green;
            color: white;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_SESSION['admin_id'])) {
        if (isset($_POST['Confirm'])) {

            $sql2 = "DELETE FROM $table WHERE id = $id";
            if (file_exists("./../../imgs/" . $imgDest)) {
                unlink("./../../imgs/" . $imgDest);
            }
            if ($conn->query($sql2)) {
                echo "<script>alert('Delete success!');</script>";
                echo "<script>window.location.href = 'adminPage.php';</script>";
            }
            
        }
        if (isset($_POST['Cancel'])) {
            echo "<script>alert('Deletion Process Aborted!');</script>";
            echo "<script>window.location.href = 'adminPage.php';</script>";
        }
    ?>
        <div class="form-middle">
            <h3>Are you sure want to delete the record ?</h3>
            <br>
            <div class="forms">
                <form action="" method="post">
                    <input type="submit" value="Cancel" name="Cancel" id="Cancel">
                </form>
                <form action="" method="post">
                    <input type="submit" value="Confirm" name="Confirm" id="Confirm">
                </form>
            </div>

            <br>
            N.B: 1.On click "confirm " your data will be permanently deleted !
            <br>
            N.B: 2.Click "cancel " to go back without harming any data.
        </div>
    <?php
    } else {
        echo "<script>alert('You are not authorized to access this page!');</script>";
        echo "<script>window.location.href = 'adminPage.php';</script>";
    }
    ?>
</body>

</html>