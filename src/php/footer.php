<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/footerStyle.css">
</head>

<body>
    <div class="footer-container">
        
        <div class="feedback-form">
        <img src="./../imgs/footer-logo.png" alt="" height="25%">
            <h2>Feedback/ Contact Form</h2><br>
            <form method="post" id="feedback-form">
                <input type="text" name="name" id="name" placeholder="Name" required><br>
                <input type="text" name="phone" id="phone" placeholder="Phone"><br>
                <textarea name="msg" id="msg" cols="30" rows="10" placeholder="Give any suggestion to improve us ..." required></textarea><br>
                <button name="feedback-btn">Submit</button>
            </form>
            <br><br>
            <hr>
        </div>

        <?php
        if (isset($_POST['feedback-btn'])) {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $msg = $_POST['msg'];
            include './config.php';
            $sqlFeedback = "INSERT INTO `feedback`(`name`, `phone`, `feedback_desc`) VALUES ('$name','$phone','$msg');";
            if ($conn->query($sqlFeedback)) {
                echo "<script>alert('Feedback submitted succes');</script>";
                echo "<script>location.replace('index.php');</script>";
            } else {
                echo "<script>location.replace('index.php');</script>";
            }
        }
        ?>

        <ul>
            <li><a href="./index.php">Home</a></li>
            <li><a href="#">About&nbsp;Us</a></li>
            <li><a href="#">Terms&nbsp;&&nbsp;Conditions</a></li>
            <li><a href="#">Contact&nbsp;Us</a></li>
            <li><a href="#">FAQ</a></li>
        </ul>
    </div>
</body>

</html>