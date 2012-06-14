<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function update($module)
{
	if ($module->version == '1.2.2')
	{
		create_table('starter_article_tags', array(
			array('name' => 'starter_article_id', 'type' => 'integer'),
			array('name' => 'name', 'type' => 'string'),
			MIGRATION_TIMESTAMPS
		));
		change_column('starter_articles', 'blog_id', array(
			'name' => 'starter_blog_id',
			'type' => 'integer'
		));
	}
	
	if ($module->version == '1.2.4')
	{
		create_column('starter_articles', array(
			'name' => 'image_id',
			'type' => 'integer'
		));
	}
	
	if ($module->version == '1.2.5')
	{
		create_column('starter_articles', array(
			'name' 		=> 'type',
			'type' 		=> 'string',
			'default' 	=> 'article'
		));
		create_column('starter_articles', array(
			'name' 		=> 'published_at',
			'type' 		=> 'integer',
			'default' 	=> 0
		));
	}
}

update($module);