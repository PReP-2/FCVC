<?php
    // Completely destroys the session data to log out the "User".
    session_start();
    session_unset();
    session_destroy();
    session_write_close();
    setcookie(session_name(),'',0,'/');
    session_regenerate_id(true);

    // After log out the page will refresh and redirect to the home page.
    header("Location: ../../?page=homeView");
    exit;
?>