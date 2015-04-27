<h1>post_image_galleries on Trash</h1>

<?php if(count($post_image_galleries)): ?>
	<table class="table table-striped table-bordered">
		<tr>
			<th>ID</th>
			
			<th>Image</th>
			
			<th>Post ID</th>
			
			<th>Deleted at</th>
			<td>
				<a class="btn btn-inverse" href="<?= site_url('post_image_galleries') ?>"><span class="icon-arrow-left icon-white"></span> Back</a>
			</td>
		</tr>
		<?php foreach($post_image_galleries as $post_image_gallery): ?>
			<tr>
				<td><?= $post_image_gallery->id ?></td>
				
				<td><?= $post_image_gallery->image ?></td>
				
				<td>
					<a href="<?= site_url('posts/show/' . $post_image_gallery->post_id) ?>"><?= $post_image_gallery->post_id ?></a>
				</td>
								<td><?= $post_image_gallery->deleted_at ?></td>
				<td>
					<a class="btn" href="<?= site_url('post_image_galleries/recover/' . $post_image_gallery->id) ?>"><span class="icon-repeat"></span> Recuperar</a>
					<a class="btn btn-danger" href="<?= site_url('post_image_galleries/delete_permanently/' . $post_image_gallery->id) ?>" data-confirm="Tem certeza que deseja excluir definitivamente o post_image_gallery? Essa ação não pode ser desfeita."><span class="icon-remove icon-white"></span> Excluir Definitivamente</a>
				</td>
			</tr>
		<?php endforeach ?>
	</table>
<?php else: ?>
	<p class="text-info">No items on trash</p>
	<a class="btn" href="<?= site_url('post_image_galleries') ?>">Back</a>
<?php endif ?>