<?php
require __DIR__ . '/connect.php';
session_start();
$user_id = $_SESSION['id']; // je récupère l'id de l'utilisateur connecté

$req = $db->prepare("
	DELETE FROM `lecteur` WHERE id = :id;
	DELETE FROM `user` WHERE lecteur_id = :id
");

$req->bindValue(':id', $user_id, PDO::PARAM_INT);
$result = $req->execute();

if($result) {
	session_destroy(); // je détruis la session si la suppression de l'utilisateur est validée
	header('Location: index.php'); // je renvoie sur l'accueil
}
else {
	header('Location: delete_profil.php?msg=une erreur s\'est produite !');
}




