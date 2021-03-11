<?php
	require 'vendor/autoload.php';
	use Laminas\Ldap\Attribute;
	use Laminas\Ldap\Ldap;
	
	ini_set('display_errors', 0);
	if ($_POST['usr'] && $_POST['ou'] && $_POST['atributeformradio'] && $_POST['noucontingut'] ){
    	#
    	# Atribut a modificar --> Número d'idenficador d'usuari
    	#
	    $atribut=$_POST['atributeformradio']; # El número identificador d'usuar té el nom d'atribut uidNumber
	    $nou_contingut=$_POST['noucontingut'];
    	#
    	# Entrada a modificar
    	#
    	$uid = $_POST['usr'] ;
    	$unorg = $_POST['ou'];
    	$dn = 'uid='.$uid.',ou='.$unorg.',dc=fjeclot,dc=net';
    	#
    	#Opcions de la connexió al servidor i base de dades LDAP
    	$opcions = [
    		'host' => 'zend-sealja.fjeclot.net',
    		'username' => 'cn=admin,dc=fjeclot,dc=net',
    		'password' => 'fjeclot',
    		'bindRequiresDn' => true,
    		'accountDomainName' => 'fjeclot.net',
    		'baseDn' => 'dc=fjeclot,dc=net',		
    	];
    	#
    	# Modificant l'entrada
    	#
    	$ldap = new Ldap($opcions);
    	$ldap->bind();
    	$entrada = $ldap->getEntry($dn);
    	if ($entrada){
    		Attribute::setAttribute($entrada,$atribut,$nou_contingut);
    		$ldap->update($dn, $entrada);
    		echo "Atribut modificat"; 
    	} else echo "<b>Aquesta entrada no existeix</b><br><br>";	
	}
?>
<html>
    <head>
    <title>
    MODIFICAR USUARIS DE LA BASE DE DADES LDAP
    </title>
    </head>
    <body>
    	<form action="http://zend-sealja.fjeclot.net/daw2_m08uf23_projecte_aliaga_sergio/modificarusuari.php" method="POST">
            Unitat organitzativa: <input type="text" name="ou"><br>
            Usuari: <input type="text" name="usr"><br>
           	Uidnumber: <input type="radio" name="atributeformradio" id="uidNumber" value="uidNumber" checked><br>
            Gidnumber: <input type="radio" name="atributeformradio" id="gidNumber" value="gidNumber"><br>
        	Directori personal: <input type="radio" name="atributeformradio" id="homeDirectory" value="homeDirectory"><br>
        	Shell: <input type="radio" name="atributeformradio" id="loginShell" value="loginShell"><br>
        	cn: <input type="radio" name="atributeformradio" id="cn" value="cn"><br>
        	sn: <input type="radio" name="atributeformradio" id="sn" value="sn"><br>
        	Given name: <input type="radio" name="atributeformradio" id="givenName" value="givenName"><br>
        	Postal Adress: <input type="radio" name="atributeformradio" id="postalAddress" value="postalAddress"><br>
        	Mobile: <input type="radio" name="atributeformradio" id="mobile" value="mobile"><br>
        	Telephone number: <input type="radio" name="atributeformradio" id="telephoneNumber" value="telephoneNumber"><br>
        	Title: <input type="radio" name="atributeformradio" id="title" value="title"><br>
        	Description: <input type="radio" name="atributeformradio" id="description" value="description"><br>
            Nou contingut: <input type="text" name="noucontingut"><br>
            <input type="submit"/>
            <input type="reset"/>
		</form>
		<a href="http://zend-sealja.fjeclot.net/daw2_m08uf23_projecte_aliaga_sergio/menu.php">Torna al menu</a>
	</body>
</html>
