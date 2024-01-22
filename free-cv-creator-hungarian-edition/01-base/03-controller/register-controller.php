<?php
    // Initiates the $_SESSION superglobal variable.
    session_start();

    // Loads all dependency files.
    require_once("../01-model/database-manager.php");
    require_once("../01-model/model-objectifier.php");
    require_once("../01-model/user-model.php");

    // Random "User" ID generator.
    function random_string($length) {
        $str = random_bytes($length);
        $str = base64_encode($str);
        $str = str_replace(["+", "/", "="], "", $str);
        $str = substr($str, 0, $length);
        return $str;
    }

    // "User" data in the database will be requested from the server before a register attempt.
    $userArray = DatabaseManager::userReader();

    // "User" data array prepared to put into session upon successful registration.
    $userArrayToSession = array();

    // Log in status saved in session.
    $_SESSION["userIsLoggedIn"] = false;

    // The register data input is validated.
    if(array_key_exists("inputEmailRegister", $_POST) && isset($_POST["inputEmailRegister"]) && array_key_exists("inputPasswordRegister", $_POST) && isset($_POST["inputPasswordRegister"])){
        // The "User" data on the server is cycled through.
        $i = 0;
        while($i < count($userArray)){
            if($userArray[$i]->getUser()->getEmailAddress() != $_POST["inputEmailRegister"]){
                $i++;
            }
        }
        // If the input email was not found on the server, the registration will complete with a randomly generated "User" ID and saved to the server.
        if($i == count($userArray)){
            $userId = random_string(8);
            $userEmailAddress = $_POST["inputEmailRegister"];
            $userPassword = $_POST["inputPasswordRegister"];
            $userUserIsAdmin = 0;
            $userPublicProfileLinkActive = 0;
            $userDataSaveActive = 1;
    
            DatabaseManager::userWriter(new User($userId, $userEmailAddress, $userPassword, $userUserIsAdmin, $userPublicProfileLinkActive, $userDataSaveActive));

            // "User" data in the database will be updated after a successful registration.
            $userArray = DatabaseManager::userReader();
        }
    }

    for($i = 0; $i < count($userArray); $i++){
        // The collected server data is matched against the log in data input. If the data exist is the database, they will be pushed into an array.
        if($userArray[$i]->getUser()->getEmailAddress() == $_POST["inputEmailRegister"] && $userArray[$i]->getUser()->getPassword() == $_POST["inputPasswordRegister"]){
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

    $_SESSION["userArray"] = $userArrayToSession;

    // The page will be refreshed to load the "User" data.
    header("Location: ../../?page=homeView");
    exit;
?>