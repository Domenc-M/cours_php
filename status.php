<?php
require __DIR__ . '/connect.php';
require __DIR__ . '/header.php';

function french_date($interval) {
	$year 	= $interval->y;
	$month 	= $interval->m;
	$day 	= $interval->d;
	$hour 	= $interval->h;
	$minute = $interval->i;

	$result = '';

	if($year == 1) {
		$result .= $year . ' année, ';
	}
	elseif($year > 1) {
		$result .= $year . ' années, ';
	}
	if($month >= 1) {
		$result .= $month . ' mois, ';
	}
	if($day == 1) {
		$result .= $day . ' jour, ';
	}
	elseif($day > 1) {
		$result .= $day . ' jours, ';
	}
	if($hour == 1) {
		$result .= $hour . ' heure et ';
	}
	elseif($hour > 1) {
		$result .= $hour . ' heures et ';
	}
	
	if($minute == 1) {
		$result .= $minute . ' minute, ';
	}
	elseif($minute > 1) {
		$result .= $minute . ' minutes, ';
	}
	return $result;
}
// var_dump(($_GET['id']));
// echo '<br>';
// je vérifie si l'id dans l'url est bien un id, sinon, on essaie de me niquer
$livre_id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : FALSE;
// var_dump($livre_id);
if($livre_id) : // on me nique pas
	$req = $db->prepare("
		SELECT l.*, i.id picture, a.nom auteur_nom, a.prenom auteur_prenom, a.date_naissance auteur_date, a.pays_id, g.libelle,le.*, p.intitule
		FROM livre l
		LEFT JOIN auteur a 
		ON l.auteur_id = a.id 
		LEFT JOIN genre g 
		ON l.genre_id = g.id
		LEFT JOIN illustration i 
		ON l.illustration_id = i.id
		LEFT JOIN lecteur le 
		ON l.lecteur_id = le.id
		LEFT JOIN pays p 
		ON a.pays_id = p.id
		WHERE l.id = :id
	");
	$req->bindValue(':id', $livre_id, PDO::PARAM_INT);
	$req->execute();
	// $req->execute(array(':id' => $livre_id));
	$results = $req->fetchAll(PDO::FETCH_OBJ);

	echo '<section id="details">';
	foreach($results as $result) : ?>
		<h1>Détails du Livre : <?= $result->titre; ?></h1>
		<div class="details">
			<div class="float_left">
				<img src="<?= "./couvertures/{$result->picture}.jpg"; ?>" alt="<?= $result->titre; ?>">
			</div>
			<p><span>Titre : </span><?= $result->titre; ?></p>
			<p><span>Auteur : </span><?= $result->auteur_prenom . ' ' . $result->auteur_nom; ?></p>
			<?php $birthday = new DateTime($result->auteur_date); ?>
			<p><span>Date de naissance : </span><?= $birthday->format('j/m/Y'); ?></p>
			<p><span>Genre : </span><?= $result->libelle; ?></p>
			<p><span>Pays : </span><?= $result->intitule ?></p>
			<p><span>Année : </span><?= $result->annee; ?></p>
			<p><span>ISBN : </span><?= $result->isbn; ?></p>
			<p><span>Résumé : </span><?= $result->resume; ?></p>
		</div>
		<div class="status">
			<?php
			if($result->lecteur_id) : ?>
				<?php $dating = new DateTime($result->date_emprunt, new DateTimeZone('EUROPE/Paris')); ?>
				<?php $now = new DateTime('now', new DateTimeZone('EUROPE/Paris')); ?>
				<?php $diff = $dating->diff($now); ?>
				<div class="identity">
					<h2>Détails du lecteur</h2>
					<p><span>Prénom Nom : </span><?= $result->prenom . ' ' . $result->nom; ?></p>
					<p><span>Adresse : </span><?= $result->adresse; ?></p>
					<p><span>Code postal : </span><?= $result->code_postal; ?></p>
					<p><span>Date de l'emprunt : </span><?= $dating->format('j/m/Y'); ?></p>
					<p>Livre emprunté depuis : <?php echo french_date($diff); ?></p>
				</div>
			<?php else : ?>
				<p class="dispo">Livre disponible</p>			
			<?php endif; ?>
		</div>
		
	<?php
	endforeach;
	echo '</section>';
	echo '<br><br><br><br><br><br>';
else : // on me nique
	echo '<h1>T\'as voulu me niquer ?</h1>';
endif;
require __DIR__ . '/footer.php';