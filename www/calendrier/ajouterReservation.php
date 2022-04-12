<!Doctype html> 

<html>

<head>
        <meta charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="calendrier.css">
</head>
<body>
<?php
    require './src/ValiderDonnee.php';
    if($_SERVER['REQUEST_METHOD']== 'POST'){ 
        $valider= new ValiderDonnee();
    } ?>

    <h1>Ajouter une réservation</h1>
    <form action="ajouterReservation.php" method="post" class="form">
        <div class="row">
                <div class="form-group">
                    <label for="titre_reservation">Titre</label>
                    <input id="titre_reservation" required type="text" class="form-control" name="titre_reservation" >
                </div>
                <div class="col-sm-6">
                <div class="form-group">
                    <label for="nom_utilisateur">nom de l'utilisateur</label>
                    <input id="nom_utilisateur" required type="text" class="form-control" name="nom_utilisateur"  >
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="nom_moyen">nom du moyen</label>
                    <input id="nom_moyen" required type="text" class="form-control" name="nom_moyen" >
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="date_debut">Date de début</label>
                    <input id="date_debut" required type="date" class="form-control" name="date_debut" >
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="heure_debut">Heure de début</label>
                    <input id="heure_debut" required type="time" class="form-control" name="heure_debut" >
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="date_fin">Date de fin</label>
                    <input id="date_fin" required type="date" class="form-control" name="date_fin">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="heure_fin">Heure de fin</label>
                    <input id="heure_fin" required type="time" class="form-control" name="heure_fin" >
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="raison">Raison</label>
                    <input id="raison" required type="text" class="form-control" name="raison" >
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="encadrant">Encadrant</label>
                    <input id="encadrant" type="text" class="form-control" name="encadrant" >
                </div>
            </div>
            <div class="form-group">
                    <label for="axe_recherche">Axe de recherche</label>
                    <input id="axe_recherche" required type="text" class="form-control" name="axe_recherche" >
            </div>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control" > </textarea>
        </div>
        <div class="bouton">
            <button class="btn btn-primary" type="reset" name="reset" value="Annuler">Annuler</button>
            <button class="btn btn-primary" type="submit" name="submit" value="Ajouter">Ajouter</button>
        </div>
        
        
    </form>
</div>

<?php 

?>
</div>
</body>

</html>

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
