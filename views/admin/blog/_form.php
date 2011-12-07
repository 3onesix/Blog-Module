<?php $this->load->view('admin/_errors', array('errors' => $article->errors()))?>
<div id="page_variables">
	<fieldset>
		<?php if (count($blogs) > 1): ?>
			<div class="field">
				<?php print $f->label('blog_id', 'Blog:'); ?>
				<?php print $f->select('blog_id', $blogs); ?>
			</div>
		<?php else: ?>
			<input type="hidden" name="starter_article[blog_id]" value="<?=current(array_keys($blogs))?>" />
		<?php endif; ?>
		<div class="field">
			<?php echo $f->label('subject', 'Subject:'); ?>
			<?php echo $f->text_field('subject'); ?>				
		</div>
		<?php if ($this->module->setting('include_short')): ?>
			<div class="field" data-help="If a summary is provided, this will be displayed on list pages.">
				<?php echo $f->label('short', 'Short Summary:'); ?>
				<?php echo $f->text_field('short'); ?>				
			</div>
		<?php endif; ?>
		<div class="field">
			<?php echo $f->label('body', 'Body:'); ?>
			<?php echo $f->text_area('body'); ?>				
		</div>
		<input type="text" name="starter_article[tags]" id="starter_article_tags_field" value="" />
		<script src="<?=base_url()?>assets/site/modules/starter_blog/js/TextboxList.js" type="text/javascript"></script>
		<script src="<?=base_url()?>assets/site/modules/starter_blog/js/TextboxList.Autocomplete.js" type="text/javascript"></script>
		<script src="<?=base_url()?>assets/site/modules/starter_blog/js/SuggestInput.js" type="text/javascript"></script>
		<script src="<?=base_url()?>assets/site/modules/starter_blog/js/GrowingInput.js" type="text/javascript"></script>
		<link rel="stylesheet" href="<?=base_url()?>assets/site/modules/starter_blog/css/TextboxList.Autocomplete.css" type="text/css" />
		<link rel="stylesheet" href="<?=base_url()?>assets/site/modules/starter_blog/css/TextboxList.css" type="text/css" />
		<script type="text/javascript">
			$(function () {
				var tags = new Array();
				<?php foreach ($tags as $tag): ?>
				tags.push('<?=$tag->name?>');
				<?php endforeach; ?>
				var t;
				t = new $.TextboxList('#starter_article_tags_field', {decode: function (o) { return []; }, unique: true, plugins: {autocomplete: {}}});
				<?php if ($article->persisted() && $article->tags): ?>
					var val = $('#starter_article_tags_field').val();
					val.split(',');
					for (var i in val)
					{
						t.add(val);
					}
				<?php endif; ?>
				var autocomplete = t.plugins['autocomplete'];
				autocomplete.setValues([
				  <?php foreach ($tags as $tag): ?>
				  ['<?=$tag->name?>', '<?=$tag->name?>', '<?=$tag->name?>', '<?=$tag->name?>'],
				  <?php endforeach; ?>
				]);
			});
		</script>
		<div class="field checkbox">
			<?php echo $f->check_box('is_published'); ?>
			<?php echo $f->label('is_published', 'Published'); ?>
		</div>
	</fieldset>
</div>
<div id="sidebar">
</div>
<div class="actions">
	<?php echo submit_tag(); ?> or <a href="<?php echo site_url('admin/blog'); ?>">cancel</a>
</div>