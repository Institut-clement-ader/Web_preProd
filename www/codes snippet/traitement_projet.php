<?php

        $user = wp_get_current_user();
        $username = $user->first_name." ".$user->last_name;

        wp_mail('ica.direction@insa_toulouse.fr', 'Nouveau projet soumis', 'Bonjour,
        
        Un nouveau projet vient d\'être déposé par '.$username.'
        
        Cordialement.','Bonjour,');
        
        header('Location: https://ica.preprod.lamp.cnrs.fr/soumettre-projet/');
        
      

?>