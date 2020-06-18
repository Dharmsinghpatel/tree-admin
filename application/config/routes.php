<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
|	$route['default_controller'] = 'home';
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

$route['default_controller'] = 'documents';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['assets/js/(:any)'] = 'Assets/js/$1';

// document routes
$route['documents/list-documents'] = 'documents/list_documents';
$route['documents/list-documents/(:any)'] = 'documents/list_documents/$1';
$route['documents/get-documents'] = 'documents/get_documents';
$route['documents/get-documents/(:any)'] = 'documents/get_documents/$1';
$route['documents/add-documents'] = 'documents/add_documents';
$route['documents/add-documents/(:any)'] = 'documents/add_documents/$1';
$route['documents/delete-document/(:num)'] = 'documents/delete_document/$1';
$route['documents/delete-document/(:num)/(:any)'] = 'documents/delete_document/$1/$2';

//resource routes
$route['resources/get-resources'] = 'resources/get_resources';
$route['resources/add-resource'] = 'resources/add_resource';
$route['resources/get-resource'] = 'resources/get_resource';
$route['resources/add-resource/(:any)'] = 'resources/add_resource/$1';
$route['resources/list-resources'] = 'resources/list_resources';
$route['resources/delete-resource/(:any)'] = 'resources/delete_resource/$1';
$route['resources/get-resource-content'] = 'resources/get_resource_content';

//charts routes
$route['charts'] = 'charts';

//carousel routes
$route['carousel/list-carousel/(:num)'] = 'carousel/list_carousel/$1';
$route['carousel/add-carousel/(:num)'] = 'carousel/add_carousel/$1';
$route['carousel/add-carousel/(:num/(:num))'] = 'carousel/add_carousel/$1/$2';
$route['carousel/get-carousel/(:num)'] = 'carousel/get_carousel/$1';
$route['carousel/delete-carousel/(:num)'] = 'carousel/delete_carousel/$1';

//auth routes
$route['profile'] = 'auth/add_profile';
$route['login'] = 'auth/login';
$route['login/(:any)'] = 'auth/login/$1';
$route['email'] = 'auth/list_email';
$route['auth/get-email'] = 'auth/get_email';
$route['email/(:num)'] = 'auth/email';
$route['show-email/(:num)'] = 'auth/show_email/$1';
$route['delete-email/(:num)'] = 'auth/delete_email/$1';


//setting
$route['setting'] = 'setting/setting';
