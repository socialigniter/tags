<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:			Social Igniter : Tags : API Controller
* Author: 		Brennan Novak
* 		  		contact@social-igniter.com
* 
* Project:		http://social-igniter.com
* 
* Description: This file is for the Tags API Controller class
*/
class Api extends Oauth_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $this->load->config('tags/tags');
        $this->load->library('tags/tags_library');
	}

    /* Install App */
	function install_get()
	{
		// Load
		$this->load->library('installer');
		$this->load->config('install');
		$this->load->dbforge();

		// Create Database Tables
		$this->dbforge->add_key('tag_id', TRUE);
		$this->dbforge->add_field(config_item('database_tags_tags_table'));
		$this->dbforge->create_table('tags');

		$this->dbforge->add_key('tag_link_id', TRUE);
		$this->dbforge->add_field(config_item('database_tags_tags_link_table'));
		$this->dbforge->create_table('tags_link');

		$this->dbforge->add_key('taxonomy_id', TRUE);
		$this->dbforge->add_field(config_item('database_tags_taxonomy_table'));
		$this->dbforge->create_table('taxonomy');

		// Settings & Create Folders
		$settings = $this->installer->install_settings('tags', config_item('tags_settings'));

		if ($settings == TRUE)
		{
            $message = array('status' => 'success', 'message' => 'Yay, the Tags App was installed');
        }
        else
        {
            $message = array('status' => 'error', 'message' => 'Dang Tags App could not be installed');
        }		
		
		$this->response($message, 200);
	}

	/* App Calls */
    function all_get()
    {   
        if ($tags = $this->tags_library->get_tags())
        {
            $message = array('status' => 'success', 'message' => 'Found some tags', 'data' => $tags);
        }
        else
        {
            $message = array('status' => 'error', 'message' => 'Could not find any tags');
        }

        $this->response($message, 200);        
    }
    
    function create_authd_post()
    {
        if ($tags = $this->tags_library->process_tags($this->input->post('tags'), $this->input->post('content_id')))
        {
            $message = array('status' => 'success', 'message' => 'Created your tags', 'data' => $tags);
        }
        else
        {
            $message = array('status' => 'error', 'message' => 'Could not create tags');
        }
        
        $this->response($message, 200);    
    }
      

    function modify_authd_post()
    {
    	$tag = $this->tags_library->get_tag($this->get('id'));

		// Access Rules
	   	//$this->social_auth->has_access_to_modify($this->input->post('type'), $this->get('id') $this->oauth_user_id);

    	$viewed			= 'Y';
    	$approval		= 'A';

    	$tag_data = array(
			'tag'			=> $this->input->post('tag'),
			'tag_url'		=> form_title_url($this->input->post('tag'), $this->input->post('tag_url'), $tag->tag_url)
    	);

		// Insert
		$update = $this->tags_library->update_tag($this->get('id'), $tag_data);

	    if ($update)
	    {
        	$message = array('status' => 'success', 'message' => 'Awesome, we updated your '.$this->input->post('type'), 'data' => $update);
        }
        else
        {
	        $message = array('status' => 'error', 'message' => 'Oops, we were unable to post your '.$this->input->post('type'));
        }

	    $this->response($message, 200);
    }
    
    function destroy_authd_get()
    {  
    	// Determine delete
    	if ($this->get('tag_id'))
    	{
			$action = $this->tags_library->delete_tag($this->get('tag_id'));
    	}
    	elseif ($this->get('tag_link_id'))
    	{
			$action = $this->tags_library->delete_tag_link($this->get('tag_link_id'));
    	}
    	elseif ($this->get('object_id'))
    	{
			$action = $this->tags_library->delete_tag_link_object($this->get('object_id'));    	
    	}
    	else
    	{
    		$action = FALSE;
    	}
    
    	// Perform delete
    	if ($action)
    	{
    		$message = array('status' => 'success', 'message' => 'Tag deleted');
    	}
    	else
    	{
    		$message = array('status' => 'error', 'message' => 'Tag was not deleted');        	
    	}
        
        $this->response($message, 200);
    }  
    
}