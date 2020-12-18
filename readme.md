This project cotains the code for Blood Bank Mangement System

Running the Project
    -> Import database file (.sql) into `PhpMyAdmin` from `db/blood_bank.sql` 
    
    -> Update the database credentials in `config/connection.php` file
    
    -> Set project folder name in operation.php file for routing 


Folder Structure                                                                       
    assets          -> This folder contains static folders (images/css/js)   

    authentication  -> Contains user login, registration, logout realted files  

    Components      -> Contains basic components of the website (navbar/footer)

    config          -> Contains database configuration      

    db              -> Contains database file (.sql)     

    hospital        -> Contains files related to the Hospital user  

    modules         -> contains files which are included in other files for performing specific task

    templates       -> Contains HTML files 
 


Tables in the database
    users              -> Stores users email and password along with their type for login

    receiver_details   -> Stores the receiver details while registering the receiver

    hospitals          -> Stores the hospital details while registering the hospital

    blood_info         -> Stores blood units information of the hospitals

    user_requests      -> Stores the requests made by the receivers for the blood




