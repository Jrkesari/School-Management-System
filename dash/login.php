<?php
require_once __DIR__ . '/includes/app.php';
require_once __DIR__ . '/includes/database.php';
require_once __DIR__ . '/includes/auth.php';
include_once __DIR__ . '/includes/head.php';

session_start();
isLogged(false);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {

	if (isset($_POST['username']) || isset($_POST['password'])) {
		$username = trim($_POST['username']);
		$password = $_POST['password'];
		$q = mysqli_query($db, "SELECT * FROM users WHERE username='${username}'");
		$data = mysqli_fetch_array($q);

		if (mysqli_num_rows($q) > 0 && password_verify($password, $data['password'])) {
			$_SESSION['valid'] = true;
			$_SESSION['id'] = $data['id'];
			$_SESSION['email'] = $data['email'];
			$_SESSION['username'] = $username;
			$_SESSION['type'] = $data['user_type'];
			header("location:" . BASE_PATH . "app/index.php");
			exit;
		} else {
			$error = '<div class="alert alert-danger" role="alert">Invalid Login</div>';
		}
	}
}

?>

<!doctype html>
<html lang="en" class="h-100">
<?php head('Login'); ?>

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
				<a href="register.php" class="nav-button">Register</a>
			</div>
		</div>
	</div>

	<div class="container-custom align-items-center text-center">
		<div class="row justify-content-center ">
			<div class="col-md-6">
				<form method="POST">
					<h1 class="h3 mb-3 fw-normal">Please sign in</h1>

					<?= isset($error) ? $error : '' ?>


						<div class="form-floating">
							<input type="text" class="form-control" id="username" placeholder="Username" name="username"
								required />
							<label for="username">Username</label>
						</div>

						<div class="form-floating my-2">
							<input type="password" class="form-control" id="password" placeholder="Password"
								name="password" required />
							<label for="password">Password</label>
						</div>

						<button class="w-100 btn btn-primary fw-semibold" type="submit" name="login">
							Sign in
						</button>
				</form>
			</div>
		</div>
	</div>
</body>

</html>