<?php
    // Initiates the $_SESSION superglobal variable.
    session_start();

    // Loads all dependency files.
    require_once("../../03-third-party/03-php/TCPDF-main/examples/tcpdf_include.php");

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

    // Profile image directory.
    $profileImageDir = "../../06-temp/" . $_SESSION["userArray"][0][0] . "/";

    // PDF material.
    // "Work Experience" subtable.
    $subtableWEArray = array();

    // If any "Work Experience" data exist on the server, it will be cycled through and pushed into an array.
    if(count($_SESSION["workExperienceArray"]) != 0){
        for($i = 0; $i < count($_SESSION["workExperienceArray"]); $i++){

            // Workplace name.
            // Start of employment.
            // End of employment.
            // Position.
            // Job description.
            $subtableWE = 
            '<tr>
                <td style="width: 3%;"></td>
                <td style="font-weight: bold; font-size: 10px; width: 72%;"><br> <br>'.$_SESSION["workExperienceArray"][$i][3].'<br></td>
                <td align="center" style="font-weight: bold; font-size: 10px; width: 25%; background-color: #d25400; color: white;"><br> <br>'.substr($_SESSION["workExperienceArray"][$i][1], 0, 4).' - '.(($_SESSION["workExperienceArray"][$i][2] == "0000-00-00") ? "jelenleg is" : substr($_SESSION["workExperienceArray"][$i][2], 0, 4)) .'<br></td>
            </tr>
            <tr>
                <td style="width: 3%;"></td>
                <td style="font-size: 10px; width: 72%;">'.$_SESSION["workExperienceArray"][$i][4].'<br></td>
                <td style="width: 25%;"></td>
            </tr>
            <tr>
                <td style="width: 6%;"></td>
                <td style="font-size: 10px; width: 69%;">'.$_SESSION["workExperienceArray"][$i][5].'<br><br></td>
                <td style="width: 25%;"></td>
            </tr>';

            array_push($subtableWEArray, $subtableWE);
        }
    }

    // "Work Experience" subtable header.
    $subtableWEHeader = 
    '<tr>
        <td style="font-weight: bold; font-size: 10px; width: 21%; color: #d25400;"><br> <br>MUNKATAPASZTALAT<br></td>
        <td style="width: 79%; color: #d25400;"><br> <hr></td>
    </tr>';

    // If any "Work Experience" data exist on the server, the subtable header will be pushed into the start of the array. If no data exists, the whole subtable will be left out of the PDF.
    if(count($_SESSION["workExperienceArray"]) != 0){
        array_unshift($subtableWEArray, $subtableWEHeader);
    }

    // "Education and Qualifications" subtable.
    $subtableEAQArray = array();

    // If any "Education and Qualifications" data exist on the server, it will be cycled through and pushed into an array.
    if(count($_SESSION["educationAndQualificationsArray"]) != 0){
        for($j = 0; $j < count($_SESSION["educationAndQualificationsArray"]); $j++){

            // Institution name.
            // Start of study.
            // End of study.
            // Qualification.
            // Studies.
            $subtableEAQ = 
            '<tr>
                <td style="width: 3%;"></td>
                <td style="font-weight: bold; font-size: 10px; width: 72%;"><br> <br>'.$_SESSION["educationAndQualificationsArray"][$j][3].'<br></td>
                <td align="center" style="font-weight: bold; font-size: 10px; width: 25%; background-color: #d25400; color: white;"><br> <br>'.substr($_SESSION["educationAndQualificationsArray"][$j][1], 0, 4).(($_SESSION["educationAndQualificationsArray"][$j][2] == $_SESSION["educationAndQualificationsArray"][$j][1]) ? "" : ' - '.substr($_SESSION["educationAndQualificationsArray"][$j][2], 0, 4)) .'<br></td>
            </tr>
            <tr>
                <td style="width: 3%;"></td>
                <td style="font-size: 10px; width: 72%;">'.$_SESSION["educationAndQualificationsArray"][$j][4].'<br></td>
                <td style="width: 25%;"></td>
            </tr>
            <tr>
                <td style="width: 6%;"></td>
                <td style="font-size: 10px; width: 69%;">'.$_SESSION["educationAndQualificationsArray"][$j][5].'<br><br></td>
                <td style="width: 25%;"></td>
            </tr>';

            array_push($subtableEAQArray, $subtableEAQ);
        }
    }

    // "Education and Qualifications" subtable header.
    $subtableEAQHeader = 
    '<tr>
        <td style="font-weight: bold; font-size: 10px; width: 16%; color: #d25400;"><br> <br>TANULMÁNYOK<br></td>
        <td style="width: 84%; color: #d25400;"><br> <hr></td>
    </tr>';

    // If any "Education and Qualifications" data exist on the server, the subtable header will be pushed into the start of the array. If no data exists, the whole subtable will be left out of the PDF.
    if(count($_SESSION["educationAndQualificationsArray"]) != 0){
        array_unshift($subtableEAQArray, $subtableEAQHeader);
    }

    // "Languages" subtable.
    $subtableLArray = array();

    // If any "Languages" data exist on the server, it will be cycled through and pushed into an array.
    if(count($_SESSION["languagesArray"]) != 0){
        for($k = 0; $k < count($_SESSION["languagesArray"]); $k++){

            // Language.
            // Level.
            $subtableL = 
            '<tr>
                <td style="width: 3%;"></td>
                <td style="font-weight: bold; font-size: 10px; width: 22%;"><br> <br>'.$_SESSION["languagesArray"][$k][1].'<br></td>
                <td style="font-size: 10px; width: 75%;"><br> <br>'.$_SESSION["languagesArray"][$k][2].'<br></td>
            </tr>';

            array_push($subtableLArray, $subtableL);
        }
    }

    // "Languages" subtable header.
    $subtableLHeader = 
    '<tr>
        <td style="font-weight: bold; font-size: 10px; width: 16%; color: #d25400;"><br> <br>NYELVISMERET<br></td>
        <td style="width: 84%; color: #d25400;"><br> <hr></td>
    </tr>';

    // If any "Languages" data exist on the server, the subtable header will be pushed into the start of the array. If no data exists, the whole subtable will be left out of the PDF.
    if(count($_SESSION["languagesArray"]) != 0){
        array_unshift($subtableLArray, $subtableLHeader);
    }

    // "Skills" subtable.
    $subtableSArray = array();

    // If any "Skills" data exist on the server, it will be cycled through and pushed into an array.
    if(count($_SESSION["skillsArray"]) != 0){
        for($l = 0; $l < count($_SESSION["skillsArray"]); $l++){

            // Skills.
            $subtableS = 
            '<tr>
                <td style="width: 3%;"></td>
                <td style="font-size: 10px; width: 97%;">'.$_SESSION["skillsArray"][$l][1].'</td>
            </tr>';
    
            array_push($subtableSArray, $subtableS);
        }
    }

    // "Skills" subtable header.
    $subtableSHeader = 
    '<tr>
        <td style="font-weight: bold; font-size: 10px; width: 8%; color: #d25400;"><br> <br>EGYÉB<br></td>
        <td style="width: 92%; color: #d25400;"><br> <hr></td>
    </tr>';

    // If any "Skills" data exist on the server, the subtable header will be pushed into the start of the array. If no data exists, the whole subtable will be left out of the PDF.
    if(count($_SESSION["skillsArray"]) != 0){
        array_unshift($subtableSArray, $subtableSHeader);
    }

    // If any "Work Experience" data exist on the server, the last job position will be printed out.
    $userLastWorkExperiencePosition = "";

    if(array_key_exists("workExperienceArray", $_SESSION) && count($_SESSION["workExperienceArray"]) != 0){
        $userLastWorkExperiencePosition = $_SESSION["workExperienceArray"][0][4];
    }

    // If the "Address" and "Phone number" both exist, the "Address" will be printed out at the top, else the table cell will be empty.
    $userAddress = "";

    if(array_key_exists("personalDetailsArray", $_SESSION) && $_SESSION["personalDetailsArray"][0][3] != "" && $_SESSION["personalDetailsArray"][0][4] != ""){
        $userAddress = "<b>Cím: </b>" . $_SESSION["personalDetailsArray"][0][3];
    }

    // If the "Address" and "Phone number" both exist, the "Phone number" will be printed out at the bottom left. Else if the "Phone number" exists, but the "Address" doesn't, the "Address" will be printed out at the bottom left. Else if neither exist, the "E-mail address" will be printed out at the bottom left.
    $userPhoneNumber = "";

    if(array_key_exists("personalDetailsArray", $_SESSION)){
        if($_SESSION["personalDetailsArray"][0][3] != "" && $_SESSION["personalDetailsArray"][0][4] != ""){
            $userPhoneNumber = "<b>Telefonszám: </b>" . $_SESSION["personalDetailsArray"][0][4];
        }
        elseif($_SESSION["personalDetailsArray"][0][3] != "" && $_SESSION["personalDetailsArray"][0][4] == ""){
            $userPhoneNumber = "<b>Cím: </b>" . $_SESSION["personalDetailsArray"][0][3];
        }
        elseif($_SESSION["personalDetailsArray"][0][3] == "" && $_SESSION["personalDetailsArray"][0][4] != ""){
            $userPhoneNumber = "<b>Telefonszám: </b>" . $_SESSION["personalDetailsArray"][0][4];
        }
        elseif($_SESSION["personalDetailsArray"][0][3] == "" && $_SESSION["personalDetailsArray"][0][4] == ""){
            $userPhoneNumber = "<b>E-mail cím: </b>" . $_SESSION["userArray"][0][1];
        }
    }

    // If the "Address" and "Phone number" both exist, the "E-mail address" will be printed out at the bottom right, else the table cell will be empty.
    $userEmailAddress = "";

    if(array_key_exists("personalDetailsArray", $_SESSION)){
        if($_SESSION["personalDetailsArray"][0][3] != "" && $_SESSION["personalDetailsArray"][0][4] != ""){
            $userEmailAddress = "<b>E-mail cím: </b>" . $_SESSION["userArray"][0][1];
        }
        elseif($_SESSION["personalDetailsArray"][0][3] != "" && $_SESSION["personalDetailsArray"][0][4] == ""){
            $userEmailAddress = "<b>E-mail cím: </b>" . $_SESSION["userArray"][0][1];
        }
        elseif($_SESSION["personalDetailsArray"][0][3] == "" && $_SESSION["personalDetailsArray"][0][4] != ""){
            $userEmailAddress = "<b>E-mail cím: </b>" . $_SESSION["userArray"][0][1];
        }
    }

    // Table.

    // First name.
    // Last name.
    // Profile image.
    // Position.
    // Address.
    // Phone number.
    // E-mail address.

    // Subtables inserted.
    $tableToPdf = 
    '<table cellpadding="2" cellspacing="2">
        <tr>
            <th style="font-weight: bold; font-size: 32px; width: 80%; color: #d25400;">'.$_SESSION["personalDetailsArray"][0][2].' '.$_SESSION["personalDetailsArray"][0][1].'</th>
            <th rowspan="4" style="width: 20%;"><img src="'.$profileImageDir.scandir('../../06-temp/'.$_SESSION["userArray"][0][0])[2].'" style="border: 1px solid #d25400;"></th>
        </tr>
        <tr>
            <th style="width: 80%; font-size: 14px;"><span style="text-transform: uppercase;">'.$userLastWorkExperiencePosition.'</span><br><br></th>
        </tr>
        <tr>
            <th style="width: 80%; font-size: 10px;">'.$userAddress.'</th>
        </tr>
        <tr>
            <th style="width: 35%; font-size: 10px;">'.$userPhoneNumber.'<br><br></th>
            <th style="width: 45%; font-size: 10px;">'.$userEmailAddress.'<br><br></th>
        </tr>
        '.implode("", $subtableWEArray).'
        '.implode("", $subtableEAQArray).'
        '.implode("", $subtableLArray).'
        '.implode("", $subtableSArray).'
    </table>';

    // Creates new PDF document.
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Sets document information.
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('');
    $pdf->SetTitle('');
    $pdf->SetSubject('');
    $pdf->SetKeywords('');

    // Sets default header data.
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    // Sets default monospaced font.
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // Sets margins.
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

    // Sets auto page breaks.
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // Sets image scale factor.
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // Sets some language-dependent strings (optional).
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')){
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

    // Sets font. "dejavusans" is a UTF-8 Unicode font. If only standard ASCII characters needed, core fonts will reduce the file size.
    $pdf->SetFont('dejavusans', '', 12, '', true);

    // Adds a page. This method has several options.
    $pdf->AddPage();

    // Table.
    $tbl = <<<EOD
    $tableToPdf
    EOD;

    // Preserves HTML formatting.
    $pdf->writeHTML($tbl, true, false, false, false, '');

    
    // Checks the "Make my profile public" checkbox status to determine the output method and file management.
    if($_SESSION["userArray"][0][4] == true){
        // A directory will be created for the publicly available PDF if the "Make my profile public" checkbox is checked.
        if(file_exists($pdfDir) == false){
            mkdir($pdfDir);
        }
        else{
            // The PDF with its directory will be deleted from the server then the directory will be recreated, so the stored document will always be the newest.
            delTree($pdfDir);
            mkdir($pdfDir);
        }
        
        // Closes and outputs the PDF document to a file and the browser. This method has several options.
        $pdf->Output($pdfDir . $_SESSION["userArray"][0][0] . '.pdf', 'FI');

        // The profile image will be deleted from the server after the PDF was generated.
        delTree($profileImageDir);
    }
    else{
        // If the PDF exists on the server, but the "Make my profile public" checkbox was unchecked, the PDF with its directory will be deleted from the server.
        if(file_exists($pdfDir)){
            delTree($pdfDir);
        }

        // Closes and outputs the PDF document to the browser. This method has several options.
        $pdf->Output($pdfDir . $_SESSION["userArray"][0][0] . '.pdf', 'I');

        // The profile image will be deleted from the server after the PDF was generated.
        delTree($profileImageDir);
    }
?>