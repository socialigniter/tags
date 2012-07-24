<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
Tags Igniter Library

@package	Social Igniter
@subpackage	Tags Igniter Library
@author		Brennan Novak
@link		http://social-igniter.com

Contains functions that handle Tags
*/
 
class Tags_library
{
	protected $ci;

	function __construct()
	{
		$this->ci =& get_instance();
				
		// Load Models
		$this->ci->load->model('tags/tags_model');
		$this->ci->load->model('tags/taxonomy_model');
	}

	function get_tag($tag)
	{
		return $this->ci->tags_model->get_tag($tag);
	}	
	
	function get_tag_url($tag_url)
	{
		return $this->ci->tags_model->get_tag_url($tag_url);
	}
	
	function get_tag_links($tag_id)
	{
		return $this->ci->tags_model->get_tag_links($tag_id);
	}

	function get_tags()
	{
		return $this->ci->tags_model->get_tags();
	}

	function get_tags_content($content_id)
	{
		return $this->ci->tags_model->get_tags_content($content_id);
	}
		
	function process_tags($tags_post, $content_id)
	{
		if ($tags_post)
		{
			// Declarations
			$tag_total	= 1;
			$tags_array = array(explode(", ", $tags_post));
				
			foreach ($tags_array[0] as $tag)
			{
				if ($tag != '')
				{			 	
					// Check for tag existence
					$tag_exists 	= $this->get_tag($tag);
		
					// Insert New Tag			
					if (!$tag_exists)
					{			
						$tag_url	= url_username($tag, 'dash', TRUE);
						$tag_id		= $this->ci->tags_model->add_tag($tag, $tag_url);				
					}
					else
					{
						$tag_id		= $tag_exists->tag_id;
					}
					
					// Insert Link
					$insert_link	= $this->ci->tags_model->add_tags_link($tag_id, $content_id);			
								
					// Check Taxonomy Existence
					$tag_total		= $this->ci->tags_model->get_tag_total($tag);			
					$tag_taxonomy	= $this->ci->taxonomy_model->get_taxonomy($tag_id, 'tag');
						
					if ($tag_taxonomy)
					{
						$update_taxonomy = $this->ci->taxonomy_model->update_taxonomy($tag_taxonomy->taxonomy_id, $tag_total);
					}				
					else
					{
						$insert_taxonomy = $this->ci->taxonomy_model->add_taxonomy($tag_id, 'tag', $tag_total);
					}
				}	
			}
			
			return TRUE;
		}
	}
	
	function delete_tag($tag_id)
	{
		return $this->ci->tags_model->delete_tag($tag_id);
	}
	
	function delete_tag_link($tag_link_id)
	{
		return $this->ci->tags_model->delete_tag_link($tag_link_id);
	}
	
	function delete_tag_links_object($object_id)
	{
		$tag_links 	= $this->get_tags_object($object_id);
		$link_count	= count($tag_links);
		$link_build = 0;
		
		foreach ($tag_links as $link)
		{
			if ($this->delete_tag_link($link->tag_link_id))
			{
				$link_build++;
			}
		}
		
		if ($link_count == $link_build)
		{
			return TRUE;
		}
		else
		{
			return FALSE;		
		}
	}
	
	
}
