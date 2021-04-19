-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 22, 2020 at 02:09 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mshahrukh01`
--

-- --------------------------------------------------------

--
-- Table structure for table `groupMembers`
--

CREATE TABLE `groupMembers` (
  `groupMemberId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  `approved` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groupMembers`
--

INSERT INTO `groupMembers` (`groupMemberId`, `userId`, `groupId`, `approved`) VALUES
(23, 19, 1, 1),
(27, 20, 2, 1),
(28, 20, 3, 1),
(29, 15, 2, 1),
(30, 15, 3, 1),
(31, 15, 4, 1),
(32, 15, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `groupMessages`
--

CREATE TABLE `groupMessages` (
  `messageId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groupMessages`
--

INSERT INTO `groupMessages` (`messageId`, `groupId`, `userId`, `message`) VALUES
(1, 3, 1, 'Welcome Folks to Being Woke. \r\n\r\nIn this group we will introduce ways on how to not sound and act like a complete lunatic on your quest for spiritual elevation.'),
(2, 4, 1, 'Welcome Folks to Fun and Adventure. \r\n\r\nIn this group we will introduce ways on how to maximise enjoyment on trips and adventures without excessively indulging in dangerous whims and impulses.'),
(3, 2, 19, 'Hi Pandemic People, Hows it hanging'),
(4, 2, 1, 'Not bad, How are you?'),
(5, 3, 19, 'How do i do that?'),
(6, 3, 19, 'I mean how'),
(7, 3, 1, 'You will start with the basics'),
(8, 2, 19, 'hanging in there, Alhamdu le Allah'),
(9, 2, 19, 'h bout everyone else'),
(10, 2, 1, 'all good here thanks'),
(11, 1, 19, 'hello'),
(12, 3, 1, 'Master The Self'),
(13, 3, 1, 'hello Its the Welllbeing Guru again'),
(14, 3, 1, 'So how is everyone coping?'),
(15, 4, 15, 'Hello'),
(16, 1, 1, 'gtdgdg'),
(17, 3, 20, 'I am well');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `groupId` int(11) NOT NULL,
  `groupName` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `imagePath` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`groupId`, `groupName`, `description`, `imagePath`) VALUES
(1, 'Mindful Meditation', 'A group to practise and encourage Mindful Meditation in everyday life.', 'skyeFarmLedge.JPG'),
(2, 'Pandemic Support', 'A support group for vulnerable individuals during this pandemic.', 'lonelyBench.jpg'),
(3, 'Being Woke', 'A group to help enlightened individuals not act like lunatics in everyday life.', 'helpPhoto.JPG'),
(4, 'Fun and Adventure', 'A responsible take on Fun and Adventure, with emphasis on controlling our whims and impulses to enhance enjoyment for everyone involved.', 'campShenanigans.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `publicMessages`
--

CREATE TABLE `publicMessages` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(80) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `publicMessages`
--

INSERT INTO `publicMessages` (`id`, `name`, `email`, `message`) VALUES
(1, 'Muhammad Shahrukh', 'sharky44444@yahoo.co.uk', 'Well, is it working'),
(5, 'Muhammad Shahrukh', 'sharky44444@yahoo.co.uk', 'Testing Public Messages Again'),
(6, 'Muhammad Shahrukh', 'sharky44444@yahoo.co.uk', 'Testing the message again'),
(14, 'Muhammad Shahrukh', 'sharky44444@yahoo.co.uk', 'Inshallah this will work'),
(16, 'Muhammad Shahrukh', 'sharky44444@yahoo.co.uk', 'This is a new message'),
(17, 'Muhammad Shahrukh', 'sharky44444@yahoo.co.uk', 'How are messages holding up'),
(18, 'Muhammad Shahrukh', '4@test', 'Testing More Messages'),
(19, 'Zesty Commneter', 'zest@test', 'Feeling Zesty?'),
(20, 'hjhgj', 'h@test', 'dhgfh'),
(21, 'test', 'test@test.com', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `sessionId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `approved` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`sessionId`, `userId`, `type`, `date`, `approved`) VALUES
(33, 15, 'Health and Wellbeing', '2020-04-30', 1),
(38, 18, 'Depression Counselling', '2020-04-11', 1),
(39, 15, 'Depression Counselling', '2020-04-17', 1),
(40, 19, 'Health and Wellbeing', '2020-04-23', 1),
(42, 20, 'General Counselling', '2020-04-17', 1),
(43, 21, 'Pandemic Advice', '2020-04-23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `userDetails`
--

CREATE TABLE `userDetails` (
  `userDetailsId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `streetAddress` text NOT NULL,
  `postCode` varchar(20) NOT NULL,
  `city` text NOT NULL,
  `country` text NOT NULL,
  `phone` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userDetails`
--

INSERT INTO `userDetails` (`userDetailsId`, `userId`, `streetAddress`, `postCode`, `city`, `country`, `phone`) VALUES
(3, 15, '52', 'BT14', 'BElfast', 'United', '07843834105'),
(4, 16, '52 Marmount Gardens', 'BT14 6NW', 'Belfast', 'United Kingdom', '07896547432'),
(5, 19, '52 Marmount Gardens', 'BT14 6NW', 'Belfast', 'United Kingdom', '07843834105'),
(6, 20, '52 Marmount Gardens', 'BT14 6NW', 'Belfast', 'United Kingdom', '07843834105'),
(7, 21, '52 Marmount Park', 'BT45 6nb', 'Raccoon', 'US', '576576868');

-- --------------------------------------------------------

--
-- Table structure for table `userMessages`
--

CREATE TABLE `userMessages` (
  `messageId` int(11) NOT NULL,
  `user1Id` int(11) NOT NULL,
  `user2Id` int(11) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userMessages`
--

INSERT INTO `userMessages` (`messageId`, `user1Id`, `user2Id`, `message`) VALUES
(1, 1, 15, 'Hello, Muhammad'),
(2, 15, 1, 'Hello Guru'),
(3, 1, 16, 'Hello id:16 user'),
(4, 16, 1, 'Right back at ya id:1'),
(5, 15, 16, 'howdy id:16 user'),
(6, 16, 15, 'what ye want id:16'),
(7, 1, 15, 'So do you want another session'),
(8, 1, 15, 'Lets try again shall we?'),
(9, 1, 15, 'Hmm'),
(10, 1, 15, 'inna'),
(11, 1, 15, 'hgjh'),
(12, 1, 17, 'Hello Shaiyanne'),
(13, 1, 18, 'hello Shaiyanne'),
(14, 1, 18, 'hello Shaiyanne'),
(15, 19, 1, 'Thanks for approving my group request, Guru'),
(16, 1, 19, 'No Problem Xesty Lemon'),
(17, 19, 2, 'Hi Pandemic People, Hows it hanging'),
(18, 1, 17, 'Is there anything I can help you with'),
(19, 20, 1, 'Thankyou for allowing me'),
(20, 1, 16, 'Hello Dogs'),
(21, 15, 1, 'Are you high, Guru?');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` text NOT NULL,
  `userType` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `password`, `userType`) VALUES
(1, 'Wellbeing Guru', 'Guru', 'admin@admin.com', 'f865b53623b121fd34ee5426c792e5c33af8c227', 1),
(15, 'Muhammad', 'Shahrukh', 'sharky44644@yahoo.co.uk', '5fa3a0be68def2d4ff102e4b56dfdebebe174087', 2),
(16, 'Mishal', 'eman', 'eman.mishal@yahoo.co.uk', 'dfbb7039544f870bed5b837d15a3d43b085e8221', 2),
(17, 'shaiyanne', 'malka', 'shaiyanne.malka@yahoo.com', 'a86132a6bec91597dfe42c2a534de83bf883b49d', 2),
(18, 'sharky', '44444', 's@yest.com', '5fa3a0be68def2d4ff102e4b56dfdebebe174087', 2),
(19, 'zesty', 'lemon', 'zest@test.com', '5fa3a0be68def2d4ff102e4b56dfdebebe174087', 2),
(20, 'Steve', 'Knott', 'steve@test.com', '5fa3a0be68def2d4ff102e4b56dfdebebe174087', 2),
(21, 'gjg', 'jjgjhg', 'gjg@test', '5fa3a0be68def2d4ff102e4b56dfdebebe174087', 2);

-- --------------------------------------------------------

--
-- Table structure for table `userTypes`
--

CREATE TABLE `userTypes` (
  `id` int(11) NOT NULL,
  `userType` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userTypes`
--

INSERT INTO `userTypes` (`id`, `userType`) VALUES
(1, 'Admin'),
(2, 'Client');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groupMembers`
--
ALTER TABLE `groupMembers`
  ADD PRIMARY KEY (`groupMemberId`),
  ADD KEY `groupMembers_userId_fk` (`userId`),
  ADD KEY `groupMembers_groupId_fk` (`groupId`);

--
-- Indexes for table `groupMessages`
--
ALTER TABLE `groupMessages`
  ADD PRIMARY KEY (`messageId`),
  ADD KEY `groupMessages_groupId` (`groupId`),
  ADD KEY `groupMessages_userId` (`userId`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`groupId`);

--
-- Indexes for table `publicMessages`
--
ALTER TABLE `publicMessages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`sessionId`),
  ADD KEY `sessions_userId_fk` (`userId`);

--
-- Indexes for table `userDetails`
--
ALTER TABLE `userDetails`
  ADD PRIMARY KEY (`userDetailsId`),
  ADD KEY `userDetails_userId_fk` (`userId`);

--
-- Indexes for table `userMessages`
--
ALTER TABLE `userMessages`
  ADD PRIMARY KEY (`messageId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_userType` (`userType`);

--
-- Indexes for table `userTypes`
--
ALTER TABLE `userTypes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groupMembers`
--
ALTER TABLE `groupMembers`
  MODIFY `groupMemberId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `groupMessages`
--
ALTER TABLE `groupMessages`
  MODIFY `messageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `groupId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `publicMessages`
--
ALTER TABLE `publicMessages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `sessionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `userDetails`
--
ALTER TABLE `userDetails`
  MODIFY `userDetailsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `userMessages`
--
ALTER TABLE `userMessages`
  MODIFY `messageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `userTypes`
--
ALTER TABLE `userTypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `groupMembers`
--
ALTER TABLE `groupMembers`
  ADD CONSTRAINT `groupMembers_groupId_fk` FOREIGN KEY (`groupId`) REFERENCES `groups` (`groupId`),
  ADD CONSTRAINT `groupMembers_userId_fk` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Constraints for table `groupMessages`
--
ALTER TABLE `groupMessages`
  ADD CONSTRAINT `groupMessages_groupId` FOREIGN KEY (`groupId`) REFERENCES `groups` (`groupId`),
  ADD CONSTRAINT `groupMessages_userId` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_userId_fk` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Constraints for table `userDetails`
--
ALTER TABLE `userDetails`
  ADD CONSTRAINT `userDetails_userId_fk` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_userType` FOREIGN KEY (`userType`) REFERENCES `userTypes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
