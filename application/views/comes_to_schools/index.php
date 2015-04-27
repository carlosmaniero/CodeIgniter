<h1>Listing Comes_to_schools</h1>

<?php if(count($comes_to_schools)): ?>
	<table class="table table-striped table-bordered">
		<tr>
			<th>ID</th>
			
			<th>Name</th>
			
			<th>Mail</th>
			
			<th>Phone</th>
			
			<th>Near_to_school</th>
			
			<th>Loking_for</th>
						<td>
				<a class="btn btn-primary" href="<?= site_url('comes_to_schools/insert') ?>"><span class="icon-plus icon-white"></span> New Comes_to_school</a>
				<a class="btn btn-inverse" href="<?= site_url('comes_to_schools/trash') ?>"><span class="icon-trash icon-white"></span> Trash</a>
			</td>
		</tr>
		<?php foreach($comes_to_schools as $comes_to_school): ?>
			<tr>
				<td><?= $comes_to_school->id ?></td>
				
				<td><?= $comes_to_school->name ?></td>
				
				<td><?= $comes_to_school->mail ?></td>
				
				<td><?= $comes_to_school->phone ?></td>
				
				<td><?= $comes_to_school->near_to_school ?></td>
				
				<td><?= $comes_to_school->loking_for ?></td>
								<td>
					<a class="btn" href="<?= site_url('comes_to_schools/show/' . $comes_to_school->id) ?>"><span class="icon-eye-open"></span> Show</a>
					<a class="btn" href="<?= site_url('comes_to_schools/edit/' . $comes_to_school->id) ?>"><span class="icon-edit"></span> Edit</a>
					<a class="btn btn-danger" href="<?= site_url('comes_to_schools/delete/' . $comes_to_school->id) ?>" data-confirm="Are you sure you want to delete the comes_to_school"><span class="icon-remove icon-white"></span> Delete</a>
				</td>
			</tr>
		<?php endforeach ?>
	</table>
<?php else: ?>
	<p class="text-info">No comes_to_school registered</p>
	<a class="btn btn-primary" href="<?= site_url('comes_to_schools/insert') ?>"><span class="icon-plus icon-white"></span> Include the first</a>
	<a class="btn btn-inverse" href="<?= site_url('comes_to_schools/trash') ?>"><span class="icon-trash icon-white"></span> Trash</a>
<?php endif; ?>
