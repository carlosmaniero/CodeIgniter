<h1>Listing Periods</h1>

<?php if(count($periods)): ?>
	<table class="table table-striped table-bordered">
		<tr>
			<th>ID</th>
			
			<th>Name</th>
			
			<th>Description</th>
			
			<th>Image</th>
			
			<th>Video</th>
			
			<th>Link_products</th>
			
			<th>Link_services</th>
			
			<th>Link_documents</th>
			
			<th>Link_calendar</th>
			
			<th>Link_materials</th>
			
			<th>Link_bookstores</th>
			
			<th>Order</th>
						<td>
				<a class="btn btn-primary" href="<?= site_url('periods/insert') ?>"><span class="icon-plus icon-white"></span> New Period</a>
				<a class="btn btn-inverse" href="<?= site_url('periods/trash') ?>"><span class="icon-trash icon-white"></span> Trash</a>
			</td>
		</tr>
		<?php foreach($periods as $period): ?>
			<tr>
				<td><?= $period->id ?></td>
				
				<td><?= $period->name ?></td>
				
				<td><?= $period->description ?></td>
				
				<td><?= $period->image ?></td>
				
				<td><?= $period->video ?></td>
				
				<td><?= $period->link_products ?></td>
				
				<td><?= $period->link_services ?></td>
				
				<td><?= $period->link_documents ?></td>
				
				<td><?= $period->link_calendar ?></td>
				
				<td><?= $period->link_materials ?></td>
				
				<td><?= $period->link_bookstores ?></td>
				
				<td><?= $period->order ?></td>
								<td>
					<a class="btn" href="<?= site_url('periods/show/' . $period->id) ?>"><span class="icon-eye-open"></span> Show</a>
					<a class="btn" href="<?= site_url('periods/edit/' . $period->id) ?>"><span class="icon-edit"></span> Edit</a>
					<a class="btn btn-danger" href="<?= site_url('periods/delete/' . $period->id) ?>" data-confirm="Are you sure you want to delete the period"><span class="icon-remove icon-white"></span> Delete</a>
				</td>
			</tr>
		<?php endforeach ?>
	</table>
<?php else: ?>
	<p class="text-info">No period registered</p>
	<a class="btn btn-primary" href="<?= site_url('periods/insert') ?>"><span class="icon-plus icon-white"></span> Include the first</a>
	<a class="btn btn-inverse" href="<?= site_url('periods/trash') ?>"><span class="icon-trash icon-white"></span> Trash</a>
<?php endif; ?>
