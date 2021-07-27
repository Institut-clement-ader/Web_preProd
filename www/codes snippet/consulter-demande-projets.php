<?php
  // Restreint l'accès aux administrateurs
  if (!is_user_logged_in()) {
    echo("loggin to access this page");
	  exit();
  }
  $user = wp_get_current_user();
  $email = $user->user_email;
// Si Nicolas ou Admin
  if(strcmp($email, 'nicolas.laurien@insa-toulouse.fr') !=0 and !current_user_can('administrator')){
    echo("you are not allowed to be here!");
	  exit();
  }
  
  //CONNEXION A LA BDD
  $serveur="localhost";
	$utilisateur="lab0611sql3";
	$password="1pm6STt9TE0n";
	$db="lab0611sql3db";

  require("codes snippet/GestionBdd.php");
  $bdd = new GestionBdd($serveur,$db,$utilisateur,$password);
  $req = $bdd->getDemandesProjets();
  
    
  ?>
  
  <table>
    <thead>
				<tr>
					<th>Nom du projet</th>
					<th>Date de depôt</th>
					<th>Nom du/des porteur(s)</th>
					<th>Accepter</th>
          <th>Refuser</th>
				</tr>
    </thead>

			
				<?php
          
					if(isset($req)){
						while($row = $req->fetch()){
              $user = get_user_by( 'email', $row['mail'] );
              $user_id = $user->ID;
              $username = $user->first_name." ".$user->last_name;
							?>
              <tbody>
							<tr>
								<?php if($row['necessite_projet']==1){echo '<td>';?><?php echo strtoupper($row['nom']); ?><?php echo '</td>';?>
								<?php echo '<td>';?><?php echo ucfirst($row['prenom']); ?><?php echo '</td>';?>
                <?php echo '<td>';?><?php echo $username;?><?php echo '</td>';?>
								<?php echo '<td>acceptée</td>';?>
                <?php echo '<td> </td>';}?>
                <?php if($row['necessite_projet']==0){echo '<td>';?><?php echo strtoupper($row['nom']); ?><?php echo '</td>';?>
								<?php echo '<td>';?><?php echo ucfirst($row['prenom']); ?><?php echo '</td>';?>
                <?php echo '<td>';?><?php echo $username;?><?php echo '</td>';?>
								<?php echo '<td id="accepterDemande"><form action="https://ica.preprod.lamp.cnrs.fr/gerer-les-projets/" method="POST"><button style="background-color:green" type="hidden" name="accepter" value="';?><?php echo $row['id']; ?>">accepter<?php echo '</button></form></td>';?>'
                <?php echo '<td id="refuserDemande"><form action="https://ica.preprod.lamp.cnrs.fr/gerer-les-projets/" method="POST"><button style="background-color:red" type="hidden" name="refuser" value="';?><?php echo $row['id']; ?>">refuser<?php echo '</button></form></td>';}?>
							</tr>
              </tbody>
					<?php
				}
			}
    
      if(isset($_POST['accepter'])){
        $bdd->accepterDemandeProjet($_POST['accepter']);
        $req = $bdd->getDemandesProjetByid($_POST['accepter']);
        $row = $req->fetch();
        $user = get_user_by( 'email', $row['mail'] );
        $username = $user->first_name." ".$user->last_name;
        echo $row['mail'].$username;
        wp_mail($row['mail'], 'Demande de projet acceptée', 'Votre demande de projet pour a été acceptée !','Bonjour,');
        wp_mail('Marie-Odile.Monsu@isae-supaero.fr', 'Demande ZRR acceptée','la demande ZRR faite par '. $username. ' pour '.$row['prenom'].' '.$row['nom'].' a été acceptée. La fin de la mission est estimée au '.$row['date_fin'].'.','Bonjour,');
        header('Location: https://ica.preprod.lamp.cnrs.fr/gerer-les-projets/');
      }
      if(isset($_POST['refuser'])){
        $url = $bdd->getUrlProjet($_POST['refuser']);
        $req = $bdd->getDemandesProjetByid($_POST['refuser']);
        $row = $req->fetch();
        $user = get_user_by( 'email', $row['mail'] );
        $username = $user->first_name." ".$user->last_name;
        echo $row['mail'].$username;
        wp_mail($row['mail'], 'Demande de projet refusée', 'Votre demande de projet a été refusée','Bonjour,');
        $bdd->refuserDemandeProjet($_POST['refuser']); 
        unlink($url);
        header('Location: https://ica.preprod.lamp.cnrs.fr/gerer-les-projets/');
        
      }
    
    
    
			?>
		</table>