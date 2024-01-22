// Hidden counter to determine how many input fields need to be send to the server.
var educationAndQualificationsTemplateCounter = document.getElementById("educationAndQualificationsTemplateCounter");

// Regex to extract the number from the template IDs.
const numberFinder = new RegExp("\\d+");

// Education and qualifications.
var educationAndQualificationsFrame = document.getElementById("educationAndQualificationsFrame");

var buttonAddNewStudy = document.getElementById("buttonAddNewStudy");
var buttonDeleteLastStudy = document.getElementById("buttonDeleteLastStudy");

var lastEaqTemplate = educationAndQualificationsFrame.lastElementChild.id;
educationAndQualificationsTemplateCounter.setAttribute("value", parseInt(lastEaqTemplate.match(numberFinder)[0]));

// Visible only if there is more than one template.
if(lastEaqTemplate == "educationAndQualificationsTemplate0"){
    buttonDeleteLastStudy.setAttribute("hidden", "hidden");
    buttonDeleteLastStudy.setAttribute("disabled", "disabled");
}

// "Add new study" button creates a new "Education and qualifications" template.
buttonAddNewStudy.addEventListener("click", function(){
    // Last "Education and qualifications" template ID.
    var lastEaqTemplateId = educationAndQualificationsFrame.lastElementChild.id.match(numberFinder);

    // "Education and qualifications" template row.
    var educationAndQualificationsRow = document.createElement("div");
    educationAndQualificationsRow.setAttribute("class", "row gx-3 mx-auto px-0");
    educationAndQualificationsRow.setAttribute("id", "educationAndQualificationsTemplate" + (parseInt(lastEaqTemplateId[0]) + 1));

    // "Education and qualifications" template col 0.
    var educationAndQualificationsCol0 = document.createElement("div");
    educationAndQualificationsCol0.setAttribute("class", "col-12 mt-3");
    var educationAndQualificationsSmall0 = document.createElement("small");

    educationAndQualificationsCol0.appendChild(educationAndQualificationsSmall0);

    educationAndQualificationsSmall0.textContent = "Please enter your studies in order so that the most recent is recorded first. This will put your highest qualification at the top of the list. The order cannot be changed later!";

    // "Education and qualifications" template col A.
    var educationAndQualificationsColA = document.createElement("div");
    educationAndQualificationsColA.setAttribute("class", "col-md-6 mt-3");
    var educationAndQualificationsLabelA = document.createElement("label");
    educationAndQualificationsLabelA.setAttribute("for", "inputStartOfStudy" + (parseInt(lastEaqTemplateId[0]) + 1));
    educationAndQualificationsLabelA.setAttribute("class", "form-label");
    var educationAndQualificationsAbbrA = document.createElement("ABBR");
    educationAndQualificationsAbbrA.setAttribute("class", "abbrMustBeFilled");
    educationAndQualificationsAbbrA.setAttribute("title", "Must be filled!");
    var educationAndQualificationsAbbrTextA = document.createTextNode("Start of study ");
    var educationAndQualificationsStrongA = document.createElement("STRONG");
    educationAndQualificationsStrongA.setAttribute("class", "strongMustBeFilled");
    var educationAndQualificationsStrongTextA = document.createTextNode("*");
    var educationAndQualificationsInputA = document.createElement("input");
    educationAndQualificationsInputA.setAttribute("type", "date");
    educationAndQualificationsInputA.setAttribute("class", "form-control");
    educationAndQualificationsInputA.setAttribute("name", "inputStartOfStudy" + (parseInt(lastEaqTemplateId[0]) + 1));
    educationAndQualificationsInputA.setAttribute("id", "inputStartOfStudy" + (parseInt(lastEaqTemplateId[0]) + 1));
    educationAndQualificationsInputA.setAttribute("value", "");
    educationAndQualificationsInputA.setAttribute("required", "required");

    educationAndQualificationsColA.appendChild(educationAndQualificationsLabelA);
    educationAndQualificationsLabelA.appendChild(educationAndQualificationsAbbrA);
    educationAndQualificationsAbbrA.appendChild(educationAndQualificationsAbbrTextA);
    educationAndQualificationsAbbrA.appendChild(educationAndQualificationsStrongA);
    educationAndQualificationsStrongA.appendChild(educationAndQualificationsStrongTextA);
    educationAndQualificationsColA.appendChild(educationAndQualificationsInputA);

    // "Education and qualifications" template col B.
    var educationAndQualificationsColB = document.createElement("div");
    educationAndQualificationsColB.setAttribute("class", "col-md-6 mt-3");
    var educationAndQualificationsLabelB = document.createElement("label");
    educationAndQualificationsLabelB.setAttribute("for", "inputEndOfStudy" + (parseInt(lastEaqTemplateId[0]) + 1));
    educationAndQualificationsLabelB.setAttribute("class", "form-label");
    var educationAndQualificationsInputB = document.createElement("input");
    educationAndQualificationsInputB.setAttribute("type", "date");
    educationAndQualificationsInputB.setAttribute("class", "form-control");
    educationAndQualificationsInputB.setAttribute("name", "inputEndOfStudy" + (parseInt(lastEaqTemplateId[0]) + 1));
    educationAndQualificationsInputB.setAttribute("id", "inputEndOfStudy" + (parseInt(lastEaqTemplateId[0]) + 1));
    educationAndQualificationsInputB.setAttribute("value", "");

    educationAndQualificationsColB.appendChild(educationAndQualificationsLabelB);
    educationAndQualificationsColB.appendChild(educationAndQualificationsInputB);

    educationAndQualificationsLabelB.textContent = "End of study";

    // "Education and qualifications" template col C.
    var educationAndQualificationsColC = document.createElement("div");
    educationAndQualificationsColC.setAttribute("class", "col-md-6 mt-3");
    var educationAndQualificationsLabelC = document.createElement("label");
    educationAndQualificationsLabelC.setAttribute("for", "inputInstitutionName" + (parseInt(lastEaqTemplateId[0]) + 1));
    educationAndQualificationsLabelC.setAttribute("class", "form-label");
    var educationAndQualificationsAbbrC = document.createElement("ABBR");
    educationAndQualificationsAbbrC.setAttribute("class", "abbrMustBeFilled");
    educationAndQualificationsAbbrC.setAttribute("title", "Must be filled!");
    var educationAndQualificationsAbbrTextC = document.createTextNode("Institution name ");
    var educationAndQualificationsStrongC = document.createElement("STRONG");
    educationAndQualificationsStrongC.setAttribute("class", "strongMustBeFilled");
    var educationAndQualificationsStrongTextC = document.createTextNode("*");
    var educationAndQualificationsInputC = document.createElement("input");
    educationAndQualificationsInputC.setAttribute("type", "text");
    educationAndQualificationsInputC.setAttribute("class", "form-control");
    educationAndQualificationsInputC.setAttribute("name", "inputInstitutionName" + (parseInt(lastEaqTemplateId[0]) + 1));
    educationAndQualificationsInputC.setAttribute("id", "inputInstitutionName" + (parseInt(lastEaqTemplateId[0]) + 1));
    educationAndQualificationsInputC.setAttribute("value", "");
    educationAndQualificationsInputC.setAttribute("required", "required");

    educationAndQualificationsColC.appendChild(educationAndQualificationsLabelC);
    educationAndQualificationsLabelC.appendChild(educationAndQualificationsAbbrC);
    educationAndQualificationsAbbrC.appendChild(educationAndQualificationsAbbrTextC);
    educationAndQualificationsAbbrC.appendChild(educationAndQualificationsStrongC);
    educationAndQualificationsStrongC.appendChild(educationAndQualificationsStrongTextC);
    educationAndQualificationsColC.appendChild(educationAndQualificationsInputC);

    // "Education and qualifications" template col D.
    var educationAndQualificationsColD = document.createElement("div");
    educationAndQualificationsColD.setAttribute("class", "col-md-6 mt-3");
    var educationAndQualificationsLabelD = document.createElement("label");
    educationAndQualificationsLabelD.setAttribute("for", "inputQualification" + (parseInt(lastEaqTemplateId[0]) + 1));
    educationAndQualificationsLabelD.setAttribute("class", "form-label");
    var educationAndQualificationsAbbrD = document.createElement("ABBR");
    educationAndQualificationsAbbrD.setAttribute("class", "abbrMustBeFilled");
    educationAndQualificationsAbbrD.setAttribute("title", "Must be filled!");
    var educationAndQualificationsAbbrTextD = document.createTextNode("Qualification ");
    var educationAndQualificationsStrongD = document.createElement("STRONG");
    educationAndQualificationsStrongD.setAttribute("class", "strongMustBeFilled");
    var educationAndQualificationsStrongTextD = document.createTextNode("*");
    var educationAndQualificationsInputD = document.createElement("input");
    educationAndQualificationsInputD.setAttribute("type", "text");
    educationAndQualificationsInputD.setAttribute("class", "form-control");
    educationAndQualificationsInputD.setAttribute("name", "inputQualification" + (parseInt(lastEaqTemplateId[0]) + 1));
    educationAndQualificationsInputD.setAttribute("id", "inputQualification" + (parseInt(lastEaqTemplateId[0]) + 1));
    educationAndQualificationsInputD.setAttribute("value", "");
    educationAndQualificationsInputD.setAttribute("required", "required");

    educationAndQualificationsColD.appendChild(educationAndQualificationsLabelD);
    educationAndQualificationsLabelD.appendChild(educationAndQualificationsAbbrD);
    educationAndQualificationsAbbrD.appendChild(educationAndQualificationsAbbrTextD);
    educationAndQualificationsAbbrD.appendChild(educationAndQualificationsStrongD);
    educationAndQualificationsStrongD.appendChild(educationAndQualificationsStrongTextD);
    educationAndQualificationsColD.appendChild(educationAndQualificationsInputD);

    // "Education and qualifications" template col E.
    var educationAndQualificationsColE = document.createElement("div");
    educationAndQualificationsColE.setAttribute("class", "col-12 mt-3 mb-2");
    var educationAndQualificationsLabelE = document.createElement("label");
    educationAndQualificationsLabelE.setAttribute("for", "inputStudies" + (parseInt(lastEaqTemplateId[0]) + 1));
    educationAndQualificationsLabelE.setAttribute("class", "form-label");
    var educationAndQualificationsTextareaE = document.createElement("textarea");
    educationAndQualificationsTextareaE.setAttribute("class", "form-control");
    educationAndQualificationsTextareaE.setAttribute("name", "inputStudies" + (parseInt(lastEaqTemplateId[0]) + 1));
    educationAndQualificationsTextareaE.setAttribute("id", "inputStudies" + (parseInt(lastEaqTemplateId[0]) + 1));
    educationAndQualificationsTextareaE.setAttribute("rows", "5");

    educationAndQualificationsColE.appendChild(educationAndQualificationsLabelE);
    educationAndQualificationsColE.appendChild(educationAndQualificationsTextareaE);

    educationAndQualificationsLabelE.textContent = "Studies";

    // "Education and qualifications" template hr.
    var educationAndQualificationsHr = document.createElement("hr");
    educationAndQualificationsHr.setAttribute("class", "mt-4 mb-3");

    educationAndQualificationsRow.appendChild(educationAndQualificationsCol0);
    educationAndQualificationsRow.appendChild(educationAndQualificationsColA);
    educationAndQualificationsRow.appendChild(educationAndQualificationsColB);
    educationAndQualificationsRow.appendChild(educationAndQualificationsColC);
    educationAndQualificationsRow.appendChild(educationAndQualificationsColD);
    educationAndQualificationsRow.appendChild(educationAndQualificationsColE);
    educationAndQualificationsRow.appendChild(educationAndQualificationsHr);

    educationAndQualificationsFrame.appendChild(educationAndQualificationsRow);

    lastEaqTemplate = educationAndQualificationsFrame.lastElementChild.id;
    educationAndQualificationsTemplateCounter.setAttribute("value", parseInt(lastEaqTemplate.match(numberFinder)[0]));

    if(lastEaqTemplate != "educationAndQualificationsTemplate0"){
        buttonDeleteLastStudy.removeAttribute("hidden", "hidden");
        buttonDeleteLastStudy.removeAttribute("disabled", "disabled");
    };
});

// "Delete last study" button removes the last "Education and qualifications" template.
buttonDeleteLastStudy.addEventListener("click", function(){
    var lastEaqTemplate = educationAndQualificationsFrame.lastElementChild.id;

    if(lastEaqTemplate != "educationAndQualificationsTemplate0"){
        educationAndQualificationsFrame.removeChild(educationAndQualificationsFrame.lastElementChild);

        lastEaqTemplate = educationAndQualificationsFrame.lastElementChild.id;
        educationAndQualificationsTemplateCounter.setAttribute("value", parseInt(lastEaqTemplate.match(numberFinder)[0]));

        if(lastEaqTemplate == "educationAndQualificationsTemplate0"){
            buttonDeleteLastStudy.setAttribute("hidden", "hidden");
            buttonDeleteLastStudy.setAttribute("disabled", "disabled");
        }
    }
});