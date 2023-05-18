<?php 



$id=$_SESSION['id_utilisateur'];
    
    $stmt = $db->prepare("SELECT id_cours, nom_cours from cours where enseignant =$id");

$stmt->execute();
// Fetch the records so we can display them in our template.
$options= $stmt->fetchAll(PDO::FETCH_ASSOC);
?>