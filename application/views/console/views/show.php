<h1>Showing <?= ucfirst($name) ?></h1>

<?php 
foreach ($attrs as $attr): if($attr['name'] != 'belong_to'): 
?>

<p>
	<strong><?= ucfirst($attr['name']) ?>: </strong> </?= $<?= $name ?>-><?= $attr['name'] ?> ?>
</p>
<?php else: ?>

<p>
	<strong><?= ucfirst(singular($attr['properties'])) ?> ID</strong> <a href="</?= site_url('<?= plural($attr['properties']) ?>/show/' .  $<?= $name ?>-><?= singular($attr['properties']) ?>_id) ?>"></?= $<?= $name ?>-><?= singular($attr['properties']) ?>_id ?></a>
</p>
<?php
	endif; 
endforeach; 
?>

<a class="btn" href="</?= site_url('<?= plural($name) ?>/edit/' . $<?= $name ?>->id) ?>">Edit</a>
<a class="btn" href="</?= site_url('<?= plural($name) ?>/') ?>">listing <?= ucfirst($name) ?></a>