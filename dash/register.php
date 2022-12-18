<?php
include_once __DIR__ . '/includes/head.php';
require_once __DIR__ . '/includes/database.php';
require_once __DIR__ . '/includes/auth.php';

session_start();
isLogged(false);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {

	if (isset($_POST['username']) || isset($_POST['email']) || isset($_POST['password'])) {
		$username = trim($_POST['username']);
		$email = trim($_POST['email']);
		$password = $_POST['password'];

		// Username exists
		if (mysqli_num_rows(mysqli_query($db, "SELECT * FROM users WHERE username='${username}'")) > 0) {
			$resp = '<div class="alert alert-danger" role="alert">Username is taken</div>';
		}

		// Email exists
		else if (mysqli_num_rows(mysqli_query($db, "SELECT * FROM users WHERE email='${email}'")) > 0) {
			$resp = '<div class="alert alert-danger" role="alert">Email is taken</div>';
		} else {
			$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

			if (mysqli_query($db, "INSERT INTO users (username, email, password) VALUES ('${username}', '${email}', '${hashedPassword}')") === TRUE) {
				$user = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM users WHERE username='${username}'"));
				mysqli_query($db, "INSERT INTO `grades`(`id`, `english`, `math`, `chemistry`, `physics`, `bio`, `studentId`) VALUES ('0','0','0','0','0','0','${user['id']}')");
				$resp = '<div class="alert alert-success" role="alert">Account created successfully.</div>';
			} else {
				$resp = '<div class="alert alert-danger" role="alert">${mysqli_error($db)}</div>';
			}
		}
	}
}

?>

<!doctype html>
<html lang="en" class="h-100">
<?php head('Register'); ?>

<body class="h-100">
<div class="nav">
		<div class="nav-container w-100">
			<div class="nav-brand">School</div>
			<div class="nav-main centered">
				<nav>
					<a href="../index.html">Home</a>
					<a href="../about.html">About Us</a>
					<a href="../placement.html">Placements</a>
				</nav>
			</div>
			<div class="nav-secondary">
				<a href="login.php" class="nav-button">Login</a>
			</div>
		</div>
	</div>

	<div class="container-custom align-items-center text-center">
		<div class="row justify-content-center ">
			<div class="col-md-6">
				<form method="POST">
					<h1 class="h3 mb-3 fw-normal">Get started!</h1>

					<?= isset($resp) ? $resp : '' ?>

						<div class="form-floating">
							<input type="text" class="form-control" id="username" placeholder="Username" name="username"
								required />
							<label for="username">Username</label>
						</div>

						<div class="form-floating mt-2">
							<input type="email" class="form-control" id="email" placeholder="Email" name="email"
								required />
							<label for="email">Email</label>
						</div>

						<div class="form-floating my-2">
							<input type="password" class="form-control" id="password" placeholder="Password"
								name="password" required />
							<label for="password">Password</label>
						</div>

						<button class="w-100 btn btn-primary fw-semibold" type="submit" name="register">
							Create Account
						</button>
				</form>
			</div>
		</div>
	</div>
</body>

</html>