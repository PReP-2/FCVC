<?php
    // Initiates the $_SESSION superglobal variable.
    session_start();

    // Loads all dependency files.
    require_once("../01-model/database-manager.php");
    require_once("../01-model/model-objectifier.php");
    require_once("../01-model/user-model.php");
    require_once("../01-model/personal-details-model.php");
    require_once("../01-model/education-and-qualifications-model.php");
    require_once("../01-model/work-experience-model.php");
    require_once("../01-model/languages-model.php");
    require_once("../01-model/skills-model.php");

    // All data in the database will be requested from the server upon a log in attempt.
    $userArray = DatabaseManager::userReader();
    $personalDetailsArray = DatabaseManager::personalDetailsReader();
    $educationAndQualificationsArray = DatabaseManager::educationAndQualificationsReader();
    $workExperienceArray = DatabaseManager::workExperienceReader();
    $languagesArray = DatabaseManager::languagesReader();
    $skillsArray = DatabaseManager::skillsReader();

    // "User" data arrays prepared to put into session upon successful log in.
    $userArrayToSession = array();
    $personalDetailsArrayToSession = array();
    $educationAndQualificationsArrayToSession = array();
    $workExperienceArrayToSession = array();
    $languagesArrayToSession = array();
    $skillsArrayToSession = array();

    // Log in status saved in session.
    $_SESSION["userIsLoggedIn"] = false;

    // The log in data input is validated.
    if(array_key_exists("inputEmailLogin", $_POST) && isset($_POST["inputEmailLogin"]) && array_key_exists("inputPasswordLogin", $_POST) && isset($_POST["inputPasswordLogin"])){
        for($i = 0; $i < count($userArray); $i++){
            // The collected server data is matched against the log in data input. If the data exist is the database, they will be pushed into an array.
            if($userArray[$i]->getUser()->getEmailAddress() == $_POST["inputEmailLogin"] && $userArray[$i]->getUser()->getPassword() == $_POST["inputPasswordLogin"]){
                $userId = $userArray[$i]->getUser()->getId();
                $userEmailAddress = $userArray[$i]->getUser()->getEmailAddress();
                $userPassword = $userArray[$i]->getUser()->getPassword();
                $userUserIsAdmin = $userArray[$i]->getUser()->getUserIsAdmin();
                $userPublicProfileLinkActive = $userArray[$i]->getUser()->getPublicProfileLinkActive();
                $userDataSaveActive = $userArray[$i]->getUser()->getDataSaveActive();
    
                $userArrayPrepared = array();
    
                array_push($userArrayPrepared, $userId, $userEmailAddress, $userPassword, $userUserIsAdmin, $userPublicProfileLinkActive, $userDataSaveActive);
    
                // And the prepared data array is pushed into another array before put into session, so each array key in the session will belong to a different "User" containing all of their data.
                array_push($userArrayToSession, $userArrayPrepared);

                // And the log in status is updated.
                $_SESSION["userIsLoggedIn"] = true;
            }
        }
    }

    $_SESSION["userArray"] = $userArrayToSession;

    // If the log in was successful and any "Personal Details" data exist on the server, it will be cycled through.
    if(array_key_exists("userIsLoggedIn", $_SESSION) && $_SESSION["userIsLoggedIn"] == true && count($personalDetailsArray) != 0){
        for($j = 0; $j < count($personalDetailsArray); $j++){
            // The collected server data ("Personal Details" ID referencing the "User" ID) is matched against the "User" ID in session. If the data exist is the database, they will be pushed into an array.
            if($personalDetailsArray[$j]->getPersonalDetails()->getPdid() == $_SESSION["userArray"][0][0]){
                $personalDetailsPdid = $personalDetailsArray[$j]->getPersonalDetails()->getPdid();
                $personalDetailsFirstName = $personalDetailsArray[$j]->getPersonalDetails()->getFirstName();
                $personalDetailsLastName = $personalDetailsArray[$j]->getPersonalDetails()->getLastName();
                $personalDetailsAddress = $personalDetailsArray[$j]->getPersonalDetails()->getAddress();
                $personalDetailsPhoneNumber = $personalDetailsArray[$j]->getPersonalDetails()->getPhoneNumber();
                $personalDetailsProfileImageExists = $personalDetailsArray[$j]->getPersonalDetails()->getProfileImageExists();
                $personalDetailsProfileImageTitle = $personalDetailsArray[$j]->getPersonalDetails()->getProfileImageTitle();
                $personalDetailsProfileImagePath = $personalDetailsArray[$j]->getPersonalDetails()->getProfileImagePath();

                $personalDetailsArrayPrepared = array();

                array_push($personalDetailsArrayPrepared, $personalDetailsPdid, $personalDetailsFirstName, $personalDetailsLastName, $personalDetailsAddress, $personalDetailsPhoneNumber, $personalDetailsProfileImageExists, $personalDetailsProfileImageTitle, $personalDetailsProfileImagePath);

                // And the prepared data array is pushed into another array before put into session, so each array key in the session will belong to a different "User" containing all of their data.
                array_push($personalDetailsArrayToSession, $personalDetailsArrayPrepared);
            }
        }
    }

    $_SESSION["personalDetailsArray"] = $personalDetailsArrayToSession;

    // If the log in was successful and any "Education and Qualifications" data exist on the server, it will be cycled through.
    if(array_key_exists("userIsLoggedIn", $_SESSION) && $_SESSION["userIsLoggedIn"] == true && count($educationAndQualificationsArray) != 0){
        for($k = 0; $k < count($educationAndQualificationsArray); $k++){
            // The collected server data ("Education and Qualifications" ID referencing the "User" ID) is matched against the "User" ID in session. If the data exist is the database, they will be pushed into an array.
            if($educationAndQualificationsArray[$k]->getEducationAndQualifications()->getEaqid() == $_SESSION["userArray"][0][0]){
                $educationAndQualificationsEaqid = $educationAndQualificationsArray[$k]->getEducationAndQualifications()->getEaqid();
                $educationAndQualificationsStartOfStudy = $educationAndQualificationsArray[$k]->getEducationAndQualifications()->getStartOfStudy();
                $educationAndQualificationsEndOfStudy = $educationAndQualificationsArray[$k]->getEducationAndQualifications()->getEndOfStudy();
                $educationAndQualificationsInstitutionName = $educationAndQualificationsArray[$k]->getEducationAndQualifications()->getInstitutionName();
                $educationAndQualificationsQualification = $educationAndQualificationsArray[$k]->getEducationAndQualifications()->getQualification();
                $educationAndQualificationsStudies = $educationAndQualificationsArray[$k]->getEducationAndQualifications()->getStudies();

                $educationAndQualificationsArrayPrepared = array();

                array_push($educationAndQualificationsArrayPrepared, $educationAndQualificationsEaqid, $educationAndQualificationsStartOfStudy, $educationAndQualificationsEndOfStudy, $educationAndQualificationsInstitutionName, $educationAndQualificationsQualification, $educationAndQualificationsStudies);

                // And the prepared data array is pushed into another array before put into session, so each array key in the session will belong to a different "User" containing all of their data.
                array_push($educationAndQualificationsArrayToSession, $educationAndQualificationsArrayPrepared);
            }
        }
    }

    $_SESSION["educationAndQualificationsArray"] = $educationAndQualificationsArrayToSession;

    // If the log in was successful and any "Work Experience" data exist on the server, it will be cycled through.
    if(array_key_exists("userIsLoggedIn", $_SESSION) && $_SESSION["userIsLoggedIn"] == true && count($workExperienceArray) != 0){
        for($l = 0; $l < count($workExperienceArray); $l++){
            // The collected server data ("Work Experience" ID referencing the "User" ID) is matched against the "User" ID in session. If the data exist is the database, they will be pushed into an array.
            if($workExperienceArray[$l]->getWorkExperience()->getWeid() == $_SESSION["userArray"][0][0]){
                $workExperienceWeid = $workExperienceArray[$l]->getWorkExperience()->getWeid();
                $workExperienceStartOfEmployment = $workExperienceArray[$l]->getWorkExperience()->getStartOfEmployment();
                $workExperienceEndOfEmployment = $workExperienceArray[$l]->getWorkExperience()->getEndOfEmployment();
                $workExperienceWorkplaceName = $workExperienceArray[$l]->getWorkExperience()->getWorkplaceName();
                $workExperiencePosition = $workExperienceArray[$l]->getWorkExperience()->getPosition();
                $workExperienceJobDescription = $workExperienceArray[$l]->getWorkExperience()->getJobDescription();

                $workExperienceArrayPrepared = array();

                array_push($workExperienceArrayPrepared, $workExperienceWeid, $workExperienceStartOfEmployment, $workExperienceEndOfEmployment, $workExperienceWorkplaceName, $workExperiencePosition, $workExperienceJobDescription);

                // And the prepared data array is pushed into another array before put into session, so each array key in the session will belong to a different "User" containing all of their data.
                array_push($workExperienceArrayToSession, $workExperienceArrayPrepared);
            }
        }
    }

    $_SESSION["workExperienceArray"] = $workExperienceArrayToSession;

    // If the log in was successful and any "Languages" data exist on the server, it will be cycled through.
    if(array_key_exists("userIsLoggedIn", $_SESSION) && $_SESSION["userIsLoggedIn"] == true && count($languagesArray) != 0){
        for($m = 0; $m < count($languagesArray); $m++){
            // The collected server data ("Languages" ID referencing the "User" ID) is matched against the "User" ID in session. If the data exist is the database, they will be pushed into an array.
            if($languagesArray[$m]->getLanguages()->getLid() == $_SESSION["userArray"][0][0]){
                $languagesLid = $languagesArray[$m]->getLanguages()->getLid();
                $languagesLanguage = $languagesArray[$m]->getLanguages()->getLanguage();
                $languagesLevel = $languagesArray[$m]->getLanguages()->getLevel();

                $languagesArrayPrepared = array();

                array_push($languagesArrayPrepared, $languagesLid, $languagesLanguage, $languagesLevel);

                // And the prepared data array is pushed into another array before put into session, so each array key in the session will belong to a different "User" containing all of their data.
                array_push($languagesArrayToSession, $languagesArrayPrepared);
            }
        }
    }

    $_SESSION["languagesArray"] = $languagesArrayToSession;

    // If the log in was successful and any "Skills" data exist on the server, it will be cycled through.
    if(array_key_exists("userIsLoggedIn", $_SESSION) && $_SESSION["userIsLoggedIn"] == true && count($skillsArray) != 0){
        for($n = 0; $n < count($skillsArray); $n++){
            // The collected server data ("Skills" ID referencing the "User" ID) is matched against the "User" ID in session. If the data exist is the database, they will be pushed into an array.
            if($skillsArray[$n]->getSkills()->getSid() == $_SESSION["userArray"][0][0]){
                $skillsSid = $skillsArray[$n]->getSkills()->getSid();
                $skillsSkills = $skillsArray[$n]->getSkills()->getSkills();

                $skillsArrayPrepared = array();

                array_push($skillsArrayPrepared, $skillsSid, $skillsSkills);

                // And the prepared data array is pushed into another array before put into session, so each array key in the session will belong to a different "User" containing all of their data.
                array_push($skillsArrayToSession, $skillsArrayPrepared);
            }
        }
    }

    $_SESSION["skillsArray"] = $skillsArrayToSession;

    // The page will be refreshed to load the "User" data.
    header("Location: ../../?page=homeView");
    exit;
?>