<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>

<script src="../assets/fontawesome.js"></script>
</head>
<body>
<?php  require '../config.php' ?>
<table class="table" style=" overflow:scroll;">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">nom du cours</th>
      <th scope="col">ajouté le </th>
      <th scope="col">enseignant</th>
      <th scope="col">actions</th>
    
    </tr>
  </thead>
  <tbody class="table-group-divider">
 <?php

 try {
    $sql = "SELECT id_cours, nom_cours,date_ajout,utilisateur.prenom , utilisateur.nom from cours join enseignant ON cours.enseignant=enseignant.utilisateur join utilisateur on enseignant.utilisateur=utilisateur.id_utilisateur;";
    $result = $db->query($sql);

     while($row =$result->fetch(PDO::FETCH_ASSOC)){
        echo '<tr>';
        echo '<th scope="row">'.$row["id_cours"].'</th>';
        echo '<td>'.$row['nom_cours'].'</td>';
        echo'<td>'.$row['date_ajout'].'</td>';
        echo'<td>'.$row['nom']." ".$row['prenom'].'</td>';
      
        echo '<td> <a href="edit_utilisateur.php?id="'.$row['id_cours'].'"><button class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> editer</button></a>
        <a href="supprimer.php?id="'.$row['id_cours'].'"><button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> supprimer</button></a>
        </td>';
        echo'</tr>';
     }
     
echo'</tbody>
</table>';
     $conn = null;
    }
    catch(PDOException $e)
{
    echo "<br> Probleme de requete".$e->getMessage();
}

 ?>
  </tbody>
</table>


</body>
</html>