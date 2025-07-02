<?php
error_reporting(0);
$crop_id = $_GET['crop_id'];
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="./../../favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <title>Crop Details View - Project 4</title>
    <link rel="stylesheet" href="./css/cropDetails.css">

</head>

<body>
    <button class="goBack" onclick="window.location.replace('./');">Go Back</button>
    <?php
    include './../db/config.php';
    $sql = "SELECT * FROM `crop` WHERE id='$crop_id';";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // print_r($row);
    }
    ?>
    <!-- Heading with crop name and bg image -->
    <div class="heading" style="background-image:linear-gradient(rgba(0, 0, 0, 0.552), rgba(0, 0, 0, 0.516)),url('<?php echo "./../imgs/".$row['img_src']; ?>');" data-aos="zoom-out" data-aos-duration="2000">
        <h1 data-aos="flip-up" data-aos-delay="700" data-aos-duration="2000"><?php echo $row['name']; ?></h1>
        <!-- Navigation bar with containing buttons for all content -->
        <div class="nav" data-aos="zoom-in" data-aos-delay="1300">
            <ul>
                <li><button onclick="changeContent('basic')">basic</button>
                </li>
                <li><button onclick="changeContent('medicine')">Fertilizer & Pesticide</button>
                </li>
                <li><button onclick="changeContent('machine')">Machinary</button>
                </li>
            </ul>
        </div>
    </div>


    <!-- Basic information display division -->
    <div class="hide" id="basic"><br><br>
        <table cellspacing="0" border="1" class="details-table" data-aos="fade-up" data-aos-duration="2000">
            <tr>
                <td>Crop Name</td>
                <td><?php echo $row['name']; ?></td>
            </tr>
            <tr>
                <td>Crop Description</td>
                <td><?php echo $row['crop_desc']; ?></td>
            </tr>
            <tr>
                <td>Best Locations For harvesting</td>
                <td><?php echo $row['best_location']; ?></td>
            </tr>
            <tr>
                <td>Best Season For harvesting</td>
                <td><?php echo $row['season']; ?></td>
            </tr>
            <tr>
                <td>Best Soil For Harvestin</td>
                <td><?php echo $row['soil']; ?></td>
            </tr>
        </table><br><br>
        <h1 data-aos="fade-up" data-aos-duration="1000" data-aos-offset="130">Harvesting Steps
            <br><hr>
        </h1>
        <div class="step-container">
            <?php
            $sql2 = "SELECT * FROM `harvest_step` WHERE crop_id='$crop_id' ORDER BY step_no;";
            $result2 = $conn->query($sql2);
            if ($result2->num_rows > 0) {
                while ($row2 = $result2->fetch_assoc()) {
                    $bgImg = "./../imgs/".$row2['img_src'];
            ?>
                    <div class="each-step" data-aos="fade-up">
                        <h1 data-aos="flip-up">Step-<?php echo $row2['step_no'] ?> : <?php echo $row2['step_name'] ?></h1>
                        <div class="step-desc">
                            <div class="step-img" style="background-image: url('<?php echo $bgImg; ?>');" data-aos="fade-down" data-aos-delay="800"></div>
                            <div class="desc-para" data-aos="fade-right">
                                <p><?php echo $row2['step_desc'] ?></p>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }else{
                echo "No Data In DataBase";
            }
            ?>
            <br><hr><br>
        </div>
    </div>


    <!-- Fertilizer & Pesticide information display division -->
    <div class="hide" id="medicine">
        <h1>Fertilizers</h1><hr>
        <div class="step-container">
            <?php
            $sql2 = "SELECT * FROM `fertilizer` WHERE crop_id='$crop_id'";
            $result2 = $conn->query($sql2);
            if ($result2->num_rows > 0) {
                while ($row2 = $result2->fetch_assoc()) {
                    $bgImg = "./../imgs/".$row2['img_src'];
            ?>
                    <div class="each-step" data-aos="fade-up">
                        <h1 data-aos="flip-up"><?php echo $row2['name'] ?> </h1>
                        <div class="step-desc">
                            <div class="step-img" style="background-image: url('<?php echo $bgImg; ?>');" data-aos="fade-down" data-aos-delay="800"></div>
                            <div class="desc-para" data-aos="fade-right">
                                <p><?php echo $row2['fertilizer_desc'] ?></p>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }else{
                echo "No Data in DataBase";
            }
            ?>
        </div><br><hr>
        <h1 data-aos="fade-up" data-aos-duration="1000">Pesticides</h1><hr>
        <div class="step-container">
            <?php
            $sql2 = "SELECT * FROM `pesticides` WHERE crop_id='$crop_id'";
            $result2 = $conn->query($sql2);
            if ($result2->num_rows > 0) {
                while ($row2 = $result2->fetch_assoc()) {
                    $bgImg = "./../imgs/".$row2['img_src'];
            ?>
                    <div class="each-step" data-aos="fade-up">
                        <h1 data-aos="flip-up"><?php echo $row2['name'] ?> </h1>
                        <div class="step-desc">
                            <div class="step-img" style="background-image: url('<?php echo $bgImg; ?>');" data-aos="fade-down"></div>
                            <div class="desc-para" data-aos="fade-right">
                                <h2>Disease : <?php echo $row2['diseases']; ?></h2>
                                <p><?php echo $row2['pesticide_desc'] ?></p>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }else{
                echo "No Data in DataBase";
            }
            ?>

        <br><hr></div>
    </div>

    <!-- Machinary information display division -->
    <div class="hide" id="machine">
        <h1>Machinary</h1><br><hr>
        <div class="step-container">
            <?php
            $sql2 = "SELECT * FROM `machinary` WHERE crop_id='$crop_id'";
            $result2 = $conn->query($sql2);
            if ($result2->num_rows > 0) {
                while ($row2 = $result2->fetch_assoc()) {
                    $bgImg = "./../imgs/".$row2['img_src'];
            ?>
                    <div class="each-step">
                        <h1><?php echo $row2['name'] ?> </h1>
                        <div class="step-desc">
                            <div class="step-img" style="background-image: url('<?php echo $bgImg; ?>');"></div>
                            <div class="desc-para">
                                <p><?php echo $row2['machine_desc'] ?></p>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }else{
                echo "No Data in DataBase";
            }
            ?>
        </div>
        <br><hr>
    </div>

    <?php
    include './footer.php';
    ?>

    <script>
        function changeContent(pageName) {
            var allPage = document.getElementsByClassName("hide");
            for (let i = 0; i < allPage.length; i++) {
                allPage[i].style.display = "none";
            }
            document.getElementById(pageName).style.display = "block";
        }
    </script>


    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            offset: 180,
            duration: 1000,
            easing: 'ease-in-out'
        });
        AOS.init({
            disable: function() {
                var maxWidth = 768;
                return window.innerWidth < maxWidth;
            }
        });
    </script>
</body>

</html>