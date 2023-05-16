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

<div class="container-fluid ">
  <div class="row justify-content-center">
<?php  require '../config.php' ?>
<table class=" table-sm  w-75 justify-content" style=" overflow:scroll;">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">cours</th>
      <th scope="col">examen</th>
           <th>note</th>
      <th scope="col"> action</th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
 <?php
 session_start();  
 $id = $_SESSION["id_utilisateur"];
 try {
    
    $sql = "SELECT id_examen,nom_cours, nom_examen,note from examen join cours on examen.cours=cours.id_cours where eleve=$id";

    $result = $db->query($sql);

     while($row =$result->fetch(PDO::FETCH_ASSOC)){
        echo '<tr>';
        echo'<td>'.$row['id_examen'].'</td>';
        echo '<td>'.$row['nom_cours'].'</td>';
        echo'<td>'.$row['nom_examen'].'</td>';
        echo'<td>'.$row['note'].'</td>';
  
        
        echo'</tr>';
     }
     
echo'</tbody>
</table>';
     
    }
    catch(PDOException $e)
{
    echo "<br> Probleme de requete".$e->getMessage();
}

 ?>
  </tbody>
  </div>
  </div>
</table>


</body>
</html>