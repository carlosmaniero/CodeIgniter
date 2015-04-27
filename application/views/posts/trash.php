<h1>posts on Trash</h1>

<?php if(count($posts)): ?>
	<table class="table table-striped table-bordered">
		<tr>
			<th>ID</th>
			
			<th>User_id</th>
			
			<th>Pub_date</th>
			
			<th>Image</th>
			
			<th>Title</th>
			
			<th>Content</th>
			
			<th>Deleted at</th>
			<td>
				<a class="btn btn-inverse" href="<?= site_url('posts') ?>"><span class="icon-arrow-left icon-white"></span> Back</a>
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
								<td><?= $post->deleted_at ?></td>
				<td>
					<a class="btn" href="<?= site_url('posts/recover/' . $post->id) ?>"><span class="icon-repeat"></span> Recuperar</a>
					<a class="btn btn-danger" href="<?= site_url('posts/delete_permanently/' . $post->id) ?>" data-confirm="Tem certeza que deseja excluir definitivamente o post? Essa ação não pode ser desfeita."><span class="icon-remove icon-white"></span> Excluir Definitivamente</a>
				</td>
			</tr>
		<?php endforeach ?>
	</table>
<?php else: ?>
	<p class="text-info">No items on trash</p>
	<a class="btn" href="<?= site_url('posts') ?>">Back</a>
<?php endif ?>