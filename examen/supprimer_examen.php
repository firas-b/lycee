<?php
require_once("../config.php");

if(isset($_GET["id"]))
{
    $id = $_GET["id"];

    try { 
        $req = "DELETE FROM examen WHERE id_examen = $id";
        $n = $db->exec($req);
        
        if($n) {
            echo '<script type="text/javascript">
            alert("succés de suppression!");
            window.location.href = "liste_examen.php";
        </script>';
        }
    }
    catch(PDOException $e)
    {
        echo "Problème de requête (suppression)... : ".$e->getMessage();
    }
}
?>
