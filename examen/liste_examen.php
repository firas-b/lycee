<?php
session_start();
if ($_SESSION['role']!= 'enseignant') { header('Location: ../login.php'); }

?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
<script src="../assets/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../assets/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link rel="stylesheet" href="../css/profile.css">



  <
</head> 
<body>
  <div class="main-content">
    <!--    naavbar-->
    <link rel="stylesheet" href="../css/nav.css">
  <?php  include '../nav.php'?>
    <!----->
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 600px; background-image: url(https://www.usnews.com/dims4/USNEWS/0db25a9/2147483647/crop/2119x1413+1+0/resize/970x647/quality/85/?url=https%3A%2F%2Fwww.usnews.com%2Fcmsmedia%2F23%2F02%2Fa1a88058409d8bc02755e6ae8bfa%2F200825-studyingbook-stock.jpg); background-size: cover; background-position: center top;">
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h1 class="display-2 text-white">Bonjour <?php  echo $_SESSION ['username']?>  </h1>

            <a href="ajouter_examen.php" class="btn btn-info">Ajouter examen</a>

          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row justify-content-center">
        
        <div class="col-xl-10 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">liste des examens</h3>
                </div>
                
              </div>
            </div>
            <div class="card-body" style="background-color:white;">
            <?php  require '../config.php' ?>
<table class=" table-sm  w-100 justify-content" style=" overflow:scroll;">
  <thead>
    <tr>
      <th scope="col">#</th>
     
      <th scope="col">examen</th>
      <th scope="col">cours</th>
      <th scope="col">enseignant</th>
      <th scope="col">date</th> 
      <th scope="col"> action</th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
 <?php

 $id = $_SESSION["id_utilisateur"];
 try {

  if (isset($_GET['cours_id'])){
    $cours=$_GET['cours_id'] ;
    $sql = "SELECT u.nom,u.prenom, date ,id_examen,nom_cours, nom_examen  from examen join cours on examen.cours=cours.id_cours join enseignant on cours.enseignant = enseignant.utilisateur join utilisateur u on enseignant.utilisateur = u.id_utilisateur where cours.enseignant= $id  and cours.id_cours=$cours";}
  
else {$sql = "SELECT u.nom,u.prenom,date, id_examen,nom_cours, nom_examen  from examen join cours on examen.cours=cours.id_cours join enseignant on cours.enseignant = enseignant.utilisateur join utilisateur u on enseignant.utilisateur = u.id_utilisateur where cours.enseignant= $id; ";}
    $result = $db->query($sql);

     while($row =$result->fetch(PDO::FETCH_ASSOC)){
        echo '<tr>';
        echo'<td>'.$row['id_examen'].'</td>';
        echo'<td>'.$row['nom_examen'].'</td>';
        echo '<td>'.$row['nom_cours'].'</td>';
      
        echo'<td>'.$row['nom']." ".$row['prenom'].'</td>';
        echo '<td>'.$row['date'].'</td>';
        ?>
  <td>
    <a class="btn btn-sm btn-primary" href="../notes/ajouter_notes.php?id=<?=$row['id_examen']?>">ajouter notes</a>
    <a class="btn btn-sm btn-secondary" href="../notes/listes_notes.php?id=<?=$row['id_examen']?>">voir notes</a>
    <a class="btn btn-sm btn-danger" href="../examen/supprimer_examen.php?id=<?=$row['id_examen']?>">supprimer</a></td>
        <?php
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
</table>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 
</body>

</html>