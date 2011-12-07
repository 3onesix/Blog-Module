<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function update($module)
{
	if ($module->version == '1.2.1')
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
}

update($module);