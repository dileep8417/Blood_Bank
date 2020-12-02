// This file cotains code for performing common functionality among all the pages

// Function executes when the page is loaded
window.onload = function(){
    // Hiding the spinner and displaying the content when the page is loaded
    document.getElementById("loader").style.display = "none";
    document.getElementById("body").style.display = "block";
}