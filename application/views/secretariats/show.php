<h1>Showing Secretariat</h1>

<p>
	<strong>Link_proposal: </strong> <?= $secretariat->link_proposal ?>
</p>
	<p>
	<strong>Link_regiment: </strong> <?= $secretariat->link_regiment ?>
</p>
	
<a class="btn" href="<?= site_url('secretariats/edit/' . $secretariat->id) ?>">Edit</a>
<a class="btn" href="<?= site_url('secretariats/') ?>">listing Secretariat</a>