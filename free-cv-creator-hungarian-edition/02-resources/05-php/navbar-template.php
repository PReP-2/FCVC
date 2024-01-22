<nav class="navbar navbar-expand-md bg-dark navbar-dark mb-5 py-2 sticky-top">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <!-- Highlights the "Home" page link if the conditions are met. -->
                    <a class="nav-link <?php echo((array_key_exists("page", $_GET) && $_GET["page"] == "homeView") || !array_key_exists("page", $_GET) ? "active" : ""); ?>" <?php echo((array_key_exists("page", $_GET) && $_GET["page"] == "homeView") ? "aria-current=page" : ""); ?> href="?page=homeView">Home</a>
                </li>

                <!-- Makes the "CV Creator" page link visible if the conditions are met. -->
                <li class="nav-item" <?php echo((array_key_exists("userIsLoggedIn", $_SESSION) && $_SESSION["userIsLoggedIn"] == true) ? "" : "hidden=hidden"); ?>>
                    <!-- Highlights the "CV Creator" page link if the conditions are met. -->
                    <a class="nav-link <?php echo((array_key_exists("page", $_GET) && $_GET["page"] == "cvCreatorView") ? "active" : ""); ?>" <?php echo((array_key_exists("page", $_GET) && $_GET["page"] == "cvCreatorView") ? "aria-current=page" : ""); ?> href="?page=cvCreatorView">CV Creator</a>
                </li>

                <!-- Makes the "Admin" page link visible if the conditions are met. -->
                <li class="nav-item" <?php echo((array_key_exists("userIsLoggedIn", $_SESSION) && $_SESSION["userIsLoggedIn"] == true && $_SESSION["userArray"][0][3] == true) ? "" : "hidden=hidden"); ?>>
                    <!-- Highlights the "Admin" page link if the conditions are met. -->
                    <a class="nav-link <?php echo((array_key_exists("page", $_GET) && $_GET["page"] == "adminView") ? "active" : ""); ?>" <?php echo((array_key_exists("page", $_GET) && $_GET["page"] == "adminView") ? "aria-current=page" : ""); ?> href="?page=adminView">Admin</a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <!-- Makes the "Logged in" user's email visible if the conditions are met. -->
                <span class="navbar-text me-3" <?php echo((array_key_exists("userIsLoggedIn", $_SESSION) && $_SESSION["userIsLoggedIn"] == true) ? "" : "hidden=hidden"); ?>>Logged in: <span id="spanLoggedIn"><?php echo((array_key_exists("userIsLoggedIn", $_SESSION) && $_SESSION["userIsLoggedIn"] == true) ? $_SESSION["userArray"][0][1] : ""); ?></span></span>

                <!-- Makes the "Log in" link visible if the conditions are met. -->
                <li class="nav-item" <?php echo((array_key_exists("userIsLoggedIn", $_SESSION) && $_SESSION["userIsLoggedIn"] == true) ? "hidden=hidden" : ""); ?>>
                    <button type="button" class="btn btn-outline-primary btn-sm my-1 me-3" data-bs-toggle="modal" data-bs-target="#staticBackdropLogin">Log in</button>
                    <div class="modal fade" id="staticBackdropLogin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelLogin" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabelLogin">Log in</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <form method="POST" action="01-base/03-controller/log-in-controller.php">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="inputEmailLogin" class="form-label">Email address</label>
                                            <input type="email" class="form-control" name="inputEmailLogin" id="inputEmailLogin">
                                        </div>

                                        <div class="mb-2">
                                            <label for="inputPasswordLogin" class="form-label">Password</label>
                                            <input type="password" class="form-control" name="inputPasswordLogin" id="inputPasswordLogin">
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="buttonLogin" value="buttonLogin" class="btn btn-primary">Log in</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </li>

                <!-- Makes the "Register" link visible if the conditions are met. -->
                <li class="nav-item" <?php echo((array_key_exists("userIsLoggedIn", $_SESSION) && $_SESSION["userIsLoggedIn"] == true) ? "hidden=hidden" : ""); ?>>
                    <button type="button" class="btn btn-outline-warning btn-sm my-1 me-3" data-bs-toggle="modal" data-bs-target="#staticBackdropRegister">Register</button>
                    <div class="modal fade" id="staticBackdropRegister" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelRegister" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabelRegister">Register</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <form method="POST" action="01-base/03-controller/register-controller.php">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="inputEmailRegister" class="form-label">Email address</label>
                                            <input type="email" class="form-control" name="inputEmailRegister" id="inputEmailRegister">
                                        </div>

                                        <div class="mb-2">
                                            <label for="inputPasswordRegister" class="form-label">Password</label>
                                            <input type="password" class="form-control" name="inputPasswordRegister" id="inputPasswordRegister">
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="buttonRegister" value="buttonRegister" class="btn btn-warning">Register</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </li>

                <!-- Makes the "Log out" link visible if the conditions are met. -->
                <li class="nav-item" <?php echo((array_key_exists("userIsLoggedIn", $_SESSION) && $_SESSION["userIsLoggedIn"] == true) ? "" : "hidden=hidden"); ?>>
                    <button type="button" class="btn btn-outline-danger btn-sm my-1 me-2" data-bs-toggle="modal" data-bs-target="#staticBackdropLogout">Log out</button>
                    <div class="modal fade" id="staticBackdropLogout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabelLogout" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabelLogout">Log out</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <form method="POST" action="01-base/03-controller/log-out-controller.php">
                                    <div class="modal-body">
                                        <h5 class="mb-3">Are you sure you want to log out?</h5>
                                        <p class="mb-2"><strong>Any unsaved data will be lost!</strong></p>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger" value="buttonLogout" name="buttonLogout">Log out</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Makes the "Public profile link" second navbar visible if the conditions are met. -->
<nav class="navbar bg-primary py-0 fixed-top" data-bs-theme="dark" id="navPublicProfileLink" <?php echo((array_key_exists("userIsLoggedIn", $_SESSION) && $_SESSION["userIsLoggedIn"] == true && $_SESSION["userArray"][0][4] == true) ? "" : "hidden=hidden"); ?>>
    <div class="container justify-content-center">
        <ul class="navbar-nav">
            <!-- Creates the "Public profile link" path and link name if the conditions are met. -->
            <span class="navbar-text pt-0 pb-1">Public profile link: <a href="<?php echo((file_exists("05-public/" . $_SESSION["userArray"][0][0] . "/")) ? "05-public/" . $_SESSION["userArray"][0][0] . "/" . scandir("05-public/" . $_SESSION["userArray"][0][0])[2] : ""); ?>" target="_blank" id="aPublicProfileLink"><?php echo((array_key_exists("userIsLoggedIn", $_SESSION) && $_SESSION["userIsLoggedIn"] == true) ? $_SESSION["userArray"][0][0] : ""); ?></a></span>
        </ul>
    </div>
</nav>