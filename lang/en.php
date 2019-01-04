<?php

/**
 * language: en
 * encoding: utf-8
 * author: Jan Štěch
 */

//page title
$lang['title'] = "Exam list";

//examdirectory.online/index.php
$lang['welcome1'] = "Welcome to examdirectory.online";
$lang['welcome2'] = "Click the button to proceed";
$lang['enter'] = "Enter";
$lang['news'] = "News";

//examdirectory.online/scripts/login.php
$lang['logIn'] = "Log in";
$lang['name'] = "Name";
$lang['pass'] = "Password";
$lang['newAccountText'] = "Don't have an account yet? Register ";
$lang['successfulLogin'] = "You were successfully logged in.";
$lang['passFailLogin'] = "Incorrect password";
$lang['nameFailLogin'] = "There is no user with this name registered.";
$lang['hereLink'] = "here";

//examdirectory.online/scripts/register.php
$lang['register'] = "Register";
$lang['repeatPass'] = "Repeat Password";
$lang['e-mail'] = "E-mail";
$lang['termsText'] = "I agree with the";
$lang['termsLink'] = "terms of service";
$lang['logInText'] = "Already having an account? Log in ";
$lang['successfulRegister'] = "You were successfully registered.";
$lang['termsFailRegister'] = "You have to accept our terms of service.";
$lang['shortNameFailRegister'] = "The name must be at least 4 characters long.";
$lang['longNameFailRegister'] = "The name mustn't be more than 16 characters long.";
$lang['duplicateNameFailRegister'] = "This name is already used by another user.";
$lang['shortPassFailRegister'] = "The password must be at leat 6 characters long.";
$lang['longPassFailRegister'] = "The password mustn't be more then 32 characters long.";
$lang['unequalPassFailRegister'] = "The passwords aren't equal.";
$lang['noDigitInPassFailRegister'] = "The password must contain at least one digit.";
$lang['noLowercaseInPassFailRegister'] = "The password must contain at least one lowercase letter.";
$lang['noUppercaseInPassFailRegister'] = "The password must contain at least one uppercase letter.";
$lang['invalidEmailFailRegister'] = "You have to enter your valid e-mail address.";
$lang['longEmailFailRegister'] = "Your e-mail mustn't be more than 64 characters long.";
$lang['duplicateEmailFailRegister'] = "This e-mail is already used by another user.";
$lang['unknownFailRegister'] = "An error occured. Repeat your attempt later or contact webmaster on e-mail address honza.stech@gmail.com.";

//header on pages requiring a logged user
$lang['headerText'] = "You are logged in as ";
$lang['logOut'] = "Log out";
$lang['info'] = "Information";
$lang['home'] = "Home";
$lang['class'] = "Class";
$lang['classManagement'] = "Class Management";

//examdirectory.online/scripts/home.php
$lang['homeHeader'] = "You are a member in these classes:";
$lang['notMemberInAnyClass'] = "You aren't member in any class.";
$lang['admin'] = "Administrator";
$lang['mod'] = "Moderator";
$lang['member'] = "Member";
$lang['apply'] = "Apply for admission to an existing class";
$lang['newClass'] = "Create a new class";

//examdirectory.online/scripts/list.php
$lang['noRecord'] = "No records";
$lang['date'] = "Date";
$lang['subject'] = "Subject";
$lang['desc'] = "Description";
$lang['author'] = "Added by";
$lang['dateOfAdding'] = "Added on";
$lang['action'] = "Action";
$lang['upvote'] = "Like";
$lang['edit'] = "Edit";
$lang['delete'] = "Delete";
$lang['newRecord'] = "Add a new record";
$lang['descPlaceholder'] = "Revision test";
$lang['priority'] = "Priority";
$lang['confirm'] = "Confirm";
$lang['cancel'] = "Cancel";

//examdirectory.online/scripts/apply.php
$lang['applyLore'] = "Choose the class you want to join and enter personal information as a hint for administrator or moderators of the class that will have to approve your application.";
$lang['meberInAll'] = "You are already a member in all existing classes.";
$lang['fName'] = "First name";
$lang['lName'] = "Last name";
$lang['applyPlaceholder'] = "Content of the application";
$lang['applyValue'] = "Hello. I would like to join your class. Would you please approve my application?";
$lang['applicationSend'] = "Send the application";
$lang['applyEmailSubject1'] = "A new application for admission into class";
$lang['applyEmailSubject2'] = "from";
$lang['applyEmailHeader'] = "Application details";
$lang['applyEmailLore1'] = "You can approve or reject this application on the class management website.";
$lang['applyEmailLore2'] = "Approve this application only in case you are sure about who this user actually is.";
$lang['EmailBottomLore'] = "This e-mail has been generated automatically and therefore do not answer it.";
$lang['applyEmailFooter1'] = "Don't want to get more e-mails from us? Unsubscribe";
$lang['applyEmailFooter2'] = "This will stop only automatically generated e-mails. If you send us your opinion, a question or a suggestion, you can still get manually written answer from the webmaster.";
$lang['applyAlertText'] = "Your application for admission to this class was send. You will find out about verdict of the admin or a moderator of the class on your e-mail.";

//examdirectory.online/scripts/newClass.php
$lang['newClassHeader'] = "Apply for creation a new class";
$lang['newClassLore1'] = "To avoid creating unnecessary and empty classes and filling a limited space in our database, you need to fill out this form to create a class.";
$lang['newClassLore2'] = "Further communication will occure via e-mail, so please make sure that you have entered the correct e-mail address.";
$lang['newClassLore3'] = "Creating a class is free just as any other feature.";
$lang['school'] = "School";
$lang['newClassPlaceholder'] = "Content of the application";
$lang['newClassAlertText'] = "Your application for creation of a new class was send. You will be contacted by webmaster on the e-mail address you specified.";

//examdirectory.online/scripts/classManagement.php
$lang['generalTab'] = "General";
$lang['subjectsTab'] = "Subjects management";
$lang['membersTab'] = "Members management";
$lang['applicationsTab'] = "Applications for admission";
$lang['classId'] = "ID of the class";
$lang['className'] = "Name of the class";
$lang['changeButton'] = "Change";
$lang['saveButton'] = "Save";
$lang['classStatus'] = "Status of the class";
$lang['openedClass'] = "Opened - applications for admission are turned on";
$lang['closedClass'] = "Closed - users can't apply for admission to the class";
$lang['openButton'] = "Open the class";
$lang['lockButton'] = "Lock the class";
$lang['classLockAlertText'] = "The class was locked. Do you want to reject and remove all pending applications for admission to the class?";
$lang['deleteClassPassword1'] = "It is necessary to verify you with your administrator password.";
$lang['deleteClassPassword2'] = "Type in your password and continue by clicking OK.";
$lang['deleteClassFinal1'] = "This action is irreversible. Your class will be pernamently deleted from the database.";
$lang['deleteClassFinal2'] = "You will be able to stop the process of deletion on this webpage during the next 24 hours.";
$lang['editSubjects'] = "Edit subjects";
$lang['nickname'] = "Nickname";
$lang['approve'] = "Approve";
$lang['reject'] = "Reject";
$lang['classManagementEmailSubject'] = "Application for admission into class ";
$lang['classManagementEmailSuccessLore1'] = "Congratulations, your application for admission into class ";
$lang['classManagementEmailFailLore1'] = "We are sorry, but your application for admission into class ";
$lang['classManagementEmailLore2'] = " has been ";
$lang['classManagementEmailSuccessLore3'] = "approved";
$lang['classManagementEmailFailLore3'] = "rejected";
$lang['classManagementEmailLore4'] = "Your application was processed by ";
$lang['classManagementEmailSuccessFooter1'] = "You can send more applications for admission into other classes on examdirectory.online.";
$lang['classManagementEmailFailFooter1'] = "You can send a new application for admission on examdirectory.online.";
$lang['classManagementEmailSuccessFooter2'] = "If you want to leave the class, you can do so on the webpage with list of classes.";
$lang['classManagementEmailFailFooter2'] = "If you want to apply for admission into the same class again, we recommend you to write a better content of the application.";
