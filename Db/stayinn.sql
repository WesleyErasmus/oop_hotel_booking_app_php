-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2023 at 08:35 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stayinn`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bookingno` varchar(255) DEFAULT NULL,
  `customerid` varchar(60) DEFAULT NULL,
  `hotelid` varchar(60) DEFAULT NULL,
  `checkindate` datetime NOT NULL DEFAULT current_timestamp(),
  `checkoutdate` datetime NOT NULL DEFAULT current_timestamp(),
  `totalcost` int(255) DEFAULT NULL,
  `cancelled` tinyint(1) NOT NULL DEFAULT 0,
  `completed` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bookingno`, `customerid`, `hotelid`, `checkindate`, `checkoutdate`, `totalcost`, `cancelled`, `completed`) VALUES
('63e69b7e05202', '3', '25', '2023-03-01 00:00:00', '2023-03-11 00:00:00', 96000, 0, 1),
('63e69bbe100c2', '3', '8', '2023-03-30 00:00:00', '2023-04-10 00:00:00', 7700, 0, 1),
('63e69bf543b31', '3', '30', '2023-08-08 00:00:00', '2023-09-08 00:00:00', 775000, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerid` int(255) NOT NULL,
  `phonenumber` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerid`, `phonenumber`) VALUES
(3, '0834561234');

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `id` int(60) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pricepernight` int(60) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `features` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `beds` int(10) NOT NULL,
  `rating` tinyint(5) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`id`, `name`, `pricepernight`, `thumbnail`, `features`, `type`, `beds`, `rating`, `location`) VALUES
(1, 'The Hilton', 500, 'https://images.pexels.com/photos/271624/pexels-photo-271624.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 'Mini Bar', 'Suites', 2, 4, 'CPT'),
(2, 'Fire & Ice', 300, 'https://images.pexels.com/photos/261102/pexels-photo-261102.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 'Free Wi-Fi', 'Residential', 1, 5, 'Clifton'),
(3, 'The 11', 2500, 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80', 'Pool', 'Suites', 3, 5, 'Camps Bay'),
(4, 'Taj Hotel Cape Town', 1300, 'https://images.unsplash.com/photo-1625244695851-1fc873f942bc?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80', '24hr Room Service', 'Business', 2, 3, 'JHB'),
(7, 'Atlanticview Cape Town', 3000, 'https://images.unsplash.com/photo-1540541338287-41700207dee6?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80', 'TV', 'Suites', 4, 4, 'CPT'),
(8, 'Savoy Lodge', 700, 'https://images.unsplash.com/photo-1445019980597-93fa8acb246c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=874&q=80', 'Mini Bar', 'Residential', 4, 3, 'V&A Waterfront'),
(9, 'Four Seasons', 5200, 'https://images.unsplash.com/photo-1439130490301-25e322d88054?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1332&q=80', 'Coffee Maker', 'Suites', 2, 5, 'DBN'),
(10, 'Comfort Hotel', 4700, 'https://images.unsplash.com/photo-1564501049412-61c2a3083791?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1332&q=80', 'Free Breakfast', 'Suites', 4, 5, 'PE'),
(11, 'Holiday Inn Express', 3500, 'https://images.unsplash.com/photo-1506059612708-99d6c258160e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1169&q=80', 'Bathrobes and slippers', 'Suites', 2, 4, 'PMB'),
(12, 'Leonardo Royal', 7000, 'https://images.unsplash.com/photo-1599722585837-c1cb8eea32ff?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=880&q=80', 'Gym & Fitness Center', 'Suites', 1, 5, 'CPT'),
(13, 'Radisson Blu', 5900, 'https://images.unsplash.com/photo-1580041065738-e72023775cdc?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80', 'Mobile Check-in', 'Residential', 2, 3, 'PE'),
(14, 'Rubens At The PalaceOpens in new window\r\n', 2100, 'https://images.unsplash.com/photo-1586875419037-52b4423c2c55?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1332&q=80', 'VIP Shopping', 'Business', 1, 4, 'CPT'),
(15, 'The Other House Residents Club', 1700, 'https://images.unsplash.com/photo-1598902590916-fd8d890ff798?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1074&q=80', 'In-Room Cocktail Station', 'Residential', 2, 4, 'PE'),
(16, 'Park Grand', 9000, 'https://images.unsplash.com/photo-1574083438348-f4158ba994b3?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80', 'Relaxation Devices', 'Suites', 7, 5, 'CPT'),
(17, 'NYX Hotel', 8200, 'https://images.unsplash.com/photo-1612727212381-492adb6413de?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1169&q=80', 'Room Purification', 'Business', 2, 3, 'DBN'),
(18, 'Egerton House', 6000, 'https://images.unsplash.com/photo-1560200353-ce0a76b1d438?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1074&q=80', 'Mini Bar', 'Business', 3, 5, 'CPT'),
(19, 'The Beaufort\r\n', 900, 'https://images.unsplash.com/photo-1573663520878-8c38b10264fc?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1074&q=80', 'Powerbank for the Road', 'Business', 1, 4, 'PMB'),
(20, 'The Montcalm At Brewery', 2800, 'https://images.unsplash.com/photo-1499793983690-e29da59ef1c2?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80', 'Free Beer On-tap', 'Residential', 4, 4, 'CPT'),
(21, 'Middle Eight', 13000, 'https://images.unsplash.com/photo-1456254394237-131c81cd1f58?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1175&q=80', 'House Car Service', 'Suites', 8, 5, 'CPT'),
(22, 'One Hundred', 250, 'https://images.unsplash.com/photo-1545065053-56b6948e260a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1074&q=80', '24hr Reception Service', 'Residential', 3, 5, 'CPT'),
(23, 'The First Collection', 1000, 'https://images.unsplash.com/photo-1536625737227-92a1fc042e7e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80', 'In-Room Cocktail Station', 'Suites', 1, 5, 'PE'),
(24, 'Shoreline', 4500, 'https://images.unsplash.com/photo-1569369926169-9ee7fb80adeb?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1163&q=80', 'Shuttle Service', 'Business', 2, 3, 'DBN'),
(25, 'Days Hotel', 9600, 'https://images.unsplash.com/photo-1595368062392-a189a24c0cf8?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80', '24hr Room Service', 'Residential', 5, 5, 'JHB'),
(26, 'Gorgeous 2BR', 5400, 'https://images.unsplash.com/photo-1590381105924-c72589b9ef3f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1171&q=80', 'Private Jacuzzi', 'Suites', 4, 3, 'CPT'),
(27, 'Golden Sands', 15000, 'https://images.unsplash.com/photo-1498503182468-3b51cbb6cb24?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80', 'Private Beach', 'Business', 2, 5, 'CPT'),
(28, 'KeyHost Hotel', 6600, 'https://images.unsplash.com/photo-1541480551145-2370a440d585?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1169&q=80', 'Champagne Sabering', 'Residential', 4, 4, 'JHB'),
(29, 'Dunya Tower', 2900, 'https://images.unsplash.com/photo-1490122417551-6ee9691429d0?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80', 'Floral Garden', 'Residential', 3, 3, 'PMB'),
(30, 'Dusit Princess', 25000, 'https://images.unsplash.com/photo-1534014963325-599a7fdebdf4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80', 'Private Manor', 'Suites', 18, 5, 'JHB'),
(31, 'Nordic Relax House', 17500, 'https://images.unsplash.com/photo-1586243795501-473ba1a71105?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1074&q=80', 'Relaxation Devices', 'Business', 1, 5, 'PE'),
(32, 'Lapland View Lodge', 3900, 'https://images.unsplash.com/photo-1477120128765-a0528148fed2?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1171&q=80', 'Premium Coffee On-tap', 'Business', 1, 4, 'PMB'),
(33, '\r\nArctic River', 22000, 'https://images.unsplash.com/photo-1600011689032-8b628b8a8747?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1074&q=80', 'Private Beach', 'Suites', 5, 5, 'CPT'),
(34, 'Peace & Quiet Hotel', 70000, 'https://images.unsplash.com/photo-1545403842-6b8149e2759e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1171&q=80', 'Private Butler & Staff', 'Suites', 10, 5, 'CPT');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffid` int(30) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffid`, `role`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(60) NOT NULL,
  `username` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `fullname`, `password`, `email`, `address`) VALUES
(1, 'admin', 'Administrator', '$2y$10$5PDfa5ihh4FPhQ9soeD6futCxl46pilAMSa1LyLR0RasiCp9ufCIG', 'admin@stayinn.com', 'N/A'),
(2, 'user', 'User', '$2y$10$OY.oOYuI6gViG.b0GMtLCO.U6qrhXNGeEk3mSCD0rrD5.yJQw1FTW', 'user@stayinn.com', 'N/A'),
(3, 'customer', 'Customer', '$2y$10$g3k9iLBJr/dMx0ID.1YcUe//smHV/7gkc.65PiatT7DDNTbREpyA.', 'customer@travelcenter.com', 'Digital Nomad');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerid`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
