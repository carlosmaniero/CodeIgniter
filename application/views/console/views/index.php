<h1>Listing <?= ucfirst(plural($name)) ?></h1>

</?php if(count($<?= plural($name) ?>)): ?>
	<table class="table table-striped table-bordered">
		<tr>
			<th>ID</th>
			<?php 
			foreach ($attrs as $attr): if($attr['name'] != 'belong_to'): 
			?>

			<th><?= ucfirst($attr['name']) ?></th>
			<?php else: ?>

			<th><?= ucfirst(singular($attr['properties'])) ?> ID</th>
			<?php
				endif; 
			endforeach; 
			?>
			<td>
				<a class="btn btn-primary" href="</?= site_url('<?= plural($name) ?>/insert') ?>"><span class="icon-plus icon-white"></span> New <?= ucfirst($name) ?></a>
				<a class="btn btn-inverse" href="</?= site_url('<?= plural($name) ?>/trash') ?>"><span class="icon-trash icon-white"></span> Trash</a>
			</td>
		</tr>
		</?php foreach($<?= plural($name) ?> as $<?= $name ?>): ?>
			<tr>
				<td></?= $<?= $name ?>->id ?></td>
				<?php 
				foreach ($attrs as $attr): if($attr['name'] != 'belong_to'): 
				?>

				<td></?= $<?= $name ?>-><?= $attr['name'] ?> ?></td>
				<?php else: ?>

				<td>
					<a href="</?= site_url('<?= plural($attr['properties']) ?>/show/' . $<?= $name ?>-><?= singular($attr['properties']) ?>_id) ?>"></?= $<?= $name ?>-><?= singular($attr['properties']) ?>_id ?></a>
				</td>
				<?php
					endif; 
				endforeach; 
				?>
				<td>
					<a class="btn" href="</?= site_url('<?= plural($name) ?>/show/' . $<?= $name ?>->id) ?>"><span class="icon-eye-open"></span> Show</a>
					<a class="btn" href="</?= site_url('<?= plural($name) ?>/edit/' . $<?= $name ?>->id) ?>"><span class="icon-edit"></span> Edit</a>
					<a class="btn btn-danger" href="</?= site_url('<?= plural($name) ?>/delete/' . $<?= $name ?>->id) ?>" data-confirm="Are you sure you want to delete the <?= $name ?>"><span class="icon-remove icon-white"></span> Delete</a>
				</td>
			</tr>
		</?php endforeach ?>
	</table>
</?php else: ?>
	<p class="text-info">No <?= $name ?> registered</p>
	<a class="btn btn-primary" href="</?= site_url('<?= plural($name) ?>/insert') ?>"><span class="icon-plus icon-white"></span> Include the first</a>
	<a class="btn btn-inverse" href="</?= site_url('<?= plural($name) ?>/trash') ?>"><span class="icon-trash icon-white"></span> Trash</a>
</?php endif; ?>
