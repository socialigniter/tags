<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:			Social Igniter : Tags : Controller
* Author: 		Localhost
* 		  		hi@brennannovak.com
* 
* Project:		http://social-igniter.com
* 
* Description: This file is for the public Tags Controller class
*/
class Tags extends Site_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $this->load->library('tags_library');      
	}
	
	function index() 
	{	
		$this->data['page_title']	= "Tags";
		$this->data['tags'] 		= $this->tags_library->get_tags('type', 'all', 5);

		$this->render('wide');
	}

	function view()
	{
		$tag				= $this->tags_library->get_tag_url($this->uri->segment(2));
		$tag_links			= $this->tags_library->get_tag_links($tag->tag_id);
		$tags_content_ids	= array();
		
		foreach ($tag_links as $link)
		{
			$tags_content_ids[] = $link->content_id;
		}

		$this->data['page_title']	= 'Tags';
		$this->data['sub_title']	= ucwords($tag->tag);
		$this->data['tag']			= $tag;
		$this->data['tag_content']	= $this->social_igniter->get_content_multiple('content_id', $tags_content_ids);

		$this->render('wide');
	}

	/* Widgets */
	function widgets_tag_cloud($widget_data)
	{
		$widget_data['tags'] = $this->tags_library->get_tags('type', 'all', 5);
		
		$this->load->view('widgets/tag_cloud', $widget_data);
	}
	
}
