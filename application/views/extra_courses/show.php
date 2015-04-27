<h1>Showing Extra_course</h1>

<p>
	<strong>Title: </strong> <?= $extra_course->title ?>
</p>
	<p>
	<strong>Image: </strong>
    <?php if($extra_course->image): ?>
	<img src="<?= site_url(UPLOAD_PATH.'extra_courses/thumbs/' . $extra_course->image) ?>" alt=""/>
	<?php endif; ?>
</p>
		<p>
	<strong>Content: </strong> <?= $extra_course->content ?>
</p>
	<p>
	<strong>Payment_information: </strong> <?= $extra_course->payment_information ?>
</p>
	
<a class="btn" href="<?= site_url('extra_courses/edit/' . $extra_course->id) ?>">Edit</a>
<a class="btn" href="<?= site_url('extra_courses/') ?>">listing Extra_course</a>