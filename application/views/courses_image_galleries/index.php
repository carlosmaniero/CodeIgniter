<h1>Listing Courses_image_galleries</h1>

<?php if(count($courses_image_galleries)): ?>
	<table class="table table-striped table-bordered">
		<tr>
			<th>ID</th>
			
			<th>Image</th>
			
			<th>Extra_course ID</th>
						<td>
				<a class="btn btn-primary" href="<?= site_url('courses_image_galleries/insert') ?>"><span class="icon-plus icon-white"></span> New Courses_image_gallery</a>
				<a class="btn btn-inverse" href="<?= site_url('courses_image_galleries/trash') ?>"><span class="icon-trash icon-white"></span> Trash</a>
			</td>
		</tr>
		<?php foreach($courses_image_galleries as $courses_image_gallery): ?>
			<tr>
				<td><?= $courses_image_gallery->id ?></td>
				
				<td><?= $courses_image_gallery->image ?></td>
				
				<td>
					<a href="<?= site_url('extra_courses/show/' . $courses_image_gallery->extra_course_id) ?>"><?= $courses_image_gallery->extra_course_id ?></a>
				</td>
								<td>
					<a class="btn" href="<?= site_url('courses_image_galleries/show/' . $courses_image_gallery->id) ?>"><span class="icon-eye-open"></span> Show</a>
					<a class="btn" href="<?= site_url('courses_image_galleries/edit/' . $courses_image_gallery->id) ?>"><span class="icon-edit"></span> Edit</a>
					<a class="btn btn-danger" href="<?= site_url('courses_image_galleries/delete/' . $courses_image_gallery->id) ?>" data-confirm="Are you sure you want to delete the courses_image_gallery"><span class="icon-remove icon-white"></span> Delete</a>
				</td>
			</tr>
		<?php endforeach ?>
	</table>
<?php else: ?>
	<p class="text-info">No courses_image_gallery registered</p>
	<a class="btn btn-primary" href="<?= site_url('courses_image_galleries/insert') ?>"><span class="icon-plus icon-white"></span> Include the first</a>
	<a class="btn btn-inverse" href="<?= site_url('courses_image_galleries/trash') ?>"><span class="icon-trash icon-white"></span> Trash</a>
<?php endif; ?>
