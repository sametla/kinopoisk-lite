<?php
/**
 * @var \App\Core\View\View $view
 * @var \App\Core\Session\Session $session
 */
?>

<?php $view->component('header') ?>

	<h1>Add Movie Page</h1>

	<form action="/admin/movies/add" method="post">
		<p>Name</p>
		<div>
			<input type="text" name="name">
		</div>
		<div>
			<button>Add</button>
		</div>
		<ul>
			<?php
            if ($session->has('name')) {
                foreach ($session->getFlash('name') as $error) { ?>
					<li style="color: red"><?php echo $error?></li>
				<?php }
                }?>
		</ul>
	</form>

<?php $view->component('footer') ?>