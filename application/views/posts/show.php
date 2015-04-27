<h1>Showing Post</h1>

<p>
	<strong>User_id: </strong> <?= $post->user_id ?>
</p>
	<p>
	<strong>Pub_date: </strong> <?= $post->pub_date ?>
</p>
	<p>
	<strong>Image: </strong>
    <?php if($post->image): ?>
	<img src="<?= site_url(UPLOAD_PATH.'posts/thumbs/' . $post->image) ?>" alt=""/>
	<?php endif; ?>
</p>
		<p>
	<strong>Title: </strong> <?= $post->title ?>
</p>
	<p>
	<strong>Content: </strong> <?= $post->content ?>
</p>
	
<a class="btn" href="<?= site_url('posts/edit/' . $post->id) ?>">Edit</a>
<a class="btn" href="<?= site_url('posts/') ?>">listing Post</a>