CREATE TABLE `Faculty` (
    `FacultyID` INT(11) NOT NULL AUTO_INCREMENT,
    `FacultyName` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`FacultyID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `Comments` (
    `ComID` INT(11) NOT NULL AUTO_INCREMENT,
    `Comment_Detail` VARCHAR(255) NOT NULL,
    `Comment_CreateTime` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP(),
    `StudentSubmissionID` INT(11) NOT NULL,
    `UserID` INT(11) NOT NULL,
    PRIMARY KEY (`ComID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `Users` (
    `UserID` INT(11) NOT NULL AUTO_INCREMENT,
    `Username` VARCHAR(255) NOT NULL,
    `Password` VARCHAR(255) NOT NULL,
    `Email` VARCHAR(255) NOT NULL,
    `PhoneNumber` VARCHAR(50) NOT NULL,
    `DOB` DATE NOT NULL,
    `Gender` VARCHAR(255) NOT NULL,
    `Address` VARCHAR(255) NOT NULL,
    `Role` VARCHAR(255) DEFAULT NULL,
    `FacultyID` INT(11) NOT NULL,
    PRIMARY KEY (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `Submission`(
    `SubmissionID` INT(11) NOT NULL AUTO_INCREMENT,
    `Submission_Name` VARCHAR(255) NOT NULL,
    `StartDate` DATETIME NOT NULL,
    `ClosureDate` DATETIME NOT NULL,
    `FinalDate` DATETIME NOT NULL,
    `Submission_Description` VARCHAR(255) NOT NULL,
    `Status` VARCHAR(255) NOT NULL,
    `FacultyID` INT(11) NOT NULL,
    PRIMARY KEY (`SubmissionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `Student_Submission`(
    `StudentSubmissionID` INT(11) NOT NULL AUTO_INCREMENT,
    `Student_SubmissionName` VARCHAR(255) NOT NULL,
    `Student_SubmissionDescription` VARCHAR(255) NOT NULL,
    `Student_SubmissionTime` VARCHAR(255) NOT NULL,
    `Student_SubmissionStatus` VARCHAR(255) NOT NULL,
    `Document` VARCHAR(255) NOT NULL,
    `Image` VARCHAR(1000) NOT NULL,
    `UserID` INT(11) NOT NULL,
    `ComID` INT(11) NOT NULL,
    `SubmissionID` INT(11) NOT NULL,
    PRIMARY KEY (`StudentSubmissionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `Comments`
    ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`StudentSubmissionID`) REFERENCES `Student_Submission` (`StudentSubmissionID`),
    ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`);

ALTER TABLE `Users`
    ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`FacultyID`) REFERENCES `Faculty` (`FacultyID`);

ALTER TABLE `Submission`
    ADD CONSTRAINT `sub_ibfk_1` FOREIGN KEY (`FacultyID`) REFERENCES `Faculty` (`FacultyID`);

ALTER TABLE `Student_Submission`
    ADD CONSTRAINT `stdsub_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`),
    ADD CONSTRAINT `stdsub_ibfk_2` FOREIGN KEY (`SubmissionID`) REFERENCES `Submission` (`SubmissionID`);
    ADD CONSTRAINT `stdsub_ibfk_3` FOREIGN KEY (`ComID`) REFERENCES `Comments` (`ComID`);

