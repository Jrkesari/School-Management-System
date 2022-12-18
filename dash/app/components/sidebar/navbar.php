<nav class="vh-100 p-2" id="sidebar">
	<div class="text-white text-center">
		<a href="../../" style="text-decoration: none; color: white;"><h3>School</h3></a>
	</div>
	<div class="list-group">
		<a href="index.php" class="list-group-item list-group-item-action <?= $title == 'Home' ? 'active' : '' ?>">
			Home
		</a>

		<?php if ($_SESSION['type'] === "0") { ?>
		<a href="marksheet.php"
			class="list-group-item list-group-item-action <?= $title == 'Marksheet' ? 'active' : '' ?>">
			Marksheet
		</a>
		<?php } else { ?>
		<a href="users.php" class="list-group-item list-group-item-action <?= $title == 'Users' ? 'active' : '' ?>">
			Users
		</a>
		<?php } ?>

		<a href="manage.php" class="list-group-item list-group-item-action <?= $title == 'Manage' ? 'active' : '' ?>">
			Manage Account
		</a>

		<a href="logout.php" class="list-group-item list-group-item-action">
			Logout
		</a>
	</div>
</nav>