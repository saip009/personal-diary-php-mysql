<? include("signing.php") ?>


<form method="POST" novalidate>

	<input type="email" name="email" id="email" value="<?php echo isset($_POST['email']) ? addslashes($_POST['email']) : ''; ?>" />
	<input type="password" name="password" id="password" value="<?php echo isset($_POST['password']) ? addslashes($_POST['password']) : ''; ?>" />
	<input type="submit" name="submit" value="Sign Up" />

</form>


<form method="POST" novalidate>

	<input type="email" name="signinemail" id="signinemail" value="<?php echo isset($_POST['email']) ? addslashes($_POST['email']) : ''; ?>" />
	<input type="password" name="signinpassword" id="signinpassword" value="<?php echo isset($_POST['password']) ? addslashes($_POST['password']) : ''; ?>" />
	<input type="submit" name="submit" value="Sign In" />

</form>