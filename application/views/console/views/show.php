<h1>Showing <?= ucfirst($name) ?></h1>

<?php 
foreach ($attrs as $attr):
	if($attr['name'] != 'belong_to'):
		if($attr['properties']['comments'] == 'image'):
?>
<p>
	<strong><?= ucfirst($attr['name']) ?>: </strong>
    </?php if($<?= singular($name) ?>-><?= $attr['name'] ?>): ?>
	<img src="</?= site_url(UPLOAD_PATH.'<?= plural($name) ?>/thumbs/' . $<?= singular($name) ?>-><?= $attr['name'] ?>) ?>" alt=""/>
	</?php endif; ?>
</p>
		<?php elseif($attr['properties']['comments'] == 'file'): ?>
<p>
	<strong><?= ucfirst($attr['name']) ?>: </strong>
    </?php if($<?= singular($name) ?>-><?= $attr['name'] ?>): ?>
	<a href="</?= site_url(UPLOAD_PATH . <?= plural($name) ?> . $<?= singular($name) ?>-><?= $attr['name'] ?>) ?>" target="_blank"></?= $<?= singular($name) ?>-><?= $attr['name'] ?> ?></a>
	</?php endif; ?>
</p>

		<?php else: ?>
<p>
	<strong><?= ucfirst($attr['name']) ?>: </strong> </?= $<?= $name ?>-><?= $attr['name'] ?> ?>
</p>
	<?php
		endif;
	else: ?>

<p>
	<strong><?= ucfirst(singular($attr['properties'])) ?> ID</strong> <a href="</?= site_url('<?= plural($attr['properties']) ?>/show/' .  $<?= $name ?>-><?= singular($attr['properties']) ?>_id) ?>"></?= $<?= $name ?>-><?= singular($attr['properties']) ?>_id ?></a>
</p>
<?php
	endif; 
endforeach; 
?>

<a class="btn" href="</?= site_url('<?= plural($name) ?>/edit/' . $<?= $name ?>->id) ?>">Edit</a>
<a class="btn" href="</?= site_url('<?= plural($name) ?>/') ?>">listing <?= ucfirst($name) ?></a>