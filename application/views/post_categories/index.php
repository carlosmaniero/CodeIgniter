<h1>Listing Post_categories</h1>

<?php if(count($post_categories)): ?>
	<table class="table table-striped table-bordered">
		<tr>
			<th>ID</th>
			
			<th>Post ID</th>
						<td>
				<a class="btn btn-primary" href="<?= site_url('post_categories/insert') ?>"><span class="icon-plus icon-white"></span> New Post_category</a>
				<a class="btn btn-inverse" href="<?= site_url('post_categories/trash') ?>"><span class="icon-trash icon-white"></span> Trash</a>
			</td>
		</tr>
		<?php foreach($post_categories as $post_category): ?>
			<tr>
				<td><?= $post_category->id ?></td>
				
				<td>
					<a href="<?= site_url('posts/show/' . $post_category->post_id) ?>"><?= $post_category->post_id ?></a>
				</td>
								<td>
					<a class="btn" href="<?= site_url('post_categories/show/' . $post_category->id) ?>"><span class="icon-eye-open"></span> Show</a>
					<a class="btn" href="<?= site_url('post_categories/edit/' . $post_category->id) ?>"><span class="icon-edit"></span> Edit</a>
					<a class="btn btn-danger" href="<?= site_url('post_categories/delete/' . $post_category->id) ?>" data-confirm="Are you sure you want to delete the post_category"><span class="icon-remove icon-white"></span> Delete</a>
				</td>
			</tr>
		<?php endforeach ?>
	</table>
<?php else: ?>
	<p class="text-info">No post_category registered</p>
	<a class="btn btn-primary" href="<?= site_url('post_categories/insert') ?>"><span class="icon-plus icon-white"></span> Include the first</a>
	<a class="btn btn-inverse" href="<?= site_url('post_categories/trash') ?>"><span class="icon-trash icon-white"></span> Trash</a>
<?php endif; ?>
