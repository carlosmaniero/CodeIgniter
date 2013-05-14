<?= form_open('', array('class' => 'form-horizontal')); ?>

	<div class="control-group">
	  <label class="control-label" for="input-title">Title:</label>
	  <div class="controls">
	    <input type="text" name="title" value="<?= $result->title ?>" id="input-title" placeholder="Title">
	  </div>
	</div>

	<div class="control-group">
	  <label class="control-label" for="input-body">Body:</label>
	  <div class="controls">
	    <textarea name="body" id="input-body" class="input-xxlarge" placeholder="Body" rows="15"><?= $result->body ?></textarea>
	  </div>
	</div>

	<div class="control-group">
	  <label class="control-label" for="input-visible-in">Visible In:</label>
	  <div class="controls">
	    <input type="text" name="visible_in" id="input-visible-in" value="<?= format_datetime($result->visible_in) ?>" data-mask="datetime" placeholder="dd/mm/aaaa hh:mm">
	  </div>
	</div>

	<div class="form-actions">
	  <button type="submit" class="btn btn-primary">Salvar</button>
	  <button type="button" class="btn" onclick="history.back()">Cancelar</button>
	</div>

<?= form_close(); ?>