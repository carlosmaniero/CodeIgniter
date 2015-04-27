<h1>Listing Posts</h1>

<?php if(count($posts)): ?>
	<table class="table table-striped table-bordered">
		<tr>
			<th>ID</th>
			
			<th>User_id</th>
			
			<th>Pub_date</th>
			
			<th>Image</th>
			
			<th>Title</th>
			
			<th>Content</th>
						<td>
				<a class="btn btn-primary" href="<?= site_url('posts/insert') ?>"><span class="icon-plus icon-white"></span> New Post</a>
				<a class="btn btn-inverse" href="<?= site_url('posts/trash') ?>"><span class="icon-trash icon-white"></span> Trash</a>
			</td>
		</tr>
		<?php foreach($posts as $post): ?>
			<tr>
				<td><?= $post->id ?></td>
				
				<td><?= $post->user_id ?></td>
				
				<td><?= $post->pub_date ?></td>
				
				<td><?= $post->image ?></td>
				
				<td><?= $post->title ?></td>
				
				<td><?= $post->content ?></td>
								<td>
					<a class="btn" href="<?= site_url('posts/show/' . $post->id) ?>"><span class="icon-eye-open"></span> Show</a>
					<a class="btn" href="<?= site_url('posts/edit/' . $post->id) ?>"><span class="icon-edit"></span> Edit</a>
					<a class="btn btn-danger" href="<?= site_url('posts/delete/' . $post->id) ?>" data-confirm="Are you sure you want to delete the post"><span class="icon-remove icon-white"></span> Delete</a>
				</td>
			</tr>
		<?php endforeach ?>
	</table>
<?php else: ?>
	<p class="text-info">No post registered</p>
	<a class="btn btn-primary" href="<?= site_url('posts/insert') ?>"><span class="icon-plus icon-white"></span> Include the first</a>
	<a class="btn btn-inverse" href="<?= site_url('posts/trash') ?>"><span class="icon-trash icon-white"></span> Trash</a>
<?php endif; ?>
