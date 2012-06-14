<?php $title = 'Blog'; ?>
<?php $this->load->view('admin/_header', array('title' => $title)); ?>

<?php if(flash('notice')): ?><div class="notice"><?php echo flash('notice'); ?></div><?php endif; ?>

<div id="actions">
	<h2>All Articles</h2>
	<a href="<?php echo site_url('admin/blog/new'); ?>" class="button new article">Create a New Article</a>
</div>
<div id="records" class="articles">
	<ul>
		<?php $odd = false; ?>
		<?php foreach($articles as $article): ?>
		<li<?=($odd ? ' class="odd"' : '')?> data-status="<?=($article->is_published ? 'published' : 'draft')?>">
			<div class="what"><?=$article->subject?> <span class="sub">(created on <?=date('m/d/Y', $article->created_at)?><?php if (count($blogs) > 1):?> in <strong><?=$article->blog->name?></strong><?php endif; ?>)</span></div>
			<div class="actions">
				<a class="edit" href="<?=site_url('admin/blog/edit/'.$article->id)?>">edit</a>
				<a class="delete" href="<?=site_url('admin/blog/destroy/'.$article->id)?>">delete</a>
			</div>
		</li>
		<?php $odd = !$odd; ?>
		<?php endforeach; ?>
	</ul>
	<?php pagination($pages); ?>
</div>
<div id="sidebar">
<?php $filters = array(); ?>
<?php if ( count($blogs) > 1 ) $filters['Blog'] = $blogs; ?>
<?php $filters += array(
	'Sort by' => array(
		'published_at' => 'Published Date',
		'created_at' => 'Created Date',
		'updated_at' => 'Updated Date'
	),
	'Sort direction' => array(
		'DESC' => 'Descending',
		'ASC'  => 'Ascending'
	),
	'Status' => array(
		'all' => 'All',
		'1'   => 'Published',
		'0'   => 'Unpublished'
	),
	'Search' => null
); ?>
<?php sidebar_filters($filters); ?>
</div>

<?php $this->load->view('admin/_footer'); ?>
