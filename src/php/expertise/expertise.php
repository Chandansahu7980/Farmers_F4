<?php
error_reporting(0);
session_name('expertise');
session_start();
include_once './../../db/config.php';
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./../../../favicon.ico" type="image/x-icon">
    <title>Expertise Page - Project F4</title>

    <script src="https://kit.fontawesome.com/75d28f1837.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <link rel="stylesheet" href="./../css/adminPage.css" />
</head>

<body>
    <?php

    if (isset($_SESSION['expertise_id'])) {
    ?>
        <div class="sidebar">
            <p> <span> <i class="fa-solid fa-user-pen"></i> </span> Hello Expert</p>
            <hr><br>
            <ul>
                <li>
                    <form method="post">
                        <button name="response">Queries</button>
                    </form>
                </li>
                <li>
                    <form method="post">
                        <button name="profile">Profile</button>
                    </form>
                </li>
                <li>
                    <form method="post">
                        <button name="logout">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
        <div class="content" id="tableContent">
            <?php
            if (isset($_POST['response'])) {

                $crop_id = $_SESSION['crop_id'];
                $sqlToGetTable = "SELECT * FROM `queries`;";
                $result = $conn->query($sqlToGetTable);
                if ($result->num_rows > 0) {
            ?>
                    <table cellspacing='0' border="1">
                        <tr>
                            <th>query desc</th>
                            <th>query Image</th>
                            <th>Answer Here</th>
                        </tr>

                        <?php
                        while ($row = $result->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo $row['query_desc'] ?></td>
                                <?php
                                $image_path = $row['img_src'];
                                ?>
                                <td>
                                    <?php
                                    if ($row['img_src']) {
                                    ?>
                                        <a style="background-color: #4CAF50; color: white; padding: 5px 10px; text-decoration: none; border-radius: 5px;" href="<?php echo "./../../imgs/".$image_path; ?>" download>
                                            download image
                                        </a>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <?php
                                if ($row['status'] == 'open') {
                                ?>
                                    <td><a href="queryAnswerPage.php?query_id=<?php echo $row['id']; ?>">Answer Here</a>
                                    </td>
                                <?php
                                } else {
                                ?>
                                    <td><a href="viewqueryAnswerPage.php?query_id=<?php echo $row['id']; ?>" style="color:green; font-weight:bold">Answered</a>
                                    </td>
                                <?php
                                }
                                ?>

                            </tr>
                        <?php
                        }
                        ?>
                    </table>
            <?php
                }
            }

            if (isset($_POST['profile'])) {
                echo "<script>alert('profile table- comming soon.');</script>";
            }
            if (isset($_POST['logout'])) {
                session_name('expertise');
                session_start();
                session_destroy();
                header("Location: ./../");
                exit;
            }
            ?>
            <div class="default-content" style="margin: 3%;">
                <h2 align="center">Work and Responsibilities of a Farming Expert</h2><br>
                <hr><br><br>
                <ol>
                    <li>
                        <h3>Provide agricultural advice:</h3>
                        <p>A farming expert on your website should offer expert advice on various aspects of farming, such as crop selection, planting techniques, irrigation methods, pest and disease control, soil management, and fertilization practices.</p>
                    </li><br>
                    <li>
                        <h3>Answer farmer queries:</h3>
                        <p> The farming expert should be responsible for addressing farmer queries and concerns promptly. This can be done through a dedicated Q&A section on your website, email correspondence, or live chat support.</p>
                    </li><br>
                    <li>
                        <h3>Offer guidance on best practices: </h3>
                        <p>The expert should educate farmers on modern and sustainable farming practices, including the use of organic methods, efficient water management, crop rotation, integrated pest management, and other environmentally friendly techniques.</p>
                    </li><br>
                    <li>
                        <h3>Conduct farm assessments:</h3>
                        <p> The farming expert can provide farm assessments and evaluations, either remotely or through farm visits, to identify specific challenges, offer tailored solutions, and suggest improvements for increased productivity and profitability.</p>
                    </li><br>
                    <li>
                        <h3>Share market insights:</h3>
                        <p>The expert should keep farmers updated with the latest market trends, pricing information, and consumer demands for various agricultural products. This helps farmers make informed decisions about crop selection and market opportunities.</p>
                    </li><br>
                    <li>
                        <h3>Recommend suitable machinery and equipment:</h3>
                        <p> Based on the specific needs of farmers, the expert can recommend appropriate machinery, tools, and equipment for different farming operations. This includes guidance on selecting tractors, harvesters, irrigation systems, and other essential tools.</p>
                    </li><br>
                    <li>
                        <h3>Assist with agricultural technology adoption:</h3>
                        <p> As technology plays a vital role in modern farming, the expert can provide guidance on adopting and utilizing agricultural technologies, such as precision farming, data analytics, remote sensing, and farm management software.</p>
                    </li><br>
                </ol>
                <br>
                <hr><br><br>
                <h2 align="center">Steps for Answering Farmer Queries on Your Website:</h2><br>
                <hr><br>
                <ol>
                    <li>
                        <h3>Review the query:</h3>
                        <p> The farming expert should carefully read and understand the farmer's query to grasp the specific problem or information requested.</p>
                    </li><br>
                    <li>
                        <h3>Research and gather relevant information:</h3>
                        <p> If necessary, the expert should conduct research to gather accurate and up-to-date information related to the query. This may involve referring to scientific studies, agricultural publications, industry reports, or consulting other experts if needed.</p>
                    </li><br>
                    <li>
                        <h3>Prepare a comprehensive response:</h3>
                        <p>Based on the gathered information, the expert should prepare a detailed and well-structured response that addresses the farmer's query. It should be clear, concise, and easily understandable by the target audience.</p>
                    </li><br>
                    <li>
                        <h3>Provide practical advice and solutions:</h3>
                        <p>The expert should offer practical advice, solutions, or recommendations that the farmer can implement to resolve the issue or address the query effectively. This can include step-by-step instructions, best practices, or suggested resources for further assistance.</p>
                    </li><br>
                    <li>
                        <h3>Support with examples and case studies:</h3>
                        <p> Whenever possible, the expert should provide real-life examples or case studies to illustrate the advice or solutions given. This helps farmers visualize how to implement the recommendations in their own farming practices.</p>
                    </li><br>
                    <li>
                        <h3>Encourage engagement and further questions: </h3>
                        <p>The farming expert should encourage farmers to engage in further discussions or ask follow-up questions if they require additional clarification or assistance. This can be done by providing contact information or directing them to specific sections of the website for further support.</p>
                    </li><br>
                    <li>
                        <h3>Maintain a respectful and professional tone:</h3>
                        <p> Throughout the communication process, the expert should maintain a respectful and professional tone, addressing farmers' concerns with empathy and understanding. This helps establish a positive relationship and builds trust with the farming community.</p>
                    </li>
                </ol>
            </div>
        </div>
    <?php
    }else{
        echo "<script>alert('You must be logged in to access this page.');</script>";
        header("Location: ./../");
        exit();
    }
    ?>

    <script>
        function toggleCropTable() {
            var cropTable = document.getElementById("crop-table");
            if (cropTable.style.display === "none") {
                cropTable.style.display = "block";
            } else {
                cropTable.style.display = "none";
            }
        }
    </script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            offset: 300,
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