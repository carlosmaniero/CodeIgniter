<h1>Showing Post_category</h1>


<p>
	<strong>Post ID</strong> <a href="<?= site_url('posts/show/' .  $post_category->post_id) ?>"><?= $post_category->post_id ?></a>
</p>

<a class="btn" href="<?= site_url('post_categories/edit/' . $post_category->id) ?>">Edit</a>
<a class="btn" href="<?= site_url('post_categories/') ?>">listing Post_category</a>