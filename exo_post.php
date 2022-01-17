<?php $post = $_POST;
mb_internal_encoding( "UTF-8" );
function mb_ucfirst($string) {
	$string = mb_strtolower($string); // remettre en minuscule toute la chaîne de caractère
	$string = mb_strtoupper(mb_substr($string, 0, 1)) . mb_substr($string, 1);
	return $string;
}
function sanitize($string) {
 return htmlspecialchars(trim($string));
 
}

$msg_error = '';
$reason_array = array('dating','info','other');
foreach ($post as $key => $value) {
	if($key === 'firstname' && empty(sanitize($value)))
		$msg_error .= 'Merci de compléter votre prénom<br>';
	if($key === 'lastname' && empty(sanitize($value)))
		$msg_error .= 'Merci de compléter votre nom<br>';
	if($key === 'email' && empty(sanitize($value)))
		$msg_error .= 'Merci de compléter votre email<br>';
	if($key === 'email' && !empty(sanitize($value)) && !filter_var(sanitize($post['email']),FILTER_VALIDATE_EMAIL))
		$msg_error .= 'Merci de renseigner un email valide<br>';
	if($key === 'reason' && empty(sanitize($value)))
		$msg_error .= 'Merci de compléter un motif<br>';
	if($key === 'reason' && !empty(sanitize($value)) && !in_array(sanitize($value), $reason_array))
		$msg_error .= 'Oups un problème est survenu<br>';
	if($key === 'msg' && empty(sanitize($value)))
		$msg_error .= 'Merci de renseigner un message<br>';
	if($key === 'msg' && !empty(sanitize($value)) && 
		strlen(sanitize($value)) < 10)
		$msg_error .= 'Merci de renseigner un message avec au moins 10 caractères<br>';
}
if(!empty($msg_error)) {
	header('Location: index.php?msg=' . $msg_error);
}
else { ?>
	<p>Prénom : <?php echo mb_ucfirst(sanitize($post['firstname'])); ?></p>
	<p>Nom : <?php echo mb_strtoupper(sanitize($post['lastname'])); ?></p>
	<p>Email : <?php echo filter_var(sanitize($post['email'])); ?></p>
	<p>Motif : <?php echo sanitize($post['reason']); ?></p>
	<p>Message : <?php echo sanitize($post['msg']); ?></p>
<?php	
}