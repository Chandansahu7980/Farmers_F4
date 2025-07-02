-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2025 at 09:37 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project4dbs`
--

-- --------------------------------------------------------

--
-- Table structure for table `crop`
--

CREATE TABLE `crop` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `crop_desc` varchar(600) NOT NULL,
  `img_src` varchar(200) NOT NULL,
  `category_id` int(11) NOT NULL,
  `best_location` varchar(600) NOT NULL,
  `season` varchar(100) NOT NULL,
  `soil` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crop`
--

INSERT INTO `crop` (`id`, `name`, `crop_desc`, `img_src`, `category_id`, `best_location`, `season`, `soil`) VALUES
(1, 'paddy', 'Paddy also called rice paddy, small level, flooded field used to cultivate rice in southern & eastern Asia.\r\n\r\n', 'paddy-bg.webp', 1, 'cuttack, khurda, sambalpur, bargarh, kendrapara, balasore, jagatsinghpur, ganjam, puri, nayagarh', 'rainy and summer season', 'loamy soil'),
(2, 'wheat', 'wheat is a grass widely cultivated  for its seed, a cereal grain that is a worldwide staple food.', 'wheat-bg.webp', 1, 'cuttack, puri, khurda, sundargarh, keonjhar', 'winter ', 'loamy soil, clay loam soil, sandy loam soil, alluvial soil'),
(3, 'maize', 'Maize also known as Corn & Queen of creales because it has highest genetic yield potencial among the cereals.', 'maize-bg.webp', 1, 'Mayurbhanj, koraput, balasore, sundargarh, ganjam, Kalahandi, rayagada, sambalpur', 'monsoon ', 'red soil, laterite soil, sandy loam soil, alluvial soil'),
(4, 'Toor dal(harad)', 'It is rich in proteins & fiberes. It is dried and split peas seeds of pigeon peas plant.', 'harad-bg.webp', 2, 'mayurbhanj, koraput, sundargarh, balasore, sambalpur, baragarh, kalahandi, nuapada', 'monsoon', 'sandy loam soil, clay loam soil, red soil'),
(5, 'Red lentil(Masoor)', 'Important part of the diet, soft & cooks quickly.', 'masoor-bg.webp', 2, 'mayurbhanj, keonjhar, balangir, dhenkanal, sundargarh, sambalpur, bargarh,cuttack', 'winter', 'loamy soil, red soil, black soil, laterite  soil'),
(6, 'Green moong', 'Used as an ingredient in both savoury and sweet dishes.', 'moong-bg.webp', 2, 'mayurbhanj, koraput, ganjam, khurda, balsore, bhadrak, sundargarh, bargarh.', 'rainy season', 'loamy soil, red soil, laterite soil'),
(12, 'Cabbage', 'it is a leafy vegetable with a round,compact head or \"heart\" made up of many layer of thick,sturdy leaves that grow in a tighty packed formation.', 'pexels-mdabu-taleb-15441233.jpg', 3, 'kendrapara,jajpur,balsore,ganjam and jagatsinghpur', 'mid feb-mid apr,august-octob', 'sandy to heavy soil'),
(13, 'potato', 'it is a plant.the fleshly part of the root(potato) is commonly  eaten as a vegetable.it is also used to make medicine.', 'images.jpeg', 3, 'puri,cuttack,kandhamala,koraput,sambalpur', 'july-november and november-march', 'loamy and sandy loam soils'),
(14, 'brinjal', 'it is an easily cultivated plant belonging to the family solanaceae.it is also known as \'eggplant\' or \'aubergine\'.', 'brinjal.jpg', 3, 'cuttack,puri,sambalpur,balasore', 'late spring or early summer', 'loamy soil');

-- --------------------------------------------------------

--
-- Table structure for table `crop_category`
--

CREATE TABLE `crop_category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category_desc` varchar(600) NOT NULL,
  `img_src` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crop_category`
--

INSERT INTO `crop_category` (`id`, `name`, `category_desc`, `img_src`) VALUES
(1, 'cereals', 'Grown in greater quantities and provide more food energy worldwide.', 'cereals-bg-1.webp'),
(2, 'pulses', 'An integral part of the Indian diet, providing much needed protein to the carbohydrate rich diet.', 'pulses-bg-2.webp'),
(3, 'vegetables', 'Vegetables are nutritious plants that provide essential vitamins, minerals and fiber.', 'vegetable-bg-3.webp');

-- --------------------------------------------------------

--
-- Table structure for table `expertise`
--

CREATE TABLE `expertise` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(300) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `crop_id` int(11) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expertise`
--

INSERT INTO `expertise` (`id`, `name`, `email`, `phone`, `address`, `crop_id`, `password`) VALUES
(14, 'paddy Expert', 'paddy@gmail.com', '6789456790', 'addr paddy', 1, '$2y$10$otarI3/1f4LpKW/N4g1tH.vZT54bOHrCwrk3gF.zK48dd1vwaZKtW'),
(17, 'Maize Expert', 'maize@gmail.com', '0987654321', 'maize addr', 3, '$2y$10$UmHXdV.rqsG8kedTo9i5TOy98s4.5y5bFzQddGIVUBr.ZZy1kyyzK');

-- --------------------------------------------------------

--
-- Table structure for table `farmers`
--

CREATE TABLE `farmers` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `address` varchar(400) NOT NULL,
  `pincode` int(11) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `farmers`
--

INSERT INTO `farmers` (`id`, `name`, `phone`, `address`, `pincode`, `password`) VALUES
(11, 'Chandan New', '7907907900', 'new addr', 761107, '$2y$10$c8alAuCxHPGM0QM4MlTYpOpdtZ3XxmRfLgIbeIZ1jDsHQv52iAzVe'),
(12, 'Dipti Ranjan Sahu', '7008009001', 'Anugul', 761108, '$2y$10$Meb64lnJDrpaoHjT/bPrl.VO/AzEsZ.pkMxbZrKGpxD7vRzn4m68y'),
(15, 'new4', '7834762901', 'new addr4', 890789, '$2y$10$2gQQxUzJ3ztrVX5Z2CPID.nhBcwzCRvKhWpJadB/picU7.X9L6c1.');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `feedback_desc` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fertilizer`
--

CREATE TABLE `fertilizer` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `fertilizer_desc` varchar(6000) NOT NULL,
  `img_src` varchar(300) NOT NULL,
  `crop_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fertilizer`
--

INSERT INTO `fertilizer` (`id`, `name`, `fertilizer_desc`, `img_src`, `crop_id`) VALUES
(1, 'Ammonium sulfates ', 'Ammonium sulfate is commonly used as a fertilizer in agriculture because it is an excellent source of both nitrogen and sulfur, two essential nutrients for plant growth. Its ability to lower the pH of soil can be particularly beneficial for crops that thrive in acidic soil conditions. However, over-application can lead to soil acidification and damage to plant roots, so it is important to follow recommended application rates and timings to ensure optimal plant growth and avoid negative environmental impacts', 'ammonium_sulfates_paddy fertilizer.jpg', 1),
(2, 'Nitrogen (N)', 'Nitrogen is a critical nutrient for the growth and development of paddy plants. Nitrogen fertilizers such as urea, ammonium sulfate, and calcium ammonium nitrate are commonly used in paddy cultivation.', 'Nitrogen_fertilizer_paddy.jpg', 1),
(3, 'Phosphorous (P) fertilizer', 'Phosphorus is important for early root development and seedling growth in paddy plants. Phosphorus fertilizers such as triple superphosphate and single superphosphate are commonly used in paddy cultivation.', 'phosphate_fertilizer_paddy.jpg', 1),
(4, 'Potassium (K) fertilizer', 'Potassium is essential for the overall growth and development of paddy plants, including the development of strong stems and healthy roots. Potassium fertilizers such as muriate of potash and sulfate of potash are commonly used in paddy cultivation.', 'potassium sulphates_paddy.png', 1),
(5, 'Nitrogen fertilizers ', 'Nitrogen is an essential nutrient for wheat, and nitrogen fertilizers are commonly used to provide this nutrient. Some examples of nitrogen fertilizers include urea, ammonium sulfate, and ammonium nitrate.', 'ammonium-sulfate.jpg', 2),
(6, 'Phosphorus fertilizers', ' Phosphorus is another important nutrient for wheat, particularly during the early stages of growth. Some examples of phosphorus fertilizers include triple superphosphate, diammonium phosphate (DAP), and monoammonium phosphate (MAP).', 'diammonium-phosphate-wheat.jpg', 2),
(7, 'Potassium fertilizers ', 'Potassium is important for wheat growth and helps to increase disease resistance and drought tolerance. Some examples of potassium fertilizers include potassium chloride, potassium sulfate, and potassium nitrate.', 'potassium-sulphate-wheat.jpg', 2),
(8, 'Micronutrient fertilizers', 'Micronutrients, such as iron, manganese, and zinc, are also important for healthy wheat growth. Micronutrient fertilizers are used to provide these nutrients when they are deficient in the soil.', 'Micronutrient fertilizers-wheat.jpg', 2),
(9, 'Organic fertilizers', 'Organic fertilizers, such as compost and manure, can also be used to provide nutrients for wheat growth. These fertilizers are typically slower acting than synthetic fertilizers but can help to improve soil health and fertility over time.', 'Organic fertilizers-wwheat.jpg', 2),
(10, 'Nitrogen fertilizers', 'Nitrogen is the most important nutrient for maize, and nitrogen fertilizers are commonly used to supply this nutrient to the crop. The most commonly used nitrogen fertilizers include urea, ammonium sulfate, and ammonium nitrate.', 'Nitrogen fertilizers.webp', 3),
(11, 'Phosphorus fertilizers', 'Phosphorus is also essential for maize growth, and phosphorus fertilizers are commonly used to supply this nutrient. Examples of phosphorus fertilizers include triple superphosphate and diammonium phosphate.', 'Phosphorus fertilizers.jpg', 3),
(12, 'Potassium fertilizers', 'Potassium is important for maize plant development, stress tolerance, and grain filling. Potassium fertilizers commonly used in maize farming include potassium chloride and potassium sulfate.', 'Potassium fertilizers.jpeg', 3),
(13, 'Micronutrient fertilizers', 'Maize also requires micronutrients such as zinc, iron, and copper, which are usually supplied through micronutrient fertilizers, such as zinc sulfate, ferrous sulfate, and copper sulfate.', 'Micronutrient fertilizers.webp', 3),
(14, 'Nitrogen (N) fertilizers', ' Nitrogen is essential for the growth and development of toor dal plants. Urea is the most commonly used nitrogen fertilizer in toor dal cultivation. It is usually applied in split doses, i.e., 25-30% at the time of sowing and the remaining in two or three split applications during the growth stages.: Nitrogen is essential for the growth and development of toor dal plants. Urea is the most commonly used nitrogen fertilizer in toor dal cultivation. It is usually applied in split doses, i.e., 25-30% at the time of sowing and the remaining in two or three split applications during the growth stages.', 'urea-toor-dal.jpg', 4),
(15, 'Phosphorus (P) fertilizers ', ' Phosphorus is necessary for the early growth and root development of toor dal plants. Superphosphate is the most common source of phosphorus used in toor dal cultivation. It is generally applied at the time of sowing.', 'Super-Phosphate-Fertilizer-toor-dal.jpg', 4),
(16, 'Potassium (K) fertilizers', ':Potassium is important for the overall growth, yield, and quality of toor dal. Muriate of potash is a commonly used potassium fertilizer in toor dal cultivation. It is generally applied in split doses after the crop reaches the flowering stage.', 'Muriate of potash-toor.jpeg', 4),
(17, 'Nitrogen', ' While red lentils can fix their own nitrogen, they still require a small amount of supplemental nitrogen during the early stages of growth. This can be provided through the use of a nitrogen-containing fertilizer, such as ammonium sulfate or urea.', 'Nitrogen_red lentil.webp', 5),
(18, 'Phosphorus', ' Phosphorus is an important nutrient for lentil growth and is often added to the soil as a phosphate-containing fertilizer, such as triple superphosphate.', 'Phosphorus_red lentil.jpg', 5),
(19, 'Potassium', 'Potassium is essential for lentil growth and can improve crop yields and quality. Potassium-containing fertilizers, such as muriate of potash, can be used to supplement soil potassium levels.', 'Potassium_red lentil.jpeg', 5),
(20, 'Nitrogen fertilizers', ' Nitrogen is an essential nutrient that is important for plant growth and development. Nitrogen fertilizers such as urea, ammonium sulfate, and calcium ammonium nitrate can be used to provide nitrogen to green moong plants. The recommended dose of nitrogen fertilizer is typically around 20-30 kg per hectare.', 'Nitrogen fertilizers.webp', 6),
(21, 'Phosphorus fertilizers', 'Phosphorus is another important nutrient that is essential for plant growth and development. Phosphorus fertilizers such as superphosphate and diammonium phosphate can be used to provide phosphorus to green moong plants. The recommended dose of phosphorus fertilizer is typically around 20-30 kg per hectare.', 'Phosphorus fertilizers.jpg', 6),
(22, 'Potassium fertilizers', 'Potassium is a nutrient that is important for plant growth and development, especially for the formation of strong stems and roots. Potassium fertilizers such as muriate of potash and potassium sulfate can be used to provide potassium to green moong plants. The recommended dose of potassium fertilizer is typically around 20-30 kg per hectare.', 'Potassium fertilizers.jpeg', 6),
(23, 'Organic fertilizers', ' Organic fertilizers such as compost, farmyard manure, and green manure can also be used to provide nutrients to green moong plants. Organic fertilizers improve soil fertility, structure, and water-holding capacity. The recommended dose of organic fertilizer is typically around 2-4 tons per hectare.', 'Organic fertilizers_green moong.jpeg', 6),
(24, 'Dr. Earth Premium Gold All Purpose Fertilizer 4-4-4 ', ' Balanced nutrition using only organic ingredients also supports long-term soil health. Use either as slow-release pellets or transform them into a compost tea.', '71ebJ+rseRL._AC_SX679_.jpg', 12),
(25, ' JR Peters Classic Fertilizer 20-20-20 ', ' Water-soluble fertilizer for use in nutrient-depleted soil and where established cabbage plants need a nutrient boost. ', '91aXFP96fIL._SX522_.jpg', 12),
(26, 'Triple 10 All Purpose Liquid Fertilizer 10-10-10', ' It has the perfect balance of macronutrients to support cabbage crops throughout spring and summer.  The addition of amino acids in this feed means that my cabbage plants are more resistant to drought conditions and cold spells, as well as have protection against pests and diseases. And if that’s not enough, the inclusion of seaweed extract means the flavor and yield of my cabbage crops are even better. ', '71dqaG-zYGL._AC_SY879_.jpg', 12),
(27, ' Dr. Earth Organic 5 Tomato, Vegetable & Herb Fertilizer', 'Earth Organic Fertilizer enriched this with humic acid, fishbone meal, fish meal, and alfalfa meal. All of these contribute to healthy potato growth.  All of these work together to produce a better potato harvest. Reviews say plants often double in overall size when using this fertilizer for potatoes. This is a 4-6-3 NPK ratio, which means it slightly has more phosphorus than nitrogen and potassium. Phosphorous contributes to strong root development. For best results, plan to reapply every two months.', '1.png', 13),
(28, 'Jobe’s Organics Vegetable & Tomato Plant Food', 'Using Jobe’s Organics is easy. Apply some around your potato plants early; mix it into your compost when planting. Then, apply every six to eight weeks for a continuous supply of nutrients to your plants.', '3.png', 13),
(29, 'urea', 'Urea is a nitrogen-rich fertilizer and is commonly used to provide nitrogen to brinjal plants. It promotes foliage growth and enhances overall plant development. It is typically applied at the time of planting or within a few weeks of transplanting.', 'UREA_0.png', 14),
(30, 'Di-Ammonium Phosphate (DAP) ', 'DAP is a phosphorus-rich fertilizer that helps in root development, flowering, and fruit setting. It is often applied before planting or incorporated into the soil during land preparation.', 'spic-dap-imported-1.jpg', 14),
(31, 'Organic Fertilizers', 'In addition to chemical fertilizers, organic fertilizers such as compost, well-rotted manure, or vermicompost can be used to improve soil fertility and provide slow-release nutrients to brinjal plants. These organic fertilizers enhance soil structure, promote microbial activity, and improve nutrient availability to the plants.', 'istockphoto-805924230-612x612.jpg', 14);

-- --------------------------------------------------------

--
-- Table structure for table `harvest_step`
--

CREATE TABLE `harvest_step` (
  `id` int(11) NOT NULL,
  `step_no` int(11) NOT NULL,
  `step_name` varchar(200) NOT NULL,
  `step_desc` varchar(6000) NOT NULL,
  `img_src` varchar(200) NOT NULL,
  `crop_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `harvest_step`
--

INSERT INTO `harvest_step` (`id`, `step_no`, `step_name`, `step_desc`, `img_src`, `crop_id`) VALUES
(1, 1, 'preparing the land', 'Land preparation involves several activities that create the optimal growing conditions for paddy crops. The first step in land preparation is clearing the land of any weeds, debris, and rocks. This is typically done manually or using mechanical tools like tractors, depending on the size of the field.\n\nAfter clearing the land, the soil is plowed to a depth of about 15-20 cm to break up hard soil and turn it over to expose the nutrients below. Plowing also helps to loosen the soil, making it easier for the paddy roots to penetrate the soil and take up nutrients. The soil is then leveled to create an even surface, which is crucial for irrigation and preventing waterlogging in low-lying areas.\n\nIn addition to plowing and leveling, adding organic matter is another crucial step in land preparation. Organic matter such as compost, green manure, or animal manure can be added to the soil to improve soil fertility, water retention, and aeration. Organic matter also enhances soil structure, making it easier for the roots to penetrate the soil and absorb nutrients.\n\nFertilizers are also a crucial component of land preparation. Depending on the nutrient status of the soil, fertilizers may be added to provide the necessary nutrients for paddy growth. Nitrogen, phosphorus, and potassium are the main nutrients required by paddy crops, and they are usually added at different growth stages of the crop.\n\nPreparing bunds is another crucial step in land preparation. Bunds are raised earthen embankments that are built around the paddy field to control water flow and prevent soil erosion. The bunds are usually prepared before flooding the field for irrigation. The height of the bunds depends on the slope of the field and the amount of water required for irrigation.\n', 'paddy-land-prepairation-step1.jpg', 1),
(2, 2, 'transplanting the paddy seedings', 'Transplanting of paddy seedlings involves preparing a seedbed, sowing paddy seeds, germinating the seedlings, uprooting them, and transplanting them to the main field. The seedlings are planted in rows with sufficient spacing, watered immediately, and maintained throughout the growing season. This process is labor-intensive but can result in higher yields and better plant health compared to direct seeding in certain areas.', 'paddy-transplanting-step2.jpg', 1),
(3, 3, 'maintenance of the field', 'Maintenance of the paddy field is a critical step in rice cultivation that can significantly impact the overall success of the crop. Proper management of water supply, nutrient levels, pests, diseases, and weeds can all contribute to higher crop yields and better quality rice. For example, inadequate water management can result in waterlogging or drought stress, which can stunt plant growth and reduce yields. Similarly, failure to control weeds or pests can lead to competition for resources and further reduce yields. Proper maintenance of the paddy field not only ensures a successful harvest but also contributes to food security and supports rural livelihoods in many parts of the world. In short, the careful management of the paddy field can have a significant impact on both agricultural productivity and human well-being.\n\n\n\n\n', 'paddy-maintenance-step3.jpg', 1),
(7, 4, 'harvesting', 'Paddy cultivation is a complex process that involves several stages, including planting, nurturing, and harvesting the rice crop. Harvesting is the process of collecting mature rice plants from the field and preparing them for further processing. This involves cutting the mature plants, bundling and drying them, threshing to separate the grains from the rest of the plant material, winnowing to separate the grains from the chaff, and cleaning and storing the grains. The timing of the harvesting process is critical to ensure maximum yield, and careful execution and storage are necessary to prevent spoilage and insect infestation. Overall, harvesting is an important step in paddy cultivation that requires attention to detail and careful planning to ensure a successful crop.', 'paddy-harvest-step4.jpg', 1),
(17, 1, 'Seed selection', 'The first step in cultivating wheat is selecting the right type of seed. Farmers usually choose seeds that are suited to the local climate and soil conditions, and that have the desired characteristics such as disease resistance and yield potential.Seed selection: The first step in cultivating wheat is selecting the right type of seed. Farmers usually choose seeds that are suited to the local climate and soil conditions, and that have the desired characteristics such as disease resistance and yield potential.: The first step in cultivating wheat is selecting the right type of seed. Farmers usually choose seeds that are suited to the local climate and soil conditions, and that have the desired characteristics such as disease resistance and yield potential.', 'Seed-selection-step-1_wheat.png', 2),
(18, 2, 'Land preparation', 'Once the seeds have been selected, the next step is to prepare the land for planting. This involves plowing the soil, breaking up any clumps, and smoothing the surface to create a seedbed.', 'land_preparation_wheat.webp', 2),
(19, 3, 'Planting', 'The seeds are then planted using a variety of methods, including broadcast seeding or using a drill. The seeds are usually planted at a depth of around 2-3 inches.', 'planting seeds_wheat.jpg', 2),
(20, 3, 'Fertilization', 'After planting, the wheat needs to be fertilized to ensure healthy growth and high yields. Fertilizers such as nitrogen, phosphorus, and potassium are commonly used.c: After planting, the wheat needs to be fertilized to ensure healthy growth and high yields. Fertilizers such as nitrogen, phosphorus, and potassium are commonly used.', 'fertilization_wheat.jpg', 2),
(21, 4, 'Irrigation', 'Wheat requires adequate moisture to grow, so irrigation is an important part of the cultivation process, especially in areas with low rainfall.', 'irrigation_wheat.jpg', 2),
(22, 5, 'Pest and disease control', 'Wheat is susceptible to a range of pests and diseases, so farmers need to take steps to prevent and control these problems. This may include using pesticides or practicing crop rotation.', 'pesticides-harvesting_wheat.webp', 2),
(23, 6, 'Harvesting', 'Finally, once the wheat has matured and the moisture content is between 12% and 14%, it is ready to be harvested. The harvesting process involves cutting the wheat, threshing it to separate the grain from the straw, cleaning the grain, and hauling it to a storage facility.', 'harvesting_wheat.jpg', 2),
(24, 1, 'Land preparation', 'The first step in maize cultivation is to prepare the land for planting. This involves clearing the field of any weeds, debris or rocks, tilling the soil to create a fine seedbed and fertilizing the soil with organic or synthetic fertilizers.', 'land-maize.jpg', 3),
(25, 2, 'Planting', 'Once the land is prepared, the next step is to plant the maize seeds. The seeds can be planted by hand or using a seed drill, which spaces the seeds evenly and at the correct depth.', 'Planting-of-maize-crop-on-the-ridges.jpg', 3),
(26, 3, 'Maintenance', ' After planting, maize plants require regular maintenance. This includes irrigating the field regularly, controlling weeds and pests, and fertilizing the plants as needed.', 'maintenance-maize.jpg', 3),
(27, 4, 'Harvesting', ' Maize is typically harvested when the kernels have reached maturity and are dry enough to be stored safely. This timing can vary depending on the variety of maize and local climatic conditions.', 'harvesting-maize.jpeg', 3),
(28, 5, 'Post-harvest management', 'After harvesting, the maize needs to be dried and stored properly to prevent mold or insect damage. This can be done by spreading the maize out in the sun or using a specialized dryer. Once dry, the maize can be stored in a cool, dry place to maintain its quality.', 'post-harvesting management-maize.jpg', 3),
(33, 1, 'Land preparation', 'The first step in toor dal cultivation is to prepare the land for planting. This involves clearing the land of any weeds or debris, tilling the soil to break up any compacted layers, and leveling the field to ensure uniform water distribution.', 'Land preparation.jpg', 4),
(34, 2, 'Seed selection', ' Select high-quality toor dal seeds that are free from pests and diseases.', 'seed-selectionToorDal..jpg', 4),
(35, 3, 'Seed treatment', ' Soak the seeds in water overnight, then treat them with a fungicide or insecticide to protect them from diseases and pests.', 'Seed treatment-Toor-Dhal..jpg', 4),
(36, 4, ' Sowing', ' Sow the treated seeds in rows, spacing them at least 10-15 cm apart. The depth of sowing should be around 3-4 cm.', 'sow-toor-dal.jpg', 4),
(37, 5, 'Irrigation', ' Water the field immediately after sowing and then irrigate as required, depending on the weather conditions.', 'Irrigation-toor-dal.jpg', 4),
(38, 6, 'Fertilization', ' Apply fertilizers like urea, superphosphate, and potash at the time of sowing and in subsequent stages of growth.', 'Fertilization-toor-dl.jpg', 4),
(39, 7, 'Weed control', 'Control weeds by manually removing them or by using herbicides.', 'Weed-control-toor-dal.jpg', 4),
(40, 8, 'Pests and disease control', 'Monitor the crop regularly for pests and diseases and use appropriate measures to control them.', 'Pests- and disease-toor-dal-control.jpg', 4),
(41, 9, 'Harvesting', 'Harvest the crop when the pods turn yellow or brown and the seeds inside are fully mature.: Harvest the crop when the pods turn yellow or brown and the seeds inside are fully mature.', 'Harvesting-toor.jpg', 4),
(42, 10, 'Threshing', 'Threshing: Thresh the harvested crop to separate the seeds from the pods.', 'Threshing-toor.jpg', 4),
(43, 11, ' Drying and storage', ' Dry the seeds in the sun for a few days, and then store them in a cool and dry place', 'Drying-and-storage-toor-dal.jpg', 4),
(44, 1, 'Soil preparation', ' Red lentils prefer well-draining, fertile soil. Before planting, work compost or well-rotted manure into the soil to improve its quality.', 'red_lentil land preparation.jpeg', 5),
(45, 2, 'Planting', ' Red lentils are typically sown in early spring, as soon as the soil can be worked. Sow the seeds about 1 inch deep and 2 inches apart, in rows that are about 18 inches apart.', 'Planting_red lentils.jpeg', 5),
(46, 3, 'Watering', ' Red lentils require consistent moisture throughout the growing season, so water regularly. However, be careful not to overwater, as this can lead to root rot.', 'Watering_red lentil.jpeg', 5),
(47, 4, 'Fertilizing', ' Lentils are nitrogen-fixing plants, which means they can extract nitrogen from the air and convert it into a form that can be used by the plant. However, if your soil is poor in nutrients, you may want to supplement with a balanced fertilizer.', 'Fertilizing_red lentil.webp', 5),
(48, 5, 'Harvesting', ' Red lentils are typically ready for harvest about 100-110 days after planting. The plants will turn yellow and the leaves will start to fall off. When the plants are fully mature, cut them down at ground level and allow them to dry for a few days. Then, thresh the pods to remove the seeds.', 'Harvesting_red lentil.webp', 5),
(49, 6, 'Storage', ' Store the lentils in a cool, dry place in an airtight container. They will keep for up to a year.', 'Storage_red-lentils.jpg', 5),
(50, 1, 'Land preparation', 'The first step in green moong cultivation is to prepare the land for planting. This involves plowing, discing, and harrowing the soil to create a seedbed that is free of weeds, rocks, and other debris. The land is then leveled and irrigated as needed.', 'Land preparation_green moong.jpeg', 6),
(51, 2, 'Seed selection and treatment', 'High-quality seeds that are free of disease and pests are selected for planting. The seeds may also be treated with fungicides or insecticides to protect them from pests and diseases.', 'Seed selection and treatment_green moong.webp', 6),
(52, 3, 'Planting', ' Green moong is typically planted during the monsoon season, between June and July. The seeds are planted in rows or broadcasted evenly over the prepared seedbed. The seeds are then covered with soil and irrigated.', 'Planting_green moong.jpg', 6),
(53, 4, 'Fertilization', ' Depending on the soil nutrient levels, additional fertilizers may be added to the soil to ensure optimal growth and yield. Green moong responds well to organic fertilizers such as compost or manure.', 'Fertilization-toor-dl.jpg', 6),
(54, 5, 'Irrigation', ' Green moong requires adequate water to grow and produce a good yield. Depending on the soil type and weather conditions, irrigation may be necessary at regular intervals.', 'Irrigation_green mong.webp', 6),
(55, 6, 'Weed control', ' Weeds can compete with green moong for nutrients, water, and sunlight. To control weeds, manual or mechanical weeding can be done or herbicides can be used.', 'Weed control_green moong.jpg', 6),
(56, 7, 'Pest and disease control', 'Green moong is susceptible to a variety of pests and diseases. Integrated pest management (IPM) strategies can be used to control pests, such as using resistant varieties, crop rotation, and the use of bio-pesticides. Fungicides can also be used to control diseases such as powdery mildew and rust.', 'Pests- and disease-toor-dal-control.jpg', 6),
(57, 8, 'Harvesting', ' Green moong is typically harvested 60-90 days after planting, when the plants have reached maturity and the pods have turned yellow. The plants are cut and left to dry in the field before threshing and separating the seeds.', 'harvesting_green moong.jpg', 6),
(58, 9, 'Post-harvest processing', 'The seeds are cleaned, dried, and stored in a cool and dry place until they are ready for consumption or further processing', 'Post-harvest processing_green moong.jpeg', 6),
(59, 1, 'plant the seeds', 'perpare seed starters by filling them with potting soil.with your finger,make a 12 inch(1.3cm)hole in the center of each seed starter cell.drop two or three cabbage seeds into each hole,and cover the hole with soil. ', 'aid1317927-v4-728px-Plant-Cabbage-Step-2-Version-3.jpg.jpeg', 12),
(60, 2, 'Maintain the temperature', 'once you plant the seeds,add enough water to soil to make it moist maintain the temperature.cabbage sedds germinate when the temperature is beetween 65 and 75 f(18 and 24C).store them inside or in a garden shed where the temperature will be maintained in this range.once the seeds come up,move them to a place that gets plenty of sunlight,like a south facing window.  ) ', 'aid1317927-v4-728px-Plant-Cabbage-Step-4-Version-3.jpg.jpeg', 12),
(61, 3, 'Keep the seedlings inside until leaves form', 'As the cabbage seeds germinate and start to grow, sprouts will shoot up through the soil. Keep the cabbage seedlings inside until they are three to four inches tall, and have at least four or five leaves eacThe seedlings will take between four and six weeks to grow to this stage.h.', 'aid1317927-v4-728px-Plant-Cabbage-Step-5-Version-3.jpg.jpeg', 12),
(62, 4, 'Determine when the last frost will be', 'It’s best to transplant cabbage to its outdoor location about two to three weeks prior to the last frost. Check the long-range weather forecast for your area to determine this dFor fall plantings, set the plants out 6-8 weeks before the average first frost date of the year. For fall plantings, set the plants out 6-8 weeks before the average first frost date of the year.', 'aid1317927-v4-728px-Plant-Cabbage-Step-6-Version-2.jpg.jpeg', 12),
(63, 5, 'pick the right location', 'There are a few things that cabbages need to thrive, and sunlight is one of them. When choosing an outdoor location for your cabbage, look for somewhere that gets at least six hours of full sun each day.', 'aid1317927-v4-728px-Plant-Cabbage-Step-7-Version-2.jpg.jpeg', 12),
(64, 6, 'prepare the seedback', 'The ideal pH for cabbage is between 6.5 and 7.5. You can test the pH of your soil with test strips, which are available at most department, garden, and hardware stores.mix the fertile soil in your seedbed with equal parts aged compost or manure. Water the bed so the soil is moist before transplanting the seedlings.', 'aid1317927-v4-728px-Plant-Cabbage-Step-8-Version-2.jpg.jpeg', 12),
(65, 7, 'transplant the cabbage seedling', 'Plant the seedlings at the same depth they were in the pots, about a ½ inch (1.3 cm) deep. Space them 12 to 24 inches (30 to 61 cm) apart, and in rows that are about 24 inches (61 cm) apart.', 'aid1317927-v4-728px-Plant-Cabbage-Step-9-Version-2.jpg.jpeg', 12),
(66, 8, 'cover the soil with mulch', 'Add a 1-inch (2.5-cm) layer of mulch to the top of the soil. This will help keep the soil moist as the seedlings grow, protect the plants from pests, and help regulate the temperature of the soil. The ideal mulch for cabbage includes ground leaves, finely ground bark, or compost.', 'aid1317927-v4-728px-Plant-Cabbage-Step-10-Version-2.jpg.jpeg', 12),
(67, 9, 'keep the soil moist', 'Cabbage plants will need about 1.5 inches (3.8 cm) of water each week. If you are notgetting enough rain, water the soil enough to keep it moist as the cabbages grow. Continue watering the cabbages until the plants approach maturity. At that time, stop watering them to prevent split heads.', 'aid1317927-v4-728px-Plant-Cabbage-Step-11-Version-2.jpg.jpeg', 12),
(68, 10, 'fertilize three weeks after transplanting', 'When the cabbages start to grow new leaves and develop heads, amend the soil with fertilizer. This will happen about three weeks after transplanting, and at this time, the cabbages will need nitrogen-rich fertilizer. Good fertilizers for a cabbage patch include fish emulsions, liquid fertilizers, blood meal, and cottonseed meal.', 'aid1317927-v4-728px-Plant-Cabbage-Step-12-Version-2.jpg.jpeg', 12),
(69, 11, 'pay attention to growing time', 'Cabbage growing time depends on the variety, but it can take anywhere from 80 to 180 days for a cabbage to mature after the seed is planted. After transplanting the seedlings, the cabbages will need anywhere from 60 to 105 days to mature', 'aid1317927-v4-728px-Plant-Cabbage-Step-13-Version-2.jpg.jpeg', 12),
(70, 12, 'do a sqeeze test', 'When the cabbages start to mature, you can start doing squeeze tests on the heads to determine if they are ready for harvest. The base of the head should be between 4 and 10 inches (10.2 to 25.4 cm) across, depending on the variety. To do the squeeze test, squeeze the head of the cabbage with your hand. A solid and firm head is ready for harvest, but a loose and soft head needs more time to mature.', 'aid1317927-v4-728px-Plant-Cabbage-Step-14-Version-2.jpg.jpeg', 12),
(71, 13, 'harvest the heads', 'When the cabbages start to mature, you can start doing squeeze tests on the heads to determine if they are ready for harvest. The base of the head should be between 4 and 10 inches (10.2 to 25.4 cm) across, depending on the variety. To do the squeeze test, squeeze the head of the cabbage with your hand. A solid and firm head is ready for harvest, but a loose and soft head needs more time to mature.', 'aid1317927-v4-728px-Plant-Cabbage-Step-15-Version-2.jpg.jpeg', 12),
(72, 1, 'choose sedds potato', 'Start with organic, certified disease-free seed potatoes obtained from a catalog or farm store. (Grocery store potatoes that have been treated with a sprout-retardant are not suitable for planting.) If you buy from a farm store, try to select tubers which have already sprouted. Otherwise, pre-sprout them by simply laying them out on your kitchen counter. Pre-sprouted potatoes can be harvested a few weeks earlier than their non-sprouted kin.', 'garden-design_6660.webp', 13),
(73, 2, 'separate the eyes', 'Only small, golf ball-sized potatoes should be planted whole.  Cut large tubers into pieces so that each segment has two or three \"eyes\" (the little bumps from which sprouts emerge, as shown in the photo). The reason for cutting the potatoes is because the many eyes on a large potato will create a crowded, multi-stemmed plant, with each stem competing for food and moisture, and in the end, bearing only small potatoes.', 'garden-design_6661.webp', 13),
(74, 3, 'cure the cut pieces', 'Next, \"cure\" the cut pieces. Either set them out in the sun, or place them on a table or counter in a warm (about 70°F), moderately lit room for three to five days. This step permits the cuts to become calloused. Calloused seed potatoes will help prevent rot.', 'garden-design_6665.webp', 13),
(75, 4, 'how to plant potato', 'Plant seed potato segments cut-side down (eyes up) in a 6-inch-deep hole or trench. Space each segment 12-inches apart on all sides.  Between each segment, sprinkle 2 tablespoons of a low-nitrogen, high-phosphorous fertilizer. Then cover both potatoes and fertilizer with 2-inches of soil, and water the soil well.', 'garden-design_6656.jpg', 13),
(76, 5, 'hill around the strems', ' new potatoes form on lateral stems, or \"stolons\" above the seed potato, it’s necessary to \"hill\" the vines. When the green sprouts achieve 8 inches in height, bury all but their top 4 inches with soil, chopped straw, or shredded leaves. Hill again when potato plants grow another 8 inches. The more you hill, the more prolific your harvest is likely to be. I usually hill mine to a height of 18 inches. Stop hilling when the vines flower.', 'garden-design_6658.jpg', 13),
(77, 6, ' when to harvest potato', 'Two weeks after the vines have flowered,wait until the vines die back. Dead vines signal that the tubers have reached maturity. Small new potatoes can be ready as early as ten weeks. However, full sized potatoes take about 80-100 days to reach maturity.', 'garden-design_6666.jpg', 13),
(78, 7, 'harvesting the potato', 'Potatoes are harvested through modern potato harvesting machines that are attached to tractors. The machines harvest by lifting the potatoes from the bed using a share. Soil, dirt, rocks and potatoes are transferred onto a series of webs where the potatoes are finally separated from the foreign materials.', 'harvesting_potatoes.jpg', 13),
(79, 1, 'Land preparation', 'The first step in brinjal farming is to prepare the land for cultivation. The land should be ploughed, leveled, and made ready for planting. The soil should be fertile and well-drained to ensure optimal growth of the brinjal plants.', 'images (1).jpeg', 14),
(80, 2, ' Seed selection and sowing', 'in this stepto select good quality brinjal seeds. The seeds should be healthy and disease-free. They can be sown directly in the field or in a nursery. If sowing directly in the field, make sure to space the seeds at least 45-60 cm apart. If sowing in a nursery, plant the seeds in trays or pots and transplant them once they reach a height of 10-12 cm.', 'download (1).jpeg', 14),
(81, 3, 'irrigation', 'Water is essential for the growth of brinjal plants. Make sure to irrigate the field regularly, especially during the early stages of growth. Irrigation should be done in such a way that the water reaches the roots of the plants.', 'depositphotos_237036288-stock-photo-drip-irrigation-system-growing-pepper.jpg', 14),
(82, 4, 'fertilizer application ', 'Water is essential for the growth of brinjal plants. Make sure to irrigate the field regularly, especially during the early stages of growth. Irrigation should be done in such a way that the water reaches the roots of the plants.', 'EU_CUBtU0AEV45z.jpg_large', 14),
(83, 5, 'Pruning and staking', 'As the brinjal plants grow taller, they need support to prevent them from falling over. Staking or trellising can be done to provide support to the plants. Pruning can also be done to remove any unwanted branches or leaves.', 'download (2).jpeg', 14),
(84, 6, 'harvesting', 'Brinjal plants start bearing fruit around 60-70 days after sowing. The fruit should be harvested when they are fully grown but before they become overripe. The fruit should be cut with a sharp knife or scissors, taking care not to damage the plant.', 'hand-picking-organic-eggplant-aubergine-or-brinjal-in-the-greenhouse-2M5XAHA.jpg', 14);

-- --------------------------------------------------------

--
-- Table structure for table `machinary`
--

CREATE TABLE `machinary` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `img_src` varchar(300) NOT NULL,
  `machine_desc` varchar(6000) NOT NULL,
  `crop_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `machinary`
--

INSERT INTO `machinary` (`id`, `name`, `img_src`, `machine_desc`, `crop_id`) VALUES
(2, 'Tractor', 'tractor_paddy_machinery.webp', 'A tractor is used for plowing, leveling, and land preparation. It is also used for transporting various equipment and materials needed in paddy cultivation.', 1),
(3, 'Power Tiller: ', 'powertiller_paddy_machinery.jpg', 'A power tiller is a smaller version of a tractor, used for plowing, tilling, and leveling small plots of land. It is usually operated manually.', 1),
(4, 'Rice Transplanter ', 'Transplanter_paddy_machinery.jpg', 'A rice transplanter is used for transplanting rice seedlings into the field. It can plant up to 6 rows of seedlings at a time and can cover a larger area in a shorter period compared to manual transplanting.', 1),
(5, 'Combine Harvester ', 'combine harvester_paddy_machinery.jpg', 'A combine harvester is a machine that is used for harvesting rice. It can cut, thresh, and clean the rice grains in one process. It saves time and labor and is a more efficient method of harvesting compared to manual harvesting.', 1),
(6, 'Threshing Machine', 'Threshing Machine_paddy_machinery.jpg', 'A threshing machine is used to separate the rice grains from the husk. It is usually powered by an engine or a tractor and can thresh large quantities of rice in a short period.', 1),
(7, 'Tractors', 'tractor_paddy_machinery.webp', 'Tractors are used for a variety of tasks in wheat farming, including plowing, harrowing, planting, and harvesting. They can be equipped with various attachments and implements to perform different tasks.', 2),
(8, 'Seed drills', 'seed-drills-wheat.jpg', 'Seed drills are used to plant wheat seeds in rows at a consistent depth and spacing. They can be operated manually or attached to a tractor for larger fields.', 2),
(9, 'Combine harvesters', 'combine harvester-wheat.jpg', 'Combine harvesters, also known as combine harvesters or combines, are used to harvest mature wheat. They cut and thresh the wheat, separating the grain from the straw and chaff.', 2),
(10, 'Grain carts', 'Grain carts-wheat.jpg', 'Grain carts are used to transport the harvested wheat from the combine to storage bins or trucks for transport to the market. They can range in size from small trailers pulled by a tractor to large self-propelled machines', 2),
(11, 'Sprayers ', 'Sprayers-wheat.jpg', 'Sprayers are used to apply herbicides, pesticides, and fertilizers to the wheat crop to control weeds and pests and promote healthy growth.', 2),
(12, 'Tillage equipment', 'Tillage equipment-wheat.jpg', 'Tillage equipment, such as plows and cultivators, are used to prepare the soil for planting and to control weeds and pests throughout the growing season.', 2),
(13, 'Tractors', 'tractor_paddy_machinery.webp', 'Tractors are used for various tasks, such as plowing, harrowing, planting, and harvesting maize. They can be equipped with various attachments and implements to perform different tasks.', 3),
(14, 'Planters', 'Planters-maize.jpg', 'Planters are used to sow maize seeds in rows at a consistent depth and spacing. They can be operated manually or attached to a tractor for larger fields.', 3),
(15, 'Sprayers', 'Sprayers-maize.jpg', 'Sprayers are used to apply herbicides, pesticides, and fertilizers to the maize crop to control weeds and pests and promote healthy growth.', 3),
(16, 'Irrigation equipment', 'maize-corn-irrigation.jpg', 'Irrigation equipment, such as sprinklers and drip irrigation systems, are used to provide water to the maize crop during the growing season.', 3),
(17, 'Harvesters', 'Harvesters-maize.jpg', 'There are different types of harvesters used for maize farming, including corn pickers, which pick and husk the maize ears, and combine harvesters, which cut and thresh the maize, separating the grain from the husks.', 3),
(18, 'Grain carts', 'Grain carts-maize.jpg', 'Grain carts are used to transport the harvested maize from the harvester to storage bins or trucks for transport to the market. They can range in size from small trailers pulled by a tractor to large self-propelled machines.', 3),
(19, 'Tillage equipment', 'Tillage equipment-maize.jpg', 'Tillage equipment, such as plows and cultivators, are used to prepare the soil for planting and to control weeds and pests throughout the growing season.', 3),
(20, 'Tractor', 'tractor_paddy_machinery.webp', ' Tractors are used to plow and prepare the land for sowing toor dal seeds. They can also be used for irrigation, harvesting, and transport of the crop.', 4),
(21, 'Seed drill', 'seed-drills-wheat.jpg', ' Seed drills are used to sow toor dal seeds in a uniform and precise manner. They are mounted on tractors and can cover a large area in a short time.', 4),
(22, 'Fertilizer applicator', 'Fertilizer applicator-toor.jpg', ' Fertilizer applicators are used to apply fertilizers like urea, superphosphate, and potash to the toor dal crop. They are mounted on tractors and can distribute the fertilizers uniformly across the field.', 4),
(23, 'Sprayer', 'Sprayer-toor-dal.jpg', 'Sprayers are used to apply pesticides and fungicides to the toor dal crop to control pests and diseases. They can be mounted on tractors or carried manually.', 4),
(24, 'Thresher', 'thresher-toor.jpg', 'Threshers are used to separate the toor dal seeds from the pods after harvesting. They can be tractor-mounted or stationary and can process a large quantity of crop in a short time.', 4),
(25, ' Winnowing machine', 'Winnowing machine.jpg', 'Winnowing machines are used to separate the toor dal seeds from the chaff and other impurities. They work by blowing air through the mixture of seeds and chaff, which separates them based on weight.', 4),
(26, ' Combine harvester', 'Combine harvester.jpg', ' Combine harvesters are used to harvest and thresh the toor dal crop in a single operation. They are self-propelled machines that can cut, thresh, and clean the crop in a single pass.', 4),
(27, 'Tractors', 'tractor_paddy_machinery.webp', 'Tractors are commonly used in lentil farming for tasks such as plowing, tilling, planting, and harvesting. They may be equipped with a variety of implements such as plows, disc harrows, cultivators, seeders, and combine harvesters.', 5),
(28, 'Seed drills', 'Seed drills_red lentil.jpeg', ' Seed drills are used for planting lentil seeds at a uniform depth and spacing. They can be attached to a tractor or used as a standalone machine.', 5),
(29, 'Sprayers', 'Sprayers_red lentil.jpeg', ' Sprayers are used to apply pesticides, fungicides, or other liquid fertilizers to the crop. They may be mounted on a tractor or towed behind it.', 5),
(30, ' Grain dryers', 'Grain dryers_red lentil.jpeg', ' Grain dryers are used to remove excess moisture from the lentil seeds after harvest, which helps to prevent spoilage and improve storage quality.', 5),
(31, 'Irrigation equipment', 'Irrigation equipment_red lentil.jpg', ' Depending on the local climate and rainfall patterns, farmers may use irrigation equipment such as drip irrigation, sprinklers, or flood irrigation to provide water to the crop.', 5),
(32, 'Tractor', 'tractor_paddy_machinery.webp', 'A tractor is often used for plowing, tilling, and leveling the land before planting green moong seeds. It can also be used for applying fertilizers and pesticides.', 6),
(33, 'Seed drill', 'Seed drills_red lentil.jpeg', 'A seed drill is a machine used for planting seeds in rows at a uniform depth and spacing. It can help to optimize seed placement and reduce seed waste.', 6),
(34, 'Sprayer', 'Sprayers_red lentil.jpeg', 'A sprayer is used for applying pesticides and fertilizers to green moong plants. It can be operated manually or attached to a tractor for larger fields.', 6),
(35, 'Harvester', 'Harvester_green moong.jpeg', ' A harvester is used for harvesting green moong pods once they are mature. There are different types of harvesters available, including tractor-mounted harvesters, self-propelled harvesters, and combine harvesters.', 6),
(36, 'Thresher', 'Threshers_red lentil.jpeg', ' A thresher is used for separating the green moong seeds from the pods after harvesting. It can help to increase the efficiency of the harvesting process.', 6),
(37, 'Winnowing machine', 'Winnowing machine.jpg', ' A winnowing machine is used for separating the green moong seeds from the chaff and other debris after threshing. It can help to improve the quality and purity of the seeds.', 6),
(38, 'Threshers', 'thresher-toor.jpg', 'Threshers are used to separate the lentil seeds from the plant material after harvesting. They can be either stationary or mobile, and may be powered by electricity or a tractor\'s power take-off (PTO).', 5),
(39, 'cabbage harvester', 'WP_20161011_11_09_49_Pro_LI.jpg', 'A cabbage harvester is a type of agricultural equipment used to mechanically harvest cabbage crops from the field.', 12),
(40, 'cultivator', 'download.jpeg', 'to improve soil structure', 13),
(41, 'pesticide boom sprayer', 'boom-sprayer-22-1593846125.jpg', 'to spery pesticide on crop', 13),
(42, 'potato digger machine', 'agricultural-potato-digger-1000x1000.webp', 'to dig potato from land', 13),
(43, 'tractor', 'Sugar-cane-farmer-land-prepartion.jpg', ' tractor can be used for land preparation, such as plowing, leveling, and harrowing. Tractors can also be used to pull other machinery like cultivators, seed drills, and spray machines.', 14),
(44, 'Irrigation equipment ', 'pm-sinchai-yojana.webp', ' Different types of irrigation equipment like drip irrigation, sprinklers, and flood irrigation can be used to ensure proper water supply to the plants. ', 14),
(45, 'Fertilizer applicator ', 'H398b1611fdda4c94bc7e5c768cabdb61X.jpg', ' A fertilizer applicator can be used to apply fertilizers to the soil. This machine can help to ensure uniform distribution of nutrients and reduce waste.', 14);

-- --------------------------------------------------------

--
-- Table structure for table `pesticides`
--

CREATE TABLE `pesticides` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `pesticide_desc` varchar(6000) NOT NULL,
  `img_src` varchar(200) NOT NULL,
  `diseases` varchar(300) NOT NULL,
  `crop_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesticides`
--

INSERT INTO `pesticides` (`id`, `name`, `pesticide_desc`, `img_src`, `diseases`, `crop_id`) VALUES
(2, 'Chlorpyrifos', 'This is a broad-spectrum insecticide that is used to control a wide range of pests such as aphids, leafhoppers, and rice stem borers.', 'Chlorpyrifos_paddy pesticide.png', ' Aphids, leafhoppers, and rice stem borers.', 1),
(3, 'Glyphosate', 'This is a broad-spectrum herbicide that is used to control weeds in paddy fields.', 'glyphosate_paddy fertilizer.jpg', 'weeds', 1),
(4, 'Carbofuran', 'This is also an insecticide that is used to control pests such as rice root aphids, planthoppers, and stem borers.', 'Carbofuran_paddy fertilizer.jpeg', 'Rice root aphids, planthoppers, and stem borers.', 1),
(5, 'Propiconazole', 'This is a fungicide that is used to control fungal diseases such as rice blast and sheath blight.', 'propiconazole_paddy fertilizer.jpg', 'Fungal diseases such as rice blast and sheath blight.', 1),
(6, 'Herbicides', 'These are used to control weeds that compete with the wheat plants for nutrients and water. Common herbicides used in wheat cultivation include glyphosate, 2,4-D, and dicamba.', 'pesticide_wheat.jpg', ' Control weeds  ', 2),
(7, 'Insecticides', 'These are used to control insect pests that can damage the wheat crop, such as aphids, armyworms, and wireworms. Common insecticides used in wheat cultivation include pyrethroids, neonicotinoids, and organophosphates.', 'insectisides-wheat.webp', 'aphids, armyworms, and wireworms', 2),
(8, 'Fungicides', 'These are used to control fungal diseases that can affect the wheat crop, such as powdery mildew, rusts, and fusarium head blight. Common fungicides used in wheat cultivation include triazoles, strobilurins, and benzimidazoles.', 'fungicides-wheat.webp', ' fungal diseases that can affect the wheat crop, such as powdery mildew, rusts, and fusarium head blight.', 2),
(9, 'Insecticides', ' Insecticides are used to control insects that can damage maize crops, such as corn borers, armyworms, and aphids. Some examples of insecticides used in maize farming include pyrethroids, organophosphates, and neonicotinoids.', 'maize-Insecticides.jpg', ' damage maize crops ,corn borers, armyworms, and aphids', 3),
(10, 'Fungicides', 'Fungicides are used to control fungal diseases that can damage maize crops, such as rust, smut, and gray leaf spot. Some examples of fungicides used in maize farming include triazoles, strobilurins, and benzimidazoles.: Fungicides are used to control fungal diseases that can damage maize crops, such as rust, smut, and gray leaf spot. Some examples of fungicides used in maize farming include triazoles, strobilurins, and benzimidazoles.', 'fungicides_maize.jpg', ' such as rust, smut, and gray leaf spot. Some examples of fungicides used in maize farming include triazoles, strobilurins, and benzimidazoles.: Fungicides are used to control fungal diseases that can damage maize crops, such as rust, smut, and gray leaf spot', 3),
(11, 'Herbicides', 'Herbicides are used to control weeds that can compete with maize crops for nutrients and water. Some examples of herbicides used in maize farming include glyphosate, atrazine, and acetochlor.', 'herbicides.jpeg', 'weeds', 3),
(12, 'Rodenticides', 'Rodenticides are used to control rodents, such as mice and rats, that can damage maize crops by feeding on them or their stored grain', 'Rodenticides.jpeg', 'control rodents', 3),
(13, 'Insecticides', 'To control insect pests like pod borer, stem fly, and aphids, farmers use insecticides like chlorpyrifos, thiamethoxam, and imidacloprid. These insecticides are usually sprayed on the crop during the vegetative and flowering stages of growth.', 'thiamethoxam-insecticides.jpg', ' control insect pests like pod borer, stem fly, and aphids', 4),
(14, 'Fungicides', ' To control fungal diseases like leaf spot and blight, farmers use fungicides like carbendazim, propiconazole, and mancozeb. These fungicides are generally sprayed on the crop during the early stages of growth and at the onset of the disease.', 'Fungicides-toor.jpg', 'control fungal diseases like leaf spot and blight', 4),
(15, 'Herbicides', ' To control weeds in the toor dal crop, farmers use herbicides like glyphosate, paraquat, and 2,4-D. These herbicides are generally sprayed on the crop after the emergence of weeds but before the flowering stage of growth.', 'herbicides-toor-dal.jpg', 'To control weeds in the toor dal', 4),
(16, 'Pyrethroids', ' These are synthetic insecticides that are commonly used to control a range of insect pests, including aphids, thrips, and weevils.', 'Pyrethroids pesticide_red lentil.jpeg', 'Insect pests, including aphids, thrips, and weevils.', 5),
(17, 'Neonicotinoids', ' These are systemic insecticides that are absorbed by the plant and can provide long-lasting control of pests like aphids and whiteflies.', 'Neonicotinoids_red lentil.jpeg', 'Can provide long-lasting control of pests like aphids and whiteflies.', 5),
(18, 'Fungicides', ' Various fungicides are used to control fungal diseases such as Ascochyta blight, which can be a significant problem in lentil crops.', 'Fungicides_red lentil.jpeg', 'Ascochyta blight, which can be a significant problem in lentil crops.', 5),
(19, 'Aphids', 'Aphids are small, soft-bodied insects that feed on the sap of green moong plants, causing stunted growth and deformities. Pesticides such as neem oil, pyrethroids, and imidacloprid can be used to control aphids.', 'Aphids_green moong.webp', 'Small, soft-bodied insects that feed on the sap of green moong plants', 6),
(20, ' Leafhoppers ', ' Leafhoppers are small, winged insects that suck the sap from green moong leaves, causing yellowing and curling. Pesticides such as neem oil, pyrethroids, and imidacloprid can be used to control leafhoppers.', 'Leafhoppers_green moong.jpg', 'Small, winged insects that suck the sap from green moong leaves, causing yellowing and curling', 6),
(21, 'Pod borers', ' Pod borers are caterpillars that feed on the inside of green moong pods, causing them to turn yellow and wither. Pesticides such as Bacillus thuringiensis (Bt), cypermethrin, and fenvalerate can be used to control pod borers.', 'Pod borers_green moong.jpg', 'Causing them to turn yellow and wither', 6),
(22, 'Whiteflies', ' Whiteflies are small, winged insects that feed on the underside of green moong leaves, causing yellowing and wilting. Pesticides such as neem oil, pyrethroids, and imidacloprid can be used to control whiteflies.', 'Whiteflies_green moong.jpg', 'Causing yellowing and wilting', 6),
(23, 'Bacillus amyloliquefaciens and Bacillus subtilis.', 'this bactrial pesticide is effective against cabbage worms and other caterpillar pests.', 'bacillus-subtilis-1000x1000.webp', 'Alternaria Leaf Spot', 12),
(24, 'Bonide Fung-onil Fungicide', 'Removing infected plants and destroying all crop debris will help prevent the spread of this pathogen.', 'Bonide-Fungonil.jpg', 'ring spot', 12),
(25, 'Vitavax Power', 'Vitavax Power  (Carboxin 37.5% + Thiram 37.5% DS) is a broad spectrum, dual action (systemic and contact) fungicide which controls seed and soil borne diseases, and also acts as plant growth stimulant.', 'qrw7XHvhFosoxEGWRyjn.png', 'black scruf and stem canker', 13),
(26, 'sixer', 'Sixer is a scientific combination of Mancozeb 63%Wp which is a contact fungicide of the dithiocarbamate group and Carbendazim 12%Wp which is a systemic fungicide of Benzimidazole carbamate group.', 'JyiHSNjWeQ7t0FglhNoo.png', 'early blight', 13);

-- --------------------------------------------------------

--
-- Table structure for table `queries`
--

CREATE TABLE `queries` (
  `id` int(11) NOT NULL,
  `farmer_id` int(11) NOT NULL,
  `date_created` varchar(100) NOT NULL,
  `query_desc` varchar(10000) NOT NULL,
  `img_src` varchar(500) DEFAULT NULL,
  `crop_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'open'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `response`
--

CREATE TABLE `response` (
  `id` int(11) NOT NULL,
  `query_id` int(11) NOT NULL,
  `expert_id` int(11) NOT NULL,
  `date_answered` varchar(100) NOT NULL,
  `responce_desc` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crop`
--
ALTER TABLE `crop`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `crop_ibfk_1` (`category_id`);

--
-- Indexes for table `crop_category`
--
ALTER TABLE `crop_category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `expertise`
--
ALTER TABLE `expertise`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD KEY `expertise to Crop id` (`crop_id`);

--
-- Indexes for table `farmers`
--
ALTER TABLE `farmers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fertilizer`
--
ALTER TABLE `fertilizer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Fertilizer to CropId` (`crop_id`);

--
-- Indexes for table `harvest_step`
--
ALTER TABLE `harvest_step`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ForeignKey` (`crop_id`);

--
-- Indexes for table `machinary`
--
ALTER TABLE `machinary`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Machinary to Crop id` (`crop_id`);

--
-- Indexes for table `pesticides`
--
ALTER TABLE `pesticides`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Pesticide Crop id` (`crop_id`);

--
-- Indexes for table `queries`
--
ALTER TABLE `queries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Farmer's id Foreign Key` (`farmer_id`),
  ADD KEY `Crop_id Foreign Key` (`crop_id`);

--
-- Indexes for table `response`
--
ALTER TABLE `response`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `query_id` (`query_id`),
  ADD KEY `Expert Id Foreign Key` (`expert_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crop`
--
ALTER TABLE `crop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `crop_category`
--
ALTER TABLE `crop_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `expertise`
--
ALTER TABLE `expertise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `farmers`
--
ALTER TABLE `farmers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `fertilizer`
--
ALTER TABLE `fertilizer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `harvest_step`
--
ALTER TABLE `harvest_step`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `machinary`
--
ALTER TABLE `machinary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `pesticides`
--
ALTER TABLE `pesticides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `queries`
--
ALTER TABLE `queries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `response`
--
ALTER TABLE `response`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `crop`
--
ALTER TABLE `crop`
  ADD CONSTRAINT `crop_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `crop_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `expertise`
--
ALTER TABLE `expertise`
  ADD CONSTRAINT `expertise to Crop id` FOREIGN KEY (`crop_id`) REFERENCES `crop` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `fertilizer`
--
ALTER TABLE `fertilizer`
  ADD CONSTRAINT `Fertilizer to CropId` FOREIGN KEY (`crop_id`) REFERENCES `crop` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `harvest_step`
--
ALTER TABLE `harvest_step`
  ADD CONSTRAINT `ForeignKey` FOREIGN KEY (`crop_id`) REFERENCES `crop` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `machinary`
--
ALTER TABLE `machinary`
  ADD CONSTRAINT `Machinary to Crop id` FOREIGN KEY (`crop_id`) REFERENCES `crop` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pesticides`
--
ALTER TABLE `pesticides`
  ADD CONSTRAINT `Pesticide Crop id` FOREIGN KEY (`crop_id`) REFERENCES `crop` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `queries`
--
ALTER TABLE `queries`
  ADD CONSTRAINT `Crop_id Foreign Key` FOREIGN KEY (`crop_id`) REFERENCES `crop` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Farmer's id Foreign Key` FOREIGN KEY (`farmer_id`) REFERENCES `farmers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `response`
--
ALTER TABLE `response`
  ADD CONSTRAINT `Expert Id Foreign Key` FOREIGN KEY (`expert_id`) REFERENCES `expertise` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Query Id Foreign Key` FOREIGN KEY (`query_id`) REFERENCES `queries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
