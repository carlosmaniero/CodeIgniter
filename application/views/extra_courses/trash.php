<h1>extra_courses on Trash</h1>

<?php if(count($extra_courses)): ?>
	<table class="table table-striped table-bordered">
		<tr>
			<th>ID</th>
			
			<th>Title</th>
			
			<th>Image</th>
			
			<th>Content</th>
			
			<th>Payment_information</th>
			
			<th>Deleted at</th>
			<td>
				<a class="btn btn-inverse" href="<?= site_url('extra_courses') ?>"><span class="icon-arrow-left icon-white"></span> Back</a>
			</td>
		</tr>
		<?php foreach($extra_courses as $extra_course): ?>
			<tr>
				<td><?= $extra_course->id ?></td>
				
				<td><?= $extra_course->title ?></td>
				
				<td><?= $extra_course->image ?></td>
				
				<td><?= $extra_course->content ?></td>
				
				<td><?= $extra_course->payment_information ?></td>
								<td><?= $extra_course->deleted_at ?></td>
				<td>
					<a class="btn" href="<?= site_url('extra_courses/recover/' . $extra_course->id) ?>"><span class="icon-repeat"></span> Recuperar</a>
					<a class="btn btn-danger" href="<?= site_url('extra_courses/delete_permanently/' . $extra_course->id) ?>" data-confirm="Tem certeza que deseja excluir definitivamente o extra_course? Essa ação não pode ser desfeita."><span class="icon-remove icon-white"></span> Excluir Definitivamente</a>
				</td>
			</tr>
		<?php endforeach ?>
	</table>
<?php else: ?>
	<p class="text-info">No items on trash</p>
	<a class="btn" href="<?= site_url('extra_courses') ?>">Back</a>
<?php endif ?>