<?php require __DIR__ . '/header.php'; ?>

<section class="loop">

	<h1>Les boucles PHP</h1>

	<h2>La boucle FOR</h2>

	<pre>
		<code>
	

	for(valeur départ de la boucle; condition pour continuer la boucle; itération à chaque tour de boucle)

	for($i = 1; $i <= 10; $i++) {
		echo 'Tour de boucle n° ' . $i . ';
	}

		</code>
	</pre>

	<br>

	<p>Résultat :</p>

	<br>

	<?php 
	$start = 1;
	$max = 10;

	for($i = $start; $i <= $max; $i++) :

		echo 'Tour de boucle n° ' . $i . '<br>';

	endfor; ?>



	<br>
	<br>

	<p>Exercice :</p>

	<br>


	<p>$start = 1;</p>
	<p>$end = 100; // attention nombre max devra être compris entre 1 et 100, ne pourra pas être négatif, devra être un integer</p>
	<p>$type = 'even'; // odd or even</p>

	<?php 
	$end = 48; // attention nombre max devra être compris entre 1 et 100, ne pourra pas être négatif, devra être un integer
	$type = 'even'; // odd or even

	echo '<div class="result_modulo">';

	if(is_int($end) && $end >= 1 && $end <= 100) :

		$result_modulo = $type === 'even' ? 0 : 1;

		for($i = 1; $i <= $end; $i++) :


			if($i % 2 === $result_modulo ) echo "<div class='{$type}'>$i</div>";

		endfor;

	elseif(is_int($end) && ($end < 1 || $end > 100)) :
		echo "{$end} n'est pas un nombre entier compris entre 1 et 100";
	else :
		echo "{$end} n'est pas un nombre entier";
	endif;

	echo '</div>';
	?>
	<br>
	<br>
	<h2>La boucle WHILE</h2>

	<pre>
		<code>
			$start = 1;
			$end = 100;

			while($start <= $end) {

				$result_modulo = $type === 'even' ? 0 : 1;

				if($start % 2 === $result_modulo ) {
					echo '&lt;div class="' . $type . '">' .$start .'&lt;/div>';
				}

				$start++;
			}
		</code>
	</pre>
	<?php 
	$arr = array("orange", "banana", "apple", "raspberry");

	$i = 0;
	echo '<p>';
	while ($i < count($arr)) {
	   $a = $arr[$i];
	   echo $a ."<br>";
	   $i++;
	}
	echo '</p>';
	 ?>
	<br>
	<h3>Exercice</h3>
	 <p>
	exo avec boucle while qui doit afficher 5 phrases <br>
	<br>
	aucun message<br>
	1 message<br>
	2 messages<br>
	3 messages<br>
	4 messages<br>

	</p>
	<?php $array = array('aucun message', '1 message', '2 messages', '3 messages', '4 messages'); ?>
	<br>
	<br>
	<?php
	$count = 0;
	$end = 5;
	while ($count < $end) {
		echo '<div>' . $array[$count] . '</div>';

		$count++;
	}


	$count = 0;

	while ($count < $end) {
		$plural = $count > 1 ? 's' : '';
		$text = $count == 0 ? 'aucun message' : $count . ' message' . $plural;

		echo '<div>' . $text . '</div>';

		$count++;
	}
	 ?>
	<br>
	<h2>La boucle DO-WHILE</h2>

<pre>
	<code>
	$max = 10;
	$i = 1;
	do {
	    if ($max < 5) {
	        echo "max n'est pas suffisamment grand";
	        break;
	    }
	    else {
	    	echo 'tour de boucle n° ' . $i . '&lt;br>';
	    	$i++;
		}

	} while ($i <= $max);
		</code>
	</pre>
	<?php 
	$max = 4;
	$i = 1;
	do {
	    if ($max < 5) {
	        echo "max n'est pas suffisamment grand";
	        break;
	    }
	    else {
	    	echo 'tour de boucle n° ' . $i . '<br>';
	    	$i++;
		}

	} while ($i <= $max);
	?>
	<br>
	<h2>La boucle FOREACH</h2>
<br>
<p>Cette boucle est faite pour parcourir des tableaux</p>
<br>

<pre>
	<code>
	$numbers = array(
	    "un" => 1,
	    "deux" => 2,
	    "trois" => 3,
	    "dix-sept" => 17
	);
	// cette méthode affichera les valeurs de chaque propriéte 

	foreach($numbers as $number) :

		echo $number . '&lt;br>';
		
	endforeach;

	// cette méthode affichera le couple propriété, valeur 
	foreach($numbers as $key => $value) :

		echo $key . ' ' . $value . '&lt;br>';
		
	endforeach;
		</code>
	</pre>
	<br>
	<br>
	<br>
	<?php 
	$numbers = array(
	    "un" => 1,
	    "deux" => 2,
	    "trois" => 3,
	    "dix-sept" => 17
	);

	foreach($numbers as $number) :

		echo $number . '<br>'; // va récupérer uniquement la valeur
		
	endforeach;

	foreach($numbers as $key => $value) :

		echo $key . ' ' . $value . '<br>'; // va récupérer le couple key et value
		
	endforeach;
	?>
	<br>
	<?php 
	$jours = array(
		array(
			'jour' => 'lundi',
			'day' => 'monday'
		),
		array(
			'jour' => 'mardi',
			'day' => 'tuesday'
		),
		array(
			'jour' => 'mercredi',
			'day' => 'wednesday'
		),
		array(
			'jour' => 'jeudi',
			'day' => 'thursday'
		),
		array(
			'jour' => 'vendredi',
			'day' => 'friday'
		),
		array(
			'jour' => 'samedi',
			'day' => 'saturday'
		),
		array(
			'jour' => 'dimanche',
			'day' => 'sunday'
		)
	);
	// echo '<pre>';
	// var_dump($jours);
	// echo '</pre>';

	foreach($jours as $key => $value) {
		echo '<p>Le jour numero ' . ($key + 1) . '</p>';
		// var_dump($key);
		// var_dump($value);
		foreach ($value as $key2 => $value2) {
			echo '<p>' . $key2 . ' : ' . $value2 . '</p>';
			// var_dump($key2);
			// var_dump($value2);
		}
		echo '<br>';
	} ?>
	<br>
	<br>
</section>
<?php require __DIR__ . '/footer.php';
