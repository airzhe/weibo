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
$route['^home$'] = "u/index/";
$route['default_controller'] = "index";
$route['404_override'] = '';

#用户页面
$route['^u/(\d+)$'] = "u/index/$1";
#用户昵称重定向
$route['^n/(:any)'] = "n/index/$1";
#单条微博重定向
$route['^(\d{5,})/Ay(:any)'] = "u/weibo/$1/$2";
// $route['^weibo/(:any)'] = "u/weibo/1004$1";
// $route['^single_weibo/(:any)'] = "single_weibo/index/$1";
// $route['(:any)'] = "welcome/$1";

/* End of file routes.php */
/* Location: ./application/config/routes.php */