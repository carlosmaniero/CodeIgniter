<?= form_open('', array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data')); ?>
	
	<div class="control-group">
		<label class="control-label" for="input-image">Image:</label>
		<div class="controls">
							<?php if($courses_image_gallery->image): ?>
			<img src="<?= site_url(UPLOAD_PATH . 'courses_image_galleries/thumbs/' . $courses_image_gallery->image) ?>" alt="" />
			<?php endif; ?>
			<br/>
							<input type="file" name="input-image" value="" id="input-image">
		</div>
	</div>
					
	<div class="control-group">
	  <label class="control-label" for="input-extra_course-id">ID do Extra_course:</label>
	  <div class="controls">
	    <input name="extra_course_id" id="input-extra_course-id" type="text" placeholder="Extra_courses" value="<?= $courses_image_gallery->extra_course_id ?>">
	  </div>
	</div>
	
	<div class="form-actions">
	  <button type="submit" class="btn btn-primary">Save</button>
	  <button type="button" class="btn" onclick="history.back()">Cancel</button>
	</div>

<?= form_close(); ?>