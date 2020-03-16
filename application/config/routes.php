<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'users';
$route['register'] = 'auth/register';
$route['flussonic/(:any)'] = 'flussonic/index/$1';
$route['register/(:any)'] = 'auth/register_confirm/$1';
$route['rules'] = 'auth/rules';
$route['admin/rules'] = 'admin/rules';


$route['admin/settings'] = 'admin/settings';
$route['admin/mail'] = 'admin/mails';
$route['admin/mail/templates'] = 'admin/mail_templates';


$route['admin/messages/(:num)'] = 'admin/messages/$1';


$route['admin/fl/create'] = 'admin/fl_create';
$route['admin/fl/(:num)'] = 'admin/fl_edit/$1';

$route['admin/ch/create'] = 'admin/ch_create';
$route['admin/ch/(:num)'] = 'admin/ch_edit/$1';
$route['admin/ch/(:num)/sessions'] = 'admin/ch_sessions/$1';
$route['admin/ch/page/(:num)'] = 'admin/ch/$1';

$route['admin/news/create'] = 'admin/news_create';
$route['admin/news/(:num)'] = 'admin/news_edit/$1';
$route['admin/news/page/(:num)'] = 'admin/news/$1';

$route['admin/cat/create'] = 'admin/cat_create';
$route['admin/cat/page/(:num)'] = 'admin/cat/$1';
$route['admin/cat/(:num)'] = 'admin/cat_edit/$1';

$route['admin/tariffs/create'] = 'admin/tariff_create';
$route['admin/tariffs/page/(:num)'] = 'admin/tariff/$1';
$route['admin/tariffs/(:num)'] = 'admin/tariff_edit/$1';

$route['admin/users/(:num)'] = 'admin/users_edit/$1';
$route['admin/users/group'] = 'admin/users_group';
$route['admin/users/group/(:num)'] = 'admin/users_group_edit/$1';

$route['admin/billing/settings'] = 'admin/billing_settings';
$route['admin/billing/statistics'] = 'admin/billing_statistics';
$route['admin/billing/statistics/(:any)'] = 'admin/billing_statistics/$1';

$route['admin/billing/transactions'] = 'admin/billing_transactions';
$route['admin/billing/transactions/page/(:num)'] = 'admin/billing_transactions/$1';
$route['admin/billing/transactions/page'] = 'admin/billing_transactions';

$route['admin/billing/invoice'] = 'admin/billing_invoice';
$route['admin/billing/invoice/page/(:num)'] = 'admin/billing_invoice/$1';
$route['admin/billing/invoice/page'] = 'admin/billing_invoice';

$route['admin/billing/refund'] = 'admin/billing_refund';
$route['admin/billing/refund/page/(:num)'] = 'admin/billing_refund/$1';
$route['admin/billing/refund/page'] = 'admin/billing_refund';

$route['admin/billing/prcode'] = 'admin/billing_prcode';
$route['admin/billing/prcode/page/(:num)'] = 'admin/billing_prcode/$1';
$route['admin/billing/prcode/page'] = 'admin/billing_prcode';

$route['admin/billing/referrals'] = 'admin/billing_referrals';
$route['admin/billing/prcode/page/(:num)'] = 'admin/billing_referrals/$1';
$route['admin/billing/prcode/page'] = 'admin/billing_referrals';

$route['admin/billing/transfer'] = 'admin/billing_transfer';

$route['admin/billing/users'] = 'admin/billing_users';


$route['admin/ajax/fl/create'] = 'admin_ajax/fl_create';
$route['admin/ajax/fl/edit/(:num)'] = 'admin_ajax/fl_edit/$1';

$route['admin/ajax/ch/create'] = 'admin_ajax/ch_create';
$route['admin/ajax/ch/edit/(:num)'] = 'admin_ajax/ch_edit/$1';
$route['admin/ajax/ch/action'] = 'admin_ajax/ch_action';

$route['admin/ajax/news/create'] = 'admin_ajax/news_create';
$route['admin/ajax/news/edit/(:num)'] = 'admin_ajax/news_edit/$1';

$route['admin/ajax/cat/create'] = 'admin_ajax/cat_create';
$route['admin/ajax/cat/edit/(:num)'] = 'admin_ajax/cat_edit/$1';
$route['admin/ajax/cat/delete/(:num)'] = 'admin_ajax/cat_delete/$1';
$route['admin/ajax/cat/delete/(:num)/(:num)'] = 'admin_ajax/cat_delete/$1/$2';


$route['admin/ajax/tariffs/create'] = 'admin_ajax/tariff_create';
$route['admin/ajax/tariffs/edit/(:num)'] = 'admin_ajax/tariff_edit/$1';
$route['admin/ajax/tariffs/delete/(:num)'] = 'admin_ajax/tariff_delete/$1';
$route['admin/ajax/tariffs/delete/(:num)/(:num)'] = 'admin_ajax/tariff_delete/$1/$2';


$route['admin/ajax/users/group/edit/(:num)'] = 'admin_ajax/users_group_edit/$1';
$route['admin/ajax/billing/settings'] = 'admin_ajax/billing_settings';

$route['admin/ajax/billing/prcode/generate'] = 'admin_ajax/billing_prcode_generate';
$route['admin/ajax/billing/prcode/save'] = 'admin_ajax/billing_prcode_save';
$route['admin/ajax/billing/prcode/action'] = 'admin_ajax/billing_prcode_action';

$route['admin/ajax/billing/refund/save'] = 'admin_ajax/billing_refund_save';
$route['admin/ajax/billing/refund/action'] = 'admin_ajax/billing_refund_action';

$route['admin/ajax/mail/templates/save'] = 'admin_ajax/mail_templates_save';


$route['admin/ajax/billing/referrals/save'] = 'admin_ajax/billing_referrals_save';
$route['admin/ajax/billing/referrals/create'] = 'admin_ajax/billing_referrals_create';
$route['admin/ajax/billing/referrals/action'] = 'admin_ajax/billing_referrals_action';
$route['admin/ajax/billing/referrals/users/action'] = 'admin_ajax/billing_referrals_users_action';

$route['admin/ajax/billing/transfer/save'] = 'admin_ajax/billing_transfer_save';
$route['admin/ajax/billing/users/pay/users'] = 'admin_ajax/billing_users_pay_users';
$route['admin/ajax/billing/users/pay/group'] = 'admin_ajax/billing_users_pay_group';
$route['admin/ajax/users/edit'] = 'admin_ajax/users_edit';

$route['admin/ajax/ch/session/delete/(:num)/(:any)'] = 'admin_ajax/ch_session_delete/$1/$2';


$route['admin/ajax/users/session/delete'] = 'admin_ajax/users_session_delete';
$route['admin/ajax/users/session/delete/(:num)'] = 'admin_ajax/users_session_delete/$1';
$route['admin/ajax/users/session/delete/(:num)/(:any)'] = 'admin_ajax/users_session_delete/$1/$2';




$route['admin/ajax/settings/save'] = 'admin_ajax/settings_save';


$route['admin/ajax/send/(:num)/(:num)'] = 'admin_ajax/mails_send/$1/$2';  
$route['admin/ajax/rules/save'] = 'admin_ajax/rules_save';  


$route['messages/(:num)'] = 'messages/index/$1';
$route['admin/messages/(:num)'] = 'admin/messages/$1';
$route['admin/messages/chat-attachment/upload'] = 'messages/send_text_message';
$route['messages/(:num)/chat-attachment/upload'] = 'messages/send_text_message';
$route['messages/(:num)/send-message'] = 'messages/send_text_message';
$route['messages/(:num)/get-chat-history-vendor'] = 'messages/get_chat_history_by_vendor/$1';















$route['messages/(:num)'] = 'users/messages/$1';
$route['tariffs/(:num)'] = 'users/tariffs/$1';
$route['settings'] = 'users/settings';
$route['history'] = 'users/history';
$route['history/page/(:num)'] = 'users/history/$1';
$route['history/page'] = 'users/history';

















$route['(:num)'] = 'users/index/$1';
$route['messages'] = 'users/messages/';




$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;



