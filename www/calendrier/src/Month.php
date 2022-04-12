<?php 

class Month{

    public $days= ['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'];
    private $months= ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Aout','Septembre','Octobre','Novembre','Décembre'];

    public $month;
    public $year;

    //Constructeur de la classe
    public function __construct(int $month ,int $year){
        if ($month === -8 || $month < 1 || $month > 12){
            $month=intval(date('m'));
        }
        if ($year ===-8){
            $year=intval(date('Y'));
        }
        $this->month=$month;
        $this->year = $year;
        
    }

    //Retourne le premier jour du mois
    public function getStartDay(): DateTime{
        return new DateTime("{$this->year}-{$this->month}-01");
    }
    //Retourne le mois et l'année
    public function toString(): string {
        return $this->months[$this->month -1].' '.$this->year;

    }
    //Retourne le nombre de semaine
    public function getWeeks(): int {
        $start= $this->getStartDay();
        $end = (clone $start)->modify('+1 month -1 day');
    
       $weeks= intval($end->format('W'))- intval($start->format('W'))+1;
       if ($weeks <0){
           $weeks = intval($end->format('W'));
       }
       return $weeks;
        

    }

    //Retourne les jours qui ne sont pas dans le mois
    public function withinMonth (DateTime $date): bool {
        return $this->getStartDay()->format('Y-m') === $date->format('Y-m');
    }

    //Passe au mois suivant 
    public function nextMonth():Month{
        $month = $this->month+1;
        $year = $this->year;
        if ($month >12){
            $month = 1;
            $year += 1; 
        }
    
    return new Month($month,$year);
    }

    //Passe au mois précecedant 
    public function previousMonth():Month{
        $month = $this->month-1;
        $year = $this->year;
        if ($month < 1){
            $month = 12;
            $year -= 1; 
        }
    
    return new Month($month,$year);
    }

 

 


}