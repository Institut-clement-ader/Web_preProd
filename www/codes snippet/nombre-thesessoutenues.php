<?php
	//LIAISON A LA BDD
	$serveur="localhost";
	$utilisateur="lab0611sql3";
	$password="1pm6STt9TE0n"
	$db="lab0611sql3db";
	
	try {
		$bdd = new PDO('mysql:host='.$serveur.';dbname='.$db, $utilisateur, $password);
	} catch(PDOException $e) {
		print "Erreur : ".$e->getMessage();
		die();
	}

	//On selectionne le nombre de theses dont la soutenance est definie et inferieure a la date courante
	$requete="SELECT COUNT(*) FROM wp_pods_these WHERE NOT(date_soutenance <=> NULL) AND date_soutenance <= CURDATE()";
	$nb_theses= $bdd->query($requete)->fetchColumn();
	//Affichage selon le nombre de resultats
	if ($nb_theses == 0)
		$nb_theses = "Aucune";
	if ($nb_theses > 1)
		echo $nb_theses." thèses soutenues.";
	else
		echo $nb_theses." thèse soutenue.";
?>