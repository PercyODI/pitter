<?php
	session_start();
	include_once("header.php");
	include_once("functions.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h1>List of Users</h1>
	<?php
		$users = show_users();
		$following = following($_SESSION['userid']);

		if(count($users)) {
			echo "<table border='1' cellspacing='0' cellpadding='5' width='500'>";
			foreach ($users as $key => $value) {
				echo "<tr valign='top'>\n";
				echo "<td>" . $key . "</td>\n";
				echo "<td>" . $value;
				if(in_array($key, $following)) {
					echo "<small>
						<a href='action.php?id=$key&do=unfollow'>unfollow</a>
						</small>";
				}
				else {
					echo "<small>
						<a href='action.php?id=$key&do=follow'>follow</a>
						</small>";
				}
				echo "</td>\n";
				echo "</tr>\n";
			}
			echo "</table>";
		}
		else {
			echo "<p><b>There are no users in the system!</b></p>";
		}
	?>
</body>
</html>