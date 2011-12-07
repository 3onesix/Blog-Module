<?php

class Blog extends MY_Controller
{
	protected $require_login = TRUE;
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('article_model');
		$this->load->model('blog_model');
		$this->load->model('article_tag_model');
		
		$this->module = $this->module_model->first(array('simple_name' => 'starter_blog'));
	}
		
	public function action_index()
	{
		/* Filters */
		$order = 'created_at';
		$order_dir = 'DESC';
		if (get_filter('sort_by'))
		{
			$order = get_filter('sort_by');
		}
		if (get_filter('sort_direction'))
		{
			$order_dir = get_filter('sort_direction');
		}
		if (get_filter('status'))
		{
			if (get_filter('status') != 'all')
			{
				$status = get_filter('status');
			}
		}
		$pages = ceil($this->article_model->count(isset($status) ? array('is_published' => $status) : null) / 10);
		if (get_filter('search'))
		{
			$query = get_filter('search');
			$this->db->where('(subject LIKE "%'.$query.'%")');
			$pages = ceil($this->article_model->count(isset($status) ? array('is_published' => $status) : null) / 10);
			$this->db->where('(subject LIKE "%'.$query.'%")');
		}
		$pages = $pages ? $pages : 1;
		
		$articles = $this->article_model->find(array('conditions' => (isset($status) ? array('is_published' => $status) : null), 'order' => $order.' '.$order_dir, 'page' => $this->input->get('page') ? $this->input->get('page') : 1, 'limit' => 10));
		
		$this->load->vars('pages', $pages);
		$this->load->vars('notice', flash('notice'));
		$this->load->vars('articles', $articles);
		$this->load->view('admin/blog/index');
	}
	
	public function action_new()
	{
		if (!count($this->blog_model->all())) $this->blog_model->create(array('name' => 'Blog', 'url' => 'blog'));
		
		foreach($this->blog_model->all(array('order' => 'name')) as $blog) $blogs[$blog->id] = $blog->name;		
		$this->load->vars('blogs', $blogs);
		$this->load->vars('tags', $this->article_tag_model->unique());
		$this->load->view('admin/blog/new', array('article' => flash_jot('article')));
	}
	
	public function action_create()
	{
		$data = $this->input->post('starter_article');
		$tags = $data['tags'];
		unset($data['tags']);
		$data['user_id'] = $this->current_user->id;
		$article = $this->article_model->create($data);
				
		if ( $article->errors() )
		{
			flash('article', $article);
			redirect('admin/blog/new');
		}
		else
		{
			//add tags
			$set = array();
			$tags = explode(',', $tags);
			foreach ($tags as $tag)
			{
				$this->article_tag_model->create(array(
					'starter_article_id' => $article->id,
					'name' => $tag
				));
			}
			
			flash('notice', 'Article was created successfully.');
			redirect('admin/blog');
		}
	}

	public function action_edit($id)
	{					
		foreach($this->blog_model->all() as $blog) $blogs[$blog->id] = $blog->name;		
		$this->load->vars('blogs', $blogs);
		$this->load->vars('tags', $this->article_tag_model->unique());
		$this->load->vars('article', flash_jot('article', $id));
		$this->load->view('admin/blog/edit');
	}
	
	public function action_update($id)
	{
		$data = $this->input->post('starter_article');
		$tags = $data['tags'];
		unset($data['tags']);
		$data['user_id'] = $this->current_user->id;
		$article = $this->article_model->update($id, $data);
				
		if ( $article->errors() )
		{
			flash('article', $article);
			redirect('admin/blog/edit/'.$id);
		}
		else
		{
			//add tags
			foreach ($article->tags->all() as $tag) $tag->destroy();
			$set = array();
			$tags = explode(',', $tags);
			foreach ($tags as $tag)
			{
				$this->article_tag_model->create(array(
					'starter_article_id' => $article->id,
					'name' => $tag
				));
			}
			flash('notice', 'Article was updated successfully.');
		}
		
		redirect('admin/blog');
	}
	
	public function action_destroy($id)
	{
		$article = $this->article_model->first($id);
		
		if ( $article )
		{
			$article->destroy();
			flash('notice', 'Article was successfully deleted.');
			redirect('admin/blog');
		}
	}
}