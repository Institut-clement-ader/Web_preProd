<?php 
    require 'codes snippet/Month.php';
    require 'codes snippet/Events.php';

    
    $events = new Events();
    $month= new Month($_GET['month'] ?? -8 ,$_GET['year'] ?? -8);
    $start= $month->getStartDay();
    $start = $start->format('N') === '1' ? $start: $month->getStartDay()->modify("last monday");
    $weeks= $month->getWeeks();
    $end = (clone $start)->modify('+'.(6+7*($weeks-1)).' days');
    $events= $events->getEventsBetweenByDay($start,$end);


?>
<div class="contain_btn">
    <h1><?=$month-> toString(); ?></h1>
    <div class="bouton" >
        <a href="https://ica.preprod.lamp.cnrs.fr/?page_id=6197&preview=true&month=<?= $month->previousMonth()->month; ?>&year=<?= $month->previousMonth()->year; ?>" class="btn-primary"> &lt;</a>
        <a href="https://ica.preprod.lamp.cnrs.fr/?page_id=6197&preview=true&month=<?= $month->nextMonth()->month; ?>&year=<?= $month->nextMonth()->year; ?>" class="btn-primary"> &gt;</a>
    </div>
</div> 


<table class="calendar__table calendar__table--<?= $weeks; ?>weeks">
    <tbody>
    <?php 
    $e=0;
    for ($i =0; $i < $weeks; $i++): ?>
    <tr>
        <?php 
            foreach($month->days as $k => $day):
                $date= (clone $start)->modify ("+".($k+$i*7)." days");
                $eventsForDay = $events[$date->format('Y-m-d')] ?? [];
        ?>
                <td class="<?= $month->withinMonth($date) ? '' :  'calendar__othermonth'; ?>" >
                    <?php if ($i == 0): ?>
                        <div class="calendar__weekday"><?= $day;?>  </div>
                    <?php endif;?>

                    <div class="calendar__day"><?= $date->format('d');?> </div>
                    <?php foreach($eventsForDay as $event): ?>

                        <div class="calendar__event">
                            <a href= "https://ica.preprod.lamp.cnrs.fr/?page_id=6221&preview=true&date_jour=<?=$date->format('Y-m-d');?>" >
                            <?php 
                            $e += 1 ;
                            if ($e==3) : ?>
                                ...
                            <?php elseif ($e>3): ?>
                                
                            <?php else: ?>
                               - <?= $event['titre_reservation']; ?> | <?= (new DateTime($event['date_debut']))->format('d/m/Y H:i')?> - <?= (new DateTime($event['date_fin']))->format('d/m/Y H:i')?> | <?= $event['nom_moyen']; ?>                   
                            <?php endif; ?>
                            </a>
                        </div>

                <?php endforeach; ?>
        </td>
            <?php endforeach; ?>
    </tr>
    </tbody>
    <?php endfor; ?>
</table>


<style>
*{
    font-size:10px;
    text-decoration: none;
}
.calendar__table{
    width: 100%;  
    height: calc(100vh - 128px );
    
  }

.calendar__table td {
    padding: 1vh;
    border: 1px solid #ccc;
    vertical-align: top;
    width: 14.29%;
    height: 10vmax;
}
.calendar__table--6weeks td {
    height: 16.66%;
}

.calendar__weekday{
    font-weight: bold;
    color: black;
    font-size: 1.5em;
}
.calendar__day{
  font-size: 1.6em;  
}
.calendar__othermonth .calendar__day {
    opacity: 0.3 ;
}
.calendar__table .calendar__event {
    color: black;
    cursor:pointer;
    font-family: 'Titillium Web';
    
}
.calendar__event a{
    text-decoration: none;
    color: black;
    text-align: center;
    font-size: 1.5em;
}
.btn-primary{
    border: 1px solid #f15a23;
    padding: 5px ; 
    background-color: #f15a23;
    color: white; 
    border-radius: 5%;
    width: 5%;
    font-size: 3em;
    display: flex;
    justify-content: center;
}
.btn-primary:hover{
    background-color: #E05523; 
    color: white; 
}
.bouton{
    display: flex;
    justify-content: space-between ;
    margin-bottom: 2% ;
    right: 10%;
}
</style>