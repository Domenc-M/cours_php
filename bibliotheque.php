<?php 
require __DIR__ . '/header.php';
require __DIR__ . '/connect.php';
if(!isset($_SESSION['id'])) :
	header('Location: index.php');		
endif;

function resumeString($string, $length = 200) {
	// je récupére la chaine limité par le paramètre $length
	$text_cut = substr($string, 0, $length);
	// je souhaite connaitre la longueur de la chaine à supprimer à la fin à partir du dernier espace
	// strlen donne le nombre de caractère
	// strrchr donne le bout de chaine en partant de la fin jusqu'au caractère voulu (ici l'espace)
	$text_length = strlen(strrchr($text_cut, ' '));
	// je récupère la chaine final en soustrayant le longueur de chaine en trop à la longueur de chaine voulue initialement
	$final_text = substr($text_cut, 0, $length - $text_length);
	return $final_text . ' ...';
}

$req = $db->query("
	SELECT DISTINCT YEAR(date_naissance) AS birthday_date
	FROM auteur
	ORDER BY YEAR(date_naissance) ASC
");
$results = $req->fetchAll(PDO::FETCH_OBJ);

$tmp_file = fopen('./tmp/test-log.log', 'a');
fwrite($tmp_file, json_encode($results) . "\r\n"); // a pour append w pour write
fclose($tmp_file);

?>
<img src="img/close.svg" alt=""><br>
<br>
<br>
<br>
<br>
<!-- on pourra changer la couleur avec le css (fill ou stroke ou color si c'est du texte) -->
<?php echo file_get_contents('img/close.svg');

var_dump(json_encode($results)); ?>
<form action="bibliotheque.php" method="GET">
	<select name="year_choice" id="year_choice">
		<option value="0">Renseigner une année</option>
		<?php foreach ($results as $year) { ?>
			<option value="<?php echo $year->birthday_date; ?>"><?php echo $year->birthday_date; ?></option>
		<?php
		} ?>

	</select>
	<button type="submit">Envoyer</button>
</form>

<?php
if(isset($_GET['search'])) {
	$request = 'WHERE l.resume = :search OR l.titre LIKE :search';
	$array = array(
		'search' => "%{$_GET['search']}%"
	);
}
elseif(isset($_GET['year_choice']) && $_GET['year_choice']) {
	$request = 'WHERE YEAR(a.date_naissance) = :date_naissance';
	$array = array(
		'date_naissance' => $_GET['year_choice']
	);
}
else {
	$request = '';
	$array = array();
}

$req = $db->prepare("
	SELECT i.id picture, l.titre, a.prenom, a.nom, l.annee, g.libelle, l.resume, l.id livre_id
	FROM livre l
	LEFT JOIN auteur a 
	ON l.auteur_id = a.id 
	LEFT JOIN genre g 
	ON l.genre_id = g.id
	LEFT JOIN illustration i 
	ON l.illustration_id = i.id 
	$request
	ORDER BY l.titre
");
$req->execute($array);
// var_dump($db->errorInfo()); // affiche les erreurs SQL
?>

<form action="bibliotheque.php" method="GET">
	<input type="text" name="search" placeholder="Renseigner un mot clé">
	<button type="submit"><i class="fas fa-search fa-2x"></i></button>
</form>
<?php 
$test = '<h1>lkjlkmcjqdmslkjm</h1>';
$test .= '<p>vdfherykkktj</p>';

echo $test;

ob_start();
?>
<h1>jhnqk:djgwlk!jag</h1>
<p>,:knlkm!:;j,w!x:djg,!q,sg</p>
<?php
$ob = ob_get_clean();
echo $ob;
 ?>
<?php ob_start(); ?> <!-- j'ouvre un cache PHP -->
<section id="books">
	<?php
	while($book = $req->fetchObject()) { // résultat en objet
	// while($book = $req->fetch(PDO::FETCH_ASSOC)) { // résultat en Array
		?>
		<div class="book">
			<div class="picture">
				<img src="<?php echo $host . "/couvertures/{$book->picture}.jpg"; ?>" alt="<?php echo $book->titre ?>">
			</div>
			<h2 class="desc">Titre : <?php echo $book->titre; ?></h2>
			<p class="desc">Auteur : <?php echo trim($book->prenom) . ' ' . trim($book->nom); ?></p>
			<p class="desc">Année de parution : <?php echo $book->annee; ?></p>
			<p class="desc">Genre : <?php echo $book->libelle; ?></p>
			<p class="desc">Resumé : <p><?php echo resumeString($book->resume,150); ?></p></p>
			<p><a href="<?php echo $host . '/status.php?id=' . $book->livre_id; ?>">En savoir plus sur : <?php echo $book->titre; ?></a></p>
		</div>
		
	<?php
	} ?>
</section>
<?php $cache = ob_get_clean(); ?> <!-- je stocke le contenu en cache dans une variable -->
<?php echo $cache; ?>
<?php
require __DIR__ . '/footer.php';