// Hidden counter to determine how many input fields need to be send to the server.
var workExperienceTemplateCounter = document.getElementById("workExperienceTemplateCounter");

// Work Experience.
var workExperienceFrame = document.getElementById("workExperienceFrame");

var requiredInputs = document.getElementsByClassName("requiredClean");

var buttonAddNewWorkplace = document.getElementById("buttonAddNewWorkplace");
var buttonDeleteLastWorkplace = document.getElementById("buttonDeleteLastWorkplace");

// "I am a freshman" checkbox hide-show toggler.
var iAmAfreshman = document.getElementById("iAmAfreshman");

iAmAfreshman.addEventListener("change", function(){
    if(iAmAfreshman.checked){
        workExperienceFrame.setAttribute("hidden", "hidden");
        workExperienceFrame.setAttribute("disabled", "disabled");

        // Makes sure that the required attribute is cleared, otherwise the script will stop at validation.
        for(var i = 0; i < requiredInputs.length; i++){
            requiredInputs[i].removeAttribute("required", "required");
        }

        buttonAddNewWorkplace.setAttribute("hidden", "hidden");
        buttonAddNewWorkplace.setAttribute("disabled", "disabled");
        buttonDeleteLastWorkplace.setAttribute("hidden", "hidden");
        buttonDeleteLastWorkplace.setAttribute("disabled", "disabled");
    }
    else{
        workExperienceFrame.removeAttribute("hidden", "hidden");
        workExperienceFrame.removeAttribute("disabled", "disabled");

        // Restores the required attribute.
        for(var i = 0; i < requiredInputs.length; i++){
            requiredInputs[i].setAttribute("required", "required");
        }
    }
});

var lastWeTemplate = workExperienceFrame.lastElementChild.id;
workExperienceTemplateCounter.setAttribute("value", parseInt(lastWeTemplate.match(numberFinder)[0]));

// Visible only if there is more than one template.
if(lastWeTemplate == "workExperienceTemplate0"){
    buttonDeleteLastWorkplace.setAttribute("hidden", "hidden");
    buttonDeleteLastWorkplace.setAttribute("disabled", "disabled");
}

// "Add new workplace" button creates a new "Work experience" template.
buttonAddNewWorkplace.addEventListener("click", function(){
    // Last "Work experience" template ID.
    var lastWeTemplateId = workExperienceFrame.lastElementChild.id.match(numberFinder);

    // "Work experience" template row.
    var workExperienceRow = document.createElement("div");
    workExperienceRow.setAttribute("class", "row gx-3 mx-auto px-0");
    workExperienceRow.setAttribute("id", "workExperienceTemplate" + (parseInt(lastWeTemplateId[0]) + 1));

    // "Work experience" template col 0.
    var workExperienceCol0 = document.createElement("div");
    workExperienceCol0.setAttribute("class", "col-12 mt-3");
    var workExperienceSmall0 = document.createElement("small");

    workExperienceCol0.appendChild(workExperienceSmall0);

    workExperienceSmall0.textContent = "Please enter your work experiences in order so that the most recent is recorded first. This will put your most recent workplace at the top of the list. The order cannot be changed later!";

    // "Work experience" template col A.
    var workExperienceColA = document.createElement("div");
    workExperienceColA.setAttribute("class", "col-md-6 mt-3");
    var workExperienceLabelA = document.createElement("label");
    workExperienceLabelA.setAttribute("for", "inputStartOfEmployment" + (parseInt(lastWeTemplateId[0]) + 1));
    workExperienceLabelA.setAttribute("class", "form-label");
    var workExperienceAbbrA = document.createElement("ABBR");
    workExperienceAbbrA.setAttribute("class", "abbrMustBeFilled");
    workExperienceAbbrA.setAttribute("title", "Must be filled!");
    var workExperienceAbbrTextA = document.createTextNode("Start of employment ");
    var workExperienceStrongA = document.createElement("STRONG");
    workExperienceStrongA.setAttribute("class", "strongMustBeFilled");
    var workExperienceStrongTextA = document.createTextNode("*");
    var workExperienceInputA = document.createElement("input");
    workExperienceInputA.setAttribute("type", "date");
    workExperienceInputA.setAttribute("class", "form-control");
    workExperienceInputA.setAttribute("name", "inputStartOfEmployment" + (parseInt(lastWeTemplateId[0]) + 1));
    workExperienceInputA.setAttribute("id", "inputStartOfEmployment" + (parseInt(lastWeTemplateId[0]) + 1));
    workExperienceInputA.setAttribute("value", "");
    workExperienceInputA.setAttribute("required", "required");

    workExperienceColA.appendChild(workExperienceLabelA);
    workExperienceLabelA.appendChild(workExperienceAbbrA);
    workExperienceAbbrA.appendChild(workExperienceAbbrTextA);
    workExperienceAbbrA.appendChild(workExperienceStrongA);
    workExperienceStrongA.appendChild(workExperienceStrongTextA);
    workExperienceColA.appendChild(workExperienceInputA);

    // "Work experience" template col B.
    var workExperienceColB = document.createElement("div");
    workExperienceColB.setAttribute("class", "col-md-6 mt-3");
    var workExperienceLabelB = document.createElement("label");
    workExperienceLabelB.setAttribute("for", "inputEndOfEmployment" + (parseInt(lastWeTemplateId[0]) + 1));
    workExperienceLabelB.setAttribute("class", "form-label");
    var workExperienceInputB = document.createElement("input");
    workExperienceInputB.setAttribute("type", "date");
    workExperienceInputB.setAttribute("class", "form-control");
    workExperienceInputB.setAttribute("name", "inputEndOfEmployment" + (parseInt(lastWeTemplateId[0]) + 1));
    workExperienceInputB.setAttribute("id", "inputEndOfEmployment" + (parseInt(lastWeTemplateId[0]) + 1));
    workExperienceInputB.setAttribute("value", "");

    workExperienceColB.appendChild(workExperienceLabelB);
    workExperienceColB.appendChild(workExperienceInputB);

    workExperienceLabelB.textContent = "End of employment";

    // "Work experience" template col C.
    var workExperienceColC = document.createElement("div");
    workExperienceColC.setAttribute("class", "col-md-6 mt-3");
    var workExperienceLabelC = document.createElement("label");
    workExperienceLabelC.setAttribute("for", "inputWorkplaceName" + (parseInt(lastWeTemplateId[0]) + 1));
    workExperienceLabelC.setAttribute("class", "form-label");
    var workExperienceAbbrC = document.createElement("ABBR");
    workExperienceAbbrC.setAttribute("class", "abbrMustBeFilled");
    workExperienceAbbrC.setAttribute("title", "Must be filled!");
    var workExperienceAbbrTextC = document.createTextNode("Workplace name ");
    var workExperienceStrongC = document.createElement("STRONG");
    workExperienceStrongC.setAttribute("class", "strongMustBeFilled");
    var workExperienceStrongTextC = document.createTextNode("*");
    var workExperienceInputC = document.createElement("input");
    workExperienceInputC.setAttribute("type", "text");
    workExperienceInputC.setAttribute("class", "form-control");
    workExperienceInputC.setAttribute("name", "inputWorkplaceName" + (parseInt(lastWeTemplateId[0]) + 1));
    workExperienceInputC.setAttribute("id", "inputWorkplaceName" + (parseInt(lastWeTemplateId[0]) + 1));
    workExperienceInputC.setAttribute("value", "");
    workExperienceInputC.setAttribute("required", "required");

    workExperienceColC.appendChild(workExperienceLabelC);
    workExperienceLabelC.appendChild(workExperienceAbbrC);
    workExperienceAbbrC.appendChild(workExperienceAbbrTextC);
    workExperienceAbbrC.appendChild(workExperienceStrongC);
    workExperienceStrongC.appendChild(workExperienceStrongTextC);
    workExperienceColC.appendChild(workExperienceInputC);

    // "Work experience" template col D.
    var workExperienceColD = document.createElement("div");
    workExperienceColD.setAttribute("class", "col-md-6 mt-3");
    var workExperienceLabelD = document.createElement("label");
    workExperienceLabelD.setAttribute("for", "inputPosition" + (parseInt(lastWeTemplateId[0]) + 1));
    workExperienceLabelD.setAttribute("class", "form-label");
    var workExperienceAbbrD = document.createElement("ABBR");
    workExperienceAbbrD.setAttribute("class", "abbrMustBeFilled");
    workExperienceAbbrD.setAttribute("title", "Must be filled!");
    var workExperienceAbbrTextD = document.createTextNode("Position ");
    var workExperienceStrongD = document.createElement("STRONG");
    workExperienceStrongD.setAttribute("class", "strongMustBeFilled");
    var workExperienceStrongTextD = document.createTextNode("*");
    var workExperienceInputD = document.createElement("input");
    workExperienceInputD.setAttribute("type", "text");
    workExperienceInputD.setAttribute("class", "form-control");
    workExperienceInputD.setAttribute("name", "inputPosition" + (parseInt(lastWeTemplateId[0]) + 1));
    workExperienceInputD.setAttribute("id", "inputPosition" + (parseInt(lastWeTemplateId[0]) + 1));
    workExperienceInputD.setAttribute("value", "");
    workExperienceInputD.setAttribute("required", "required");

    workExperienceColD.appendChild(workExperienceLabelD);
    workExperienceLabelD.appendChild(workExperienceAbbrD);
    workExperienceAbbrD.appendChild(workExperienceAbbrTextD);
    workExperienceAbbrD.appendChild(workExperienceStrongD);
    workExperienceStrongD.appendChild(workExperienceStrongTextD);
    workExperienceColD.appendChild(workExperienceInputD);

    // "Work experience" template col E.
    var workExperienceColE = document.createElement("div");
    workExperienceColE.setAttribute("class", "col-12 mt-3 mb-2");
    var workExperienceLabelE = document.createElement("label");
    workExperienceLabelE.setAttribute("for", "inputJobDescription" + (parseInt(lastWeTemplateId[0]) + 1));
    workExperienceLabelE.setAttribute("class", "form-label");
    var workExperienceTextareaE = document.createElement("textarea");
    workExperienceTextareaE.setAttribute("class", "form-control");
    workExperienceTextareaE.setAttribute("name", "inputJobDescription" + (parseInt(lastWeTemplateId[0]) + 1));
    workExperienceTextareaE.setAttribute("id", "inputJobDescription" + (parseInt(lastWeTemplateId[0]) + 1));
    workExperienceTextareaE.setAttribute("rows", "5");

    workExperienceColE.appendChild(workExperienceLabelE);
    workExperienceColE.appendChild(workExperienceTextareaE);

    workExperienceLabelE.textContent = "Job description";

    // "Work experience" template col hr.
    var workExperienceHr = document.createElement("hr");
    workExperienceHr.setAttribute("class", "mt-4 mb-3");

    workExperienceRow.appendChild(workExperienceCol0);
    workExperienceRow.appendChild(workExperienceColA);
    workExperienceRow.appendChild(workExperienceColB);
    workExperienceRow.appendChild(workExperienceColC);
    workExperienceRow.appendChild(workExperienceColD);
    workExperienceRow.appendChild(workExperienceColE);
    workExperienceRow.appendChild(workExperienceHr);

    workExperienceFrame.appendChild(workExperienceRow);

    lastWeTemplate = workExperienceFrame.lastElementChild.id;
    workExperienceTemplateCounter.setAttribute("value", parseInt(lastWeTemplate.match(numberFinder)[0]));

    if(lastWeTemplate != "workExperienceTemplate0"){
        buttonDeleteLastWorkplace.removeAttribute("hidden", "hidden");
        buttonDeleteLastWorkplace.removeAttribute("disabled", "disabled");
    }
});

// "Delete last workplace" button removes the last "Work Experience" template.
buttonDeleteLastWorkplace.addEventListener("click", function(){
    var lastWeTemplate = workExperienceFrame.lastElementChild.id;

    if(lastWeTemplate != "workExperienceTemplate0"){
        workExperienceFrame.removeChild(workExperienceFrame.lastElementChild);

        lastWeTemplate = workExperienceFrame.lastElementChild.id;
        workExperienceTemplateCounter.setAttribute("value", parseInt(lastWeTemplate.match(numberFinder)[0]));

        if(lastWeTemplate == "workExperienceTemplate0"){
            buttonDeleteLastWorkplace.setAttribute("hidden", "hidden");
            buttonDeleteLastWorkplace.setAttribute("disabled", "disabled");
        }
    }
});