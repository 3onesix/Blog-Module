<?php

$module		 						= array(
	'name'							=> 'Blog',
	'simple_name'					=> 'starter_blog',
	'version'						=> '1.3', //add WYSIWYG
	'settings'						=> array(
		array(
			'label' 				=> 'Include Short Body Field',
			'key'					=> 'include_short',
			'type'					=> 'checkbox'
		),
		array(
			'label'					=> 'Include Tags',
			'key'					=> 'include_tags',
			'type'					=> 'checkbox'
		),
		array(
			'label'					=> 'Include Rich Text Editor',
			'key'					=> 'include_wysiwyg',
			'type'					=> 'checkbox'
		),
		array(
			'label'					=> 'Include Image',
			'key'					=> 'include_image',
			'type'					=> 'checkbox'
		),
		array(
			'label'					=> 'Image Width',
			'key'					=> 'image_width',
			'type'					=> 'string'
		),
		array(
			'label'					=> 'Image Height',
			'key'					=> 'image_height',
			'type'					=> 'string'
		),
	),
	'files'							=> array(
		array(
			'type'					=> 'controller',
			'name'					=> 'blog.php',
			'include_on_page'		=> 0
		),
		array(
			'type'					=> 'model',
			'name'					=> 'blog_model.php',
			'include_on_page'		=> 1
		),
		array(
			'type'					=> 'model',
			'name'					=> 'article_model.php',
			'include_on_page'		=> 1
		),
		array(
			'type'					=> 'helper',
			'name'					=> 'blog_helper.php',
			'include_on_page'		=> 1
		),
		array(
			'type'					=> 'view',
			'name'					=> 'admin/_form.php',
			'include_on_page'		=> 0
		),
		array(
			'type'					=> 'view',
			'name'					=> 'admin/edit.php',
			'include_on_page'		=> 0
		),
		array(
			'type'					=> 'view',
			'name'					=> 'admin/index.php',
			'include_on_page'		=> 0
		),
		array(
			'type'					=> 'view',
			'name'					=> 'admin/new.php',
			'include_on_page'		=> 0
		),
		array(
			'type'					=> 'stylesheet',
			'name'					=> 'blog.css',
			'include_on_page'		=> 0
		)
	),
	'screens'						=> array(
		array(
			'name'					=> 'Blog',
			'url'					=> 'blog'
		)
	),
	'install'						=> 'install.php',
	'update'						=> 'update.php'
);