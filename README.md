Setup & Installation:

Use git to clone this repository.
Make sure you have downloaded XAMPP.
Run apache and MySql
Import the database dump on  http://localhost/phpmyadmin/
Make sure the credentials are default or match them with the ones given at db.php

Running the Website:

Once you've set up XAMPP and the database, open localhost and navigate to any of the pages (login.php/employee.php/manager.php).
Each selection should redirect you to login.php. Fill the correct credentials found on the database "Users" table
and depending on the user you choose to log in to, you should be redirected to the correct page.

Features:

  For Employees: 
      Once they log in to the portal, they can see:
      1) a table with the history of their requests
      2) a request form to fill for their manager
      3) an option button to Log out.
  For Manager:
    Once the manager logs in to the Manager portal, he can see:
    1) a table with all the users data needed. He has 2 options: edit them which on click shows a new form where he fills correct data
                                                                or delete the user which automatically deletes the user's requests from the db.
    2) a table with all the requests from all users. He has the option to REJECT,APPROVE or keep them PENDING.
    3) there is a form which he can fill in order to register a new user (employee) to the database.
    
File Structure:

The project contains 3 folders CSS (for basic viewing improvement) , handlers and includes:
includes: contains the database object creation and set up. It creates an object which is used to 
query to the actual database throughout the project.

handlers: Each handler performs unique operation throughout the project.

  create_request_handler: Only employess can create a request which is checked via super global variable SESSION
                          afterwards it "INSERTS" a new entity to request table.
  delete_request_handler: An employee has the ability to delete a request he has submitted while it is still on the "PENDING" phase.
  requests_employee_handler: This handler retrieves all the requests the logged-in user has sent.
    
  All employee handlers have the same error-checking for loggin and user type (Employee/Manager) instances.
    
  delete_user_handler: A manager handler used to delete the user from the database.
  edit_user_handler: Updates fields of an entity of the "users" table
  register_handler: Creates a new entity on the "users" table
  requests_update_handler: Updates the state of a selected Request from a user to the database
  select_all_requests_handler: Simple select query that retrieves all the entities of the "requests" table
  select_all_users_handler: Simple select query that retrieves all the entities of the "users" table

  All manager handlers have the same error-checking for loggin and user type (Employee/Manager) instances.

  login_handler: checks for the data provided by the user at that log in phase and redirects him to the correct portal if it was successful.
  Additionally, it sets up the SESSION variable
  logout_handler: destroys the SESSION variable

Database Structure:

  In the database provided there are 2 tables "users" and "requests":
  "Users": 8 fields in total. "id" is provided to distinguish each entity as PRIMARY KEY
  and isManager is provided as a boolean check to determine the type of user (Employee/Manager)
  
  "Requests": 7 fields in total. "id" is provided to distinguish each entity as PRIMARY KEY,
  dates for the duration of the request are saved on the fields "date_from" and "date_to" accordingly.
  In addition, there is a field "reason" which represents the point of the request as well as a "status" field which 
  is set to "PENDING" when  users send the request. Lastly, there is a field called "user_id". It represent a foreign_key from the table 
  "users" and  field "users.id". It depicts the user the has sent the request on each entity of the table. That's why the table has been set 
  "ON DELETE CASCADE" so everytime a user is deleted by a manager all their requests automatically get dropped.
    
  
    
                                          



