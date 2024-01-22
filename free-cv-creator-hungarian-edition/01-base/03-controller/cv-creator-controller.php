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

    // "User" updater.
    $userPublicProfileLinkActive = (array_key_exists("makeMyProfilePublic", $_POST) && $_POST["makeMyProfilePublic"] == "checked") ? true : false;
    $userDataSaveActive = $_SESSION["userArray"][0][5];
    // This is part of a feature that will be implemented in the future. $userDataSaveActive = ($_POST["saveMyData"] == "checked") ? true : false;

    DatabaseManager::userUpdater(new User("", "", "", "", $userPublicProfileLinkActive, $userDataSaveActive));

    // Directory and file remover.
    function delTree($dir) {
        $files = array_diff(scandir($dir), array('.','..'));
 
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }

    // PDF directory.
    $pdfDir = "../../05-public/" . $_SESSION["userArray"][0][0] . "/";

    // A temporary directory will be created for uploaded profile images.
    $profileImageDir = "../../06-temp/" . $_SESSION["userArray"][0][0] . "/";

    if(file_exists($profileImageDir) == false){
        mkdir($profileImageDir);
    }

    // Profile image uploader.
    $profileImage = $profileImageDir . basename($_FILES["profileImage"]["name"]);

    $imageFileType = strtolower(pathinfo($profileImage, PATHINFO_EXTENSION));
    $imagePath = pathinfo($profileImage);

    // Upload status and feedback variables.
    $_SESSION["imageUploadStatus"] = "";
    $_SESSION["imageUploadFeedback"] = "";

    // "Personal Details" actions (update-write-delete).
    function personalDetailsActions(){
        $profileImageDir = "../../06-temp/" . $_SESSION["userArray"][0][0] . "/";

        $profileImage = $profileImageDir . basename($_FILES["profileImage"]["name"]);

        $imagePath = pathinfo($profileImage);

        // If any "Personal Details" data exist on the server, it will be updated.
        if(array_key_exists("personalDetailsArray", $_SESSION) && count($_SESSION["personalDetailsArray"]) != 0){

            // Checks if the uploaded image directory is empty.
            $isDirEmpty = !(new \FilesystemIterator($profileImageDir))->valid();

            $personalDetailsPdid = $_SESSION["userArray"][0][0];
            $personalDetailsFirstName = $_POST["inputFirstName"];
            $personalDetailsLastName = $_POST["inputLastName"];
            $personalDetailsAddress = $_POST["inputAddress"];
            $personalDetailsPhoneNumber = $_POST["inputPhoneNumber"];
            $personalDetailsProfileImageExists = (file_exists($profileImageDir) == true && $isDirEmpty == false) ? true : false;
            $personalDetailsProfileImageTitle = (file_exists($profileImageDir) == true && $isDirEmpty == false) ? $_FILES["profileImage"]["name"] : "";
            $personalDetailsProfileImagePath = (file_exists($profileImageDir) == true && $isDirEmpty == false) ? $imagePath["dirname"] . "/" . $imagePath["basename"] : "";

            DatabaseManager::personalDetailsUpdater(new PersonalDetails($personalDetailsPdid, $personalDetailsFirstName, $personalDetailsLastName, $personalDetailsAddress, $personalDetailsPhoneNumber,  $personalDetailsProfileImageExists, $personalDetailsProfileImageTitle, $personalDetailsProfileImagePath));
        }
        // If no "Personal Details" data exist on the server, or the array is empty, the data will be saved to the server.
        elseif(array_key_exists("personalDetailsArray", $_SESSION) == false || (array_key_exists("personalDetailsArray", $_SESSION) && count($_SESSION["personalDetailsArray"]) == 0)){

            // Checks if the uploaded image directory is empty.
            $isDirEmpty = !(new \FilesystemIterator($profileImageDir))->valid();

            $personalDetailsPdid = $_SESSION["userArray"][0][0];
            $personalDetailsFirstName = $_POST["inputFirstName"];
            $personalDetailsLastName = $_POST["inputLastName"];
            $personalDetailsAddress = $_POST["inputAddress"];
            $personalDetailsPhoneNumber = $_POST["inputPhoneNumber"];
            $personalDetailsProfileImageExists = (file_exists($profileImageDir) == true && $isDirEmpty == false) ? true : false;
            $personalDetailsProfileImageTitle = (file_exists($profileImageDir) == true && $isDirEmpty == false) ? $_FILES["profileImage"]["name"] : "";
            $personalDetailsProfileImagePath = (file_exists($profileImageDir) == true && $isDirEmpty == false) ? $imagePath["dirname"] . "/" . $imagePath["basename"] : "";

            DatabaseManager::personalDetailsWriter(new PersonalDetails($personalDetailsPdid, $personalDetailsFirstName, $personalDetailsLastName, $personalDetailsAddress, $personalDetailsPhoneNumber,  $personalDetailsProfileImageExists, $personalDetailsProfileImageTitle, $personalDetailsProfileImagePath));
        }
        /* This is part of a feature that will be implemented in the future.
        // If any "Personal Details" data exist on the server, but the "saveMyData" checkbox is unchecked, it will be cycled through and removed from the server.
        elseif($_POST["saveMyData"] != "checked" && array_key_exists("personalDetailsArray", $_SESSION) && count($_SESSION["personalDetailsArray"]) != 0){

            // Checks if the uploaded image directory is empty.
            $isDirEmpty = !(new \FilesystemIterator($profileImageDir))->valid();

            for($i = 0; $i < count($_SESSION["personalDetailsArray"]); $i++){
                $personalDetailsPdid = $_SESSION["personalDetailsArray"][$i][0];
                $personalDetailsFirstName = $_SESSION["personalDetailsArray"][$i][1];
                $personalDetailsLastName = $_SESSION["personalDetailsArray"][$i][2];
                $personalDetailsAddress = $_SESSION["personalDetailsArray"][$i][3];
                $personalDetailsPhoneNumber = $_SESSION["personalDetailsArray"][$i][4];
                $personalDetailsProfileImageExists = $_SESSION["personalDetailsArray"][$i][5];
                $personalDetailsProfileImageTitle = $_SESSION["personalDetailsArray"][$i][6];
                $personalDetailsProfileImagePath = $_SESSION["personalDetailsArray"][$i][7];

                DatabaseManager::personalDetailsRemover(new PersonalDetails($personalDetailsPdid, $personalDetailsFirstName, $personalDetailsLastName, $personalDetailsAddress, $personalDetailsPhoneNumber,  $personalDetailsProfileImageExists, $personalDetailsProfileImageTitle, $personalDetailsProfileImagePath));
            }
            // The user's temporary directory of the uploaded profile image will be removed with its content from the server.
            delTree($profileImageDir);
        } */
    }

    // "Education and Qualifications" actions (delete/write-write-delete).
    // If any "Education and Qualifications" data exist on the server, it will be cycled through and removed, and the new data will be cycled through and saved to the server.
    if(array_key_exists("educationAndQualificationsArray", $_SESSION) && count($_SESSION["educationAndQualificationsArray"]) != 0){
        for($j = 0; $j < count($_SESSION["educationAndQualificationsArray"]); $j++){
            $educationAndQualificationsEaqid = $_SESSION["educationAndQualificationsArray"][$j][0];
            $educationAndQualificationsStartOfStudy = $_SESSION["educationAndQualificationsArray"][$j][1];
            $educationAndQualificationsEndOfStudy = $_SESSION["educationAndQualificationsArray"][$j][2];
            $educationAndQualificationsInstitutionName = $_SESSION["educationAndQualificationsArray"][$j][3];
            $educationAndQualificationsQualification = $_SESSION["educationAndQualificationsArray"][$j][4];
            $educationAndQualificationsStudies = $_SESSION["educationAndQualificationsArray"][$j][5];

            DatabaseManager::educationAndQualificationsRemover(new EducationAndQualifications($educationAndQualificationsEaqid, $educationAndQualificationsStartOfStudy, $educationAndQualificationsEndOfStudy, $educationAndQualificationsInstitutionName, $educationAndQualificationsQualification,  $educationAndQualificationsStudies));
        }

        for($ji = 0; $ji <= intval($_POST["educationAndQualificationsTemplateCounter"]); $ji++){
        $educationAndQualificationsEaqid = $_SESSION["userArray"][0][0];
        $educationAndQualificationsStartOfStudy = $_POST["inputStartOfStudy" . $ji];
        $educationAndQualificationsEndOfStudy = $_POST["inputEndOfStudy" . $ji];
        $educationAndQualificationsInstitutionName = $_POST["inputInstitutionName" . $ji];
        $educationAndQualificationsQualification = $_POST["inputQualification" . $ji];
        $educationAndQualificationsStudies = $_POST["inputStudies" . $ji];

        DatabaseManager::educationAndQualificationsWriter(new EducationAndQualifications($educationAndQualificationsEaqid, $educationAndQualificationsStartOfStudy, $educationAndQualificationsEndOfStudy, $educationAndQualificationsInstitutionName, $educationAndQualificationsQualification,  $educationAndQualificationsStudies));
        }
    }
    // If no "Education and Qualifications" data exist on the server, or the array is empty, the data will be saved to the server.
    elseif(array_key_exists("educationAndQualificationsArray", $_SESSION) == false || (array_key_exists("educationAndQualificationsArray", $_SESSION) && count($_SESSION["educationAndQualificationsArray"]) == 0)){
        for($j = 0; $j <= intval($_POST["educationAndQualificationsTemplateCounter"]); $j++){
            $educationAndQualificationsEaqid = $_SESSION["userArray"][0][0];
            $educationAndQualificationsStartOfStudy = $_POST["inputStartOfStudy" . $j];
            $educationAndQualificationsEndOfStudy = $_POST["inputEndOfStudy" . $j];
            $educationAndQualificationsInstitutionName = $_POST["inputInstitutionName" . $j];
            $educationAndQualificationsQualification = $_POST["inputQualification" . $j];
            $educationAndQualificationsStudies = $_POST["inputStudies" . $j];
    
            DatabaseManager::educationAndQualificationsWriter(new EducationAndQualifications($educationAndQualificationsEaqid, $educationAndQualificationsStartOfStudy, $educationAndQualificationsEndOfStudy, $educationAndQualificationsInstitutionName, $educationAndQualificationsQualification,  $educationAndQualificationsStudies));
        }
    }
    /* This is part of a feature that will be implemented in the future.
    // If any "Education and Qualifications" data exist on the server, but the "saveMyData" checkbox is unchecked, it will be cycled through and removed from the server.
    elseif($_POST["saveMyData"] != "checked" && array_key_exists("educationAndQualificationsArray", $_SESSION) && count($_SESSION["educationAndQualificationsArray"]) != 0){
        for($j = 0; $j < count($_SESSION["educationAndQualificationsArray"]); $j++){
            $educationAndQualificationsEaqid = $_SESSION["educationAndQualificationsArray"][$j][0];
            $educationAndQualificationsStartOfStudy = $_SESSION["educationAndQualificationsArray"][$j][1];
            $educationAndQualificationsEndOfStudy = $_SESSION["educationAndQualificationsArray"][$j][2];
            $educationAndQualificationsInstitutionName = $_SESSION["educationAndQualificationsArray"][$j][3];
            $educationAndQualificationsQualification = $_SESSION["educationAndQualificationsArray"][$j][4];
            $educationAndQualificationsStudies = $_SESSION["educationAndQualificationsArray"][$j][5];

            DatabaseManager::educationAndQualificationsRemover(new EducationAndQualifications($educationAndQualificationsEaqid, $educationAndQualificationsStartOfStudy, $educationAndQualificationsEndOfStudy, $educationAndQualificationsInstitutionName, $educationAndQualificationsQualification,  $educationAndQualificationsStudies));
        }
    } */

    // "Work Experience" actions (delete-delete/write-write).
    // Some of these conditions are part of a feature that will be implemented in the future.
    // If any "Work Experience" data exist on the server, but the "saveMyData" checkbox is unchecked or any "Work Experience" data exist on the server and "saveMyData" checkbox is checked and "I am a freshman" checkbox is checked, it will be cycled through and removed from the server.
    if(/* ($_POST["saveMyData"] != "checked" && array_key_exists("workExperienceArray", $_SESSION) && count($_SESSION["workExperienceArray"]) != 0) ||  */(/* $_POST["saveMyData"] == "checked" &&  */array_key_exists("workExperienceArray", $_SESSION) && count($_SESSION["workExperienceArray"]) != 0 && array_key_exists("iAmAfreshman", $_POST) && $_POST["iAmAfreshman"] == "checked")){
        for($k = 0; $k < count($_SESSION["workExperienceArray"]); $k++){
            $workExperienceWeid = $_SESSION["workExperienceArray"][$k][0];
            $workExperienceStartOfEmployment = $_SESSION["workExperienceArray"][$k][1];
            $workExperienceEndOfEmployment = $_SESSION["workExperienceArray"][$k][2];
            $workExperienceWorkplaceName = $_SESSION["workExperienceArray"][$k][3];
            $workExperiencePosition = $_SESSION["workExperienceArray"][$k][4];
            $workExperienceJobDescription = $_SESSION["workExperienceArray"][$k][5];

            DatabaseManager::workExperienceRemover(new WorkExperience($workExperienceWeid, $workExperienceStartOfEmployment, $workExperienceEndOfEmployment, $workExperienceWorkplaceName, $workExperiencePosition,  $workExperienceJobDescription));
        }
    }
    // If any "Work Experience" data exist on the server and "I am a freshman" checkbox is unchecked, it will be cycled through and removed, and the new data will be cycled through and saved to the server.
    elseif((array_key_exists("workExperienceArray", $_SESSION) && count($_SESSION["workExperienceArray"]) != 0 && array_key_exists("iAmAfreshman", $_POST) && $_POST["iAmAfreshman"] != "checked") || (array_key_exists("workExperienceArray", $_SESSION) && count($_SESSION["workExperienceArray"]) != 0)){
        for($k = 0; $k < count($_SESSION["workExperienceArray"]); $k++){
            $workExperienceWeid = $_SESSION["workExperienceArray"][$k][0];
            $workExperienceStartOfEmployment = $_SESSION["workExperienceArray"][$k][1];
            $workExperienceEndOfEmployment = $_SESSION["workExperienceArray"][$k][2];
            $workExperienceWorkplaceName = $_SESSION["workExperienceArray"][$k][3];
            $workExperiencePosition = $_SESSION["workExperienceArray"][$k][4];
            $workExperienceJobDescription = $_SESSION["workExperienceArray"][$k][5];

            DatabaseManager::workExperienceRemover(new WorkExperience($workExperienceWeid, $workExperienceStartOfEmployment, $workExperienceEndOfEmployment, $workExperienceWorkplaceName, $workExperiencePosition,  $workExperienceJobDescription));
        }

        for($ki = 0; $ki <= intval($_POST["workExperienceTemplateCounter"]); $ki++){
            $workExperienceWeid = $_SESSION["userArray"][0][0];
            $workExperienceStartOfEmployment = $_POST["inputStartOfEmployment" . $ki];
            $workExperienceEndOfEmployment = $_POST["inputEndOfEmployment" . $ki];
            $workExperienceWorkplaceName = $_POST["inputWorkplaceName" . $ki];
            $workExperiencePosition = $_POST["inputPosition" . $ki];
            $workExperienceJobDescription = $_POST["inputJobDescription" . $ki];

            DatabaseManager::workExperienceWriter(new WorkExperience($workExperienceWeid, $workExperienceStartOfEmployment, $workExperienceEndOfEmployment, $workExperienceWorkplaceName, $workExperiencePosition,  $workExperienceJobDescription));
        }
    }
    // If no "Work Experience" data exist on the server and "I am a freshman" checkbox is unchecked, or the array is empty and "I am a freshman" checkbox is unchecked, the data will be saved to the server.
    elseif((array_key_exists("workExperienceArray", $_SESSION) == false && array_key_exists("iAmAfreshman", $_POST) && $_POST["iAmAfreshman"] != "checked") || (array_key_exists("workExperienceArray", $_SESSION) && count($_SESSION["workExperienceArray"]) == 0 && array_key_exists("iAmAfreshman", $_POST) &&  $_POST["iAmAfreshman"] != "checked") || (array_key_exists("workExperienceArray", $_SESSION) == false) || (array_key_exists("workExperienceArray", $_SESSION) && count($_SESSION["workExperienceArray"]) == 0)){
        for($k = 0; $k <= intval($_POST["workExperienceTemplateCounter"]); $k++){
            $workExperienceWeid = $_SESSION["userArray"][0][0];
            $workExperienceStartOfEmployment = $_POST["inputStartOfEmployment" . $k];
            $workExperienceEndOfEmployment = $_POST["inputEndOfEmployment" . $k];
            $workExperienceWorkplaceName = $_POST["inputWorkplaceName" . $k];
            $workExperiencePosition = $_POST["inputPosition" . $k];
            $workExperienceJobDescription = $_POST["inputJobDescription" . $k];

            DatabaseManager::workExperienceWriter(new WorkExperience($workExperienceWeid, $workExperienceStartOfEmployment, $workExperienceEndOfEmployment, $workExperienceWorkplaceName, $workExperiencePosition,  $workExperienceJobDescription));
        }
    }

    // "Languages" actions (delete/write-write-delete).
    // If any "Languages" data exist on the server and the inputs are not empty, it will be cycled through and removed, and the new data will be cycled through and saved to the server.
    if(array_key_exists("languagesArray", $_SESSION) && count($_SESSION["languagesArray"]) != 0 && $_POST["inputLanguage" . intval($_POST["languagesTemplateCounter"])] != "" && $_POST["inputLevel" . intval($_POST["languagesTemplateCounter"])] != ""){
        for($l = 0; $l < count($_SESSION["languagesArray"]); $l++){
            $languagesLid = $_SESSION["languagesArray"][$l][0];
            $languagesLanguage = $_SESSION["languagesArray"][$l][1];
            $languagesLevel = $_SESSION["languagesArray"][$l][2];

            DatabaseManager::languagesRemover(new Languages($languagesLid, $languagesLanguage, $languagesLevel));
        }

        for($li = 0; $li <= intval($_POST["languagesTemplateCounter"]); $li++){
            $languagesLid = $_SESSION["userArray"][0][0];
            $languagesLanguage = $_POST["inputLanguage" . $li];
            $languagesLevel = $_POST["inputLevel" . $li];

            DatabaseManager::languagesWriter(new Languages($languagesLid, $languagesLanguage, $languagesLevel));
        } 
    }
    // If no "Languages" data exist on the server and the inputs are not empty, or the array is empty and the inputs are not empty, the data will be saved to the server.
    elseif((array_key_exists("languagesArray", $_SESSION) == false && $_POST["inputLanguage" . intval($_POST["languagesTemplateCounter"])] != "" && $_POST["inputLevel" . intval($_POST["languagesTemplateCounter"])] != "") || (array_key_exists("languagesArray", $_SESSION) && count($_SESSION["languagesArray"]) == 0 && $_POST["inputLanguage" . intval($_POST["languagesTemplateCounter"])] != "" && $_POST["inputLevel" . intval($_POST["languagesTemplateCounter"])] != "")){
        for($l = 0; $l <= intval($_POST["languagesTemplateCounter"]); $l++){
            $languagesLid = $_SESSION["userArray"][0][0];
            $languagesLanguage = $_POST["inputLanguage" . $l];
            $languagesLevel = $_POST["inputLevel" . $l];

            DatabaseManager::languagesWriter(new Languages($languagesLid, $languagesLanguage, $languagesLevel));
        } 
    }
    // Some of these conditions are part of a feature that will be implemented in the future.
    // If any "Languages" data exist on the server, but the "saveMyData" checkbox is unchecked or any "Languages" data exist on the server and "saveMyData" checkbox is checked and the inputs are empty, it will be cycled through and removed from the server.
    elseif(/* ($_POST["saveMyData"] != "checked" && array_key_exists("languagesArray", $_SESSION) && count($_SESSION["languagesArray"]) != 0) ||  */(/* $_POST["saveMyData"] == "checked" &&  */array_key_exists("languagesArray", $_SESSION) && count($_SESSION["languagesArray"]) != 0 && $_POST["inputLanguage" . intval($_POST["languagesTemplateCounter"])] == "" && $_POST["inputLevel" . intval($_POST["languagesTemplateCounter"])] == "")){
        for($l = 0; $l < count($_SESSION["languagesArray"]); $l++){
            $languagesLid = $_SESSION["languagesArray"][$l][0];
            $languagesLanguage = $_SESSION["languagesArray"][$l][1];
            $languagesLevel = $_SESSION["languagesArray"][$l][2];

            DatabaseManager::languagesRemover(new Languages($languagesLid, $languagesLanguage, $languagesLevel));
        }
    }

    // "Skills" actions (update-write-delete).
    // If any "Skills" data exist on the server and the input is not empty, it will be updated.
    if(array_key_exists("skillsArray", $_SESSION) && count($_SESSION["skillsArray"]) != 0 && $_POST["inputSkills"] != ""){
        $skillsSid = $_SESSION["userArray"][0][0];
        $skillsSkills = $_POST["inputSkills"];

        DatabaseManager::skillsUpdater(new Skills($skillsSid, $skillsSkills));
    }
    // If no "Skills" data exist on the server and the input is not empty, or the array is empty and the input is not empty, the data will be saved to the server.
    elseif((array_key_exists("skillsArray", $_SESSION) == false && $_POST["inputSkills"] != "") || array_key_exists("skillsArray", $_SESSION) && count($_SESSION["skillsArray"]) == 0 && $_POST["inputSkills"] != ""){
        $skillsSid = $_SESSION["userArray"][0][0];
        $skillsSkills = $_POST["inputSkills"];

        DatabaseManager::skillsWriter(new Skills($skillsSid, $skillsSkills));
    }
    //This is part of a feature that will be implemented in the future.
    // If any "Skills" data exist on the server, but the "saveMyData" checkbox is unchecked, or any "Skills" data exist on the server and "saveMyData" checkbox is checked and the input is not empty, it will be cycled through and removed from the server.
    elseif(/* ($_POST["saveMyData"] != "checked" && array_key_exists("skillsArray", $_SESSION) && count($_SESSION["skillsArray"]) != 0) ||  */(/* $_POST["saveMyData"] == "checked" &&  */array_key_exists("skillsArray", $_SESSION) && count($_SESSION["skillsArray"]) != 0 && $_POST["inputSkills"] == "")){
        for($m = 0; $m < count($_SESSION["skillsArray"]); $m++){
            $skillsSid = $_SESSION["skillsArray"][$m][0];
            $skillsSkills = $_SESSION["skillsArray"][$m][1];

            DatabaseManager::skillsRemover(new Skills($skillsSid, $skillsSkills));
        }
    }

    // All data in the database will be requested from the server to update any changes.
    $userArray = DatabaseManager::userReader();
    $educationAndQualificationsArray = DatabaseManager::educationAndQualificationsReader();
    $workExperienceArray = DatabaseManager::workExperienceReader();
    $languagesArray = DatabaseManager::languagesReader();
    $skillsArray = DatabaseManager::skillsReader();

    // "User" data arrays prepared to put into session upon successful log in.
    $userArrayToSession = array();
    $educationAndQualificationsArrayToSession = array();
    $workExperienceArrayToSession = array();
    $languagesArrayToSession = array();
    $skillsArrayToSession = array();

    for($i = 0; $i < count($userArray); $i++){
        // The collected server data ("User" ID) is matched against the "User" ID in session. If the data exist is the database, they will be pushed into an array.
        if($userArray[$i]->getUser()->getId() == $_SESSION["userArray"][0][0]){
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
        }
    }

    $_SESSION["userArray"] = $userArrayToSession;

    function personalDetailsReader(){
        $personalDetailsArray = DatabaseManager::personalDetailsReader();
        $personalDetailsArrayToSession = array();

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

        $_SESSION["personalDetailsArray"] = $personalDetailsArrayToSession;
    }

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

    $_SESSION["educationAndQualificationsArray"] = $educationAndQualificationsArrayToSession;

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

    $_SESSION["workExperienceArray"] = $workExperienceArrayToSession;

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

    $_SESSION["languagesArray"] = $languagesArrayToSession;

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

    $_SESSION["skillsArray"] = $skillsArrayToSession;

    // Profile image upload validator.
    if(isset($_POST["submitForm"])){
        $uploadOk = 1;

        $check = getimagesize($_FILES["profileImage"]["tmp_name"]);

        // Checks if the attempted file upload is an actual image or fake.
        if($check !== false) {
            $uploadOk = 1;

            // Checks file size. Max 5MB is allowed.
            if($_FILES["profileImage"]["size"] > 5000000){

                // File is too large.
                $uploadOk = 0;

                $_SESSION["imageUploadFeedback"] = "File is too large! Max. 5MB is allowed!";
            }
            // Checks file format. Only JPG, JPEG, PNG, GIF files are allowed.
            elseif($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif"){

                // Wrong image format.
                $uploadOk = 0;

                $_SESSION["imageUploadFeedback"] = "Only JPG, JPEG, PNG, GIF files are allowed!";
            }
        }
        else{
            // File is not an image.
            $uploadOk = 0;

            $_SESSION["imageUploadFeedback"] = "File is not an image!";
        }

        // Checks if $uploadOk is set to 0 by an error.
        if($uploadOk == 0){
            personalDetailsActions();
            personalDetailsReader();

            if($_SESSION["userArray"][0][4] == false){
                // If the PDF exists on the server, but the "Make my profile public" checkbox was unchecked, the PDF with its directory will be deleted from the server.
                if(file_exists($pdfDir)){
                    delTree($pdfDir);
                }
            }

            // The profile image directory will be deleted from the server after a failed submit.
            if(file_exists($profileImageDir)){
                delTree($profileImageDir);
            }

            // File could not be uploaded.
            $_SESSION["imageUploadStatus"] = "An error occured during file check!";

            // Upon failed submit the page will be refreshed.
            header("Location: ../../?page=cvCreatorView");
            exit;
        }
        else{
            // If everything is ok, try to upload the file.
            if(move_uploaded_file($_FILES["profileImage"]["tmp_name"], $profileImage)){
                personalDetailsActions();
                personalDetailsReader();

                // Upon submit the page will be redirected to the PDF generator.
                header("Location: pdf-controller.php");
                exit;
            }
            else{
                personalDetailsActions();
                personalDetailsReader();

                if($_SESSION["userArray"][0][4] == false){
                    // If the PDF exists on the server, but the "Make my profile public" checkbox was unchecked, the PDF with its directory will be deleted from the server.
                    if(file_exists($pdfDir)){
                        delTree($pdfDir);
                    }
                }

                // The profile image directory will be deleted from the server after a failed submit.
                if(file_exists($profileImageDir)){
                    delTree($profileImageDir);
                }

                $_SESSION["imageUploadStatus"] = "An error occured during upload!";

                // Upon failed submit the page will be refreshed.
                header("Location: ../../?page=cvCreatorView");
                exit;
            }
        }
    }
?>