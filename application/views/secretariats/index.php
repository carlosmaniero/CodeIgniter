<h1>Listing Secretariats</h1>

<?php if(count($secretariats)): ?>
	<table class="table table-striped table-bordered">
		<tr>
			<th>ID</th>
			
			<th>Link_proposal</th>
			
			<th>Link_regiment</th>
						<td>
				<a class="btn btn-primary" href="<?= site_url('secretariats/insert') ?>"><span class="icon-plus icon-white"></span> New Secretariat</a>
				<a class="btn btn-inverse" href="<?= site_url('secretariats/trash') ?>"><span class="icon-trash icon-white"></span> Trash</a>
			</td>
		</tr>
		<?php foreach($secretariats as $secretariat): ?>
			<tr>
				<td><?= $secretariat->id ?></td>
				
				<td><?= $secretariat->link_proposal ?></td>
				
				<td><?= $secretariat->link_regiment ?></td>
								<td>
					<a class="btn" href="<?= site_url('secretariats/show/' . $secretariat->id) ?>"><span class="icon-eye-open"></span> Show</a>
					<a class="btn" href="<?= site_url('secretariats/edit/' . $secretariat->id) ?>"><span class="icon-edit"></span> Edit</a>
					<a class="btn btn-danger" href="<?= site_url('secretariats/delete/' . $secretariat->id) ?>" data-confirm="Are you sure you want to delete the secretariat"><span class="icon-remove icon-white"></span> Delete</a>
				</td>
			</tr>
		<?php endforeach ?>
	</table>
<?php else: ?>
	<p class="text-info">No secretariat registered</p>
	<a class="btn btn-primary" href="<?= site_url('secretariats/insert') ?>"><span class="icon-plus icon-white"></span> Include the first</a>
	<a class="btn btn-inverse" href="<?= site_url('secretariats/trash') ?>"><span class="icon-trash icon-white"></span> Trash</a>
<?php endif; ?>
