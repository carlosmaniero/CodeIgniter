<?= form_open('', array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data')); ?>
	
	<div class="control-group">
		<label class="control-label" for="input-image">Image:</label>
		<div class="controls">
							<?php if($post_image_gallery->image): ?>
			<img src="<?= site_url(UPLOAD_PATH . 'post_image_galleries/thumbs/' . $post_image_gallery->image) ?>" alt="" />
			<?php endif; ?>
			<br/>
							<input type="file" name="input-image" value="" id="input-image">
		</div>
	</div>
					
	<div class="control-group">
	  <label class="control-label" for="input-post-id">ID do Post:</label>
	  <div class="controls">
	    <input name="post_id" id="input-post-id" type="text" placeholder="Posts" value="<?= $post_image_gallery->post_id ?>">
	  </div>
	</div>
	
	<div class="form-actions">
	  <button type="submit" class="btn btn-primary">Save</button>
	  <button type="button" class="btn" onclick="history.back()">Cancel</button>
	</div>

<?= form_close(); ?>