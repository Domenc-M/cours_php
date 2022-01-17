<?php
require __DIR__ . '/connect.php'; // connexion BDD
session_start(); // ouverture $_SESSION pour lire et créer des variables de session

$user_id = intval($_POST['user_id']); // on récupère l'ID de l'utilisateur choisi

mb_internal_encoding( "UTF-8" );
function mb_ucfirst($string) {
	$string = mb_strtolower($string); // remettre en minuscule toute la chaîne de caractère
	$string = mb_strtoupper(mb_substr($string, 0, 1)) . mb_substr($string, 1);
	return $string;
}
function sanitize($string) { // faille XSS
 	return htmlspecialchars(trim($string));
}

$msg_error = ''; // création de la variable des messages d'erreur. elle est vide et reste vide si pas d'erreur

$d = new DateTime('now', new DateTimeZone('EUROPE/Paris')); 
$d->sub(new DateInterval('P18Y'));
$majority_date = $d->format('Y-m-d');

// création d'un tableau avec les champs obligatoires si seulement certains champs sont requis

// $required_fields = array($_POST['email'],$_POST['nom']); 
// il faudra bien sur, remplacer $_POST par $required_fields dans la ligne ci-dessous

if(in_array('', $_POST)) { // je vérifie que tous les champs sont remplis
	$msg_error .= 'Merci de renseigner les champs manquants<br>';
}
else {
	$lastname 	= mb_strtoupper(sanitize($_POST['lastname']));
	$firstname 	= mb_ucfirst(sanitize($_POST['firstname']));
	$address 	= sanitize($_POST['address']);
	$zip_code 	= str_replace(' ','', sanitize($_POST['zip_code']));
	$born_date 	= sanitize($_POST['born_date']);
	$email 		= filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
	$role 		= intval($_POST['role']);
	$current_email = $_POST['current_email']; // champs input hidden qui correspond à l'email de l'utilisateur à l'affichage du DOM

	if(!is_numeric($zip_code) && strlen($zip_code) != 5) {
		$msg_error .= 'Merci de renseigner un code postal valide<br>';
	}
	if(strlen($born_date) != 10) { // 2022-01-04 soit 10 caractères et avec les heures et minutes
		$msg_error .= 'La date n\'a pas un format valide<br>';
	}
	elseif(strlen($born_date) == 10 && $born_date > $majority_date) {
		$msg_error .= 'Vous devez avoir 18 ans pour vous servir<br>';
	}
	if(!$email) { // si email === FALSE ==> résultat de : filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
		$msg_error .= 'Vous devez renseigner un email valide<br>';
	}
	elseif($current_email != $email) { // je regarde si l'email a été modifié et si oui, on vérifie qu'il n'existe pas déjà dans la base de données
		$req = $db->prepare("
			SELECT COUNT(*) AS count_email
			FROM user
			WHERE email = :email
		");
		$req->bindValue(':email', $email, PDO::PARAM_STR);
		$req->execute(); // execute car c'est une requête préparée
		$count = $req->fetchObject(); // je récupère les résultats

		// echo '<pre>';
		// var_dump($count);
		// echo '</pre>';
		$number_email = $count->count_email;
		if($number_email) { // si le résultat est supérieur à 0, sinon 0 == FALSE
			$msg_error .= 'Cet email existe déjà<br>';
		}
	}
}


if(!empty($msg_error)) { // $msg_error n'est pas vide donc erreur dans les conditions ci-dessus
	header('Location: update_profil_admin.php?msg=' . $msg_error . '&select_user_id=' . $user_id);
}
else {
	// 2 cas de figure
	// 1er : le lecteur n'est rattaché à aucun utilisateur
	if($current_email == 'none') {
		$request = "INSERT INTO user(email, password, lecteur_id, role_id) VALUES (:email, :password, :user_id, :role_id)";
		$pass_uniq = "webinar";
	}
	// 2eme cas : lecteur est bien rattaché à un utilisateur
	else {
		$request = "UPDATE user SET email = :email, role_id = :role_id WHERE lecteur_id = :user_id";
		$pass_uniq = FALSE;
	}
	$req = $db->prepare("
		UPDATE lecteur
		SET nom = :nom, prenom = :prenom, adresse = :adresse, code_postal = :code_postal, date_naissance = :date_naissance
		WHERE id = :user_id;
		$request
	");

	$req->bindValue(':nom',$lastname,PDO::PARAM_STR);
	$req->bindValue(':prenom',$firstname,PDO::PARAM_STR);
	$req->bindValue(':adresse',$address,PDO::PARAM_STR);
	$req->bindValue(':code_postal',$zip_code,PDO::PARAM_INT);
	$req->bindValue(':date_naissance',$born_date,PDO::PARAM_STR);
	$req->bindValue(':email',$email,PDO::PARAM_STR);
	$req->bindValue(':role_id',$role,PDO::PARAM_STR);
	$req->bindValue(':user_id',$user_id,PDO::PARAM_INT);
	if($pass_uniq) {
		$req->bindValue(':password',password_hash($pass_uniq, PASSWORD_DEFAULT),PDO::PARAM_STR);
	}

	$result = $req->execute();

	if($result) {
		header('Location: update_profil_admin.php?msg=Profil mis à jour !&select_user_id=' . $user_id);
	}
	else {
		header('Location: update_profil_admin.php?msg=Une erreur s\'est produite&select_user_id=' . $user_id);
	}
}
