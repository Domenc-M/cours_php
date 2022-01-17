<?php
date_default_timezone_set('EUROPE/Paris'); // fuseau horaire
setlocale(LC_TIME, 'fr_FR.utf8','fra'); // pour la traduction de la date en français
// var_dump($_POST['birthday']);
function retrieveDay($birthday) { 
	$day = new DateTime($birthday);

	if(!$day) {
		return 'Le format doit être YYYY-MM-DD'; 
	}
	$pos = $day->format('w');
	$day = array('dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi');
	return 'Le jour de la semaine était un ' . $day[$pos];

}

echo retrieveDay($_POST['birthday']);