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

    $expert_id = $_SESSION['expertise_id'];


    $sql1 = "SELECT * FROM `queries` WHERE id='$query_id';";
    $sql2 = "SELECT * FROM `response` WHERE query_id='$query_id';";
    $result1 = $conn->query($sql1);
    $result2 = $conn->query($sql2);
    $row1 = $result1->fetch_assoc();
    if ($row2 = $result2->fetch_assoc()) {
    ?>
        <div class="container">
            <div class="ans-form">
                <p><b>Date Posted :</b> <?php echo $row1['date_created']; ?></p>
                <p><b>Date Answered :</b> <?php echo $row2['date_answered']; ?></p>
                <p><b>Query :</b><?php echo $row1['query_desc']; ?></p>
                <b>Answer:</b><br>
                <textarea name="answer" id="answer" rows="17" readonly><?php echo $row2['responce_desc'] ?></textarea>
                <button type="button" id="cancel" onclick="goBack()">Go Back</button>
            </div>
        </div>
    <?php
    }
    ?>
    <script>
        function goBack() {
            window.location.replace('./expertise.php');
        }
    </script>
</body>

</html>