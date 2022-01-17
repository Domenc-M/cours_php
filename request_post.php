<pre>
	<?php var_dump($_POST); ?>
</pre>
<?php 
mb_internal_encoding( "UTF-8" );
function mb_ucfirst($string) {
	$string = mb_strtolower($string); // remettre en minuscule toute la chaîne de caractère
	$string = mb_strtoupper(mb_substr($string, 0, 1)) . mb_substr($string, 1);
	return $string;
}
function sanitize($string) {
 return htmlspecialchars(trim($string));
 
}
?>

<?php if(!empty($_POST['firstname'])) : ?>
	<p>Mon prénom est : <?php echo mb_ucfirst(sanitize($_POST['firstname'])); ?></p>
<?php endif; ?>

<?php if(!empty($_POST['lastname'])) : ?>
	<p>Mon prénom est : <?php echo mb_strtoupper(sanitize($_POST['lastname'])); ?></p>
<?php endif; ?>

<?php if(filter_var(sanitize($_POST['email']), FILTER_VALIDATE_EMAIL)) : ?>
	<p>Mon email est : <?php echo sanitize($_POST['email']); ?></p>
<?php else : ?>
	<p><?php echo sanitize($_POST['email']); ?> n'est pas un email valide</p>
<?php endif; ?>