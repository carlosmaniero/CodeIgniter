<?= form_open('', array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data')); ?>
	
	<div class="control-group">
		<label class="control-label" for="input-name">Name:</label>
		<div class="controls">
			<input name="name" type="text" id="input-name" placeholder="Name" value="<?= $period->name ?>">
		</div>
	</div>
					
	<div class="control-group">
	  <label class="control-label" for="input-description">Description:</label>
	  <div class="controls">
	    <textarea name="description" id="input-description" class="input-xxlarge" placeholder="Description" rows="15"><?= $period->description ?></textarea>
	  </div>
	</div>
					
	<div class="control-group">
		<label class="control-label" for="input-image">Image:</label>
		<div class="controls">
							<?php if($period->image): ?>
			<img src="<?= site_url(UPLOAD_PATH . 'periods/thumbs/' . $period->image) ?>" alt="" />
			<?php endif; ?>
			<br/>
							<input type="file" name="input-image" value="" id="input-image">
		</div>
	</div>
					
	<div class="control-group">
		<label class="control-label" for="input-video">Video:</label>
		<div class="controls">
			<input name="video" type="text" id="input-video" placeholder="Video" value="<?= $period->video ?>">
		</div>
	</div>
					
	<div class="control-group">
		<label class="control-label" for="input-link_products">Link_products:</label>
		<div class="controls">
			<input name="link_products" type="text" id="input-link_products" placeholder="Link_products" value="<?= $period->link_products ?>">
		</div>
	</div>
					
	<div class="control-group">
		<label class="control-label" for="input-link_services">Link_services:</label>
		<div class="controls">
			<input name="link_services" type="text" id="input-link_services" placeholder="Link_services" value="<?= $period->link_services ?>">
		</div>
	</div>
					
	<div class="control-group">
		<label class="control-label" for="input-link_documents">Link_documents:</label>
		<div class="controls">
			<input name="link_documents" type="text" id="input-link_documents" placeholder="Link_documents" value="<?= $period->link_documents ?>">
		</div>
	</div>
					
	<div class="control-group">
		<label class="control-label" for="input-link_calendar">Link_calendar:</label>
		<div class="controls">
			<input name="link_calendar" type="text" id="input-link_calendar" placeholder="Link_calendar" value="<?= $period->link_calendar ?>">
		</div>
	</div>
					
	<div class="control-group">
		<label class="control-label" for="input-link_materials">Link_materials:</label>
		<div class="controls">
			<input name="link_materials" type="text" id="input-link_materials" placeholder="Link_materials" value="<?= $period->link_materials ?>">
		</div>
	</div>
					
	<div class="control-group">
		<label class="control-label" for="input-link_bookstores">Link_bookstores:</label>
		<div class="controls">
			<input name="link_bookstores" type="text" id="input-link_bookstores" placeholder="Link_bookstores" value="<?= $period->link_bookstores ?>">
		</div>
	</div>
					
	<div class="control-group">
		<label class="control-label" for="input-order">Order:</label>
		<div class="controls">
			<input name="order" type="text" id="input-order" placeholder="Order" value="<?= $period->order ?>">
		</div>
	</div>
					
	<div class="form-actions">
	  <button type="submit" class="btn btn-primary">Save</button>
	  <button type="button" class="btn" onclick="history.back()">Cancel</button>
	</div>

<?= form_close(); ?>