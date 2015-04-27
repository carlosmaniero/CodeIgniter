<h1>periods on Trash</h1>

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
			
			<th>Deleted at</th>
			<td>
				<a class="btn btn-inverse" href="<?= site_url('periods') ?>"><span class="icon-arrow-left icon-white"></span> Back</a>
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
								<td><?= $period->deleted_at ?></td>
				<td>
					<a class="btn" href="<?= site_url('periods/recover/' . $period->id) ?>"><span class="icon-repeat"></span> Recuperar</a>
					<a class="btn btn-danger" href="<?= site_url('periods/delete_permanently/' . $period->id) ?>" data-confirm="Tem certeza que deseja excluir definitivamente o period? Essa ação não pode ser desfeita."><span class="icon-remove icon-white"></span> Excluir Definitivamente</a>
				</td>
			</tr>
		<?php endforeach ?>
	</table>
<?php else: ?>
	<p class="text-info">No items on trash</p>
	<a class="btn" href="<?= site_url('periods') ?>">Back</a>
<?php endif ?>