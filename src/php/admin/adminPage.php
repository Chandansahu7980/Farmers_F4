<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="./../../../favicon.ico" type="image/x-icon">

    <title>Admin Control Page - Project F4</title>

    <script src="https://kit.fontawesome.com/75d28f1837.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="./../css/adminPage.css">
</head>


<body>
    <?php
    error_reporting(0);
    session_name('admin');
    session_start();

    if ($_GET['status'] == 'insertSuccess') {
        echo "<script>alert('Insert success!');</script>";
        echo "<script>window.location.href = 'adminPage.php';</script>";
    }
    if ($_GET['status'] == 'insertNotSuccess') {
        echo "<script>alert('Insert Unsuccess!');</script>";
        echo "<script>window.location.href = 'adminPage.php';</script>";
    }
    if ($_GET['status'] == 'updateSuccess') {
        echo "<script>alert('update success!');</script>";
        echo "<script>window.location.href = 'adminPage.php';</script>";
    }
    if ($_GET['status'] == 'updateFailed') {
        echo "<script>alert('update failed!');</script>";
        echo "<script>window.location.href = 'adminPage.php';</script>";
    }
    if ($_GET['status'] == 'fileUploadError') {
        echo "<script>alert('File upload error occurred!');</script>";
        echo "<script>window.location.href = 'adminPage.php';</script>";
    }

    if (isset($_SESSION['admin_id']) && $_GET['logout'] == 'true') {
        session_destroy();
        echo "<script>alert('You have been logged out successfully!');</script>";
        echo "<script>window.location.href = 'adminLogin.php';</script>";
    }
    ?>

    <?php
    if (isset($_SESSION['admin_id'])) {
    ?>
        <div class="total-content">
            <div class="sidebar">
                <?php echo $myPhpVar; ?>
                <p> <span> <i class="fa-solid fa-user-pen"></i> </span> Hello Admin</p>
                <hr><br>
                <ul>
                    <li onclick="toggleList()">Tables <i id="icon" class="fa-sharp fa-solid fa-turn-down"></i></li>

                    <div id="tableList">
                        <li onclick="showTable('farmers')">FARMERS</li>
                        <li onclick="showTable('expertise')">EXPERTISE</li>
                        <li onclick="showTable('crop_category')">CROP CATEGORY</li>
                        <li onclick="showTable('crop')">CROP</li>
                        <li onclick="showTable('harvest_step')">HARVESTING STEPS</li>
                        <li onclick="showTable('pesticides')">PESTICIDES</li>
                        <li onclick="showTable('fertilizer')">FERTILIZER</li>
                        <li onclick="showTable('machinary')">MACHINARY</li>
                        <li onclick="showTable('queries')">QUERIES</li>
                        <li onclick="showTable('response')">RESPONSE</li>
                        <li onclick="showTable('feedback')">FEEDBACK</li>
                    </div>
                    <li>
                        <a style="all:inherit;padding:0;" href="./adminPage.php?logout=true"><i class="fa-solid fa-right-from-bracket"></i> LOGOUT</a>
                    </li>
                </ul>
            </div>

            <div class="content" id="tableContent">
                <div class="" style="margin: 2em; line-height:1.4em;font-size:larger">
                    <h1>Job Description: Website Administrator</h1>
                    <hr>
                    <br>
                    <h2>Responsibilities:</h2>
                    <hr><br>
                    <ul style="list-style-type:upper-roman;">
                        <li>Managing user accounts and permissions</li>
                        <li>Maintaining website security and protecting against threats</li>
                        <li>Creating and managing website content</li>
                        <li>Managing payment processing and transactions</li>
                        <li>Managing website community interactions and promoting positive engagement</li>
                        <li>Ensuring legal compliance with relevant regulations</li>
                        <li>Providing training and support to team members or volunteers</li>
                    </ul><br>
                    <h2>How to perform these tasks:</h2>
                    <hr><br>
                    <ul>
                        <li>To manage user accounts and permissions, go to the "User Accounts" page and use the provided tools to add, edit, or remove accounts as needed.</li>
                        <li>To maintain website security, regularly update security protocols and guidelines, and use tools such as firewalls or malware scanners to protect against threats.</li>
                        <li>To create and manage website content, use the content management system (CMS) provided on the site. Add new pages, posts, or products as needed, and edit or delete existing content as necessary.</li>
                        <li>To manage payment processing, use the payment gateway provided on the site and ensure that transactions are properly recorded and secure.</li>
                        <li>To manage website community interactions, use the provided moderation tools to address conflicts or inappropriate behavior, and promote positive engagement through community events or contests.</li>
                        <li>To ensure legal compliance, review relevant regulations and consult with legal experts as needed. Implement appropriate measures such as data protection policies or consumer protection guidelines.</li>
                        <li>To provide training and support to team members or volunteers, create documentation or resources such as manuals or video tutorials, and be available for questions or concerns as they arise.</li>
                    </ul>
                </div>
            </div>
        </div>
    <?php
    } else {
    ?>
        <div class="login-required" style="text-align: center; margin-top: 50px;">
            <h1>Login Required</h1>
            <p>You must be logged in as an admin to access this page.</p>
            <a href="./adminLogin.php" style="text-decoration: none; color: blue; font-weight: bold;font-size: larger; margin-top: 10px; display: inline-block;">Admin Login</a>
        </div>
    <?php
    }
    ?>


    <script>
        function showTable(tableName) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("tableContent").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "getTableContent.php?table=" + tableName, true);
            xhttp.send();
        }


        function toggleList() {
            var list = document.getElementById("tableList");
            var icon = document.getElementById("icon");

            if (list.style.display === "none") {
                list.style.display = "block";
                icon.setAttribute("class", "fa-sharp fa-solid fa-left-long");
            } else {
                list.style.display = "none";
                icon.setAttribute("class", "fa-solid fa-turn-down");
            }
        }
    </script>

</body>

</html>