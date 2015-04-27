<h1>categories on Trash</h1>

<?php if(count($categories)): ?>
	<table class="table table-striped table-bordered">
		<tr>
			<th>ID</th>
			
			<th>Title</th>
			
			<th>Deleted at</th>
			<td>
				<a class="btn btn-inverse" href="<?= site_url('categories') ?>"><span class="icon-arrow-left icon-white"></span> Back</a>
			</td>
		</tr>
		<?php foreach($categories as $category): ?>
			<tr>
				<td><?= $category->id ?></td>
				
				<td><?= $category->title ?></td>
								<td><?= $category->deleted_at ?></td>
				<td>
					<a class="btn" href="<?= site_url('categories/recover/' . $category->id) ?>"><span class="icon-repeat"></span> Recuperar</a>
					<a class="btn btn-danger" href="<?= site_url('categories/delete_permanently/' . $category->id) ?>" data-confirm="Tem certeza que deseja excluir definitivamente o category? Essa ação não pode ser desfeita."><span class="icon-remove icon-white"></span> Excluir Definitivamente</a>
				</td>
			</tr>
		<?php endforeach ?>
	</table>
<?php else: ?>
	<p class="text-info">No items on trash</p>
	<a class="btn" href="<?= site_url('categories') ?>">Back</a>
<?php endif ?>