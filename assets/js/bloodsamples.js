/*
    Handles the request button actions in available blood samples page
*/

// These methods are called when the users clicked request sample button

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