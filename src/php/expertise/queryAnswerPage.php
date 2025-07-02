<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="./../../../favicon.ico" type="image/x-icon">
    
    <title>Expertise Query Answering Page - Project F4</title>
    <link rel="stylesheet" href="./../css/queryAnswerPage.css">
</head>

<body>
    <?php
    error_reporting(0);
    session_name('expertise');
    session_start();

    include_once './../../db/config.php';

    $query_id = $_GET['query_id'];
    // echo "quiry id:" . $query_id;
    $expert_id = $_SESSION['expertise_id'];
    // echo "expert id:" . $expert_id;

    $sqlForQuery = "SELECT * FROM `queries` WHERE id='$query_id';";
    $resultQuery = $conn->query($sqlForQuery);
    if ($row = $resultQuery->fetch_assoc()) {
    ?>
        <div class="container">
            <div class="ans-form">
                <p><b>Date Posted :</b> <?php echo $row['date_created']; ?></p>
                <p><b>Query :</b><?php echo $row['query_desc']; ?></p>
                <form method="post">
                    <label for="answer"><b>Answer:</b></label><br>
                    <textarea name="answer" id="answer" rows="17" placeholder="Type Your answer here..." required></textarea>
                    <button type="submit" name="answered">Submit Answer</button>
                    <button type="button" id="cancel" onclick="goBack()">Cancel</button>
                </form>
            </div>
        </div>
    <?php
    }

    if (isset($_POST['answered'])) {
        $answer = $_POST['answer'];
        $status = 'close';
        $current_date = date("d-m-Y");
        $sql2 = "INSERT INTO `response`(`query_id`, `expert_id`, `date_answered`, `responce_desc`) VALUES ('$query_id','$expert_id','$current_date','$answer');";
        $sql3 = "UPDATE `queries` SET `status`='$status' WHERE id='$query_id';";
        if ($conn->query($sql2) && $conn->query($sql3)) {
            echo "<script>alert('Answer recorded success');</script>";
            echo "<script>window.location.replace('expertise.php');</script>";
        }
    }
    ?>
    <script>
        function goBack() {
            window.location.replace('expertise.php');
        }
    </script>
</body>

</html>