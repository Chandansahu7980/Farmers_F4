<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="../../favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <title>Farmer's Help</title>
    <link rel="stylesheet" href="./css/Style.css">
    <link rel="stylesheet" href="./css/queryForm.css">
</head>

<body>
    <?php
    include './header.php';
    include_once './../db/config.php';
    ?>

    <div class="crop-container" id="crop-category" name="crop-category">
        <h1>Crop Practices</h1>
        <?php
        if (isset($_SESSION['farmer_id'])) {
        ?>
            <div class="crop-search-form" data-aos="fade-down">
                <form method="post">
                    <?php
                    $sqlCropId = "SELECT `id`, `name` FROM `crop`;";
                    $resultCropId = $conn->query($sqlCropId);
                    if ($resultCropId->num_rows > 0) {
                    ?>
                        <select name="crop_id" id="crop_id" required>
                            <option disabled selected value="">Select any crop</option>
                            <?php
                            while ($row = $resultCropId->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $row['id']; ?>">
                                    <?php echo $row['name']; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    <?php
                    }
                    ?>
                    <button type="button" onclick="redirectToUrl()"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
        <?php
        }

        $sql = "SELECT * FROM `crop_category`;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        ?>
            <div class="category-types">
                <?php
                while ($row = $result->fetch_assoc()) {
                    $img_src = $row['img_src'];
                    $category_id = $row['id'];
                    $category_name = $row['name'];
                ?>
                    <div class="category" data-aos="fade-right" data-aos-offset="200" style="background-image:linear-gradient(rgba(0, 0, 0, 0.552), rgba(0, 0, 0, 0.516)),url('<?php echo "./../imgs/" . $img_src; ?>')" onclick="goDetails(<?php echo $category_id ?>,'<?php echo $category_name; ?>')">
                        <h1 data-aos="flip-up" data-aos-duration="1000" data-aos-delay="500" data-aos-offset="50"><?php echo $category_name; ?></h1>
                        <p data-aos="flip-up" data-aos-duration="1000" data-aos-offset="60"><?php echo $row['category_desc']; ?></p>
                    </div>
                <?php
                }
                ?>
            </div>
        <?php
        }
        ?>
    </div>

    <section class="banner">
        <div class="banner-content" data-aos="fade-up" data-aos-offset="200">
            <h2>Get expert advice for your farm</h2>
            <ul class="benefits">
                <li><img src="./../imgs/list-style-1.gif" class="list-style-1"> Get personalized insights from our team of experts</li>
                <li><img src="./../imgs/list-style-1.gif" class="list-style-1"> Learn new techniques to improve your yield and quality</li>
                <li><img src="./../imgs/list-style-1.gif" class="list-style-1"> Get easy step and your problem will be vanished.</li>
                <li><img src="./../imgs/list-style-1.gif" class="list-style-1"> Know more efficient way of farming.</li>
                <li><img src="./../imgs/list-style-1.gif" class="list-style-1"> Stay updated with the latest farming news and trends</li>
            </ul>
            <p class="supportive-text">Need help? Write your problem. We will help YOU ✌️.</p>
        </div>
    </section>


    <div class="query-form-container">

        <h1>Write Us Query to get more efective information.</h1>

        <form method="post" class="query-form" id="query-form" enctype="multipart/form-data" data-aos="flip-up">
            <input type="number" name="farmer_id" id="farmer_id" value="<?php echo $_SESSION['farmer_id']; ?>" hidden>
            <div>
                <?php
                $sqlCropId = "SELECT `id`, `name` FROM `crop`;";
                $resultCropId = $conn->query($sqlCropId);
                if ($resultCropId->num_rows > 0) {
                ?>
                    <select name="crop_id" id="crop_id" required>
                        <option disabled selected value="">Select Crop</option>
                        <?php
                        while ($row = $resultCropId->fetch_assoc()) {
                        ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                <?php
                }
                ?>
                <input type="file" accept="image/*" id="img_src" name="img_src">
            </div>
            <textarea name="query_desc" id="query_desc" placeholder="Write Your Query Here ..." rows="13" required></textarea><br>
            <button name="send-query">Send Query</button>
        </form>
    </div>


    <section class="banner banner2">
        <div class="banner-content" data-aos="fade-up" data-aos-offset="200">
            <h2>Elevate Your Crop Knowledge and Drive Agricultural Innovation</h2>
            <ul class="benefits">
                <li><img src="./../imgs/list-style-1.gif" class="list-style-1"> Make a real impact in the farming industry by sharing your knowledge and insights with farmers worldwide</li>
                <li><img src="./../imgs/list-style-1.gif" class="list-style-1"> Connect with fellow crop experts and be part of a thriving network dedicated to revolutionizing agriculture</li>
                <li><img src="./../imgs/list-style-1.gif" class="list-style-1"> Help farmers optimize crop yields, enhance soil health, and overcome agricultural challenges using your valuable expertise</li>
                <li><img src="./../imgs/list-style-1.gif" class="list-style-1"> Become a trusted advisor to farmers and assist them in making informed decisions for their crops</li>
                <li><img src="./../imgs/list-style-1.gif" class="list-style-1"> Contribute to the global agricultural community by sharing your research, techniques, and success stories</li>
            </ul>
            <p class="supportive-text">Unlock Your Potential here✌️. <a href="./expertise.php">Get Started</a></p>
        </div>
    </section>

    <?php
    include './footer.php';

    if (isset($_POST['send-query'])) {
        if (isset($_SESSION['farmer_id'])) {

            $farmer_id = $_POST['farmer_id'];
            $crop_id = $_POST['crop_id'];
            $query_desc = $_POST['query_desc'];
            $current_date = date("d-m-Y");

            if (isset($_FILES['img_src']) && $_FILES['img_src']['error'] === UPLOAD_ERR_OK) {
                $file_name = $_FILES['img_src']['name'];
                $imgDest = './../imgs/' . $file_name;
                move_uploaded_file($_FILES['img_src']['tmp_name'], $imgDest);
            } else {
                $file_name = null;
                $imgDest = null;
            }

            // ✅ Prepare the SQL with placeholders
            $stmt = $conn->prepare("INSERT INTO `queries` (`farmer_id`, `date_created`, `query_desc`, `img_src`, `crop_id`) VALUES (?, ?, ?, ?, ?)");

            // ✅ Bind values safely (all strings here)
            $stmt->bind_param("ssssi", $farmer_id, $current_date, $query_desc, $file_name, $crop_id);

            // ✅ Execute
            if ($stmt->execute()) {
                echo "<script>alert('Query submitted successfully.');</script>";
                echo "<script>document.getElementById('query-form').reset();</script>";
                echo "<script>window.location.href = 'index.php';</script>";
            } else {
                echo "<script>alert('Query not submitted.');</script>";
            }

            $stmt->close();
        } else {
            echo "<script>alert('Please Log In Before Submitting Query');</script>";
            echo "<script>window.location.href = 'farmer-loginPage.php';</script>";
        }
    }
    ?>


    <script>

        function goDetails(id, name) {
            const url = 'categoryDetails.php';
            const queryString = `?category_id=${id}&category_name=${name}`;
            window.location.href = url + queryString;
        }

        function toggleCropTable() {
            var cropTable = document.getElementById("crop-table");
            if (cropTable.style.display === "none") {
                cropTable.style.display = "block";
            } else {
                cropTable.style.display = "none";
            }
        }

        function redirectToUrl() {
            var cropId = document.getElementById("crop_id").value;
            var encodedValue = encodeURIComponent(cropId);
            var url = "cropDetails.php?crop_id=" + encodedValue;
            window.location.href = url;
        }
    </script>

    <!-- My Data Aos for scroll animation -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        // AOS.init();
        AOS.init({
            offset: 300,
            duration: 1000,
            easing: 'ease-in-out'
        });
    </script>

</body>

</html>