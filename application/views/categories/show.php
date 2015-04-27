<h1>Showing Category</h1>

<p>
	<strong>Title: </strong> <?= $category->title ?>
</p>
	
<a class="btn" href="<?= site_url('categories/edit/' . $category->id) ?>">Edit</a>
<a class="btn" href="<?= site_url('categories/') ?>">listing Category</a>