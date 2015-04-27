<h1>Showing Post_image_gallery</h1>

<p>
	<strong>Image: </strong>
    <?php if($post_image_gallery->image): ?>
	<img src="<?= site_url(UPLOAD_PATH.'post_image_galleries/thumbs/' . $post_image_gallery->image) ?>" alt=""/>
	<?php endif; ?>
</p>
		
<p>
	<strong>Post ID</strong> <a href="<?= site_url('posts/show/' .  $post_image_gallery->post_id) ?>"><?= $post_image_gallery->post_id ?></a>
</p>

<a class="btn" href="<?= site_url('post_image_galleries/edit/' . $post_image_gallery->id) ?>">Edit</a>
<a class="btn" href="<?= site_url('post_image_galleries/') ?>">listing Post_image_gallery</a>