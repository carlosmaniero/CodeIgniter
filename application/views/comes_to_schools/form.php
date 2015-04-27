<?= form_open('', array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data')); ?>
	
	<div class="control-group">
		<label class="control-label" for="input-name">Name:</label>
		<div class="controls">
			<input name="name" type="text" id="input-name" placeholder="Name" value="<?= $comes_to_school->name ?>">
		</div>
	</div>
					
	<div class="control-group">
		<label class="control-label" for="input-mail">Mail:</label>
		<div class="controls">
			<input name="mail" type="text" id="input-mail" placeholder="Mail" value="<?= $comes_to_school->mail ?>">
		</div>
	</div>
					
	<div class="control-group">
		<label class="control-label" for="input-phone">Phone:</label>
		<div class="controls">
			<input name="phone" type="text" id="input-phone" placeholder="Phone" value="<?= $comes_to_school->phone ?>">
		</div>
	</div>
					
	<div class="control-group">
		<label class="control-label" for="input-near_to_school">Near_to_school:</label>
		<div class="controls">
			<input name="near_to_school" type="text" id="input-near_to_school" placeholder="Near_to_school" value="<?= $comes_to_school->near_to_school ?>">
		</div>
	</div>
					
	<div class="control-group">
		<label class="control-label" for="input-loking_for">Loking_for:</label>
		<div class="controls">
			<input name="loking_for" type="text" id="input-loking_for" placeholder="Loking_for" value="<?= $comes_to_school->loking_for ?>">
		</div>
	</div>
					
	<div class="form-actions">
	  <button type="submit" class="btn btn-primary">Save</button>
	  <button type="button" class="btn" onclick="history.back()">Cancel</button>
	</div>

<?= form_close(); ?>