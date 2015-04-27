<h1>Listing Banners</h1>

<?php if(count($banners)): ?>
	<table class="table table-striped table-bordered">
		<tr>
			<th>ID</th>
			
			<th>Images</th>
			
			<th>Title</th>
			
			<th>Description</th>
			
			<th>Link</th>
			
			<th>Order</th>
						<td>
				<a class="btn btn-primary" href="<?= site_url('banners/insert') ?>"><span class="icon-plus icon-white"></span> New Banner</a>
				<a class="btn btn-inverse" href="<?= site_url('banners/trash') ?>"><span class="icon-trash icon-white"></span> Trash</a>
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
								<td>
					<a class="btn" href="<?= site_url('banners/show/' . $banner->id) ?>"><span class="icon-eye-open"></span> Show</a>
					<a class="btn" href="<?= site_url('banners/edit/' . $banner->id) ?>"><span class="icon-edit"></span> Edit</a>
					<a class="btn btn-danger" href="<?= site_url('banners/delete/' . $banner->id) ?>" data-confirm="Are you sure you want to delete the banner"><span class="icon-remove icon-white"></span> Delete</a>
				</td>
			</tr>
		<?php endforeach ?>
	</table>
<?php else: ?>
	<p class="text-info">No banner registered</p>
	<a class="btn btn-primary" href="<?= site_url('banners/insert') ?>"><span class="icon-plus icon-white"></span> Include the first</a>
	<a class="btn btn-inverse" href="<?= site_url('banners/trash') ?>"><span class="icon-trash icon-white"></span> Trash</a>
<?php endif; ?>
