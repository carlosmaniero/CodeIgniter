<h1>Showing Banner</h1>

<p>
	<strong>Images: </strong>
    <?php if($banner->images): ?>
	<img src="<?= site_url(UPLOAD_PATH.'banners/thumbs/' . $banner->images) ?>" alt=""/>
	<?php endif; ?>
</p>
		<p>
	<strong>Title: </strong> <?= $banner->title ?>
</p>
	<p>
	<strong>Description: </strong> <?= $banner->description ?>
</p>
	<p>
	<strong>Link: </strong> <?= $banner->link ?>
</p>
	<p>
	<strong>Order: </strong> <?= $banner->order ?>
</p>
	
<a class="btn" href="<?= site_url('banners/edit/' . $banner->id) ?>">Edit</a>
<a class="btn" href="<?= site_url('banners/') ?>">listing Banner</a>