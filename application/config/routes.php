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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'intro';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['news/(:num)/topic/(:any)'] = 'News/index/$1';
$route['cate/(:any)'] = 'CategoryNews/index/$1';
$route['page/(:any)'] = 'Page/index/$1';
$route['page/(:any)/(:any)/(:any)'] = 'Page/index/$1/$2/$3';
$route['page/(:any)/(:any)/(:any)/(:any)'] = 'Page/index/$1/$2/$3/$4';
$route['file/(:any)'] = 'PageFile/index/$1';
$route['file/(:any)/(:any)'] = 'PageFile/index/$1/$2';
$route['file/(:any)/(:any)/(:any)'] = 'PageFile/index/$1/$2/$3';
// poll
$route['poll/result'] = 'Poll/result';

// user
$route['forgotpassword'] = 'Login/forgotpassword';
$route['admin/logout'] = 'Login/logout';
$route['admin/user/new'] = 'AdminUser/create';
$route['admin/user/list'] = 'AdminUser/listData';

// category news
$route['admin/category/news'] = 'AdminCategoryNews/news';


// news
$route['admin/news/new'] = 'AdminNews/create';
$route['admin/news/edit/(:any)'] = 'AdminNews/edit/$1';
$route['admin/news/list'] = 'AdminNews/listData';
$route['admin/rss/list'] = 'AdminNews/listDataRss';
$route['admin/news/export'] = 'AdminNews/export';

// setting
$route['admin/setting/event'] = 'AdminSettingEvent/event';
$route['admin/setting/cover'] = 'AdminSettingCover/cover';
$route['admin/setting/slideimage'] = 'AdminSettingSlideImage/slideimage';
$route['admin/setting/general'] = 'AdminSettingGeneral/general';
$route['admin/setting/external/link'] = 'AdminSettingExternalLink/external_link';
$route['admin/setting/important/link'] = 'AdminSettingImportantLink/important';
$route['admin/setting/partner'] = 'AdminSettingPartner';
$route['admin/setting/special'] = 'AdminSettingSpecial';
// menu
$route['admin/menu/list'] = 'AdminMenu/listData';
$route['admin/menu/manage'] = 'AdminManageMenu/manage';
$route['admin/menu/head'] = 'AdminManageMenu/head';
$route['admin/submenu/manage'] = 'AdminManageMenu/submenu';
// mail
$route['admin/mail'] = 'AdminMail/index';
$route['admin/mail/manage'] = 'AdminMail/manage';
$route['admin/mail/sent'] = 'AdminMail/sent';
$route['admin/mail/rank'] = 'AdminMail/rank';
// page
$route['admin/page/manage'] = 'AdminManagePage/manage';
$route['admin/page/new'] = 'AdminManagePage/create';
$route['admin/page/list'] = 'AdminManagePage/listData';
$route['admin/page/edit/(:any)'] = 'AdminManagePage/edit/$1';
// folder
$route['admin/folder'] = 'AdminFolder';
$route['admin/folder/(:any)'] = 'AdminFolder/index/$1';
