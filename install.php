<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function install()
{
	create_table('starter_blogs', array(
		array('name' => 'name', 'type' => 'string'),
		array('name' => 'url', 'type' => 'string'),
		MIGRATION_TIMESTAMPS
	));
	create_table('starter_articles', array(
		array('name' => 'starter_blog_id', 'type' => 'integer'),
		array('name' => 'user_id', 'type' => 'integer'),
		array('name' => 'subject', 'type' => 'string'),
		array('name' => 'slug', 'type' => 'string'),
		array('name' => 'short', 'type' => 'binary'),
		array('name' => 'body', 'type' => 'binary'),
		array('name' => 'is_published', 'type' => 'boolean'),
		array('name' => 'image_id', 'type' => 'integer'),
		MIGRATION_TIMESTAMPS
	));
	create_table('starter_article_tags', array(
		array('name' => 'starter_article_id', 'type' => 'integer'),
		array('name' => 'name', 'type' => 'string'),
		MIGRATION_TIMESTAMPS
	));
}

install();