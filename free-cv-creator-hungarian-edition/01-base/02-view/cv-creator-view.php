<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Free CV Creator</title>

    <link href="03-third-party/01-css/bootstrap-5.3.2-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="02-resources/03-css/global-style.css" rel="stylesheet" type="text/css">
    <link href="02-resources/03-css/cv-creator-style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <!-- Navbar template. -->
    <?php require_once("02-resources/05-php/navbar-template.php"); ?>

    <div class="container">
        <div class="row">
            <div class="col">

                <!-- CV Creator form. -->
                <form class="row g-3" method="POST" action="01-base/03-controller/cv-creator-controller.php" enctype="multipart/form-data" id="mainForm">

                    <!-- Personal details. -->
                    <h4 class="mt-4 mb-2 mx-auto row text-uppercase mark">Personal details</h4>
                    <div class="col-md-6">
                        <label for="inputFirstName" class="form-label">
                            <abbr class="abbrMustBeFilled" title="Must be filled!">First name 
                                <strong class="strongMustBeFilled">*</strong>
                            </abbr>
                        </label>

                        <!-- Input is auto filled from db if the conditions are met. -->
                        <input type="text" class="form-control" name="inputFirstName" id="inputFirstName" value="<?php echo((array_key_exists("personalDetailsArray", $_SESSION) && count($_SESSION["personalDetailsArray"]) != 0 && $_SESSION["personalDetailsArray"][0][1] != "") ? $_SESSION["personalDetailsArray"][0][1] : ""); ?>" required>
                    </div>
                
                    <div class="col-md-6">
                        <label for="inputLastName" class="form-label">
                            <abbr class="abbrMustBeFilled" title="Must be filled!">Last name 
                                <strong class="strongMustBeFilled">*</strong>
                            </abbr>
                        </label>

                        <!-- Input is auto filled from db if the conditions are met. -->
                        <input type="text" class="form-control" name="inputLastName" id="inputLastName" value="<?php echo((array_key_exists("personalDetailsArray", $_SESSION) && count($_SESSION["personalDetailsArray"]) != 0 && $_SESSION["personalDetailsArray"][0][2] != "") ? $_SESSION["personalDetailsArray"][0][2] : ""); ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="inputAddress" class="form-label">Address</label>

                        <!-- Input is auto filled from db if the conditions are met. -->
                        <input type="text" class="form-control" name="inputAddress" id="inputAddress" value="<?php echo((array_key_exists("personalDetailsArray", $_SESSION) && count($_SESSION["personalDetailsArray"]) != 0 && $_SESSION["personalDetailsArray"][0][3] != "") ? $_SESSION["personalDetailsArray"][0][3] : ""); ?>">
                    </div>

                    <div class="col-md-6">
                        <label for="inputPhoneNumber" class="form-label">Phone number</label>

                        <!-- Input is auto filled from db if the conditions are met. -->
                        <input type="tel" class="form-control" name="inputPhoneNumber" id="inputPhoneNumber" value="<?php echo((array_key_exists("personalDetailsArray", $_SESSION) && count($_SESSION["personalDetailsArray"]) != 0 && $_SESSION["personalDetailsArray"][0][4] != "") ? $_SESSION["personalDetailsArray"][0][4] : ""); ?>">
                    </div>

                    <div class="col-md-6">
                        <label for="inputEmail" class="form-label">
                            <abbr class="abbrMustBeFilled" title="Must be filled!">E-mail address 
                                <strong class="strongMustBeFilled">*</strong>
                            </abbr>
                        </label>

                        <!-- Input is auto filled from db. -->
                        <input type="email" class="form-control" name="inputEmail" id="inputEmail" value="<?php echo($_SESSION["userArray"][0][1]); ?>" readonly>
                    </div>

                    <div class="mb-2 col-md-6">
                        <label for="profileImage" class="form-label">
                            <abbr class="abbrMustBeFilled" title="Must be filled!">Profile image 
                                <strong class="strongMustBeFilled">*</strong>
                            </abbr><small> - Max. 5MB and JPG, JPEG, PNG, GIF only!</small>
                        </label>
                        <input class="form-control" type="file" name="profileImage" id="profileImage" required>
                    </div>

                    <!-- Image upload feedback template will be loaded if the conditions are met. -->
                    <?php if(array_key_exists("imageUploadStatus", $_SESSION) && $_SESSION["imageUploadStatus"] != "" && array_key_exists("imageUploadFeedback", $_SESSION) && $_SESSION["imageUploadFeedback"] != ""){
                        require_once("02-resources/05-php/image-upload-feedback-template.php");
                    } ?>

                    <!-- Education and Qualifications. -->
                    <h4 class="mt-4 mb-2 mx-auto row text-uppercase mark">Education and Qualifications</h4>
                    <div class="my-0 mx-0 py-0 px-0" id="educationAndQualificationsFrame">

                        <!-- If Education and Qualifications data exists in the database, they will be cycled through, else a template will be loaded. -->
                        <?php if(array_key_exists("educationAndQualificationsArray", $_SESSION) && count($_SESSION["educationAndQualificationsArray"]) != 0){for($i = 0; $i < count($_SESSION["educationAndQualificationsArray"]); $i++) :?>
                            <div class="row gx-3 mx-auto px-0" id="educationAndQualificationsTemplate<?= $i ?>">
                                <div class="col-12 mt-3">
                                    <small>Please enter your studies in order so that the most recent is recorded first. This will put your highest qualification at the top of the list. The order cannot be changed later!</small>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="inputStartOfStudy<?= $i ?>" class="form-label">
                                        <abbr class="abbrMustBeFilled" title="Must be filled!">Start of study 
                                            <strong class="strongMustBeFilled">*</strong>
                                        </abbr>
                                    </label>
                                    <input type="date" class="form-control" name="inputStartOfStudy<?= $i ?>" id="inputStartOfStudy<?= $i ?>" value="<?= $_SESSION["educationAndQualificationsArray"][$i][1] ?>" required>
                                </div>
                        
                                <div class="col-md-6 mt-3">
                                    <label for="inputEndOfStudy<?= $i ?>" class="form-label">End of study</label>
                                    <input type="date" class="form-control" name="inputEndOfStudy<?= $i ?>" id="inputEndOfStudy<?= $i ?>" value="<?= $_SESSION["educationAndQualificationsArray"][$i][2] ?>">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="inputInstitutionName<?= $i ?>" class="form-label">
                                        <abbr class="abbrMustBeFilled" title="Must be filled!">Institution name 
                                            <strong class="strongMustBeFilled">*</strong>
                                        </abbr>
                                    </label>
                                    <input type="text" class="form-control" name="inputInstitutionName<?= $i ?>" id="inputInstitutionName<?= $i ?>" value="<?= $_SESSION["educationAndQualificationsArray"][$i][3] ?>" required>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="inputQualification<?= $i ?>" class="form-label">
                                        <abbr class="abbrMustBeFilled" title="Must be filled!">Qualification 
                                            <strong class="strongMustBeFilled">*</strong>
                                        </abbr>
                                    </label>
                                    <input type="text" class="form-control" name="inputQualification<?= $i ?>" id="inputQualification<?= $i ?>" value="<?= $_SESSION["educationAndQualificationsArray"][$i][4] ?>" required>
                                </div>

                                <div class="col-12 mt-3 mb-2">
                                    <label for="inputStudies<?= $i ?>" class="form-label">Studies</label>
                                    <textarea class="form-control" name="inputStudies<?= $i ?>" id="inputStudies<?= $i ?>" rows="5"><?= $_SESSION["educationAndQualificationsArray"][$i][5] ?></textarea>
                                </div>

                                <hr class="mt-4 mb-3">
                            </div>
                        <?php endfor;} ?>

                        <!-- Education and Qualifications template will be loaded if the conditions are met. -->
                        <?php if(array_key_exists("educationAndQualificationsArray", $_SESSION) == false || count($_SESSION["educationAndQualificationsArray"]) == 0){
                            require_once("02-resources/02-html/education-and-qualifications-template.html");
                        } ?>
                    </div>
                    
                    <div class="col-12 mt-3 mb-2 text-center">
                        <button class="btn btn-primary mx-2" type="button" id="buttonAddNewStudy" name="buttonAddNewStudy">Add new study</button>
                        <button class="btn btn-danger mx-2" type="button" id="buttonDeleteLastStudy" name="buttonDeleteLastStudy">Delete last study</button>
                    </div>

                    <!-- Work Experience. -->
                    <h4 class="mt-4 mb-2 mx-auto row text-uppercase mark">Work Experience</h4>

                    <!-- If checked, the Work Experience input field will be hidden and not send data to the server. -->
                    <div class="form-check d-flex justify-content-center px-2 mb-1">
                        <input class="form-check-input me-2" type="checkbox" name="iAmAfreshman" value="checked" id="iAmAfreshman">
                        <label class="form-check-label" for="iAmAfreshman">I am a freshman</label>
                    </div>

                    <hr class="mt-3 mb-2">

                    <div class="my-0 mx-0 py-0 px-0" id="workExperienceFrame">

                        <!-- If Work Experience data exists in the database, they will be cycled through, else a template will be loaded. -->
                        <?php if(array_key_exists("workExperienceArray", $_SESSION) && count($_SESSION["workExperienceArray"]) != 0){for($j = 0; $j < count($_SESSION["workExperienceArray"]); $j++) :?>
                            <div class="row gx-3 mx-auto px-0" id="workExperienceTemplate<?= $j ?>">
                                <div class="col-12 mt-3">
                                    <small>Please enter your work experiences in order so that the most recent is recorded first. This will put your most recent workplace at the top of the list. The order cannot be changed later!</small>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="inputStartOfEmployment<?= $j ?>" class="form-label">
                                        <abbr class="abbrMustBeFilled" title="Must be filled!">Start of employment 
                                            <strong class="strongMustBeFilled">*</strong>
                                        </abbr>
                                    </label>
                                    <input type="date" class="form-control requiredClean" name="inputStartOfEmployment<?= $j ?>" id="inputStartOfEmployment<?= $j ?>" value="<?= $_SESSION["workExperienceArray"][$j][1] ?>" required>
                                </div>
                            
                                <div class="col-md-6 mt-3">
                                    <label for="inputEndOfEmployment<?= $j ?>" class="form-label">End of employment</label>
                                    <input type="date" class="form-control" name="inputEndOfEmployment<?= $j ?>" id="inputEndOfEmployment<?= $j ?>" value="<?= $_SESSION["workExperienceArray"][$j][2] ?>">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="inputWorkplaceName<?= $j ?>" class="form-label">
                                        <abbr class="abbrMustBeFilled" title="Must be filled!">Workplace name 
                                            <strong class="strongMustBeFilled">*</strong>
                                        </abbr>
                                    </label>
                                    <input type="text" class="form-control requiredClean" name="inputWorkplaceName<?= $j ?>" id="inputWorkplaceName<?= $j ?>" value="<?= $_SESSION["workExperienceArray"][$j][3] ?>" required>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="inputPosition<?= $j ?>" class="form-label">
                                        <abbr class="abbrMustBeFilled" title="Must be filled!">Position 
                                            <strong class="strongMustBeFilled">*</strong>
                                        </abbr>
                                    </label>
                                    <input type="text" class="form-control requiredClean" name="inputPosition<?= $j ?>" id="inputPosition<?= $j ?>" value="<?= $_SESSION["workExperienceArray"][$j][4] ?>" required>
                                </div>

                                <div class="col mt-3 mb-2">
                                    <label for="inputJobDescription<?= $j ?>" class="form-label">Job description</label>
                                    <textarea class="form-control" name="inputJobDescription<?= $j ?>" id="inputJobDescription<?= $j ?>" rows="5"><?= $_SESSION["workExperienceArray"][$j][5] ?></textarea>
                                </div>

                                <hr class="mt-4 mb-3">
                            </div>
                        <?php endfor;} ?>

                        <!-- Work Experience template will be loaded if the conditions are met. -->
                        <?php if(array_key_exists("workExperienceArray", $_SESSION) == false || count($_SESSION["workExperienceArray"]) == 0){
                            require_once("02-resources/02-html/work-experience-template.html");
                        } ?>
                    </div>

                    <div class="col-12 mt-3 mb-2 text-center">
                        <button class="btn btn-primary mx-2" type="button" id="buttonAddNewWorkplace">Add new workplace</button>
                        <button class="btn btn-danger mx-2" type="button" id="buttonDeleteLastWorkplace" name="buttonDeleteLastWorkplace">Delete last workplace</button>
                    </div>

                    <!-- Languages. -->
                    <h4 class="mt-4 mb-2 mx-auto row text-uppercase mark">Languages</h4>
                    <div class="my-0 mx-0 py-0 px-0" id="languagesFrame">

                        <!-- If Languages data exists in the database, they will be cycled through, else a template will be loaded. -->
                        <?php if(array_key_exists("languagesArray", $_SESSION) && count($_SESSION["languagesArray"]) != 0){for($k = 0; $k < count($_SESSION["languagesArray"]); $k++): ?>
                            <div class="row gx-3 mx-auto px-0" id="languagesTemplate<?= $k ?>">
                                <div class="col-md-6 mt-3">
                                    <label for="inputLanguage<?= $k ?>" class="form-label">Language</label>
                                    <select class="form-select forcedRequireLanguage" name="inputLanguage<?= $k ?>" id="inputLanguage<?= $k ?>">
                                        <option value="" <?= ($_SESSION["languagesArray"][$k][1] == "") ? "selected" : "" ?>></option>
                                        <option value="Angol" <?= ($_SESSION["languagesArray"][$k][1] == "Angol") ? "selected" : "" ?>>Angol</option>
                                        <option value="Egyéb" <?= ($_SESSION["languagesArray"][$k][1] == "Egyéb") ? "selected" : "" ?>>Egyéb</option>
                                        <option value="Francia" <?= ($_SESSION["languagesArray"][$k][1] == "Francia") ? "selected" : "" ?>>Francia</option>
                                        <option value="Német" <?= ($_SESSION["languagesArray"][$k][1] == "Német") ? "selected" : "" ?>>Német</option>
                                        <option value="Olasz" <?= ($_SESSION["languagesArray"][$k][1] == "Olasz") ? "selected" : "" ?>>Olasz</option>
                                        <option value="Orosz" <?= ($_SESSION["languagesArray"][$k][1] == "Orosz") ? "selected" : "" ?>>Orosz</option>
                                        <option value="Spanyol" <?= ($_SESSION["languagesArray"][$k][1] == "Spanyol") ? "selected" : "" ?>>Spanyol</option>  
                                    </select>
                                </div>

                                <div class="col-md-6 mt-3 mb-2">
                                    <label for="inputLevel<?= $k ?>" class="form-label">Level</label>
                                    <select class="form-select forcedRequireLevel" name="inputLevel<?= $k ?>" id="inputLevel<?= $k ?>">
                                        <option value="" <?= ($_SESSION["languagesArray"][$k][2] == "") ? "selected" : "" ?>></option>
                                        <option value="A2 - Alapfok" <?= ($_SESSION["languagesArray"][$k][2] == "A2 - Alapfok") ? "selected" : "" ?>>A2 - Alapfok</option>
                                        <option value="B2 - Középfok" <?= ($_SESSION["languagesArray"][$k][2] == "B2 - Középfok") ? "selected" : "" ?>>B2 - Középfok</option>
                                        <option value="C2 - Felsőfok" <?= ($_SESSION["languagesArray"][$k][2] == "C2 - Felsőfok") ? "selected" : "" ?>>C2 - Felsőfok</option>
                                    </select>
                                </div>

                                <hr class="mt-4 mb-3">
                            </div>
                        <?php endfor;} ?>

                        <!-- Languages template will be loaded if the conditions are met. -->
                        <?php if(array_key_exists("languagesArray", $_SESSION) == false || count($_SESSION["languagesArray"]) == 0){
                            require_once("02-resources/02-html/languages-template.html");
                        } ?>
                    </div>

                    <div class="col-12 mt-3 mb-2 text-center">
                        <button class="btn btn-primary mx-2" type="button" id="buttonAddNewLanguage">Add new language</button>
                        <button class="btn btn-danger mx-2" type="button" id="buttonDeleteLastLanguage" name="buttonDeleteLastLanguage">Delete last language</button>
                    </div>

                    <!-- Skills. -->
                    <h4 class="mt-4 mb-2 mx-auto row text-uppercase mark">Skills</h4>
                    <div class="row gx-3 mx-auto px-0">
                        <div class="col mt-3 mb-2">
                            <textarea class="form-control" name="inputSkills" rows="5"><?php echo((array_key_exists("skillsArray", $_SESSION) && count($_SESSION["skillsArray"]) != 0) ? $_SESSION["skillsArray"][0][1] : ""); ?></textarea>
                        </div>
                    </div>

                    <div class="form-check d-flex justify-content-end align-items-center px-2">
                        <!-- This is part of a feature that will be implemented in the future.
                            <input class="form-check-input me-2 mb-1" type="checkbox" value="checked" name="saveMyData" id="saveMyData" <?php //echo((array_key_exists("userIsLoggedIn", $_SESSION)) ? (($_SESSION["userIsLoggedIn"] == true && $_SESSION["userArray"][0][5] == true) ? "checked=checked" : "") : ""); ?>>
                            <label class="form-check-label me-2" for="saveMyData">Save my data</label> 
                        -->

                        <!-- Public profile link checkbox. -->
                        <input class="form-check-input ms-2 me-2 mb-1" type="checkbox" value="checked" name="makeMyProfilePublic" id="makeMyProfilePublic" <?php echo(($_SESSION["userArray"][0][4] == true) ? "checked=checked" : ""); ?>>
                        <label class="form-check-label me-2" for="makeMyProfilePublic">Make my profile public</label>

                        <!-- Form submit button. -->
                        <button type="submit" class="btn btn-primary ms-2" name="submitForm" id="submitForm">Create PDF</button>
                    </div>

                    <!-- Hidden counters to determine how many input fields need to be send to the server. -->
                    <input type="text" id="educationAndQualificationsTemplateCounter" name="educationAndQualificationsTemplateCounter" value="" readonly hidden>
                    <input type="text" id="workExperienceTemplateCounter" name="workExperienceTemplateCounter" value="" readonly hidden>
                    <input type="text" id="languagesTemplateCounter" name="languagesTemplateCounter" value="" readonly hidden>
                </form>
            </div> 
        </div>
    </div>

    <!-- Footer template. -->
    <?php require_once("02-resources/02-html/footer-template.html"); ?>

    <script src="03-third-party/02-js/bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <script src="02-resources/04-js/education-and-qualifications-template.js" type="text/javascript"></script>
    <script src="02-resources/04-js/work-experience-template.js" type="text/javascript"></script>
    <script src="02-resources/04-js/languages-template.js" type="text/javascript"></script>
    <script src="02-resources/04-js/form-validator.js" type="text/javascript"></script>
</body>

</html>