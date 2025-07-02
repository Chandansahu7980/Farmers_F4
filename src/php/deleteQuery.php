<?php
$id = $_GET['id'];
session_name('farmer');
session_start();
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Delete query page - project F4</title>

    <link rel="shortcut icon" href="./../../favicon.ico" type="image/x-icon">

    <style>
        * {
            border: 0;
            outline: 0;
        }

        .form-middle {
            text-align: center;
        }

        .forms {
            display: flex;
            justify-content: center;
        }

        input {
            padding: .5em;
            border-radius: .3em;
            margin: 0 7em;
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
    if (isset($_SESSION['farmer_id']) && isset($_POST['Confirm'])) {
        // echo "Confirm clicked";
        include_once './../db/config.php';

        $sql_img_src = $conn->query("SELECT img_src FROM queries WHERE id = $id");
        $img_src = $sql_img_src->fetch_assoc()['img_src'];

        if (file_exists("./../imgs/" . $img_src)) {
            unlink("./../imgs/" . $img_src);
        }

        $sql2 = "DELETE FROM `queries` WHERE id = $id";
        if ($conn->query($sql2)) {
            echo "<script>alert('Delete success!');</script>";
            echo "<script>window.location.href = 'farmerQueryView.php';</script>";
        }
    }
    if (isset($_POST['Cancel'])) {
        // echo "<script>alert('Deletion Process Aborted!');</script>";
        echo "<script>window.location.href = 'farmerQueryView.php';</script>";
    }
    ?>

    <?php
    if (!isset($_SESSION['farmer_id'])) {
        echo "<script>alert('You are not logged in!');</script>";
        echo "<script>window.location.href = 'farmer-login.php';</script>";
    } else {
    ?>
        <div class="form-middle">
            <h3>Are you sure want to delete the Query ?</h3>
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
            <b>N.B: </b>
            1.On click <span style="color:green;">" confirm "</span> your data will be permanently deleted !
            <br>
            2.Click <span style="color:red">" cancel "</span> to go back without deleting query.
        </div>
    <?php
    }
    ?>


</body>

</html>