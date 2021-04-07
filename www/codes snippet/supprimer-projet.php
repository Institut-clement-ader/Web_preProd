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

	//SUPPRESSION D'UN PROJET
	//si un id a ete transmis
	if (isset($_POST["id_projet"])) {
		$id = $_POST["id_projet"];
		if (!empty($id)) {
			//on supprime le projet dont l'id a ete transmis
			$requete="DELETE FROM `wp_pods_projet` WHERE `id` = :id LIMIT 1";
			$req = $bdd->prepare($requete);
			$req->execute(array('id'=>$id));
		}
	}
?>