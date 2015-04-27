<h1>secretariats on Trash</h1>

<?php if(count($secretariats)): ?>
	<table class="table table-striped table-bordered">
		<tr>
			<th>ID</th>
			
			<th>Link_proposal</th>
			
			<th>Link_regiment</th>
			
			<th>Deleted at</th>
			<td>
				<a class="btn btn-inverse" href="<?= site_url('secretariats') ?>"><span class="icon-arrow-left icon-white"></span> Back</a>
			</td>
		</tr>
		<?php foreach($secretariats as $secretariat): ?>
			<tr>
				<td><?= $secretariat->id ?></td>
				
				<td><?= $secretariat->link_proposal ?></td>
				
				<td><?= $secretariat->link_regiment ?></td>
								<td><?= $secretariat->deleted_at ?></td>
				<td>
					<a class="btn" href="<?= site_url('secretariats/recover/' . $secretariat->id) ?>"><span class="icon-repeat"></span> Recuperar</a>
					<a class="btn btn-danger" href="<?= site_url('secretariats/delete_permanently/' . $secretariat->id) ?>" data-confirm="Tem certeza que deseja excluir definitivamente o secretariat? Essa ação não pode ser desfeita."><span class="icon-remove icon-white"></span> Excluir Definitivamente</a>
				</td>
			</tr>
		<?php endforeach ?>
	</table>
<?php else: ?>
	<p class="text-info">No items on trash</p>
	<a class="btn" href="<?= site_url('secretariats') ?>">Back</a>
<?php endif ?>