<?php 
	
	session_start();

	include("connection.php");

	if (isset($_POST['submit'])){

		if ($_POST['submit'] == "Sign Up") {

			$error = "";

			if (!$_POST['email']) {
				$error .= "<br />Please enter your e-mail";
			}
			elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
				$error .= "<br />Please enter a valid e-mail address";
			}

			if (!$_POST['password']) {
				$error .= "<br />Please enter your password";
			}
			else {
				if (strlen($_POST['password'])<8) {
					$error .= "<br />Please enter a password with at lease 8 letters.";
				}
			}

			if ($error) echo "There were following error(s) in your Sign-Up details:".$error;
			else {

				$query = "SELECT * FROM user WHERE email='".mysqli_real_escape_string($link, $_POST['email'])."'";
				$result = mysqli_query($link, $query);
				// echo $results = mysqli_num_rows($result);
				$results = mysqli_num_rows($result);

				if ($results)	echo "This email is already registered. Do you want to Sign-In?";
				else {
					$query = "INSERT INTO user (email,password) VALUES('".mysqli_real_escape_string($link, $_POST['email'])."' , '". md5(md5($_POST['email']).$_POST['password'])."')";
					if (mysqli_query($link, $query))	echo "You have successfully Signed-Up!";
					// else echo "Error: " . $query . "<br>" . mysqli_error($link);

					$_SESSION['id'] = mysqli_insert_id($link);

					// print_r($_SESSION);

					// redirect to logged in page.

				}

			}

		}

		if ($_POST['submit'] == "Sign In") {

			$error = "";

			if (!$_POST['signinemail']) {
				$error .= "<br />Please enter your e-mail";
			}
			elseif (!filter_var($_POST['signinemail'], FILTER_VALIDATE_EMAIL)) {
				$error .= "<br />Please enter a valid e-mail address";
			}

			if (!$_POST['signinpassword']) {
				$error .= "<br />Please enter your password";
			}

			if ($error) echo "There were following error(s) in your Sign-In details:".$error;
			else {

				$query = "SELECT  * FROM user WHERE email='".mysqli_real_escape_string($link, $_POST['signinemail'])."' AND password = '".md5(md5($_POST['signinemail']).$_POST['signinpassword'])."' LIMIT 1";
				// echo $query;
				$result = mysqli_query($link, $query);
				$row = mysqli_fetch_array($result);

				if ($row) {
					$_SESSION['id'] = $row['id'];
				}
				else {
					echo "Could not find user with given email and password. Please try again.";
				}
			}

		}

	}

?>
