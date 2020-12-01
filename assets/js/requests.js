
// Redirects the user to blood samples request page
function sendReq(hospitalId){
    location.href = "./requestblood.php?id="+hospitalId;
}

// Redirects the user to login page if the user not loggedin
function notLoggedin(){
    location.href="./authentication/login.php";
}

// alerts the hospital user when clicked on the request button 
function notReceiver(){
    alert("You are not allowed to request.");
}

// Function will be called on change in the blood quantity dropdown field
// Updates the hiddent form fields for sending the data to store in database
function updateForm(id){
    let val = document.getElementById(id).value;
    document.getElementById(id+"-i").value = val;
}

// updates the hidden form fields when message field [textarea] updated 
function updateMsg(){
    document.getElementById("msg-i").value = document.getElementById("msg").value;
}

// Function called on change in the selection of blood groups
// Allows user to select only one particular blood group
function chgQnt(id){        // Takes the id of the radio button 
    let check = document.getElementById(id);
    let allFields = document.getElementsByClassName("bloodgroups");
    // Sets the allFields blood group quantity to 0
    for(let i=0;i<allFields.length;i++){
        document.getElementById(allFields[i].id+"-qnt").selectedIndex = 0;
        document.getElementById(allFields[i].id+"-qnt").disabled = true;
        document.getElementById(allFields[i].id+"-qnt-i").value = 0;
    }
    // Sets selected blood group quantity to 1
    if(check.checked){
        document.getElementById(id+"-qnt").selectedIndex = 1;
        document.getElementById(id+"-qnt").disabled = false;
        document.getElementById(id+"-qnt-i").value = 1;
    }
}

// validates the user sent request and submit the hidden form
function validateRequest(hospitalId){
    // Getting selected blood group details
    let aPosBox = document.getElementById("a-pos");
    let aNegBox = document.getElementById("a-neg");
    let bPosBox = document.getElementById("b-pos");
    let bNegBox = document.getElementById("b-neg");
    let abPosBox = document.getElementById("ab-pos");
    let abNegBox = document.getElementById("ab-neg");
    let oPosBox = document.getElementById("o-pos");
    let oNegBox = document.getElementById("o-neg");

    // Getting the blood units required
    let aPosQnt = document.getElementById("a-pos-qnt").value;
    let aNegQnt = document.getElementById("a-neg-qnt").value;
    let bPosQnt = document.getElementById("b-pos-qnt").value;
    let bNegQnt = document.getElementById("b-neg-qnt").value;
    let abPosQnt = document.getElementById("ab-pos-qnt").value;
    let abNegQnt = document.getElementById("ab-neg-qnt").value;
    let oPosQnt = document.getElementById("o-pos-qnt").value;
    let oNegQnt = document.getElementById("o-neg-qnt").value;

    // Validating the data
    if(!aPosBox.checked && !aNegBox.checked && !bPosBox.checked && !bNegBox.checked && !abNegBox.checked && !abPosBox.checked && !oPosBox.checked && !oNegBox.checked){
        alert("Select the needed group.");
    }
    else if(aPosQnt==0 && aNegQnt==0 && bPosQnt==0 && bNegQnt==0 && abNegQnt==0 && abPosQnt==0 && oPosQnt==0 && oNegQnt==0){
        alert("Must select minimum 1 unit.");
    }else{
        // Submits the form
        document.getElementById("req-form").submit();
    }
}