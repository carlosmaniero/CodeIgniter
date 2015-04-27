<h1>banners on Trash</h1>

<?php if(count($banners)): ?>
	<table class="table table-striped table-bordered">
		<tr>
			<th>ID</th>
			
			<th>Images</th>
			
			<th>Title</th>
			
			<th>Description</th>
			
			<th>Link</th>
			
			<th>Order</th>
			
			<th>Deleted at</th>
			<td>
				<a class="btn btn-inverse" href="<?= site_url('banners') ?>"><span class="icon-arrow-left icon-white"></span> Back</a>
			</td>
		</tr>
		<?php foreach($banners as $banner): ?>
			<tr>
				<td><?= $banner->id ?></td>
				
				<td><?= $banner->images ?></td>
				
				<td><?= $banner->title ?></td>
				
				<td><?= $banner->description ?></td>
				
				<td><?= $banner->link ?></td>
				
				<td><?= $banner->order ?></td>
								<td><?= $banner->deleted_at ?></td>
				<td>
					<a class="btn" href="<?= site_url('banners/recover/' . $banner->id) ?>"><span class="icon-repeat"></span> Recuperar</a>
					<a class="btn btn-danger" href="<?= site_url('banners/delete_permanently/' . $banner->id) ?>" data-confirm="Tem certeza que deseja excluir definitivamente o banner? Essa ação não pode ser desfeita."><span class="icon-remove icon-white"></span> Excluir Definitivamente</a>
				</td>
			</tr>
		<?php endforeach ?>
	</table>
<?php else: ?>
	<p class="text-info">No items on trash</p>
	<a class="btn" href="<?= site_url('banners') ?>">Back</a>
<?php endif ?>