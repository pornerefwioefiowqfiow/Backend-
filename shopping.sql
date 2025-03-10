-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2020 at 09:51 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'Admin@123'),
(2, 'admin1', 'Admin@123');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `c_id` int(8) NOT NULL,
  `c_name` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`c_id`, `c_name`) VALUES
(1, 'Western'),
(2, 'Traditional'),
(3, 'Nightwear');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `f_id` int(8) NOT NULL,
  `f_description` varchar(255) NOT NULL,
  `f_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `u_id` int(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `o_id` int(8) NOT NULL,
  `o_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `o_total` float NOT NULL,
  `o_status` varchar(30) NOT NULL,
  `u_id` int(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `od_id` int(8) NOT NULL,
  `od_qty` int(3) NOT NULL,
  `p_price` float NOT NULL,
  `p_id` int(8) NOT NULL,
  `o_id` int(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `p_id` int(8) NOT NULL,
  `p_name` varchar(50) NOT NULL,
  `p_price` float NOT NULL,
  `p_description` varchar(255) NOT NULL,
  `p_image1` varchar(50) NOT NULL,
  `p_image2` varchar(50) NOT NULL,
  `p_image3` varchar(50) NOT NULL,
  `sub_id` int(8) NOT NULL,
  `c_id` int(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`p_id`, `p_name`, `p_price`, `p_description`, `p_image1`, `p_image2`, `p_image3`, `sub_id`, `c_id`) VALUES
(14, 'Cotton Lycra Strechable Jeggins', 799, 'Care Instructions: Wash Dark Colors Separately\r\nFabric: cotton lycra\r\nSlim fit\r\nMid waist', 'WJ15.1.jpg', 'WJ15.2.jpg', 'WJ15.3.jpg', 1, 1),
(25, 'Solid Blue Shirt', 599, 'Care Instructions: Care Instructions: Dry clean or Handwash Only\r\nFit Type: Ragular\r\nFit Type: Slim\r\nOccasion: Party wear & Casual', 'WS11.1.jpg', 'WS11.2.jpg', 'WS11.3.jpg', 2, 1),
(26, 'Casual Shirt', 749, 'Fit Type: regular fit\r\nColor Name: Cobalt\r\nMaterial: crepe\r\nMachine wash\r\nBody Blouse\r\nLong sleeve', 'WS12.1.jpg', 'WS12.2.jpg', 'WS12.3.jpg', 2, 1),
(29, 'Plain Shirt', 599, 'Fit Type: regular fit\r\n100% Crepe\r\nDry clean only\r\nTunic\r\nHalf sleeve\r\nFabric: crepe', 'WS14.1.jpg', 'WS14.2.jpg', 'WS14.3.jpg', 2, 1),
(30, 'Cotton Shirt', 629, 'Fit Type: Regular Fit\r\nMaterial: Cotton\r\nColor: Pink\r\nSleeve Type: Long Sleeve; Neck Type: Banded Collor\r\nFit Type: Regular Fit\r\nPackage Contents: 1 Shirt', 'WS15.1.jpg', 'WS15.2.jpg', 'WS15.3.jpg', 2, 1),
(43, 'Polyster', 1299, 'Material: Polyester Crepe\r\nColor: Black\r\nLength: Knee Long\r\nNeck Style: Round Neck; Sleeve Type: 3/4th Sleeve\r\nPackage Contents: 1 Kurta', 'TK13.1.jpg', 'TK13.2.jpg', 'TK13.3.jpg', 5, 2),
(44, 'Rayon Anarkali Kurta', 2500, 'Sleeve : Sleeveless and Fabric for sleeve is provided inside the dress\r\nKurti Fabric : Printed Rayon\r\nStyle : A-Line Gown Style Kurti\r\nPackage contains : 1 Readymade Kurti', 'TK14.1.jpg', 'TK14.2.jpg', 'TK14.3.jpg', 5, 2),
(45, 'Rayon Printed Halter Neck Kurti', 900, 'Material: Cotton; Color: Orange\r\nFit Type: Regular Fit; Neck Style: Square Neck\r\nType of Sleeves: Sleeveless\r\nNumber of Items: 1; Included Items: 1 Gown', 'TK15.1.jpg', 'TK15.2.jpg', 'TK15.3.jpg', 5, 2),
(46, 'Kurti And Palazo Set', 1499, 'Type : full stitched || style : kurti with palazzo\r\nFabric: kurti - cotton, palazzo - cotton, sleeves are included\r\nSize: kurti - m (38 in) and xxl (44 in), length upto 46 in. Size: palazzo - m (28 in) and xxl (34 in)\r\nWork: printed', 'TS1.1.jpg', 'TS1.2.jpg', 'TS1.3.jpg', 6, 2),
(57, 'Silk Party Wear Suit', 1299, 'Lehenga Fabric :- Malbari Silk | Bottom Fabric :- Raw silk , Dupatta Fabric :- Net\r\nDress is semi-stitched. \r\nWork : Embroidered | Neck : Round Neck | Sleeve : Full Sleeve\r\nLife Style : Ceremony,Wedding,Party Wear, Festival Wear', 'TS13.1.jpg', 'TS13.2.jpg', 'TS13.3.jpg', 6, 2),
(58, 'Off white Sharara Embrodary Suit', 2149, 'Product Fabric : Net, Bottom Fabric : Santoon, Dupatta Fabric : Net,\r\nWORK : EMBROIDERED ,Neck : Round Neck\r\nCare instruction:FirstTime Dry Clean', 'TS14.1.jpg', 'TS14.2.jpg', 'TS14.3.jpg', 6, 2),
(60, 'Beige Loung Pants', 799, 'Care Instructions: Machine Wash\r\nOur Relaxed Checked Lounge Pant is quirky and stylish. Wear it to make your day even more fun!\r\n2 front pockets for added style and comfort', 'LP1.1.jpg', 'LP1.2.jpg', 'LP1.3.jpg', 7, 3),
(73, 'Sleep Wear Pants', 499, 'Versatile use - can be used as Yoga wear, Casual wear, Beach wear, Routine day wear, Active wear, Night wear & Lounge wear\r\n100 % Hosiery Premium biowash Cotton\r\nColour: Multi || Fit: Comfort Fit || Pattern: Printed', 'LP14.1.jpg', 'LP14.2.jpg', 'LP14.3.jpg', 7, 3),
(74, 'Cup Cake Pyjama Pants', 549, 'Made of 100% Cotton\r\nPyjamas ideal for loungewear and sleepwear\r\nComfy fit\r\nMachine wash cold, warm iron, do not bleach, do not dry clean', 'LP15.1.jpg', 'LP15.2.jpg', 'LP15.3.jpg', 7, 3),
(82, 'Vests Pyjama Set', 499, 'Color name: Green, 100% Cotton, \r\nMachine wash\r\nLoose Fit, Top and Pyjama', 'PS8.1.jpg', 'PS8.2.jpg', 'PS8.3.jpg', 8, 3),
(83, 'Satin to and Pyjama Set', 399, 'Material Type: Satin \r\nColor: Pink, Type: Sleepwear', 'PS9.1.jpg', 'PS9.2.jpg', 'PS9.3.jpg', 8, 3),
(84, 'Flower Print top and Cepri', 999, 'Care Instructions: Do Not Bleech, Soft and Comfortable Fabric,Relaxed Fit,Top and bottom set, 80% Silk and 20% Polyster', 'PS10.1.jpg', 'PS10.2.jpg', 'PS10.3.jpg', 8, 3),
(90, 'V-Neck T-shirt', 349, 'Fit Type: Regular Fit, Fit: Comfort Quality: 100% Cotton Premium Quality, Bio washed to offer comfort and smoothness, Sleeve: Half Sleeve Tshirt Neck Type: V-Neck tshirt, Occasion: Casual Wear', 'WT1.1.jpg', 'WT1.2.jpg', 'WT1.3.jpg', 3, 1),
(91, 'Short Sleev T-shirt', 499, '<div>Care Instructions: First Dry Clean And Then Normal Wash</div><div>Fit Type: Regular Fit</div><div>Fabric: Lycra, Color: Red and Pink || Pattern: Printed || Style: Casual western wear t-shirt</div>', 'WT2.1.jpg', 'WT2.2.jpg', 'WT2.3.jpg', 3, 1),
(93, 'Up â€“ Down Top', 399, '<div>Fit Type: Regular Fit, Material: Cotton, Color: Yellow</div><div>Package Contents: 1 Shirt</div><div>Sleeve Type: Half Sleeve; Neck Type: Round Neck</div>', 'WT4.1.jpg', 'WT4.2.jpg', 'WT4.3.jpg', 3, 1),
(105, 'Casual Top', 489, '<div>Fit Type: Regular Fit, Fabric - Viscose, Sleeve Styling - Bell Sleeves</div><div>Fit Type - Regular Fit Top, Solid Casual Top, Women Comfortable Top</div>', 'WTO1.1.jpg', 'WTO1.2.jpg', 'WTO1.3.jpg', 4, 1),
(106, 'Regular fit Top', 923, '<div>Fit Type: regular fit, Color Name: Peach, 100% Polyester,Machine wash</div><div>Tunic, Half sleeve, Round neck, Pattern: Solid, Fabric: Polyester</div><div>Sales Package: 1 Top</div>', 'WTO2.1.jpg', 'WTO2.2.jpg', 'WTO2.3.jpg', 4, 1),
(107, 'Regular fit Top', 489, '<div>Fit Type: regular fit, Color Name: Lilac, Material: cotton, Machine wash</div><div>Body Blouse, Half sleeve</div>', 'WTO3.1.jpg', 'WTO3.2.jpg', 'WTO3.3.jpg', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_return`
--

CREATE TABLE `product_return` (
  `pr_id` int(8) NOT NULL,
  `pr_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `p_id` int(8) NOT NULL,
  `o_id` int(8) NOT NULL,
  `u_id` int(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_return_detail`
--

CREATE TABLE `product_return_detail` (
  `prd_id` int(8) NOT NULL,
  `reason_of_return` varchar(255) NOT NULL,
  `p_name` varchar(30) NOT NULL,
  `p_price` float NOT NULL,
  `pr_id` int(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_review`
--

CREATE TABLE `product_review` (
  `r_id` int(8) NOT NULL,
  `r_rating` int(2) NOT NULL,
  `r_review` varchar(255) NOT NULL,
  `r_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `p_id` int(8) NOT NULL,
  `u_id` int(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `s_id` int(8) NOT NULL,
  `address1` varchar(150) NOT NULL,
  `address2` varchar(150) NOT NULL,
  `address3` varchar(150) NOT NULL,
  `landmark` varchar(150) NOT NULL,
  `pincode` int(6) NOT NULL,
  `u_id` int(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `sub_id` int(8) NOT NULL,
  `sub_name` varchar(40) NOT NULL,
  `c_id` int(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`sub_id`, `sub_name`, `c_id`) VALUES
(1, 'Jeans', 1),
(2, 'Shirts', 1),
(3, 'Tees', 1),
(4, 'Tops', 1),
(5, 'Kurta - Kurtis', 2),
(6, 'Salwar - Suites', 2),
(7, 'Lounge Pants', 3),
(8, 'Payjama Sets', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` int(8) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(16) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `dob` date NOT NULL,
  `mobileno` bigint(10) NOT NULL,
  `city` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`f_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`o_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`od_id`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `o_id` (`o_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `sub_id` (`sub_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `product_return`
--
ALTER TABLE `product_return`
  ADD PRIMARY KEY (`pr_id`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `o_id` (`o_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `product_return_detail`
--
ALTER TABLE `product_return_detail`
  ADD PRIMARY KEY (`prd_id`),
  ADD KEY `pr_id` (`pr_id`);

--
-- Indexes for table `product_review`
--
ALTER TABLE `product_review`
  ADD PRIMARY KEY (`r_id`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`sub_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `UNIQUE` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `c_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `f_id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `o_id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `od_id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `p_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `product_return`
--
ALTER TABLE `product_return`
  MODIFY `pr_id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_return_detail`
--
ALTER TABLE `product_return_detail`
  MODIFY `prd_id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_review`
--
ALTER TABLE `product_review`
  MODIFY `r_id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `s_id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `sub_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(8) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
