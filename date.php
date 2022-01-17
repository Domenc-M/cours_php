<?php 
// le serveur est souvent paramétré sur le fuseau horaire UTC

// va mettre au bon fuseau toute la page
// date_default_timezone_set('EUROPE/Paris'); // + 1 heure hiver / + 2 heure été

// pour la traduction de la date en français
setlocale(LC_TIME, 'fr_FR.utf8','fra'); 

require __DIR__ . '/header.php';
?>

<h1>Les dates</h1>

<a href="https://www.php.net/manual/fr/datetime.format.php">Lien des format de dates</a>

<pre>
	<?php var_dump(date('Y-m-d H:i:s')); // en procédural ?>
</pre>

<pre>
	<?php var_dump(date('U')); // timestamp temps en secondes depuis le 1/01/1970 ?>
</pre>

<pre>
	<!-- va appliquer le fuseau horaire du serveur avec le parametre date_default_timezone_set -->
	<?php var_dump(new DateTime('now')); // en POO ?>
</pre>

<pre>
	<!-- ici il ne faut pas mettre le date_default_timezone_set en haut de page, le DateTimeZone permet d'appliquer le bon fuseau horaire uniquement sur cette instanciation -->
	<?php var_dump(new DateTime('now', new DateTimeZone('EUROPE/Paris'))); // en POO ?>
</pre>
<?php
$date1 = new DateTime('now', new DateTimeZone('EUROPE/Paris'));
$date3 = new DateTime('now', new DateTimeZone('EUROPE/Paris'));
echo '<pre>';
var_dump($date1);
echo '</pre>';

$date2 = $date1;

$date1->add(new DateInterval('P10D')); // ajout de 10 jours

echo '<pre>';
var_dump($date2);
echo '</pre>';

echo '<pre>';
var_dump($date3);
echo '</pre>';

echo $date3->format('\HE\URE : j F Y à h:i'); // application de la méthode format sur l'instance de class $date3

$date_week_end = new DateTime('2022-01-14 16:30:00');
echo '<br>';
echo $date_week_end->format('d m Y à H:i');

$another_date = $date_week_end->format('\l\e, j-n-Y à G \h i'); 
echo '<br>';
echo $another_date;
echo '<br><br>';

$date_with_day = $date_week_end->format('\l\e l, j F Y à G \h i');
echo $date_with_day;
echo '<br><br>'; ?>

<h2>Mettre en français la date ci-dessus</h2>
<p>pour cela, il nous faut déjà définir la langue voulu</p>
<!-- setlocale(LC_TIME, 'fr_FR.utf8','fra');  -->
<p>Il nous faut aussi la fonction strftime qui a besoin du timestamp</p>
<p>Attention function dépreciée depuis PHP 8.1</p>
<a href="https://www.php.net/manual/fr/function.strftime.php">Doc de strftime pour mettre au format du pays désiré</a>

<p>2 solutions pour récupérer le timestamp de la date</p>

<?php
// utiliser gettimestamp comme méthode est mieux car le fuseau horaire est réglé
$timestamp = $date_week_end->gettimestamp();
$timestamp2 = strtotime('2022-01-14 16:30:00');

echo $timestamp2;


echo '<br><br>'; ?>
<p>Avec strftime (Attention obsolète depuis PHP 8.1</p>
<?php
$french_format = strftime('le %A, %e %B %Y à %H h %M', $timestamp);
echo $french_format;

echo '<br><br>'; ?>


<!-- <p>Avec IntlDateFormatter</p> -->
<?php
////////////////////////////////////////// TODO //////////////////////////////////////////////////
// $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::SHORT, IntlDateFormatter::SHORT);
// $formatter->setPattern('l d F Y');

// echo $formatter->format($date_week_end);

// $formatter->format('\l\e l, j F Y à G \h i');
////////////////////////////////////////// TODO //////////////////////////////////////////////////

?>
<h2>calcul interval entre 2 dates</h2>
<a href="https://www.php.net/manual/fr/dateinterval.format.php">DateInterval();</a><br>
<?php
$d1 = new DateTime('now', new DateTimeZone('EUROPE/Paris'));
$d2 = new DateTime('2021-07-14 23:00', new DateTimeZone('EUROPE/Paris'));

$interval = $d2->diff($d1);

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
		$result .= $minute . ' minute';
	}
	elseif($minute > 1) {
		$result .= $minute . ' minutes';
	}
	return $result;
}

echo french_date($interval);
echo '<pre>';
var_dump($interval);
echo '</pre>';
echo '<pre>';
var_dump($interval->days);
echo '</pre>';
echo '<br>'; ?>
<h2>Ajout d'une période à une date donnée</h2>
<a href="https://www.php.net/manual/fr/datetime.add.php">DateTime::add</a>
<?php

$d = new DateTime('now', new DateTimeZone('EUROPE/Paris'));

echo '<pre>';
var_dump($d);
echo '</pre>';

// P10D    	=> ajout de 10 jours
// P10M    	=> ajout de 10 mois
// P10Y    	=> ajout de 10 ans
// PT10H30S => ajout de 10 heures et 30 secondes
$d->add(new DateInterval('P10D'));

echo '<pre>';
var_dump($d);
echo '</pre>';

echo $d->format('\l\e, j-n-Y à G \h i'); 

echo '<br>'; ?>

<h2>Soustrait une période à une date donnée</h2>
<a href="https://www.php.net/manual/fr/datetime.sub.php">DateTime::sub</a>
<?php

$d = new DateTime('now', new DateTimeZone('EUROPE/Paris'));

echo '<pre>';
var_dump($d);
echo '</pre>';

// P10D    	=> ajout de 10 jours
// P10M    	=> ajout de 10 mois
// P10Y    	=> ajout de 10 ans
// PT10H30S => ajout de 10 heures et 30 secondes
$d->sub(new DateInterval('P10D'));
echo '<pre>';
var_dump($d);
echo '</pre>';

echo $d->format('\l\e, j-n-Y à G \h i'); 

echo '<br>'; ?>

<h2>Fonction mktime</h2>
<a href="https://www.php.net/manual/fr/function.mktime.php">Doc mktime</a>
<?php
$d = new DateTime('now', new DateTimeZone('EUROPE/Paris'));

// mktime(heures, minutes, secondes, mois, jour, année);
$start_timestamp = mktime(0,0,0, $d->format('m') + 1, 1, $d->format('Y'));

$end_timestamp = mktime(0,0,0, $d->format('m') + 1, 2, $d->format('Y'));

echo '<pre>';
var_dump(date('Y-m-d H:i:s', $start_timestamp));
echo '</pre>';

echo '<pre>';
var_dump(date('Y-m-d H:i:s', $end_timestamp));
echo '</pre>';
echo '<br>';

?>
<p>Exercice : créer une fonction qui définira le jour de votre naissance selon une date donnée sous le format DD/MM/YYYY</p>
<a href="https://www.php.net/manual/fr/datetime.createfromformat.php">Doc createFromFormat</a>
<br>
<form action="birthday_post.php" method="POST">
	<label for="birthday">Renseigner votre date d'anniversaire</label>
	<br>
	<input type="date" name="birthday" id="birthday">
	<br>
	<button type="submit" id="result_birthday">Afficher le résultat</button>
</form>

<br><br>

<p>Exercice : afficher toutes les années bisextiles entre 2 années</p>

<form action="bisex_post.php" method="post" id="bisex_form" enctype="multipart/form-data">
	<label for="start_year">Renseigner une année de début</label>
	<br>
	<input type="text" name="start_year" id="start_year">
	<br>
	<label for="end_year">Renseigner une année de fin</label>
	<br>
	<input type="text" name="end_year" id="end_year">
	<br>
	<input type="submit" value="GO !!!">
</form>
<div id="result_year"></div>

<?php 


echo '<br><br><br><br><br><br>';
echo '<br>';
echo '<br>';




require __DIR__ . '/footer.php';