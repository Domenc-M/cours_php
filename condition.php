<?php require __DIR__ . '/header.php'; ?>

<section class="condition">

	<h1>Les conditions PHP</h1>

	<div>
		<pre>
			<code>
$condition = 1;

if($condition === TRUE) {
	echo '1 === TRUE';
}
else {
	echo '1 !== TRUE';
}				
			</code>
		</pre>
	</div>
	<?php
	$condition = 1;

	if($condition === TRUE) {
		echo '1 === TRUE';
	}
	else {
		echo '1 !== TRUE';
	} ?>

	<br><br>
	<h3>autre syntaxe</h3>

	<div>
		<pre>
			<code>
$condition = 1;

if($condition == TRUE) :
	echo '1 == TRUE';
else :
	echo '1 != TRUE';
endif; ?>
			</code>
		</pre>
	</div>

	<br>
	<br>
	<?php
	$condition = 1;

	if($condition == TRUE) :
		$result = '1 == TRUE';
	else :
		$result = '1 != TRUE';
	endif;
	echo $result; ?>
	<br><br>
	<h3>condition sans accolade</h3>
	<div>
		<code>
		if($condition === TRUE)<br>
		<span></span>echo '1 === TRUE'; // attention uniquement la première instruction sera exécutée si la condition est true <br>
		<span></span>echo '1 !== TRUE'; // ceci n'est pas une instruction de la condition mais tout simplement un echo<br>
		<br>
		</code>
	</div>
	<?php 
	if($condition === TRUE) 
		echo '1 === TRUE'; // il n'affiche pas car la condition n'est pas juste
		echo '1 !== TRUE'; // il affiche parce que cet echo ne dépend pas de la condition

	 ?>
	<br><br>
	<h3>Opérateur ternaire</h3>
	<div>
		<code>
		// opérateur ternaire <br>	
		$result = ($condition == TRUE) ? '1 == TRUE' : '1 != TRUE';<br>	
		echo $result; <br>	
		</code>
	</div>
	<?php 
	// opérateur ternaire
	$result = ($condition == TRUE) ? '1 == TRUE' : '1 != TRUE';

	// opérateur ternaire avec elseif
	// $result = ($condition === TRUE) ? '1 === TRUE'  || ($condition !== TRUE) : '1 !== TRUE';
	echo $result; ?>
	
	<br><br>
	<br><br>
	<h3>Condition avec elseif</h3>
	<div>
		<pre>
			<code>
$condition = 50; 
 
if($condition % 2 === 1) { 
	echo 'Je suis un nombre impair'; 
} 
elseif($condition % 2 === 0) { 
	echo 'Je suis un nombre pair'; 
} 
else { 
	echo 'je ne suis pas un chiffre'; 
} 
			</code>
		</pre>
	</div>
	<?php
	$condition = 50;

	if($condition % 2 === 1) {
		echo 'Je suis un nombre impair<br>';
	}
	elseif($condition % 2 === 0) {
		echo 'Je suis un nombre pair<br>';
	}
	else {
		echo 'je ne suis pas un chiffre<br>';
	}

	$condition = 50.27;
	if(is_int($condition)) :
		if($condition % 2 === 1) :
			echo 'Je suis un nombre impair<br>';
		elseif($condition % 2 === 0) :
			echo 'Je suis un nombre pair<br>';
		else :
			echo 'je ne suis pas un chiffre<br>';
		endif;
	else:
		echo 'merci de renseigner un nombre entier';
	endif;
	?>

	<br><br>
	<br><br>
	<h3>Condition avec SWITCH</h3>

	<div>
		<pre>
		<code>
$result = 10; 
switch($result) {
	case 25:						// if
		echo 'Bon résultat';
		break;
	case 35:						// elseif
		echo 'Bon résultat';
		break;
	case 10:						// elseif
		echo 'Bon résultat';
		break;
	default:						// else
		echo 'aucun résultat ne correspond';
}
		</code>
		</pre>
		
		<pre>
		<code>
$result = 10;
$array = array(25,35,10);
switch($result) {
	case 25:						// if(in_array($result,$array))
	case 35:						
	case 10:						
		echo 'Bon résultat';
		break;
	default:						// else
		echo 'aucun résultat ne correspond';
}
		</code>
		</pre>
			

	</div>
	<br>
	<br>
	<br>
	<h3>Condition avec MATCH (A partir de PHP 8)</h3>

	<div>
		<pre>
		<code>
$expressionResult = match ($condition) {
    1, 2 => foo(), // if
    3, 4 => bar(), // elseif
    default => baz(), // else
};
		</code>

	</pre>

	?>
</section>
<?php require __DIR__ . '/footer.php';
