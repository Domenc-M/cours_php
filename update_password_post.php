<?php
require __DIR__ . '/connect.php';
session_start();

function sanitize($string) {
	return htmlspecialchars(trim($string));
}
$msg_error = '';

$pass_1 = sanitize($_POST['password']);
$pass_2 = sanitize($_POST['password2']);
$user_id = intval($_POST['user_id']);

if($pass_1 != $pass_2) {
	$msg_error .= 'Les 2 mots de passe ne sont pas identiques';
}
elseif(strlen($pass_1) < 6) {
	$msg_error .= 'Le mot de passe doit faire au moins 6 caractères';
}
else {
	$req = $db->prepare("
		SELECT password
		FROM user
		WHERE lecteur_id = :user_id
	");
	$req->bindValue(':user_id', (int)$user_id, PDO::PARAM_INT);
	$req->execute();

	$result = $req->fetch();

	if(password_verify($pass_1, $result['password'])) {
		$msg_error .= 'Le nouveau mot de passe doit être différent de l\'ancien';
	}
	else {
		$req = $db->prepare("
			UPDATE user
			SET password = :pass
			WHERE lecteur_id = :user_id
		");
		$req->bindValue(':pass', password_hash($pass_1, PASSWORD_DEFAULT) , PDO::PARAM_STR);
		$req->bindValue(':user_id', $user_id , PDO::PARAM_INT);

		$result = $req->execute();

		if($result) {
			$msg_success = 'Mot de passe mis à jour !';
		}
		else {
			$msg_error .= 'une erreur s\'est produite';
		}

	}
}
if(!empty($msg_error) ) {
	header('Location: update_password.php?msg=' . $msg_error);
}
else {
	header('Location: update_password.php?msg=' . $msg_success);
}
