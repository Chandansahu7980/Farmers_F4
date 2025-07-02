<?php
error_reporting(0);
session_name('farmer');
session_start();
?>
<script>
    var simple = 'Cuttack';
</script>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="./../../favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="./css/headerStyle.css">

    <script src="https://kit.fontawesome.com/75d28f1837.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="navbar" data-aos="fade-down" data-aos-duration="2000" data-aos-offset="0">
            <div class="navbar-logo" id="navbar-logo" data-aos="fade-down" data-aos-duration="2000" data-aos-delay="1000">
                <span class="open" id="open"><i class="fa-solid fa-bars"></i></span>
                <p>PROJECT F4</p>
                <ul class="opt-list" id="opt-list">
                    <?php
                    if (isset($_SESSION['farmer_id'])) {
                    ?>
                        <li><a href="#" onclick="AlertConstruction()">My Profile</a></li>
                        <li><a href="farmerQueryView.php">Queries</a></li>
                        <li class="mob-notification"><a href="./Notification.php">Notification</a></li>
                        <li>
                            <form method="post">
                                <button name="logout">LogOut</button>
                            </form>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li><a href="./admin/adminLogin.php">Admin Login</a></li>
                        <li><a href="./expertise/expertiseLogin.php">Expertise Login</a></li>
                        <li class="desk-farmer-login"><a href="./farmer-loginPage.php">Farmer Login</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">About Us</a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>

            <?php

            if (isset($_POST['logout'])) {
                session_name('farmer');
                session_start();
                session_destroy();
                header("Location: index.php");
                exit;
            }
            if (!isset($_SESSION['farmer_id'])) {
            ?>
                <div class="login-btn" data-aos="fade-down" data-aos-duration="2000" data-aos-delay="1000">
                    <a href="./farmer-loginPage.php">LOGIN</a>
                </div>
            <?php
            } else {
            ?>
                <div class="notify" data-aos="fade-down" data-aos-duration="2000" data-aos-delay="1000">
                    <a href="./Notification.php">Notification</a>
                </div>
            <?php
            }
            ?>
        </div>

        <div class="weather" data-aos="fade-down" data-aos-duration="2500">
            <?php
            if (isset($_SESSION['farmer_id'])) {
            ?>
                <form method="post" id="cityEnterForm" data-aos="fade-down" data-aos-duration="2000" data-aos-delay="1000">
                    <input type="text" id="city0" name="city0" placeholder="Enter City name">
                    <button name="search"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            <?php
            }
            ?>

            <img class="weather-icon" src="./../imgs/weather/rain.png">
            <h1 class="temp"><span id="temp">22</span> °c</h1>
            <h2 class="city"><span id="city">Cuttack</span></h2>
            <div class="details">
                <div class="col">
                    <img class="weather-icon" src="./../imgs/weather/humidity.png">
                    <p class="humidity"><span id="humidity">50</span> %</p>
                    <p>Humidity</p>
                </div>
                <div class="col">
                    <img src="./../imgs/weather/wind.png">
                    <p class="wind"><span id="wind">77</span> Km/h</p>
                    <p>Wind Speed</p>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST['search'])) {
    ?>
        <script>
            simple = '<?php echo $_POST['city0'] ?>';
        </script>
    <?php
    }
    ?>

    <script>
        document.getElementById("open").addEventListener("click", function() {
            // var element = document.querySelector(".navbar-logo .opt-list");
            // var btnn = document.querySelector(".navbar-logo .open");
            var element = document.getElementById("opt-list");
            var btnn = document.getElementById("open");
            var icon = btnn.querySelector('i');
            if (element.style.display == "none") {
                element.style.display = "block";
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-xmark');
                icon.style.color = "gray";
                icon.addEventListener('mouseover', () => {
                    icon.style.color = 'red';
                });
                icon.addEventListener('mouseout', () => {
                    icon.style.color = 'gray';
                });
            } else {
                element.style.display = "none";
                icon.classList.add('fa-bars');
                icon.classList.remove('fa-xmark');
                icon.style.color = "white";
                icon.addEventListener('mouseover', () => {
                    icon.style.color = 'white';
                });
                icon.addEventListener('mouseout', () => {
                    icon.style.color = 'white';
                });
            }
        });

        // weather widget.....
        const apiKey = '1d4f8c891bdd6b0eddbeccf8ef3932a6';
        const apiurl = `https://api.openweathermap.org/data/2.5/weather?units=metric&q=`;
        const weatherIcon = document.querySelector(".weather-icon");

        async function getWeather(city) {
            const response = await fetch(apiurl + city + `&appid=${apiKey}`);
            const data = await response.json();

            console.log(data);

            // alert(data.name);

            document.getElementById("city").innerHTML = data.name;
            document.getElementById("temp").innerHTML = data.main.temp;
            document.getElementById("humidity").innerHTML = data.main.humidity;
            document.getElementById("wind").innerHTML = data.wind.speed;

            if (data.weather[0].main == "Clouds") {
                weatherIcon.src = "./../imgs/weather/clouds.png";
            } else if (data.weather[0].main == "Clear") {
                weatherIcon.src = "./../imgs/weather/clear.png";
            } else if (data.weather[0].main == "Drizzle") {
                weatherIcon.src = "./../imgs/weather/drizzle.png";
            } else if (data.weather[0].main == "Humidity") {
                weatherIcon.src = "./../imgs/weather/humidity.png";
            } else if (data.weather[0].main == "Mist") {
                weatherIcon.src = "./../imgs/weather/mist.png";
            } else if (data.weather[0].main == "Rain") {
                weatherIcon.src = "./../imgs/weather/rain.png";
            } else if (data.weather[0].main == "Snow") {
                weatherIcon.src = "./../imgs/weather/snow.png";
            } else if (data.weather[0].main == "Wind") {
                weatherIcon.src = "./../imgs/weather/wind.png";
            }
        }

        getWeather(simple);
        // getWeather("Cuttack");
        // getWeather("Jajpur");
        // getWeather("Ganjam");

        // const pincodeUrl="https://api.data.gov.in/resource/9115b89c-7a80-4f54-9b06-21086e0f0bd7?api-key=579b464db66ec23bdd000001cdd3946e44ce4aad7209ff7b23ac571b&format=json&offset=1&limit=1&filters%5Bpincode%5D=761107";


        function AlertConstruction() {
            alert("Page Under Construction");
        }
    </script>
</body>



</html>