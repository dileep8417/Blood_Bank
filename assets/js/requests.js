/*
    Handles receivers request page
*/

// Supported blood groups information
let supportedBloodGroups = {
    "aPos":["aPos","aNeg","oPos","oNeg"],
    "aNeg":["aNeg","oNeg"],
    "bPos":["bPos","bNeg","oPos","oNeg"],
    "bNeg":["bNeg","oNeg"],
    "abPos":["aPos","aNeg","bPos","bNeg","AbPos","AbNeg","oPos","oNeg"],
    "abNeg":["AbNeg","aNeg","bNeg","oNeg"],
    "oPos":["oPos","oNeg"],
    "oNeg":["oNeg"]
};
let availableQuantity;  // For storing the quantity of a particular blood group available in blood bank
let selectedQuantity;   // For storing user selected quantity


// Calls the function when the page is loaded
window.onload = function(){
    // Load the form with receiver eligible blood groups
    setForm(receiverBloodGroup); // Sets the form according the receiver blood group
}

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

// To change the actual value to convinient value
function changeFormat(bloodGroup){
    if(bloodGroup=="A+"){
        return "aPos";
    }if(bloodGroup=="B+"){
        return "bPos";
    }if(bloodGroup=="O+"){
        return "oPos";
    }if(bloodGroup=="AB+"){
        return "abPos";
    }if(bloodGroup=="A-"){
        return "aNeg";
    }if(bloodGroup=="B-"){
        return "bNeg";
    }if(bloodGroup=="O-"){
        return "oNeg";
    }if(bloodGroup=="AB-"){
        return "abNeg";
    }
}

// Sets the blood request form when the page is loaded for displaying receiver eligible blood types
function setForm(){
    // updating the variable value according to the blood group for handling html elements
    let bloodGroup = changeFormat(receiverBloodGroup);
    suppoerted = supportedBloodGroups[bloodGroup]; 
    for(let i=0;i<suppoerted.length;i++){
        // Displaying the receiver eligible blood groups
        document.getElementById(suppoerted[i]+"-row").style.display = "table-row";
    }
}

// Function will be called on change in the blood quantity dropdown field
// Updates the hiddent form fields for sending the data to store in database
function updateForm(id){
    let val = document.getElementById(id).value;
    document.getElementById(id+"-i").value = val;
    selectedQuantity = val;
}

// updates the hidden form fields when message field [textarea] updated 
function updateMsg(){
    document.getElementById("msg-i").value = document.getElementById("msg").value;
}

// Set
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
        selectedQuantity = 1;
    }
}

// To check the availability of receiver requested blood group
function checkAvailability(){
    let bloodGroup = changeFormat(receiverBloodGroup);
    // Sending HTTP request for getting available quanity in blood bank
    var xhttp = new XMLHttpRequest();                   // Creates object for XMLHttpRequest
    xhttp.onreadystatechange = function() {             // Called on completion of request
        if (this.readyState == 4 && this.status == 200) {       // Checking the status
        // Typical action to be performed when the document is ready:
            availableQuantity = xhttp.responseText;
            if(parseInt(availableQuantity)<parseInt(selectedQuantity)){
                alert("You are requesting more units than available.");
            }else{
                // Submits the form
                document.getElementById("req-form").submit();
            }
        }
    };
    xhttp.open("GET", `./checkavailability.php?id=${hospitalId}&grp=${bloodGroup}`, true);
    xhttp.send()
}

// validates the user sent request and submit the hidden form
function validateRequest(hospitalId){
    // Getting selected blood group details
    let aPosBox = document.getElementById("aPos");
    let aNegBox = document.getElementById("aNeg");
    let bPosBox = document.getElementById("bPos");
    let bNegBox = document.getElementById("bNeg");
    let abPosBox = document.getElementById("abPos");
    let abNegBox = document.getElementById("abNeg");
    let oPosBox = document.getElementById("oPos");
    let oNegBox = document.getElementById("oNeg");

    // Getting the blood units required
    let aPosQnt = document.getElementById("aPos-qnt").value;
    let aNegQnt = document.getElementById("aNeg-qnt").value;
    let bPosQnt = document.getElementById("bPos-qnt").value;
    let bNegQnt = document.getElementById("bNeg-qnt").value;
    let abPosQnt = document.getElementById("abPos-qnt").value;
    let abNegQnt = document.getElementById("abNeg-qnt").value;
    let oPosQnt = document.getElementById("oPos-qnt").value;
    let oNegQnt = document.getElementById("oNeg-qnt").value;

    // Validating the data
    if(!aPosBox.checked && !aNegBox.checked && !bPosBox.checked && !bNegBox.checked && !abNegBox.checked && !abPosBox.checked && !oPosBox.checked && !oNegBox.checked){
        alert("Select the needed group.");
    }
    else if(aPosQnt==0 && aNegQnt==0 && bPosQnt==0 && bNegQnt==0 && abNegQnt==0 && abPosQnt==0 && oPosQnt==0 && oNegQnt==0){
        alert("Must select minimum 1 unit.");
    }else{
        // Checks the availability and submits the form if eligible
        checkAvailability();
    }
}