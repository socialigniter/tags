<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:			Social Igniter : Tags : Widgets
* Author: 		Localhost
* 		  		hi@brennannovak.com
*          
* Project:		http://social-igniter.com/
*
* Description: 	Installer values for Tags for Social Igniter 
*/

$config['tags_widgets'][] = array(
	'regions'	=> array('sidebar', 'content', 'wide', 'leftbar', 'middle'),
	'widget'	=> array(
		'module'	=> 'tags',
		'name'		=> 'Tag Cloud',
		'method'	=> 'run',
		'path'		=> 'widgets_tag_cloud',
		'multiple'	=> 'FALSE',
		'order'		=> '1',
		'title'		=> 'Tags',
		'content'	=> ''
	)
);