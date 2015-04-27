<h1>Showing Comes_to_school</h1>

<p>
	<strong>Name: </strong> <?= $comes_to_school->name ?>
</p>
	<p>
	<strong>Mail: </strong> <?= $comes_to_school->mail ?>
</p>
	<p>
	<strong>Phone: </strong> <?= $comes_to_school->phone ?>
</p>
	<p>
	<strong>Near_to_school: </strong> <?= $comes_to_school->near_to_school ?>
</p>
	<p>
	<strong>Loking_for: </strong> <?= $comes_to_school->loking_for ?>
</p>
	
<a class="btn" href="<?= site_url('comes_to_schools/edit/' . $comes_to_school->id) ?>">Edit</a>
<a class="btn" href="<?= site_url('comes_to_schools/') ?>">listing Comes_to_school</a>