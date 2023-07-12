
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `floridastore`
--
CREATE DATABASE floridastore;
-- --------------------------------------------------------
USE floridastore;
--
-- Table structure for table `custtbl`
--

CREATE TABLE `custtbl` (
  `custRegNo` varchar(50) NOT NULL,
  `custName` varchar(150) NOT NULL,
  `custEmail` varchar(255) NOT NULL,
  `custPhone` varchar(30) NOT NULL,
  `custAddress` varchar(255) NOT NULL
);

--
-- Dumping data for table `custtbl`
--

INSERT INTO `custtbl` (`custRegNo`, `custName`, `custEmail`, `custPhone`, `custAddress`) VALUES
('CUST-237052114', 'Theophilus Lincoln', 'lincolntheop@gmail.com', ' 254758885970', 'Eldama Ravine Road, Nairobi, Kabarak University Main Campus, Nakuru'),
('CUST-23711132958', 'Trevor Vuhya', 'tvuhya@gmail.com', ' 254797127148', 'Southern Lands, Nairobi, South C Estate'),
('CUST-23711133140', 'Moses Sande', 'mswanyama@kabarak.ac.ke', ' 254796980087', 'Eldama Ravine Road, Nairobi, Kabarak University Main Campus, Nakuru'),
('CUST-23711164909', 'Tina Nelly', 'tinanelly@mail.com', ' 254788456723', 'Angel Street, 4th Avenue, Boston');

-- --------------------------------------------------------

--
-- Table structure for table `employeetbl`
--

CREATE TABLE `employeetbl` (
  `empId` varchar(50) NOT NULL,
  `empName` varchar(150) NOT NULL,
  `empEmail` varchar(255) NOT NULL,
  `empPhone` varchar(30) NOT NULL,
  `empPass` varchar(150) NOT NULL,
  `resetExpiration` varchar(150) NOT NULL
);

--
-- Dumping data for table `employeetbl`
--

INSERT INTO `employeetbl` (`empId`, `empName`, `empEmail`, `empPhone`, `empPass`, `resetExpiration`) VALUES
('EMP-23710102851', 'Theophilus Owiti ', 'lincolntheop@gmail.com', '+254758885760', '$2y$10$ZIWAVg/cRP6l.NrSlVfBbeLfwLSHAuz7Z1GANGxr1bsDEQRqw6S86', '20230711164158');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `custtbl`
--
ALTER TABLE `custtbl`
  ADD PRIMARY KEY (`custRegNo`);

--
-- Indexes for table `employeetbl`
--
ALTER TABLE `employeetbl`
  ADD PRIMARY KEY (`empId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
