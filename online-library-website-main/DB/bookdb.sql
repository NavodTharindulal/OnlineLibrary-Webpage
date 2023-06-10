-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2022 at 06:29 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `last_login` datetime NOT NULL,
  `regi_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `first_name`, `last_name`, `email`, `password`, `is_deleted`, `last_login`, `regi_date`) VALUES
(1000, 'admin', 'Smith', 'admin@gmail.com', 'e663d1c3ebb985d2feede8175a936a82c7ea27c4', 0, '2022-03-12 10:54:38', '2022-02-06 07:02:54');

-- --------------------------------------------------------

--
-- Table structure for table `book_category`
--

CREATE TABLE `book_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_category`
--

INSERT INTO `book_category` (`id`, `category_name`, `time`, `is_deleted`) VALUES
(102050040, 'Biography', '2022-03-11 12:17:34', 0),
(102050041, 'Wild Life', '2022-03-11 12:19:23', 0),
(102050042, 'New Arrivals', '2022-03-11 13:18:32', 0),
(102050043, 'Historical', '2022-03-11 13:22:45', 0);

-- --------------------------------------------------------

--
-- Table structure for table `book_list`
--

CREATE TABLE `book_list` (
  `id` int(11) NOT NULL,
  `book_image` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `book_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `book_category` int(11) NOT NULL,
  `description` varchar(1600) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `book_price` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_list`
--

INSERT INTO `book_list` (`id`, `book_image`, `book_name`, `book_category`, `description`, `book_price`, `time`, `is_deleted`) VALUES
(102050050, '622b3bdb8ca31-1647000539.jpg', 'MAGE INIMA ROSHAN MAHANAMA', 102050040, 'Former Sri Lanka cricketer and ICC match referee Roshan Mahanama autobiography takes us on journey from his early childhood, playing school cricket, challenges as a teenager and breaking into the national side. In addition to his cricketing journey, it also elaborates on personal milestones highlights his experiences, thoughts, and opinions in retrospect of enjoying the Best View of the Game as an ICC Elite Panel Match Referee, an Administrator, a Coach and most importantly as a Father, a Grandfather and a Responsible citizen of the country.', 1250, '2022-03-11 12:08:59', 0),
(102050051, '622b3ca87c64a-1647000744.jpg', 'FINDING FREEDOM : HARRY AND MEGHAN AND', 102050040, 'When news of the budding romance between a beloved English prince and an American actress broke, it captured the worldâ€™s attention and sparked an international media frenzy. When news of the budding romance between a beloved English prince and an American actress broke, it captured the worldâ€™s attention and sparked an international media frenzy. But while the Duke and Duchess of Sussex have continued to make headlines â€“ from their engagement, wedding, and birth of their son Archie to their unprecedented decision to step back from their royal lives â€“ few know the true story of Harry and Meghan. For the very first time, FINDING FREEDOM goes beyond the headlines to reveal unknown details of Harry and Meghanâ€™s life together, dispelling the many rumours and misconceptions that plague the couple on both sides of the pond.', 2300, '2022-03-11 12:12:24', 0),
(102050052, '622b3d8492b89-1647000964.jpg', 'PHOTOGRAPHIC FIELD GUIDE TO THE AMPHIBIANS OF SRI LANKA', 102050041, 'A Photographic Field Guide to the Amphibians of Sri Lanka is a complete guide to the 120 species of frog, toad and caecilian found in Sri Lanka. Extinct species are also listed for completeness. With photographs from the authors, each species is illustrated with many variants.The general introduction includes details of the climate, geography and vegetation of the island, key characteristics that can be used in the identification of amphibians, information on amphibian conservation in Sri Lanka, a brief introduction to folklore and where to look for amphibians. The species descriptions include the common English name, the current scientific name, the vernacular name in Sinhala, a brief history of the species, a description with identification features, and details of habitat, habits and distribution\r\nADD TO CARTCONTINUE SHOPPING', 1250, '2022-03-11 12:19:57', 0),
(102050053, '622b3f24aacd1-1647001380.jpg', 'GOTABAYA - ENGLISH', 102050040, 'Gotabaya Rajapaksa who hails from Sri Lankaâ€™s famous Rajapaksa political family, studied at Ananda College in Colombo, joined the Sri Lanka Army, and had a distinguished military career lasting twenty years, before emigrating to the U.S. In the latter half of 2005, following the election of his elder brother Mahinda Rajapaksa as the fifth executive president of Sri Lanka, he was appointed Secretary of Defense, whereupon he provided strategical and administrative leadership to end the thirty-year brutal terrorist war. After the conclusion of the war, Gotabaya was also appointed Secretary of the Urban Development Authority, subsequently displaying his abilities and exemplary work ethic to Sri Lankans, as he transformed the city of Colombo into the â€œmiracle of Asiaâ€. The Viyathmaga Organization which he formed by convening scholars, intellectuals and professionals from all over Sri Lanka gathered momentum, enabling their services to be utilised more effectively for the development and betterment of the nation. He won the presidential election in 2019 and the party headed by his brother Prime Minister Mahinda Rajapaksa and allies won a resounding two thirds majority at the general election in August 2020. For the knowledge of the public, this book unravels in detail the journey travelled by the fascinating man, known as Gotabaya.', 2000, '2022-03-11 12:23:00', 0),
(102050054, '622b3f85d4299-1647001477.jpg', 'LOVATA URUMA SADADARA JOTHI', 102050040, 'Author Mekala Wasundara Jayathilaka', 450, '2022-03-11 12:25:39', 0),
(102050055, '622b404153f5a-1647001665.jpg', 'SPEAKING FOR MYSELF', 102050040, 'The autobiography of the wife of the ex-premier of United Kingdom.', 2200, '2022-03-11 12:27:45', 0),
(102050056, '622b4092ddadd-1647001746.jpg', 'THE BUDDHA : AS IN EARLY BUDDHISM', 102050040, 'Author Ven. Dr . K. Sri Pemaloka', 380, '2022-03-11 12:29:06', 0),
(102050057, '622b40ff95a19-1647001855.jpg', 'BUDDHA CHARITHAYA', 102050040, 'Author John S Strong', 400, '2022-03-11 12:30:55', 0),
(102050058, '622b421c794e2-1647002140.jpg', 'QUIET MAVERICK : THE DR GAMINI WICKRAMASINGHE STORY', 102050040, 'When Garnini wants something done, he wants it done. Theres never an if, but, or cant. He problem solves on the run,finds opportunity in impossible spaces, speaks out for truth and justice, and is a fount of knowledge on any and every subject. ', 1200, '2022-03-11 12:36:58', 0),
(102050059, '622b42c619ec8-1647002310.jpg', 'PROMISE TOUCHED BY ANGELS IN DISGUISE', 102050040, 'growing up in the splendor of a beach side paradise teera Teera settled down in a good home with the love of her life, chandra and her two gorgeous children.teera world was nearly perfect, until the night her husband was violently murdered The assailant intended to kill her too but Teera survived to tell her story in her memoir Teera : A Life of Hope and Fulfillment. devasted by lost and disfgured by gruesome facial wound her infants still to care teera lethargically carried on an uphill climb attemting to conquer the hurdles in her life one step at a time', 500, '2022-03-11 12:38:47', 0),
(102050060, '622b4327434f7-1647002407.jpg', 'LONG WATCH (PAPERBACK EDITION)', 102050040, 'A Long Watch offers a story of human complexity amid entrenched narratives of Sri Lankas long civil war. Pulled from a dark ocean after a battle at sea, Commodore Boyagoda became the highest-ranking prisoner detained by the Tamil Tigers. For eight years, he lived at close quarters with his declared enemy, his imprisonment punctuated by high-level talks about his fate, but also by extended conversations with his jailers and scratch games of badminton played in jungle clearings. ', 1225, '2022-03-11 12:40:36', 0),
(102050061, '622b4444671ac-1647002692.jpg', 'NATURALISTS GUIDE TO THE REPTILES OF SRI LANKA ( 2ND EDITION )', 102050041, 'Anslem de Silva & Kanishka Ukuwela', 1500, '2022-03-11 12:45:35', 0),
(102050062, '622b44a8476b6-1647002792.jpg', 'BIRDS OF SRI LANKA', 102050041, 'Author Deepal Warakagoda, Carol Inskipp, Tim Inskipp, Richard Grimmett', 2500, '2022-03-11 12:49:08', 0),
(102050063, '622b45210a534-1647002913.jpg', 'THE SRORY OF ASIA ELEPHANTS', 102050041, 'A SHORT BIOGRAPHY', 5000, '2022-03-11 12:48:57', 0),
(102050064, '622b470caa324-1647003404.jpg', 'WHY THE CHEETAH CHEATS', 102050041, 'Remarkable discoveries from recent research on wild animals. This book title refers to new research revealing that almost every cheetah litter has two or more fathers. This phenomenon has two major benefits: the cubs are more genetically diverse, and the chances of the young being killed by an adult male are reduced. This is just one example of the many exciting developments in our understanding of animal behavior.', 1250, '2022-03-11 12:58:41', 0),
(102050065, '622b4c668b697-1647004774.jpg', 'APARADA SAMEEKSHA', 102050042, 'Author D.M.S.Dammika Bandara', 1500, '2022-03-11 13:19:53', 0),
(102050066, '622b4d680f038-1647005032.jpg', 'MY NAME IS RAVANA', 102050043, 'King Ravana of Sri Lanka is the villain in the Indian epic Ramayana but new interest has surfaced with satellite pictures of the bridge connecting with Sri Lanka and the discovery of historic links in Sri Lanka. The author Bala Sankuratri is the convener of the global dictionary of the Ramayana. Ravana is credited to be the inventor of chess and the violin. New facts are revealed about what led to the kidnapping of Sita and Ravana’s benevolent raid in Sri Lanka.', 1200, '2022-03-11 13:23:52', 0),
(102050067, '622b4daed8294-1647005102.jpg', 'POWER HOUR : HOW TO FOCUS ON YOUR GOALS AND CREATE A LIFE YOU LOVE', 102050042, 'The Power Hour message is simple : taking an hour for yourselves and your aspirations isnt selfish or impossible, its essential.', 850, '2022-03-11 13:26:06', 0),
(102050068, '622b4e50a5ad0-1647005264.jpg', 'SIGIRIYA A TALE OF GRANDEUR LOVE AND TRAGEDY', 102050043, 'Palace intrigue, passion, deceit, betrayal, and tragedyâ€”this is the story of King Kasyapa and his beloved Sigiriya.', 1600, '2022-03-11 13:27:44', 0),
(102050069, '622b4e8f39606-1647005327.jpg', 'E PURA REJAYU EYA', 102050043, 'Author Chandrasiri Palliyaguru', 700, '2022-03-11 13:28:47', 0),
(102050070, '622b4ecc924d1-1647005388.jpg', 'SIGIRIYA', 102050043, 'Translation of Kasyapas Homage to Beauty', 750, '2022-03-11 13:29:48', 0),
(102050071, '622b4f4ed43c6-1647005518.jpg', 'I AM THE KING OF KINGS', 102050043, 'A historical novel based on king Kirti Nissanka Malla of Sri Lanka. Historians consider him as a king who boasted himself through his rock inscriptions.', 750, '2022-03-11 13:31:58', 0),
(102050072, '622b523ac6ed3-1647006266.jpg', 'WEERA DIWAINA', 102050042, 'Author Abhaya Hewawasam (Translator)', 400, '2022-03-11 13:44:47', 0);

-- --------------------------------------------------------

--
-- Table structure for table `book_order`
--

CREATE TABLE `book_order` (
  `id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `phone_number` int(12) NOT NULL,
  `email` varchar(40) NOT NULL,
  `address` varchar(100) NOT NULL,
  `is_confirm` tinyint(4) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_order`
--

INSERT INTO `book_order` (`id`, `qty`, `book_id`, `first_name`, `last_name`, `phone_number`, `email`, `address`, `is_confirm`, `time`) VALUES
(102050058, 1, 102050055, 'Royan', 'Harsha', 2147483647, 'www.royanharsha6@gmail.com', '417/A1 Hiyare', 0, '2022-03-11 13:51:06'),
(102050059, 1, 102050068, 'Alex', 'Lanka', 2147483647, 'alexlanka99@gmail.com', '417/A1 Hiyare', 0, '2022-03-11 14:55:46'),
(102050060, 1, 102050050, 'Sadhuni', 'Hansika', 2147483647, 'saduni@gmail.com', '417/A1 Hiyare', 1, '2022-03-11 14:57:09');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `email` varchar(40) NOT NULL,
  `message` varchar(1600) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_seen` tinyint(4) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `first_name`, `last_name`, `email`, `message`, `is_seen`, `time`) VALUES
(102050057, 'Royan', 'Harsha', 'www.royanharsha6@gmail.com', 'Simple describes something as being easy to understand or do, as being plain or not elaborate, or as being ordinary or common. The word simple has many other senses as an adjective and a noun. If something is simple, it involves little challenge or will be really easy.', 1, '2022-03-11 10:29:44'),
(102050058, 'Alex', 'Lanka', 'alexlanka99@gmail.com', 'Simple describes something as being easy to understand or do, as being plain or not elaborate, or as being ordinary or common. The word simple has many other senses as an adjective and a noun. If something is simple, it involves little challenge or will be really easy.', 0, '2022-03-11 10:29:53'),
(102050059, 'Sadhuni', 'Hansika', 'saduni@gmail.com', 'Simple describes something as being easy to understand or do, as being plain or not elaborate, or as being ordinary or common. The word simple has many other senses as an adjective and a noun. If something is simple, it involves little challenge or will be really easy.', 0, '2022-03-11 10:30:32');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `site_title` varchar(25) NOT NULL,
  `stats` int(11) NOT NULL,
  `fb` varchar(100) NOT NULL,
  `ins` varchar(100) NOT NULL,
  `twi` varchar(100) NOT NULL,
  `yt` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_title`, `stats`, `fb`, `ins`, `twi`, `yt`) VALUES
(1, 'Vidunetha', 0, 'https://www.facebook.com/', 'https://www.instagram.com/?hl=en', 'https://twitter.com/', 'https://www.youtube.com/');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_category`
--
ALTER TABLE `book_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_list`
--
ALTER TABLE `book_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_order`
--
ALTER TABLE `book_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1002;

--
-- AUTO_INCREMENT for table `book_category`
--
ALTER TABLE `book_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102050044;

--
-- AUTO_INCREMENT for table `book_list`
--
ALTER TABLE `book_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102050073;

--
-- AUTO_INCREMENT for table `book_order`
--
ALTER TABLE `book_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102050061;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102050060;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
