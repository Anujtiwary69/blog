-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 20, 2017 at 09:09 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `domain`
--

CREATE TABLE `domain` (
  `id` int(11) NOT NULL,
  `domain` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `domain`
--

INSERT INTO `domain` (`id`, `domain`, `user_id`) VALUES
(1, 'anujtiwary.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Product-search`
--

CREATE TABLE `Product-search` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` varchar(50) NOT NULL,
  `seller` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Product-search`
--

INSERT INTO `Product-search` (`id`, `image`, `name`, `price`, `seller`, `user_id`) VALUES
(1, 'https://images-eu.ssl-images-amazon.com/images/I/31F0WPPf1PL._AC_US218_.jpg', 'Fastrack PS240 Ultar Medium Polo Shirt - Navy', ' £11.67 ', 'by  Paroh ', 1),
(2, 'https://images-eu.ssl-images-amazon.com/images/I/31tq0zkwqQL._AC_US218_.jpg', 'CURTAIN RAIL TRACK GLIDE GLIDER HOOKS TO FIT SWISH FASTRACK ( pack of 30 )', ' £2.34 ', 'by  ONESTOPDIY.COM ', 1),
(3, 'https://images-eu.ssl-images-amazon.com/images/I/41VxFthpMSL._AC_US218_.jpg', 'fastrack to wellness: good health. good life. guide', 'helen marie loorents', 'by  helen marie loorents ', 1),
(4, 'https://images-eu.ssl-images-amazon.com/images/I/41964bxfh7L._AC_US218_.jpg', 'MSA V-Gard 520 Construction Worker Helmet with Ventilation and Rotary Knob Control FasTrack &ndash; ', ' £16.45 ', 'by  MSA Safety ', 1),
(5, 'https://images-eu.ssl-images-amazon.com/images/I/41NST7dQDJL._AC_US218_.jpg', 'agrobiothers Cat Toy Kitty Fastrack', ' £16.58 ', 'by  Agrobiothers ', 1),
(6, 'https://images-eu.ssl-images-amazon.com/images/I/61hLocd8ItL._PI_PJStripe-Prime-Only-500px,TopLeft,0,0_AC_US218_.jpg', 'How to Build An O Gauge Train Layout Beginner &amp; Advanced - Using Lionel FasTrack', '£0.00 ', 'Amazon Video', 1),
(7, 'https://images-eu.ssl-images-amazon.com/images/I/51yjeZKjLdL._AC_US218_.jpg', 'On Air - Fastrack into Radio', 'Kindle Edition', 'by  Malcolm Russell ', 1),
(8, 'https://images-eu.ssl-images-amazon.com/images/I/41BJMGHoNnL._AC_US218_.jpg', 'Fastrack Men\'s 3062Pp11 Colorful Tees Analog Quartz Watch', ' £35.00  	 (1 new offer)', 'by  Fastrack ', 1),
(9, 'https://images-eu.ssl-images-amazon.com/images/I/511rlcj50KL._AC_US218_.jpg', 'Berghaus Men\'s Fastrack 3 in 1 Triclimate Waterproof Jacket - Green', ' £109.99 ', 'by  Berghaus ', 1),
(10, 'https://images-eu.ssl-images-amazon.com/images/I/41-JCO8Zz7L._AC_US218_.jpg', 'WD My Net N900 HD Dual Band Router for HD Video with Fastrack Plus', ' £109.47 ', 'by  Western Digital ', 1),
(11, 'https://images-eu.ssl-images-amazon.com/images/I/314uTZXO9cL._AC_US218_.jpg', 'Polo Shirt Royal Blue Fastrack Ps240 Orbit-3 X Lrg', ' £11.67 ', ' £11.67 ', 1),
(12, 'https://images-eu.ssl-images-amazon.com/images/I/21CD79EYXFL._AC_US218_.jpg', 'JCB Fastrack 155-65', ' £10.99 ', 'by  Joal ', 1),
(13, 'https://images-eu.ssl-images-amazon.com/images/I/515A7qdBH-L._AC_US218_.jpg', 'Centurian Curtain Glider To Fit Swish Fastrack Pack of 10', ' £2.00 ', 'by  UK Safety Signs & Products ', 1),
(14, 'https://i.ebayimg.com/thumbs/images/m/m8JmI3tnFDwDO5ru0pWZEUw/s-l225.jpg', 'Berghaus Women\'s Fastrack Full Zip Outdoors Activewear Hoodie Jacket 2 Colours', ' 					£21.00 ', 'none', 1),
(15, 'https://i.ebayimg.com/thumbs/images/m/mckXX-CqyPZDsecrGFG03gQ/s-l225.jpg', 'Packs of 100 Curtain Hooks Gliders, Harrison Drape & Swish Fastrack, Nova & Solo', ' 					£6.00 ', 'none', 1),
(16, 'https://i.ebayimg.com/thumbs/images/m/mht3DmiRmh-hmo5tbQ9k7qw/s-l225.jpg', 'Berghaus Men\'s Fastrack 3 in 1 Triclimate Waterproof Jacket - New', ' 					£99.99 ', 'none', 1),
(17, 'https://i.ebayimg.com/thumbs/images/g/yd0AAOSw2xRYcAZG/s-l225.jpg', 'Stens 280-926 Flat Idler for Hustler 784504 Fastrack And Mini Fastrack', ' 					£8.70 ', 'none', 1),
(18, 'https://i.ebayimg.com/thumbs/images/g/xqUAAOSwsW9Yyb5o/s-l225.jpg', 'FastRack 24-Bottle Rack and Tray Set (2 Racks and 1 Tray)', ' 					£24.89 ', 'none', 1),
(19, 'https://images-eu.ssl-images-amazon.com/images/I/31EnFIY9ZxL._AC_US218_.jpg', 'Lipstick Matte Lipstick Velvet Teddy M.A.C', ' £24.39 ', 'by Amazon', 1),
(20, 'https://images-eu.ssl-images-amazon.com/images/I/41eNxnDIXCL._AC_US218_.jpg', 'MAC Eye Shadow X 9 AMBER TIMES NINE', ' £35.50 ', 'by Amazon', 1),
(21, 'https://images-eu.ssl-images-amazon.com/images/I/41jRarL8dVL._AC_US218_.jpg', 'Mac in a Sac Classic Unisex Packaway Jacket', ' £8.99 - £36.12 ', 'by Amazon', 1),
(22, 'https://images-eu.ssl-images-amazon.com/images/I/41bgDEZyPhL._AC_US218_.jpg', 'T0PQuality Newest Long Lasting Liquid Lipstick Matte Lipgloss Lipstick Not Stick On Cup Lipstick', ' £0.99 ', 'by Amazon', 1),
(23, 'https://images-eu.ssl-images-amazon.com/images/I/51qGtmt9oJL._AC_US218_.jpg', 'Premium Beauty Cosmetic Organiser Display Stand with 4 Drawers (2 parts 20 sections) - Clear Acrylic', ' £12.99 ', 'by Amazon', 1),
(24, 'https://images-eu.ssl-images-amazon.com/images/I/41u1Eurt-IL._AC_US218_.jpg', 'USB 3.0 External DVD Drive Patuoxun CD Drive Burner ,  [High Speed] CD DVD Writer Player for Apple M', 'USB 3.0 External DVD Drive Patuoxun CD Drive Burne', 'by Amazon', 1),
(25, 'https://images-eu.ssl-images-amazon.com/images/I/51xA1PjuG6L._AC_US218_.jpg', 'Ammiy&reg;18 Pcs Makeup Brush Set Professional Wood Handle Premium Synthetic Kabuki Foundation Blend', ' £14.99 ', 'by Amazon', 1),
(26, 'https://images-eu.ssl-images-amazon.com/images/I/21nDYGUb3CL._AC_US218_.jpg', 'MAC Satin Lipstick TWIG 3g', ' £15.01 ', 'by Amazon', 1),
(27, 'https://images-eu.ssl-images-amazon.com/images/I/51kZLQfCtoL._AC_US218_.jpg', 'Urban Decay Naked Vault Volume II', '£375.00 ', 'by Amazon', 1),
(28, 'https://images-eu.ssl-images-amazon.com/images/I/41-YQ6W4PNL._AC_US218_.jpg', 'MAC Mineralize Skinfinish GLOBAL GLOW', ' £36.90 ', 'by Amazon', 1),
(29, 'https://images-eu.ssl-images-amazon.com/images/I/41Ws8h7X2oL._AC_US218_.jpg', 'MAC - Fix+ - Prep+Prime Skin Refresher/Finishing Mist', ' £26.10 ', 'by Amazon', 1),
(30, 'https://images-eu.ssl-images-amazon.com/images/I/51SUdtoBywL._AC_US218_.jpg', 'ROPALIA Jelly Color Changing Long Lasting Lipstick Moisturizing Lip Gloss', ' £2.10 ', 'by Amazon', 1),
(31, 'https://images-eu.ssl-images-amazon.com/images/I/31hDDEYCY7L._AC_US218_.jpg', 'Mac Prep and Prime Transparent Finishing Powder, Net 9g, Boxed', ' £24.99 ', 'by Amazon', 1),
(32, 'https://i.ebayimg.com/thumbs/images/m/mhh7Xoq1XKNiXLF8jXHCOAw/s-l225.jpg', 'MAC STUDIO FACE AND BODY FOUNDATION GENUINE C SHADES 120ML NOT FIX FULL SIZE', ' 					£13.99 to  £18.99  						 ', 'By Ebay', 1),
(33, 'https://i.ebayimg.com/thumbs/images/m/mM1BYwzqaiAblldbVmVEtXQ/s-l225.jpg', 'MAC Studio Fix Foundation Fluid SPF15 ALL SHADES 30ml + Free Pump', ' 					£19.99 ', 'By Ebay', 1),
(34, 'https://i.ebayimg.com/thumbs/images/m/mRIMlwHswN2lRGbOK8BQV3Q/s-l225.jpg', 'MAC CINDERELLA LIMITED EDITION DISNEY LIPSTICK FREE AS A BUTTERFLY / ROYAL BALL', ' 					£7.40 ', 'By Ebay', 1),
(35, 'https://i.ebayimg.com/thumbs/images/m/mF-C98vc31GT7JfjvBVJLWw/s-l225.jpg', 'MAC Foundation Matchmaster NC15 NC20 NC25 NC30 NC35 NC40', ' 					£15.99 ', 'By Ebay', 1),
(36, 'https://i.ebayimg.com/thumbs/images/m/mAZmzY1KprjfG9EaehZMFHQ/s-l225.jpg', '?? MAC Studio Fix Fluid SPF 15 Foundation SAMPLE??', ' 					£3.40 to  £6.99  						 ', 'By Ebay', 1),
(37, 'https://i.ebayimg.com/thumbs/images/m/mr4sEpHcOuNdRbk3M_OSPTQ/s-l225.jpg', 'MAC Studio Sculpt Foundation Summer Makeup ALL SHADES - 40ml 100% Genuine RRP26£', ' 					£17.98 ', 'By Ebay', 1),
(38, 'https://i.ebayimg.com/thumbs/images/g/QlUAAOSwFNZWwDu2/s-l225.jpg', 'Apple Mac Pro A1186 Desktop - MA356LL/A - 2.66GHz Xeon, 32GB Ram, 1.5TB HD Lion', ' 					£376.27 ', 'By Ebay', 1),
(39, 'https://i.ebayimg.com/thumbs/images/g/FCUAAOSwaeRZMCXB/s-l225.jpg', 'Mac Velvet Teddy Nude Lipstick Uk Seller', ' 					£7.49 ', 'By Ebay', 1),
(40, 'https://i.ebayimg.com/thumbs/images/g/faUAAOSwxu5ZMAeh/s-l225.jpg', 'Twelve South BookArc for Mac Pro | Horizontal desktop stand for Mac Pro', ' 					£23.51 ', 'By Ebay', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'anujtiwary69@gmail.com', 'Admin@#$');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `domain`
--
ALTER TABLE `domain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Product-search`
--
ALTER TABLE `Product-search`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `domain`
--
ALTER TABLE `domain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `Product-search`
--
ALTER TABLE `Product-search`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
