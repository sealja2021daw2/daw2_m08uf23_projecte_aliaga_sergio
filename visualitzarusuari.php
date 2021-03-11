<?php
require 'vendor/autoload.php';
use Laminas\Ldap\Ldap;
ini_set('display_errors',0);
if ($_GET['usr'] && $_GET['ou']){
    $domini = 'dc=fjeclot,dc=net';
    $opcions = [
        'host' => 'zend-sealja.fjeclot.net',
        'username' => "cn=admin,$domini",
        'password' => 'fjeclot',
        'bindRequiresDn' => true,
        'accountDomainName' => 'fjeclot.net',
        'baseDn' => 'dc=fjeclot,dc=net',
    ];
    $ldap = new Ldap($opcions);
    $ldap->bind();
    $entrada='uid='.$_GET['usr'].',ou='.$_GET['ou'].',dc=fjeclot,dc=net';
    $usuari=$ldap->getEntry($entrada);
    echo "<b><u>".$usuari["dn"]."</b></u><br>";
    foreach ($usuari as $atribut => $dada) {
        if ($atribut != "dn") echo $atribut.": ".$dada[0].'<br>';
    }
}
?>
<html>
    <head>
    <title>
    MOSTRANT DADES D'USUARIS DE LA BASE DE DADES LDAP
    </title>
    </head>
    <body>
    	<form action="http://zend-sealja.fjeclot.net/daw2_m08uf23_projecte_aliaga_sergio/visualitzarusuari.php" method="GET">
            Unitat organitzativa: <input type="text" name="ou"><br>
            Usuari: <input type="text" name="usr"><br>
            <input type="submit"/>
            <input type="reset"/>
		</form>
		<a href="http://zend-sealja.fjeclot.net/daw2_m08uf23_projecte_aliaga_sergio/menu.php">Torna al menu</a>
	</body>
</html>