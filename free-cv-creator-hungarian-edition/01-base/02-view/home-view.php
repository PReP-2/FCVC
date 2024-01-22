<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Free CV Creator</title>

    <link href="03-third-party/01-css/bootstrap-5.3.2-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="02-resources/03-css/global-style.css" rel="stylesheet" type="text/css">
    <link href="02-resources/03-css/home-style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <!-- Navbar template. -->
    <?php require_once("02-resources/05-php/navbar-template.php"); ?>

    <div class="container text-center">
        <div class="row">
            <div class="col">
                <h1 class="mb-0 lh-lg">Welcome to the 
                    <span class="mark">Free CV Creator</span>!
                </h1>
                <p class="mb-4">
                    <small>A free account is required to use this application!</small>
                </p>
                
                <!-- Makes the "Let's get started" button visible if the conditions are met. -->
                <a class="btn btn-primary my-4" href="?page=cvCreatorView" role="button" <?php echo((array_key_exists("userIsLoggedIn", $_SESSION) && $_SESSION["userIsLoggedIn"] == true) ? "" : "hidden=hidden"); ?>>Let's get started!</a>

                <!-- Gallery. -->
                <div class="row mt-5 mb-2">
                    <div class="col-md-4 offset-md-4">
                        <a target="_blank" href="02-resources/06-images/example-generated-pdf-page-1.jpg">
                            <img class="img-thumbnail" src="02-resources/06-images/example-generated-pdf-page-1.jpg" alt="Example generated PDF page 1" title="Example generated PDF page 1">
                        </a>
                        <p class="px-5">Example generated PDF page 1</p>
                    </div>
                </div>

                <h5 class="mb-4 pt-4">Quality of life features:</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-grid gap-2 col-6 mx-auto">
                        <mark>Data saving for fast and easy update. 
                            <span class="badge bg-primary">New</span>
                        </mark>
                    </li>

                    <li class="list-group-item d-grid gap-2 col-6 mx-auto">
                        <mark>Unique profile link for convenient job applications. 
                            <span class="badge bg-primary">New</span>
                        </mark>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Footer template. -->
    <?php require_once("02-resources/02-html/footer-template.html"); ?>

    <script src="03-third-party/02-js/bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js" type="text/javascript"></script>
</body>

</html>