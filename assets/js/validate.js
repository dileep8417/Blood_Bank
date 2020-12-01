
// Validating Receiver Registration Form
try{
     document.getElementById("receiver-register-btn").addEventListener("click",function(e){
         // Removing the default behaviour of the form submission for validating the data
          e.preventDefault();  
          // Getting the form data
          let name = document.getElementById("username").value; 
          let email = document.getElementById("email").value;
          let contact = document.getElementById("contact").value;
          let bloodGroup = document.getElementById("bloodgroup").value;
          let age = document.getElementById("age").value;
          let state = document.getElementById("state").value; 
          let city = document.getElementById("city").value;
          let zipcode = document.getElementById("zipcode").value;
          let pwd = document.getElementById("pwd").value;
          let repwd = document.getElementById("repwd").value;
          let msg = "";
          // Validation
          if(name.length<2){
               msg = "User name must be more than 2 charecters.";
          }else if(email.length<4){
               msg = "Enter valid Email Id.";
          }else if(contact.length<6){
               msg = "Enter valid contact number.";
          }
          else if(bloodGroup.length<2){
               msg = "Select your blood group.";
          }
          else if(age.length<1 || age.length>3){
              msg = "Enter the proper age.";
          }
          else if(state.length<2){
              msg = "Mention your state properly.";
          }
          else if(city.length<3){
               msg = "Mention your city properly.";
          }else if(zipcode.length<4){
               msg = "Mention your zipcode properly";
          }else if(pwd.length<4){
               msg = "Password must be more than 3 charecters.";
          }else if(pwd!=repwd){
               msg = "Password and Re-Password are not matching";
          }else{
               // No errors 
               // Submitting the form
               document.getElementById("receiver-registration").submit();
               msg = "Processing...";
          }
          window.scrollTo(500, 0);      // Scrolls current page to top for showing error
          document.getElementById("err-msg").innerHTML  = msg;
       });
}catch(Exception){}




 // Validating Hospital Registration Form
try{
     document.getElementById("hospital-register-btn").addEventListener("click",function(e){
          // Removing the default behaviour of the form submission for validating the data
          e.preventDefault();  
          // Getting the form data
          let name = document.getElementById("hospital").value; 
          let email = document.getElementById("email").value;
          let contact = document.getElementById("contact").value;
          let state = document.getElementById("state").value; 
          let city = document.getElementById("city").value;
          let zipcode = document.getElementById("zipcode").value;
          let pwd = document.getElementById("pwd").value;
          let repwd = document.getElementById("repwd").value;
          let msg = "";
          // Validation
     
          if(name.length<2){
               msg = "Hospital name must be more than 2 charecters.";
          }else if(email.length<4){
               msg = "Enter valid Email Id.";
          }else if(contact.length<6){
               msg = "Enter valid contact number.";
          }
          else if(state.length<2){
          msg = "Mention your hospital state properly.";
          }
          else if(city.length<3){
               msg = "Mention your hospital city properly.";
          }else if(zipcode.length<4){
               msg = "Mention your hospital zipcode properly";
          }else if(pwd.length<4){
               msg = "Password must be more than 3 charecters.";
          }else if(pwd!=repwd){
               msg = "Password and Re-Password are not matching";
          }else{
               // Submitting the form
               document.getElementById("hospital-registration").submit();
               msg = "Processing...";
          }
          window.scrollTo(500, 0);
          document.getElementById("err-msg").innerHTML  = msg;
     });
}catch(Exception){}



// Validating Update Blood Info Form
try{
    document.getElementById("update-blood-info-btn").addEventListener("click",function(e){
         // Removing the default behaviour of the form submission for validating the data
          e.preventDefault();  
          // Getting the form data
         let grp = document.getElementById("blood-group").value;
         let qnt = document.getElementById("qnt").value;
         let action = document.getElementById("action").value;
         let msg = "";
         // Validation
         if(grp.length<1){
               msg = "Select the blood group";
         }else if(qnt<=0){
               msg = "Quantity must be greater than 0";
         }else{
              // Submitting the form
          document.getElementById("blood-info-form").submit();
         }
         document.getElementById("err").innerHTML = msg;
    });
}catch(Exception){}
