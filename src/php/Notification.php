<?php
error_reporting(0);
session_name('farmer');
session_start();
// Load the Simple HTML DOM library
require_once('simple_html_dom.php');

// Fetch the HTML content of the website
$html = file_get_html('https://agri.odisha.gov.in/notifications/notification');

$table = $html->find('table', 0);
$table->removeAttribute('class');
$table->removeAttribute('style');
$table->removeAttribute('cellspacing');

foreach ($table->find('tr') as $row) {
    $th = $row->children(2);
    $th->remove();
}

foreach ($table->find('th') as $th) {
    $th->attr = array();
}

foreach ($table->find('td') as $td) {
    $td->attr = array();
}
foreach ($table->find('tr') as $td) {
    $link = $td->find('a', 0);
    if ($link) {
        // Get the existing href value
        $href = $link->href;

        // Update the href value with the base URL
        $base_url = 'https://agri.odisha.gov.in';
        $link->href = $base_url . $href;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="./../../favicon.ico" type="image/x-icon">

    <title>Notification For Farmer - Project F4</title>

    <style>
        .content-data {
            margin: 1em;
        }

        table {
            border-collapse: collapse;
            margin: 1.5em auto;
            font-size: 1.2em;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: .5em;
            overflow: hidden;
        }

        th,
        td {
            padding: .5em;
            text-align: center;
            color: #333;
        }

        td:nth-child(2) {
            text-align: left;
        }

        th {
            background-color: #8C56B4;
            color: #FFF;
            text-transform: uppercase;
            border-top: 3px solid #8C56B4;
        }

        tr {
            border-bottom: 1px solid #ccc;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        td a {
            color: #8C56B4;
            text-decoration: none;
        }

        td a:hover {
            color: #5A2F83;
        }

        .banner-1 {
            background: url(./../imgs/breadcrumb-banner-1.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 10em;
            width: 100%;
        }

        .goBack {
            cursor: pointer;
            border: 0;
            border-radius: .5em;
            position: fixed;
            top: 1em;
            right: 1em;
            background-color: rgba(144, 238, 144, 1);
            color: red;
            font-weight: 600;
            z-index: 5;
        }

        @media screen and (max-width: 768px) {
            .banner-1 {
                display: none;
            }

            .footer-data {
                display: none;
            }
        }
    </style>
</head>

<body>
    <button class="goBack" onclick="window.location.replace('index.php');">Go Back</button>
    <div class="banner-1">
    </div>
    <hr>
    <marquee behavior="" direction="" loop="">Hello Farmers ! Get All the update form Odisha Govornment about Farming from our website free and usefull. </marquee>
    <hr>
    <div class="content-data">
        <?php
        if (isset($_SESSION['farmer_id'])) {
            echo "<h2>Notifications for Farmer</h2>";
            echo $table->outertext;
            $html->clear();
        } else {
            echo "<h2 style='text-align: center;'>Please <a href='farmer-login.php'>Login</a> to view notifications.</h2>";
        }
        ?>
    </div>
    <center><a href="https://agri.odisha.gov.in/notifications/notification" target="_blank" rel="noopener noreferrer">View All Notifications</a></center><br>

    <div class="footer-data">
        <?php
        include './footer.php';
        ?>
    </div>
</body>

</html>