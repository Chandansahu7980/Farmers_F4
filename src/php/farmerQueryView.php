<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
    
    <title>Display Query and Answer - farmer- Project F4</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .query-view {
            background: #fff;
            padding: 1em;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        td:nth-child(3){
            width: 150px;
        }
        th {
            background-color:rgb(198, 198, 198);
        }

        button {
            cursor: pointer;
            background-color:rgb(163, 37, 37);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color:rgb(255, 0, 0);
        }
    </style>
</head>

<body>

    <div class="container">
        <?php
        error_reporting(0);
        include './../db/config.php';

        session_name('farmer');
        session_start();

        $farmer_id = $_SESSION['farmer_id'];
        // print_r($_SESSION);
        $farmer_name = $_SESSION['farmer_name'];
        echo "<h2>Hello $farmer_name ,</h2>";
        $sql = "SELECT * FROM `queries` WHERE farmer_id='$farmer_id';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        ?>
            <div class="query-view">
                <h1>Your Queries</h1>
                <hr><br>
                <table border="1" cellspacing="0">
                    <tr>
                        <th>Query</th>
                        <th>Answer</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $row['query_desc'] ?></td>
                            <td>
                                <?php
                                if ($row['status'] == 'open') {
                                    echo "<span style='color:red;'>Not answered</span>";
                                } else {
                                    $query_id = $row['id'];
                                    $sql2 = "SELECT * FROM `response` WHERE query_id='$query_id';";
                                    $result2 = $conn->query($sql2);
                                    $row2 = $result2->fetch_assoc();
                                    $ans = $row2['responce_desc'];
                                    echo "<span style='color:darkblue;'>$ans</span>";
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if ($row['status'] == 'open') {
                                ?>
                                    <form method="post">
                                        <button name="withdraw">Withdraw</button>
                                    </form>
                                <?php
                                    if (isset($_POST['withdraw'])) {
                                        $id = $row['id'];
                                        $sql3 = "DELETE FROM `queries` WHERE id='$query_id';";
                                        echo '<script>';
                                        echo '  window.location.href = "deleteQuery.php?id=' . $id . '";';
                                        echo '</script>';
                                    }
                                }else{
                                    echo "<p style='color:green';><b>Already Answered</b></p>";
                                }
                                ?>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<h2 style='color:gray'>You don't posted any Query. <br> Write us query to get more effective and specified answer from expertise.</h2>";
                }
                ?>
                </table>
            </div>
            <br>
            <hr>
            <button style="background: red;padding:.5em 1em; border-radius:.5em;" onclick="goBack()">Go Back</button>
    </div>
    
    <script>
        function goBack() {
            window.location.replace('index.php');
        }
    </script>

</body>

</html>