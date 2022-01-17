<?php require __DIR__ . '/header.php'; ?>
<p>Récupération de la requête GET avec la variable "var"</p>

<!-- isset() vérifie que la variable demandée existe et n'est pas NULLE -->
<?php 
$var = 10;
if($var < 10) {
	echo 'inférieur à 10';
}
elseif($var > 10) {
	echo 'supérieur à 10';
}
else {
	echo 'égal à 10';
}

$var = 10;
if($var < 10) :
	echo 'inférieur à 10';
elseif($var > 10) :
	echo 'supérieur à 10';
else :
	echo 'égal à 10';
endif;
 ?>
<?php if(isset($_GET['var'])) : ?>
<pre>
	<?php var_dump($_GET); ?>
</pre>

<?php elseif(isset($_GET['picture'])) : ?>
	<br>
	<br>
	<p>Résultat de l'exercice d'affichage d'image</p>
	<?php if($_GET['picture'] === 'YES') : ?>
		<img src="img/star-wars-eclipse.jpg" alt="">
	<?php else: ?>
		<p>Pas d'image à afficher</p>
	<?php endif; ?>
<?php endif; ?>
<br>
<br>
<br>
<?php if(isset($_GET['color']) && $_GET['color'] === 'red') : ?>

	<div class="bg_red cube_get"></div>

<?php elseif(isset($_GET['color']) && $_GET['color'] === 'green') : ?>

	<div class="bg_green cube_get"></div>

<?php else : ?>

	<p>Ouh là, y'a un problème, là !</p>

<?php endif; ?>



<?php require __DIR__ . '/footer.php';