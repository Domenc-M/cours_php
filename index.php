<?php 
// require ==> si le fichier n'est pas trouvé, génére une erreur fatale
// require_once ==> si le fichier a déjà été chargé, ne le chargera pas une seconde fois
// include ==> ne bloque pas le script si le fichier n'est pas trouvé
// include_once
setcookie('test', 'value', time() + 3600*24*365, '/');
require __DIR__ . '/header.php'; ?>

<h1>Introduction au PHP : Les variables</h1>

<section class="intro">
	<h2>Format de variable</h2>
	<p>Dans un premier temps pour que le serveur interprête le php, celui doit être enfermé dans des balises <?php echo '&lt;?php ?&gt;'; ?></p>
	<br>
	<p>Une variable php commence par un $</p>
	<p>il ne doit pas comporter de caractères spéciaux, ni d'accents sauf le underscore</p>
	<p>Pas de chiffre aussitôt le $</p>
	<p>Attention, les variables sont sensibles à la casse</p>
	<br>
	<p><code>$name_var</code> correct</p>
	<p><code>$2name_var</code> faux</p>
	<p><code>$name_var2</code> correct</p>
	<p><code>$name != $Name != $nAme</code> ce sont 3 variables différentes</p>
	<br>
	<h2>Valeurs de variable PHP (types)</h2>
	<p><code>$string = 'je suis un string';</code> chaîne de caractères</p>
	<p><code>$integer = 24;</code> nombre entier</p>
	<p><code>$float = 24.59;</code> nombre relatif (décimaux)</p>
	<p><code>$bolean = TRUE;</code> booléen (vrai ou faux)</p>
	<p><code>$array = array();</code> tableau</p>
	<p><code>$object = new stdClass();</code> objet</p>
	<p><code>$null = NULL</code> valeur nulle</p>
	<br><br>
	<pre>
		<code>
			$var1 = FALSE; 
			<!-- signe "=" permet d'assigner une valeur à la variable -->
			$var2 = 0;

			$var1 == $var2 // correct
			$var1 === $var2 // faux
			$var1 != $var2 // faux car 0 == FALSE
			$var1 !== $var2 // correct ils ne sont pas strictement égaux (1 bolean et 1 integer)
		</code>
	</pre>
	<p><a target="_blank" href="https://www.php.net/manual/fr/language.operators.comparison.php">Opérateurs de comparaison</a></p>
	<br>

	<code>
		$first = 'je suis ma première variable';
		<?php $first_var = 'je suis ma première variable'; ?>
		<br>
		<?php echo $first_var; ?> 
		<!-- echo sert à afficher la variable en front (print); -->
	</code>

	<h2>Concaténation</h2>

	<p>différence entre <code>''</code>  et <code>""</code></p>
	<br>
	<?php echo '$first_var'; ?>
	<!-- interprete comme une chaine de caractere -->
	<br>
	<?php echo "$first_var"; ?>
	<!-- interprete la valeur de la variable -->
	<br>
	<?php $firstname = 'Otis'; ?>
	<?php echo 'Mon prénom est ' . $firstname . '<br>'; ?>
	<?php echo "Mon prénom est $firstname<br>"; ?>
	<br>
	<?php 
	echo 'Mon prénom est ' . $firstname . '<br>';
	echo "Mon prénom est $firstname<br>";
	?>
	<br>
	<br>

	<h3>Concaténation de variables</h3>
	<pre>
		<code>
	$text = '&lt;article&gt;';
	$text .= '&lt;h3&gt; test concaténation variable&lt;/h3&gt;';
	$text .= '&lt;p&gt;Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatum accusantium eaque consequatur sed deleniti nostrum earum veritatis voluptatibus. Esse quia rem similique et adipisci commodi accusantium sunt cupiditate autem velit?
	Quis dignissimos molestias corrupti soluta a sit voluptate ipsum nam dicta, eveniet dolor. Aperiam aspernatur officia vitae amet sequi itaque ut temporibus earum delectus quod facere, enim, iusto autem nihil.
	Obcaecati impedit odit molestias similique, laboriosam enim placeat doloribus aspernatur tenetur ea voluptatem ex corporis vel ratione minus possimus animi quasi voluptates, tempore nam eveniet ut fugiat. Suscipit atque, ex.&lt;/p&gt;';
	$text .= '&lt;/article&gt;';

	echo $text;
		</code>
	</pre>
	<?php 
	$text = '<article>';
	$text .= '<h3> test concaténation variable</h3>';
	$text .= '<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatum accusantium eaque consequatur sed deleniti nostrum earum veritatis voluptatibus. Esse quia rem similique et adipisci commodi accusantium sunt cupiditate autem velit?
	Quis dignissimos molestias corrupti soluta a sit voluptate ipsum nam dicta, eveniet dolor. Aperiam aspernatur officia vitae amet sequi itaque ut temporibus earum delectus quod facere, enim, iusto autem nihil.
	Obcaecati impedit odit molestias similique, laboriosam enim placeat doloribus aspernatur tenetur ea voluptatem ex corporis vel ratione minus possimus animi quasi voluptates, tempore nam eveniet ut fugiat. Suscipit atque, ex.</p>';
	$text .= '</article>';

	echo $text;

	$var1 = '5';
	$var2 = 5;
	$result = $var1 . $var2;
	echo $result; // donne 55

	?>
	<br>
	<h2>Portée des variables</h2>
	<p>Les variables en PHP ont uniquement une portée de function
	</p>
	<p>exemple :</p>
	<pre>
		<code>
	$test = TRUE; // en global

	function appel_variable() { 
		$test = FALSE; // encapsulée dans la fonction
		return $test;
	}
	echo $test; // affiche TRUE
	echo appel_variable(); // affiche FALSE
		</code>
	</pre>
	<?php 
	$test = 'Otis'; // déclarée en global

	var_dump($test);

	echo '<br>';

	function appel_variable() { 
		$test = 'FERU'; // encapsulée dans la fonction
		var_dump($test);
	}

	var_dump($test);

	echo '<br>';
	echo $test; // affiche TRUE
	echo '<br>';
	echo appel_variable(); // affiche FALSE
	echo '<br>';
	 ?>
	<br>
	<h2>Les constantes</h2>
	<p><code>define('NAME', 'value');</code> // attention sensible à la casse... selon la norme, on écrit toujours une constante en majuscule</p>
	<p>Une constante est donc appelée comme ceci</p>
	<p><code>echo NAME;</code></p>
	<br>
	<p>Exemple :</p>
	<p><code>define('NOM_ECOLE', 'Campus du Lac');</code></p>
	<?php
	define('NOM_ECOLE', 'Campus du Lac');
	echo '<p><code>' . NOM_ECOLE . '</code></p>';
	?>
	<br><br>
	<h2>Les tableaux</h2>
	<h3>tableau simple</h3>
	<p>
	<code>
	$array = array('bleu', 'blanc', 'rouge');<br>
	$array[0] ==> 'bleu';
	Le premier élément est 0, le second 1, etc...
	</code>
	</p>
	<?php $array = array('bleu', 'blanc', 'rouge'); ?>
	<pre>
		<?php var_dump($array); ?>
	</pre>
	<?php 
	echo '<pre>';
	var_dump($array);
	echo '</pre>';
	?>
	<br>
	<p>Récupération de la bdd en format json</p>
	<?php 
	$result_bdd = json_encode(array('test@test.fr', 'thomas@fototoua.nul'));
	var_dump($result_bdd); ?>
	<br><br>
	<p>Remise en tableau PHP</p>
	<?php
	$array_bdd = json_decode($result_bdd);
	var_dump($array_bdd); ?>
	<br><br>
	<p>Récupération d'un nouvel email par formulaire</p>
	<?php
	$result_form = array('melanie@zetofré.bzh'); // array($_POST['email']);
	var_dump($result_form); ?>
	<br><br>
	<p>Fusion des 2 tableau avec array_merge</p>
	<?php
	$array_merge = array_merge($array_bdd,$result_form);
	var_dump($array_merge); ?>
	<br><br>
	<p>On trie le tableau par ordre alphanumérique</p>
	<?php sort($array_merge);
	var_dump($array_merge); ?>
	<br><br>
	<p>On peut aussi enlever les doublons</p>
	<p>on a un tableau avec bleu bleu ver rouge</p>
	<?php 
	$colors = array('bleu', 'bleu', 'vert', 'rouge');
	$colors_unique = array_unique($colors);
	var_dump($colors_unique);
	?>
	<br><br>
	<p>array_diff va resortir les différences entre 2 tableaux</p>
	<?php 
	$tab1 = array('bleu', 'vert', 'rouge');
	$tab2 = array('bleu', 'jaune', 'vert'); 
	var_dump(array_diff($tab2, $tab1)); ?>
	<br><br>
	<p>Trier un tableau multidimensionnel avec usort</p>
	<p>il permet de trier un tableau avec une fonction de comparaison</p>
	<?php
	function cmp($a, $b) {
		return $a['fruit'] <=> $b['fruit'];
	}
	$fruits = array(
		array(
			'fruit' => 'lemons'
		),
		array(
			'fruit' => 'apples'
		),
		array(
			'fruit' => 'grapes'
		),
	);

	usort($fruits, "cmp");
	echo '<pre>';
	var_dump($fruits);
	echo '</pre>';

	?>
	<h3>tableau associatif</h3>
	<pre>
		<code>
		$array = array(
			'couleur' => 'bleu',
			'dimension' => '25m3',
			'matiere' => 'coton'
		);
		</code>
	</pre>
	
	<?php 
	$array = array(
		'couleur' => 'bleu',
		'dimension' => '25m3',
		'matiere' => 'coton'
	);
	?>
	<pre>
		<?php var_dump($array); ?>
		<?php var_dump("Afficher le second élément avec \$array['dimension'] ==>{$array['dimension']}"); ?>
	</pre>
	<br>
	<h3>tableau multi-dimensionnel</h3>
	<?php $array = array(
		'nom' => 'FERU',
		'prenom' => 'Otis',
		'enfant' => array(
			array(
				'nom' => 'FERU',
				'prenom' => 'Dorian',
			),
			array(
				'nom' => 'etc',
				'prenom' => 'etc',
			),

		)
	); ?>
	<pre>
		<?php var_dump($array); ?>
	</pre>
	<pre>
		<?php var_dump($array['enfant'][0]['prenom']); ?>
	</pre>
	
	<br><br>
	<h2>Les superglobales</h2>
	<a href="https://www.php.net/manual/fr/language.variables.superglobals.php" target="_blank">Lien doc PHP</a>
	<br>
	<h3>$GLOBALS</h3>
	<p>var_dump($GLOBALS['array']) ==> <?php var_dump($GLOBALS['array']); ?></p>
	
	<br>
	<h3>$_SERVER</h3>
	<p>Sert à récupérer les données serveur</p>
	<p>var_dump($_SERVER) ==> </p>
	<pre>
		<?php var_dump($_SERVER); ?>
	</pre>
	<br>
	<h3>$_GET</h3>
	<p>Sert à récupérer une variable envoyer par le biais de l'url</p>
	<a href="http://localhost/cours_php/request_get.php?var=99">Envoi de la requête GET</a>
	<br>
	<p>envoi de plusieurs variables en méthode GET</p>
	<a href="http://localhost/cours_php/request_get.php?var=99&var2=Otis&var3=FERU">Envoi de la requête GET de plusieurs variables</a>
	<br>
	<br>
	<h4>Exercice GET</h4>
	<div class="btn_flex">
		<a href="http://localhost/cours_php/request_get.php?picture=YES" class="btn_gray">Afficher Photo</a>
		<a href="http://localhost/cours_php/request_get.php?picture=NO" class="btn_gray">Ne pas afficher Photo</a>
	</div>
	<br>
	<br>
	<div class="btn_flex">
		<a class="btn_red" href="http://localhost/cours_php/request_get.php?color=red">Rouge</a>
		<a class="btn_green" href="http://localhost/cours_php/request_get.php?color=green">Vert</a>
	</div>
	<br>
	<br>
	<h3>$_POST</h3>
	<p>Le $_POST sert à récupérer les données envoyés par formulaire</p>
	<br>
	<p>action : sert à definir la page php où on soumet le formulaire</p>
	<p>method : le type de requête. Pour les formulaires retenez toujours POST</p>
	<p>Dans le input ou textarea le "name" sera le nom de la variable à récupérer</p>
	<form action="./request_post.php" method="POST">
		<div>
			<label for="firstname">Prénom</label>
			<input type="text" name="firstname" id="firstname">
		</div>
		<div>
			<label for="lastname">Nom</label>
			<input type="text" name="lastname" id="lastname">
		</div>
		<div>
			<label for="email">Email</label>
			<input type="text" name="email" id="email">
		</div>
		
		<button type="submit">Envoyer</button>
	</form>
	<br>
	<br>
	<h3>exercice formulaire</h3>
	<form action="./exo_post.php" method="POST">
		<div>
			<label for="firstname">Prénom<span class="red">*</span></label>
			<input type="text" name="firstname" id="firstname">
		</div>
		<div>
			<label for="lastname">Nom<span class="red">*</span></label>
			<input type="text" name="lastname" id="lastname">
		</div>
		<div>
			<label for="email">Email<span class="red">*</span></label>
			<input type="text" name="email" id="email">
		</div>
		<div>
			<label for="reason">Motif<span class="red">*</span></label>
			<select type="text" name="reason" id="reason">
				<option value="">Renseigner votre motif</option>
				<option value="dating">RDV</option>
				<option value="info">Info</option>
				<option value="other">Autre</option>
			</select>
		</div>
		<div>
			<label for="msg">Message<span class="red">*</span></label>
			<textarea name="msg" id="msg" cols="30" rows="10"></textarea>
		</div>

		
		<button name="exo_form" type="submit">Envoyer</button>
		<?php if(isset($_GET['msg'])) echo $_GET['msg']; ?>
	</form>
	<br>
	<h3>$_SESSION</h3>
	<p>Les variables de session sont des données qui sont enregistrées directement sur le serveur avec un id de session correspondant à l'utilisateur et son navigateur</p>
	<p>Les sessions se détruisent automatiquement au bout de 30 minutes d'inactivité</p>
	<p>Pour enregistrer ou lire une session, il faut commencer la page php par 
		<code>
		session_start();
		</code></p>

	<br>
	<h3>$_COOKIE</h3>
	<p>Les variables de cookies sont des données qui sont enregistrées directement sur le navigateur</p>
	<p>Cet variable a un délai d'expiration, celui-ci disparait automatiquement dès que ce délai est expiré</p>
	<p>Pour enregistrer un cookie on va utiliser la fonction 
		<a href="https://www.php.net/manual/fr/function.setcookie.php">fonction setcookie</a>
		<code>
		setcookie();
		</code>
	</p>
	<p>La fonction setcookie sera à placer en tout début de fichier</p>
	<p>Pour la lire on va utiliser 
		<a href="https://www.php.net/manual/fr/reserved.variables.cookies.php">$_COOKIE</a>
		<code>
		$_COOKIE['nom_de_la_variable'];
		</code>
	</p>
	<p>Pour effacer un cookie, on utilisera setcookie avec le timestamp à laquelle on ajoute une valeur négative
		<code>
		setcookie('name', 'value', time() - 3600, '/');
		</code>
	</p>
	<br>
	<br>
	<br>
</section>

<?php require __DIR__ . '/footer.php';	