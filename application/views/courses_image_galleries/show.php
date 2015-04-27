<h1>Showing Courses_image_gallery</h1>

<p>
	<strong>Image: </strong>
    <?php if($courses_image_gallery->image): ?>
	<img src="<?= site_url(UPLOAD_PATH.'courses_image_galleries/thumbs/' . $courses_image_gallery->image) ?>" alt=""/>
	<?php endif; ?>
</p>
		
<p>
	<strong>Extra_course ID</strong> <a href="<?= site_url('extra_courses/show/' .  $courses_image_gallery->extra_course_id) ?>"><?= $courses_image_gallery->extra_course_id ?></a>
</p>

<a class="btn" href="<?= site_url('courses_image_galleries/edit/' . $courses_image_gallery->id) ?>">Edit</a>
<a class="btn" href="<?= site_url('courses_image_galleries/') ?>">listing Courses_image_gallery</a>