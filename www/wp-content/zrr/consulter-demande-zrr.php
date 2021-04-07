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
	$password="1pm6STt9TE0n"
	$db="lab0611sql3db";

  require("codes snippet/GestionBdd.php");
  $bdd = new GestionBdd($serveur,$db,$utilisateur,$password);
  $req = $bdd->getDemandes();
  
    
  ?>
  
  <table>
    <thead>
				<tr>
					<th>Nom</th>
					<th>Prénom</th>
					<th>Demandeur</th>
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
								<?php if($row['necessite_zrr']==1){echo '<td>';?><?php echo strtoupper($row['nom']); ?><?php echo '</td>';?>
								<?php echo '<td>';?><?php echo ucfirst($row['prenom']); ?><?php echo '</td>';?>
                <?php echo '<td>';?><?php echo $username;?><?php echo '</td>';?>
								<?php echo '<td>acceptée</td>';?>
                <?php echo '<td> </td>';}?>
                <?php if($row['necessite_zrr']==0){echo '<td>';?><?php echo strtoupper($row['nom']); ?><?php echo '</td>';?>
								<?php echo '<td>';?><?php echo ucfirst($row['prenom']); ?><?php echo '</td>';?>
                <?php echo '<td>';?><?php echo $username;?><?php echo '</td>';?>
								<?php echo '<td id="accepterDemande"><form action="https://ica.preprod.lamp.cnrs.fr/demandes-zrr/" method="POST"><button style="background-color:green" type="hidden" name="accepter" value="';?><?php echo $row['id']; ?>">accepter<?php echo '</button></form></td>';?>'
                <?php echo '<td id="refuserDemande"><form action="https://ica.preprod.lamp.cnrs.fr/demandes-zrr/" method="POST"><button style="background-color:red" type="hidden" name="refuser" value="';?><?php echo $row['id']; ?>">refuser<?php echo '</button></form></td>';}?>
							</tr>
              </tbody>
					<?php
				}
			}
    
      if(isset($_POST['accepter'])){
        $bdd->accepterDemande($_POST['accepter']);
        $req = $bdd->getDemandesByid($_POST['accepter']);
        $row = $req->fetch();
        $user = get_user_by( 'email', $row['mail'] );
        $username = $user->first_name." ".$user->last_name;
        echo $row['mail'].$username;
        wp_mail($row['mail'], 'Demande ZRR acceptée', 'Votre demande ZRR pour '.$row['prenom'].' '.$row['nom'].' a été acceptée','Bonjour,');
        wp_mail('Marie-Odile.Monsu@isae-supaero.fr', 'Demande ZRR acceptée','la demande ZRR faite par '. $username. ' pour '.$row['prenom'].' '.$row['nom'].' a été acceptée. La fin de la mission est estimée au '.$row['date_fin'].'.','Bonjour,');
        header('Location: https://ica.preprod.lamp.cnrs.fr/demandes-zrr/');
      }
      if(isset($_POST['refuser'])){
        $url = $bdd->getUrl($_POST['refuser']);
        $req = $bdd->getDemandesByid($_POST['refuser']);
        $row = $req->fetch();
        $user = get_user_by( 'email', $row['mail'] );
        $username = $user->first_name." ".$user->last_name;
        echo $row['mail'].$username;
        wp_mail($row['mail'], 'Demande ZRR refusée', 'Votre demande ZRR pour '.$row['prenom'].' '.$row['nom'].' a été refusée','Bonjour,');
        $bdd->refuserDemande($_POST['refuser']); 
        unlink($url);
        header('Location: https://ica.preprod.lamp.cnrs.fr/demandes-zrr/');
        
      }
    
    
    
			?>
		</table>