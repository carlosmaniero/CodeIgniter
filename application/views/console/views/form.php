</?= form_open('', array('class' => 'form-horizontal')); ?>
	<?php 
	foreach ($attrs as $attr): if($attr['name'] != 'belong_to'): 
		if($attr['properties']['type'] == 'text'): 
	?>

	<div class="control-group">
	  <label class="control-label" for="input-<?= $attr['name'] ?>"><?= ucfirst($attr['name']) ?>:</label>
	  <div class="controls">
	    <textarea name="<?= $attr['name'] ?>" id="input-<?= $attr['name'] ?>" class="input-xxlarge" placeholder="<?= ucfirst($attr['name']) ?>" rows="15"></?= $<?= singular($name) ?>-><?= $attr['name'] ?> ?></textarea>
	  </div>
	</div>
		<?php else: ?>

	<div class="control-group">
	  <label class="control-label" for="input-<?= $attr['name'] ?>"><?= ucfirst($attr['name']) ?>:</label>
	  <div class="controls">
	    <input name="<?= $attr['name'] ?>" type="text" id="input-<?= $attr['name'] ?>" placeholder="<?= ucfirst($attr['name']) ?>" value="</?= $<?= singular($name) ?>-><?= $attr['name'] ?> ?>">
	  </div>
	</div>
		<?php endif; ?>
	<?php else: ?>

	<div class="control-group">
	  <label class="control-label" for="input-<?= singular($attr['properties']) ?>-id">ID do <?= ucfirst(singular($attr['properties'])) ?>:</label>
	  <div class="controls">
	    <input name="<?= singular($attr['properties']) ?>_id" id="input-<?= singular($attr['properties']) ?>-id" type="text" placeholder="<?= ucfirst($attr['properties']) ?>" value="</?= $<?= singular($name) ?>-><?= singular($attr['properties']) ?>_id ?>">
	  </div>
	</div>
	<?php
		endif; 
	endforeach; 
	?>

	<div class="form-actions">
	  <button type="submit" class="btn btn-primary">Save</button>
	  <button type="button" class="btn" onclick="history.back()">Cancel</button>
	</div>

</?= form_close(); ?>