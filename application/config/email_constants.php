<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* -------------MAIL Content Constants ----> */

// mail subject
define('FORGOT_PASSWORD_SUB', 'Reset Your %s Password');
define('CHANGE_PASSWORD_SUB', 'Change Your %s Password');
define('WELCOME_SUB', 'Welcome to %s');
define('TICKET_CREATE_SUB', 'Ticket Created ');
define('TICKET_ASSIGN_SUB', 'Ticket Assign ');
define('TICKET_COMMENT_SUB', 'Ticket Comment ');
define('TICKET_CHANGE_SUB', 'Ticket Status Changed ');
define('TICKET_SOLVED_SUB', 'Ticket Sloved');
define('TICKET_CLOSED_SUB', 'Ticket Closed');
define('TICKET_REOPEN_SUB', 'Ticket Reopen Request');

// mail content
define('FORGOT_EMAIL', '');
define('EMPLOYEE_SIGNUP','<b> Hi, %s!</b><br>Thanks for  joining our organisation!. We re happy to have you join us and hope you enjoy You can login with following credentials:<br><br><b> Email: </b><u>%s</u> <br> <b>Password:</b> <u>%s </u>');

define('EMAILHEADING','Welcome to %s');

define('FORGET_PASSWORD','<b>Dear, %s! </b><br>There was recently a request to change the password for your account.<br>if you requested this password change, please click Reset Now Botton.<br>');

define('CUSTOMER_SIGNUP','<b>Dear, %s! </b><br>Thanks for  joining our organisation!. We re happy to have you join us and hope you enjoy, your username is <u>%s</u>. <br> <small>for create your password please click following Create Password Botton.</small><br>');

define('CUSTOMER_SIGNUP_OUT','<b> Hi, %s!</b><br> Thanks for  joining our organisation!. We re happy to have you join us and hope you enjoy You can login with following credentials:<br><br> <b>Email:</b> <u> %s </u><br> <b>Password:</b> <u>%s</u>');

define('CUSTOMER_TICKET_CREATION','<b>Dear, %s! </b><br>Your ticket was successfully created, your ticket number is %s.<br>for view ticket please click ticket view button.<br><br><br> ');

define('ADMIN_TICKET_CREATION','Ticket was successfully created by %s , ticket number is %s.<br>for view ticket please click ticket view button.<br><br><br>');

define('TICKET_ASSIGN','<span>%s</span><b>&nbsp;&nbsp;%s(%s)</b>,%s<br>%s<br><small>assigned to you <b>%s</b> at %s</small><br><br>');

define('TICKET_COMMENT_CREATION','%s,commented on Ticket <b>%s</b><br> %s.<input type="hidden" name="ticket_number" value="%s"><br><br>for view ticket please click ticket view button.<br><br><br> ');

define('TICKET_SOLVED_STATUS','<span>%s</span>&nbsp;Your Ticket %s has been solved at <small>%s</small> <br>You have a 48 hour to reopen this ticket.<br> for view ticket please click ticket view button.<br><br><br>');

define('TICKET_CHANGE_STATUS','<span>%s</span>&nbsp;Your Ticket %s has been changed to %s at <small>%s</small>.<br> for view ticket please click ticket view button.<br><br><br>');

define('TICKET_CLOSED_STATUS','<span>%s</span>&nbsp;Your Ticket %s has been successfully closed at <small>%s</small> <br>for view ticket please click ticket view button.<br><br><br>');;

define('TICKET_REOPEN','<span>%s</span>&nbsp;Your Ticket %s has been successfully reopen at <small>%s</small> <br>for view ticket please click ticket view button.<br><br><br>');
define('TICKET_ASIGNEE_REOPEN','<span>%s</span>&nbsp;Ticket %s has been Reopen at <small>%s</small> <br>for view ticket please click ticket view button.<br><br><br>');
?>