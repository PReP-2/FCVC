// Form validation before submit.
var mainForm = document.getElementById("mainForm");
var submitForm = document.getElementById("submitForm");

submitForm.addEventListener("click", function(){
        var forcedRequireLanguage = document.getElementsByClassName("forcedRequireLanguage");
        var forcedRequireLevel = document.getElementsByClassName("forcedRequireLevel");

        // Makes sure that the "Language" inputs won't get through validation half or fully empty.
        for(var i = 0; i < forcedRequireLanguage.length; i++){
                if(forcedRequireLanguage.length == 1){
                        if(forcedRequireLanguage[i].value != "" || forcedRequireLevel[i].value != ""){
                                forcedRequireLanguage[i].setAttribute("required", "required");
                                forcedRequireLevel[i].setAttribute("required", "required");
                        }
                        else if(forcedRequireLanguage[i].value == "" && forcedRequireLevel[i].value == ""){
                                forcedRequireLanguage[i].removeAttribute("required", "required");
                                forcedRequireLevel[i].removeAttribute("required", "required");
                        }
                }
                else if(forcedRequireLanguage.length > 1){
                        forcedRequireLanguage[i].setAttribute("required", "required");
                        forcedRequireLevel[i].setAttribute("required", "required");
                }
        }

        mainForm.setAttribute("class", "row g-3 was-validated");
});