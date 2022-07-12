<?php
	include 'index.php';
	include '../config.php';
	error_reporting(E_ERROR);
	if (!isset($_GET["username"]) || !isset($_GET["password"])) {
		echo("Missing fields!");
		return;
	}
	$username = $conn->real_escape_string(htmlspecialchars($_GET["username"]));
	$password = $conn->real_escape_string(htmlspecialchars($_GET["password"]));
	$existence = "SELECT * FROM users WHERE username = ?;";
	$stmt = $conn->stmt_init();
	if (!$stmt->prepare($existence)) {
		echo("Failed to prime statement!");
		return;
	} 
	$stmt->bind_param("s", $username);
	$results = $stmt->execute();
	$resulting_rows = $stmt->get_result();
	if ($resulting_rows->num_rows > 0) {
		echo("
			<div class='err-msg'>
				<p>Username is taken!</p>
			</div>
		");
		return;
	} 
	$insertion_preparer = $conn->stmt_init();
	$create_stmt = "INSERT INTO users(username, password) VALUES (?, ?);";
	$res = $insertion_preparer->prepare($create_stmt);
	if (!$res) {
		echo("Failed to prime statement!");
		return;
	} 
	$insertion_preparer->bind_param('ss', $username, password_hash($password, PASSWORD_DEFAULT));
	$insertion_preparer->execute();
	header('Location: /');
