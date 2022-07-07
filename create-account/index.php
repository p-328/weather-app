<!DOCTYPE html>
<html>

<head>
	<title>Create Account</title>
	<link rel="stylesheet" href="../assets/styles.css" type="text/css">
	<link rel="icon" href="../assets/WeatherMan!.png">
</head>

<body class='bg'>
	<div class='center'>
		<img src="../assets/WeatherMan!.png" class="logo">
		<h1>Create Account</h1>
		<form action="create.php" method="GET">
			<label>Username</label>
			<br>
			<input type="text" name="username" class="input-form-login" required>
			<br>
			<br>
			<label>Password</label>
			<br>
			<input type="password" name="password" class="input-form-login" required>
			<br>
			<br>
			<input type="submit" class="btn-submit-creation" value="Create account!">
		</form>
	</div>
</body>

</html>