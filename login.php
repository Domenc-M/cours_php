<form action="login_post.php" method="POST">
	<div>
		<label for="login">Login</label>
		<input id="login" type="text" name="login">
	</div>
	<div>
		<label for="password">Mot de passe</label>
		<div class="password_input">
			<input id="password" type="password" name="password">
			<i class="fas fa-eye pass_display pass_btn"></i>
			<i class="far fa-eye pass_hide pass_btn"></i>
		</div>
		
	</div>
	<button type="submit">Se connecter</button>
</form>