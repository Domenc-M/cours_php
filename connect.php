<?php
try
{
	$db = new PDO('mysql:host=localhost;dbname=bibliotheque;charset=utf8','root','root');
}
catch(Exception $e)
{
	die('Erreur: ' . $e->getMessage());
}