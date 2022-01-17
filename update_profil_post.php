<?php
require __DIR__ . '/connect.php';
session_start();

$current_email = $_SESSION['email'];
$user_id = intval($_POST['user_id']); // ou $_SESSION['id']

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
	elseif($current_email != $email) {
		$req = $db->prepare("
			SELECT COUNT(*) AS count_email
			FROM user
			WHERE email = :email
		");
		$req->bindValue(':email', $email, PDO::PARAM_STR);
		$req->execute();
		$count = $req->fetchObject();

		$number_email = $count->count_email;
		if($number_email) {
			$msg_error .= 'Cet email existe déjà<br>';
		}
	}
}


if(!empty($msg_error)) {
	header('Location: update_profil.php?msg=' . $msg_error);
}
else {
	$req = $db->prepare("
		UPDATE lecteur
		SET nom = :nom, prenom = :prenom, adresse = :adresse, code_postal = :code_postal, date_naissance = :date_naissance
		WHERE id = :user_id;
		UPDATE user
		SET email = :email
		WHERE lecteur_id = :user_id
	");

	$req->bindValue(':nom',$lastname,PDO::PARAM_STR);
	$req->bindValue(':prenom',$firstname,PDO::PARAM_STR);
	$req->bindValue(':adresse',$address,PDO::PARAM_STR);
	$req->bindValue(':code_postal',$zip_code,PDO::PARAM_INT);
	$req->bindValue(':date_naissance',$born_date,PDO::PARAM_STR);
	$req->bindValue(':email',$email,PDO::PARAM_STR);
	$req->bindValue(':user_id',$user_id,PDO::PARAM_INT);

	$result = $req->execute();

	if($result) {
		header('Location: update_profil.php?msg=Profil mis à jour !');
	}
	else {
		header('Location: update_profil.php?msg=Une erreur s\'est produite');
	}
}
