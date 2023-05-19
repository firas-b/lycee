<?php
require_once("../config.php");

      if(isset($_GET["id"]))
      {
        require_once("connect.inc.php");
        $id = $_GET["id"];
        // Connexion a la base de donnees
        
try { 
  $req="delete from utilisateur where id_utilisateur = $id";
    $n = $db->exec($req);
    if($n>0) {
        echo "Suppression effectuee avec succes... :)";
        header('location:liste_utilisateur.php');
    }
}
catch(PDOException $e)
{
    echo "Probleme de requete(suppression)... : ".$e->getMessage();
}
      }

?>