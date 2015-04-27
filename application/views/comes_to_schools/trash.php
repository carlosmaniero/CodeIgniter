<h1>comes_to_schools on Trash</h1>

<?php if(count($comes_to_schools)): ?>
	<table class="table table-striped table-bordered">
		<tr>
			<th>ID</th>
			
			<th>Name</th>
			
			<th>Mail</th>
			
			<th>Phone</th>
			
			<th>Near_to_school</th>
			
			<th>Loking_for</th>
			
			<th>Deleted at</th>
			<td>
				<a class="btn btn-inverse" href="<?= site_url('comes_to_schools') ?>"><span class="icon-arrow-left icon-white"></span> Back</a>
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
								<td><?= $comes_to_school->deleted_at ?></td>
				<td>
					<a class="btn" href="<?= site_url('comes_to_schools/recover/' . $comes_to_school->id) ?>"><span class="icon-repeat"></span> Recuperar</a>
					<a class="btn btn-danger" href="<?= site_url('comes_to_schools/delete_permanently/' . $comes_to_school->id) ?>" data-confirm="Tem certeza que deseja excluir definitivamente o comes_to_school? Essa ação não pode ser desfeita."><span class="icon-remove icon-white"></span> Excluir Definitivamente</a>
				</td>
			</tr>
		<?php endforeach ?>
	</table>
<?php else: ?>
	<p class="text-info">No items on trash</p>
	<a class="btn" href="<?= site_url('comes_to_schools') ?>">Back</a>
<?php endif ?>