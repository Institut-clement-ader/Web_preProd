<?php
// Restreint l'accès aux utilisateurs connectés
  if (!is_user_logged_in()) {
    echo("loggin to access this page");
	  exit();
  }
    //CONNEXION A LA BDD
	$serveur="localhost";
	$utilisateur="lab0611sql3";
	$password="1pm6STt9TE0n"
	$db="lab0611sql3db";
  
?>

<?php
  $saveok=0;
  if(isset($_POST['valider'])){
    //on importe GestionBdd.php
    require("codes snippet/GestionBdd.php");
    $bdd = new GestionBdd($serveur,$db,$utilisateur,$password);
    
    $current_user = wp_get_current_user();
    $mailArrivant = $_POST['mail'];
    $name = $current_user->first_name." ".$current_user->last_name;
    $mail = $current_user->user_email;
    $user_id = get_current_user_id();
    $date_fin = $_POST['date_fin'];
    $url = dirname(__DIR__)."/zrr/uploads/".strtolower ( $_POST['nom']).strtolower ($_POST['prenom']).$user_id.".zip";
    $file = 0;
    if(filesize($_FILES['fichier']['tmp_name']) < 10000000){
      if(!file_exists($url)){
        $req = $bdd->ajouterDemande(strtolower ($_POST['nom']),strtolower ($_POST['prenom']),$mailArrivant,$mail,$url,$date_fin);
        $file = 1;

      } 
      move_uploaded_file ( $_FILES['fichier']['tmp_name'] , $url);
      if($file == 0){
        wp_mail('acces_zrr_ica@insa-toulouse.fr', 'Mise à jour de fichier ZRR', $name. ' a mis le fichier ZRR de '.$_POST['prenom'].' '.$_POST['nom'].' à jour','Bonjour,', array($url));
      }if($file == 1){
        wp_mail('acces_zrr_ica@insa-toulouse.fr', 'Nouvelle demande ZRR', $name. ' a fait une demande ZRR pour '.$_POST['prenom'].' '.$_POST['nom'].' : "https://ica.preprod.lamp.cnrs.fr/demandes-zrr/. La fin de mission est estimée à '.$_POST['date_fin'],'Bonjour,', array($url));
      }
      $saveok = 2;
    }
    else{
      $saveok = 1;
      echo'<div id="echec">';
      echo '<p style="color:white"> &nbsp; Échec de la soumission de votre dossier. Le document déposé dépasse les 7 Mo.</p><br>';
      echo'</div>';
    }
  }
?>
<?php
  echo '<h2>Site de Toulouse - Dépôt du dossier ZRR  :</h2>';
  echo "<p>Pour plus de détails sur les documents nécessaires pour la demande ZRR, reportez vous à la page <a href='https://ica.preprod.lamp.cnrs.fr/documents/zrr-site-de-toulouse/'>https://ica.preprod.lamp.cnrs.fr/documents/zrr-site-de-toulouse/</a></p>";
?>
<?php 
  if($saveok==1){

    echo'<div id="echec">';
    echo '<p style="color:white"> &nbsp; Échec de la soumission de votre dossier</p><br>';
    echo'</div>';
  }
  elseif($saveok==2){
    echo'<div id="confirmation">';
    echo '<p style="color:white"> &nbsp; Dossier soummis avec succès!</p><br>';
    echo'</div>';
  }
?>

<?php
  echo'
  <form id="inscription4" name="zrr" method="post" action="https://ica.preprod.lamp.cnrs.fr/documents/zrr-site-de-toulouse/depot-dossier-zrr/" enctype="multipart/form-data">
    Prénom de l\'arrivant (nécéssaire) : <input type="text" name="prenom" required/>
    Nom de l\'arrivant (nécéssaire) : <input type="text" name="nom" required/><br/>
    Adresse E-mail de l\'arrivant (nécéssaire) : <input type="email" name="mail" required/><br/>
    Date estimée de fin de mission (nécessaire) :<input type="date" name="date_fin" required/><br/>
    <br/>
    Dépôt fichier de  l\'archive zip (moins de <em>7Mo</em>! ) contenant:<br><br>
    -Fichier excel<br> 
    -CV<br>
    -Carte d\'identité<br>
    -Sujet<br><br>
    <input type="file" name="fichier" accept=".zip" required/><br/><br/>
    <input type="submit" name="valider" value="Valider"/>
  </form>';
?>
