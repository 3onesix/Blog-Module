<?php

class Article_Tag_Model extends My_Model {
	
	function init()
	{
		$this->table_name('starter_article_tags');
		
		$this->belongs_to('articles');
	}
	
	function unique()
	{
		$this->db->distinct('name');
		return $this->all(array(
			'order' => 'name'
		));
	}
	
}