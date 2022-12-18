<?php
$title = "Users";
require_once __DIR__ . '/../includes/database.php';
require_once __DIR__ . '/../includes/auth.php';
include_once __DIR__ . '/../includes/head.php';

session_start();
isLogged(true);
isTeacher();

$users = mysqli_query($db, "SELECT * FROM users");
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
				<h1 class="display-6 mt-3">View Users Info</h1>
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
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Username</th>
							<th scope="col">Role</th>
							<th scope="col">Email</th>
							<th scope="col">Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($users as $user):
	                        $link = 'update.php?id=' . $user["id"] ?>

						<tr>
							<th scope="row">
								<?= $user['id'] ?>
							</th>
							<td>
								<?= $user['username'] ?>
							</td>
							<td>
								<span class="badge rounded-pill text-bg-primary">
									<?= $user['user_type']==="1" ? "Teacher" : "Student" ?>
								</span>
							<td>
								<?= $user['email'] ?>
							</td>
							<td>
								<?= $user['user_type']==="1" ? "" : "<a href='$link' class='link-primary'>Edit</a>" ?>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>

</html>