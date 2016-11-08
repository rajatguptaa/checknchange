<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	http://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There area two reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router what URI segments to use if those provided
  | in the URL cannot be matched to a valid route.
  |
 */

$route['default_controller'] = 'authController/index';
$route['404_override'] = '';


// Amc Controller Action
$route['amc'] = 'amcController/index';
$route['amc/add'] = 'amcController/createamc';
$route['amc/edit/(:num)'] = 'amcController/editamc/$1';
$route['amc/delete/(:num)'] = 'amcController/amcOrganisation/$1';
$route['amc/show/(:num)'] = 'amcController/showAmc/$1';



//login route
//$route['login'] = 'authController/index';
$route['login'] = 'authController/index';
$route['forget_password'] = 'authController/forget_password';
$route['signup'] = 'authController/signup';
$route['reset_password/(:any)'] = 'authController/reset_password/$1';
$route['create_password/(:any)'] = 'authController/create_password/$1';
$route['update_password'] = 'authController/update_password';
$route['dashboard'] = 'dashboardController/index';
$route['customer'] = 'customerController/index';
$route['comment'] = 'commentController/index';
$route['report'] = 'reportController/index';

// Employee Controller Action
$route['employee'] = 'employeeController/index';
$route['employee/(:num)'] = 'employeeController/index/$1';
$route['employee/add'] = 'employeeController/createEmployee';
$route['employee/show/(:num)'] = 'employeeController/showEmployee/$1';
$route['employee/edit/(:num)'] = 'employeeController/editEmployee/$1';
$route['employee/delete/(:num)'] = 'employeeController/deleteEmployee/$1';
$route['employee/empTicket/(:num)/(:num)'] = 'employeeController/getEmployeeTicket/$1/$2';
$route['employee/ticketAttachment/(:num)'] = 'employeeController/getTicketattachment/$1';


// Customer Controller Action
$route['customer'] = 'customerController/index';
//$route['customer/(:num)'] = 'customerController/index/$1';
$route['customer/add'] = 'customerController/createCustomer';
$route['customer/show/(:num)'] = 'customerController/showCustomer/$1';
$route['customer/edit/(:num)'] = 'customerController/editCustomer/$1';
$route['customer/delete/(:num)/(:num)'] = 'customerController/deleteCustomer/$1/$2';
$route['customer/unapproved'] = 'customerController/index/$1';
$route['customer/approve/(:num)'] = 'customerController/approveCustomer/$1';
$route['customer/approve/all'] = 'customerController/approveAll';
$route['customer/approve/selected'] = 'customerController/approveSelected';
$route['customer/empTicket/(:num)/(:num)'] = 'customerController/getEmployeeTicket/$1/$2';
// Organisation Controller Action
$route['organisation'] = 'organisationController/index';
$route['organisation/add'] = 'organisationController/createOrganisation';
$route['organisation/edit/(:num)'] = 'organisationController/editOrganisation/$1';
$route['organisation/delete/(:num)'] = 'organisationController/deleteOrganisation/$1';


// Amc Controller Action
$route['amc'] = 'amcController/index';
$route['amc/add'] = 'amcController/createAmc';
$route['amc/edit/(:num)'] = 'amcController/editAmc/$1';
$route['amc/delete/(:num)'] = 'amcController/deleteAmc/$1';


// Access Controller Action
$route['access'] = 'accessController/index';


// Setting Controller Actions
$route['setting'] = 'settingController/index';

// Ticket Controller Actions
$route['request'] = 'ticketController/index';
$route['request/detail'] = 'ticketController/getCustomerIndex';
$route['request/customer/add'] = 'ticketController/createCustomerTicket';
$route['request/customer/edit/(:num)'] = 'ticketController/editCustomerTicket/$1';
$route['request/customer/reopen/(:num)'] = 'ticketController/reopenTicket/$1';
$route['request/ticket/view/(:num)'] = 'ticketController/showTicket/$1';
$route['request/employee/add/(:num)'] = 'ticketController/createEmployeeTicket/$1';
//$route['request/employee/assign/(:num)/(:num)'] = 'ticketController/assignTicket/$1/$2';
$route['request/backlogData/(:num)/(:num)'] = 'ticketController/getBacklogData/$1/$2';
$route['request/toDoData/(:num)/(:num)'] = 'ticketController/getToDoData/$1/$2';
$route['request/doingData/(:num)/(:num)'] = 'ticketController/getDoingData/$1/$2';
$route['request/doneData/(:num)/(:num)'] = 'ticketController/getDoneData/$1/$2';
$route['request/changeTicketStatus'] = 'ticketController/changeTicketStatus';
$route['request/ticketDetail/(:num)'] = 'ticketController/getTicketDetail/$1';
$route['request/changePriority'] = 'ticketController/changePriority';
$route['request/ticketview/(:num)'] = 'ticketController/getTicketView/$1';
$route['request/employee/ticket/grid/(:num)'] = 'ticketController/getEmployeeGridView/$1';
$route['request/ticket_table/(:num)/(:num)/(:num)'] = 'ticketController/ticketTableView/$1/$2/$3';
$route['request/feedback/(:num)/(:num)'] = 'ticketController/feedback/$1/$2';


//Comment Controller...
$route['comment/addComment'] = 'commentController/createComment';


// Report Module

$route['report'] = 'reportController/index';
$route['report/(:num)'] = 'reportController/create/$1';


//Support Controller
$route['support'] = 'supportController/index';
$route['support/add'] = 'supportController/createSupport';
$route['support/addforum/(:num)/(:num)'] = 'supportController/forumcreateSupport/$1/$2';
$route['support/categoryForum'] = 'supportController/categoryForum';
$route['support/viewForum/(:num)'] = 'supportController/viewForum/$1';
$route['support/forumEntries/(:num)'] = 'supportController/forumEntries/$1';
$route['support/postview/(:num)'] = 'supportController/forumarticlepostview/$1';
$route['support/forumcategoryview/(:num)'] = 'supportController/forumcategoryview/$1';
$route['support/editcategory/(:num)'] = 'supportController/editcategory/$1';
$route['support/deletecateogry/(:num)'] = 'supportController/deletecateogry/$1';
$route['support/editsupportforum/(:num)'] = 'supportController/editsupportforum/$1';
$route['support/deletesupportforum/(:num)'] = 'supportController/deletesupportforum/$1';
$route['support/editpost/(:num)'] = 'supportController/editsupportforumpost/$1';
$route['support/deleteforumpost/(:num)/(:num)'] = 'supportController/deleteforumpost/$1/$2';
$route['support/comment'] = 'supportController/comment';
$route['support/addComment'] = 'supportController/createComment';
$route['support/recentpost'] = 'supportController/recentpost';
$route['support/deletecomment'] = 'supportController/deletecomment';
$route['support/updateComment'] = 'supportController/updateComment';


//Dashboard controller
$route['dashboard/supportForum'] = 'dashboardController/supportForum';
$route['dashboard/unpinforumpost'] = 'dashboardController/unpinforumpost';


//service Controller
$route['service'] = 'serviceController/index';


//service Histroy

$route['history'] = 'historyController/index';

// archive 
$route['archive'] = 'archiveController/index';

/* End of file routes.php */
/* Location: ./application/config/routes.php */