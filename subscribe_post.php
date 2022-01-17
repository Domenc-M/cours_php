<?php
session_start();
require __DIR__ . '/connect.php';
var_dump($_POST);
mb_internal_encoding( "UTF-8" );
function mb_ucfirst($string) {
	$string = mb_strtolower($string); // remettre en minuscule toute la chaîne de caractère
	$string = mb_strtoupper(mb_substr($string, 0, 1)) . mb_substr($string, 1);
	return $string;
}
function sanitize($string) {
 return htmlspecialchars(trim($string));
 
}
$msg_error = '';

$d = new DateTime('now', new DateTimeZone('EUROPE/Paris'));
$d->sub(new DateInterval('P18Y'));
$majority_date = $d->format('Y-m-d');

// function pour nettoyer les numéros de téléphone
function validating($phone){
	$valid_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT); // 01 02 02 02 65 // jhkjfd45643-454 => 45643-454
	$valid_number = str_replace("-", "", $valid_number);
	$valid_number = str_replace(".", "", $valid_number);
	$valid_number = str_replace("+", "", $valid_number);
	if (strlen($valid_number) < 10 || strlen($valid_number) > 14) { // si +33606060606
		$valid_number = FALSE;
	}
	return $valid_number;
}

if(in_array('', $_POST)) {
	$msg_error .= 'Merci de renseigner les champs manquants<br>';
}
else {
	$lastname 	= mb_strtoupper(sanitize($_POST['lastname']));
	$firstname 	= mb_ucfirst(sanitize($_POST['firstname']));
	$address 	= sanitize($_POST['address']);
	$zip_code 	= str_replace(' ','', sanitize($_POST['zip_code']));
	$born_date 	= sanitize($_POST['born_date']);
	$email 		= filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
	$password 	= sanitize($_POST['password']);
	$role 		= $_SESSION['role'] == 'administrator' ? intval($_POST['role']) : 2;

	if(!is_numeric($zip_code) && strlen($zip_code) != 5) {
		$msg_error .= 'Merci de renseigner un code postal valide<br>';
	}
	if(strlen($born_date) != 10) {
		$msg_error .= 'La date n\'a pas un format valide<br>';
	}
	elseif(strlen($born_date) == 10 && $born_date > $majority_date) {
		$msg_error .= 'Vous devez avoir 18 ans pour vous servir<br>';
	}
	if(!$email) {
		$msg_error .= 'Vous devez renseigner un email valide<br>';
	}
	else {
		$req = $db->prepare("
			SELECT COUNT(*) AS count_email
			FROM user
			WHERE email = :email
		");
		$req->bindValue(':email', $email, PDO::PARAM_STR);
		$req->execute();
		$count = $req->fetchObject();

		$number_email = $count->count_email;
		var_dump($number_email);
		if($number_email) {
			$msg_error .= 'Cet email existe déjà<br>';
		}

	}
	if(strlen($password) < 6) {
		$msg_error .= 'Votre mot de passe doit comporter au moins 6 caractères<br>';
	}
}


if(!empty($msg_error)) {
	header('Location: subscribe.php?msg=' . $msg_error);
}
else {
	$req = $db->prepare("
		INSERT INTO lecteur(nom, prenom, adresse, code_postal, date_naissance) VALUES (:nom, :prenom, :adresse, :code_postal, :date_naissance);
		INSERT INTO user(email, password, lecteur_id, role_id) VALUES (:email, :password, LAST_INSERT_ID(), :role_id)
	");
	$req->bindValue(':nom', $lastname, PDO::PARAM_STR);
	$req->bindValue(':prenom', $firstname, PDO::PARAM_STR);
	$req->bindValue(':adresse', $address, PDO::PARAM_STR);
	$req->bindValue(':code_postal', $zip_code, PDO::PARAM_INT);
	$req->bindValue(':date_naissance', $born_date, PDO::PARAM_STR);
	$req->bindValue(':email', $email, PDO::PARAM_STR);
	$req->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
	$req->bindValue(':role_id', $role, PDO::PARAM_INT);

	$result = $req->execute();
	if($result) {
		header('Location: subscribe.php?msg=Profil bien créé !');
	}
	else {
		header('Location: subscribe.php?msg=Une erreur s\'est produite');
	}
}