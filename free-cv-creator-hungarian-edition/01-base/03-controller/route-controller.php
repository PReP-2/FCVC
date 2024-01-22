<?php
    // Initiates the $_SESSION superglobal variable.
    session_start();

    // Page routes.
    function homeView(){
        return require("01-base/02-view/home-view.php");
    }

    function cvCreatorView(){
        return require("01-base/02-view/cv-creator-view.php");
    }

    function adminView(){
        return require("01-base/02-view/admin-view.php");
    }

    function accessDeniedView(){
        return require("01-base/02-view/access-denied-view.php");
    }

    function errorView(){
        return require("01-base/02-view/error-view.php");
    }

    // Page route controller.
    function controller(){
        if(array_key_exists("page", $_GET) && isset($_GET["page"])){
            $page = $_GET["page"];
        }
        else{
            $page = "homeView";
        }

        switch($page){
            case "homeView":
                return homeView();

            case "cvCreatorView":
                // Access validation.
                if(array_key_exists("userIsLoggedIn", $_SESSION) && $_SESSION["userIsLoggedIn"] == true){
                    return cvCreatorView();
                }
                else{
                    return accessDeniedView();
                }

            case "adminView":
                // Access validation.
                if(array_key_exists("userIsLoggedIn", $_SESSION) && $_SESSION["userIsLoggedIn"] == true && $_SESSION["userArray"][0][3] == true){
                    return adminView();
                }
                else{
                    return accessDeniedView();
                }

            default:
                return errorView();
        }
    }

    return controller();
?>