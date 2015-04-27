<h1>Listing Categories</h1>

<?php if(count($categories)): ?>
	<table class="table table-striped table-bordered">
		<tr>
			<th>ID</th>
			
			<th>Title</th>
						<td>
				<a class="btn btn-primary" href="<?= site_url('categories/insert') ?>"><span class="icon-plus icon-white"></span> New Category</a>
				<a class="btn btn-inverse" href="<?= site_url('categories/trash') ?>"><span class="icon-trash icon-white"></span> Trash</a>
			</td>
		</tr>
		<?php foreach($categories as $category): ?>
			<tr>
				<td><?= $category->id ?></td>
				
				<td><?= $category->title ?></td>
								<td>
					<a class="btn" href="<?= site_url('categories/show/' . $category->id) ?>"><span class="icon-eye-open"></span> Show</a>
					<a class="btn" href="<?= site_url('categories/edit/' . $category->id) ?>"><span class="icon-edit"></span> Edit</a>
					<a class="btn btn-danger" href="<?= site_url('categories/delete/' . $category->id) ?>" data-confirm="Are you sure you want to delete the category"><span class="icon-remove icon-white"></span> Delete</a>
				</td>
			</tr>
		<?php endforeach ?>
	</table>
<?php else: ?>
	<p class="text-info">No category registered</p>
	<a class="btn btn-primary" href="<?= site_url('categories/insert') ?>"><span class="icon-plus icon-white"></span> Include the first</a>
	<a class="btn btn-inverse" href="<?= site_url('categories/trash') ?>"><span class="icon-trash icon-white"></span> Trash</a>
<?php endif; ?>
