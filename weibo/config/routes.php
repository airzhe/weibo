<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
$route['u/10000'] = "home";
$route['default_controller'] = "index";
$route['404_override'] = '';
// index页分页路由
$route['^page$'] = "index";
$route['^page/(\d+)$'] = "index/index/page/$1";

// home页路由
$route['^u/(\d+)$'] = "u/index/$1";
#分页路由
$route['^u/(\d+)/p/(\d+)$'] = "u/index/$1/p/$2";
$route['^airzhe/p/(\d+)$'] = "u/index/10000/p/$1";

#个性域名路由
$route['^home$'] = "u/index/10000";
$route['^airzhe$'] = "u/index/10000";
$route['^canglaoshi$'] = "u/index/10005";
$route['^minmin$'] = "u/index/10004";



// $route['(:any)'] = "welcome/$1";

/* End of file routes.php */
/* Location: ./application/config/routes.php */