<?php 

	if (isset($_POST['submit'])) {

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
				mysqli_query($link, $query);
				echo "You've been signed up!";
			}
		}

		if ($error) echo "There were following error(s) in your Sign-Up details:".$error;
		else {

			$link = mysqli_connect("localhost","root","password","diaryDB");
			$query = "SELECT * FROM user WHERE email='".mysqli_real_escape_string($link, $_POST['email'])."'";
			$result = mysqli_query($link, $query);
			// echo $results = mysqli_num_rows($result);
			$results = mysqli_num_rows($result);

			if ($results)	echo "This email is already registered. Do you want to Sign-In?";
			else {
				$query = "INSERT INTO user (email,password) VALUES('".mysqli_real_escape_string($link, $_POST['email'])."' , '". md5(md5($_POST['email']).$_POST['password'])."')";
				if (mysqli_query($link, $query))	echo "You have successfully Signed-Up!";
				else echo "Error: " . $query . "<br>" . mysqli_error($link);
			}

		}

	}

?>

<form method="POST" novalidate>

	<input type="email" name="email" id="email" />
	<input type="password" name="password" id="password" />
	<input type="submit" name="submit" value="Sign Up" />

</form>