<?php
$category_id = $_GET['category_id'];
$category_name = $_GET['category_name'];
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="./../../favicon.ico" type="image/x-icon">

    <title>All Crops under Category - project F4</title>

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <link rel="stylesheet" href="./css/Style.css">
</head>

<body >
    <button class="goBack" onclick="window.location.replace('./index.php');">Go Back</button>
    <div class="crop-container">
        <h1 data-aos="fade-up" data-aos-duration="3000"><?php echo $category_name; ?></h1>
        <?php
        include './../db/config.php';
        $sql = "SELECT * FROM `crop` WHERE category_id='$category_id';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        ?>
            <div class="category-types">
                <?php
                while ($row = $result->fetch_assoc()) {
                    $img_src = $row['img_src'];
                    $crop_id = $row['id'];
                ?>
                    <div class="category" style="background-image:linear-gradient(rgba(0, 0, 0, 0.552), rgba(0, 0, 0, 0.516)),url('<?php echo "./../imgs/".$img_src; ?>')" onclick="goDetails(<?php echo $crop_id; ?>)" data-aos="zoom-in" data-aos-duration="3000">
                        <h1 data-aos="flip-down" data-aos-delay="1000" data-aos-duration="3000"><?php echo $row['name']; ?></h1>
                        <p><?php echo $row['crop_desc']; ?></p>
                    </div>
                <?php
                }
                ?>
            </div>
        <?php
        }
        ?>
    </div>

    <?php
    include './footer.php';
    ?>


    <script>
        function goDetails(id) {
            window.location.href = "cropDetails.php?crop_id=" + id;
        }
    </script>


    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            easing: 'ease-in-out'
        });
    </script>
    
</body>

</html>