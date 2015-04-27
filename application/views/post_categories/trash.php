<h1>post_categories on Trash</h1>

<?php if(count($post_categories)): ?>
	<table class="table table-striped table-bordered">
		<tr>
			<th>ID</th>
			
			<th>Post ID</th>
			
			<th>Deleted at</th>
			<td>
				<a class="btn btn-inverse" href="<?= site_url('post_categories') ?>"><span class="icon-arrow-left icon-white"></span> Back</a>
			</td>
		</tr>
		<?php foreach($post_categories as $post_category): ?>
			<tr>
				<td><?= $post_category->id ?></td>
				
				<td>
					<a href="<?= site_url('posts/show/' . $post_category->post_id) ?>"><?= $post_category->post_id ?></a>
				</td>
								<td><?= $post_category->deleted_at ?></td>
				<td>
					<a class="btn" href="<?= site_url('post_categories/recover/' . $post_category->id) ?>"><span class="icon-repeat"></span> Recuperar</a>
					<a class="btn btn-danger" href="<?= site_url('post_categories/delete_permanently/' . $post_category->id) ?>" data-confirm="Tem certeza que deseja excluir definitivamente o post_category? Essa ação não pode ser desfeita."><span class="icon-remove icon-white"></span> Excluir Definitivamente</a>
				</td>
			</tr>
		<?php endforeach ?>
	</table>
<?php else: ?>
	<p class="text-info">No items on trash</p>
	<a class="btn" href="<?= site_url('post_categories') ?>">Back</a>
<?php endif ?>