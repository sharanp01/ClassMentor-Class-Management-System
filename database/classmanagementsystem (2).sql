-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2024 at 07:56 AM
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
-- Database: `classmanagementsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `sno` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `Code` mediumint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`sno`, `email`, `username`, `password`, `Code`) VALUES
(1, 'sharanputhran01@gmail.com', 'admin', 'sharanp', 0);

-- --------------------------------------------------------

--
-- Table structure for table `announcementdetails`
--

CREATE TABLE `announcementdetails` (
  `AnnouncementID` int(11) NOT NULL,
  `Announcementtitle` varchar(100) NOT NULL,
  `AnnouncementDesc` varchar(250) NOT NULL,
  `SubjectID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcementdetails`
--

INSERT INTO `announcementdetails` (`AnnouncementID`, `Announcementtitle`, `AnnouncementDesc`, `SubjectID`, `CourseID`) VALUES
(3, 'class test', 'today we have a class test brothers', 6, 2),
(4, 'new attachment file ', 'there is anew attachment file avaiable', 5, 2),
(5, 'test on saturday', 'There is a class test assigned for saturday', 5, 2),
(6, 'new timetable ', 'new tiel;smgms;mvd', 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `assignmentdetails`
--

CREATE TABLE `assignmentdetails` (
  `AssignmentID` int(11) NOT NULL,
  `TeacherID` int(11) NOT NULL,
  `SubjectID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `Assignmentquestion` varchar(300) NOT NULL,
  `AssignmentSubdate` date NOT NULL,
  `Assignmentweightage` varchar(5) NOT NULL,
  `AssignmentSublink` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignmentdetails`
--

INSERT INTO `assignmentdetails` (`AssignmentID`, `TeacherID`, `SubjectID`, `CourseID`, `Assignmentquestion`, `AssignmentSubdate`, `Assignmentweightage`, `AssignmentSublink`) VALUES
(5, 4, 6, 2, 'do a research on php and mysql', '2024-03-02', '5', 'https://drive.google.com/drive/folders/1PhJkxFs-V780fgmM9b7BO-uK_N_Sk3s7?usp=drive_link'),
(6, 4, 6, 2, 'Do a research on PHP', '2024-03-02', '5', 'https://drive.google.com/drive/folders/1PhJkxFs-V780fgmM9b7BO-uK_N_Sk3s7?usp=drive_link'),
(7, 4, 6, 2, 'this is sample question', '2024-03-08', '5', 'https://drive.google.com/drive/folders/1PhJkxFs-V780fgmM9b7BO-uK_N_Sk3s7?usp=drive_link');

-- --------------------------------------------------------

--
-- Table structure for table `assignmentmarks`
--

CREATE TABLE `assignmentmarks` (
  `AssignmentID` int(11) NOT NULL,
  `SubjectID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `Marks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignmentmarks`
--

INSERT INTO `assignmentmarks` (`AssignmentID`, `SubjectID`, `StudentID`, `Marks`) VALUES
(5, 6, 3, 5),
(5, 6, 4, 6),
(5, 6, 6, 7),
(5, 6, 7, 6),
(5, 6, 8, 6),
(5, 6, 9, 7);

-- --------------------------------------------------------

--
-- Table structure for table `attendancedetails`
--

CREATE TABLE `attendancedetails` (
  `AttendanceID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `SubjectID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendancedetails`
--

INSERT INTO `attendancedetails` (`AttendanceID`, `StudentID`, `SubjectID`, `Date`, `Status`) VALUES
(1, 3, 6, '2024-03-07', 'Absent'),
(2, 4, 6, '2024-03-07', 'Present'),
(3, 6, 6, '2024-03-07', 'Absent'),
(4, 7, 6, '2024-03-07', 'Present'),
(5, 8, 6, '2024-03-07', 'Absent'),
(6, 9, 6, '2024-03-07', 'Present'),
(7, 3, 6, '2024-03-07', 'Absent'),
(8, 4, 6, '2024-03-07', 'Present'),
(9, 6, 6, '2024-03-07', 'Absent'),
(10, 7, 6, '2024-03-07', 'Present'),
(11, 8, 6, '2024-03-07', 'Absent'),
(12, 9, 6, '2024-03-07', 'Present');

-- --------------------------------------------------------

--
-- Table structure for table `coursedetails`
--

CREATE TABLE `coursedetails` (
  `CourseID` int(11) NOT NULL,
  `Coursename` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coursedetails`
--

INSERT INTO `coursedetails` (`CourseID`, `Coursename`) VALUES
(1, '10th1'),
(2, '9th'),
(3, '12th'),
(4, '11th'),
(9, '14th');

-- --------------------------------------------------------

--
-- Table structure for table `feedbackdetails`
--

CREATE TABLE `feedbackdetails` (
  `FeedbackID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `TeacherID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `Feedback` varchar(300) NOT NULL,
  `Suggestion` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedbackdetails`
--

INSERT INTO `feedbackdetails` (`FeedbackID`, `StudentID`, `TeacherID`, `CourseID`, `Feedback`, `Suggestion`) VALUES
(2, 4, 3, 2, 'good teacher', 'need to be punchual'),
(3, 4, 4, 2, 'good teacher', 'very bad handwriting'),
(4, 8, 4, 2, 'very good teacher', 'no improvements');

-- --------------------------------------------------------

--
-- Table structure for table `quizdetails`
--

CREATE TABLE `quizdetails` (
  `QuizID` int(11) NOT NULL,
  `QuestionID` int(11) NOT NULL,
  `Question` varchar(300) NOT NULL,
  `Option1` varchar(100) NOT NULL,
  `Option2` varchar(100) NOT NULL,
  `Option3` varchar(100) NOT NULL,
  `Option4` varchar(100) NOT NULL,
  `Answer` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quizdetails`
--

INSERT INTO `quizdetails` (`QuizID`, `QuestionID`, `Question`, `Option1`, `Option2`, `Option3`, `Option4`, `Answer`) VALUES
(1, 1, 'What is known as history', '1', '2', '3', '4', '1'),
(1, 2, 'What is geo?', '2', '3', '4', '5', '4'),
(1, 15, 'this is a sample question', '1', '2', '3', '4', '2');

-- --------------------------------------------------------

--
-- Table structure for table `quizmarks`
--

CREATE TABLE `quizmarks` (
  `QuizID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `Attempted` int(11) NOT NULL,
  `NotAttempted` int(11) NOT NULL,
  `Wrongans` int(11) NOT NULL,
  `Totalmarks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quizmarks`
--

INSERT INTO `quizmarks` (`QuizID`, `StudentID`, `Attempted`, `NotAttempted`, `Wrongans`, `Totalmarks`) VALUES
(1, 4, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `quiztopic`
--

CREATE TABLE `quiztopic` (
  `QuizID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `SubjectID` int(11) NOT NULL,
  `Quiztopic` varchar(50) NOT NULL,
  `Difficulty` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiztopic`
--

INSERT INTO `quiztopic` (`QuizID`, `CourseID`, `SubjectID`, `Quiztopic`, `Difficulty`) VALUES
(1, 2, 6, 'history', 'easy');

-- --------------------------------------------------------

--
-- Table structure for table `resourcedetails`
--

CREATE TABLE `resourcedetails` (
  `ResourceID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `Resourcename` varchar(100) NOT NULL,
  `Resourcedesc` varchar(300) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `filepath` varchar(200) NOT NULL,
  `Studentfilepath` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resourcedetails`
--

INSERT INTO `resourcedetails` (`ResourceID`, `CourseID`, `Resourcename`, `Resourcedesc`, `filename`, `filepath`, `Studentfilepath`) VALUES
(9, 2, 'sharan', 'this is login file', 'unification.docx', 'uploads/unification.docx', 'C:/xampp/htdocs/cms/student/uploads/unification.docx'),
(10, 2, 'PHP file', 'this is a php file', 'impact of ai script.pdf', 'uploads/impact of ai script.pdf', 'C:/xampp/htdocs/cms/student/uploads/impact of ai script.pdf'),
(11, 2, 'PDF File', 'This is sample PDF file', 'examfees.pdf', 'uploads/examfees.pdf', 'C:/xampp/htdocs/cms/student/uploads/examfees.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `studentdetails`
--

CREATE TABLE `studentdetails` (
  `StudentID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `Firstname` varchar(50) NOT NULL,
  `Lastname` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone` varchar(10) NOT NULL,
  `Age` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(10) NOT NULL,
  `code` mediumint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studentdetails`
--

INSERT INTO `studentdetails` (`StudentID`, `CourseID`, `Firstname`, `Lastname`, `Email`, `Phone`, `Age`, `Username`, `Password`, `code`) VALUES
(3, 2, 'mann', 'diwani', 'man11@gmail.com', '9029412841', 17, 'mann12', '$2y$10$iEG', 0),
(4, 2, 'sathya', 'poomari', 'sathya01@gmail.com', '8657617559', 15, 'sathya05', '1234', 0),
(6, 2, 'aadesh', 'sawant', 'aadesh11@gmail.com', '8657617558', 17, 'aadesh11', '1234', 0),
(7, 2, 'Shraddha', 'Puthran', 'shraddhaputhran@gmail.com', '9028412824', 18, 'shrad04', '$2y$10$eax', 0),
(8, 2, 'Sharan', 'Puthran', 'splegend2003@gmail.com', '8657617558', 17, 'sharan31', 'sharanp01', 0),
(9, 2, 'viraj', 'mehta', 'viru02@gmail.com', '7990438603', 16, 'viru12', '1234', 0);

-- --------------------------------------------------------

--
-- Table structure for table `subjectdetails`
--

CREATE TABLE `subjectdetails` (
  `SubjectID` int(11) NOT NULL,
  `TeacherID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `Subjectname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjectdetails`
--

INSERT INTO `subjectdetails` (`SubjectID`, `TeacherID`, `CourseID`, `Subjectname`) VALUES
(3, 6, 1, 'science1'),
(4, 5, 1, 'Maths'),
(5, 3, 2, 'Geography'),
(6, 4, 2, 'History'),
(7, 6, 3, 'maths'),
(8, 5, 4, 'chemistry');

-- --------------------------------------------------------

--
-- Table structure for table `teacherdetails`
--

CREATE TABLE `teacherdetails` (
  `TeacherID` int(11) NOT NULL,
  `Firstname` varchar(50) NOT NULL,
  `Lastname` varchar(50) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Phone` varchar(10) NOT NULL,
  `Education` varchar(200) NOT NULL,
  `Subjectstaken` varchar(200) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `code` mediumint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacherdetails`
--

INSERT INTO `teacherdetails` (`TeacherID`, `Firstname`, `Lastname`, `Email`, `Phone`, `Education`, `Subjectstaken`, `Username`, `Password`, `code`) VALUES
(3, 'sharan', 'puthran', 'sharanputhran01@gmail.com', '8657617558', 'phd', 'ej', 'sharan01', 'sharanp01', 0),
(4, 'Divya', 'Mhatre', 'divya03@gmail.com', '8688787981', 'BMS', 'Finance', 'Divya01', '1234', 0),
(5, 'aadesh', 'sawant', 'aadesh02@gmail.com', '8688787981', 'phd', 'asf', 'aadesh02', '1234', 0),
(6, 'yash', 'kandlkar', 'yash01@gmail.com', '8657617558', 'phd', 'ej', 'yash04', '$2y$10$Hfj2MJglR8piA', 0),
(7, 'Indira', 'Puthran', 'Indiraputhran22@gmail.com', '9029412824', 'afa', 'faf', 'indira22', '$2y$10$Je6xYBfwJB7z2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `timetabledetails`
--

CREATE TABLE `timetabledetails` (
  `TimetableID` int(11) NOT NULL,
  `TeacherID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `SubjectID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Starttime` time NOT NULL,
  `Endtime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `announcementdetails`
--
ALTER TABLE `announcementdetails`
  ADD PRIMARY KEY (`AnnouncementID`),
  ADD KEY `SubjectID` (`SubjectID`),
  ADD KEY `CourseID` (`CourseID`);

--
-- Indexes for table `assignmentdetails`
--
ALTER TABLE `assignmentdetails`
  ADD PRIMARY KEY (`AssignmentID`),
  ADD KEY `TeacherID` (`TeacherID`),
  ADD KEY `SubjectID` (`SubjectID`),
  ADD KEY `courseid` (`CourseID`);

--
-- Indexes for table `assignmentmarks`
--
ALTER TABLE `assignmentmarks`
  ADD KEY `subjectid` (`SubjectID`),
  ADD KEY `studentid` (`StudentID`),
  ADD KEY `AssignmentID` (`AssignmentID`);

--
-- Indexes for table `attendancedetails`
--
ALTER TABLE `attendancedetails`
  ADD PRIMARY KEY (`AttendanceID`),
  ADD KEY `StudentID` (`StudentID`),
  ADD KEY `SubjectID` (`SubjectID`);

--
-- Indexes for table `coursedetails`
--
ALTER TABLE `coursedetails`
  ADD PRIMARY KEY (`CourseID`);

--
-- Indexes for table `feedbackdetails`
--
ALTER TABLE `feedbackdetails`
  ADD PRIMARY KEY (`FeedbackID`),
  ADD KEY `StudentId` (`StudentID`),
  ADD KEY `TeacherId` (`TeacherID`),
  ADD KEY `Courseid` (`CourseID`);

--
-- Indexes for table `quizdetails`
--
ALTER TABLE `quizdetails`
  ADD PRIMARY KEY (`QuestionID`),
  ADD KEY `quizid` (`QuizID`);

--
-- Indexes for table `quizmarks`
--
ALTER TABLE `quizmarks`
  ADD KEY `QuizID` (`QuizID`),
  ADD KEY `StudentID` (`StudentID`);

--
-- Indexes for table `quiztopic`
--
ALTER TABLE `quiztopic`
  ADD PRIMARY KEY (`QuizID`),
  ADD KEY `subID` (`SubjectID`),
  ADD KEY `CourseID` (`CourseID`);

--
-- Indexes for table `resourcedetails`
--
ALTER TABLE `resourcedetails`
  ADD PRIMARY KEY (`ResourceID`),
  ADD KEY `Courseid` (`CourseID`);

--
-- Indexes for table `studentdetails`
--
ALTER TABLE `studentdetails`
  ADD PRIMARY KEY (`StudentID`),
  ADD KEY `CourseID` (`CourseID`);

--
-- Indexes for table `subjectdetails`
--
ALTER TABLE `subjectdetails`
  ADD PRIMARY KEY (`SubjectID`),
  ADD KEY `TeacherID` (`TeacherID`),
  ADD KEY `CourseID` (`CourseID`);

--
-- Indexes for table `teacherdetails`
--
ALTER TABLE `teacherdetails`
  ADD PRIMARY KEY (`TeacherID`);

--
-- Indexes for table `timetabledetails`
--
ALTER TABLE `timetabledetails`
  ADD PRIMARY KEY (`TimetableID`),
  ADD KEY `TeacherID` (`TeacherID`),
  ADD KEY `SubjectID` (`SubjectID`),
  ADD KEY `courseid` (`CourseID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminlogin`
--
ALTER TABLE `adminlogin`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `announcementdetails`
--
ALTER TABLE `announcementdetails`
  MODIFY `AnnouncementID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `assignmentdetails`
--
ALTER TABLE `assignmentdetails`
  MODIFY `AssignmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `attendancedetails`
--
ALTER TABLE `attendancedetails`
  MODIFY `AttendanceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `coursedetails`
--
ALTER TABLE `coursedetails`
  MODIFY `CourseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `feedbackdetails`
--
ALTER TABLE `feedbackdetails`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `quizdetails`
--
ALTER TABLE `quizdetails`
  MODIFY `QuestionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `quiztopic`
--
ALTER TABLE `quiztopic`
  MODIFY `QuizID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `resourcedetails`
--
ALTER TABLE `resourcedetails`
  MODIFY `ResourceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `studentdetails`
--
ALTER TABLE `studentdetails`
  MODIFY `StudentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `subjectdetails`
--
ALTER TABLE `subjectdetails`
  MODIFY `SubjectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `teacherdetails`
--
ALTER TABLE `teacherdetails`
  MODIFY `TeacherID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `timetabledetails`
--
ALTER TABLE `timetabledetails`
  MODIFY `TimetableID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcementdetails`
--
ALTER TABLE `announcementdetails`
  ADD CONSTRAINT `announcementdetails_ibfk_1` FOREIGN KEY (`SubjectID`) REFERENCES `subjectdetails` (`SubjectID`),
  ADD CONSTRAINT `announcementdetails_ibfk_2` FOREIGN KEY (`CourseID`) REFERENCES `coursedetails` (`CourseID`);

--
-- Constraints for table `assignmentdetails`
--
ALTER TABLE `assignmentdetails`
  ADD CONSTRAINT `assignmentdetails_ibfk_1` FOREIGN KEY (`TeacherID`) REFERENCES `teacherdetails` (`TeacherID`),
  ADD CONSTRAINT `assignmentdetails_ibfk_2` FOREIGN KEY (`SubjectID`) REFERENCES `subjectdetails` (`SubjectID`),
  ADD CONSTRAINT `assignmentdetails_ibfk_3` FOREIGN KEY (`CourseID`) REFERENCES `coursedetails` (`CourseID`);

--
-- Constraints for table `assignmentmarks`
--
ALTER TABLE `assignmentmarks`
  ADD CONSTRAINT `assignmentmarks_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `studentdetails` (`StudentID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `assignmentmarks_ibfk_2` FOREIGN KEY (`SubjectID`) REFERENCES `subjectdetails` (`SubjectID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `assignmentmarks_ibfk_3` FOREIGN KEY (`AssignmentID`) REFERENCES `assignmentdetails` (`AssignmentID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attendancedetails`
--
ALTER TABLE `attendancedetails`
  ADD CONSTRAINT `attendancedetails_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `studentdetails` (`StudentID`),
  ADD CONSTRAINT `attendancedetails_ibfk_2` FOREIGN KEY (`SubjectID`) REFERENCES `subjectdetails` (`SubjectID`);

--
-- Constraints for table `feedbackdetails`
--
ALTER TABLE `feedbackdetails`
  ADD CONSTRAINT `feedbackdetails_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `coursedetails` (`CourseID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `feedbackdetails_ibfk_2` FOREIGN KEY (`StudentID`) REFERENCES `studentdetails` (`StudentID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `feedbackdetails_ibfk_3` FOREIGN KEY (`TeacherID`) REFERENCES `teacherdetails` (`TeacherID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `quizdetails`
--
ALTER TABLE `quizdetails`
  ADD CONSTRAINT `quizdetails_ibfk_2` FOREIGN KEY (`QuizID`) REFERENCES `quiztopic` (`QuizID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quizmarks`
--
ALTER TABLE `quizmarks`
  ADD CONSTRAINT `quizmarks_ibfk_1` FOREIGN KEY (`QuizID`) REFERENCES `quiztopic` (`QuizID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `quizmarks_ibfk_2` FOREIGN KEY (`StudentID`) REFERENCES `studentdetails` (`StudentID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `quiztopic`
--
ALTER TABLE `quiztopic`
  ADD CONSTRAINT `quiztopic_ibfk_1` FOREIGN KEY (`SubjectID`) REFERENCES `subjectdetails` (`SubjectID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `quiztopic_ibfk_2` FOREIGN KEY (`CourseID`) REFERENCES `coursedetails` (`CourseID`);

--
-- Constraints for table `resourcedetails`
--
ALTER TABLE `resourcedetails`
  ADD CONSTRAINT `resourcedetails_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `coursedetails` (`CourseID`);

--
-- Constraints for table `studentdetails`
--
ALTER TABLE `studentdetails`
  ADD CONSTRAINT `studentdetails_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `coursedetails` (`CourseID`);

--
-- Constraints for table `subjectdetails`
--
ALTER TABLE `subjectdetails`
  ADD CONSTRAINT `subjectdetails_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `coursedetails` (`CourseID`),
  ADD CONSTRAINT `subjectdetails_ibfk_2` FOREIGN KEY (`TeacherID`) REFERENCES `teacherdetails` (`TeacherID`);

--
-- Constraints for table `timetabledetails`
--
ALTER TABLE `timetabledetails`
  ADD CONSTRAINT `timetabledetails_ibfk_1` FOREIGN KEY (`TeacherID`) REFERENCES `teacherdetails` (`TeacherID`),
  ADD CONSTRAINT `timetabledetails_ibfk_2` FOREIGN KEY (`SubjectID`) REFERENCES `subjectdetails` (`SubjectID`),
  ADD CONSTRAINT `timetabledetails_ibfk_3` FOREIGN KEY (`CourseID`) REFERENCES `coursedetails` (`CourseID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
