<h1>Showing Period</h1>

<p>
	<strong>Name: </strong> <?= $period->name ?>
</p>
	<p>
	<strong>Description: </strong> <?= $period->description ?>
</p>
	<p>
	<strong>Image: </strong>
    <?php if($period->image): ?>
	<img src="<?= site_url(UPLOAD_PATH.'periods/thumbs/' . $period->image) ?>" alt=""/>
	<?php endif; ?>
</p>
		<p>
	<strong>Video: </strong> <?= $period->video ?>
</p>
	<p>
	<strong>Link_products: </strong> <?= $period->link_products ?>
</p>
	<p>
	<strong>Link_services: </strong> <?= $period->link_services ?>
</p>
	<p>
	<strong>Link_documents: </strong> <?= $period->link_documents ?>
</p>
	<p>
	<strong>Link_calendar: </strong> <?= $period->link_calendar ?>
</p>
	<p>
	<strong>Link_materials: </strong> <?= $period->link_materials ?>
</p>
	<p>
	<strong>Link_bookstores: </strong> <?= $period->link_bookstores ?>
</p>
	<p>
	<strong>Order: </strong> <?= $period->order ?>
</p>
	
<a class="btn" href="<?= site_url('periods/edit/' . $period->id) ?>">Edit</a>
<a class="btn" href="<?= site_url('periods/') ?>">listing Period</a>