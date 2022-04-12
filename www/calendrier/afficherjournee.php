
<?php

require 'codes snippet/Events.php';
$events = new Events();
if(!isset($_GET['date_jour'])){
    die("erreur date de reservation null");
}
$date_jour= new DateTime($_GET['date_jour']);
$event = $events->getEventByDay($date_jour);
?>

<h1>COUCOU </h1>


<table class="table">
        <tr class="table-header">
            <th>Titre de la réservation</th>
            <th>Nom de l'utilisateur</th>
            <th>Nom de la moyen</th>
            <th>Date de début de la réservation</th>
            <th>Heure de début de la réservation</th>
            <th>Date de fin de la réservation</th>
            <th>Heure de fin de la réservation</th>
            <th></th>

        </tr>

        <?php
        foreach($event as $row){
            $date_deb= (new DateTime($row['date_debut']))->format('d/m/Y'); 
            $date_fin= (new DateTime($row['date_fin']))->format('d/m/Y'); 
            $heure_deb= (new DateTime($row['date_debut']))->format('h:m'); 
            $heure_fin= (new DateTime($row['date_fin']))->format('h:m'); 
            
         echo

         "<tr>
            <td>" . $row['titre_reservation'] . "</td>
            <td>" . $row['nom_utilisateur'] . "</td>
            <td>" . $row['nom_moyen'] . "</td>
            <td>" . $date_deb .  "</td>
            <td>" . $heure_deb .  "</td>
            <td>" . $date_fin .  "</td>
            <td>" . $heure_fin .  "</td>
            <td> <a href='./voirReservation.php?id=" . $row['id'] . "'>  
                <img src='image\search-icon.png' alt='edit icon' width='30'/> 
            </a>

            </tr>"; 
        }
     ?>
</table>

<style>
.table {
    width: 95%;
    margin: 2.5%;
    border: 1px solid #ccc;

}

.table tr:nth-child(even) {
    background-color: #f2f2f2;
    
}

.table tr:hover {
    background-color: #ddd;
}

.table-header {
    background-color:#f15a23;
    color: white;
}

</style>