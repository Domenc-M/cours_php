<?php
session_start();
require __DIR__ . '/connect.php';

$login = htmlentities(trim($_POST['login']));
$password = htmlentities(trim($_POST['password']));

if(in_array('', $_POST)) {
	$msg_error = '';
	if(empty($login)) {
		$msg_error .= 'Merci de renseigner votre login<br>';
	}
	if(empty($password)) {
		$msg_error .= 'Merci de renseigner votre mot de passe<br>';
	}
}
else {
	if(!filter_var($login, FILTER_VALIDATE_EMAIL)) {
		$msg_error .= 'Merci de renseigner un email valide<br>';
	}
	else {
		$req = $db->prepare("
			SELECT u.*, r.*
			FROM user u
			INNER JOIN role r
			ON u.role_id = r.id
			WHERE u.email = :email
		");
		$req->bindValue(':email', $login, PDO::PARAM_STR);
		$req->execute();

		$result = $req->fetchObject();
		// echo '<pre>';
		// var_dump($result);
		// echo '</pre>';
		if(!$result) {
			$msg_error = 'Votre login ou mot de passe est inconnu';
		}
		else {

			if(password_verify($password, $result->password)) {
				$msg_success = 'Vous êtes connecté';
			}
			else {
				$msg_error = 'Votre login ou mot de passe est inconnu';
			}
		}
	}
}

$no_connect = isset($msg_error);

$last_url = $_SERVER['HTTP_REFERER']; // url d'où je viens
if(strpos($last_url, '?') !== FALSE) {
	$req_get = strrchr($last_url, '?');
	$last_url = str_replace($req_get, '', $last_url);
}

if($no_connect) {
	header("Location: $last_url?msg=$msg_error");
}
else {
	$_SESSION['id'] 	= $result->lecteur_id;
	$_SESSION['role'] 	= $result->label;
	$_SESSION['email'] 	= $result->email;
	header("Location: $last_url?msg=$msg_success");

}