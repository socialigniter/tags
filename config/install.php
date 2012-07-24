<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:			Social Igniter : Tags : Install
* Author: 		Localhost
* 		  		hi@brennannovak.com
*          
* Project:		http://social-igniter.com/
*
* Description: 	Installer values for Tags for Social Igniter 
*/

/* Settings */
$config['tags_settings']['widgets']			= 'TRUE';
$config['tags_settings']['enabled']			= 'TRUE';

/* Tags Table */
$config['database_tags_tags_table'] = array(
'tag_id' => array(
	'type' 					=> 'INT',
	'constraint' 			=> 11,
	'unsigned' 				=> TRUE,
	'auto_increment'		=> TRUE
),
'tag' => array(
	'type' 					=> 'VARCHAR',
	'constraint' 			=> '128',
	'null'					=> TRUE
),
'tag_url' => array(
	'type' 					=> 'VARCHAR',
	'constraint' 			=> '128',
	'null'					=> TRUE
),
'created_at' => array(
	'type'					=> 'DATETIME',
	'default'				=> '9999-12-31 00:00:00'
));

/* Tags Link Table */
$config['database_tags_tags_link_table'] = array(
'tag_link_id' => array(
	'type' 					=> 'INT',
	'constraint' 			=> 11,
	'unsigned' 				=> TRUE,
	'auto_increment'		=> TRUE
),
'tag_id' => array(
	'type' 					=> 'INT',
	'constraint' 			=> '11',
	'null'					=> TRUE
),
'content_id' => array(
	'type' 					=> 'INT',
	'constraint' 			=> '11',
	'null'					=> TRUE
),
'created_at' => array(
	'type'					=> 'DATETIME',
	'default'				=> '9999-12-31 00:00:00'
));

/* Taxonomy Table */
$config['database_tags_taxonomy_table'] = array(
'taxonomy_id' => array(
	'type' 					=> 'INT',
	'constraint' 			=> 11,
	'unsigned' 				=> TRUE,
	'auto_increment'		=> TRUE
),
'object_id' => array(
	'type' 					=> 'INT',
	'constraint' 			=> '11',
	'null'					=> TRUE
),
'taxonomy' => array(
	'type' 					=> 'VARCHAR',
	'constraint' 			=> '32',
	'null'					=> TRUE
),
'count' => array(
	'type'					=> 'INT',
	'constraint'			=> 6,
	'null'					=> TRUE
));