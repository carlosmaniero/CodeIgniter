<?= form_open('', array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data')); ?>
	
	<div class="control-group">
		<label class="control-label" for="input-user_id">User_id:</label>
		<div class="controls">
			<input name="user_id" type="text" id="input-user_id" placeholder="User_id" value="<?= $post->user_id ?>">
		</div>
	</div>
					
	<div class="control-group">
		<label class="control-label" for="input-pub_date">Pub_date:</label>
		<div class="controls">
			<input name="pub_date" type="text" id="input-pub_date" placeholder="Pub_date" value="<?= $post->pub_date ?>">
		</div>
	</div>
					
	<div class="control-group">
		<label class="control-label" for="input-image">Image:</label>
		<div class="controls">
							<?php if($post->image): ?>
			<img src="<?= site_url(UPLOAD_PATH . 'posts/thumbs/' . $post->image) ?>" alt="" />
			<?php endif; ?>
			<br/>
							<input type="file" name="input-image" value="" id="input-image">
		</div>
	</div>
					
	<div class="control-group">
		<label class="control-label" for="input-title">Title:</label>
		<div class="controls">
			<input name="title" type="text" id="input-title" placeholder="Title" value="<?= $post->title ?>">
		</div>
	</div>
					
	<div class="control-group">
	  <label class="control-label" for="input-content">Content:</label>
	  <div class="controls">
	    <textarea name="content" id="input-content" class="input-xxlarge" placeholder="Content" rows="15"><?= $post->content ?></textarea>
	  </div>
	</div>
					
	<div class="form-actions">
	  <button type="submit" class="btn btn-primary">Save</button>
	  <button type="button" class="btn" onclick="history.back()">Cancel</button>
	</div>

<?= form_close(); ?>