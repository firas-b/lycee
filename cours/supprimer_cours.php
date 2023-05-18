<?php
require_once("../config.php");

      if(isset($_GET["id"]))
      {
        
        $id = $_GET["id"];
        $req="delete from cours where id_cours=$id";
        
try {
    $n = $db->exec($req);
    if($n>0) {
        echo '<script type="text/javascript">
        alert("succés  !");
        window.location.href = "liste_cours.php";
    </script>';
    }
}
catch(PDOException $e)
{
    echo "Probleme de requete(suppression)... : ".$e->getMessage();
}
      }

?>