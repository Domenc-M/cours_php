<?php
require __DIR__ . '/connect.php';
require __DIR__ . '/header.php';
$user_id = isset($_SESSION['id']) ? $_SESSION['id'] : FALSE;
if($user_id) :
?>
	<h1>Suppression de votre compte</h1>

	<div class="delete_user">Suppression du compte</div>

	<div class="pop_up_bg">
		<div class="pop_up_delete">
			<p>Vous êtes sur le point de supprimer votre compte</p>
			<div class="delete_response">
				<a href="<?php echo $host . '/delete_profil_get.php'; ?>">Supprimer</a>
				<div>Retour</div>
			</div>
		</div>
	</div>
<?php 
else : 
	header("Location: $host/index.php");
endif;
require __DIR__ . '/footer.php';