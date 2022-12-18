<?php
$title = "Marksheet";
require_once __DIR__ . '/../includes/database.php';
require_once __DIR__ . '/../includes/auth.php';
include_once __DIR__ . '/../includes/head.php';

session_start();
isLogged(true);
isStudent();

$grades = mysqli_query($db, "SELECT * FROM grades WHERE studentId={$_SESSION['id']}");
$data = mysqli_fetch_array($grades);
$total = $data['english'] + $data['math'] + $data['chemistry'] + $data['physics'] + $data['bio'];
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
				<h1 class="display-6 mt-3">View Your Marksheet</h1>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.php">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">
							<?= $title ?>
						</li>
					</ol>
				</nav>
				<hr />
				<?php if ($total === 0): ?>
				<div class="alert alert-secondary">
					Not Graded
				</div>
				<?php else: ?>
				<table class="table">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Subject</th>
							<th scope="col">Marks</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="row">1</th>
							<td>English</td>
							<td>
								<?= $data['english'] ?>
							</td>
						</tr>
						<tr>
							<th scope="row">2</th>
							<td>Math</td>
							<td>
								<?= $data['math'] ?>
							</td>
						</tr>
						<tr>
							<th scope="row">3</th>
							<td>Chemistry</td>
							<td>
								<?= $data['chemistry'] ?>
							</td>
						</tr>
						<tr>
							<th scope="row">4</th>
							<td>Physics</td>
							<td>
								<?= $data['physics'] ?>
							</td>
						</tr>
						<tr>
							<th scope="row">5</th>
							<td>Bio</td>
							<td>
								<?= $data['bio'] ?>
							</td>
						</tr>
						<tr class="table-active rounded">
							<th colspan="2" scope="row">Total: </th>
							<td>
								<?= $total ?>
							</td>
						</tr>
						<tr>
							<td colspan="2"></td>
							<td>
								<?= $total > 175 ? "Pass" : "Fail" ?>
							</td>
						</tr>
					</tbody>
				</table>
				<?php endif ?>
			</div>
		</div>
	</div>
</body>

</html>