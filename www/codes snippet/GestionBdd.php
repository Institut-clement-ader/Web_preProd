<?php
	class GestionBdd{
		private $bdd;

		public function __construct($host, $dbname, $login, $passwd){
			try{
				$this->bdd = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $login, $passwd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
			}
			catch(Exception $e){
				die('Erreur : '.$e->getMessage());
			}
		}
    
    public function ajouterDemande($nom,$prenom,$mailArrivant,$mail,$path,$date_fin){
      $req = $this->bdd->prepare('INSERT INTO wp_temp_zrr(nom,prenom,mail_arrivant,mail,path,date_fin,necessite_zrr) VALUES(?,?,?,?,?,?,?)');
			$req->execute(array($nom,$prenom,$mailArrivant,$mail,$path,$date_fin,0));
			return true;
    }
    
    public function getDemandes(){
      $req = $this->bdd->prepare('SELECT * FROM wp_temp_zrr');
      $req->execute();
      return $req;
    }
    
    public function getDemandesByEmail($mail){
      $req = $this->bdd->prepare('SELECT * FROM wp_temp_zrr WHERE mail = ?' );
      $req->execute(array($mail));
      return $req;
    }
    
    public function getDemandesById($id){
      $req = $this->bdd->prepare('SELECT * FROM wp_temp_zrr WHERE id = ?' );
      $req->execute(array($id));
      return $req;
    }
    
    public function accepterDemande($id){
      $req = $this->bdd->prepare('UPDATE wp_temp_zrr SET necessite_zrr = 1 WHERE id = ? ');
      $req->execute(array($id));
      return true;
    }
    
    public function refuserDemande($id){
      $req = $this->bdd->prepare('DELETE FROM wp_temp_zrr WHERE id = ? ');
      $req->execute(array($id));
      return true;
      
    }
    public function getUrl($id){
      $req = $this->bdd->prepare('SELECT path FROM wp_temp_zrr WHERE id = ?');
      $req->execute(array($id));
      $donnees = $req->fetch();
      
      return $donnees['path'];
      
    }
    
    public function getNecessiteZrrByEmail($mail){
      $req = $this->bdd->prepare('SELECT necessite_zrr FROM wp_temp_zrr WHERE mail_arrivant = ?');
      $req->execute(array($mail));
      $donnees = $req->fetch();
      return $donnees['necessite_zrr'];
      
    }
    
    public function getIdByEmailArrivant($mail){
      $req = $this->bdd->prepare('SELECT id FROM wp_temp_zrr WHERE mail_arrivant = ?');
      $req->execute(array($mail));
      $donnees = $req->fetch();
      return $donnees['id'];
      
    }
    
  }
?>

    