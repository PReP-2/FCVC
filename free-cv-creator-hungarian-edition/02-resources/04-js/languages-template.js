// Hidden counter to determine how many input fields need to be send to the server.
var languagesTemplateCounter = document.getElementById("languagesTemplateCounter");

// Languages.
var languagesFrame = document.getElementById("languagesFrame");

var buttonAddNewLanguage = document.getElementById("buttonAddNewLanguage");
var buttonDeleteLastLanguage = document.getElementById("buttonDeleteLastLanguage");

var lastLTemplate = languagesFrame.lastElementChild.id;
languagesTemplateCounter.setAttribute("value", parseInt(lastLTemplate.match(numberFinder)[0]));

// Visible only if there is more than one template.
if(lastLTemplate == "languagesTemplate0"){
    buttonDeleteLastLanguage.setAttribute("hidden", "hidden");
    buttonDeleteLastLanguage.setAttribute("disabled", "disabled");
}

// "Add new language" button creates a new "Languages" template.
buttonAddNewLanguage.addEventListener("click", function(){
    // Last "Languages" template ID.
    var lastLTemplateId = languagesFrame.lastElementChild.id.match(numberFinder);

    // "Languages" template row.
    var languagesRow = document.createElement("div");
    languagesRow.setAttribute("class", "row gx-3 mx-auto px-0");
    languagesRow.setAttribute("id", "languagesTemplate" + (parseInt(lastLTemplateId[0]) + 1));

    // "Languages" template col A.
    var languagesColA = document.createElement("div");
    languagesColA.setAttribute("class", "col-md-6 mt-3");
    var languagesLabelA = document.createElement("label");
    languagesLabelA.setAttribute("for", "inputLanguage" + (parseInt(lastLTemplateId[0]) + 1));
    languagesLabelA.setAttribute("class", "form-label");
    var languagesAbbrA = document.createElement("ABBR");
    languagesAbbrA.setAttribute("class", "abbrMustBeFilled");
    languagesAbbrA.setAttribute("title", "Must be filled!");
    var languagesAbbrTextA = document.createTextNode("Language ");
    var languagesStrongA = document.createElement("STRONG");
    languagesStrongA.setAttribute("class", "strongMustBeFilled");
    var languagesStrongTextA = document.createTextNode("*");
    var languagesSelectA = document.createElement("select");
    languagesSelectA.setAttribute("class", "form-select forcedRequireLanguage");
    languagesSelectA.setAttribute("name", "inputLanguage" + (parseInt(lastLTemplateId[0]) + 1));
    languagesSelectA.setAttribute("id", "inputLanguage" + (parseInt(lastLTemplateId[0]) + 1));

    var languagesOptionA01 = document.createElement("option");
    languagesOptionA01.setAttribute("value", "");
    languagesOptionA01.setAttribute("selected", "selected");
    var languagesOptionA16 = document.createElement("option");
    languagesOptionA16.setAttribute("value", "Angol");
    var languagesOptionA57 = document.createElement("option");
    languagesOptionA57.setAttribute("value", "Egyéb");
    var languagesOptionA20 = document.createElement("option");
    languagesOptionA20.setAttribute("value", "Francia");
    var languagesOptionA22 = document.createElement("option");
    languagesOptionA22.setAttribute("value", "Német");
    var languagesOptionA30 = document.createElement("option");
    languagesOptionA30.setAttribute("value", "Olasz");
    var languagesOptionA43 = document.createElement("option");
    languagesOptionA43.setAttribute("value", "Orosz");
    var languagesOptionA47 = document.createElement("option");
    languagesOptionA47.setAttribute("value", "Spanyol");
    

    languagesColA.appendChild(languagesLabelA);
    languagesLabelA.appendChild(languagesAbbrA);
    languagesAbbrA.appendChild(languagesAbbrTextA);
    languagesAbbrA.appendChild(languagesStrongA);
    languagesStrongA.appendChild(languagesStrongTextA);
    languagesColA.appendChild(languagesSelectA);
    languagesSelectA.appendChild(languagesOptionA01);
    languagesSelectA.appendChild(languagesOptionA16);
    languagesSelectA.appendChild(languagesOptionA57);
    languagesSelectA.appendChild(languagesOptionA20);
    languagesSelectA.appendChild(languagesOptionA30);
    languagesSelectA.appendChild(languagesOptionA43);
    languagesSelectA.appendChild(languagesOptionA47);

    languagesOptionA16.textContent = "Angol";
    languagesOptionA57.textContent = "Egyéb";
    languagesOptionA20.textContent = "Francia";
    languagesOptionA22.textContent = "Német";
    languagesOptionA30.textContent = "Olasz";
    languagesOptionA43.textContent = "Orosz";
    languagesOptionA47.textContent = "Spanyol";

    // "Languages" template col B.
    var languagesColB = document.createElement("div");
    languagesColB.setAttribute("class", "col-md-6 mt-3 mb-2");
    var languagesLabelB = document.createElement("label");
    languagesLabelB.setAttribute("for", "inputLevel" + (parseInt(lastLTemplateId[0]) + 1));
    languagesLabelB.setAttribute("class", "form-label");

    var languagesAbbrB = document.createElement("ABBR");
    languagesAbbrB.setAttribute("class", "abbrMustBeFilled");
    languagesAbbrB.setAttribute("title", "Must be filled!");
    var languagesAbbrTextB = document.createTextNode("Level ");
    var languagesStrongB = document.createElement("STRONG");
    languagesStrongB.setAttribute("class", "strongMustBeFilled");
    var languagesStrongTextB = document.createTextNode("*");

    var languagesSelectB = document.createElement("select");
    languagesSelectB.setAttribute("class", "form-select forcedRequireLevel");
    languagesSelectB.setAttribute("name", "inputLevel" + (parseInt(lastLTemplateId[0]) + 1));
    languagesSelectB.setAttribute("id", "inputLevel" + (parseInt(lastLTemplateId[0]) + 1));
    var languagesOptionB01 = document.createElement("option");
    languagesOptionB01.setAttribute("value", "");
    languagesOptionB01.setAttribute("selected", "selected");
    var languagesOptionB03 = document.createElement("option");
    languagesOptionB03.setAttribute("value", "A2 - Alapfok");
    var languagesOptionB05 = document.createElement("option");
    languagesOptionB05.setAttribute("value", "B2 - Középfok");
    var languagesOptionB07 = document.createElement("option");
    languagesOptionB07.setAttribute("value", "C2 - Felsőfok");

    languagesColB.appendChild(languagesLabelB);
    languagesLabelB.appendChild(languagesAbbrB);
    languagesAbbrB.appendChild(languagesAbbrTextB);
    languagesAbbrB.appendChild(languagesStrongB);
    languagesStrongB.appendChild(languagesStrongTextB);
    languagesColB.appendChild(languagesSelectB);
    languagesSelectB.appendChild(languagesOptionB01);
    languagesSelectB.appendChild(languagesOptionB03);
    languagesSelectB.appendChild(languagesOptionB05);
    languagesSelectB.appendChild(languagesOptionB07);

    languagesOptionB03.textContent = "A2 - Alapfok";
    languagesOptionB05.textContent = "B2 - Középfok";
    languagesOptionB07.textContent = "C2 - Felsőfok";

    // "Languages" template col hr.
    var languagesHr = document.createElement("hr");
    languagesHr.setAttribute("class", "mt-4 mb-3");

    languagesRow.appendChild(languagesColA);
    languagesRow.appendChild(languagesColB);
    languagesRow.appendChild(languagesHr);

    languagesFrame.appendChild(languagesRow);

    lastLTemplate = languagesFrame.lastElementChild.id;
    languagesTemplateCounter.setAttribute("value", parseInt(lastLTemplate.match(numberFinder)[0]));

    if(lastLTemplate != "languagesTemplate0"){
        buttonDeleteLastLanguage.removeAttribute("hidden", "hidden");
        buttonDeleteLastLanguage.removeAttribute("disabled", "disabled");
    }
});

// "Delete last language" button removes the last "Languages" template.
buttonDeleteLastLanguage.addEventListener("click", function(){
    var lastLTemplate = languagesFrame.lastElementChild.id;

    if(lastLTemplate != "languagesTemplate0"){
        languagesFrame.removeChild(languagesFrame.lastElementChild);

        lastLTemplate = languagesFrame.lastElementChild.id;
        languagesTemplateCounter.setAttribute("value", parseInt(lastLTemplate.match(numberFinder)[0]));

        if(lastLTemplate == "languagesTemplate0"){
            buttonDeleteLastLanguage.setAttribute("hidden", "hidden");
            buttonDeleteLastLanguage.setAttribute("disabled", "disabled");
        }
    }
});