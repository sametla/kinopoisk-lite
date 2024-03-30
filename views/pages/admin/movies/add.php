<?php
/**
 * @var \App\Core\View\View $view
 */
?>

<?php $view->component('header') ?>

<h1>Add Movie Page</h1>

<form action="/admin/movies/add" method="post">
	<p>Name</p>
	<div>
		<input type="text" name = "name">
	</div>
	<div>
		<button>Add</button>
	</div>
</form>

<?php $view->component('footer') ?>
