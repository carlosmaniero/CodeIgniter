<h1><?= plural($name) ?> on Trash</h1>

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

			<th>Deleted at</th>
			<td>
				<a class="btn btn-inverse" href="</?= site_url('<?= plural($name) ?>') ?>"><span class="icon-arrow-left icon-white"></span> Back</a>
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
				<td></?= $<?= $name ?>->deleted_at ?></td>
				<td>
					<a class="btn" href="</?= site_url('<?= plural($name) ?>/recover/' . $<?= $name ?>->id) ?>"><span class="icon-repeat"></span> Recuperar</a>
					<a class="btn btn-danger" href="</?= site_url('<?= plural($name) ?>/delete_permanently/' . $<?= $name ?>->id) ?>" data-confirm="Tem certeza que deseja excluir definitivamente o <?= $name ?>? Essa ação não pode ser desfeita."><span class="icon-remove icon-white"></span> Excluir Definitivamente</a>
				</td>
			</tr>
		</?php endforeach ?>
	</table>
</?php else: ?>
	<p class="text-info">No items on trash</p>
	<a class="btn" href="</?= site_url('<?= plural($name) ?>') ?>">Back</a>
</?php endif ?>