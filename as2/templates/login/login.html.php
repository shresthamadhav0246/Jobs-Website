<main class="sidebar">
<section class="left">
		<ul>
	
			<li><a href="/job/list">Jobs</a></li>

		</ul>
	</section>

	<section class="right">
      
    <h2>Login </h2>
  
	
<?php
if (isset($errorMessage)):
echo '<div class="errors">Sorry, your username and password could not be found.</div>';
endif;
?>

<form method="post" action="">
<label for="email">Your email address</label>
<input type="text" id="email" name="email">
<label for="password">Your password</label>
<input type="password" id="password" name="password">
<input type="submit" name="login" value="Log in">
</form>
<p>Don't have an account? <a href="/user/edit">Click here to register</a></p>

</section>
</main>