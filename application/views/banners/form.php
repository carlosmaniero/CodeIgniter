<?= form_open('', array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data')); ?>
	
	<div class="control-group">
		<label class="control-label" for="input-images">Images:</label>
		<div class="controls">
							<?php if($banner->images): ?>
			<img src="<?= site_url(UPLOAD_PATH . 'banners/thumbs/' . $banner->images) ?>" alt="" />
			<?php endif; ?>
			<br/>
							<input type="file" name="input-images" value="" id="input-images">
		</div>
	</div>
					
	<div class="control-group">
		<label class="control-label" for="input-title">Title:</label>
		<div class="controls">
			<input name="title" type="text" id="input-title" placeholder="Title" value="<?= $banner->title ?>">
		</div>
	</div>
					
	<div class="control-group">
	  <label class="control-label" for="input-description">Description:</label>
	  <div class="controls">
	    <textarea name="description" id="input-description" class="input-xxlarge" placeholder="Description" rows="15"><?= $banner->description ?></textarea>
	  </div>
	</div>
					
	<div class="control-group">
		<label class="control-label" for="input-link">Link:</label>
		<div class="controls">
			<input name="link" type="text" id="input-link" placeholder="Link" value="<?= $banner->link ?>">
		</div>
	</div>
					
	<div class="control-group">
		<label class="control-label" for="input-order">Order:</label>
		<div class="controls">
			<input name="order" type="text" id="input-order" placeholder="Order" value="<?= $banner->order ?>">
		</div>
	</div>
					
	<div class="form-actions">
	  <button type="submit" class="btn btn-primary">Save</button>
	  <button type="button" class="btn" onclick="history.back()">Cancel</button>
	</div>

<?= form_close(); ?>