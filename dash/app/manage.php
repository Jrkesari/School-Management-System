<?php
$title = "Manage";
require_once __DIR__ . '/../includes/database.php';
require_once __DIR__ . '/../includes/auth.php';
include_once __DIR__ . '/../includes/head.php';

session_start();
isLogged(true);

?>

<html lang="en" class="h-100">
<?php head($title); ?>

<body class="app">
	<div>
		<div class="row g-0">
			<div class="col">
				<?php include_once __DIR__ . '/components/sidebar/navbar.php'; ?>
			</div>
			<div class="col-10 container">
				<h1 class="display-6 mt-3">Manage Your Account</h1>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.php">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">
							<?= $title ?>
						</li>
					</ol>
				</nav>
				<hr />
				<table class="table">
					<tbody>
						<tr>
							<th scope="row">ID</th>
							<td>
								<?= $_SESSION['id'] ?>
							</td>
						</tr>
						<tr>
							<th scope="row">Username</th>
							<td>
								<?= $_SESSION['username'] ?>
							</td>
						</tr>
						<tr>
							<th scope="row">Email</th>
							<td>
								<?= $_SESSION['email'] ?>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>

</html>