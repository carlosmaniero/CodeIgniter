<h1>Listagem de Posts</h1>

<table class="table table-striped table-bordered">
	<tr>
		<th>ID</th>
		<th>Title</th>
		<th>Visible in</th>
		<td>
			<a class="btn btn-primary" href="<?= site_url('posts/insert') ?>"><span class="icon-plus icon-white"></span> Novo Post</a>
		</td>
	</tr>
	<?php foreach($results as $result): ?>
		<tr>
			<td><?= $result->id ?></td>
			<td><?= $result->title ?></td>
			<td><?= $result->visible_in ?></td>
			<td>
				<a class="btn" href="<?= site_url('posts/edit/' . $result->id) ?>"><span class="icon-edit"></span> Editar</a>
				<a class="btn btn-danger" href="<?= site_url('posts/delete/' . $result->id) ?>" data-confirm="Tem certeza que deseja excluir o post"><span class="icon-remove icon-white"></span> Excluir</a>
			</td>
		</tr>
	<?php endforeach ?>
</table>