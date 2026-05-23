<?php
/**
 * Shared auth + escaping helpers.
 * Include after config.php so $connect is available for db_escape().
 */

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

/** Redirect to login if no session. */
function require_login($redirect = 'login.php') {
	if (empty($_SESSION['username'])) {
		header("Location: $redirect");
		exit;
	}
}

/** Redirect to home if not admin. */
function require_admin($redirect = '../index.php') {
	require_login($redirect);
	if (($_SESSION['level'] ?? '') !== 'admin') {
		header("Location: $redirect");
		exit;
	}
}

/** HTML-escape for safe echo into pages. */
function e($s) {
	return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
}

/** SQL-escape a string (call after $connect is established). */
function db_escape($s) {
	global $connect;
	return mysqli_real_escape_string($connect, (string)$s);
}

/** Cast to int safely for IDs in SQL. */
function as_int($v) {
	return (int)$v;
}

/** Get current session username, or empty string. */
function current_user() {
	return $_SESSION['username'] ?? '';
}
?>
