<?php 
require __DIR__ . '/header.php';
?>
<h1>Les Expressions Régulières (REGEX)</h1>

<p>Plusieurs fonctions permettent d'utiliser les REGEX</p>
<p>preg_match <span><a href="https://www.php.net/manual/fr/function.preg-match.php">Doc</a></span></p>
<p>preg_match_all <span><a href="https://www.php.net/manual/fr/function.preg-match-all.php">Doc</a></span></p>
<p>preg_replace <span><a href="https://www.php.net/manual/fr/function.preg-replace.php">Doc</a></span></p>
<br><br>
<h2>Utilisation d'un pattern</h2>
<p>la fonction qui utilise le pattern demande un délimiteur</p>
<p>exemple (on veut savoir si la chaine fournie correspond bien à une url) : </p>
<br><br>
<p>preg_match('/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:.[A-Z0-9][A-Z0-9_-]*)+):?(d+)?\/?/i', $url)</p>
<br><br>
<p>Ici on utilise le  / comme délimiteur, ce n'est pas le meilleur à utiliser, car si ce caractère est utilisé dans le pattern il faudra l'échapper avec \</p>
<p>Il vaut mieux utiliser des caractères rares : ~ % # @</p>
<br><br>
<p>Attention, à chaque fois que vous devez rechercher un caractère qui correspond à une syntaxe REGEX il faudra l'échapper à un \</p>
<br><br>
<p>l'exemple deviendrait : preg_match('#^(http|https|ftp)://([A-Z0-9][A-Z0-9_-]*(?:.[A-Z0-9][A-Z0-9_-]*)+):?(d+)?/?#i', $url)</p>
<br><br>
<p>On utilise le i en dehors des délimiteurs regex pour spécifier que le pattern est insensible à la casse</p>
<br><br>
<p>preg_match('#pattern#', $string)</p>
<p>preg_match_all('#pattern#', $string)</p>
<p>preg_replace('#pattern#', $replace, $string)</p>

<h2>Syntaxe des expressions régulières</h2>
<p>pour tester vos pattern : <a href="https://regex101.com/">test en ligne</a></p>
<p>#world# correspond à world</p>
<?php var_dump(preg_match('#world#', 'hello world !')); // result 1 ?> 
<br><br>
<p>#.# remplace n'importe quel caractère sauf \n (nouvelle ligne)</p>
<?php var_dump(preg_match('#.#', 'world is beautiful')); ?>
<br><br>
<p>#^world# correspond à world qui devra être en début de chaine</p>
<?php var_dump(preg_match('#^world#', 'world is beautiful')); ?>
<br><br>
<p>#world$# correspond à world qui devra être en fin de chaine</p>
<?php var_dump(preg_match('#world$#', 'hello world')); ?>
<br><br>
<p>#^world$# correspond à world qui devra être seul dans la chaine 'world and world' ne fonctionne pas</p>
<?php var_dump(preg_match('#^world$#', 'world')); ?>
<br><br>
<p>#[aeo]# indique qu'au moins une des lettres devra être présente</p>
<p>Je vais utiliser preg_match_all pour savoir le nombre de fois que le pattern est trouvé</p>
<?php var_dump(preg_match_all('#[aeo]#', 'hello world !')); ?>
<br><br>
<p>#[^aeo]# indique qu'aucune des lettres ne devra être présente</p>
<?php var_dump(preg_match_all('#[^aeo]#', 'hello world !ggrg')); // renvoie 14/17 car a trouvé 3 lettres défendues ?> 
<br><br>
<p>#[a-z]# correspond à une chaine comprise entre a et z en minuscule</p>
<?php var_dump(preg_match_all('#[a-z]#', 'helloffeA  world !ggrg')); // renvoie 17/22 car les espaces, les majuscules et le ! ne sont pas pris en compte ?> 
<br><br>
<p>#[^A-Z]# correspond à une chaine comprise entre a et z en minuscule</p>
<?php var_dump(preg_match_all('#[^A-Z]#', 'helloffeA  world !ggrg')); // renvoie 21/22 car on ne veut pas des caracteres entre A et Z en majuscule ?>
<br><br>
<p>#[a-z]+# correspond à une 1 ou plus de caractères en minuscule</p> <!-- >= 1 -->
<?php var_dump(preg_match_all('#[a-z]+#', 'heLLo WorLD !')); // renvoie 3 car il a trouvé 3 chaines qui ont au moins 1 caractères en minuscule ?>
<br><br>
<p>#w*d# correspond à 0 ou plus de caractères (joker)</p> <!-- >= 0 -->
<p>pourra être wd wild world etc...</p>
<?php var_dump(preg_match_all('#w*d#', 'heLLo WorLD !')); ?>
<br><br>
<p>#[wor?d]# correspond à 0 ou 1 caractère (joker)</p>
<p>pourra être word world par contre worked ne sera pas bon</p>
<?php var_dump(preg_match_all('#[a-z]?#', 'heLLo WorLD !')); ?> <!-- 0 || 1 -->
<br><br>
<p>#[0-9.-]# correspond à n'importe quel chiffre point ou tiret</p>
<?php var_dump(preg_match_all('#[0-9.-]#', 'heLLo WorLD ! 007.')); // renvoie 4 ?>
<br><br>
<p>#[\d]# correspond à n'importe quel chiffre soit [0-9]</p>
<?php var_dump(preg_match_all('#[\d]#', 'heLLo WorLD ! 007.')); // renvoie 3/18 ?>
<br><br>
<p>#[\D]# correspond à n'importe quel caractère non numérique soit  [^0-9]</p>
<?php var_dump(preg_match_all('#[\D]#', 'heLLo WorLD ! 007.')); // renvoie 15/18 ?>
<br><br>
<p>#[\s]# correspond à n'importe quel caractère d'espacement (espace, tabulation, nouvelle ligne ou retour chariot [ \t\n\r]</p>
<?php var_dump(preg_match_all('#[\s]#', 'heLLo WorLD ! 007.')); // renvoie 3 ?>
<br><br>
<p>#[\w]# correspond à n'importe quel caractère alphanumérique et le underscore [0-9_a-zA-Z]</p>
<?php var_dump(preg_match_all('#[\w]#', 'heLLo WorLD ! 007.')); // renvoie 13 ?>
<br><br>
<p>#[\W]# correspond à n'importe quel caractère autre qu'un caractère alphanumérique et autre qu'un underscore [^0-9_a-zA-Z]</p>
<?php var_dump(preg_match_all('#[\W]#', 'heLLo WorLD ! 007.')); // renvoie 5 ?>
<br><br>
<p>#(hello|WorLD)# doit correspondre à l'une des 2 chaines... | correspond à 'ou'</p>
<?php var_dump(preg_match_all('#(hello|WorLD)#', 'heLLo WorLD ! 007.')); // renvoie 1 car hello et pas heLLo ?>
<br><br>
<p>#(hello|WorLD)# doit correspondre à l'une des 2 chaines... | correspond à 'ou'</p>
<?php var_dump(preg_match_all('#(hello|WorLD)#', 'heLLo WorLD ! 007.')); // renvoie 1 car hello et pas heLLo ?>
<br><br>
<p>#^[a-zA-Z0-9]{2,}$#  indique que je veux une chaine d'au minimum 2 caractères avec que des lettres ou chiffres (minuscules et majuscules)</p>
<p>{2}</p> <!-- === 2 -->
<p>{2,}</p> <!-- >= 2 -->
<p>{2,6}</p> <!-- entre 2 et 6 caractères -->
<?php var_dump(preg_match_all('#^[a-zA-Z0-9]{2,}$#u', 'elephant')); // renvoie 1 mais éléphant renvoie 0 ?>
<br><br>
<p>#([wx][yz])#  va matcher avec wy wz xy xz</p>
<?php var_dump(preg_match_all('#([wx][yz])#', 'wy')); // renvoie 1 ?>
<br><br>

<p>#([A-Z]{3}|[0-9]{4})#  va matcher 4 lettres en majuscule ou 4 chiffres</p>
<?php var_dump(preg_match_all('#([A-Z]{3}|[0-9]{4})#', '1234')); // renvoie 1 ?>
<br><br>

<h2>Exemple avec preg_replace</h2>
<?php 
$string = 'Hello WORLD !';
$replace = 'Campus du Lac';
$pattern = '#WORLD#';
?>
<p>Phrase initiale : <?php echo $string ?></p>
<p>Pattern : <?php echo $pattern ?></p>
<p>Terme de remplacement : <?php echo $replace ?></p>
<br><br>
<p>Résultat : <?php echo preg_replace($pattern, $replace, $string);
  ?></p>
<br>
<br>
<p>exercice paramétrer un regex pour mot de passe</p>
<p>contraintes :</p>
<p>Au moins 1 majuscule</p>
<p>Au moins 1 minuscule</p>
<p>Au moins 1 chiffre</p>
<p>Au moins 1 caractère spécial</p>

<p>réponse : #^(?=(.*[A-Z])+)(?=(.*[a-z])+)(?=(.*[\d])+)(?=.*\W)(?!.*\s).{8,16}$#</p>

<br>

<h2>Les sous-masques ?: ?= ?! (ce sont des conditions)</h2>
<p>?: condition pour lancer le pattern mais celui-ci ne sera pas capturé en cas d'enregistrement</p>
<?php
preg_match('#^(?:(.*(WORLD)){1,})(.*WORLD.*)$#', $string, $match);
var_dump($match);
?>
<br>
<p>?= condition pour lancer le pattern et celui sera capturé. ici il faudra que WORLD soit présent</p>
<?php
preg_match('#^(?=(.*(WORLD)){1,})(.*WORLD.*)$#', $string, $match);
var_dump($match);
?>
<br>
<p>?! condition où le modele ne doit pas correspondre pour lancer le pattern et celui sera capturé. ici il faudra que beautiful soit absent</p>
<?php
preg_match('#^(?!(.*(beautiful)){1,})(.*WORLD.*)$#', $string, $match);
var_dump($match);
?>
<p>Si votre demande est juste de savoir si un mot est dans la chaine</p>
<p>On utilisera plus strpos</p>
<?php var_dump(strpos($string,'Hello')); ?>
<br><br>
<?php
require __DIR__ . '/footer.php';
