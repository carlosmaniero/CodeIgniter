<?= form_open('', array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data')); ?>
	
	<div class="control-group">
		<label class="control-label" for="input-title">Title:</label>
		<div class="controls">
			<input name="title" type="text" id="input-title" placeholder="Title" value="<?= $extra_course->title ?>">
		</div>
	</div>
					
	<div class="control-group">
		<label class="control-label" for="input-image">Image:</label>
		<div class="controls">
							<?php if($extra_course->image): ?>
			<img src="<?= site_url(UPLOAD_PATH . 'extra_courses/thumbs/' . $extra_course->image) ?>" alt="" />
			<?php endif; ?>
			<br/>
							<input type="file" name="input-image" value="" id="input-image">
		</div>
	</div>
					
	<div class="control-group">
	  <label class="control-label" for="input-content">Content:</label>
	  <div class="controls">
	    <textarea name="content" id="input-content" class="input-xxlarge" placeholder="Content" rows="15"><?= $extra_course->content ?></textarea>
	  </div>
	</div>
					
	<div class="control-group">
	  <label class="control-label" for="input-payment_information">Payment_information:</label>
	  <div class="controls">
	    <textarea name="payment_information" id="input-payment_information" class="input-xxlarge" placeholder="Payment_information" rows="15"><?= $extra_course->payment_information ?></textarea>
	  </div>
	</div>
					
	<div class="form-actions">
	  <button type="submit" class="btn btn-primary">Save</button>
	  <button type="button" class="btn" onclick="history.back()">Cancel</button>
	</div>

<?= form_close(); ?>