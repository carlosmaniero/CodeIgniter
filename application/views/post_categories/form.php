<?= form_open('', array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data')); ?>
	
	<div class="control-group">
	  <label class="control-label" for="input-post-id">ID do Post:</label>
	  <div class="controls">
	    <input name="post_id" id="input-post-id" type="text" placeholder="Posts" value="<?= $post_category->post_id ?>">
	  </div>
	</div>
	
	<div class="form-actions">
	  <button type="submit" class="btn btn-primary">Save</button>
	  <button type="button" class="btn" onclick="history.back()">Cancel</button>
	</div>

<?= form_close(); ?>