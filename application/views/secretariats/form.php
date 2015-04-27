<?= form_open('', array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data')); ?>
	
	<div class="control-group">
		<label class="control-label" for="input-link_proposal">Link_proposal:</label>
		<div class="controls">
			<input name="link_proposal" type="text" id="input-link_proposal" placeholder="Link_proposal" value="<?= $secretariat->link_proposal ?>">
		</div>
	</div>
					
	<div class="control-group">
		<label class="control-label" for="input-link_regiment">Link_regiment:</label>
		<div class="controls">
			<input name="link_regiment" type="text" id="input-link_regiment" placeholder="Link_regiment" value="<?= $secretariat->link_regiment ?>">
		</div>
	</div>
					
	<div class="form-actions">
	  <button type="submit" class="btn btn-primary">Save</button>
	  <button type="button" class="btn" onclick="history.back()">Cancel</button>
	</div>

<?= form_close(); ?>