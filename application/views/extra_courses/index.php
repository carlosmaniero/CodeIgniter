<h1>Listing Extra_courses</h1>

<?php if(count($extra_courses)): ?>
	<table class="table table-striped table-bordered">
		<tr>
			<th>ID</th>
			
			<th>Title</th>
			
			<th>Image</th>
			
			<th>Content</th>
			
			<th>Payment_information</th>
						<td>
				<a class="btn btn-primary" href="<?= site_url('extra_courses/insert') ?>"><span class="icon-plus icon-white"></span> New Extra_course</a>
				<a class="btn btn-inverse" href="<?= site_url('extra_courses/trash') ?>"><span class="icon-trash icon-white"></span> Trash</a>
			</td>
		</tr>
		<?php foreach($extra_courses as $extra_course): ?>
			<tr>
				<td><?= $extra_course->id ?></td>
				
				<td><?= $extra_course->title ?></td>
				
				<td><?= $extra_course->image ?></td>
				
				<td><?= $extra_course->content ?></td>
				
				<td><?= $extra_course->payment_information ?></td>
								<td>
					<a class="btn" href="<?= site_url('extra_courses/show/' . $extra_course->id) ?>"><span class="icon-eye-open"></span> Show</a>
					<a class="btn" href="<?= site_url('extra_courses/edit/' . $extra_course->id) ?>"><span class="icon-edit"></span> Edit</a>
					<a class="btn btn-danger" href="<?= site_url('extra_courses/delete/' . $extra_course->id) ?>" data-confirm="Are you sure you want to delete the extra_course"><span class="icon-remove icon-white"></span> Delete</a>
				</td>
			</tr>
		<?php endforeach ?>
	</table>
<?php else: ?>
	<p class="text-info">No extra_course registered</p>
	<a class="btn btn-primary" href="<?= site_url('extra_courses/insert') ?>"><span class="icon-plus icon-white"></span> Include the first</a>
	<a class="btn btn-inverse" href="<?= site_url('extra_courses/trash') ?>"><span class="icon-trash icon-white"></span> Trash</a>
<?php endif; ?>
