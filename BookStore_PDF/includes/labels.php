<?php

error_reporting(0);
define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASS', '');
define('DBNAME', 'BookStore');

// Get Default Time Zone To Asia
//date_default_timezone_set("Asia/kolkata");

define("SITE_NAME", "BookStore");
define("SESSION_ALIAS", "BookStore");
define('SITE_URL', "http://" . $_SERVER['HTTP_HOST'] . "/BookStore/");
define('ADMIN_URL', "http://" . $_SERVER['HTTP_HOST'] . "/BookStore/admin");
define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'] . "/BookStore/");
define("COMPANY_NAME", "Book Store.");
$year = date('Y');
define("COPYRIGHT", "&copy Copyright $year - All Rights Reserved ( Book Store )");
define("EMAIL_TO", "info@.com");
define("CONTACT_EMAIL", "info@.com");
define("CONTACT_PASSWORD", "abc@123");
define("contact", "Contact Us");
define("EMAIL_FOOTER", "With Best Regards,<br>Books Store.<br><br><small>Note: Please do not reply or forward this email.<br>If you are not associated with this email, please ignore and delete.</small>");
// login & registration classes
define("MESSAGE_ACCOUNT_NOT_ACTIVATED", "Your account is not activated yet. Please click on the confirm link in the mail.");
define("MESSAGE_CAPTCHA_WRONG", "Captcha was wrong!");
define("MESSAGE_COOKIE_INVALID", "Invalid cookie");
define("MESSAGE_DATABASE_ERROR", "Database connection problem.");
define("MESSAGE_EMAIL_ALREADY_EXISTS", "This email address is already registered. Please use the \"I forgot my password\" page if you don't remember it.");
define("MESSAGE_EMAIL_CHANGE_FAILED", "Sorry, your email changing failed.");
define("MESSAGE_EMAIL_CHANGED_SUCCESSFULLY", "Your email address has been changed successfully. New email address is ");
define("MESSAGE_EMAIL_EMPTY", "Email cannot be empty");
define("MESSAGE_EMAIL_INVALID", "Your email address is not in a valid email format");
define("MESSAGE_EMAIL_SAME_LIKE_OLD_ONE", "Sorry, that email address is the same as your current one. Please choose another one.");
define("MESSAGE_EMAIL_TOO_LONG", "Email cannot be longer than 64 characters");
define("MESSAGE_LINK_PARAMETER_EMPTY", "Empty link parameter data.");
define("MESSAGE_LOGGED_OUT", "You have been logged out.");
// The "login failed"-message is a security improved feedback that doesn't show a potential attacker if the user exists or not
define("MESSAGE_LOGIN_FAILED", "Login failed.");
define("MESSAGE_OLD_PASSWORD_WRONG", "Your OLD password was wrong.");
define("MESSAGE_PASSWORD_BAD_CONFIRM", "Password and password repeat are not the same");
define("MESSAGE_PASSWORD_CHANGE_FAILED", "Sorry, your password changing failed.");
define("MESSAGE_PASSWORD_CHANGED_SUCCESSFULLY", "Password successfully changed! Please login with new password");
define("MESSAGE_PASSWORD_EMPTY", "Password field was empty");
define("MESSAGE_PASSWORD_RESET_MAIL_FAILED", "Password reset mail failed to send! Error: ");
define("MESSAGE_PASSWORD_RESET_MAIL_SUCCESSFULLY_SENT", "Password reset mail successfully sent! Please enter email again if you have not received email.");
define("CHECK_EMAIL_REQUEST", "Please check your email.");
define("MESSAGE_PASSWORD_TOO_SHORT", "Password has a minimum length of 6 characters");
define("MESSAGE_PASSWORD_WRONG", "Wrong password. Try again.");
define("MESSAGE_PASSWORD_WRONG_3_TIMES", "You have entered an incorrect password more than 3 times. Please enter captcha to ensure you are not a robot.");
define("MESSAGE_PASSWORD_WRONG_5_TIMES", "You have entered an incorrect password more than 5 times. Please wait for 5 minutes and try again.");
define("MESSAGE_REGISTRATION_ACTIVATION_NOT_SUCCESSFUL", "Sorry, no such id/verification code combination here...");
define("MESSAGE_REGISTRATION_ACTIVATION_SUCCESSFUL", "Activation was successful! You can now log in!");
define("MESSAGE_REGISTRATION_FAILED", "Sorry, your registration failed. Please go back and try again.");
define("MESSAGE_RESET_LINK_HAS_EXPIRED", "Your reset link has expired. Please use the reset link within one hour.");
define("MESSAGE_VERIFICATION_MAIL_ERROR", "Sorry, we could not send you an verification mail. Your account has NOT been created.");
define("MESSAGE_VERIFICATION_MAIL_NOT_SENT", "Verification Mail failed to send! Error: ");
define("MESSAGE_VERIFICATION_MAIL_SENT", "Your account has been created successfully and we have sent you an email. Please click the VERIFICATION LINK within that mail.");
define("MESSAGE_USER_DOES_NOT_EXIST", "This user does not exist");
define("MESSAGE_USERNAME_BAD_LENGTH", "Username cannot be shorter than 2 or longer than 64 characters");
define("MESSAGE_USERNAME_CHANGE_FAILED", "Sorry, your chosen username renaming failed");
define("MESSAGE_USERNAME_CHANGED_SUCCESSFULLY", "Your username has been changed successfully. New username is ");
define("MESSAGE_USERNAME_EMPTY", "Username field was empty");
define("MESSAGE_USERNAME_EXISTS", "Sorry, that username is already taken. Please choose another one.");
define("MESSAGE_USERNAME_INVALID", "Username does not fit the name scheme: only a-Z and numbers are allowed, 2 to 64 characters");
define("MESSAGE_USERNAME_SAME_LIKE_OLD_ONE", "Sorry, that username is the same as your current one. Please choose another one.");

// views
define("WORDING_BACK_TO_LOGIN", "Back to Login Page");
define("WORDING_CHANGE_EMAIL", "Change email");
define("WORDING_CHANGE_PASSWORD", "Change password");
define("WORDING_CHANGE_USERNAME", "Change username");
define("WORDING_CURRENTLY", "currently");
define("WORDING_EDIT_USER_DATA", "Edit user data");
define("WORDING_EDIT_YOUR_CREDENTIALS", "You are logged in and can edit your credentials here");
define("WORDING_FORGOT_MY_PASSWORD", "I forgot my password");
define("WORDING_LOGIN", "Log in");
define("WORDING_LOGOUT", "Log out");
define("WORDING_NEW_EMAIL", "New email");
define("WORDING_NEW_PASSWORD", "New password");
define("WORDING_NEW_PASSWORD_REPEAT", "Repeat new password");
define("WORDING_NEW_USERNAME", "New username (username cannot be empty and must be azAZ09 and 2-64 characters)");
define("WORDING_OLD_PASSWORD", "Your OLD Password");
define("WORDING_PASSWORD", "Password");
define("WORDING_PROFILE_PICTURE", "Your profile picture (from gravatar):");
define("WORDING_REGISTER", "Register");
define("WORDING_REGISTER_NEW_ACCOUNT", "Register new account");
define("WORDING_REGISTRATION_CAPTCHA", "Please enter these characters");
define("WORDING_REGISTRATION_EMAIL", "User's email (please provide a real email address, you'll get a verification mail with an activation link)");
define("WORDING_REGISTRATION_PASSWORD", "Password (min. 6 characters!)");
define("WORDING_REGISTRATION_PASSWORD_REPEAT", "Password repeat");
define("WORDING_REGISTRATION_USERNAME", "Username (only letters and numbers, 2 to 64 characters)");
define("WORDING_REMEMBER_ME", "Keep me logged in (for 2 weeks)");
define("WORDING_REQUEST_PASSWORD_RESET", "Request a password reset. Enter your username and you'll get a mail with instructions:");
define("WORDING_RESET_PASSWORD", "Reset my password");
define("WORDING_SUBMIT_NEW_PASSWORD", "Submit new password");
define("WORDING_USERNAME", "Username");
define("WORDING_YOU_ARE_LOGGED_IN_AS", "You are logged in as ");
define("WORDING_ADMIN_LINK", "Videos");
define("WORDING_EDIT_USERS", "Edit Users");
define("WORDING_UPLOADER", "Upload");
define("WORDING_EDIT_ADS", "Advertisments");
define("EntryIsAvailable", "Entry is available");
//MENU LIST
define("Project", "Book Store");
define("SearchCityByCountry", "Country Search:");
define("SearchCityByState", "State Search:");
define("AllState", "All States");
define("AllCity", "All Cities");
define("home", 'Dashboard');
define("create", 'Create');
define("edit", 'Edit');
define("menu_rights", 'Menu Rights');
define("view_client", 'Clients Master');
define("CountryName", 'Country Name');
define("RowAction", 'Row Action');
define("country", 'Country');
define("StateName", 'State Name');
define("CategoryTitle", 'Category Title');
define("Agents", 'Agents');
define("OpeningBalance", 'Opening Balance');
define("RetailersName", 'Retailer Name');
define("NameOfRetailer", 'Name of Retailer');
define("Date", 'Date');
define("Type", 'Type');
define("CheckNo", 'Check No');
define("BankName", 'Bank Name');
define("Comment", 'Comment');
define("ExpenseTitle", 'Expense Title');
define("ExpenseDate", 'Expense Date');
define("ExpenseDescription", 'Expense Description');
define("ExpenseAmount", 'Expense Amount');
define("state", 'State');
define("CityName", 'City Name');
define("city", 'City');
define("ZipCode", 'Zip Code');
define("action", 'Action');
define("sr_no", 'Sr. No.');
define("update", 'Update');
define("back", 'Back');
define("save", 'Save');
define("view_all", 'View All');
define("add_new", 'Add New ');
define("Fname", 'First Name');
define("Mname", 'Middle Name');
define("Lname", 'Last Name');
define("username", 'Username');
define("email", 'Email ID');
define("TotalAmount", 'Total Amount');
define("Discount", 'Discount');
define("Quantity", 'Quantity');
define("CostPrice", 'Cost Price');
define("password", 'Password');
define("dob", 'Birth Date');
define("Gender", 'Gender');
define("Bdate", 'Birth Date');
define("store_name", 'Store Name');
define("cell_number", 'Mobile Number');
define("land_number", 'Landline Number');
define("ResAddressLine1", 'Address Line #1');
define("ResAddressLine2", 'Address Line #2');
define("ZIPCode", 'ZIP Code');
define("about_me", 'About You');
define("about_us", 'About Us');
define("MobileNumber", 'Mobile Number');
define("AgentName", 'Agent Name');
define("BookSellerName", 'Book Seller Name');
define("about_description", 'About Description');
define("return_description", 'Return Description');
define("return_content", 'Return Policy Content');
define("company_name", 'Company Name');
define("address", 'Address');
define("phone_no", 'Phone No.');
define("fax", 'Fax');
define("zipcode", 'ZIP Code');
define("SliderHeading", 'Slider Heading');
define("SliderText", 'Slider Text');
define("SliderImage", 'Slider Image');
define("faq_question", 'FAQ Question');
define("faq_answer", 'FAQ Answer');
define("term_description", 'Term & Description');
define("privacy_content", 'Privacy Content');
define("name", 'Name');
define("agreement_title", 'Agreement Title');
define("agreement_desc", ' Agreement Description');
define("profile", 'Profile');
define("userprofile", 'Profile');
define("user_master", 'User Master');
define("location_master", 'Location Masters');
define("cms_manage", 'CMS Management');
define("admin_user", 'Administrator Users');
define("location_master", 'Location Master');
define("slider", 'Slider');
define("Tileslider", 'Sliders');
define("faq", 'FAQs');
define("term", 'Terms & Conditions');
define("policy_content", 'Privacy Policy Content');
define("agreement", 'Agreement');
define("Upload", 'Upload');


define("NoImageAlert", 'Please Browse Image first to upload');
define("general_master", 'General Master');
define("client_category_master", 'Client Category Master');
define("supplier_tag_master", 'Supplier Tag Master');
define("event_site_category_master", 'Event Site Category Master');
define("ClientCategoryName", 'Category Name');
define("ClientCategoryDesc", 'Category Description');
define("SupplierTagName", 'Supplier Tag Name');
define("SupplierTagDesc", 'Supplier Tag Description');
define("EventSiteCategoryName", 'Event Site Category Name');
define("EventSiteCategoryDesc", 'Event Site Category Description');

//Login Page Labels START-----
define("Login", 'Login');
define("EnterInfo", 'Enter Your Login Information');
define("PlaceholderUserName", 'Enter Your UserName OR E-mail');
define("PlaceholderPassWord", 'Enter Your Password');
define("CopyRight", '&copy; Safari Infosoft');
//Login Page Labels END-----
//Profile Page Labels START-----
define("Toggle", 'Toggle Sidebar');
define("Welcome", 'Welcome');
define("Logout", 'Logout');
define("Hello", 'Hello');
define("YourProfile", 'Your Profile');
define("ContactInfo", 'Contact Information');
define("ChangePassword", 'Change Password');
define("ChangeProfilePic", 'Change Profile Picture');
define("AboutMe", 'About Me');
define("AgreementAcceptDate", 'Agreement Accepted On');
define("General", 'General');
define("Male", 'Male');
define("FeMale", 'Female');
define("ContactLabel", 'Contact');
define("Address1", 'Address Line 1');
define("Address2", 'Address Line 2');
define("SelectCountry", 'Select Country');
define("SelectState", 'Select State');
define("SelectCity", 'Select City');
define("CurrentPassword", 'Current Password');
define("NewPassword", 'New Password');
define("ConfirmNewPassword", 'Confirm New Password');
//Profile Page Labels END-----
//Admin User Page Labels START-----
define("BasicDetails", 'Basic Details');
define("ContactDetails", 'Contact Details');
//Admin User Page Labels END-----
// Breadcrum Labels START---->
define("NoRecordAlert", 'No Record Found!!');
define("UserMaster", 'User Masters');
define("LocationMaster", 'Location Masters');
define("CMSManagement", 'CMS Management');
define("AdminUser", 'Administrator Users');
define("Countries", 'Countries');
define("States", 'States');
define("Cities", 'Cities');
define("RightClickSpellCheck", 'For Spell Check Press CLTR + Right Click To find right Suggestion');
// Breadcrum Labels END---->
// AjaxRequest Messages Labels START---->
define("LoginSuccessful", 'Login Successful');
define("AccountNotActive", 'Account not activated yet');
define("PasswordWrong", 'Password entered is wrong');
define("NoUserExist", 'No user exist with this details');
define("DataSaveSuccessfully", 'Data saved successfully');
define("DataUpdateSuccessfully", 'Data updated successfully');
define("AddressSaveSuccessfully", 'Address saved successfully');
define("ProfileSaveSuccessfully", 'Profile saved successfully');
define("SomethingWentWrong", 'Something went wrong! Please try again');
define("SessionExpired", 'Session Expired! Please login and try again');
define("PleaseCheckMail", 'Please check your email.!');
define("PasswordNotMatch", 'Password not matching');
define("PasswordMustHaveAlpha", 'Password must be alphabet & number');
define("PasswordLengthVali", 'Please enter password between 8-16 characters');
define("PasswordFieldRequired", 'Please enter password field');
define("AccountCreated", 'Account Created Successfully');
define("RegisterEmailTitle", 'Book Store Registration');
define("Success", 'Success');
define("Deleted", 'Deleted');
define("StatusChanged", 'Status Changed');
define("EntryAlreadyExist", 'Entry Already Exist');
// AjaxRequest Messages Labels END---->
//Labels to use in Function.js START---->
define("InvalidEmail", '<strong>Sorry...!</strong> Invalid email address');
define("UnmPwdRequired", '<strong>Sorry...!</strong> Username/Password/Language fields are required');

define("InvalidEmail", '<strong>Oops...!</strong> Invalid Email Address');
define("AllFreidRequired", '<strong>Sorry...!</strong> All Fields are required');
define("Send", 'Send');
define("Location", 'Location');
//Labels to use in Function.js END---->
//
define("BookTitle", 'Book Title');
define("BookPrice", 'Book Price');
define("BookCode", 'Book Code');
define("BookEdition", 'Book Edition');
define("BookAutherName", 'Book Auther Name');
define("BookPublisher", 'Book Publisher');
define("BookDescription", 'Book Description');
define("BookImage", 'Book Image');
define("BookQuantity", 'Book Quantity');
//
//Labels to use in Client_Master START---->
define("OrganizationInformation", 'Organization Information');
define("OrganizationName", 'Organization Name');
define("Organization", 'Organization');
define("BussinesPhone", 'Bussines Phone');
define("TollFree", 'Toll Free');
define("TollFreeFax", 'Toll Free Fax Number');
define("FaxNo", 'Fax No');
define("Website", 'Website');
define("BusinessPhone", 'Business Phone');
define("Details", 'Details');
define("ClientCategory", 'Client Category');
define("ClientCode", 'Client Code');
define("ContactName", 'Contact Name');
define("Departmen", 'Departmen');
define("JobTitle", 'Job Title');
define("ExentionNumber", 'Extension Number');
define("MobileNo", 'Mobile no.');
define("PhoneNo", 'Phone No.');
define("PhoneNo", 'Phone No.');
define("Department", 'Department');
define("DirectLine", 'Direct Line');
define("Password", 'Password');
define("UserName", 'User Name');
define("BookSellerName", 'Book Seller Name');
define("LoginInformation", 'Login Information');
define("SelectClientCategory", 'Select Client Category');
define("ClientContacts", 'Client Contact List');
define("BillingInformation", 'Billing Information');
define('SaveCity','Add City');
define('AddNewCityIntoCityMaster','Add New City Into City Master');
//Labels to use in Client_Master END---->
//Alert Messages Start
define("NullSearchCriteriaAlert", 'Please Fill Search Criteria');
define("UserNameCannotNull", 'UserName cannot have Null value');
define("UserNameCannotHaveSpace", 'UserName cannot have spaces!');
define("PassWordCannotHaveSpace", 'PassWord cannot have spaces!');
define("PassWordValidation", 'Password Must Be Greater Then Or equal to 3 Charactors!');
define("WebsiteValidation", 'Website Should Be Like: -> www.example.com');
define("ArrayValueUnique", 'Values Should be Unique');
define("ClientFileSection", 'Client File Section');
define("ValueCannotHaveSpace", 'Value cannot have NULL or spaces!');
define("LocationDeleteEntryWarning", 'Cannot Delete value because it is in use!');
define("EntryDeleted", 'Entry Deleted Successfully');
define("LocationUpdateEntryWarning", 'Cannot De-activate value because it is in use!');
define("ADDNEWCOUNTRY", 'Add New Country');
define("ADDNEWSTATE", 'Add New State');
define("ADDNEWCITY", 'Add New City');

define("ContactFileSection", 'Client File Section');
//Alert Messages End
// Menu Rights START
define("Menu_Management", 'Menu Management');
define("user_roles", 'User Roles');
define("UserRole", 'User Role');
define("Menus", 'Menu List');
define("Close", 'Close');
define("ADDNEWUSERTYPE", 'Add New Role');
define("ViewUserRoles", 'View All User Roles');

define("ADDNEWMENURIGHTS", 'Add New Menu Rights');
// Menu Rights END
// POPUP TITLES

define('CreateSupplierTag', 'Create Supplier Tag');
define('EditSupplierTag', 'Edit Supplier Tag');
define('AddNewSupplierTag', 'Add New Supplier Tag');
define('ViewAllSupplierTag', 'View All Supplier Tag');

define('EditContact', 'Edit Contact');
define('CreateContact', 'Create Contact');
define('AddNewClient', 'Add New Client');

define('EditClientCategory', 'Edit Client Category');
define('CreateClientCategory', 'Create Client Category');
define('AddNewClientCategory', 'Add New Client Category');
define('ViewAllClientCategory', 'View All Client Category');

define('EditEventSiteCategory', 'Edit Event Site Category');
define('CreateEventSiteCategory', 'Create Event Site Category');
define('AddNewEventSiteCategory', 'Add New Event Site Category');
define('ViewAllEventSiteCategory', 'View All Event Site Category');

define('EditCountry', 'Edit Country');
define('CreateCountry', 'Create Country');
define('ViewAllCountry', 'View All Country');

define('EditState', 'Edit State');
define('CreateState', 'Create State');
define('ViewAllState', 'View All State');

define('EditCity', 'Edit City');
define('CreateCity', 'Create City');
define('ViewAllCity', 'View All City');

define('AddNewSlider', 'Add New Slider');
define('ViewNewSlider', 'View All Slider');

define('AddNewFAQ', 'Add New FAQ');
define('ViewNewFAQ', 'View All FAQ');

define('AddNewAgreement', 'Add New Agreement');
define('ViewAllAgreement', 'View All Agreement');

define('Contacts', 'Contacts');
define('Archives', 'Archives');

define('OverView', 'OverView');
define('SharedData', 'Shared Data');
define('Docs', 'Docs');
define('view', 'View');
define('delete', 'Delete');
define('ChangeStatus', 'Change Status');
define('UploadFiles', 'Upload Files');
define('AddContact', 'Add Contact');
define('ViewAllMenuRights', 'View All Menu Rights');



// Change PassWord Messages
define('PassWordChanged', 'Password changed successfully');
define('PasswordNotMatchOrEmpty', 'New password & Confirm password must be same and not empty');
define('PassWordNotValid', 'Current password not valid');
define('ValuesInCurrect', 'Sorry! Please enter correct values');


define('HomePhone','Home Phone');
define('Notes','Notes');
define('SpouseHusband','Spouse, Husband');
define('Kids','Kids');
define('PersonalInformation','Personal Information');



define('EventSite','Event Site');
define('Amenities','Amenities');
define('BeddingConfiguration','Bedding Configuration');
define('MeetingRoom','Meeting Room');
define('MeetingRoomCombination','Meeting Room Combination ');
define('AllMeetingRoomDetails','All Meeting Room Details ');
define('DocumentCenter','Document Center');






// Terms Of Payment Master START-----

define('terms_of_payment_master','Terms Of Payment');
define('EditTermsOfPayment', 'Edit Terms Of Payment');
define('CreateTermsOfPayment', 'Create Terms Of Payment');
define('AddNewTermsOfPayment', 'Add New Terms Of Payment');
define('ViewAllTermsOfPayment', 'View All Terms Of Payment');
define('TermsOfPaymentName','Terms Of Payment Name');

// Terms Of Payment Master START-----
 
 
// Product Receive From Repair START-----
define('product_receive_repair_master','Product Receive From Repair Master');
define('ReturnDate','Return Date');
define('ReceivedRemarks','Received Remarks');
define('ItemReceived','Item Received');
// Product Receive From Repair START-----


// Changes In Product And Stock Master ON 07-11-2016 START

define('CustomCase','Custom Case');
define('ProductCode','Product Code');
define('ModelNumber','Model Number');
define('SerialNumber','Serial Number');
define('Height','Height');
define('Width','Width');
define('Depth','Depth');
define('Weight','Weight');
define('SupplierName','Supplier Name');
define('SelectSupplierName','Select Supplier Name');
define('InvoiceFile','Invoice File');
define('ProductCost','Product Cost');
define('DimensionsWithCase','Dimensions With Case');
define('DimensionsWithoutCase','Dimensions Without Case');

// Notes Master in Dashboard

define('AddNotes','Add Notes');
define('AddNote','Add Note');
define('PageName','Page Name');
define('User','User');
define('SelectUser','Select User');
define('Note','Note');
define('ClickToAddNote','Click To Add Note');
define('ClickToViewNote','Click To View Note');
define('ViewNotes','View Notes');
define('EntryDate','Entry Date');
define('EntryTime','Entry Time');
define('ClikToMarkSolve','Click To Mark Solve');
define('Solve','Solve');
define('status','Status');


// Add New City AND State Validation.
define('AddNewCityValidation','Please select country and state and enter city name to add city.');
define('AddNewStateValidation','Please select country and enter state name to add state.');

define('MarkAsReceive','Mark as receive');
define('SaveNewEventCategoryNullValidation','Please enter Event category name to add new category');
define('SaveContinue','Save & Continue');
define('ViewAboutUs','View AboutUs');
define('AddNewAboutUs','Add New AboutUs');
define('ViewReturnPolicy','View Return Policy');
define('AddNewReturnPolicy','Add New Return Policy');
define('ViewContact','View Contact');
define('AddNewContact','Add New Contact');
define('ViewAllPrivacyPolicy','View Privacy Policy');
define('AddNewPrivacyPolicy','Add New Privacy Policy');
define('EmailValidationAlertMsg','Invalid Email ID');
define('NumberValidation','Only Numbers Allow');
define('BackToDashboard','Back To Home');
define('ErrorInsertingValuesshouldunique','Error Inserting Value, Values should be unique');
define('DateDiffValidation','Expected return date should be greater then or equal to issue date');
define('Approve','Approve');
define('ClickToMarkApprove','Click to mark Approve');
define('Approved','Approved');
define('SelectStatus','Select Status');

// Product Trash Master
define('product_trash','Product Trash');
define('TrashEntryDate','Trash Entry Date');
define('TrashNote','Trash Note');
define('ItemsSentToTrash','Items Sent To Trash');
define('ProductDetailsForTrash','Product Details For Trash');


// Product Sold Master
define('product_sold','Product Sold');
define('SoldEntryDate','Sold Entry Date');
define('SoldRemarks','Sold Remarks');
define('ItemsSold','Items Sold');
define('ProductDetailsToSold','Product Details To Sold');
define('SoldPrice','Sold Price');
define('SoldTo','Sold To');
// Client Master Chages:
define('OrganizationEmail','Organization Email');
define('RoomCombinationDetails','Room Combination Details');
define('RoomConfiguration','Room Configuration');
define('CombinedConfiguration','Combined Configuration');



// Client Master Changes START
define('ClientOverview','Client Overview');
define('Office','Office');
define('Accounting','Accounting');
define('Contacts','Contacts');
define('GeneralInfo','General Info');
define('DASHBOARD','DASHBOARD');
define('Balance','Balance');
define('ClientsMasterDatabase','Clients Master Database');
define('DashboardFor','Dashboard for :');
// Client Master Changes END
 

// Inventory Master START
define('inventory','Inventory Management');
define('StockDetails','Stock Details');
define('ProductWithInventoryList','Product With Inventory List');
// Inventory Master END

//Quotation Master START
define('Quotation','Quotation Management');
define('SelectClient','Select Client');
define('SelectEventSite','Select Event Site');
define('SelectDate','Select Date');
define('SelectTime','Select Time');
define('ClickToAdd','Click To Add');
//Quotation Master END


define('StockDetails','Stock Details');
define('Total','Total');
define('Repair','Repair');
define('Allocated','Allocated');
define('Available','Available');
define('EnterQty','Enter Qty');
//EMAIL FORMATE START
$header = '';
$header .= '<!DOCTYPE html>';
$header .= '<html>';
$header .= '<head>';
$header .= '<meta charset="UTF-8">';
$header .= '<title>iZone</title>';
$header .= '</head>';
$header .= '<body>';
$header .= '<div id=":1re" class="a3s" style="overflow: hidden;"><u></u>';
$header .= '<div style="width:100%;min-height:100%;padding:0;background-color:#ffffff;font-family:Arial,Tahoma,Verdana,sans-serif;font-weight:299px;font-size:13px;text-align:center" bgcolor="#ffffff">';
$header .= '<table style="max-width:810px;border-left:solid 1px #104A9C;border-right:solid 1px #104A9C; border-top:solid 1px #104A9C;" width="100%" cellpadding="0" cellspacing="0">';
$header .= '<tbody>';
$header .= '<tr>';
$header .= '<td style="width:10px;background-color:#EBEBEB" width="10" bgcolor="#D4D1D1">&nbsp;</td>';
$header .= '<td style="background-color:#EBEBEB;padding:0;margin:0" align="left" valign="middle" height="50" bgcolor="#D4D1D1">';
$header .= '<a style="text-decoration:none;outline:none;color:#ffffff;font-size:13px" href="http://sighteat.com/BookStore/" target="_blank">';
$header .= '<img class="CToWUd" src="http://sighteat.com/BookStore/admin/images/izonepms.png" alt="iZone.com" style="border:none" height="45" border="0">';
$header .= '</a>';
$header .= '</td>';
$header .= '<td style="width:10px;background-color:#EBEBEB" width="10" bgcolor="#D4D1D1">&nbsp;</td>';
$header .= '</tr>';
$header .= '</tbody>';
$header .= '</table>';
//EMAIL Body Start
$BodyStart = '';
$BodyStart .= '<table style="max-width:810px;border-left:solid 1px #104A9C;border-right:solid 1px #104A9C" width="100%" cellpadding="0" cellspacing="0">';
$BodyStart .= '<tbody><tr>';
$BodyStart .= '<td style="color:#2c2c2c;line-height:20px;font-weight:300;margin:0 auto;clear:both;background-color:#ffffff;padding:20px 20px 0 20px" align="left" valign="top" bgcolor="#ffffff">';
$BodyStart .= '<p style="padding:0;margin:0;color:#565656;font-size:13px">';
//EMAIL Body Ends
$BodyEnd .= '</p>';
$BodyEnd .= '</td>';
$BodyEnd .= '</tr>';
$BodyEnd .= '<tr>';
$BodyEnd .= '<td style="color:#2c2c2c;line-height:20px;font-weight:300;margin:0;clear:both;background-color:#fff;padding:10px 20px 0 20px;font-size:13px" align="center" valign="top" bgcolor="#F9F9F9">';
$BodyEnd .= '</td>';
$BodyEnd .= '</tr>';
$BodyEnd .= '</tbody>';
$BodyEnd .= '</table>';
//EMAIL Footer 
$footer = '';
$footer .= '<table style="max-width:810px;border-left:solid 1px #104A9C;border-right:solid 1px #104A9C;border-bottom:solid 1px #104A9C" width="100%" cellpadding="0" cellspacing="0">';
$footer .= '<tbody>';
$footer .= '<tr>';
$footer .= '<td style="text-align:left;background-color:#104A9C;display:block;margin:0 auto;clear:both;padding:5px 20px" valign="top" bgcolor="">';
$footer .= '<p style="padding:0;margin:0 0 4px 0;font-size:12px;color:#fff"><b>DISCLAIMER</b></p>';
$footer .= '<p style="padding:0;margin:0;font-size:9px;color:#fff;line-height:15px">';
$footer .= 'The information transmitted is intended only for the person or entity to which it is addressed and may contain confidential and/or privileged material which is the intellectual property of iZone. If you are not the intended recipient, or the employee, or agent responsible for delivering the message to the intended recipient and/or if you have received this in error, please contact the iZone or delete the material from the computer or device.';
$footer .= '</p>';
$footer .= '</td>';
$footer .= '</tr>';
$footer .= '<tr>';
$footer .= '<td style="text-align:center;background-color:#EBEBEB;display:block;margin:0 auto;clear:both;padding:5px 20px" align="center" valign="top" bgcolor="">';
$footer .= '<p style="padding:0;margin:0 0 4px 0">';
$footer .= '<a title="iZone.com" style="text-decoration:none;color:#104a9c" href="http://sighteat.com/BookStore/" target="_blank"><span style="color:#104a9c;font-size:13px">iZone.com</span></a>';
$footer .= '</p>';
$footer .= '<p style="padding:10px 0 0 0;margin:0;border-top:solid 1px #104A9C;font-size:11px;color:#565656">';
$footer .= '</p>';
$footer .= '</td>';
$footer .= '</tr>';
$footer .= '<tr>';
$footer .= '</tbody></table>';
$footer .= '</td>';
$footer .= '</tr>';
$footer .= '</tbody>';
$footer .= '</table>';
define('MAIL_HEADER', $header);
define('BODY_START', $BodyStart);
define('BODY_FOOTER', $BodyEnd);
define('MAIL_FOOTER', $footer);

//EMAIL FORMATE END