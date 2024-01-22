<?php
    // Database actions (read-write-update-delete) class.
    class DatabaseManager{
        // "User" actions.
        // "User" reader.
        public static function userReader():array{
            $con = new mysqli("127.0.0.1", "root", "", "freecvcreator");

            $driver = new mysqli_driver();
            $driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;

            // SQL listing command prepared for execution.
            $stmt = $con->query("SELECT * FROM User ORDER BY ID");

            $userArray = [];

            // All users data collected into an array.
            while($instance = $stmt->fetch_assoc()){
                array_push($userArray, new UserObjectifier(
                    new User(
                        strval($instance["ID"]),
                        strval($instance["EmailAddress"]),
                        strval($instance["Password"]),
                        boolval($instance["UserIsAdmin"]),
                        boolval($instance["PublicProfileLinkActive"]),
                        boolval($instance["DataSaveActive"]))
                ));
            }

            $con->close();

            return $userArray;
        }

        // "User" writer.
        public static function userWriter(User $user):void{
            $con = new mysqli("127.0.0.1", "root", "", "freecvcreator");

            $driver = new mysqli_driver();
            $driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;

            // SQL writer command prepared for execution.
            $stmt = $con->prepare("INSERT INTO User (ID, EmailAddress, Password, UserIsAdmin, PublicProfileLinkActive, DataSaveActive)
            VALUES (?, ?, ?, ?, ?, ?)");

            $id = $user->getId();
            $emailAddress = $user->getEmailAddress();
            $password = $user->getPassword();
            $userIsAdmin = $user->getUserIsAdmin();
            $publicProfileLinkActive = $user->getPublicProfileLinkActive();
            $dataSaveActive = $user->getDataSaveActive();

            $stmt->bind_param("sssiii", $id, $emailAddress, $password, $userIsAdmin, $publicProfileLinkActive, $dataSaveActive);

            $stmt->execute();
            $stmt->close();
            $con->close();
        }

        // "User" updater.
        public static function userUpdater(User $user):void{
            $con = new mysqli("127.0.0.1", "root", "", "freecvcreator");

            $driver = new mysqli_driver();
            $driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;

            // SQL updater command prepared for execution.
            $stmt = $con->prepare("UPDATE User SET PublicProfileLinkActive = ?, DataSaveActive = ?");

            $publicProfileLinkActive = $user->getPublicProfileLinkActive();
            $dataSaveActive = $user->getDataSaveActive();

            $stmt->bind_param("ii", $publicProfileLinkActive, $dataSaveActive);

            $stmt->execute();
            $stmt->close();
            $con->close();
        }

        // "User" remover.
        public static function userRemover(User $user):void{
            $con = new mysqli("127.0.0.1", "root", "", "freecvcreator");

            $driver = new mysqli_driver();
            $driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;

            // SQL remover command prepared for execution.
            $stmt = $con->prepare("DELETE FROM User WHERE ID = ? AND EmailAddress = ? AND Password = ? AND UserIsAdmin = ? AND PublicProfileLinkActive = ? AND DataSaveActive = ?");

            $id = $user->getId();
            $emailAddress = $user->getEmailAddress();
            $password = $user->getPassword();
            $userIsAdmin = $user->getUserIsAdmin();
            $publicProfileLinkActive = $user->getPublicProfileLinkActive();
            $dataSaveActive = $user->getDataSaveActive();

            $stmt->bind_param("sssiii", $id, $emailAddress, $password, $userIsAdmin, $publicProfileLinkActive, $dataSaveActive);

            $stmt->execute();
            $stmt->close();
            $con->close();
        }

        // "Personal Details" actions.
        // "Personal Details" reader.
        public static function personalDetailsReader():array{
            $con = new mysqli("127.0.0.1", "root", "", "freecvcreator");

            $driver = new mysqli_driver();
            $driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;

            // SQL listing command prepared for execution.
            $stmt = $con->query("SELECT * FROM PersonalDetails ORDER BY PDID");

            $personalDetailsArray = [];

            // All personal details data collected into an array.
            while($instance = $stmt->fetch_assoc()){
                array_push($personalDetailsArray, new PersonalDetailsObjectifier(
                    new PersonalDetails(
                        strval($instance["PDID"]),
                        strval($instance["FirstName"]),
                        strval($instance["LastName"]),
                        strval($instance["Address"]),
                        strval($instance["PhoneNumber"]),
                        boolval($instance["ProfileImageExists"]),
                        strval($instance["ProfileImageTitle"]),
                        strval($instance["ProfileImagePath"]))
                ));
            }

            $con->close();

            return $personalDetailsArray;
        }

        // "Personal Details" writer.
        public static function personalDetailsWriter(PersonalDetails $personalDetails):void{
            $con = new mysqli("127.0.0.1", "root", "", "freecvcreator");

            $driver = new mysqli_driver();
            $driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;

            // SQL writer command prepared for execution.
            $stmt = $con->prepare("INSERT INTO PersonalDetails (PDID, FirstName, LastName, Address, PhoneNumber, ProfileImageExists, ProfileImageTitle, ProfileImagePath)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

            $pdid = $personalDetails->getPdid();
            $firstName = $personalDetails->getFirstName();
            $lastName = $personalDetails->getLastName();
            $address = $personalDetails->getAddress();
            $phoneNumber = $personalDetails->getPhoneNumber();
            $profileImageExists = $personalDetails->getProfileImageExists();
            $profileImageTitle = $personalDetails->getProfileImageTitle();
            $profileImagePath = $personalDetails->getProfileImagePath();

            $stmt->bind_param("sssssiss", $pdid, $firstName, $lastName, $address, $phoneNumber, $profileImageExists, $profileImageTitle, $profileImagePath);

            $stmt->execute();
            $stmt->close();
            $con->close();
        }

        // "Personal Details" updater.
        public static function personalDetailsUpdater(PersonalDetails $personalDetails):void{
            $con = new mysqli("127.0.0.1", "root", "", "freecvcreator");

            $driver = new mysqli_driver();
            $driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;

            // SQL updater command prepared for execution.
            $stmt = $con->prepare("UPDATE PersonalDetails SET PDID = ?, FirstName = ?, LastName = ?, Address = ?, PhoneNumber = ?, ProfileImageExists = ?, ProfileImageTitle = ?, ProfileImagePath = ?");

            $pdid = $personalDetails->getPdid();
            $firstName = $personalDetails->getFirstName();
            $lastName = $personalDetails->getLastName();
            $address = $personalDetails->getAddress();
            $phoneNumber = $personalDetails->getPhoneNumber();
            $profileImageExists = $personalDetails->getProfileImageExists();
            $profileImageTitle = $personalDetails->getProfileImageTitle();
            $profileImagePath = $personalDetails->getProfileImagePath();

            $stmt->bind_param("sssssiss", $pdid, $firstName, $lastName, $address, $phoneNumber, $profileImageExists, $profileImageTitle, $profileImagePath);

            $stmt->execute();
            $stmt->close();
            $con->close();
        }

        // "Personal Details" remover
        public static function personalDetailsRemover(PersonalDetails $personalDetails):void{
            $con = new mysqli("127.0.0.1", "root", "", "freecvcreator");

            $driver = new mysqli_driver();
            $driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;

            // SQL remover command prepared for execution.
            $stmt = $con->prepare("DELETE FROM PersonalDetails WHERE PDID = ? AND FirstName = ? AND LastName = ? AND Address = ? AND PhoneNumber = ? AND ProfileImageExists = ? AND ProfileImageTitle = ? AND ProfileImagePath = ?");

            $pdid = $personalDetails->getPdid();
            $firstName = $personalDetails->getFirstName();
            $lastName = $personalDetails->getLastName();
            $address = $personalDetails->getAddress();
            $phoneNumber = $personalDetails->getPhoneNumber();
            $profileImageExists = $personalDetails->getProfileImageExists();
            $profileImageTitle = $personalDetails->getProfileImageTitle();
            $profileImagePath = $personalDetails->getProfileImagePath();

            $stmt->bind_param("sssssiss", $pdid, $firstName, $lastName, $address, $phoneNumber, $profileImageExists, $profileImageTitle, $profileImagePath);

            $stmt->execute();
            $stmt->close();
            $con->close();
        }

        // "Education and Qualifications" actions.
        // "Education and Qualifications" reader.
        public static function educationAndQualificationsReader():array{
            $con = new mysqli("127.0.0.1", "root", "", "freecvcreator");

            $driver = new mysqli_driver();
            $driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;

            // SQL listing command prepared for execution.
            $stmt = $con->query("SELECT * FROM EducationAndQualifications ORDER BY EAQID");

            $educationAndQualificationsArray = [];

            // All education and qualifications data collected into an array.
            while($instance = $stmt->fetch_assoc()){
                array_push($educationAndQualificationsArray, new EducationAndQualificationsObjectifier(
                    new EducationAndQualifications(
                        strval($instance["EAQID"]),
                        strval($instance["StartOfStudy"]),
                        strval($instance["EndOfStudy"]),
                        strval($instance["InstitutionName"]),
                        strval($instance["Qualification"]),
                        strval($instance["Studies"]))
                ));
            }

            $con->close();

            return $educationAndQualificationsArray;
        }

        // "Education and Qualifications" writer.
        public static function educationAndQualificationsWriter(EducationAndQualifications $educationAndQualifications):void{
            $con = new mysqli("127.0.0.1", "root", "", "freecvcreator");

            $driver = new mysqli_driver();
            $driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;

            // SQL writer command prepared for execution.
            $stmt = $con->prepare("INSERT INTO EducationAndQualifications (EAQID, StartOfStudy, EndOfStudy, InstitutionName, Qualification, Studies)
            VALUES (?, ?, ?, ?, ?, ?)");

            $eaqid = $educationAndQualifications->getEaqid();
            $startOfStudy = $educationAndQualifications->getStartOfStudy();
            $endOfStudy = $educationAndQualifications->getEndOfStudy();
            $institutionName = $educationAndQualifications->getInstitutionName();
            $qualification = $educationAndQualifications->getQualification();
            $studies = $educationAndQualifications->getStudies();

            $stmt->bind_param("ssssss", $eaqid, $startOfStudy, $endOfStudy, $institutionName, $qualification, $studies);

            $stmt->execute();
            $stmt->close();
            $con->close();
        }

        // "Education and Qualifications" updater.
        public static function educationAndQualificationsUpdater(EducationAndQualifications $educationAndQualifications):void{
            $con = new mysqli("127.0.0.1", "root", "", "freecvcreator");

            $driver = new mysqli_driver();
            $driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;

            // SQL updater command prepared for execution.
            $stmt = $con->prepare("UPDATE EducationAndQualifications SET EAQID = ?, StartOfStudy = ?, EndOfStudy = ?, InstitutionName = ?, Qualification = ?, Studies = ?");

            $eaqid = $educationAndQualifications->getEaqid();
            $startOfStudy = $educationAndQualifications->getStartOfStudy();
            $endOfStudy = $educationAndQualifications->getEndOfStudy();
            $institutionName = $educationAndQualifications->getInstitutionName();
            $qualification = $educationAndQualifications->getQualification();
            $studies = $educationAndQualifications->getStudies();

            $stmt->bind_param("ssssss", $eaqid, $startOfStudy, $endOfStudy, $institutionName, $qualification, $studies);

            $stmt->execute();
            $stmt->close();
            $con->close();
        }

        // "Education and Qualifications" remover.
        public static function educationAndQualificationsRemover(EducationAndQualifications $educationAndQualifications):void{
            $con = new mysqli("127.0.0.1", "root", "", "freecvcreator");

            $driver = new mysqli_driver();
            $driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;

            // SQL remover command prepared for execution.
            $stmt = $con->prepare("DELETE FROM EducationAndQualifications WHERE EAQID = ? AND StartOfStudy = ? AND EndOfStudy = ? AND InstitutionName = ? AND Qualification = ? AND Studies = ?");

            $eaqid = $educationAndQualifications->getEaqid();
            $startOfStudy = $educationAndQualifications->getStartOfStudy();
            $endOfStudy = $educationAndQualifications->getEndOfStudy();
            $institutionName = $educationAndQualifications->getInstitutionName();
            $qualification = $educationAndQualifications->getQualification();
            $studies = $educationAndQualifications->getStudies();

            $stmt->bind_param("ssssss", $eaqid, $startOfStudy, $endOfStudy, $institutionName, $qualification, $studies);

            $stmt->execute();
            $stmt->close();
            $con->close();
        }

        // "Work Experience" actions.
        // "Work Experience" reader.
        public static function workExperienceReader():array{
            $con = new mysqli("127.0.0.1", "root", "", "freecvcreator");

            $driver = new mysqli_driver();
            $driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;

            // SQL listing command prepared for execution.
            $stmt = $con->query("SELECT * FROM WorkExperience ORDER BY WEID");

            $workExperienceArray = [];

            // All work experience data collected into an array.
            while($instance = $stmt->fetch_assoc()){
                array_push($workExperienceArray, new WorkExperienceObjectifier(
                    new WorkExperience(
                        strval($instance["WEID"]),
                        strval($instance["StartOfEmployment"]),
                        strval($instance["EndOfEmployment"]),
                        strval($instance["WorkplaceName"]),
                        strval($instance["Position"]),
                        strval($instance["JobDescription"]))
                ));
            }

            $con->close();

            return $workExperienceArray;
        }

        // "Work Experience" writer.
        public static function workExperienceWriter(WorkExperience $workExperience):void{
            $con = new mysqli("127.0.0.1", "root", "", "freecvcreator");

            $driver = new mysqli_driver();
            $driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;

            // SQL writer command prepared for execution.
            $stmt = $con->prepare("INSERT INTO WorkExperience (WEID, StartOfEmployment, EndOfEmployment, WorkplaceName, Position, JobDescription)
            VALUES (?, ?, ?, ?, ?, ?)");

            $weid = $workExperience->getWeid();
            $startOfEmployment = $workExperience->getStartOfEmployment();
            $endOfEmployment = $workExperience->getEndOfEmployment();
            $workplaceName = $workExperience->getWorkplaceName();
            $position = $workExperience->getPosition();
            $jobDescription = $workExperience->getJobDescription();

            $stmt->bind_param("ssssss", $weid, $startOfEmployment, $endOfEmployment, $workplaceName, $position, $jobDescription);

            $stmt->execute();
            $stmt->close();
            $con->close();
        }

        // "Work Experience" updater.
        public static function workExperienceUpdater(WorkExperience $workExperience):void{
            $con = new mysqli("127.0.0.1", "root", "", "freecvcreator");

            $driver = new mysqli_driver();
            $driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;

            // SQL updater command prepared for execution.
            $stmt = $con->prepare("UPDATE WorkExperience SET WEID = ?, StartOfEmployment = ?, EndOfEmployment = ?, WorkplaceName = ?, Position = ?, JobDescription = ?");

            $weid = $workExperience->getWeid();
            $startOfEmployment = $workExperience->getStartOfEmployment();
            $endOfEmployment = $workExperience->getEndOfEmployment();
            $workplaceName = $workExperience->getWorkplaceName();
            $position = $workExperience->getPosition();
            $jobDescription = $workExperience->getJobDescription();

            $stmt->bind_param("ssssss", $weid, $startOfEmployment, $endOfEmployment, $workplaceName, $position, $jobDescription);

            $stmt->execute();
            $stmt->close();
            $con->close();
        }

        // "Work Experience" remover.
        public static function workExperienceRemover(WorkExperience $workExperience):void{
            $con = new mysqli("127.0.0.1", "root", "", "freecvcreator");

            $driver = new mysqli_driver();
            $driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;

            // SQL remover command prepared for execution.
            $stmt = $con->prepare("DELETE FROM WorkExperience WHERE WEID = ? AND StartOfEmployment = ? AND EndOfEmployment = ? AND WorkplaceName = ? AND Position = ? AND JobDescription = ?");

            $weid = $workExperience->getWeid();
            $startOfEmployment = $workExperience->getStartOfEmployment();
            $endOfEmployment = $workExperience->getEndOfEmployment();
            $workplaceName = $workExperience->getWorkplaceName();
            $position = $workExperience->getPosition();
            $jobDescription = $workExperience->getJobDescription();

            $stmt->bind_param("ssssss", $weid, $startOfEmployment, $endOfEmployment, $workplaceName, $position, $jobDescription);

            $stmt->execute();
            $stmt->close();
            $con->close();
        }

        // "Languages" actions.
        // "Languages" reader.
        public static function languagesReader():array{
            $con = new mysqli("127.0.0.1", "root", "", "freecvcreator");

            $driver = new mysqli_driver();
            $driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;

            // SQL listing command prepared for execution.
            $stmt = $con->query("SELECT * FROM Languages ORDER BY LID");

            $languagesArray = [];

            // All languages data collected into an array.
            while($instance = $stmt->fetch_assoc()){
                array_push($languagesArray, new LanguagesObjectifier(
                    new Languages(
                        strval($instance["LID"]),
                        strval($instance["Language"]),
                        strval($instance["Level"]))
                ));
            }

            $con->close();

            return $languagesArray;
        }

        // "Languages" writer.
        public static function languagesWriter(Languages $languages):void{
            $con = new mysqli("127.0.0.1", "root", "", "freecvcreator");

            $driver = new mysqli_driver();
            $driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;

            // SQL writer command prepared for execution.
            $stmt = $con->prepare("INSERT INTO Languages (LID, Language, Level)
            VALUES (?, ?, ?)");

            $lid = $languages->getLid();
            $language = $languages->getLanguage();
            $level = $languages->getLevel();

            $stmt->bind_param("sss", $lid, $language, $level);

            $stmt->execute();
            $stmt->close();
            $con->close();
        }

        // "Languages" updater.
        public static function languagesUpdater(Languages $languages):void{
            $con = new mysqli("127.0.0.1", "root", "", "freecvcreator");

            $driver = new mysqli_driver();
            $driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;

            // SQL updater command prepared for execution.
            $stmt = $con->prepare("UPDATE Languages SET LID = ?, Language = ?, Level = ?");

            $lid = $languages->getLid();
            $language = $languages->getLanguage();
            $level = $languages->getLevel();

            $stmt->bind_param("sss", $lid, $language, $level);

            $stmt->execute();
            $stmt->close();
            $con->close();
        }

        // "Languages" remover.
        public static function languagesRemover(Languages $languages):void{
            $con = new mysqli("127.0.0.1", "root", "", "freecvcreator");

            $driver = new mysqli_driver();
            $driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;

            // SQL remover command prepared for execution.
            $stmt = $con->prepare("DELETE FROM Languages WHERE LID = ? AND Language = ? AND Level = ?");

            $lid = $languages->getLid();
            $language = $languages->getLanguage();
            $level = $languages->getLevel();

            $stmt->bind_param("sss", $lid, $language, $level);

            $stmt->execute();
            $stmt->close();
            $con->close();
        }

        // "Skills" actions.
        // "Skills" reader.
        public static function skillsReader():array{
            $con = new mysqli("127.0.0.1", "root", "", "freecvcreator");

            $driver = new mysqli_driver();
            $driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;

            // SQL listing command prepared for execution.
            $stmt = $con->query("SELECT * FROM Skills ORDER BY SID");

            $skillsArray = [];

            // All skills data collected into an array.
            while($instance = $stmt->fetch_assoc()){
                array_push($skillsArray, new SkillsObjectifier(
                    new Skills(
                        strval($instance["SID"]),
                        strval($instance["Skills"]))
                ));
            }

            $con->close();

            return $skillsArray;
        }

        // "Skills" writer.
        public static function skillsWriter(Skills $skills):void{
            $con = new mysqli("127.0.0.1", "root", "", "freecvcreator");

            $driver = new mysqli_driver();
            $driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;

            // SQL writer command prepared for execution.
            $stmt = $con->prepare("INSERT INTO Skills (SID, Skills)
            VALUES (?, ?)");

            $sid = $skills->getSid();
            $skills = $skills->getSkills();

            $stmt->bind_param("ss", $sid, $skills);

            $stmt->execute();
            $stmt->close();
            $con->close();
        }

        // "Skills" updater.
        public static function skillsUpdater(Skills $skills):void{
            $con = new mysqli("127.0.0.1", "root", "", "freecvcreator");

            $driver = new mysqli_driver();
            $driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;

            // SQL updater command prepared for execution.
            $stmt = $con->prepare("UPDATE Skills SET SID = ?, Skills = ?");

            $sid = $skills->getSid();
            $skills = $skills->getSkills();

            $stmt->bind_param("ss", $sid, $skills);

            $stmt->execute();
            $stmt->close();
            $con->close();
        }

        // "Skills" remover.
        public static function skillsRemover(Skills $skills):void{
            $con = new mysqli("127.0.0.1", "root", "", "freecvcreator");

            $driver = new mysqli_driver();
            $driver->report_mode = MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR;

            // SQL remover command prepared for execution.
            $stmt = $con->prepare("DELETE FROM Skills WHERE SID = ? AND Skills = ?");

            $sid = $skills->getSid();
            $skills = $skills->getSkills();

            $stmt->bind_param("ss", $sid, $skills);

            $stmt->execute();
            $stmt->close();
            $con->close();
        }
    }
?>