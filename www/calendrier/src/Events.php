<?php
require("../www/codes snippet/GestionBdd.php");


class Events{


    private $bdd;

    // creation du constructeur 
    public function __construct(){
        $this->bdd = new GestionBdd();
    }
    // récupère les évènements commencant entre 2 dates
    public function getEventsBetween (DateTime $start, DateTime $end): array {
        $results = $this->bdd->dateDansUnMois($start,$end);
        return $results;
    }
    // récupère les évènements commencant entre 2 dates indéxé par jour 
    public function getEventsBetweenByDay (DateTime $start, DateTime $end): array {
       $events = $this->getEventsBetween($start,$end);
       $days =[];
       foreach($events as $event) {
           $date = explode(' ', $event['date_debut'])[0];
           if (!isset($days[$date])){
               $days[$date] = [$event];
           }else {
               $days[$date][]= $event;
           }
       }
       return $days;
    }
    // charche un event en fonction du jour donnée 
    public function getEventByDay(DateTime $date_jour): array {
        $results = $this->bdd->getByDay($date_jour);
        return $results;
    }

    // cherche un event par son id
    public function getEventById(int $id): array {
        $results = $this->bdd->getReservationByID($id);
        if ($results == false) {
            throw new Exception('Aucun résultat n\'a été trouvé');
        }
        return $results;
    }
}