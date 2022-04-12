<!Doctype html> 

<html>

<head>
        <meta charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="calendrier.css">
</head>

<body>

<?php
require './src/Events.php';
$events = new Events();
if(!isset($_GET['id'])){
    die("erreur id null");
}
try {
    $event = $events->GetEventById($_GET['id']);
} catch (Exception $e){
    die("erreur id pas trouvé");
}
?>

<h1><?=$event['titre_reservation']; ?> </h1>

<div class="liste">
<ul>
    <li>Nom de l'utilisateur: <div class="valeur"> <?= $event['nom_utilisateur'] ?></div> </li> </br>
    <li>Nom du moyen  <div class="valeur"><?= $event['nom_moyen'] ?></div> </li></br>
    <li>Date de début:  <div class="valeur"><?= (new DateTime($event['date_debut']))->format('d/m/Y'); ?></div>   </li></br>
    <li>Heure de début:  <div class="valeur"><?= (new DateTime($event['date_debut']))->format('h:m'); ?></div>  </li></br>
    <li>Date de fin:  <div class="valeur"><?= (new DateTime($event['date_fin']))->format('d/m/Y'); ?></div>  </li></br>
    <li>Heure de fin:  <div class="valeur"><?= (new DateTime($event['date_fin']))->format('h:m'); ?></div>  </li></br>
    <li>Axe de recherche:  <div class="valeur"><?= $event['axe_recherche'] ?></div> </li></br> 
    <li>Raison:  <div class="valeur"><?= $event['raison'] ?></div> </li></br>

    <?php if ($event['encadrant']!= NULL):  ?>
        <li>Encadrant: </br> <div class="valeur"><?= $event['encadrant'] ?> </div> </li></br>
    <?php endif; ?>

    <?php if ($event['description']!= NULL):  ?>
        <li>Description: </br> <div class="valeur"><?= $event['description'] ?></div>  </li></br>
    <?php endif; ?>
    </div>
</ul>

<div class="contain_btn">
    <div class="bouton" >
        <a href="./modifier" class="btn-primary"> Modifier</a>
        <a href="./modifier" class="btn-primary"> Supprimer</a>
    </div>
</div> 
</body>

<style>
.btn-primary{
    border: 1px solid #f15a23;
    padding: 5px ; 
    background-color: #f15a23;
    color: white; 
    border-radius: 5%;
    width: 10%;
    font-size: 1em;
    display: flex;
    justify-content: center;
    margin: 2% 20% 0% 20%;
    text-decoration: none;
}
.btn-primary:hover{
    background-color: #E05523; 
    color: white; 
}
.bouton{
    display: flex;
    justify-content: space-between ;
    margin-bottom: 2% ;

    
}
</style>
