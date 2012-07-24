<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:			Social Igniter : Tags : Routes
* Author: 		Localhost
* 		  		hi@brennannovak.com
*          
* Project:		http://social-igniter.com/
*
* Description: 	URI Routes for Tags for Social Igniter 
*/

$route['tags']									= 'tags';

$route['tags/settings/widgets']					= 'settings/widgets';
$route['tags/settings']							= 'settings/index';

$route['tags/api/(:any)/(:any)/(:any)/(:any)']	= 'api/$1/$2/$3/$4';
$route['tags/api/(:any)/(:any)/(:any)']			= 'api/$1/$2/$3';
$route['tags/api/(:any)/(:any)']				= 'api/$1/$2';
$route['tags/api/(:any)']						= 'api/$1';

$route['tags/(:any)/(:any)']					= 'tags/view';
$route['tags/(:any)']							= 'tags/view';
